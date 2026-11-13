<!DOCTYPE html>
<html class="light" lang="vi">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Đặt Sân Thể Thao Đa Năng | Thể thao Anh Vinh</title>

    <!-- Material Symbols Outlined -->
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">
    <!-- Google Fonts: Plus Jakarta Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Tailwind CSS Play CDN -->
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <script>
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "primary": "#00694b",
                        "primary-hover": "#0d7654",
                        "primary-container": "#00855f",
                        "on-primary": "#ffffff",
                        "secondary": "#546500",
                        "secondary-container": "#d3ef69",
                        "on-secondary-fixed": "#171e00",
                        "background": "#f7f9f4",
                        "surface": "#effdf6",
                        "surface-container-lowest": "#ffffff",
                        "surface-container-low": "#e9f7f0",
                        "surface-container": "#e3f1ea",
                        "surface-bright": "#effdf6",
                        "on-surface": "#121e1a",
                        "on-surface-variant": "#3e4943",
                        "outline": "#6e7a72",
                        "outline-variant": "#bdcac1",
                        "error": "#ba1a1a"
                    },
                    fontFamily: {
                        sans: ['Plus Jakarta Sans', 'sans-serif'],
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
            letter-spacing: normal;
            text-transform: none;
            display: inline-block;
            white-space: nowrap;
            word-wrap: normal;
            direction: ltr;
            -webkit-font-smoothing: antialiased;
            vertical-align: middle;
        }
        .striped-pattern {
            background-image: repeating-linear-gradient(45deg, #e5e7eb, #e5e7eb 6px, #f3f4f6 6px, #f3f4f6 12px);
        }
    </style>
</head>
<body class="bg-[#f7f9f4] text-on-surface antialiased font-sans min-h-screen flex flex-col selection:bg-secondary-container selection:text-on-secondary-fixed">

    <!-- ================= 1. HEADER ================= -->
    <header class="sticky top-0 z-40 w-full bg-surface-container-lowest/95 backdrop-blur-md border-b border-outline-variant/30 shadow-sm transition-all duration-200">
        <div class="max-w-7xl mx-auto flex items-center justify-between px-4 sm:px-6 py-3.5">
            <!-- Brand Logo -->
            <div class="flex items-center gap-3">
                <a href="{{ route('home') }}" class="flex items-center gap-2.5 group">
                    <div class="w-10 h-10 rounded-xl bg-secondary-container flex items-center justify-center text-on-secondary-fixed font-black text-xl tracking-tight shadow-sm group-hover:scale-105 transition-transform duration-200">
                        AV
                    </div>
                    <div class="flex flex-col">
                        <span class="text-[17px] font-extrabold text-primary tracking-tight leading-tight">Thể thao Anh Vinh</span>
                        <span class="text-[9.5px] font-bold tracking-widest text-outline uppercase">KHU PHỨC HỢP THỂ THAO</span>
                    </div>
                </a>
            </div>

            <!-- Navigation Links -->
            <nav class="hidden md:flex items-center gap-8">
                <a href="{{ route('home') }}" class="text-on-surface-variant hover:text-primary transition-colors text-sm font-semibold">Trang chủ</a>
                <a href="{{ route('booking') }}" class="text-primary border-b-2 border-primary pb-1 text-sm font-bold flex items-center gap-1">Đặt Sân</a>
                <a href="{{ route('courts.index') }}" class="text-on-surface-variant hover:text-primary transition-colors text-sm font-semibold">Danh sách sân</a>
                <a href="{{ route('store') }}" class="text-on-surface-variant hover:text-primary transition-colors text-sm font-semibold">Cửa hàng</a>
            </nav>

            <!-- User Auth / Action -->
            <div class="flex items-center gap-3">
                @auth
                    <div class="flex items-center gap-2.5 pl-2.5 pr-3.5 py-1.5 bg-surface-container-lowest border border-outline-variant/50 rounded-full shadow-sm">
                        <div class="w-8 h-8 rounded-full bg-primary/10 text-primary font-bold flex items-center justify-center text-xs">
                            {{ strtoupper(substr(Auth::user()->TenDangNhap, 0, 1)) }}
                        </div>
                        <div class="flex flex-col text-left">
                            <div class="flex items-center gap-1.5">
                                <span class="text-xs font-bold text-on-surface">{{ Auth::user()->TenDangNhap }}</span>
                                <span class="{{ Auth::user()->khachHang?->hangThanhVien ? 'bg-amber-100 text-amber-900 border border-amber-300' : 'bg-secondary-container text-on-secondary-fixed' }} text-[9.5px] font-extrabold px-1.5 py-0.5 rounded-full uppercase">
                                    {{ Auth::user()->ten_hang_thanh_vien }}
                                </span>
                            </div>
                        </div>
                        <form action="{{ route('logout') }}" method="POST" class="inline m-0">
                            @csrf
                            <button type="submit" class="ml-1 text-outline hover:text-error transition-colors p-1" title="Đăng xuất">
                                <span class="material-symbols-outlined text-[18px]">logout</span>
                            </button>
                        </form>
                    </div>
                @else
                    <a href="{{ route('login') }}" class="text-sm font-bold text-on-surface hover:text-primary transition-colors px-3 py-1.5">Đăng nhập</a>
                    <a href="{{ route('register') }}" class="bg-primary hover:bg-primary-hover text-white text-xs font-bold px-4 py-2 rounded-full shadow-sm transition-all">Đăng ký</a>
                @endauth
            </div>
        </div>
    </header>

    @if (session('success'))
    <div class="max-w-7xl mx-auto px-4 sm:px-6 pt-4">
        <div class="bg-emerald-50 border border-emerald-300 text-emerald-900 px-4 py-3 rounded-2xl flex items-center justify-between shadow-sm">
            <div class="flex items-center gap-2">
                <span class="material-symbols-outlined text-emerald-600">check_circle</span>
                <span class="font-bold text-sm">{{ session('success') }}</span>
            </div>
            <button type="button" onclick="this.parentElement.remove()" class="text-emerald-700 hover:text-emerald-900">✕</button>
        </div>
    </div>
    @endif

    <!-- ================= 2. HERO & FILTER TOOLBAR ================= -->
    <main class="flex-grow max-w-7xl w-full mx-auto px-4 sm:px-6 py-6">
        <!-- Breadcrumb & Headline -->
        <section class="mb-6">
            <div class="flex items-center gap-2 text-xs text-outline mb-2">
                <a href="{{ route('home') }}" class="hover:text-primary transition-colors flex items-center gap-1">
                    <span class="material-symbols-outlined text-[15px]">home</span> Trang chủ
                </a>
                <span class="text-outline-variant">/</span>
                <span class="text-primary font-semibold">Đặt sân thể thao</span>
            </div>

            <div class="flex flex-col lg:flex-row lg:items-end justify-between gap-4">
                <div>
                    <h1 class="text-2xl sm:text-3xl lg:text-4xl font-extrabold text-on-surface tracking-tight">
                        Chọn sân. <span class="text-primary">Lên lịch chơi</span> nhiều môn linh hoạt.
                    </h1>
                    <p class="text-sm sm:text-base text-on-surface-variant mt-1.5 max-w-3xl leading-relaxed">
                        Đặt cùng lúc nhiều sân thuộc bóng đá, cầu lông, pickleball với các khung giờ khác nhau trong duy nhất 1 phiếu đặt tiện lợi.
                    </p>
                </div>
            </div>
        </section>

        <!-- Interactive Filter Toolbar Card -->
        <section class="bg-surface-container-lowest border border-outline-variant/40 rounded-2xl p-4 sm:p-5 shadow-sm mb-8">
            <div class="flex flex-col gap-4">
                <!-- Hàng 1: Bộ chọn Ngày + CHỈ CHỌN KHUNG GIỜ CHẴN (:00 & :30) + Bộ chọn thời lượng nhanh (Min 60' - Max 180') -->
                <div class="grid grid-cols-1 md:grid-cols-12 gap-3.5 items-end">
                    <!-- 1. Chọn ngày -->
                    <div class="md:col-span-3">
                        <label for="bookingDateInput" class="block text-[11px] font-bold text-outline uppercase tracking-wider mb-1">Ngày đặt sân</label>
                        <div class="relative">
                            <input type="date" id="bookingDateInput"
                                value="{{ $selectedDate ?? date('Y-m-d') }}"
                                min="{{ date('Y-m-d') }}"
                                class="w-full bg-[#f0f4f1] hover:bg-surface-container border border-outline-variant/40 px-3.5 py-2.5 rounded-xl text-xs sm:text-sm font-bold text-on-surface focus:ring-2 focus:ring-primary focus:bg-white transition-all cursor-pointer">
                        </div>
                    </div>

                    <!-- 2. Giờ bắt đầu mong muốn (CHỈ CHỌN KHUNG GIỜ CHẴN :00 & :30, TỰ ẨN GIỜ ĐÃ QUA) -->
                    <div class="md:col-span-3">
                        <div class="mb-1">
                            <label for="bookingStartTimeInput" class="block text-[11px] font-bold text-outline uppercase tracking-wider">Giờ bắt đầu dự kiến</label>
                        </div>
                        <div class="relative">
                            <select id="bookingStartTimeInput"
                                class="w-full appearance-none bg-[#f0f4f1] hover:bg-surface-container border border-outline-variant/40 pl-9 pr-8 py-2.5 rounded-xl text-xs sm:text-sm font-bold text-on-surface focus:ring-2 focus:ring-primary focus:bg-white transition-all cursor-pointer shadow-xs">
                                <!-- Dynamically populated via JS with :00 and :30 intervals only -->
                            </select>
                            <span class="material-symbols-outlined text-primary text-[18px] absolute left-2.5 top-1/2 -translate-y-1/2 pointer-events-none">schedule</span>
                            <span class="material-symbols-outlined text-outline text-[18px] absolute right-2.5 top-1/2 -translate-y-1/2 pointer-events-none">expand_more</span>
                        </div>
                    </div>

                    <!-- 3. Bộ chọn thời lượng chơi linh hoạt (Min 60p - Max 180p) -->
                    <div class="md:col-span-4">
                        <div class="flex items-center justify-between mb-1">
                            <label class="block text-[11px] font-bold text-outline uppercase tracking-wider">Thời lượng chơi</label>
                            <span class="text-[11px] font-semibold text-primary">Tối thiểu 60p • Tối đa 180p</span>
                        </div>
                        <div class="grid grid-cols-4 gap-1.5 p-1 bg-[#f0f4f1] rounded-xl border border-outline-variant/30" id="durationButtonGroup">
                            <button type="button" data-duration="60" class="duration-btn py-1.5 px-1 rounded-lg text-xs font-semibold text-on-surface hover:bg-white text-center transition-all">
                                60 phút
                            </button>
                            <button type="button" data-duration="90" class="duration-btn py-1.5 px-1 rounded-lg text-xs font-bold bg-primary text-white shadow-xs text-center">
                                90p (1.5h)
                            </button>
                            <button type="button" data-duration="120" class="duration-btn py-1.5 px-1 rounded-lg text-xs font-semibold text-on-surface hover:bg-white text-center transition-all">
                                120p (2h)
                            </button>
                            <button type="button" data-duration="180" class="duration-btn py-1.5 px-1 rounded-lg text-xs font-semibold text-on-surface hover:bg-white text-center transition-all">
                                180p (3h)
                            </button>
                        </div>
                    </div>

                    <!-- 4. Nút LỌC SÂN -->
                    <div class="md:col-span-2">
                        <button type="button" id="btnFilterApply" class="w-full bg-primary hover:bg-primary-hover active:scale-[0.98] text-white py-2.5 px-3 rounded-xl font-bold flex items-center justify-center gap-1.5 shadow-sm transition-all text-xs sm:text-sm">
                            <span class="material-symbols-outlined text-[18px]">filter_alt</span>
                            <span>Lọc sân</span>
                        </button>
                    </div>
                </div>

                <!-- Quy tắc đặt sân liền mạch Banner -->
                <div class="bg-gradient-to-r from-amber-50 via-emerald-50/50 to-surface-container-low border border-amber-200/80 rounded-xl p-3 flex items-center gap-2.5 text-xs sm:text-sm">
                    <div class="w-7 h-7 rounded-lg bg-amber-500 text-white flex items-center justify-center flex-shrink-0 shadow-xs">
                        <span class="material-symbols-outlined text-[17px]">lock_clock</span>
                    </div>
                    <div class="flex flex-col sm:flex-row sm:items-center gap-1 sm:gap-2 text-xs sm:text-[13px]">
                        <span class="font-bold text-amber-950 flex items-center gap-1">
                            Quy định đặt sân liên tục:
                        </span>
                        <span class="text-on-surface-variant">
                            Hệ thống tự động cảnh báo & gợi ý giờ liền kề khi lịch đặt để lại khoảng trống 30 phút lẻ (thời lượng thuê tối thiểu là 60 phút).
                        </span>
                    </div>
                </div>

                <!-- Hàng 3: Phân loại môn thể thao & tìm kiếm nhanh -->
                <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-3 pt-3 border-t border-outline-variant/30">
                    <div class="flex items-center gap-2 overflow-x-auto pb-1 lg:pb-0 scrollbar-none" id="sportFilters">
                        <button type="button" data-sport="all" class="sport-filter-btn bg-primary text-white px-4 py-1.5 rounded-full text-xs font-bold shadow-sm transition-all flex items-center gap-1.5 flex-shrink-0">
                            <span class="material-symbols-outlined text-[16px]">sports_score</span>
                            <span>Tất cả môn</span>
                            <span class="bg-primary-container text-white text-[11px] px-2 py-0.5 rounded-full font-bold ml-0.5">{{ count($allSan) }}</span>
                        </button>
                        <button type="button" data-sport="bong-da" class="sport-filter-btn bg-[#f0f4f1] hover:bg-surface-container border border-outline-variant/30 text-on-surface px-4 py-1.5 rounded-full text-xs font-semibold transition-all flex items-center gap-1.5 flex-shrink-0">
                            <span>⚽ Bóng đá</span>
                            <span class="bg-surface-container text-primary text-[11px] px-1.5 py-0.5 rounded-full font-bold">({{ $allSan->where('MaLoai', 1)->count() }} sân)</span>
                        </button>
                        <button type="button" data-sport="cau-long" class="sport-filter-btn bg-[#f0f4f1] hover:bg-surface-container border border-outline-variant/30 text-on-surface px-4 py-1.5 rounded-full text-xs font-semibold transition-all flex items-center gap-1.5 flex-shrink-0">
                            <span>🏸 Cầu lông</span>
                            <span class="bg-surface-container text-primary text-[11px] px-1.5 py-0.5 rounded-full font-bold">({{ $allSan->where('MaLoai', 2)->count() }} sân)</span>
                        </button>
                        <button type="button" data-sport="pickleball" class="sport-filter-btn bg-[#f0f4f1] hover:bg-surface-container border border-outline-variant/30 text-on-surface px-4 py-1.5 rounded-full text-xs font-semibold transition-all flex items-center gap-1.5 flex-shrink-0">
                            <span>🎾 Pickleball</span>
                            <span class="bg-surface-container text-primary text-[11px] px-1.5 py-0.5 rounded-full font-bold">({{ $allSan->where('MaLoai', 3)->count() }} sân)</span>
                        </button>
                    </div>

                    <!-- Ô tìm kiếm nhanh -->
                    <div class="relative flex-grow lg:flex-grow-0 lg:w-72">
                        <span class="material-symbols-outlined absolute left-3.5 top-1/2 -translate-y-1/2 text-outline text-[18px]">search</span>
                        <input type="text" id="courtSearchInput"
                            class="w-full bg-[#f0f4f1] border border-outline-variant/30 text-xs sm:text-sm pl-10 pr-3.5 py-1.5 rounded-full focus:ring-2 focus:ring-primary text-on-surface placeholder-outline focus:bg-white transition-all"
                            placeholder="Tìm nhanh tên sân, số sân...">
                    </div>
                </div>
            </div>
        </section>

        <!-- Message Filter status -->
        <div id="filterStatusAlert" class="hidden mb-4 p-3 bg-emerald-50 border border-emerald-200 rounded-xl text-xs sm:text-sm text-emerald-900 flex items-center justify-between">
            <span id="filterStatusText"></span>
            <button type="button" id="btnResetFilter" class="font-bold text-primary underline text-xs">Đặt lại bộ lọc</button>
        </div>

        <!-- ================= 3. TWO-COLUMN BOOKING WORKSPACE ================= -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-start">

            <!-- ================= LEFT COLUMN: AVAILABLE COURTS LIST (8 COLS) ================= -->
            <section class="lg:col-span-8 space-y-4" id="courtContainer">
                <!-- List Header Bar with Timeline Legend -->
                <div class="bg-surface-container-lowest px-4 py-3 rounded-xl border border-outline-variant/30 flex flex-col md:flex-row md:items-center justify-between gap-2.5">
                    <div class="flex items-center gap-2">
                        <span class="text-base font-extrabold text-on-surface">Danh sách sân đang sẵn sàng</span>
                        <span class="bg-surface-container text-primary font-bold text-xs px-2.5 py-0.5 rounded-full" id="visibleCourtCountBadge">
                            {{ count($allSan) }} sân phù hợp
                        </span>
                    </div>

                    <!-- Legend cho Timeline -->
                    <div class="flex items-center gap-3 text-[11px] font-semibold text-outline flex-wrap">
                        <div class="flex items-center gap-1.5">
                            <span class="w-3.5 h-3 rounded bg-gray-200 border border-gray-300 inline-block"></span>
                            <span>Giờ đã qua</span>
                        </div>
                        <div class="flex items-center gap-1.5">
                            <span class="w-3.5 h-3 rounded bg-gray-300 striped-pattern inline-block"></span>
                            <span>Đã có người đặt</span>
                        </div>
                        <div class="flex items-center gap-1.5">
                            <span class="w-3.5 h-3 rounded bg-primary inline-block"></span>
                            <span>Đang chọn / Đã thêm</span>
                        </div>
                        <div class="flex items-center gap-1.5">
                            <span class="w-3.5 h-3 rounded bg-emerald-50 border border-emerald-300 inline-block"></span>
                            <span>Sẵn sàng đặt</span>
                        </div>
                        <div class="flex items-center gap-1.5">
                            <span class="w-3.5 h-3 rounded bg-amber-200 border border-amber-400 inline-block"></span>
                            <span>Khoảng trống 30'</span>
                        </div>
                    </div>
                </div>

                <!-- ================= RENDER TẤT CẢ SÂN TỪ DATABASE ================= -->
                @foreach ($allSan as $san)
                @php
                    $sportCode = $san->MaLoai == 1 ? 'bong-da' : ($san->MaLoai == 2 ? 'cau-long' : 'pickleball');
                    $sportIcon = $san->MaLoai == 1 ? '⚽' : ($san->MaLoai == 2 ? '🏸' : '🎾');
                @endphp

                <article class="court-card bg-surface-container-lowest rounded-2xl border-2 transition-all duration-200 p-4 sm:p-5 shadow-sm relative overflow-hidden"
                         data-court-id="{{ $san->MaSan }}"
                         data-sport="{{ $sportCode }}"
                         data-court-name="{{ $san->TenSan }}"
                         data-court-price="{{ $san->GiaThue }}"
                         data-court-status="{{ $san->TinhTrang }}"
                         id="court-card-{{ $san->MaSan }}">

                    <div class="flex flex-col md:flex-row gap-4 sm:gap-5">
                        <!-- Thumbnail -->
                        <div class="relative w-full md:w-56 h-48 md:h-auto rounded-xl overflow-hidden flex-shrink-0 group">
                            <img class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300"
                                src="{{ $san->HinhAnh ?? 'https://i.ibb.co/3mbLd3R/badminton-court.png' }}"
                                alt="{{ $san->TenSan }}">
                            <div class="absolute top-2.5 left-2.5 flex flex-col gap-1">
                                @if (mb_strtolower(trim($san->TinhTrang)) === 'hoạt động')
                                    <span class="inline-flex items-center gap-1.5 bg-emerald-800/85 text-emerald-100 text-[10.5px] font-bold px-2.5 py-1 rounded-lg backdrop-blur-md shadow-xs">
                                        <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
                                        Hoạt động
                                    </span>
                                @else
                                    <span class="inline-flex items-center bg-gray-800/85 text-gray-200 text-[10.5px] font-bold px-2.5 py-1 rounded-lg backdrop-blur-md shadow-xs">
                                        Bảo trì
                                    </span>
                                @endif
                            </div>
                        </div>

                        <!-- Info & Slots -->
                        <div class="flex-grow flex flex-col justify-between">
                            <div>
                                <div class="flex items-start justify-between gap-3">
                                    <div>
                                        <h2 class="text-lg font-bold text-on-surface">
                                            {{ $san->TenSan }}
                                        </h2>
                                        <p class="text-xs text-outline flex items-center gap-1 mt-0.5">
                                            <span class="material-symbols-outlined text-[15px] text-primary">location_on</span>
                                            {{ $san->MoTa ?? 'Sân thi đấu chất lượng cao tại Thể thao Anh Vinh' }}
                                        </p>
                                    </div>
                                    <div class="flex items-center gap-1 bg-[#fffbe6] text-[#b78103] px-2 py-1 rounded-lg text-xs font-bold border border-[#ffe58f]">
                                        <span class="material-symbols-outlined text-[15px] text-[#faad14]">star</span>
                                        <span>4.9</span>
                                        <span class="text-outline font-normal text-[10.5px]">(98)</span>
                                    </div>
                                </div>

                                <!-- Interactive Timeline (DỰA THEO CƠ SỞ DỮ LIỆU & GIỜ THỰC TẾ) -->
                                <div class="mt-3.5 pt-3 border-t border-outline-variant/30">
                                    <div class="flex items-center justify-between text-[11px] text-outline font-bold uppercase tracking-wider mb-1.5">
                                        <span>Dải Timeline theo dõi ca đặt (05:00 – 03:00)</span>
                                        <span class="court-timeline-status text-xs font-bold" id="timeline-status-{{ $san->MaSan }}"></span>
                                    </div>
                                    <div class="w-full bg-[#f0f4f1] p-1.5 rounded-xl border border-outline-variant/30">
                                        <div class="grid grid-cols-12 gap-1 h-9 text-[11px] font-bold text-center" id="timeline-bar-{{ $san->MaSan }}">
                                            <!-- Dynamically generated via JS based on Start Time, Duration and DB Bookings -->
                                        </div>
                                        <div class="flex justify-between text-[10px] text-outline font-medium px-1 mt-1">
                                            <span>05:00</span>
                                            <span>10:00</span>
                                            <span>15:00</span>
                                            <span>20:00</span>
                                            <span>00:00</span>
                                            <span>03:00</span>
                                        </div>
                                    </div>
                                </div>

                                <!-- Warning Banner (Nếu để lại khoảng trống 30 phút lẻ) -->
                                <div class="anti-orphan-warning-banner hidden mt-3 bg-gradient-to-r from-amber-50 to-orange-50 border-2 border-amber-400 rounded-xl p-3 shadow-xs" id="warning-banner-{{ $san->MaSan }}">
                                    <div class="flex items-start gap-2.5">
                                        <div class="w-7 h-7 rounded-full bg-amber-500 text-white flex items-center justify-center flex-shrink-0 mt-0.5 shadow-xs">
                                            <span class="material-symbols-outlined text-[18px]">error_outline</span>
                                        </div>
                                        <div class="flex-grow">
                                            <h4 class="text-xs sm:text-sm font-bold text-amber-950 flex items-center gap-1.5">
                                                <span>⚠️ Cảnh báo: Tạo khoảng trống 30 phút khó xếp sân</span>
                                            </h4>
                                            <p class="text-xs text-amber-900/90 mt-1 leading-relaxed" id="warning-text-{{ $san->MaSan }}">
                                                Khung giờ bạn chọn để lại khoảng trống 30 phút không thể phục vụ khách tiếp theo.
                                            </p>
                                            <div class="mt-2.5 pt-2 border-t border-amber-300/80 flex flex-wrap items-center gap-2">
                                                <span class="text-xs font-bold text-amber-950">Gợi ý đổi giờ:</span>
                                                <button type="button" class="btn-snap-adjacent bg-primary hover:bg-primary-hover text-white text-xs font-bold px-3 py-1.5 rounded-lg flex items-center gap-1 shadow-xs transition-all" data-court-id="{{ $san->MaSan }}">
                                                    👉 Đặt nối tiếp ca trước (Khuyên dùng)
                                                </button>
                                                <button type="button" class="btn-snap-safe bg-white hover:bg-emerald-50 border border-primary text-primary text-xs font-bold px-3 py-1.5 rounded-lg transition-all" data-court-id="{{ $san->MaSan }}">
                                                    👉 Đặt lùi lại (Cách 60p)
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Snapped Banner (Khi liền kề) -->
                                <div class="anti-orphan-snapped-banner hidden mt-3 bg-gradient-to-r from-emerald-50 to-emerald-100/60 border border-primary/30 rounded-xl p-3 shadow-xs" id="snapped-banner-{{ $san->MaSan }}">
                                    <div class="flex items-start gap-2.5">
                                        <div class="w-7 h-7 rounded-full bg-primary text-white flex items-center justify-center flex-shrink-0 mt-0.5 shadow-xs">
                                            <span class="material-symbols-outlined text-[18px]">check_circle</span>
                                        </div>
                                        <div class="flex-grow">
                                            <h4 class="text-xs sm:text-sm font-bold text-emerald-900 flex items-center gap-1.5">
                                                <span>✓ Đã nối tiếp ca trước (Trống 0 phút)</span>
                                            </h4>
                                            <p class="text-xs text-emerald-900 mt-0.5">
                                                Khung giờ hoàn toàn liền mạch, tối ưu thời gian sân!
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                <!-- Slot summary info -->
                                <div class="mt-3 flex flex-wrap items-center justify-between gap-2">
                                    <div class="flex items-center gap-2">
                                        <span class="text-xs text-outline">Khung giờ chọn: <strong class="court-slot-label text-primary font-bold bg-surface-container px-2 py-0.5 rounded" id="slot-label-{{ $san->MaSan }}">--:-- → --:--</strong></span>
                                        <span class="text-outline-variant">•</span>
                                        <span class="court-rule-tag text-xs font-bold flex items-center gap-1" id="rule-tag-{{ $san->MaSan }}"></span>
                                    </div>
                                </div>
                            </div>

                            <!-- Price & Button Add to receipt -->
                            <div class="mt-3 pt-3 border-t border-outline-variant/30 flex items-center justify-between">
                                <div>
                                    <span class="text-xs text-outline block">Đơn giá thuê</span>
                                    <div class="flex items-baseline gap-1.5">
                                        <span class="text-lg font-extrabold text-primary">{{ number_format($san->GiaThue, 0, ',', '.') }}đ</span>
                                        <span class="text-xs text-outline">/ giờ</span>
                                    </div>
                                </div>
                                <button type="button" class="btn-toggle-court-cart bg-primary hover:bg-primary-hover active:scale-95 text-white px-5 py-2.5 rounded-full text-xs sm:text-sm font-bold flex items-center gap-1.5 transition-all shadow-sm"
                                    data-court-id="{{ $san->MaSan }}"
                                    id="btn-cart-{{ $san->MaSan }}">
                                    <span class="material-symbols-outlined text-[17px]">add</span>
                                    <span>Thêm vào phiếu đặt</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </article>
                @endforeach
            </section>

            <!-- ================= RIGHT COLUMN: STICKY BOOKING SUMMARY (4 COLS) ================= -->
            <aside class="lg:col-span-4 space-y-4 lg:sticky lg:top-24">
                <!-- Main Booking Receipt Card -->
                <div class="bg-surface-container-lowest border border-outline-variant/40 rounded-2xl p-5 shadow-sm">
                    <!-- Header -->
                    <div class="flex items-center justify-between pb-3.5 border-b border-outline-variant/30">
                        <div class="flex items-center gap-2">
                            <span class="material-symbols-outlined text-primary text-[24px]">receipt_long</span>
                            <h3 class="text-base sm:text-lg font-bold text-on-surface">Phiếu đặt sân</h3>
                        </div>
                        <span id="receiptBadgeCount" class="bg-secondary-container text-on-secondary-fixed text-xs font-extrabold px-3 py-1 rounded-full">
                            0 sân đã chọn
                        </span>
                    </div>

                    <!-- Empty placeholder (TÁCH BIỆT NGOÀI CONTAINER ĐỂ KHÔNG BỊ INNERHTML XÓA) -->
                    <div id="receiptEmptyPlaceholder" class="py-8 text-center text-outline">
                        <span class="material-symbols-outlined text-4xl text-outline-variant mb-2 block">event_busy</span>
                        <p class="font-bold text-sm text-on-surface mb-1">Chưa có sân nào trong phiếu đặt</p>
                        <p class="text-xs">Hãy chọn sân và khung giờ phù hợp ở danh sách bên trái.</p>
                    </div>

                    <!-- Selected Courts List Container (CHỨA CÁC SÂN ĐƯỢC CHỌN) -->
                    <div class="mt-4 space-y-3 hidden" id="receiptCourtList">
                        <!-- Court items dynamically rendered here -->
                    </div>

                    <!-- Price Calculations -->
                    <div class="mt-4 space-y-2 text-xs sm:text-sm text-on-surface-variant pt-3 border-t border-outline-variant/30">
                        <div class="flex justify-between">
                            <span>Tạm tính (<span id="summaryCourtCount">0</span> sân):</span>
                            <span class="font-semibold text-on-surface" id="summarySubtotal">0đ</span>
                        </div>
                        <div class="flex justify-between text-primary font-medium">
                            <span>Giảm giá thành viên ({{ $discountPercent }}%):</span>
                            <span id="summaryDiscount">-0đ</span>
                        </div>
                        <div class="flex justify-between text-outline text-xs">
                            <span>Phí dịch vụ sân & đèn chiếu sáng:</span>
                            <span class="text-primary font-medium">Miễn phí</span>
                        </div>
                        <!-- Dashed Divider -->
                        <div class="pt-3 border-t-2 border-dashed border-outline-variant/40 flex justify-between items-baseline">
                            <span class="text-xs sm:text-sm font-bold text-on-surface">TỔNG CỘNG THANH TOÁN:</span>
                            <span class="text-xl font-extrabold text-primary" id="summaryTotal">0đ</span>
                        </div>
                    </div>

                    <!-- Primary Confirmation Button (MỞ MODAL XÁC NHẬN & LƯU CSDL) -->
                    <div class="mt-5">
                        <button type="button" id="btnOpenCheckoutModal"
                            disabled
                            class="w-full bg-primary hover:bg-primary-hover active:scale-[0.98] text-white py-3.5 px-4 rounded-full font-bold text-center flex items-center justify-center gap-2 transition-all shadow-md text-xs sm:text-sm disabled:opacity-40 disabled:cursor-not-allowed">
                            <span>Tiến hành xác nhận đặt sân</span>
                            <span class="material-symbols-outlined text-[18px]">arrow_forward</span>
                        </button>
                    </div>

                    <!-- Trust Badges -->
                    <div class="mt-3.5 text-center">
                        <p class="text-[11px] text-outline flex items-center justify-center gap-1">
                            <span class="material-symbols-outlined text-[14px] text-primary">lock</span>
                            Bảo lưu sân trong 15 phút • Hỗ trợ hoàn hủy linh hoạt trước 4 tiếng
                        </p>
                    </div>
                </div>

                <!-- Secondary Support Callout Card -->
                <div class="bg-surface-container-lowest border border-outline-variant/30 rounded-2xl p-4 flex items-center justify-between gap-3 shadow-sm">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-full bg-secondary-container flex items-center justify-center text-on-secondary-fixed flex-shrink-0">
                            <span class="material-symbols-outlined text-[20px]">support_agent</span>
                        </div>
                        <div>
                            <p class="text-xs font-bold text-on-surface">Cần hỗ trợ đặt sân theo đoàn?</p>
                            <p class="text-[11.5px] text-outline">Hotline trực sân: <strong class="text-primary">0988 123 456</strong></p>
                        </div>
                    </div>
                    <a href="tel:0988123456" class="px-3.5 py-1.5 rounded-full border border-primary text-primary hover:bg-surface-container text-xs font-bold transition-all whitespace-nowrap">
                        Gọi ngay
                    </a>
                </div>
            </aside>
        </div>
    </main>

    <!-- ================= MODAL XÁC NHẬN VÀ LƯU VÀO DATABASE ================= -->
    <div id="checkoutModal" class="fixed inset-0 z-50 hidden overflow-y-auto bg-black/50 backdrop-blur-sm flex items-center justify-center p-4">
        <div class="bg-white rounded-2xl max-w-lg w-full p-6 shadow-2xl border border-outline-variant/40 relative animate-in fade-in zoom-in duration-200">
            <button type="button" id="btnCloseCheckoutModal" class="absolute top-4 right-4 text-outline hover:text-on-surface p-1 rounded-lg">
                <span class="material-symbols-outlined">close</span>
            </button>

            <div class="flex items-center gap-3 mb-4">
                <div class="w-10 h-10 rounded-xl bg-primary/10 text-primary flex items-center justify-center">
                    <span class="material-symbols-outlined text-2xl">verified</span>
                </div>
                <div>
                    <h3 class="text-lg font-bold text-on-surface">Xác nhận thông tin đặt sân</h3>
                    <p class="text-xs text-outline">Vui lòng kiểm tra lại thông tin và các ca đã chọn</p>
                </div>
            </div>

            <!-- Form lưu DB -->
            <form id="bookingCheckoutForm" action="{{ route('booking.store') }}" method="POST">
                @csrf
                <input type="hidden" name="NgayDat" id="formNgayDat" value="{{ $selectedDate ?? date('Y-m-d') }}">

                <!-- Hidden inputs for items will be appended via JS -->
                <div id="formHiddenItems"></div>

                <!-- Contact inputs -->
                <div class="space-y-3 mb-4">
                    <div>
                        <label for="formHoTen" class="block text-xs font-bold text-outline mb-1">Họ và tên người đặt <span class="text-red-500">*</span></label>
                        <input type="text" id="formHoTen" name="HoTen"
                            value="{{ $userKhachHang->HoTen ?? (Auth::user()->TenDangNhap ?? '') }}"
                            required
                            class="w-full bg-[#f0f4f1] border border-outline-variant/40 rounded-xl px-3.5 py-2 text-xs font-semibold focus:ring-2 focus:ring-primary focus:bg-white transition-all">
                    </div>
                    <div class="grid grid-cols-2 gap-3">
                        <div>
                            <label for="formSDT" class="block text-xs font-bold text-outline mb-1">Số điện thoại <span class="text-red-500">*</span></label>
                            <input type="tel" id="formSDT" name="SDT"
                                value="{{ $userKhachHang->SDT ?? '' }}"
                                required
                                placeholder="0912345678"
                                class="w-full bg-[#f0f4f1] border border-outline-variant/40 rounded-xl px-3.5 py-2 text-xs font-semibold focus:ring-2 focus:ring-primary focus:bg-white transition-all">
                        </div>
                        <div>
                            <label for="formEmail" class="block text-xs font-bold text-outline mb-1">Email nhận xác nhận</label>
                            <input type="email" id="formEmail" name="Email"
                                value="{{ $userKhachHang->Email ?? '' }}"
                                placeholder="email@example.com"
                                class="w-full bg-[#f0f4f1] border border-outline-variant/40 rounded-xl px-3.5 py-2 text-xs font-semibold focus:ring-2 focus:ring-primary focus:bg-white transition-all">
                        </div>
                    </div>
                    <div>
                        <label for="formGhiChu" class="block text-xs font-bold text-outline mb-1">Ghi chú (tùy chọn)</label>
                        <input type="text" id="formGhiChu" name="GhiChu"
                            placeholder="Ví dụ: Cần mượn thêm vợt, lấy nước ngọt..."
                            class="w-full bg-[#f0f4f1] border border-outline-variant/40 rounded-xl px-3.5 py-2 text-xs font-semibold focus:ring-2 focus:ring-primary focus:bg-white transition-all">
                    </div>
                </div>

                <!-- Booking item summary inside modal -->
                <div class="bg-[#f7f9f4] p-3 rounded-xl border border-outline-variant/30 mb-4 max-h-40 overflow-y-auto" id="modalItemList">
                    <!-- Appended via JS -->
                </div>

                <div class="flex items-center justify-between py-2 border-t border-outline-variant/30 mb-5">
                    <span class="text-xs font-bold text-outline uppercase">Tổng thanh toán:</span>
                    <span class="text-xl font-extrabold text-primary" id="modalTotalAmount">0đ</span>
                </div>

                <div class="flex items-center gap-3">
                    <button type="button" id="btnCancelModal" class="w-1/3 py-2.5 rounded-xl border border-outline-variant/40 text-xs font-bold hover:bg-gray-100 transition-colors">
                        Quay lại
                    </button>
                    <button type="submit" id="btnSubmitBooking" class="w-2/3 bg-primary hover:bg-primary-hover text-white py-2.5 rounded-xl text-xs sm:text-sm font-bold shadow-md transition-all flex items-center justify-center gap-1.5">
                        <span class="material-symbols-outlined text-[18px]">check_circle</span>
                        <span>Hoàn tất đặt sân ngay</span>
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- ================= 4. FOOTER ================= -->
    <footer class="w-full mt-12 bg-surface-container-lowest border-t border-outline-variant/30 transition-colors">
        <div class="max-w-7xl mx-auto px-6 py-8 flex flex-col md:flex-row justify-between items-center gap-4">
            <div class="flex flex-col sm:flex-row items-center gap-3 text-center sm:text-left">
                <div class="flex items-center gap-2">
                    <div class="w-7 h-7 rounded-lg bg-secondary-container flex items-center justify-center text-on-secondary-fixed font-black text-xs">
                        AV
                    </div>
                    <span class="text-sm font-bold text-primary">Thể thao Anh Vinh</span>
                </div>
                <span class="hidden sm:inline text-outline-variant">•</span>
                <p class="text-xs text-outline">
                    © {{ date('Y') }} Thể thao Anh Vinh. Tất cả các quyền được bảo lưu.
                </p>
            </div>
            <div class="flex flex-wrap justify-center items-center gap-6 text-xs text-on-surface-variant font-medium">
                <a class="hover:text-primary transition-colors" href="#">Điều khoản dịch vụ</a>
                <a class="hover:text-primary transition-colors" href="#">Chính sách hoàn tiền</a>
                <a class="hover:text-primary transition-colors" href="#">Quy định đặt sân</a>
                <a class="hover:text-primary transition-colors" href="#">Hỗ trợ khách hàng</a>
            </div>
        </div>
    </footer>

    <!-- Pass real DB bookings from PHP to JS -->
    <script>
        window.dbBookedSlots = @json($bookedSlotsByCourt ?? []);
        window.serverCurrentTime = "{{ date('H:i') }}";
        window.serverCurrentDate = "{{ date('Y-m-d') }}";
    </script>

    <!-- ================= SCRIPT TOÀN BỘ LOGIC TƯƠNG TÁC ================= -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // State
            let selectedDate = document.getElementById('bookingDateInput').value;
            let selectedStartTime = '18:30';
            let selectedDuration = 90; // Minutes
            let selectedSport = 'all';
            let searchQuery = '';
            const discountPercent = {{ (float) $discountPercent }};

            // Giỏ hàng đặt sân: Bắt đầu trống để người dùng tự chọn
            let cart = [];

            // Lấy giờ hiện tại HH:mm
            function getNowTimeStr() {
                const now = new Date();
                const h = String(now.getHours()).padStart(2, '0');
                const m = String(now.getMinutes()).padStart(2, '0');
                return `${h}:${m}`;
            }

            // Kiểm tra xem ngày chọn có phải là hôm nay không
            function isDateToday(dateStr) {
                return dateStr === window.serverCurrentDate;
            }

            // Tiện ích đổi HH:mm thành số phút từ mốc 05:00 sáng (Hỗ trợ qua đêm đến 03:00 khuya hôm sau)
            function timeToMinutes(tStr) {
                if (!tStr) return 0;
                const parts = tStr.split(':').map(Number);
                let h = parts[0];
                const m = parts[1] || 0;
                // Nếu giờ < 5 (tức 00:xx, 01:xx, 02:xx, 03:00), đây là giờ khuya sau nửa đêm thuộc ca ngày đang chọn
                if (h < 5) {
                    h += 24;
                }
                return h * 60 + m;
            }

            // Tiện ích đổi phút thành HH:mm
            function minutesToTime(mins) {
                const totalMinutes = mins % 1440; // wrap around 24h
                const h = Math.floor(totalMinutes / 60);
                const m = totalMinutes % 60;
                return `${String(h).padStart(2, '0')}:${String(m).padStart(2, '0')}`;
            }

            // Tính giờ kết thúc
            function calculateEndTime(startTimeStr, durationMinutes) {
                const total = timeToMinutes(startTimeStr) + durationMinutes;
                return minutesToTime(total);
            }

            // ================= CHỈ CHO PHÉP CHỌN KHUNG GIỜ CHẴN (:00 HOẶC :30) TỪ 05:00 ĐẾN 02:30 (ĐÓNG CỬA 03:00) =================
            function populateStartTimeOptions() {
                const timeSelect = document.getElementById('bookingStartTimeInput');
                const dateInput = document.getElementById('bookingDateInput');
                const isToday = isDateToday(dateInput.value);
                const nowStr = getNowTimeStr();
                const nowMins = timeToMinutes(nowStr);

                const previousVal = timeSelect.value || selectedStartTime;
                timeSelect.innerHTML = '';

                let firstValidOption = null;

                // Danh sách khung giờ theo chu kỳ hoạt động 05:00 sáng đến 02:30 khuya
                const slots = [];
                // Ban ngày & tối: 05:00 -> 23:30
                for (let h = 5; h <= 23; h++) {
                    for (let m of [0, 30]) {
                        slots.push({ h, m, slotStr: `${String(h).padStart(2, '0')}:${String(m).padStart(2, '0')}` });
                    }
                }
                // Ca khuya sau nửa đêm: 00:00 -> 02:30
                for (let h = 0; h <= 2; h++) {
                    for (let m of [0, 30]) {
                        slots.push({ h, m, slotStr: `${String(h).padStart(2, '0')}:${String(m).padStart(2, '0')}` });
                    }
                }

                slots.forEach(slot => {
                    const slotMins = timeToMinutes(slot.slotStr);

                    // Nếu là ngày hôm nay và khung giờ này đã qua, bỏ qua không cho chọn
                    if (isToday && slotMins <= nowMins) {
                        return;
                    }

                    const opt = document.createElement('option');
                    opt.value = slot.slotStr;
                    opt.textContent = (slot.h < 5) ? `${slot.slotStr} (Sáng hôm sau)` : slot.slotStr;

                    if (!firstValidOption) {
                        firstValidOption = slot.slotStr;
                    }

                    if (slot.slotStr === previousVal) {
                        opt.selected = true;
                    }

                    timeSelect.appendChild(opt);
                });

                if (!timeSelect.value && firstValidOption) {
                    timeSelect.value = firstValidOption;
                }

                selectedStartTime = timeSelect.value || firstValidOption || '18:30';
            }

            // Cập nhật trạng thái hiển thị của từng sân
            function updateAllCourtCards() {
                const courtCards = document.querySelectorAll('.court-card');
                let visibleCount = 0;
                const endTimeStr = calculateEndTime(selectedStartTime, selectedDuration);
                const isToday = isDateToday(selectedDate);
                const nowMinutes = timeToMinutes(getNowTimeStr());

                courtCards.forEach(card => {
                    const cId = card.getAttribute('data-court-id');
                    const cSport = card.getAttribute('data-sport');
                    const cName = card.getAttribute('data-court-name');
                    const cPrice = parseFloat(card.getAttribute('data-court-price'));
                    const cStatus = card.getAttribute('data-court-status') || 'Hoạt động';
                    const isOperating = (cStatus.trim().toLowerCase() === 'hoạt động');

                    // Lọc môn thể thao và tìm kiếm
                    const matchSport = (selectedSport === 'all' || cSport === selectedSport);
                    const matchSearch = (!searchQuery || cName.toLowerCase().includes(searchQuery));

                    if (matchSport && matchSearch) {
                        card.classList.remove('hidden');
                        visibleCount++;
                    } else {
                        card.classList.add('hidden');
                        return;
                    }

                    // Lấy các ca đã đặt THỰC TẾ trong cơ sở dữ liệu cho sân này
                    const courtBookings = (window.dbBookedSlots && (window.dbBookedSlots[cId] || window.dbBookedSlots[String(cId)] || window.dbBookedSlots[Number(cId)]))
                        ? (window.dbBookedSlots[cId] || window.dbBookedSlots[String(cId)] || window.dbBookedSlots[Number(cId)])
                        : [];

                    const chosenStartMins = timeToMinutes(selectedStartTime);
                    const chosenEndMins = chosenStartMins + selectedDuration;
                    const CLOSING_MINUTES = 27 * 60; // 1620 phút (03:00 khuya hôm sau)
                    const isPastClosing = chosenEndMins > CLOSING_MINUTES;

                    // 1. KIỂM TRA TRÙNG LỊCH (COLLISION / OVERLAP) VỚI CÁC CA ĐÃ ĐẶT TRONG DATABASE
                    let conflictingBooking = null;
                    let priorBooking = null;
                    let nextBooking = null;

                    courtBookings.forEach(b => {
                        const bStartMins = timeToMinutes(b.start);
                        const bEndMins = timeToMinutes(b.end, true);

                        // Trùng lịch: 2 khoảng [start1, end1) và [start2, end2) giao nhau khi max(start1, start2) < min(end1, end2)
                        if (Math.max(chosenStartMins, bStartMins) < Math.min(chosenEndMins, bEndMins)) {
                            conflictingBooking = b;
                        }

                        // Ca trước (kết thúc trước hoặc đúng lúc khách bắt đầu)
                        if (bEndMins <= chosenStartMins) {
                            if (!priorBooking || bEndMins > timeToMinutes(priorBooking.end, true)) {
                                priorBooking = b;
                            }
                        }

                        // Ca sau (bắt đầu sau hoặc đúng lúc khách kết thúc)
                        if (bStartMins >= chosenEndMins) {
                            if (!nextBooking || bStartMins < timeToMinutes(nextBooking.start)) {
                                nextBooking = b;
                            }
                        }
                    });

                    // 2. Tính toán quy tắc Anti-Orphan khi không trùng lịch:
                    let gapMinutes = -1;
                    let isAntiOrphanDead = false;
                    let isAdjacentSnap = false;
                    let snapTargetTime = null;

                    if (!conflictingBooking && !isPastClosing) {
                        if (priorBooking) {
                            const gapBefore = chosenStartMins - timeToMinutes(priorBooking.end, true);
                            if (gapBefore > 0 && gapBefore < 60) {
                                isAntiOrphanDead = true;
                                gapMinutes = gapBefore;
                                snapTargetTime = priorBooking.end;
                            } else if (gapBefore === 0) {
                                isAdjacentSnap = true;
                            }
                        }

                        if (!isAntiOrphanDead && nextBooking) {
                            const gapAfter = timeToMinutes(nextBooking.start) - chosenEndMins;
                            if (gapAfter > 0 && gapAfter < 60) {
                                isAntiOrphanDead = true;
                                gapMinutes = gapAfter;
                                snapTargetTime = minutesToTime(timeToMinutes(nextBooking.start) - selectedDuration);
                            } else if (gapAfter === 0) {
                                isAdjacentSnap = true;
                            }
                        }
                    }

                    // Kiểm tra ca này đã có trong phiếu đặt chưa
                    const isInCartThisSlot = cart.some(item => 
                        String(item.courtId) === String(cId) && 
                        item.startTime === selectedStartTime && 
                        item.endTime === endTimeStr
                    );

                    // Kiểm tra xem sân này có ca nào khác trong giỏ bị trùng giờ không
                    const cartOverlapItem = cart.find(item => 
                        String(item.courtId) === String(cId) && 
                        !isInCartThisSlot && 
                        Math.max(chosenStartMins, timeToMinutes(item.startTime)) < Math.min(chosenEndMins, timeToMinutes(item.endTime, true))
                    );

                    // DOM elements trong card
                    const timelineStatus = document.getElementById(`timeline-status-${cId}`);
                    const timelineBar = document.getElementById(`timeline-bar-${cId}`);
                    const warningBanner = document.getElementById(`warning-banner-${cId}`);
                    const snappedBanner = document.getElementById(`snapped-banner-${cId}`);
                    const slotLabel = document.getElementById(`slot-label-${cId}`);
                    const ruleTag = document.getElementById(`rule-tag-${cId}`);
                    const btnCart = document.getElementById(`btn-cart-${cId}`);

                    // NẾU SÂN BẢO TRÌ:
                    if (!isOperating) {
                        warningBanner.classList.add('hidden');
                        snappedBanner.classList.add('hidden');

                        card.className = card.className.replace(/border-(primary\/40|emerald-300|amber-400|outline-variant\/40|red-400)/g, '');
                        card.classList.add('border-gray-300');

                        timelineStatus.innerHTML = '';
                        ruleTag.innerHTML = '';

                        timelineBar.innerHTML = `
                            <div class="col-span-12 bg-gray-100 border border-gray-300 text-gray-600 rounded-md flex items-center justify-center font-bold text-xs py-1">
                                Bảo trì
                            </div>
                        `;

                        btnCart.disabled = true;
                        btnCart.className = 'btn-toggle-court-cart bg-gray-200 text-gray-400 border border-gray-300 px-5 py-2.5 rounded-full text-xs sm:text-sm font-bold flex items-center gap-1.5 cursor-not-allowed shadow-none';
                        btnCart.innerHTML = 'Bảo trì';
                        return;
                    }

                    // Cập nhật slot label
                    const nightSuffix = (chosenStartMins >= 1440) ? ' (Sáng hôm sau)' : ((chosenEndMins > 1440) ? ' (Hôm sau)' : '');
                    slotLabel.textContent = `${selectedStartTime} → ${endTimeStr}${nightSuffix} (${selectedDuration}p)`;

                    // CẬP NHẬT TIMELINE BAR:
                    timelineBar.innerHTML = '';

                    // 1. Phân đoạn quá khứ: CHỈ NỀN XÁM, KHÔNG HIỆN KHOẢNG THỜI GIAN, KHÔNG HIỆN "ĐÃ ĐẶT"
                    if (isToday && nowMinutes > timeToMinutes('05:00')) {
                        const pastCol = document.createElement('div');
                        pastCol.className = 'col-span-3 bg-gray-200 border border-gray-300 rounded-md';
                        pastCol.title = 'Thời gian đã trôi qua trong ngày';
                        timelineBar.appendChild(pastCol);
                    }

                    // 2. Phân đoạn đã đặt từ cơ sở dữ liệu (nếu có)
                    if (courtBookings.length > 0) {
                        courtBookings.forEach(b => {
                            const bEnd = timeToMinutes(b.end);
                            if (!isToday || bEnd > nowMinutes) {
                                const bookedCol = document.createElement('div');
                                const isThisConflict = (conflictingBooking && conflictingBooking.start === b.start && conflictingBooking.end === b.end);
                                if (isThisConflict) {
                                    bookedCol.className = 'col-span-6 bg-red-100 text-red-700 font-extrabold rounded-md border-2 border-red-500 flex items-center justify-center p-0.5 text-[10px] shadow-xs';
                                    bookedCol.textContent = `❌ ${b.start} - ${b.end} (Đã đặt - Trùng lịch)`;
                                } else {
                                    bookedCol.className = 'col-span-3 striped-pattern text-gray-700 font-bold rounded-md border border-gray-400 flex items-center justify-center p-0.5 text-[10px]';
                                    bookedCol.textContent = `${b.start} - ${b.end} (Đã đặt)`;
                                }
                                timelineBar.appendChild(bookedCol);
                            }
                        });
                    }

                    // 3. Phân đoạn ca người dùng đang chọn & xử lý các trạng thái:
                    if (conflictingBooking) {
                        // TRƯỜNG HỢP 1: TRÙNG LỊCH ĐÃ ĐẶT TRONG DATABASE
                        warningBanner.classList.add('hidden');
                        snappedBanner.classList.add('hidden');

                        card.className = card.className.replace(/border-(primary\/40|emerald-300|amber-400|outline-variant\/40|red-400)/g, '');
                        card.classList.add('border-red-400');

                        timelineStatus.className = 'court-timeline-status text-xs font-bold text-red-600 flex items-center gap-1';
                        timelineStatus.innerHTML = `<span class="material-symbols-outlined text-[14px]">event_busy</span> Đã có người đặt (${conflictingBooking.start} - ${conflictingBooking.end})`;

                        ruleTag.innerHTML = `<span class="material-symbols-outlined text-[15px] text-red-600">block</span> <span class="text-red-700 font-bold">Trùng giờ đã đặt (${conflictingBooking.start} - ${conflictingBooking.end})</span>`;

                        btnCart.disabled = true;
                        btnCart.className = 'btn-toggle-court-cart bg-gray-200 text-gray-400 border border-gray-300 px-5 py-2.5 rounded-full text-xs sm:text-sm font-bold flex items-center gap-1.5 cursor-not-allowed shadow-none';
                        btnCart.innerHTML = '<span class="material-symbols-outlined text-[17px]">block</span> Đã kín lịch';

                    } else if (isPastClosing) {
                        // TRƯỜNG HỢP 2: VƯỢT QUÁ GIỜ ĐÓNG CỬA CỦA CỤM SÂN (03:00 KHUYA)
                        warningBanner.classList.add('hidden');
                        snappedBanner.classList.add('hidden');

                        card.className = card.className.replace(/border-(primary\/40|emerald-300|amber-400|outline-variant\/40|red-400)/g, '');
                        card.classList.add('border-red-400');

                        timelineStatus.className = 'court-timeline-status text-xs font-bold text-red-600 flex items-center gap-1';
                        timelineStatus.innerHTML = `<span class="material-symbols-outlined text-[14px]">error</span> Kết thúc lúc ${endTimeStr}, vượt quá giờ đóng cửa (03:00 khuya)`;

                        ruleTag.innerHTML = `<span class="material-symbols-outlined text-[15px] text-red-600">block</span> <span class="text-red-700 font-bold">Vượt giờ đóng cửa (03:00 khuya)</span>`;

                        btnCart.disabled = true;
                        btnCart.className = 'btn-toggle-court-cart bg-gray-200 text-gray-400 border border-gray-300 px-5 py-2.5 rounded-full text-xs sm:text-sm font-bold flex items-center gap-1.5 cursor-not-allowed shadow-none';
                        btnCart.innerHTML = '<span class="material-symbols-outlined text-[17px]">block</span> Quá giờ đóng cửa';

                    } else if (cartOverlapItem) {
                        // TRƯỜNG HỢP 3: TRÙNG VỚI 1 CA KHÁC CỦA SÂN NÀY ĐANG CÓ TRONG GIỎ
                        warningBanner.classList.add('hidden');
                        snappedBanner.classList.add('hidden');

                        card.className = card.className.replace(/border-(primary\/40|emerald-300|amber-400|outline-variant\/40|red-400)/g, '');
                        card.classList.add('border-amber-400');

                        timelineStatus.className = 'court-timeline-status text-xs font-bold text-amber-700 flex items-center gap-1';
                        timelineStatus.innerHTML = `<span class="material-symbols-outlined text-[14px]">warning</span> Trùng ca đã chọn (${cartOverlapItem.startTime} - ${cartOverlapItem.endTime})`;

                        ruleTag.innerHTML = `<span class="material-symbols-outlined text-[15px] text-amber-600">warning</span> <span class="text-amber-800 font-bold">Trùng ca trong phiếu</span>`;

                        btnCart.disabled = true;
                        btnCart.className = 'btn-toggle-court-cart bg-amber-100 text-amber-700 border border-amber-300 px-5 py-2.5 rounded-full text-xs sm:text-sm font-bold flex items-center gap-1.5 cursor-not-allowed shadow-none';
                        btnCart.innerHTML = '<span class="material-symbols-outlined text-[17px]">warning</span> Trùng ca trong phiếu';

                    } else if (isInCartThisSlot) {
                        // TRƯỜNG HỢP 3: CHÍNH XÁC CA NÀY ĐÃ ĐƯỢC CHỌN VÀO PHIẾU
                        const chosenCol = document.createElement('div');
                        chosenCol.className = 'col-span-5 bg-primary text-white rounded-md flex items-center justify-center text-[10.5px] font-bold shadow-xs';
                        chosenCol.innerHTML = `<span class="material-symbols-outlined text-[13px] mr-1">task_alt</span> ${selectedStartTime} - ${endTimeStr}`;
                        timelineBar.appendChild(chosenCol);

                        warningBanner.classList.add('hidden');
                        snappedBanner.classList.add('hidden');

                        card.className = card.className.replace(/border-(amber-400|outline-variant\/40|red-400)/g, '');
                        card.classList.add('border-primary/40');

                        timelineStatus.className = 'court-timeline-status text-xs font-bold text-primary flex items-center gap-1';
                        timelineStatus.innerHTML = '<span class="material-symbols-outlined text-[14px]">task_alt</span> Đang có trong phiếu đặt';

                        ruleTag.innerHTML = '<span class="material-symbols-outlined text-[15px] text-primary">verified</span> <span class="text-primary font-bold">Đã chọn</span>';

                        btnCart.disabled = false;
                        btnCart.className = 'btn-toggle-court-cart bg-primary/15 text-primary border border-primary/30 px-5 py-2.5 rounded-full text-xs sm:text-sm font-bold flex items-center gap-1.5 transition-all shadow-xs hover:bg-red-50 hover:text-error hover:border-error';
                        btnCart.innerHTML = '<span class="material-symbols-outlined text-[17px]">check</span> Đã trong phiếu';

                    } else if (isAntiOrphanDead && snapTargetTime) {
                        // TRƯỜNG HỢP 4: KHOẢNG TRỐNG 30 PHÚT LẺ
                        const deadCol = document.createElement('div');
                        deadCol.className = 'col-span-2 bg-amber-200 border-2 border-dashed border-amber-500 text-amber-900 rounded-md flex items-center justify-center animate-pulse text-[10px]';
                        deadCol.textContent = `Khe hở ${gapMinutes}p ⚠️`;
                        timelineBar.appendChild(deadCol);

                        const chosenCol = document.createElement('div');
                        chosenCol.className = 'col-span-4 bg-amber-100 border border-amber-400 text-amber-900 rounded-md flex items-center justify-center text-[10px] font-semibold';
                        chosenCol.textContent = `${selectedStartTime} - ${endTimeStr}`;
                        timelineBar.appendChild(chosenCol);

                        warningBanner.classList.remove('hidden');
                        snappedBanner.classList.add('hidden');

                        const warningText = document.getElementById(`warning-text-${cId}`);
                        warningText.innerHTML = `Lịch đặt của bạn để lại khoảng trống <strong>${gapMinutes} phút lẻ</strong> (thời lượng thuê tối thiểu là 60 phút). Vui lòng chọn một trong các khung giờ gợi ý bên dưới để đặt sân:`;

                        const snapBtn = warningBanner.querySelector('.btn-snap-adjacent');
                        snapBtn.setAttribute('data-target-time', snapTargetTime);
                        snapBtn.innerHTML = `👉 Đặt nối tiếp từ ${snapTargetTime} (Khuyên dùng)`;

                        const safeTime = minutesToTime(timeToMinutes(snapTargetTime, true) + 60);
                        const safeBtn = warningBanner.querySelector('.btn-snap-safe');
                        safeBtn.setAttribute('data-target-time', safeTime);
                        safeBtn.innerHTML = `👉 Đặt lùi lại từ ${safeTime} (Cách 60p)`;

                        card.className = card.className.replace(/border-(primary\/40|emerald-300|outline-variant\/40|red-400)/g, '');
                        card.classList.add('border-amber-400');

                        timelineStatus.className = 'court-timeline-status text-xs font-bold text-amber-800';
                        timelineStatus.textContent = `⚠️ Để lại khoảng trống ${gapMinutes} phút lẻ`;

                        ruleTag.innerHTML = '<span class="material-symbols-outlined text-[15px] text-amber-600">priority_high</span> <span class="text-amber-700 font-bold">Cần đổi giờ liền mạch</span>';

                        // Tắt nút đặt sân, không cho khách đặt khi tạo khoảng trống lẻ
                        btnCart.disabled = true;
                        btnCart.className = 'btn-toggle-court-cart bg-gray-200 text-gray-400 border border-gray-300 px-5 py-2.5 rounded-full text-xs sm:text-sm font-bold flex items-center gap-1.5 cursor-not-allowed shadow-none';
                        btnCart.innerHTML = '<span class="material-symbols-outlined text-[17px]">block</span> Vui lòng chọn gợi ý đổi giờ';

                    } else if (isAdjacentSnap) {
                        // TRƯỜNG HỢP 5: KHỚP NỐI TIẾP LIỀN KỀ (TRỐNG 0 PHÚT)
                        const snapCol = document.createElement('div');
                        snapCol.className = 'col-span-4 bg-primary text-white rounded-md flex items-center justify-center gap-1 shadow-xs text-[10.5px]';
                        snapCol.innerHTML = `<span class="material-symbols-outlined text-[13px]">done_all</span> ${selectedStartTime} - ${endTimeStr}`;
                        timelineBar.appendChild(snapCol);

                        warningBanner.classList.add('hidden');
                        snappedBanner.classList.remove('hidden');

                        card.className = card.className.replace(/border-(amber-400|outline-variant\/40|red-400)/g, '');
                        card.classList.add('border-primary/40');

                        timelineStatus.className = 'court-timeline-status text-xs font-bold text-primary flex items-center gap-1';
                        timelineStatus.innerHTML = '<span class="material-symbols-outlined text-[14px]">check_circle</span> Nối tiếp ca trước (0 phút trống)';

                        ruleTag.innerHTML = '<span class="material-symbols-outlined text-[15px] text-primary">verified</span> <span class="text-primary font-bold">Giờ đặt liền mạch</span>';

                        btnCart.disabled = false;
                        if (isInCartThisSlot) {
                            btnCart.className = 'btn-toggle-court-cart bg-primary/15 text-primary border border-primary/30 px-5 py-2.5 rounded-full text-xs sm:text-sm font-bold flex items-center gap-1.5 transition-all shadow-xs hover:bg-red-50 hover:text-error hover:border-error';
                            btnCart.innerHTML = '<span class="material-symbols-outlined text-[17px]">check</span> Đã trong phiếu';
                        } else {
                            btnCart.className = 'btn-toggle-court-cart bg-primary hover:bg-primary-hover active:scale-95 text-white px-5 py-2.5 rounded-full text-xs sm:text-sm font-bold flex items-center gap-1.5 transition-all shadow-sm';
                            btnCart.innerHTML = '<span class="material-symbols-outlined text-[17px]">add</span> Thêm vào phiếu đặt';
                        }

                    } else {
                        // TRƯỜNG HỢP 6: SÂN TRỐNG HOÀN TOÀN HOẶC CÁCH CA KHÁC >= 60 PHÚT
                        const freeCol = document.createElement('div');
                        freeCol.className = 'col-span-5 bg-primary text-white rounded-md flex items-center justify-center text-[10.5px] font-bold shadow-xs';
                        freeCol.innerHTML = `<span class="material-symbols-outlined text-[13px] mr-1">schedule</span> ${selectedStartTime} - ${endTimeStr}`;
                        timelineBar.appendChild(freeCol);

                        const remainingCol = document.createElement('div');
                        remainingCol.className = 'col-span-4 bg-emerald-50 text-emerald-800 border border-emerald-300 rounded-md flex items-center justify-center text-[10px]';
                        remainingCol.textContent = `Trống sau ${endTimeStr}`;
                        timelineBar.appendChild(remainingCol);

                        warningBanner.classList.add('hidden');
                        snappedBanner.classList.add('hidden');

                        card.className = card.className.replace(/border-(amber-400|primary\/40|red-400)/g, '');
                        card.classList.add('border-outline-variant/40');

                        timelineStatus.className = 'court-timeline-status text-xs font-bold text-primary';
                        timelineStatus.textContent = courtBookings.length > 0 ? '✓ Khung giờ hợp lệ' : '✓ Sân trống hoàn toàn';

                        ruleTag.innerHTML = '<span class="material-symbols-outlined text-[15px] text-primary">verified</span> <span class="text-primary font-bold">Hợp lệ</span>';

                        btnCart.disabled = false;
                        btnCart.className = 'btn-toggle-court-cart bg-primary hover:bg-primary-hover active:scale-95 text-white px-5 py-2.5 rounded-full text-xs sm:text-sm font-bold flex items-center gap-1.5 transition-all shadow-sm';
                        btnCart.innerHTML = '<span class="material-symbols-outlined text-[17px]">add</span> Thêm vào phiếu đặt';
                    }
                });

                document.getElementById('visibleCourtCountBadge').textContent = `${visibleCount} sân phù hợp`;
            }

            // ================= RENDER PHIẾU ĐẶT SÂN & TÍNH LẠI GIÁ TIỀN CHUẨN XÁC 100% =================
            function renderReceipt() {
                const listContainer = document.getElementById('receiptCourtList');
                const emptyPlaceholder = document.getElementById('receiptEmptyPlaceholder');
                const receiptBadgeCount = document.getElementById('receiptBadgeCount');
                const summaryCourtCount = document.getElementById('summaryCourtCount');
                const summarySubtotal = document.getElementById('summarySubtotal');
                const summaryDiscount = document.getElementById('summaryDiscount');
                const summaryTotal = document.getElementById('summaryTotal');
                const btnOpenCheckout = document.getElementById('btnOpenCheckoutModal');

                // Nếu giỏ hàng trống (0 sân)
                if (cart.length === 0) {
                    listContainer.innerHTML = '';
                    listContainer.classList.add('hidden');
                    emptyPlaceholder.classList.remove('hidden');

                    receiptBadgeCount.textContent = '0 sân đã chọn';
                    summaryCourtCount.textContent = '0';
                    summarySubtotal.textContent = '0đ';
                    summaryDiscount.textContent = '-0đ';
                    summaryTotal.textContent = '0đ';
                    btnOpenCheckout.disabled = true;
                    return;
                }

                // Nếu giỏ hàng có sân
                emptyPlaceholder.classList.add('hidden');
                listContainer.classList.remove('hidden');
                btnOpenCheckout.disabled = false;
                listContainer.innerHTML = '';

                let subtotal = 0;

                cart.forEach((item, index) => {
                    subtotal += item.total;

                    const itemDiv = document.createElement('div');
                    itemDiv.className = 'p-3 bg-[#f7f9f4] border border-outline-variant/30 rounded-xl relative group hover:border-primary/40 transition-colors';
                    itemDiv.innerHTML = `
                        <!-- NÚT THÙNG RÁC GỌI TRỰC TIẾP HÀM XÓA VÀ CẬP NHẬT TỔNG TIỀN -->
                        <button type="button" onclick="window.removeItemFromReceipt(${index})" class="absolute top-2.5 right-2.5 text-outline hover:text-error transition-colors p-1" title="Xóa sân này khỏi phiếu">
                            <span class="material-symbols-outlined text-[18px]">delete</span>
                        </button>
                        <div class="flex items-start gap-2.5 pr-7">
                            <span class="text-xl">${item.sportIcon}</span>
                            <div>
                                <h4 class="text-xs sm:text-sm font-bold text-on-surface">${item.courtName}</h4>
                                <p class="text-xs text-primary font-semibold flex items-center gap-1 mt-0.5">
                                    <span class="material-symbols-outlined text-[14px]">schedule</span> ${item.startTime} - ${item.endTime} (${item.duration}p${timeToMinutes(item.startTime) >= 1440 ? ' • Sáng hôm sau' : (timeToMinutes(item.endTime) > 1440 ? ' • Hôm sau' : '')})
                                </p>
                                <p class="text-[11px] text-outline mt-0.5">Đơn giá: ${new Intl.NumberFormat('vi-VN').format(item.price)}đ/h</p>
                            </div>
                        </div>
                        <div class="mt-2 pt-2 border-t border-outline-variant/30 flex justify-between items-center text-xs">
                            <span class="text-outline">Thành tiền:</span>
                            <span class="font-bold text-on-surface text-sm">${new Intl.NumberFormat('vi-VN').format(item.total)}đ</span>
                        </div>
                    `;
                    listContainer.appendChild(itemDiv);
                });

                // Cập nhật giá tiền chuẩn xác
                const discountAmount = Math.round(subtotal * (discountPercent / 100));
                const finalTotal = subtotal - discountAmount;

                receiptBadgeCount.textContent = `${cart.length} sân đã chọn`;
                summaryCourtCount.textContent = cart.length;
                summarySubtotal.textContent = new Intl.NumberFormat('vi-VN').format(subtotal) + 'đ';
                summaryDiscount.textContent = `-${new Intl.NumberFormat('vi-VN').format(discountAmount)}đ`;
                summaryTotal.textContent = new Intl.NumberFormat('vi-VN').format(finalTotal) + 'đ';
            }

            // Hàm xóa sân khỏi phiếu toàn cục
            window.removeItemFromReceipt = function(index) {
                cart.splice(index, 1);
                renderReceipt();
                updateAllCourtCards();
            };

            // ================= SỰ KIỆN ĐỔI NGÀY: TẢI LẠI GIỜ TRỐNG TRONG CSDL =================
            document.getElementById('bookingDateInput').addEventListener('change', function () {
                selectedDate = this.value;
                populateStartTimeOptions();

                fetch(`{{ route('booking.slots') }}?date=${selectedDate}`, {
                    headers: { 'Accept': 'application/json' }
                })
                .then(res => res.json())
                .then(data => {
                    if (data && data.booked_slots) {
                        window.dbBookedSlots = data.booked_slots;
                    } else {
                        window.dbBookedSlots = {};
                    }
                    updateAllCourtCards();
                })
                .catch(() => {
                    updateAllCourtCards();
                });
            });

            // ================= SỰ KIỆN NÚT LỌC SÂN =================
            document.getElementById('btnFilterApply').addEventListener('click', function () {
                selectedDate = document.getElementById('bookingDateInput').value;
                selectedStartTime = document.getElementById('bookingStartTimeInput').value;

                const btnFilter = document.getElementById('btnFilterApply');
                const originalHtml = btnFilter.innerHTML;
                btnFilter.disabled = true;
                btnFilter.innerHTML = '<span class="material-symbols-outlined text-[18px] animate-spin">refresh</span> <span>Đang lọc...</span>';

                // Luôn fetch lại ca đã đặt mới nhất từ CSDL khi bấm Lọc sân
                fetch(`{{ route('booking.slots') }}?date=${selectedDate}`, {
                    headers: { 'Accept': 'application/json' }
                })
                .then(res => res.json())
                .then(data => {
                    if (data && data.booked_slots) {
                        window.dbBookedSlots = data.booked_slots;
                    } else {
                        window.dbBookedSlots = {};
                    }
                    updateAllCourtCards();

                    const alertBox = document.getElementById('filterStatusAlert');
                    const alertText = document.getElementById('filterStatusText');
                    alertBox.classList.remove('hidden');
                    alertText.innerHTML = `<strong>Đã áp dụng bộ lọc:</strong> Ngày <strong>${selectedDate}</strong> lúc <strong>${selectedStartTime}</strong> (${selectedDuration} phút)`;
                })
                .catch(() => {
                    updateAllCourtCards();
                })
                .finally(() => {
                    btnFilter.disabled = false;
                    btnFilter.innerHTML = originalHtml;
                });
            });

            // Nút đặt lại bộ lọc
            document.getElementById('btnResetFilter').addEventListener('click', function () {
                document.getElementById('bookingDateInput').value = window.serverCurrentDate;
                selectedDate = window.serverCurrentDate;

                populateStartTimeOptions();
                selectedSport = 'all';
                searchQuery = '';
                document.getElementById('courtSearchInput').value = '';

                document.querySelectorAll('.sport-filter-btn').forEach(b => {
                    b.classList.remove('bg-primary', 'text-white');
                    b.classList.add('bg-[#f0f4f1]', 'text-on-surface');
                });
                const allBtn = document.querySelector('.sport-filter-btn[data-sport="all"]');
                if (allBtn) {
                    allBtn.classList.add('bg-primary', 'text-white');
                    allBtn.classList.remove('bg-[#f0f4f1]', 'text-on-surface');
                }

                document.getElementById('filterStatusAlert').classList.add('hidden');
                updateAllCourtCards();
            });

            // Thay đổi giờ chẵn qua select
            document.getElementById('bookingStartTimeInput').addEventListener('change', function () {
                selectedStartTime = this.value;
                updateAllCourtCards();
            });

            // Chọn thời lượng
            document.querySelectorAll('.duration-btn').forEach(btn => {
                btn.addEventListener('click', function () {
                    document.querySelectorAll('.duration-btn').forEach(b => {
                        b.classList.remove('bg-primary', 'text-white', 'font-bold', 'shadow-xs');
                        b.classList.add('text-on-surface', 'font-semibold');
                    });
                    this.classList.add('bg-primary', 'text-white', 'font-bold', 'shadow-xs');
                    this.classList.remove('text-on-surface', 'font-semibold');

                    selectedDuration = parseInt(this.getAttribute('data-duration'), 10) || 90;
                    updateAllCourtCards();
                });
            });

            // Lọc môn thể thao
            document.querySelectorAll('.sport-filter-btn').forEach(btn => {
                btn.addEventListener('click', function () {
                    document.querySelectorAll('.sport-filter-btn').forEach(b => {
                        b.classList.remove('bg-primary', 'text-white');
                        b.classList.add('bg-[#f0f4f1]', 'text-on-surface');
                    });
                    this.classList.add('bg-primary', 'text-white');
                    this.classList.remove('bg-[#f0f4f1]', 'text-on-surface');

                    selectedSport = this.getAttribute('data-sport');
                    updateAllCourtCards();
                });
            });

            // Tìm kiếm nhanh tên sân
            document.getElementById('courtSearchInput').addEventListener('input', function () {
                searchQuery = this.value.toLowerCase().trim();
                updateAllCourtCards();
            });

            // Click nút 1-Click Snap liền kề trên card
            document.addEventListener('click', function (e) {
                if (e.target.closest('.btn-snap-adjacent')) {
                    const btn = e.target.closest('.btn-snap-adjacent');
                    const targetTime = btn.getAttribute('data-target-time');
                    document.getElementById('bookingStartTimeInput').value = targetTime;
                    selectedStartTime = targetTime;
                    updateAllCourtCards();
                } else if (e.target.closest('.btn-snap-safe')) {
                    const btn = e.target.closest('.btn-snap-safe');
                    const targetTime = btn.getAttribute('data-target-time');
                    document.getElementById('bookingStartTimeInput').value = targetTime;
                    selectedStartTime = targetTime;
                    updateAllCourtCards();
                } else if (e.target.closest('.btn-toggle-court-cart')) {
                    const btn = e.target.closest('.btn-toggle-court-cart');
                    if (btn.disabled || btn.classList.contains('cursor-not-allowed')) {
                        return;
                    }
                    const cId = btn.getAttribute('data-court-id');
                    const card = document.getElementById(`court-card-${cId}`);
                    const cName = card.getAttribute('data-court-name');
                    const cSport = card.getAttribute('data-sport');
                    const cPrice = parseFloat(card.getAttribute('data-court-price'));
                    const cStatus = card.getAttribute('data-court-status') || 'Hoạt động';

                    if (cStatus.trim().toLowerCase() !== 'hoạt động') {
                        alert(`Sân "${cName}" đang bảo trì, không thể đặt sân!`);
                        return;
                    }

                    const endTimeStr = calculateEndTime(selectedStartTime, selectedDuration);
                    const chosenStartMins = timeToMinutes(selectedStartTime);
                    const chosenEndMins = chosenStartMins + selectedDuration;

                    if (chosenEndMins > 27 * 60) {
                        alert(`Khung giờ bạn chọn (${selectedStartTime} - ${endTimeStr}) vượt quá giờ hoạt động của cụm sân (Đóng cửa lúc 03:00 khuya). Vui lòng chọn ca ngắn hơn!`);
                        return;
                    }

                    // 1. Kiểm tra an toàn: Ca này có bị trùng lịch trong CSDL không
                    const courtBookings = (window.dbBookedSlots && (window.dbBookedSlots[cId] || window.dbBookedSlots[String(cId)] || window.dbBookedSlots[Number(cId)]))
                        ? (window.dbBookedSlots[cId] || window.dbBookedSlots[String(cId)] || window.dbBookedSlots[Number(cId)])
                        : [];

                    const hasDbConflict = courtBookings.some(b => {
                        const bStartMins = timeToMinutes(b.start);
                        const bEndMins = timeToMinutes(b.end, true);
                        return Math.max(chosenStartMins, bStartMins) < Math.min(chosenEndMins, bEndMins);
                    });

                    if (hasDbConflict) {
                        alert(`Sân "${cName}" đã có người đặt trong khung giờ ${selectedStartTime} - ${endTimeStr}. Không thể thêm vào phiếu!`);
                        return;
                    }

                    // 2. Kiểm tra xem có để lại khoảng trống 30 phút lẻ không
                    let hasOrphanGap = false;
                    courtBookings.forEach(b => {
                        const bEndMins = timeToMinutes(b.end, true);
                        const bStartMins = timeToMinutes(b.start);
                        if (bEndMins <= chosenStartMins && (chosenStartMins - bEndMins) > 0 && (chosenStartMins - bEndMins) < 60) {
                            hasOrphanGap = true;
                        }
                        if (bStartMins >= chosenEndMins && (bStartMins - chosenEndMins) > 0 && (bStartMins - chosenEndMins) < 60) {
                            hasOrphanGap = true;
                        }
                    });

                    if (hasOrphanGap) {
                        alert(`Khung giờ ${selectedStartTime} - ${endTimeStr} để lại khoảng trống 30 phút lẻ khó xếp sân. Vui lòng bấm vào nút gợi ý đổi giờ trên sân để chọn khung giờ liền mạch!`);
                        return;
                    }

                    // 3. Tìm xem chính xác ca này của sân đã có trong giỏ chưa
                    const exactIndex = cart.findIndex(i => 
                        String(i.courtId) === String(cId) && 
                        i.startTime === selectedStartTime && 
                        i.endTime === endTimeStr
                    );

                    if (exactIndex > -1) {
                        // Đã có chính xác ca này -> bấm vào để xóa khỏi giỏ
                        cart.splice(exactIndex, 1);
                    } else {
                        // 3. Kiểm tra xem có bị trùng giờ với ca khác của cùng sân này trong giỏ không
                        const overlapInCart = cart.find(i => 
                            String(i.courtId) === String(cId) && 
                            Math.max(chosenStartMins, timeToMinutes(i.startTime)) < Math.min(chosenEndMins, timeToMinutes(i.endTime, true))
                        );

                        if (overlapInCart) {
                            alert(`Sân "${cName}" đã có ca ${overlapInCart.startTime} - ${overlapInCart.endTime} trong phiếu bị trùng giờ!`);
                            return;
                        }

                        // Thêm vào giỏ
                        const durationHours = selectedDuration / 60;
                        const itemTotal = Math.round(cPrice * durationHours);
                        const sportIcon = cSport === 'bong-da' ? '⚽' : (cSport === 'cau-long' ? '🏸' : '🎾');

                        cart.push({
                            courtId: cId,
                            courtName: cName,
                            sport: cSport,
                            sportIcon: sportIcon,
                            date: selectedDate,
                            startTime: selectedStartTime,
                            endTime: endTimeStr,
                            duration: selectedDuration,
                            price: cPrice,
                            total: itemTotal
                        });
                    }

                    renderReceipt();
                    updateAllCourtCards();
                }
            });

            // ================= MODAL VÀ LƯU VÀO CƠ SỞ DỮ LIỆU =================
            const checkoutModal = document.getElementById('checkoutModal');
            const btnOpenCheckoutModal = document.getElementById('btnOpenCheckoutModal');
            const btnCloseCheckoutModal = document.getElementById('btnCloseCheckoutModal');
            const btnCancelModal = document.getElementById('btnCancelModal');
            const bookingCheckoutForm = document.getElementById('bookingCheckoutForm');
            const modalItemList = document.getElementById('modalItemList');
            const modalTotalAmount = document.getElementById('modalTotalAmount');
            const formHiddenItems = document.getElementById('formHiddenItems');
            const formNgayDat = document.getElementById('formNgayDat');

            btnOpenCheckoutModal.addEventListener('click', function () {
                if (cart.length === 0) {
                    alert('Vui lòng chọn ít nhất 1 sân vào phiếu đặt.');
                    return;
                }

                formNgayDat.value = document.getElementById('bookingDateInput').value;
                formHiddenItems.innerHTML = '';
                modalItemList.innerHTML = '';

                let subtotal = 0;

                cart.forEach((item, index) => {
                    subtotal += item.total;

                    formHiddenItems.innerHTML += `
                        <input type="hidden" name="items[${index}][MaSan]" value="${item.courtId}">
                        <input type="hidden" name="items[${index}][GioBatDau]" value="${item.startTime}">
                        <input type="hidden" name="items[${index}][GioKetThuc]" value="${item.endTime}">
                        <input type="hidden" name="items[${index}][DonGia]" value="${item.price}">
                    `;

                    modalItemList.innerHTML += `
                        <div class="flex items-center justify-between text-xs py-1.5 border-b border-gray-200 last:border-0">
                            <div>
                                <span class="font-bold text-on-surface">${item.courtName}</span>
                                <span class="text-primary block">${item.startTime} - ${item.endTime} (${item.duration}p${timeToMinutes(item.startTime) >= 1440 ? ' • Sáng hôm sau' : (timeToMinutes(item.endTime) > 1440 ? ' • Hôm sau' : '')})</span>
                            </div>
                            <span class="font-extrabold text-on-surface">${new Intl.NumberFormat('vi-VN').format(item.total)}đ</span>
                        </div>
                    `;
                });

                const discountAmount = Math.round(subtotal * (discountPercent / 100));
                const finalTotal = subtotal - discountAmount;
                modalTotalAmount.textContent = new Intl.NumberFormat('vi-VN').format(finalTotal) + 'đ';

                checkoutModal.classList.remove('hidden');
            });

            function closeModal() {
                checkoutModal.classList.add('hidden');
            }

            btnCloseCheckoutModal.addEventListener('click', closeModal);
            btnCancelModal.addEventListener('click', closeModal);

            // Gửi form lưu database
            bookingCheckoutForm.addEventListener('submit', function (e) {
                e.preventDefault();

                const btnSubmit = document.getElementById('btnSubmitBooking');
                btnSubmit.disabled = true;
                btnSubmit.innerHTML = '<span class="material-symbols-outlined text-[18px] animate-spin">refresh</span> Đang lưu vào hệ thống...';

                const formData = new FormData(bookingCheckoutForm);

                fetch(bookingCheckoutForm.action, {
                    method: 'POST',
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        closeModal();
                        cart = []; // Reset giỏ
                        renderReceipt();
                        // Cập nhật lại dbBookedSlots từ server ngay lập tức
                        fetch(`{{ route('booking.slots') }}?date=${selectedDate}`, {
                            headers: { 'Accept': 'application/json' }
                        })
                        .then(res => res.json())
                        .then(slotData => {
                            if (slotData && slotData.booked_slots) {
                                window.dbBookedSlots = slotData.booked_slots;
                            }
                            updateAllCourtCards();
                        })
                        .catch(() => {
                            updateAllCourtCards();
                        });

                        // Thông báo thành công
                        const alertBox = document.createElement('div');
                        alertBox.className = 'fixed top-6 right-6 z-50 bg-emerald-600 text-white p-5 rounded-2xl shadow-2xl max-w-md animate-in slide-in-from-top-4 duration-300';
                        alertBox.innerHTML = `
                            <div class="flex items-start gap-3">
                                <span class="material-symbols-outlined text-3xl">task_alt</span>
                                <div>
                                    <h4 class="font-bold text-base mb-1">Đặt sân thành công!</h4>
                                    <p class="text-xs text-emerald-100 mb-2">${data.message}</p>
                                    <p class="text-xs text-emerald-200">Tổng tiền: <strong>${new Intl.NumberFormat('vi-VN').format(data.total)}đ</strong>. Phiếu đặt đã được ghi nhận vào cơ sở dữ liệu.</p>
                                </div>
                            </div>
                        `;
                        document.body.appendChild(alertBox);
                        setTimeout(() => alertBox.remove(), 6000);
                    } else {
                        alert(data.message || 'Đã có lỗi xảy ra khi lưu phiếu đặt.');
                        btnSubmit.disabled = false;
                        btnSubmit.innerHTML = '<span class="material-symbols-outlined text-[18px]">check_circle</span> Hoàn tất đặt sân ngay';
                    }
                })
                .catch(error => {
                    console.error('Lỗi:', error);
                    alert('Lỗi kết nối máy chủ khi lưu phiếu đặt.');
                    btnSubmit.disabled = false;
                    btnSubmit.innerHTML = '<span class="material-symbols-outlined text-[18px]">check_circle</span> Hoàn tất đặt sân ngay';
                });
            });

            // Khởi chạy ban đầu
            populateStartTimeOptions();
            renderReceipt();
            updateAllCourtCards();
        });
    </script>
</body>
</html>
