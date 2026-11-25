<?php

namespace App\Http\Controllers;

use App\Models\ChiTietPhieuDatSan;
use App\Models\HangThanhVien;
use App\Models\HoaDon;
use App\Models\KhachHang;
use App\Models\LoaiSan;
use App\Models\LuotGiuCho;
use App\Models\PhieuDatSan;
use App\Models\PhieuThue;
use App\Models\PhuKienThue;
use App\Models\San;
use App\Services\ZaloPayService;
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
    public function __construct(public ZaloPayService $zaloPayService) {}

    /**
     * Kiểm tra sân có đang ở trạng thái bảo trì hay không
     */
    private function isCourtMaintenance(San $san): bool
    {
        $status = mb_strtolower(trim((string) ($san->TinhTrang ?? '')));

        return str_contains($status, 'bảo trì')
            || str_contains($status, 'baotri')
            || str_contains($status, 'bao_tri');
    }

    /**
     * Chuyển đổi giờ thành số phút theo chu kỳ hoạt động 05:00 sáng -> 03:00 khuya
     */
    private function toOperatingMinutes(string $timeStr): int
    {
        $parts = explode(':', $timeStr);
        $h = (int) $parts[0];
        $m = (int) ($parts[1] ?? 0);
        if ($h < 5) {
            $h += 24;
        }

        return $h * 60 + $m;
    }

    /**
     * Hiển thị giao diện đặt sân đa môn với quy tắc Anti-Orphan Gap & Giữ chỗ tạm thời
     */
    public function index(Request $request): View
    {
        $loaiSanList = LoaiSan::withCount('san')->get();
        $allSan = San::with('loaiSan')->orderBy('MaLoai')->orderBy('MaSan')->get();

        $selectedDate = $request->input('date', date('Y-m-d'));
        $sessionId = $request->session()->getId();

        // Tự động dọn dẹp các lượt giữ chỗ đã hết hạn
        LuotGiuCho::where('HetHanLuc', '<=', Carbon::now())->delete();

        // Lấy danh sách các ca đã đặt chính thức trong ngày
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

        // Lấy danh sách các ca đang được giữ chỗ tạm thời (Holding slots)
        $holdingSlots = LuotGiuCho::where('NgayDat', $selectedDate)
            ->where('HetHanLuc', '>', Carbon::now())
            ->get(['MaSan', 'GioBatDau', 'GioKetThuc', 'SessionId', 'HetHanLuc']);

        $holdingSlotsByCourt = $holdingSlots->groupBy('MaSan')->map(function ($items) use ($sessionId) {
            return $items->map(function ($item) use ($sessionId) {
                return [
                    'start' => substr((string) $item->GioBatDau, 0, 5),
                    'end' => substr((string) $item->GioKetThuc, 0, 5),
                    'is_mine' => ($item->SessionId === $sessionId),
                    'remaining_seconds' => max(0, Carbon::now()->diffInSeconds($item->HetHanLuc, false)),
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

        $phuKienThueList = PhuKienThue::with('loaiSan')
            ->where('TinhTrang', 'hoat_dong')
            ->where('SoLuongKhaDung', '>', 0)
            ->orderBy('MaLoai')
            ->orderBy('MaPKThue')
            ->get();

        $rentalAccessoriesData = $phuKienThueList->map(function (PhuKienThue $pk): array {
            return [
                'id' => $pk->MaPKThue,
                'sport_id' => $pk->MaLoai,
                'sport_name' => $pk->loaiSan?->TenLoai ?? 'Dùng chung',
                'name' => $pk->TenPhuKien,
                'category' => $pk->PhanLoai,
                'price' => (float) $pk->GiaThue,
                'stock' => (int) $pk->SoLuongKhaDung,
                'description' => $pk->MoTa,
            ];
        })->values();

        return view('booking.index', compact(
            'loaiSanList',
            'allSan',
            'bookedSlots',
            'bookedSlotsByCourt',
            'holdingSlotsByCourt',
            'selectedDate',
            'userKhachHang',
            'discountPercent',
            'phuKienThueList',
            'rentalAccessoriesData'
        ));
    }

    /**
     * API trả về các khung giờ đã đặt và đang giữ chỗ của một ngày cụ thể (để client AJAX check)
     */
    public function getBookedSlots(Request $request): JsonResponse
    {
        $date = $request->input('date', date('Y-m-d'));
        $sessionId = $request->session()->getId();

        // Dọn dẹp giữ chỗ hết hạn
        LuotGiuCho::where('HetHanLuc', '<=', Carbon::now())->delete();

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

        $holdingSlots = LuotGiuCho::where('NgayDat', $date)
            ->where('HetHanLuc', '>', Carbon::now())
            ->get(['MaSan', 'GioBatDau', 'GioKetThuc', 'SessionId', 'HetHanLuc']);

        $groupedHolds = $holdingSlots->groupBy('MaSan')->map(function ($items) use ($sessionId) {
            return $items->map(function ($item) use ($sessionId) {
                return [
                    'start' => substr((string) $item->GioBatDau, 0, 5),
                    'end' => substr((string) $item->GioKetThuc, 0, 5),
                    'is_mine' => ($item->SessionId === $sessionId),
                    'remaining_seconds' => max(0, Carbon::now()->diffInSeconds($item->HetHanLuc, false)),
                ];
            })->values();
        });

        return response()->json([
            'date' => $date,
            'booked_slots' => $grouped,
            'holding_slots' => $groupedHolds,
        ]);
    }

    /**
     * Giữ chỗ tạm thời trong 5 phút (TTL) - Giống hệ thống CGV / Vé máy bay
     */
    public function holdSlot(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'MaSan' => ['required', 'exists:san,MaSan'],
            'NgayDat' => ['required', 'date', 'after_or_equal:today'],
            'GioBatDau' => ['required', 'date_format:H:i'],
            'GioKetThuc' => ['required', 'date_format:H:i'],
        ]);

        $san = San::find($validated['MaSan']);
        if (! $san || $this->isCourtMaintenance($san)) {
            return response()->json([
                'success' => false,
                'message' => 'Sân đang bảo trì, không thể giữ chỗ.',
            ], 422);
        }

        $sessionId = $request->session()->getId();
        $reqStart = $this->toOperatingMinutes($validated['GioBatDau']);
        $reqEnd = $this->toOperatingMinutes($validated['GioKetThuc']);

        // Kiểm tra thời gian thực nếu là ngày hôm nay
        if ($validated['NgayDat'] === date('Y-m-d') && $reqStart <= $this->toOperatingMinutes(date('H:i'))) {
            return response()->json([
                'success' => false,
                'message' => 'Khung giờ này đã trôi qua so với thời gian hiện tại.',
            ], 422);
        }

        // Xóa các lượt giữ chỗ đã hết hạn
        LuotGiuCho::where('HetHanLuc', '<=', Carbon::now())->delete();

        // 1. Kiểm tra xem đã có người đặt chính thức chưa
        $existingBookings = ChiTietPhieuDatSan::where('MaSan', $validated['MaSan'])
            ->whereHas('phieuDatSan', function ($query) use ($validated) {
                $query->whereDate('NgayDat', $validated['NgayDat'])
                    ->whereNotIn('TrangThai', ['da_huy', 'huy']);
            })
            ->get(['GioBatDau', 'GioKetThuc']);

        foreach ($existingBookings as $eb) {
            $bStart = $this->toOperatingMinutes(substr((string) $eb->GioBatDau, 0, 5));
            $bEnd = $this->toOperatingMinutes(substr((string) $eb->GioKetThuc, 0, 5));
            if (max($reqStart, $bStart) < min($reqEnd, $bEnd)) {
                return response()->json([
                    'success' => false,
                    'message' => "Sân \"{$san->TenSan}\" đã có người đặt trong khung giờ {$validated['GioBatDau']} - {$validated['GioKetThuc']}.",
                ], 422);
            }
        }

        // 2. Kiểm tra xem có người khác đang giữ chỗ không
        $existingHolds = LuotGiuCho::where('MaSan', $validated['MaSan'])
            ->where('NgayDat', $validated['NgayDat'])
            ->where('HetHanLuc', '>', Carbon::now())
            ->get();

        foreach ($existingHolds as $hold) {
            $hStart = $this->toOperatingMinutes(substr((string) $hold->GioBatDau, 0, 5));
            $hEnd = $this->toOperatingMinutes(substr((string) $hold->GioKetThuc, 0, 5));

            if (max($reqStart, $hStart) < min($reqEnd, $hEnd)) {
                if ($hold->SessionId === $sessionId) {
                    // Của chính người này -> Gia hạn thêm 5 phút
                    $hold->update([
                        'HetHanLuc' => Carbon::now()->addMinutes(5),
                    ]);

                    return response()->json([
                        'success' => true,
                        'message' => 'Đã gia hạn giữ chỗ sân.',
                        'remaining_seconds' => 300,
                    ]);
                }

                $remain = max(0, Carbon::now()->diffInSeconds($hold->HetHanLuc, false));
                $remainMin = floor($remain / 60);
                $remainSec = $remain % 60;
                $remainStr = sprintf('%02d:%02d', $remainMin, $remainSec);

                return response()->json([
                    'success' => false,
                    'is_holding' => true,
                    'message' => "Sân \"{$san->TenSan}\" đang có khách khác giữ chỗ (còn {$remainStr}). Vui lòng chọn sân hoặc khung giờ khác!",
                ], 422);
            }
        }

        // Tạo lượt giữ chỗ mới có thời hạn 5 phút (300 giây)
        LuotGiuCho::create([
            'MaSan' => $validated['MaSan'],
            'NgayDat' => $validated['NgayDat'],
            'GioBatDau' => $validated['GioBatDau'],
            'GioKetThuc' => $validated['GioKetThuc'],
            'SessionId' => $sessionId,
            'MaKH' => Auth::check() ? Auth::user()->khachHang?->MaKH : null,
            'HetHanLuc' => Carbon::now()->addMinutes(5),
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Đã giữ chỗ sân tạm thời trong 5 phút.',
            'remaining_seconds' => 300,
        ]);
    }

    /**
     * Nhả giữ chỗ khi khách xóa sân khỏi phiếu đặt
     */
    public function releaseSlot(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'MaSan' => ['required', 'exists:san,MaSan'],
            'NgayDat' => ['required', 'date'],
            'GioBatDau' => ['required', 'date_format:H:i'],
            'GioKetThuc' => ['required', 'date_format:H:i'],
        ]);

        $sessionId = $request->session()->getId();

        LuotGiuCho::where('MaSan', $validated['MaSan'])
            ->where('NgayDat', $validated['NgayDat'])
            ->where('GioBatDau', $validated['GioBatDau'])
            ->where('GioKetThuc', $validated['GioKetThuc'])
            ->where('SessionId', $sessionId)
            ->delete();

        return response()->json([
            'success' => true,
            'message' => 'Đã nhả giữ chỗ thành công.',
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
            'PhuongThucThanhToan' => ['nullable', 'in:tai_san,zalopay'],
            'items' => ['required', 'array', 'min:1'],
            'items.*.MaSan' => ['required', 'exists:san,MaSan'],
            'items.*.GioBatDau' => ['required', 'date_format:H:i'],
            'items.*.GioKetThuc' => ['required', 'date_format:H:i', 'after:items.*.GioBatDau'],
            'items.*.DonGia' => ['required', 'numeric', 'min:0'],
            'rentals' => ['nullable', 'array'],
            'rentals.*.MaPKThue' => ['required', 'exists:phukienthue,MaPKThue'],
            'rentals.*.SoLuong' => ['required', 'integer', 'min:1'],
            'rentals.*.GhiChu' => ['nullable', 'string', 'max:255'],
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
                if ($this->isCourtMaintenance($san)) {
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

                // Kiểm tra xem khung giờ đặt có nằm trong quá khứ so với thời gian thực tế không
                $isBookingDateToday = $validated['NgayDat'] === date('Y-m-d');
                $currentOperatingMins = $toOperatingMinutes(date('H:i'));

                if ($isBookingDateToday && $reqStart <= $currentOperatingMins) {
                    DB::rollBack();

                    $msg = "Khung giờ {$item['GioBatDau']} của sân \"{$san->TenSan}\" đã trôi qua so với thời gian hiện tại.";
                    if ($request->wantsJson() || $request->ajax()) {
                        return response()->json([
                            'success' => false,
                            'message' => $msg,
                        ], 422);
                    }

                    return back()->withErrors(['general' => $msg])->withInput();
                }

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

            // Áp dụng giảm giá thành viên cho tiền sân nếu có
            if ($khachHang && $khachHang->MaHang) {
                $hang = HangThanhVien::find($khachHang->MaHang);
                if ($hang && $hang->PhanTramGiamGia > 0) {
                    $tongTien = round($tongTien * (1 - ($hang->PhanTramGiamGia / 100)));
                }
            }

            // Xử lý phụ kiện thuê đi kèm (chỉ cho thuê kèm phiếu đặt sân)
            $tongTienThue = 0;
            $rentalsToAttach = [];
            $lockedAccessories = [];

            foreach ($validated['rentals'] ?? [] as $rental) {
                $maPK = (int) $rental['MaPKThue'];
                $qty = (int) $rental['SoLuong'];

                if ($qty <= 0) {
                    continue;
                }

                $phuKien = $lockedAccessories[$maPK] ?? PhuKienThue::where('MaPKThue', $maPK)->lockForUpdate()->first();
                if (! $phuKien || $phuKien->TinhTrang !== 'hoat_dong') {
                    DB::rollBack();

                    $msg = 'Phụ kiện bạn chọn hiện không còn cho thuê.';
                    if ($request->wantsJson() || $request->ajax()) {
                        return response()->json(['success' => false, 'message' => $msg], 422);
                    }

                    return back()->withErrors(['general' => $msg])->withInput();
                }

                $lockedAccessories[$maPK] = $phuKien;
                $alreadyRequested = $rentalsToAttach[$maPK]['SoLuong'] ?? 0;

                if ($phuKien->SoLuongKhaDung < ($alreadyRequested + $qty)) {
                    DB::rollBack();

                    $msg = "Phụ kiện \"{$phuKien->TenPhuKien}\" chỉ còn {$phuKien->SoLuongKhaDung} cái khả dụng.";
                    if ($request->wantsJson() || $request->ajax()) {
                        return response()->json(['success' => false, 'message' => $msg], 422);
                    }

                    return back()->withErrors(['general' => $msg])->withInput();
                }

                $donGiaThue = (float) $phuKien->GiaThue;
                $tongTienThue += round($donGiaThue * $qty);
                $note = isset($rental['GhiChu']) ? trim((string) $rental['GhiChu']) : null;

                if (isset($rentalsToAttach[$maPK])) {
                    $rentalsToAttach[$maPK]['SoLuong'] += $qty;
                    if ($note !== null && $note !== '') {
                        $rentalsToAttach[$maPK]['GhiChu'] = trim(($rentalsToAttach[$maPK]['GhiChu'] ? $rentalsToAttach[$maPK]['GhiChu'].'; ' : '').$note);
                    }
                } else {
                    $rentalsToAttach[$maPK] = [
                        'SoLuong' => $qty,
                        'DonGiaThue' => $donGiaThue,
                        'GhiChu' => $note !== '' ? $note : null,
                    ];
                }
            }

            $tongThanhToan = $tongTien + $tongTienThue;
            $paymentMethod = $validated['PhuongThucThanhToan'] ?? 'tai_san';

            // Tạo phiếu đặt sân
            $phieuDatSan = PhieuDatSan::create([
                'MaKH' => $khachHang->MaKH,
                'NgayDat' => $validated['NgayDat'],
                'TongTien' => $tongTien,
                'TrangThai' => 'da_dat',
                'GhiChu' => $validated['GhiChu'] ?? 'Đặt trực tuyến qua hệ thống Sports Complex',
            ]);

            // Tạo phiếu thuê phụ kiện gắn liền với phiếu đặt sân nếu khách có chọn thuê đồ
            if (! empty($rentalsToAttach)) {
                $phieuThue = PhieuThue::create([
                    'MaKH' => $khachHang->MaKH,
                    'MaDatSan' => $phieuDatSan->MaDatSan,
                    'TenKhachThue' => $khachHang->HoTen,
                    'SDTKhachThue' => $khachHang->SDT,
                    'NgayThue' => $validated['NgayDat'],
                    'TongTienThue' => $tongTienThue,
                    'TrangThai' => 'dat_truoc',
                    'GhiChu' => 'Thuê kèm phiếu đặt sân #MDS-'.$phieuDatSan->MaDatSan,
                ]);

                $phieuThue->phuKienThue()->attach($rentalsToAttach);

                foreach ($rentalsToAttach as $maPK => $pivotData) {
                    $lockedAccessories[$maPK]->decrement('SoLuongKhaDung', $pivotData['SoLuong']);
                }
            }

            // Tạo hóa đơn tương ứng với trạng thái chưa thanh toán (gộp tiền sân + tiền thuê phụ kiện)
            $hoaDonNote = $paymentMethod === 'zalopay'
                ? 'Hóa đơn khởi tạo chờ thanh toán ZaloPay'
                : 'Hóa đơn khởi tạo khi đặt sân trực tuyến';
            if ($tongTienThue > 0) {
                $hoaDonNote .= ' (đã bao gồm phụ kiện thuê)';
            }

            $hoaDon = HoaDon::create([
                'MaDatSan' => $phieuDatSan->MaDatSan,
                'NgayLap' => now()->toDateString(),
                'TongTien' => $tongThanhToan,
                'TenPhuongThuc' => $paymentMethod,
                'TrangThai' => 'chua_thanh_toan',
                'GhiChu' => $hoaDonNote,
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

            // Xóa các lượt giữ chỗ tạm thời của phiên này vì đã hoàn tất đặt sân
            $sessionId = $request->session()->getId();
            foreach ($itemsToCreate as $itemData) {
                LuotGiuCho::where('MaSan', $itemData['MaSan'])
                    ->where('NgayDat', $validated['NgayDat'])
                    ->where('GioBatDau', $itemData['GioBatDau'])
                    ->where('SessionId', $sessionId)
                    ->delete();
            }

            DB::commit();

            if ($paymentMethod === 'zalopay') {
                $zaloResult = $this->zaloPayService->createOrder($phieuDatSan, $hoaDon, route('zalopay.return'));

                if ($zaloResult['success'] && ! empty($zaloResult['order_url'])) {
                    $hoaDon->update(['MaGiaoDich' => $zaloResult['app_trans_id']]);

                    if ($request->wantsJson() || $request->ajax()) {
                        return response()->json([
                            'success' => true,
                            'message' => 'Đang chuyển đến cổng thanh toán ZaloPay...',
                            'booking_id' => $phieuDatSan->MaDatSan,
                            'total' => $tongThanhToan,
                            'payment_url' => $zaloResult['order_url'],
                        ]);
                    }

                    return redirect()->away($zaloResult['order_url']);
                }

                $zaloError = $zaloResult['sub_return_message'] ?: $zaloResult['return_message'];
                if ($request->wantsJson() || $request->ajax()) {
                    return response()->json([
                        'success' => true,
                        'message' => 'Đã tạo phiếu #MDS-'.$phieuDatSan->MaDatSan.' nhưng chưa mở được ZaloPay ('.$zaloError.'). Bạn có thể thanh toán lại trong Hồ sơ.',
                        'booking_id' => $phieuDatSan->MaDatSan,
                        'total' => $tongThanhToan,
                    ]);
                }

                return redirect()->route('booking')->with(
                    'error',
                    'Đã tạo phiếu #MDS-'.$phieuDatSan->MaDatSan.' nhưng không thể kết nối ZaloPay: '.$zaloError
                );
            }

            if ($request->wantsJson() || $request->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Đặt sân thành công! Mã phiếu: #MDS-'.$phieuDatSan->MaDatSan,
                    'booking_id' => $phieuDatSan->MaDatSan,
                    'total' => $tongThanhToan,
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
