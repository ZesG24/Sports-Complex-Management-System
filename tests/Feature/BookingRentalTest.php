<?php

namespace Tests\Feature;

use App\Models\HoaDon;
use App\Models\KhachHang;
use App\Models\LoaiSan;
use App\Models\PhieuDatSan;
use App\Models\PhieuThue;
use App\Models\PhuKienThue;
use App\Models\San;
use App\Models\TaiKhoan;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BookingRentalTest extends TestCase
{
    use RefreshDatabase;

    public function test_booking_page_renders_with_rental_accessories(): void
    {
        $loaiSan = LoaiSan::create(['TenLoai' => 'Bóng đá']);
        PhuKienThue::create([
            'MaLoai' => $loaiSan->MaLoai,
            'TenPhuKien' => 'Giày bóng đá đinh dăm TF',
            'PhanLoai' => 'giay',
            'GiaThue' => 35000,
            'TongSoLuong' => 10,
            'SoLuongKhaDung' => 10,
            'TinhTrang' => 'hoat_dong',
        ]);

        $this->get(route('booking'))
            ->assertOk()
            ->assertSee('Thuê thêm phụ kiện đi kèm');
    }

    public function test_booking_with_rental_accessories_creates_rental_record_and_updates_invoice_and_stock(): void
    {
        $taiKhoan = TaiKhoan::create([
            'TenDangNhap' => 'rentaluser',
            'MatKhau' => bcrypt('password'),
            'LoaiTK' => 'user',
        ]);

        KhachHang::create([
            'MaTK' => $taiKhoan->MaTK,
            'HoTen' => 'Nguyen Van Rental',
            'SDT' => '0911222333',
            'Email' => 'rental@example.com',
        ]);

        $loaiSan = LoaiSan::create(['TenLoai' => 'Bóng đá']);
        $san = San::create([
            'TenSan' => 'Sân bóng đá 1',
            'MaLoai' => $loaiSan->MaLoai,
            'GiaThue' => 300000,
            'TinhTrang' => 'Hoạt động',
        ]);

        $giay = PhuKienThue::create([
            'MaLoai' => $loaiSan->MaLoai,
            'TenPhuKien' => 'Giày bóng đá đinh dăm TF',
            'PhanLoai' => 'giay',
            'GiaThue' => 35000,
            'TongSoLuong' => 10,
            'SoLuongKhaDung' => 10,
            'TinhTrang' => 'hoat_dong',
        ]);

        $response = $this->actingAs($taiKhoan)->postJson(route('booking.store'), [
            'NgayDat' => now()->addDay()->toDateString(),
            'HoTen' => 'Nguyen Van Rental',
            'SDT' => '0911222333',
            'PhuongThucThanhToan' => 'tai_san',
            'items' => [
                [
                    'MaSan' => $san->MaSan,
                    'GioBatDau' => '18:00',
                    'GioKetThuc' => '19:00',
                    'DonGia' => 300000,
                ],
            ],
            'rentals' => [
                [
                    'MaPKThue' => $giay->MaPKThue,
                    'SoLuong' => 2,
                    'GhiChu' => '1 đôi size 41, 1 đôi size 42',
                ],
            ],
        ]);

        $response->assertOk()
            ->assertJson([
                'success' => true,
                'total' => 370000,
            ]);

        $phieuDatSan = PhieuDatSan::firstOrFail();
        $this->assertEquals(300000.00, (float) $phieuDatSan->TongTien);

        $phieuThue = PhieuThue::with('phuKienThue')->firstOrFail();
        $this->assertSame($phieuDatSan->MaDatSan, $phieuThue->MaDatSan);
        $this->assertEquals(70000.00, (float) $phieuThue->TongTienThue);
        $this->assertSame('dat_truoc', $phieuThue->TrangThai);

        $attached = $phieuThue->phuKienThue->firstOrFail();
        $this->assertSame(2, (int) $attached->pivot->SoLuong);
        $this->assertSame('1 đôi size 41, 1 đôi size 42', $attached->pivot->GhiChu);

        $this->assertSame(8, $giay->fresh()->SoLuongKhaDung);

        $hoaDon = HoaDon::firstOrFail();
        $this->assertEquals(370000.00, (float) $hoaDon->TongTien);
    }

    public function test_booking_rejects_rental_exceeding_available_stock_and_rolls_back(): void
    {
        $taiKhoan = TaiKhoan::create([
            'TenDangNhap' => 'rentaluser2',
            'MatKhau' => bcrypt('password'),
            'LoaiTK' => 'user',
        ]);

        KhachHang::create([
            'MaTK' => $taiKhoan->MaTK,
            'HoTen' => 'Nguyen Van Rental 2',
            'SDT' => '0911222444',
            'Email' => 'rental2@example.com',
        ]);

        $loaiSan = LoaiSan::create(['TenLoai' => 'Cầu lông']);
        $san = San::create([
            'TenSan' => 'Sân cầu lông 1',
            'MaLoai' => $loaiSan->MaLoai,
            'GiaThue' => 200000,
            'TinhTrang' => 'Hoạt động',
        ]);

        $vot = PhuKienThue::create([
            'MaLoai' => $loaiSan->MaLoai,
            'TenPhuKien' => 'Vợt cầu lông Li-Ning Carbon',
            'PhanLoai' => 'vot',
            'GiaThue' => 40000,
            'TongSoLuong' => 2,
            'SoLuongKhaDung' => 1,
            'TinhTrang' => 'hoat_dong',
        ]);

        $response = $this->actingAs($taiKhoan)->postJson(route('booking.store'), [
            'NgayDat' => now()->addDay()->toDateString(),
            'HoTen' => 'Nguyen Van Rental',
            'SDT' => '0911222333',
            'PhuongThucThanhToan' => 'tai_san',
            'items' => [
                [
                    'MaSan' => $san->MaSan,
                    'GioBatDau' => '18:00',
                    'GioKetThuc' => '19:00',
                    'DonGia' => 200000,
                ],
            ],
            'rentals' => [
                [
                    'MaPKThue' => $vot->MaPKThue,
                    'SoLuong' => 3,
                    'GhiChu' => null,
                ],
            ],
        ]);

        $response->assertStatus(422)
            ->assertJson(['success' => false]);

        $this->assertSame(0, PhieuDatSan::count());
        $this->assertSame(0, PhieuThue::count());
        $this->assertSame(1, $vot->fresh()->SoLuongKhaDung);
    }
}
