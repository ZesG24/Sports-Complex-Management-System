<?php

namespace App\Http\Controllers;

use App\Models\BaiDangTimBan;
use App\Models\LoaiSan;
use App\Models\PhieuDatSan;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class DashboardController extends Controller
{
    /**
     * Hiển thị trang Dashboard / Hồ sơ người dùng
     */
    public function index(Request $request): View
    {
        $user = Auth::user();
        $khachHang = $user->khachHang()->with('hangThanhVien')->first();
        $loaiSanList = LoaiSan::withCount('san')->get();

        $upcomingBookings = collect();
        $pastBookings = collect();
        $myMatchmakings = collect();

        $totalHoursPlayed = 0;
        $totalBookingsCount = 0;
        $totalSpent = 0;
        $discountSaved = 0;

        if ($khachHang) {
            $allBookings = PhieuDatSan::with(['chiTiet.san.loaiSan', 'hoaDon'])
                ->where('MaKH', $khachHang->MaKH)
                ->orderBy('NgayDat', 'desc')
                ->get();

            $totalBookingsCount = $allBookings->count();
            $totalSpent = $allBookings->where('TrangThai', '!=', 'DaHuy')->sum('TongTien');

            // Tính tổng số giờ đã chơi & ước tính tiền tiết kiệm
            foreach ($allBookings as $booking) {
                if ($booking->TrangThai !== 'DaHuy') {
                    foreach ($booking->chiTiet as $item) {
                        try {
                            $start = Carbon::parse($item->GioBatDau);
                            $end = Carbon::parse($item->GioKetThuc);
                            $hours = max(0, $end->diffInMinutes($start) / 60);
                            $totalHoursPlayed += $hours;
                        } catch (\Throwable $e) {
                            // Bỏ qua lỗi format
                        }
                    }
                }
            }

            // Tiết kiệm theo % hạng thành viên nếu có
            if ($khachHang->hangThanhVien && (float) $khachHang->hangThanhVien->PhanTramGiamGia > 0) {
                $discountSaved = round($totalSpent * ((float) $khachHang->hangThanhVien->PhanTramGiamGia / 100));
            }

            $today = now()->toDateString();
            $upcomingBookings = $allBookings->filter(function ($b) use ($today) {
                $dateStr = $b->NgayDat ? $b->NgayDat->toDateString() : '';
                return $dateStr >= $today && $b->TrangThai !== 'DaHuy';
            })->values();

            $pastBookings = $allBookings->filter(function ($b) use ($today) {
                $dateStr = $b->NgayDat ? $b->NgayDat->toDateString() : '';
                return $dateStr < $today || $b->TrangThai === 'DaHuy';
            })->values();

            // Kèo ghép bạn đã tạo
            $myMatchmakings = BaiDangTimBan::with(['loaiSan'])
                ->where('MaKH', $khachHang->MaKH)
                ->latest()
                ->take(5)
                ->get();
        }

        // Gợi ý kèo giao lưu gần bạn
        $suggestedMatches = BaiDangTimBan::with(['loaiSan', 'nguoiDang'])
            ->where('TrangThai', 'DangTim')
            ->latest()
            ->take(3)
            ->get();

        return view('dashboard.index', compact(
            'user',
            'khachHang',
            'upcomingBookings',
            'pastBookings',
            'myMatchmakings',
            'suggestedMatches',
            'totalHoursPlayed',
            'totalBookingsCount',
            'totalSpent',
            'discountSaved',
            'loaiSanList'
        ));
    }
}
