<?php

namespace Tests\Feature;

use App\Models\HoaDon;
use App\Models\KhachHang;
use App\Models\LoaiSan;
use App\Models\PhieuDatSan;
use App\Models\San;
use App\Models\TaiKhoan;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Client\Request as HttpClientRequest;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class ZaloPayPaymentTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        config([
            'services.zalopay.app_id' => 2554,
            'services.zalopay.key1' => 'sdngKKJmqEMzvh5QQcdD2A9XBSKUNaYn',
            'services.zalopay.key2' => 'trMrHtvjo6myautxDUiAcYsVtaeQ8nhf',
            'services.zalopay.create_url' => 'https://sb-openapi.zalopay.vn/v2/create',
            'services.zalopay.query_url' => 'https://sb-openapi.zalopay.vn/v2/query',
            'services.zalopay.callback_url' => null,
        ]);
    }

    /**
     * @return array{0: TaiKhoan, 1: KhachHang}
     */
    private function createCustomerAccount(string $username, string $phone): array
    {
        $taiKhoan = TaiKhoan::create([
            'TenDangNhap' => $username,
            'MatKhau' => bcrypt('password'),
            'VaiTro' => 'khach_hang',
            'TrangThai' => 'hoat_dong',
        ]);

        $khachHang = KhachHang::create([
            'MaTK' => $taiKhoan->MaTK,
            'HoTen' => 'Khách hàng '.$username,
            'SDT' => $phone,
            'Email' => $username.'@example.com',
        ]);

        return [$taiKhoan, $khachHang];
    }

    public function test_booking_with_zalopay_creates_order_and_returns_payment_url(): void
    {
        Http::preventStrayRequests();
        Http::fake([
            'https://sb-openapi.zalopay.vn/v2/create' => Http::response([
                'return_code' => 1,
                'return_message' => 'Giao dịch thành công',
                'order_url' => 'https://sbgateway.zalopay.vn/openinapp?order=test_token',
                'zp_trans_token' => 'zp_token_123',
            ], 200),
        ]);

        [$taiKhoan] = $this->createCustomerAccount('nguyenvana', '0912345678');

        $loaiSan = LoaiSan::create(['TenLoai' => 'Bóng đá']);
        $san = San::create([
            'TenSan' => 'Sân Bóng Đá 1',
            'MaLoai' => $loaiSan->MaLoai,
            'GiaThue' => 200000,
            'TinhTrang' => 'Hoạt động',
        ]);

        $response = $this->actingAs($taiKhoan)->postJson(route('booking.store'), [
            'NgayDat' => now()->addDay()->toDateString(),
            'HoTen' => 'Nguyen Van A',
            'SDT' => '0912345678',
            'Email' => 'test@example.com',
            'PhuongThucThanhToan' => 'zalopay',
            'items' => [
                [
                    'MaSan' => $san->MaSan,
                    'GioBatDau' => '18:00',
                    'GioKetThuc' => '19:30',
                    'DonGia' => 200000,
                ],
            ],
        ]);

        $response->assertOk()
            ->assertJson([
                'success' => true,
                'payment_url' => 'https://sbgateway.zalopay.vn/openinapp?order=test_token',
            ]);

        $hoaDon = HoaDon::firstOrFail();
        $this->assertSame('zalopay', $hoaDon->TenPhuongThuc);
        $this->assertSame('chua_thanh_toan', $hoaDon->TrangThai);
        $this->assertNotEmpty($hoaDon->MaGiaoDich);

        Http::assertSent(function (HttpClientRequest $request) use ($hoaDon) {
            return $request->url() === 'https://sb-openapi.zalopay.vn/v2/create'
                && (int) $request['app_id'] === 2554
                && (int) $request['amount'] === 300000
                && $request['app_trans_id'] === $hoaDon->MaGiaoDich
                && ! empty($request['mac']);
        });
    }

    public function test_zalopay_return_queries_order_and_marks_invoice_paid(): void
    {
        Http::preventStrayRequests();
        Http::fake([
            'https://sb-openapi.zalopay.vn/v2/query' => Http::response([
                'return_code' => 1,
                'return_message' => 'Thanh toán thành công',
                'is_processing' => false,
                'amount' => 200000,
                'zp_trans_id' => '261123000001234',
            ], 200),
        ]);

        [, $khachHang] = $this->createCustomerAccount('nguyenvanb', '0987654321');

        $phieu = PhieuDatSan::create([
            'MaKH' => $khachHang->MaKH,
            'NgayDat' => now()->addDay()->toDateString(),
            'TongTien' => 200000,
            'TrangThai' => 'da_dat',
        ]);

        $hoaDon = HoaDon::create([
            'MaDatSan' => $phieu->MaDatSan,
            'NgayLap' => now()->toDateString(),
            'TongTien' => 200000,
            'TenPhuongThuc' => 'zalopay',
            'TrangThai' => 'chua_thanh_toan',
            'MaGiaoDich' => '261123_1_123456',
        ]);

        $response = $this->get(route('zalopay.return', [
            'apptransid' => '261123_1_123456',
            'status' => 1,
        ]));

        $response->assertRedirect(route('booking'))
            ->assertSessionHas('success');

        $hoaDon->refresh();
        $this->assertSame('da_thanh_toan', $hoaDon->TrangThai);
        $this->assertStringContainsString('261123000001234', (string) $hoaDon->GhiChu);
    }

    public function test_zalopay_callback_verifies_mac_and_marks_invoice_paid(): void
    {
        [, $khachHang] = $this->createCustomerAccount('nguyenvanc', '0901112222');

        $phieu = PhieuDatSan::create([
            'MaKH' => $khachHang->MaKH,
            'NgayDat' => now()->addDay()->toDateString(),
            'TongTien' => 150000,
            'TrangThai' => 'da_dat',
        ]);

        $hoaDon = HoaDon::create([
            'MaDatSan' => $phieu->MaDatSan,
            'NgayLap' => now()->toDateString(),
            'TongTien' => 150000,
            'TenPhuongThuc' => 'zalopay',
            'TrangThai' => 'chua_thanh_toan',
            'MaGiaoDich' => '261123_2_654321',
        ]);

        $dataStr = json_encode([
            'app_id' => 2554,
            'app_trans_id' => '261123_2_654321',
            'zp_trans_id' => '261123000009999',
            'amount' => 150000,
        ]);

        $invalidResponse = $this->postJson(route('zalopay.callback'), [
            'data' => $dataStr,
            'mac' => 'invalid_mac',
        ]);

        $invalidResponse->assertOk()->assertJson(['return_code' => -1]);
        $this->assertSame('chua_thanh_toan', $hoaDon->fresh()->TrangThai);

        $validMac = hash_hmac('sha256', $dataStr, 'trMrHtvjo6myautxDUiAcYsVtaeQ8nhf');
        $validResponse = $this->postJson(route('zalopay.callback'), [
            'data' => $dataStr,
            'mac' => $validMac,
        ]);

        $validResponse->assertOk()->assertJson(['return_code' => 1]);
        $this->assertSame('da_thanh_toan', $hoaDon->fresh()->TrangThai);
    }

    public function test_authenticated_owner_can_pay_existing_booking_via_zalopay(): void
    {
        Http::preventStrayRequests();
        Http::fake([
            'https://sb-openapi.zalopay.vn/v2/create' => Http::response([
                'return_code' => 1,
                'return_message' => 'OK',
                'order_url' => 'https://sbgateway.zalopay.vn/openinapp?order=owner_order',
            ], 200),
        ]);

        [$taiKhoan, $khachHang] = $this->createCustomerAccount('nguyenvand', '0909998888');

        $phieu = PhieuDatSan::create([
            'MaKH' => $khachHang->MaKH,
            'NgayDat' => now()->addDay()->toDateString(),
            'TongTien' => 250000,
            'TrangThai' => 'da_dat',
        ]);

        HoaDon::create([
            'MaDatSan' => $phieu->MaDatSan,
            'NgayLap' => now()->toDateString(),
            'TongTien' => 250000,
            'TenPhuongThuc' => 'tai_san',
            'TrangThai' => 'chua_thanh_toan',
        ]);

        $response = $this->actingAs($taiKhoan)->post(route('zalopay.pay', $phieu->MaDatSan));

        $response->assertRedirect('https://sbgateway.zalopay.vn/openinapp?order=owner_order');
    }
}
