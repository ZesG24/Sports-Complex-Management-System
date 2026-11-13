<?php

namespace App\Http\Controllers;

use App\Models\ChiTietPhieuDatSan;
use App\Models\HangThanhVien;
use App\Models\KhachHang;
use App\Models\LoaiSan;
use App\Models\PhieuDatSan;
use App\Models\San;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

class BookingController extends Controller
{
    /**
     * Hiển thị giao diện đặt sân đa môn với quy tắc Anti-Orphan Gap
     */
    public function index(Request $request): View
    {
        $loaiSanList = LoaiSan::withCount('san')->get();
        $allSan = San::with('loaiSan')->orderBy('MaLoai')->orderBy('MaSan')->get();

        $selectedDate = $request->input('date', date('Y-m-d'));

        // Lấy danh sách các ca đã đặt trong ngày để kiểm tra trên timeline
        $bookedSlots = ChiTietPhieuDatSan::whereHas('phieuDatSan', function ($q) use ($selectedDate) {
            $q->where('NgayDat', $selectedDate)
                ->whereNotIn('TrangThai', ['da_huy', 'huy']);
        })->get(['MaSan', 'GioBatDau', 'GioKetThuc']);

        $bookedSlotsByCourt = $bookedSlots->groupBy('MaSan')->map(function ($items) {
            return $items->map(function ($item) {
                return [
                    'start' => substr((string) $item->GioBatDau, 0, 5),
                    'end' => substr((string) $item->GioKetThuc, 0, 5),
                ];
            })->values();
        });

        $userKhachHang = null;
        $discountPercent = 0;

        if (Auth::check()) {
            $userKhachHang = Auth::user()->khachHang;
            if ($userKhachHang && $userKhachHang->MaHang) {
                $hang = HangThanhVien::find($userKhachHang->MaHang);
                if ($hang) {
                    $discountPercent = (float) $hang->PhanTramGiamGia;
                }
            }
        }

        return view('booking', compact(
            'loaiSanList',
            'allSan',
            'bookedSlots',
            'bookedSlotsByCourt',
            'selectedDate',
            'userKhachHang',
            'discountPercent'
        ));
    }

    /**
     * API trả về các khung giờ đã đặt của một ngày cụ thể (để client AJAX check)
     */
    public function getBookedSlots(Request $request): JsonResponse
    {
        $date = $request->input('date', date('Y-m-d'));

        $bookedSlots = ChiTietPhieuDatSan::whereHas('phieuDatSan', function ($q) use ($date) {
            $q->where('NgayDat', $date)
                ->whereNotIn('TrangThai', ['da_huy', 'huy']);
        })->get(['MaSan', 'GioBatDau', 'GioKetThuc']);

        $grouped = $bookedSlots->groupBy('MaSan')->map(function ($items) {
            return $items->map(function ($item) {
                return [
                    'start' => substr((string) $item->GioBatDau, 0, 5),
                    'end' => substr((string) $item->GioKetThuc, 0, 5),
                ];
            })->values();
        });

        return response()->json([
            'date' => $date,
            'booked_slots' => $grouped,
        ]);
    }

