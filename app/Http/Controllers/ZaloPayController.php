<?php

namespace App\Http\Controllers;

use App\Models\HoaDon;
use App\Models\PhieuDatSan;
use App\Services\ZaloPayService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ZaloPayController extends Controller
{
    public function __construct(public ZaloPayService $zaloPayService) {}

    /**
     * Khởi tạo giao dịch thanh toán ZaloPay cho một phiếu đặt sân chưa thanh toán.
     */
    public function pay(Request $request, int $maDatSan): RedirectResponse|JsonResponse
    {
        $phieuDatSan = PhieuDatSan::with(['chiTiet.san', 'hoaDon'])->findOrFail($maDatSan);

        $khachHang = Auth::user()?->khachHang;
        if (! $khachHang || (int) $phieuDatSan->MaKH !== (int) $khachHang->MaKH) {
            abort(403, 'Bạn không có quyền thanh toán phiếu đặt sân này.');
        }

        $hoaDon = $phieuDatSan->hoaDon;
        if (! $hoaDon) {
            $hoaDon = HoaDon::create([
                'MaDatSan' => $phieuDatSan->MaDatSan,
                'NgayLap' => now()->toDateString(),
                'TongTien' => $phieuDatSan->TongTien,
                'TenPhuongThuc' => 'zalopay',
                'TrangThai' => 'chua_thanh_toan',
                'GhiChu' => 'Hóa đơn khởi tạo khi thanh toán ZaloPay',
            ]);
        }

        if ($hoaDon->TrangThai === 'da_thanh_toan') {
            return redirect()->route('dashboard')->with('success', 'Phiếu đặt sân #MDS-'.$phieuDatSan->MaDatSan.' đã được thanh toán trước đó.');
        }

        $result = $this->zaloPayService->createOrder($phieuDatSan, $hoaDon, route('zalopay.return'));

        if (! $result['success'] || empty($result['order_url'])) {
            $errorMsg = 'Không thể khởi tạo thanh toán ZaloPay: '.($result['sub_return_message'] ?: $result['return_message']);

            if ($request->wantsJson() || $request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => $errorMsg,
                ], 422);
            }

            return redirect()->route('dashboard')->with('error', $errorMsg);
        }

        $hoaDon->update([
            'TenPhuongThuc' => 'zalopay',
            'MaGiaoDich' => $result['app_trans_id'],
        ]);

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json([
                'success' => true,
                'order_url' => $result['order_url'],
                'app_trans_id' => $result['app_trans_id'],
            ]);
        }

        return redirect()->away($result['order_url']);
    }

    /**
     * Xử lý điều hướng sau khi khách thanh toán xong trên cổng ZaloPay.
     * Chủ động gọi API /v2/query để xác nhận kết quả chính xác ngay cả khi chạy localhost không có ngrok.
     */
    public function handleReturn(Request $request): RedirectResponse
    {
        $redirectRoute = Auth::check() ? 'dashboard' : 'booking';
        $appTransId = (string) $request->query('apptransid', '');

        if ($appTransId === '') {
            return redirect()->route($redirectRoute)->with('error', 'Không tìm thấy mã giao dịch ZaloPay.');
        }

        $hoaDon = HoaDon::with('phieuDatSan')->where('MaGiaoDich', $appTransId)->first();
        if (! $hoaDon) {
            return redirect()->route($redirectRoute)->with('error', 'Không tìm thấy hóa đơn tương ứng với giao dịch '.$appTransId.'.');
        }

        if ($hoaDon->TrangThai === 'da_thanh_toan') {
            return redirect()->route($redirectRoute)->with(
                'success',
                'Thanh toán ZaloPay thành công cho phiếu đặt sân #MDS-'.$hoaDon->MaDatSan.'!'
            );
        }

        $queryResult = $this->zaloPayService->queryOrder($appTransId);

        if ($queryResult['return_code'] === 1) {
            $this->markInvoicePaid($hoaDon, $queryResult['zp_trans_id']);

            return redirect()->route($redirectRoute)->with(
                'success',
                'Thanh toán ZaloPay thành công cho phiếu đặt sân #MDS-'.$hoaDon->MaDatSan.' (Mã GD: '.$appTransId.').'
            );
        }

        if ($queryResult['return_code'] === 3 || $queryResult['is_processing']) {
            return redirect()->route($redirectRoute)->with(
                'error',
                'Giao dịch ZaloPay đang được xử lý. Vui lòng kiểm tra lại trạng thái sau ít phút.'
            );
        }

        return redirect()->route($redirectRoute)->with(
            'error',
            'Thanh toán ZaloPay chưa hoàn tất cho phiếu #MDS-'.$hoaDon->MaDatSan.'. Bạn có thể thử thanh toán lại trong Hồ sơ.'
        );
    }

    /**
     * Webhook Callback từ ZaloPay Server (khi có Public URL / ngrok / Production).
     */
    public function handleCallback(Request $request): JsonResponse
    {
        $dataStr = (string) $request->input('data', '');
        $requestMac = (string) $request->input('mac', '');

        if (! $this->zaloPayService->verifyCallback($dataStr, $requestMac)) {
            Log::warning('ZaloPay callback invalid MAC');

            return response()->json([
                'return_code' => -1,
                'return_message' => 'mac not equal',
            ]);
        }

        $data = json_decode($dataStr, true);
        if (! is_array($data) || empty($data['app_trans_id'])) {
            return response()->json([
                'return_code' => 0,
                'return_message' => 'invalid payload',
            ]);
        }

        $hoaDon = HoaDon::with('phieuDatSan')
            ->where('MaGiaoDich', (string) $data['app_trans_id'])
            ->first();

        if (! $hoaDon) {
            Log::warning('ZaloPay callback invoice not found', ['app_trans_id' => $data['app_trans_id']]);

            return response()->json([
                'return_code' => 0,
                'return_message' => 'invoice not found',
            ]);
        }

        if ($hoaDon->TrangThai !== 'da_thanh_toan') {
            $this->markInvoicePaid($hoaDon, isset($data['zp_trans_id']) ? (string) $data['zp_trans_id'] : null);
        }

        return response()->json([
            'return_code' => 1,
            'return_message' => 'success',
        ]);
    }

    /**
     * Cập nhật hóa đơn sang đã thanh toán.
     */
    private function markInvoicePaid(HoaDon $hoaDon, ?string $zpTransId = null): void
    {
        $note = 'Đã thanh toán qua ZaloPay';
        if ($zpTransId) {
            $note .= ' (ZP Trans ID: '.$zpTransId.')';
        }

        $hoaDon->update([
            'TenPhuongThuc' => 'zalopay',
            'TrangThai' => 'da_thanh_toan',
            'GhiChu' => $note,
        ]);

        if ($hoaDon->phieuDatSan && in_array($hoaDon->phieuDatSan->TrangThai, ['cho_xac_nhan', 'cho_thanh_toan'], true)) {
            $hoaDon->phieuDatSan->update(['TrangThai' => 'da_dat']);
        }
    }
}
