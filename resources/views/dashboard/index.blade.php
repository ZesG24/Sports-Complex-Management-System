<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Hồ sơ người dùng & Quản lý đặt sân - Thể thao Anh Vinh</title>

    <!-- Google Fonts: Plus Jakarta Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Material Symbols Outlined -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />

    <!-- Tailwind CSS Play CDN -->
    <script src="https://cdn.tailwindcss.com?plugins=forms"></script>
    <script>
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "primary": "#158f68",
                        "primary-hover": "#0d7654",
                        "primary-light": "#e6f5ef",
                        "accent-lime": "#d8f46e",
                        "ink": "#17231f",
                        "muted": "#71807a",
                        "cream": "#f7f9f4",
                        "line": "#e4eae5"
                    },
                    fontFamily: {
                        sans: ['"Plus Jakarta Sans"', 'sans-serif'],
                    }
                }
            }
        }
    </script>
    <style>
        .material-symbols-outlined {
            font-family: 'Material Symbols Outlined';
            font-weight: normal;
            font-style: normal;
            font-size: 20px;
            line-height: 1;
            display: inline-block;
            vertical-align: middle;
        }
    </style>
</head>
<body class="bg-cream text-ink font-sans antialiased min-h-screen flex flex-col selection:bg-accent-lime selection:text-ink">

    <!-- Header đồng bộ -->
    @include('partials.header')

    <!-- ================= MAIN DASHBOARD CONTAINER ================= -->
    <main class="flex-grow max-w-7xl w-full mx-auto px-4 sm:px-6 lg:px-8 py-8 pb-20">

        <!-- Breadcrumb -->
        <nav class="flex items-center gap-2 text-xs text-muted mb-6">
            <a href="{{ route('home') }}" class="hover:text-primary transition-colors flex items-center gap-1">
                <span class="material-symbols-outlined text-[15px]">home</span> Trang chủ
            </a>
            <span>/</span>
            <span class="text-ink font-bold">Hồ sơ người dùng & Quản lý đặt sân</span>
        </nav>

        <!-- 1. USER OVERVIEW BANNER (KHÔNG CÓ THẺ HỘI VIÊN) -->
        <section class="bg-white rounded-3xl border border-line p-6 sm:p-8 shadow-sm mb-8">
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-6 pb-6 border-b border-line">
                <!-- User Basic Profile -->
                <div class="flex items-center gap-4 sm:gap-5">
                    <div class="relative">
                        <div class="w-16 h-16 sm:w-20 sm:h-20 rounded-2xl bg-accent-lime text-ink font-extrabold text-2xl sm:text-3xl flex items-center justify-center shadow-sm">
                            {{ strtoupper(substr($user->TenDangNhap, 0, 1)) }}
                        </div>
                        <span class="absolute -bottom-1 -right-1 w-5 h-5 rounded-full bg-emerald-500 border-2 border-white flex items-center justify-center" title="Đang trực tuyến">
                            <span class="w-2 h-2 rounded-full bg-white animate-pulse"></span>
                        </span>
                    </div>

                    <div>
                        <div class="flex flex-wrap items-center gap-2.5">
                            <h1 class="text-xl sm:text-2xl font-extrabold text-ink tracking-tight">
                                {{ $khachHang->HoTen ?? $user->TenDangNhap }}
                            </h1>
                            <span class="px-2.5 py-0.5 rounded-full {{ $khachHang?->hangThanhVien ? 'bg-amber-100 text-amber-800 border border-amber-300' : 'bg-primary-light text-primary' }} text-xs font-bold uppercase tracking-wider">
                                {{ $user->ten_hang_thanh_vien }}
                            </span>
                        </div>
                        <p class="text-xs sm:text-sm text-muted mt-1 flex flex-wrap items-center gap-3">
                            <span>@ {{ $user->TenDangNhap }}</span>
                            <span class="text-line">•</span>
                            <span class="flex items-center gap-1">
                                <span class="material-symbols-outlined text-[15px] text-muted">call</span>
                                {{ $khachHang->SDT ?? 'Chưa cập nhật SĐT' }}
                            </span>
                            <span class="text-line">•</span>
                            <span class="flex items-center gap-1">
                                <span class="material-symbols-outlined text-[15px] text-muted">mail</span>
                                {{ $khachHang->Email ?? 'Chưa cập nhật email' }}
                            </span>
                        </p>
                    </div>
                </div>
            </div>

            <!-- 4 Thẻ chỉ số tổng quan (Metric Stats) -->
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 pt-6">
                <div class="bg-cream/60 rounded-2xl p-4 border border-line">
                    <div class="flex items-center justify-between text-muted mb-2">
                        <span class="text-xs font-bold uppercase tracking-wider">Tổng giờ chơi</span>
                        <span class="w-7 h-7 rounded-lg bg-emerald-100 text-primary flex items-center justify-center">
                            <span class="material-symbols-outlined text-[16px]">timer</span>
                        </span>
                    </div>
                    <div class="text-2xl font-extrabold text-ink">
                        {{ number_format($totalHoursPlayed, 1) }}<span class="text-xs font-normal text-muted ml-1">giờ</span>
                    </div>
                    <span class="text-[11px] text-muted mt-0.5 block">Thời gian vận động thể thao</span>
                </div>

                <div class="bg-cream/60 rounded-2xl p-4 border border-line">
                    <div class="flex items-center justify-between text-muted mb-2">
                        <span class="text-xs font-bold uppercase tracking-wider">Lượt đặt sân</span>
                        <span class="w-7 h-7 rounded-lg bg-emerald-100 text-primary flex items-center justify-center">
                            <span class="material-symbols-outlined text-[16px]">calendar_month</span>
                        </span>
                    </div>
                    <div class="text-2xl font-extrabold text-ink">
                        {{ $totalBookingsCount }}<span class="text-xs font-normal text-muted ml-1">phiếu</span>
                    </div>
                    <span class="text-[11px] text-muted mt-0.5 block">Đã ghi nhận trên hệ thống</span>
                </div>

                <div class="bg-cream/60 rounded-2xl p-4 border border-line">
                    <div class="flex items-center justify-between text-muted mb-2">
                        <span class="text-xs font-bold uppercase tracking-wider">Kèo ghép bạn</span>
                        <span class="w-7 h-7 rounded-lg bg-accent-lime/60 text-ink flex items-center justify-center">
                            <span class="material-symbols-outlined text-[16px]">groups</span>
                        </span>
                    </div>
                    <div class="text-2xl font-extrabold text-ink">
                        {{ $myMatchmakings->count() }}<span class="text-xs font-normal text-muted ml-1">kèo</span>
                    </div>
                    <span class="text-[11px] text-muted mt-0.5 block">Kèo giao lưu đã tạo</span>
                </div>

                <div class="bg-cream/60 rounded-2xl p-4 border border-line">
                    <div class="flex items-center justify-between text-muted mb-2">
                        <span class="text-xs font-bold uppercase tracking-wider">Tổng chi tiêu</span>
                        <span class="w-7 h-7 rounded-lg bg-emerald-100 text-primary flex items-center justify-center">
                            <span class="material-symbols-outlined text-[16px]">payments</span>
                        </span>
                    </div>
                    <div class="text-2xl font-extrabold text-primary">
                        {{ number_format($totalSpent, 0, ',', '.') }}<span class="text-xs font-normal text-muted ml-0.5">đ</span>
                    </div>
                    <span class="text-[11px] text-muted mt-0.5 block">Tổng phí thuê sân bãi</span>
                </div>
            </div>
        </section>

        <!-- 2. MAIN CONTENT GRID (TABS BÊN TRÁI & SIDEBAR BÊN PHẢI) -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">

            <!-- CỘT CHÍNH (8 CỘT): DANH SÁCH TABS & PHIẾU ĐẶT SÂN -->
            <div class="lg:col-span-8 space-y-6">

                <!-- Navigation Tabs Bar -->
                <div class="flex items-center gap-2 overflow-x-auto pb-2 scrollbar-none border-b border-line">
                    <button type="button" onclick="switchDashboardTab('upcoming')" id="tabBtnUpcoming" class="tab-btn px-4 py-2.5 rounded-full text-xs sm:text-sm font-bold transition-all flex items-center gap-2 bg-primary text-white shadow-sm">
                        <span class="material-symbols-outlined text-[18px]">event_available</span>
                        <span>Sắp tới</span>
                        <span class="px-2 py-0.5 rounded-full bg-white/20 text-white text-[10px] font-extrabold">{{ $upcomingBookings->count() }}</span>
                    </button>

                    <button type="button" onclick="switchDashboardTab('past')" id="tabBtnPast" class="tab-btn px-4 py-2.5 rounded-full text-xs sm:text-sm font-bold transition-all flex items-center gap-2 bg-white text-muted hover:text-ink border border-line">
                        <span class="material-symbols-outlined text-[18px]">history</span>
                        <span>Lịch sử đặt sân</span>
                        <span class="px-2 py-0.5 rounded-full bg-cream text-muted text-[10px] font-extrabold">{{ $pastBookings->count() }}</span>
                    </button>

                    <button type="button" onclick="switchDashboardTab('matchmaking')" id="tabBtnMatchmaking" class="tab-btn px-4 py-2.5 rounded-full text-xs sm:text-sm font-bold transition-all flex items-center gap-2 bg-white text-muted hover:text-ink border border-line">
                        <span class="material-symbols-outlined text-[18px]">sports_tennis</span>
                        <span>Kèo ghép bạn chơi</span>
                        <span class="px-2 py-0.5 rounded-full bg-cream text-muted text-[10px] font-extrabold">{{ $myMatchmakings->count() }}</span>
                    </button>
                </div>

                <!-- ================= TAB 1: SẮP TỚI (UPCOMING) ================= -->
                <div id="tabContentUpcoming" class="space-y-4">
                    @forelse($upcomingBookings as $booking)
                        <div class="bg-white rounded-2xl border border-line p-5 shadow-sm hover:border-primary/40 transition-all">
                            <!-- Card Header: Mã phiếu & Trạng thái -->
                            <div class="flex flex-wrap items-center justify-between gap-3 pb-4 border-b border-line">
                                <div class="flex items-center gap-2.5">
                                    <span class="w-8 h-8 rounded-lg bg-primary-light text-primary flex items-center justify-center font-bold text-xs">
                                        #{{ $booking->MaDatSan }}
                                    </span>
                                    <div>
                                        <span class="text-xs font-bold text-ink block">Phiếu đặt #BK-{{ str_pad($booking->MaDatSan, 5, '0', STR_PAD_LEFT) }}</span>
                                        <span class="text-[11px] text-muted">Đặt lúc {{ $booking->created_at ? $booking->created_at->format('H:i - d/m/Y') : '' }}</span>
                                    </div>
                                </div>

                                <div class="flex flex-wrap items-center gap-2">
                                    <!-- Trạng thái sân bãi -->
                                    @if(in_array($booking->TrangThai, ['da_dat', 'cho_xac_nhan', 'DaXacNhan']))
                                        <span class="px-3 py-1 rounded-full bg-emerald-50 text-emerald-800 border border-emerald-300 text-xs font-bold flex items-center gap-1">
                                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-600"></span> Đã đặt sân
                                        </span>
                                    @elseif($booking->TrangThai === 'dang_thi_dau')
                                        <span class="px-3 py-1 rounded-full bg-blue-50 text-blue-800 border border-blue-300 text-xs font-bold flex items-center gap-1">
                                            <span class="w-1.5 h-1.5 rounded-full bg-blue-600 animate-pulse"></span> Đang thi đấu
                                        </span>
                                    @elseif($booking->TrangThai === 'hoan_thanh')
                                        <span class="px-3 py-1 rounded-full bg-gray-100 text-gray-700 border border-gray-300 text-xs font-bold">
                                            Đã hoàn tất
                                        </span>
                                    @else
                                        <span class="px-3 py-1 rounded-full bg-cream text-muted border border-line text-xs font-bold">
                                            {{ $booking->TrangThai }}
                                        </span>
                                    @endif

                                    <!-- Trạng thái thanh toán hóa đơn -->
                                    @if($booking->hoaDon && $booking->hoaDon->TrangThai === 'da_thanh_toan')
                                        <span class="px-2.5 py-1 rounded-full bg-emerald-100 text-emerald-900 text-xs font-extrabold flex items-center gap-1">
                                            <span class="material-symbols-outlined text-[14px]">check_circle</span> Đã thanh toán
                                        </span>
                                    @else
                                        <span class="px-2.5 py-1 rounded-full bg-amber-100 text-amber-900 text-xs font-extrabold flex items-center gap-1">
                                            <span class="material-symbols-outlined text-[14px]">schedule</span> Thanh toán tại sân
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <!-- Court Items List -->
                            <div class="py-4 space-y-3">
                                @foreach($booking->chiTiet as $item)
                                    <div class="flex items-start justify-between gap-4 p-3 bg-cream/40 rounded-xl border border-line/60">
                                        <div class="flex items-start gap-3">
                                            <div class="w-10 h-10 rounded-xl bg-accent-lime text-ink flex items-center justify-center font-bold flex-shrink-0 text-sm">
                                                @if(str_contains(strtolower($item->san?->loaiSan?->TenLoai ?? ''), 'bóng đá')) ⚽
                                                @elseif(str_contains(strtolower($item->san?->loaiSan?->TenLoai ?? ''), 'cầu lông')) 🏸
                                                @else 🏓
                                                @endif
                                            </div>
                                            <div>
                                                <h4 class="text-sm font-bold text-ink">
                                                    {{ $item->san?->TenSan ?? 'Sân thi đấu' }}
                                                    <span class="text-xs font-normal text-muted">({{ $item->san?->loaiSan?->TenLoai ?? '' }})</span>
                                                </h4>
                                                <div class="flex items-center gap-3 text-xs text-muted mt-1">
                                                    <span class="flex items-center gap-1 text-ink font-semibold">
                                                        <span class="material-symbols-outlined text-[15px] text-primary">schedule</span>
                                                        {{ substr($item->GioBatDau, 0, 5) }} - {{ substr($item->GioKetThuc, 0, 5) }}
                                                    </span>
                                                    <span>•</span>
                                                    <span class="flex items-center gap-1">
                                                        <span class="material-symbols-outlined text-[15px] text-muted">calendar_today</span>
                                                        {{ $booking->NgayDat ? $booking->NgayDat->format('d/m/Y') : '' }}
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="text-right">
                                            <span class="text-xs font-extrabold text-primary block">{{ number_format($item->DonGia, 0, ',', '.') }}đ</span>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <!-- Card Footer: Tổng tiền & Nút xem QR Check-in -->
                            <div class="pt-3 border-t border-line flex flex-wrap items-center justify-between gap-3">
                                <div>
                                    <span class="text-[11px] text-muted block">Tổng thanh toán:</span>
                                    <span class="text-base font-extrabold text-primary">{{ number_format($booking->TongTien, 0, ',', '.') }}đ</span>
                                </div>

                                <div class="flex items-center gap-2">
                                    <button type="button" onclick="openQrModal('{{ $booking->MaDatSan }}', 'BK-{{ str_pad($booking->MaDatSan, 5, '0', STR_PAD_LEFT) }}', '{{ $booking->NgayDat ? $booking->NgayDat->format('d/m/Y') : '' }}')" class="inline-flex items-center gap-1.5 px-4 py-2 rounded-full bg-primary-light hover:bg-primary/20 text-primary text-xs font-bold transition-all">
                                        <span class="material-symbols-outlined text-[17px]">qr_code_2</span>
                                        <span>Mã QR Check-in</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-16 bg-white rounded-2xl border border-line p-8">
                            <span class="w-14 h-14 rounded-full bg-primary-light text-primary flex items-center justify-center mx-auto mb-3">
                                <span class="material-symbols-outlined text-3xl">event_busy</span>
                            </span>
                            <h3 class="text-base font-bold text-ink">Bạn chưa có lịch đặt sân nào sắp tới</h3>
                            <p class="text-xs text-muted max-w-sm mx-auto mt-1 mb-5">Khám phá hệ thống sân bãi hiện đại và đặt lịch nhanh chóng chỉ trong vài thao tác.</p>
                            <a href="{{ route('booking') }}" class="inline-flex items-center gap-2 px-5 py-2.5 rounded-full bg-primary hover:bg-primary-hover text-white text-xs sm:text-sm font-bold shadow-sm transition-all">
                                <span class="material-symbols-outlined text-[18px]">add_circle</span>
                                <span>Đặt sân ngay bây giờ</span>
                            </a>
                        </div>
                    @endforelse
                </div>

                <!-- ================= TAB 2: LỊCH SỬ ĐÃ QUA (PAST) ================= -->
                <div id="tabContentPast" class="space-y-4 hidden">
                    @forelse($pastBookings as $booking)
                        <div class="bg-white rounded-2xl border border-line p-5 shadow-sm opacity-90 hover:opacity-100 transition-opacity">
                            <div class="flex items-center justify-between pb-3 border-b border-line">
                                <div class="flex items-center gap-2">
                                    <span class="text-xs font-bold text-ink">Phiếu #BK-{{ str_pad($booking->MaDatSan, 5, '0', STR_PAD_LEFT) }}</span>
                                    <span class="text-[11px] text-muted">• {{ $booking->NgayDat ? $booking->NgayDat->format('d/m/Y') : '' }}</span>
                                </div>
                                <span class="text-xs font-bold {{ $booking->TrangThai === 'DaHuy' ? 'text-red-600' : 'text-muted' }}">
                                    {{ $booking->TrangThai === 'DaHuy' ? 'Đã hủy' : 'Đã hoàn tất' }}
                                </span>
                            </div>
                            <div class="py-3 text-xs text-muted space-y-1">
                                @foreach($booking->chiTiet as $item)
                                    <div class="flex justify-between">
                                        <span>{{ $item->san?->TenSan ?? 'Sân' }} ({{ substr($item->GioBatDau, 0, 5) }} - {{ substr($item->GioKetThuc, 0, 5) }})</span>
                                        <span class="font-semibold text-ink">{{ number_format($item->DonGia, 0, ',', '.') }}đ</span>
                                    </div>
                                @endforeach
                            </div>
                            <div class="pt-2 border-t border-line flex justify-between items-center text-xs">
                                <span class="text-muted">Tổng cộng:</span>
                                <span class="font-extrabold text-ink text-sm">{{ number_format($booking->TongTien, 0, ',', '.') }}đ</span>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-12 bg-white rounded-2xl border border-line text-muted text-xs">
                            Chưa có dữ liệu lịch sử đặt sân trước đó.
                        </div>
                    @endforelse
                </div>

                <!-- ================= TAB 3: KÈO GHÉP BẠN CHƠI ================= -->
                <div id="tabContentMatchmaking" class="space-y-4 hidden">
                    @forelse($myMatchmakings as $match)
                        <div class="bg-white rounded-2xl border border-line p-5 shadow-sm">
                            <div class="flex items-start justify-between gap-4">
                                <div>
                                    <span class="px-2 py-0.5 rounded-full bg-accent-lime text-ink text-[10px] font-extrabold uppercase mb-1.5 inline-block">
                                        {{ $match->loaiSan?->TenLoai ?? 'Thể thao' }}
                                    </span>
                                    <h4 class="text-sm font-bold text-ink">{{ $match->TieuDe }}</h4>
                                    <p class="text-xs text-muted mt-1">{{ $match->NoiDung }}</p>
                                    <div class="flex items-center gap-3 text-xs text-muted mt-2">
                                        <span>⏰ {{ $match->ThoiGianChoi ? $match->ThoiGianChoi->format('H:i - d/m/Y') : '' }}</span>
                                        <span>•</span>
                                        <span>Trình độ: <strong>{{ $match->TrinhDo }}</strong></span>
                                        <span>•</span>
                                        <span>Cần tìm: <strong>{{ $match->SoLuongHienTai }}/{{ $match->SoLuongCanTim }}</strong></span>
                                    </div>
                                </div>
                                <span class="px-2.5 py-1 rounded-full text-[11px] font-bold {{ $match->TrangThai === 'DangTim' ? 'bg-emerald-50 text-emerald-700 border border-emerald-300' : 'bg-cream text-muted' }}">
                                    {{ $match->TrangThai === 'DangTim' ? 'Đang tuyển' : 'Đã đủ' }}
                                </span>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-12 bg-white rounded-2xl border border-line text-muted text-xs">
                            Bạn chưa tạo bài đăng tìm bạn ghép kèo nào.
                        </div>
                    @endforelse
                </div>

            </div>

            <!-- CỘT PHỤ (4 CỘT): QUICK ACTIONS & GỢI Ý KÈO GIAO LƯU -->
            <aside class="lg:col-span-4 space-y-6">

                <!-- Thao tác nhanh -->
                <div class="bg-white rounded-2xl border border-line p-5 shadow-sm space-y-3">
                    <h3 class="text-xs font-extrabold uppercase tracking-wider text-muted">Thao tác nhanh</h3>
                    <a href="{{ route('booking') }}" class="w-full py-3 px-4 rounded-xl bg-primary hover:bg-primary-hover text-white text-xs sm:text-sm font-bold flex items-center justify-center gap-2 shadow-sm transition-all">
                        <span class="material-symbols-outlined text-[18px]">calendar_add_on</span>
                        <span>Đặt sân trực tuyến</span>
                    </a>
                    <a href="{{ route('home') }}#matchmaking" class="w-full py-3 px-4 rounded-xl bg-cream hover:bg-line text-ink text-xs sm:text-sm font-bold flex items-center justify-center gap-2 transition-all border border-line">
                        <span class="material-symbols-outlined text-[18px]">group_add</span>
                        <span>Tìm bạn chơi ghép kèo</span>
                    </a>
                </div>

                <!-- Gợi ý kèo giao lưu gần bạn -->
                <div class="bg-white rounded-2xl border border-line p-5 shadow-sm space-y-3">
                    <div class="flex items-center justify-between">
                        <h3 class="text-xs font-extrabold uppercase tracking-wider text-muted">Kèo ghép mới mở</h3>
                        <a href="{{ route('home') }}#matchmaking" class="text-xs font-bold text-primary hover:underline">Xem thêm</a>
                    </div>

                    @forelse($suggestedMatches as $match)
                        <div class="p-3 bg-cream/50 rounded-xl border border-line space-y-1.5 hover:border-primary/50 transition-colors">
                            <div class="flex items-center justify-between text-xs">
                                <span class="font-bold text-ink">{{ $match->loaiSan?->TenLoai ?? 'Bộ môn' }}</span>
                                <span class="text-primary font-bold">{{ $match->ChiPhiUocTinh ? number_format($match->ChiPhiUocTinh, 0, ',', '.') . 'đ' : 'Chia đều' }}</span>
                            </div>
                            <p class="text-xs text-muted line-clamp-1 font-medium">{{ $match->TieuDe }}</p>
                            <div class="flex items-center justify-between text-[11px] text-muted pt-1 border-t border-line/60">
                                <span>⏰ {{ $match->ThoiGianChoi ? $match->ThoiGianChoi->format('H:i - d/m') : '' }}</span>
                                <span class="font-bold text-ink">Thiếu {{ max(1, $match->SoLuongCanTim - $match->SoLuongHienTai) }}</span>
                            </div>
                        </div>
                    @empty
                        <p class="text-xs text-muted text-center py-4">Hiện chưa có kèo ghép nào đang mở.</p>
                    @endforelse
                </div>

                <!-- Thông tin hỗ trợ trực tiếp -->
                <div class="bg-primary-light/60 rounded-2xl border border-primary/20 p-5 text-xs text-ink space-y-2">
                    <div class="flex items-center gap-2 text-primary font-bold text-sm">
                        <span class="material-symbols-outlined text-[20px]">support_agent</span>
                        <span>Hotline hỗ trợ sân</span>
                    </div>
                    <p class="text-muted leading-relaxed">
                        Cần đổi lịch hoặc hỗ trợ gấp về phiếu đặt sân? Vui lòng liên hệ ban quản lý sân trước giờ bắt đầu:
                    </p>
                    <div class="font-extrabold text-sm text-primary flex items-center gap-1.5 pt-1">
                        <span class="material-symbols-outlined text-[16px]">call</span>
                        <span>0988 123 456 (05:00 - 23:00)</span>
                    </div>
                </div>

            </aside>
        </div>
    </main>

    <!-- Modal Phóng to mã QR Check-in -->
    <div id="qrModal" class="fixed inset-0 z-50 bg-black/60 backdrop-blur-xs hidden flex items-center justify-center p-4">
        <div class="bg-white rounded-3xl p-6 sm:p-8 max-w-sm w-full text-center shadow-2xl border border-line relative animate-in fade-in zoom-in duration-200">
            <button type="button" onclick="closeQrModal()" class="absolute top-4 right-4 w-8 h-8 rounded-full bg-cream hover:bg-line text-muted hover:text-ink flex items-center justify-center">
                <span class="material-symbols-outlined text-[18px]">close</span>
            </button>

            <span class="w-12 h-12 rounded-2xl bg-primary-light text-primary flex items-center justify-center mx-auto mb-3">
                <span class="material-symbols-outlined text-2xl">qr_code_scanner</span>
            </span>

            <h3 class="text-base font-extrabold text-ink" id="qrModalTitle">Mã QR Check-in</h3>
            <p class="text-xs text-muted mt-1 mb-5">Đưa mã này cho lễ tân tại quầy check-in sân</p>

            <!-- Simulated high-contrast QR box -->
            <div class="bg-cream p-5 rounded-2xl border border-line inline-block mx-auto mb-4">
                <div class="w-48 h-48 bg-white p-3 rounded-xl shadow-inner flex flex-col items-center justify-center border border-line">
                    <span class="material-symbols-outlined text-8xl text-ink">qr_code_2</span>
                    <span class="text-[11px] font-mono font-bold text-muted tracking-widest mt-1" id="qrModalCode">#BK-00000</span>
                </div>
            </div>

            <p class="text-[11px] text-muted">
                Ngày đặt: <strong id="qrModalDate">--/--/----</strong><br>
                Vui lòng có mặt trước giờ thi đấu 10 phút.
            </p>
        </div>
    </div>

    <!-- Footer đồng bộ -->
    @include('partials.footer')

    <!-- Tab switching & QR Modal Script -->
    <script>
        function switchDashboardTab(tabName) {
            const tabs = ['upcoming', 'past', 'matchmaking'];
            tabs.forEach(t => {
                const btn = document.getElementById('tabBtn' + t.charAt(0).toUpperCase() + t.slice(1));
                const content = document.getElementById('tabContent' + t.charAt(0).toUpperCase() + t.slice(1));

                if (t === tabName) {
                    btn.classList.add('bg-primary', 'text-white', 'shadow-sm');
                    btn.classList.remove('bg-white', 'text-muted', 'border');
                    content.classList.remove('hidden');
                } else {
                    btn.classList.remove('bg-primary', 'text-white', 'shadow-sm');
                    btn.classList.add('bg-white', 'text-muted', 'border');
                    content.classList.add('hidden');
                }
            });
        }

        function openQrModal(id, code, date) {
            document.getElementById('qrModalCode').textContent = '#' + code;
            document.getElementById('qrModalTitle').textContent = 'Mã Check-in ' + code;
            document.getElementById('qrModalDate').textContent = date;
            document.getElementById('qrModal').classList.remove('hidden');
        }

        function closeQrModal() {
            document.getElementById('qrModal').classList.add('hidden');
        }

        document.getElementById('qrModal')?.addEventListener('click', function(e) {
            if (e.target === this) {
                closeQrModal();
            }
        });
    </script>
</body>
</html>