    /**
     * Lưu phiếu đặt sân và chi tiết đặt sân vào cơ sở dữ liệu
     */
    public function store(Request $request): JsonResponse|RedirectResponse
    {
        $validated = $request->validate([
            'NgayDat' => ['required', 'date', 'after_or_equal:today'],
            'GhiChu' => ['nullable', 'string', 'max:500'],
            'HoTen' => ['required_without:user', 'nullable', 'string', 'max:255'],
            'SDT' => ['required_without:user', 'nullable', 'string', 'max:20'],
            'Email' => ['nullable', 'email', 'max:255'],
            'items' => ['required', 'array', 'min:1'],
            'items.*.MaSan' => ['required', 'exists:san,MaSan'],
            'items.*.GioBatDau' => ['required', 'date_format:H:i'],
            'items.*.GioKetThuc' => ['required', 'date_format:H:i', 'after:items.*.GioBatDau'],
            'items.*.DonGia' => ['required', 'numeric', 'min:0'],
        ], [
            'NgayDat.required' => 'Vui lòng chọn ngày đặt sân.',
            'NgayDat.after_or_equal' => 'Ngày đặt sân không thể ở quá khứ.',
            'items.required' => 'Phiếu đặt sân phải có ít nhất một sân.',
            'items.min' => 'Vui lòng chọn ít nhất một sân để đặt.',
            'HoTen.required_without' => 'Vui lòng nhập họ tên người đặt.',
            'SDT.required_without' => 'Vui lòng nhập số điện thoại liên hệ.',
        ]);

        DB::beginTransaction();

        try {
            // Xác định khách hàng
            $khachHang = null;

            if (Auth::check() && Auth::user()->khachHang) {
                $khachHang = Auth::user()->khachHang;
            } else {
                // Khách vãng lai: tìm theo SĐT hoặc tạo mới
                $sdt = $validated['SDT'] ?? ($request->user()?->TenDangNhap ?? '0900000000');
                $hoTen = $validated['HoTen'] ?? ($request->user()?->TenDangNhap ?? 'Khách vãng lai');
                $email = $validated['Email'] ?? null;

                $khachHang = KhachHang::firstOrCreate(
                    ['SDT' => $sdt],
                    [
                        'HoTen' => $hoTen,
                        'Email' => $email,
                    ]
                );
            }

            // Tính tổng tiền
            $tongTien = 0;
            $itemsToCreate = [];

            // Hàm đổi giờ sang số phút theo chu kỳ hoạt động 05:00 sáng -> 03:00 khuya
            $toOperatingMinutes = function (string $timeStr): int {
                $parts = explode(':', $timeStr);
                $h = (int) $parts[0];
                $m = (int) ($parts[1] ?? 0);
                if ($h < 5) {
                    $h += 24;
                }
                return $h * 60 + $m;
            };

            foreach ($validated['items'] as $item) {
                $san = San::find($item['MaSan']);
                if (! $san) {
                    continue;
                }

                // Kiểm tra tình trạng sân trong cơ sở dữ liệu
                if (mb_strtolower(trim($san->TinhTrang ?? '')) !== 'hoạt động') {
                    DB::rollBack();

                    $msg = "Sân \"{$san->TenSan}\" đang bảo trì, không thể đặt sân.";
                    if ($request->wantsJson() || $request->ajax()) {
                        return response()->json([
                            'success' => false,
                            'message' => $msg,
                        ], 422);
                    }

                    return back()->withErrors(['general' => $msg])->withInput();
                }

                $reqStart = $toOperatingMinutes($item['GioBatDau']);
                $reqEnd = $toOperatingMinutes($item['GioKetThuc']);

                // Lấy tất cả ca đã đặt của sân trong ngày để kiểm tra trùng giờ chính xác (bao gồm ca đêm)
                $existingBookings = ChiTietPhieuDatSan::where('MaSan', $item['MaSan'])
                    ->whereHas('phieuDatSan', function ($query) use ($validated) {
                        $query->whereDate('NgayDat', $validated['NgayDat'])
                            ->whereNotIn('TrangThai', ['da_huy', 'huy']);
                    })
                    ->get(['GioBatDau', 'GioKetThuc']);

                $hasOverlap = false;
                foreach ($existingBookings as $eb) {
                    $bStart = $toOperatingMinutes(substr((string) $eb->GioBatDau, 0, 5));
                    $bEnd = $toOperatingMinutes(substr((string) $eb->GioKetThuc, 0, 5));
                    if (max($reqStart, $bStart) < min($reqEnd, $bEnd)) {
                        $hasOverlap = true;
                        break;
                    }
                }

                if ($hasOverlap) {
                    DB::rollBack();

                    if ($request->wantsJson() || $request->ajax()) {
                        return response()->json([
                            'success' => false,
                            'message' => "Sân \"{$san->TenSan}\" đã có người đặt trong khung giờ {$item['GioBatDau']} - {$item['GioKetThuc']}. Vui lòng chọn khung giờ khác.",
                        ], 422);
                    }

                    return back()->withErrors([
                        'general' => "Sân \"{$san->TenSan}\" đã có người đặt trong khung giờ {$item['GioBatDau']} - {$item['GioKetThuc']}. Vui lòng chọn khung giờ khác.",
                    ])->withInput();
                }

                $startTime = Carbon::createFromFormat('H:i', $item['GioBatDau']);
                $endTime = Carbon::createFromFormat('H:i', $item['GioKetThuc']);
                if ($endTime->lessThanOrEqualTo($startTime)) {
                    $endTime = $endTime->copy()->addDay();
                }
                $durationHours = $startTime->floatDiffInHours($endTime);

                $donGia = (float) $item['DonGia'];
                $itemTotal = round($donGia * $durationHours);
                $tongTien += $itemTotal;

                $itemsToCreate[] = [
                    'MaSan' => $item['MaSan'],
                    'GioBatDau' => $item['GioBatDau'],
                    'GioKetThuc' => $item['GioKetThuc'],
                    'DonGia' => $donGia,
                ];
            }

            // Áp dụng giảm giá thành viên nếu có
            if ($khachHang && $khachHang->MaHang) {
                $hang = HangThanhVien::find($khachHang->MaHang);
                if ($hang && $hang->PhanTramGiamGia > 0) {
                    $tongTien = round($tongTien * (1 - ($hang->PhanTramGiamGia / 100)));
                }
            }

            // Tạo phiếu đặt sân
            $phieuDatSan = PhieuDatSan::create([
                'MaKH' => $khachHang->MaKH,
                'NgayDat' => $validated['NgayDat'],
                'TongTien' => $tongTien,
                'TrangThai' => 'cho_xac_nhan',
                'GhiChu' => $validated['GhiChu'] ?? 'Đặt trực tuyến qua hệ thống Sports Complex',
            ]);

            // Tạo chi tiết đặt sân
            foreach ($itemsToCreate as $itemData) {
                ChiTietPhieuDatSan::create([
                    'MaDatSan' => $phieuDatSan->MaDatSan,
                    'MaSan' => $itemData['MaSan'],
                    'GioBatDau' => $itemData['GioBatDau'],
                    'GioKetThuc' => $itemData['GioKetThuc'],
                    'DonGia' => $itemData['DonGia'],
                ]);
            }

            DB::commit();

            if ($request->wantsJson() || $request->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Đặt sân thành công! Mã phiếu: #MDS-'.$phieuDatSan->MaDatSan,
                    'booking_id' => $phieuDatSan->MaDatSan,
                    'total' => $tongTien,
                ]);
            }

            return redirect()->route('booking')->with(
                'success',
                'Đặt sân thành công! Mã phiếu của bạn là #MDS-'.$phieuDatSan->MaDatSan.'. Nhân viên sẽ liên hệ xác nhận.'
            );
        } catch (\Throwable $e) {
            DB::rollBack();
            Log::error('Lỗi lưu phiếu đặt sân: '.$e->getMessage());

            if ($request->wantsJson() || $request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Đã có lỗi xảy ra trong quá trình đặt sân: '.$e->getMessage(),
                ], 500);
            }

            return back()->withErrors(['general' => 'Đã có lỗi xảy ra khi lưu phiếu đặt: '.$e->getMessage()]);
        }
    }
}
