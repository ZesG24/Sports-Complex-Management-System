<!DOCTYPE html>
<html class="light" lang="vi">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Đặt sân thể thao đa năng - Thể thao Anh Vinh</title>

    <!-- Google Fonts: Space Grotesk & Be Vietnam Pro -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Be+Vietnam+Pro:wght@400;500;600;700&family=Space+Grotesk:wght@500;600;700&display=swap" rel="stylesheet">

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com?plugins=forms"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: {
                        'turf': '#14261e',
                        'turf-hover': '#07281c',
                        'clay': '#b02d1c',
                        'clay-hover': '#8e1306',
                        'stone-canvas': '#faf9f4',
                        'stone-low': '#f5f4ef',
                        'stone-high': '#e9e8e3',
                        'ink': '#1b1c19',
                        'muted': '#424844',
                        'subtle': '#737874',
                        'line': '#c2c8c3',
                    },
                    fontFamily: {
                        display: ['"Space Grotesk"', 'sans-serif'],
                        sans: ['"Be Vietnam Pro"', 'sans-serif'],
                    }
                }
            }
        }
    </script>
    <style>
        .striped-booked {
            background-color: #dbdad5;
            background-image: repeating-linear-gradient(
                -45deg,
                #e3e3de,
                #e3e3de 6px,
                #cfd1cb 6px,
                #cfd1cb 12px
            );
        }
    </style>
</head>

<body class="bg-stone-canvas text-ink font-sans antialiased min-h-screen flex flex-col">

    @include('partials.header')

    @if (session('success'))
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-4 w-full">
            <div class="bg-white border-2 border-turf text-turf px-4 py-3 rounded-[6px] flex items-center justify-between">
                <div class="flex items-center gap-2.5">
                    <span class="w-2.5 h-2.5 rounded-full bg-emerald-600 shrink-0"></span>
                    <span class="font-semibold text-sm">{{ session('success') }}</span>
                </div>
                <button type="button" onclick="this.parentElement.remove()" class="text-subtle hover:text-ink p-1 cursor-pointer" aria-label="Đóng thông báo">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    @endif

    <!-- ==================== MAIN CONTENT ==================== -->
    <main class="grow max-w-7xl w-full mx-auto px-4 sm:px-6 lg:px-8 py-8 space-y-6">

        <!-- 1. TIÊU ĐỀ TRANG -->
        <section class="flex flex-col md:flex-row md:items-end justify-between gap-4">
            <div class="space-y-1.5">
                <div class="flex items-center gap-2 text-xs font-medium text-subtle">
                    <a href="{{ route('home') }}" class="hover:text-turf transition-colors">Trang chủ</a>
                    <span>/</span>
                    <span class="text-muted font-semibold">Đặt sân thể thao</span>
                </div>
                <h1 class="font-display text-2xl sm:text-3xl font-bold text-turf tracking-tight">
                    Đặt sân thể thao đa năng
                </h1>
                <p class="text-sm text-muted max-w-2xl">
                    Khung giờ hoạt động: <strong class="font-display text-turf">05:00 – 01:00</strong> sáng hôm sau. Đặt nhiều sân cùng lúc trong một phiếu.
                </p>
            </div>
        </section>

        <!-- 2. BỘ LỌC SÂN & CHỌN GIỜ -->
        <section class="bg-white border border-line rounded-[6px] p-4 sm:p-5 space-y-4">
            <!-- Hàng 1: Ngày, Giờ bắt đầu, Thời lượng & Nút Lọc -->
            <div class="grid grid-cols-1 md:grid-cols-12 gap-4 items-end">
                <!-- Ngày đặt sân -->
                <div class="md:col-span-3 space-y-1.5">
                    <label for="bookingDateInput" class="block font-display text-xs font-bold text-turf tracking-wide uppercase">
                        NGÀY ĐẶT SÂN
                    </label>
                    <div class="relative flex items-center">
                        <span class="absolute left-3 text-subtle pointer-events-none">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5" />
                            </svg>
                        </span>
                        <input type="date" id="bookingDateInput"
                               value="{{ $selectedDate ?? date('Y-m-d') }}"
                               min="{{ date('Y-m-d') }}"
                               class="w-full pl-9 pr-3 py-2 font-display text-sm font-semibold text-turf bg-stone-canvas border border-line rounded-[4px] focus:ring-1 focus:ring-turf focus:border-turf cursor-pointer">
                    </div>
                </div>

                <!-- Giờ bắt đầu -->
                <div class="md:col-span-3 space-y-1.5">
                    <label for="bookingStartTimeInput" class="block font-display text-xs font-bold text-turf tracking-wide uppercase">
                        GIỜ BẮT ĐẦU
                    </label>
                    <div class="relative flex items-center">
                        <span class="absolute left-3 text-subtle pointer-events-none">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </span>
                        <select id="bookingStartTimeInput"
                                class="w-full pl-9 pr-8 py-2 font-display text-sm font-semibold text-turf bg-stone-canvas border border-line rounded-[4px] focus:ring-1 focus:ring-turf focus:border-turf appearance-none cursor-pointer">
                        </select>
                        <span class="absolute right-3 text-subtle pointer-events-none">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                            </svg>
                        </span>
                    </div>
                </div>

                <!-- Thời lượng -->
                <div class="md:col-span-4 space-y-1.5">
                    <div class="flex items-center justify-between">
                        <span class="font-display text-xs font-bold text-turf tracking-wide uppercase">
                            THỜI LƯỢNG
                        </span>
                        <span class="text-[11px] text-subtle font-medium">Tối thiểu 60p</span>
                    </div>
                    <div class="grid grid-cols-4 gap-1.5" id="durationButtonGroup">
                        <button type="button" data-duration="60" class="duration-btn py-2 font-display text-xs font-semibold text-turf bg-stone-canvas border border-line hover:bg-stone-high rounded-[4px] transition-colors cursor-pointer">
                            60p
                        </button>
                        <button type="button" data-duration="90" class="duration-btn py-2 font-display text-xs font-semibold bg-turf text-white border border-turf rounded-[4px] transition-colors cursor-pointer">
                            90p
                        </button>
                        <button type="button" data-duration="120" class="duration-btn py-2 font-display text-xs font-semibold text-turf bg-stone-canvas border border-line hover:bg-stone-high rounded-[4px] transition-colors cursor-pointer">
                            120p
                        </button>
                        <button type="button" data-duration="180" class="duration-btn py-2 font-display text-xs font-semibold text-turf bg-stone-canvas border border-line hover:bg-stone-high rounded-[4px] transition-colors cursor-pointer">
                            180p
                        </button>
                    </div>
                </div>

                <!-- Nút Lọc sân -->
                <div class="md:col-span-2">
                    <button type="button" id="btnFilterApply" class="w-full flex items-center justify-center gap-2 bg-clay hover:bg-clay-hover text-white font-display text-sm font-semibold px-5 py-2 rounded-[6px] transition-colors cursor-pointer h-[38px]">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 3c2.755 0 5.455.232 8.083.678.533.09.917.556.917 1.096v1.044a2.25 2.25 0 01-.659 1.591l-5.432 5.432a2.25 2.25 0 00-.659 1.591v2.927a2.25 2.25 0 01-1.244 2.013L9.75 21v-6.568a2.25 2.25 0 00-.659-1.591L3.659 7.409A2.25 2.25 0 013 5.818V4.774c0-.54.384-1.006.917-1.096A48.32 48.32 0 0112 3z" />
                        </svg>
                        <span>Lọc sân</span>
                    </button>
                </div>
            </div>

            <!-- Hàng 2: Lọc theo bộ môn & Tìm tên sân -->
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 pt-3 border-t border-line/70">
                <div class="flex flex-wrap items-center gap-2" id="sportFilters">
                    <button type="button" data-sport="all" class="sport-filter-btn px-3.5 py-1.5 font-display text-xs font-bold rounded-[4px] bg-turf text-white border border-turf transition-colors cursor-pointer">
                        Tất cả môn ({{ count($allSan) }})
                    </button>
                    <button type="button" data-sport="bong-da" class="sport-filter-btn px-3.5 py-1.5 font-display text-xs font-semibold rounded-[4px] bg-stone-canvas text-turf border border-line hover:bg-stone-high transition-colors cursor-pointer">
                        Bóng đá ({{ $allSan->where('MaLoai', 1)->count() }})
                    </button>
                    <button type="button" data-sport="cau-long" class="sport-filter-btn px-3.5 py-1.5 font-display text-xs font-semibold rounded-[4px] bg-stone-canvas text-turf border border-line hover:bg-stone-high transition-colors cursor-pointer">
                        Cầu lông ({{ $allSan->where('MaLoai', 2)->count() }})
                    </button>
                    <button type="button" data-sport="pickleball" class="sport-filter-btn px-3.5 py-1.5 font-display text-xs font-semibold rounded-[4px] bg-stone-canvas text-turf border border-line hover:bg-stone-high transition-colors cursor-pointer">
                        Pickleball ({{ $allSan->where('MaLoai', 3)->count() }})
                    </button>
                </div>

                <div class="relative w-full sm:w-64">
                    <span class="absolute left-3 top-1/2 -translate-y-1/2 text-subtle pointer-events-none">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                        </svg>
                    </span>
                    <input type="text" id="courtSearchInput"
                           class="w-full pl-9 pr-3 py-1.5 text-xs bg-stone-canvas border border-line rounded-[4px] focus:ring-1 focus:ring-turf focus:border-turf text-ink placeholder:text-subtle"
                           placeholder="Tìm tên sân...">
                </div>
            </div>
        </section>

        <!-- 3. CHÚ THÍCH TRẠNG THÁI TIMELINE -->
        <section class="bg-white border border-line rounded-[6px] px-4 py-2.5 flex flex-wrap items-center justify-between gap-3 text-xs">
            <div class="font-display font-bold text-turf flex items-center gap-2">
                <span class="w-2 h-2 rounded-full bg-turf"></span>
                <span>Danh sách sân · <span id="visibleCourtCountBadge">{{ count($allSan) }} sân</span></span>
            </div>

            <div class="flex flex-wrap items-center gap-4 font-display text-xs font-medium text-muted">
                <div class="flex items-center gap-1.5">
                    <span class="w-4 h-3.5 rounded-[2px] bg-stone-high border border-line"></span>
                    <span>Đã qua</span>
                </div>
                <div class="flex items-center gap-1.5">
                    <span class="w-4 h-3.5 rounded-[2px] striped-booked border border-line"></span>
                    <span>Đã có người đặt</span>
                </div>
                <div class="flex items-center gap-1.5">
                    <span class="w-4 h-3.5 rounded-[2px] bg-[#E5A93C] border border-[#B47C1C]"></span>
                    <span>Đang giữ chỗ</span>
                </div>
                <div class="flex items-center gap-1.5">
                    <span class="w-4 h-3.5 rounded-[2px] bg-turf border border-clay"></span>
                    <span>Đang chọn / Trong phiếu</span>
                </div>
                <div class="flex items-center gap-1.5">
                    <span class="w-4 h-3.5 rounded-[2px] bg-stone-low border border-line"></span>
                    <span>Trống</span>
                </div>
            </div>
        </section>

        <!-- 4. DANH SÁCH SÂN VỚI TIMELINE 2 TẦNG (05:00 → 01:00 FULL-WIDTH KHÔNG CUỘN NGANG) -->
        <section class="space-y-4" id="courtContainer">
            @foreach ($allSan as $san)
                @php
                    $sportCode = $san->MaLoai == 1 ? 'bong-da' : ($san->MaLoai == 2 ? 'cau-long' : 'pickleball');
                    $sportName = $san->loaiSan->TenLoai ?? ($san->MaLoai == 1 ? 'Bóng đá' : ($san->MaLoai == 2 ? 'Cầu lông' : 'Pickleball'));
                    $rawStatus = mb_strtolower(trim($san->TinhTrang ?? 'hoạt động'));
                    $isMaintenance = in_array($rawStatus, ['bảo trì', 'baotri', 'bao_tri'], true);
                @endphp
                <article class="court-card bg-white border border-line rounded-[6px] p-4 flex flex-col lg:flex-row gap-5 transition-colors"
                         data-court-id="{{ $san->MaSan }}"
                         data-sport="{{ $sportCode }}"
                         data-sport-label="{{ $sportName }}"
                         data-court-name="{{ $san->TenSan }}"
                         data-court-price="{{ $san->GiaThue }}"
                         data-court-status="{{ $san->TinhTrang }}"
                         id="court-card-{{ $san->MaSan }}">

                    <!-- Ảnh sân góc trái -->
                    <div class="relative w-full lg:w-64 h-44 shrink-0 rounded-[4px] overflow-hidden bg-stone-high border border-line/60">
                        <img src="{{ $san->HinhAnh ?? 'https://images.unsplash.com/photo-1529900748604-07564a03e7a6?auto=format&fit=crop&w=800&q=80' }}"
                             alt="{{ $san->TenSan }}"
                             class="w-full h-full object-cover">
                        @if (!$isMaintenance)
                            <span class="absolute top-2.5 left-2.5 bg-turf text-white font-display text-[10px] uppercase font-bold tracking-wider px-2 py-0.5 rounded-[3px]">
                                HOẠT ĐỘNG
                            </span>
                        @else
                            <span class="absolute top-2.5 left-2.5 bg-stone-high text-muted border border-line font-display text-[10px] uppercase font-bold tracking-wider px-2 py-0.5 rounded-[3px]">
                                BẢO TRÌ
                            </span>
                        @endif
                    </div>

                    <!-- Chi tiết sân & Timeline 2 tầng bên phải -->
                    <div class="grow flex flex-col justify-between space-y-3 min-w-0">
                        <!-- Tiêu đề + Giá -->
                        <div class="flex items-start justify-between gap-4">
                            <div class="min-w-0">
                                <div class="flex flex-wrap items-center gap-2">
                                    <h2 class="font-display text-base md:text-lg font-bold text-turf">
                                        {{ $san->TenSan }}
                                    </h2>
                                    <span class="bg-stone-low text-muted font-display text-[11px] px-2 py-0.5 rounded-[3px] border border-line/80 font-semibold">
                                        {{ $sportName }}
                                    </span>
                                </div>
                                @if($san->MoTa)
                                    <p class="text-xs text-subtle mt-0.5 line-clamp-1">
                                        {{ $san->MoTa }}
                                    </p>
                                @endif
                            </div>

                            <div class="text-right shrink-0">
                                <span class="font-display text-lg font-bold text-clay">{{ number_format($san->GiaThue, 0, ',', '.') }}đ</span>
                                <span class="text-xs text-subtle">/h</span>
                            </div>
                        </div>

                        <!-- CỤM TIMELINE 2 TẦNG TOÀN DIỆN (100% FULL-WIDTH, 05:00 → 01:00, KHÔNG CUỘN NGANG) -->
                        <div class="w-full select-none pt-0.5">
                            <!-- Tầng 1: Thước đo 10 khoảng đều nhau (mỗi khoảng = 10% = 2 giờ) -->
                            <div class="w-full grid grid-cols-10 text-[10px] sm:text-[11px] font-display font-semibold text-subtle mb-1 border-b border-line/50 pb-1">
                                <div class="text-left">05:00</div>
                                <div class="text-left">07:00</div>
                                <div class="text-left">09:00</div>
                                <div class="text-left">11:00</div>
                                <div class="text-left">13:00</div>
                                <div class="text-left">15:00</div>
                                <div class="text-left">17:00</div>
                                <div class="text-left">19:00</div>
                                <div class="text-left">21:00</div>
                                <div class="flex justify-between">
                                    <span>23:00</span>
                                    <span>01:00</span>
                                </div>
                            </div>

                            <!-- Tầng 2: Thanh trạng thái gióng thẳng 1:1 với 10 cột mốc giờ phía trên -->
                            <div class="relative w-full h-9 bg-stone-low border border-line rounded-[4px] overflow-hidden">
                                <!-- Lưới dọc chia 10 khoảng cố định -->
                                <div class="absolute inset-0 grid grid-cols-10 pointer-events-none">
                                    @for ($col = 1; $col <= 9; $col++)
                                        <div class="border-r border-line/40 h-full"></div>
                                    @endfor
                                    <div class="h-full"></div>
                                </div>

                                <!-- Lớp render các khối giờ thực tế theo % -->
                                <div class="absolute inset-0" id="timeline-track-{{ $san->MaSan }}"></div>
                            </div>
                        </div>

                        <!-- Hộp cảnh báo khi để lại khoảng trống 30 phút lẻ -->
                        <div class="anti-orphan-warning-banner hidden bg-[#FEF3C7]/70 border border-[#F59E0B] rounded-[4px] px-3 py-2.5" id="warning-banner-{{ $san->MaSan }}">
                            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-2.5 text-xs">
                                <p class="text-[#92400E] font-medium" id="warning-text-{{ $san->MaSan }}">
                                    Lịch đặt để lại khoảng trống 30 phút lẻ. Vui lòng chọn gợi ý đổi giờ:
                                </p>
                                <div class="flex flex-wrap items-center gap-2 shrink-0">
                                    <button type="button" class="btn-snap-adjacent bg-turf hover:bg-turf-hover text-white font-display text-xs font-semibold px-3 py-1.5 rounded-[4px] transition-colors cursor-pointer" data-court-id="{{ $san->MaSan }}">
                                        Nối tiếp ca trước
                                    </button>
                                    <button type="button" class="btn-snap-safe bg-white hover:bg-stone-low border border-turf text-turf font-display text-xs font-semibold px-3 py-1.5 rounded-[4px] transition-colors cursor-pointer" data-court-id="{{ $san->MaSan }}">
                                        Lùi lại 60p
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Chân thẻ: Thông tin ca chọn & Nút hành động -->
                        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 pt-2 border-t border-line/60 text-xs">
                            <div class="flex flex-wrap items-center gap-2 font-display text-turf">
                                <span class="inline-block w-2 h-2 rounded-full bg-turf" id="status-dot-{{ $san->MaSan }}"></span>
                                <span class="font-bold">Ca chọn: <span id="slot-label-{{ $san->MaSan }}">--:-- → --:--</span></span>
                                <span class="text-subtle">·</span>
                                <span id="rule-tag-{{ $san->MaSan }}" class="font-semibold text-muted"></span>
                            </div>

                            <button type="button"
                                    class="btn-toggle-court-cart inline-flex items-center justify-center gap-1.5 px-4 py-1.5 rounded-[4px] bg-turf hover:bg-turf-hover text-white font-display text-xs font-bold transition-colors cursor-pointer shrink-0"
                                    data-court-id="{{ $san->MaSan }}"
                                    id="btn-cart-{{ $san->MaSan }}">
                                <span>+ Thêm vào phiếu đặt</span>
                            </button>
                        </div>
                    </div>
                </article>
            @endforeach
        </section>

        <!-- 5. PHIẾU ĐẶT SÂN CỦA BẠN (ĐẶT CỐ ĐỊNH TRONG LUỒNG TRANG NGAY TRÊN FOOTER) -->
        <section id="bookingReceiptSection" class="bg-white border-2 border-turf rounded-[6px] p-5 sm:p-6 my-8 space-y-5">
            <!-- Header Phiếu -->
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 pb-4 border-b border-line">
                <div class="flex items-start gap-3">
                    <div class="p-2 bg-turf text-white rounded-[4px] mt-0.5 shrink-0">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 002.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 00-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 00.75-.75 2.25 2.25 0 00-.1-.664m-5.8 0A2.251 2.251 0 0113.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25z" />
                        </svg>
                    </div>
                    <div>
                        <h2 class="font-display text-lg sm:text-xl font-bold text-turf">
                            Phiếu đặt sân của bạn
                        </h2>
                        <p class="text-xs text-subtle mt-0.5">
                            Mỗi sân được giữ chỗ tạm thời độc lập. Hoàn tất xác nhận trước khi hết thời gian giữ chỗ.
                        </p>
                    </div>
                </div>
                <div>
                    <span id="receiptBadgeCount" class="inline-block bg-turf text-white font-display text-xs font-bold px-3 py-1.5 rounded-[4px]">
                        0 sân đã chọn
                    </span>
                </div>
            </div>

            <!-- Trạng thái trống -->
            <div id="receiptEmptyPlaceholder" class="py-8 text-center text-subtle border border-dashed border-line rounded-[4px] bg-stone-canvas">
                <p class="font-display font-bold text-sm text-turf mb-1">Chưa có sân nào trong phiếu đặt</p>
                <p class="text-xs">Chọn ngày, khung giờ và bấm "+ Thêm vào phiếu đặt" ở danh sách sân phía trên.</p>
            </div>

            <!-- Lưới các ca sân đã chọn (Mỗi sân đếm ngược độc lập) -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 hidden" id="receiptCourtList"></div>

            <!-- Chân phiếu: Tổng tiền & CTA -->
            <div class="pt-4 border-t border-line flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                <div class="space-y-1">
                    <div class="flex flex-wrap items-center gap-x-4 gap-y-1 text-xs text-muted">
                        <span>Tạm tính (<span id="summaryCourtCount">0</span> sân): <strong class="font-display text-turf" id="summarySubtotal">0đ</strong></span>
                        @if($discountPercent > 0)
                            <span>Hội viên VIP giảm {{ rtrim(rtrim(number_format((float) $discountPercent, 2, '.', ''), '0'), '.') }}%: <strong class="font-display text-clay" id="summaryDiscount">-0đ</strong></span>
                        @endif
                    </div>
                    <div class="flex items-baseline gap-2 pt-0.5">
                        <span class="font-display text-xs font-bold text-subtle uppercase">TỔNG THANH TOÁN:</span>
                        <span class="font-display text-2xl font-bold text-turf" id="summaryTotal">0đ</span>
                    </div>
                </div>

                <div>
                    <button type="button" id="btnOpenCheckoutModal" disabled
                            class="w-full sm:w-auto bg-clay hover:bg-clay-hover text-white font-display font-bold px-7 py-3.5 rounded-[6px] text-sm inline-flex items-center justify-center gap-2 transition-colors disabled:opacity-40 disabled:cursor-not-allowed cursor-pointer">
                        <span>Tiến hành xác nhận đặt sân</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
                        </svg>
                    </button>
                </div>
            </div>
        </section>
    </main>

    <!-- ==================== MODAL XÁC NHẬN ĐẶT SÂN ==================== -->
    <div id="checkoutModal" class="fixed inset-0 z-50 hidden overflow-y-auto bg-black/60 flex items-center justify-center p-4" role="dialog" aria-modal="true" aria-labelledby="checkoutModalTitle">
        <div class="bg-white rounded-[6px] max-w-lg w-full p-6 border-2 border-turf relative">
            <button type="button" id="btnCloseCheckoutModal" class="absolute top-4 right-4 text-subtle hover:text-turf p-1 rounded-[4px] cursor-pointer" aria-label="Đóng hộp thoại">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>

            <div class="mb-4 pr-6">
                <h3 id="checkoutModalTitle" class="font-display text-lg font-bold text-turf">
                    Xác nhận thông tin đặt sân
                </h3>
                <p class="text-xs text-subtle mt-0.5">
                    Kiểm tra thông tin người đặt và các ca đã chọn trước khi hoàn tất.
                </p>
            </div>

            <form id="bookingCheckoutForm" action="{{ route('booking.store') }}" method="POST">
                @csrf
                <input type="hidden" name="NgayDat" id="formNgayDat" value="{{ $selectedDate ?? date('Y-m-d') }}">
                <div id="formHiddenItems"></div>

                <div class="space-y-3 mb-4">
                    <div>
                        <label for="formHoTen" class="block font-display text-xs font-bold text-turf uppercase mb-1">
                            Họ và tên người đặt <span class="text-clay">*</span>
                        </label>
                        <input type="text" id="formHoTen" name="HoTen"
                               value="{{ $userKhachHang->HoTen ?? (Auth::user()->TenDangNhap ?? '') }}"
                               required
                               class="w-full bg-stone-canvas border border-line rounded-[4px] px-3.5 py-2 text-sm font-medium focus:ring-1 focus:ring-turf focus:border-turf">
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                        <div>
                            <label for="formSDT" class="block font-display text-xs font-bold text-turf uppercase mb-1">
                                Số điện thoại <span class="text-clay">*</span>
                            </label>
                            <input type="tel" id="formSDT" name="SDT"
                                   value="{{ $userKhachHang->SDT ?? '' }}"
                                   required
                                   placeholder="0912345678"
                                   class="w-full bg-stone-canvas border border-line rounded-[4px] px-3.5 py-2 text-sm font-medium focus:ring-1 focus:ring-turf focus:border-turf">
                        </div>
                        <div>
                            <label for="formEmail" class="block font-display text-xs font-bold text-turf uppercase mb-1">
                                Email
                            </label>
                            <input type="email" id="formEmail" name="Email"
                                   value="{{ $userKhachHang->Email ?? '' }}"
                                   placeholder="email@example.com"
                                   class="w-full bg-stone-canvas border border-line rounded-[4px] px-3.5 py-2 text-sm font-medium focus:ring-1 focus:ring-turf focus:border-turf">
                        </div>
                    </div>

                    <div>
                        <label for="formGhiChu" class="block font-display text-xs font-bold text-turf uppercase mb-1">
                            Ghi chú (tùy chọn)
                        </label>
                        <input type="text" id="formGhiChu" name="GhiChu"
                               placeholder="Ghi chú thêm nếu có..."
                               class="w-full bg-stone-canvas border border-line rounded-[4px] px-3.5 py-2 text-sm font-medium focus:ring-1 focus:ring-turf focus:border-turf">
                    </div>
                </div>

                <!-- Danh sách sân tóm tắt trong modal -->
                <div class="bg-stone-low p-3 rounded-[4px] border border-line mb-4 max-h-44 overflow-y-auto" id="modalItemList"></div>

                <div class="flex items-center justify-between py-2.5 border-t border-line mb-4">
                    <span class="font-display text-xs font-bold text-subtle uppercase">TỔNG THANH TOÁN:</span>
                    <span class="font-display text-xl font-bold text-turf" id="modalTotalAmount">0đ</span>
                </div>

                <div class="flex items-center gap-3">
                    <button type="button" id="btnCancelModal" class="w-1/3 py-2.5 rounded-[6px] border border-line font-display text-xs font-bold text-turf hover:bg-stone-low transition-colors cursor-pointer">
                        Quay lại
                    </button>
                    <button type="submit" id="btnSubmitBooking" class="w-2/3 bg-clay hover:bg-clay-hover text-white py-2.5 rounded-[6px] font-display text-sm font-bold transition-colors inline-flex items-center justify-center gap-1.5 cursor-pointer">
                        <span>Hoàn tất đặt sân</span>
                    </button>
                </div>
            </form>
        </div>
    </div>

    @include('partials.footer')

    <script>
        window.dbBookedSlots = @json($bookedSlotsByCourt ?? []);
        window.dbHoldingSlots = @json($holdingSlotsByCourt ?? []);
        window.serverCurrentTime = "{{ date('H:i') }}";
        window.serverCurrentDate = "{{ date('Y-m-d') }}";
        window.holdSlotUrl = "{{ route('booking.hold') }}";
        window.releaseSlotUrl = "{{ route('booking.release') }}";
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            let selectedDate = document.getElementById('bookingDateInput').value;
            let selectedStartTime = '18:30';
            let selectedDuration = 90;
            let selectedSport = 'all';
            let searchQuery = '';
            const discountPercent = {{ (float) $discountPercent }};

            // Khung giờ hoạt động: 05:00 sáng -> 01:00 sáng hôm sau (20 giờ = 1200 phút)
            const DAY_START = 300;   // 05:00
            const DAY_END = 1500;    // 01:00 sáng hôm sau (25 * 60)
            const TOTAL_DAY_MINUTES = DAY_END - DAY_START; // 1200 phút

            // Giỏ hàng: mỗi phần tử giữ expiresAt độc lập riêng của sân đó
            let cart = [];

            const ICON_TRASH = '<svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"/></svg>';
            const ICON_CLOCK = '<svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>';
            const ICON_LOCK = '<svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z"/></svg>';

            function formatVnd(amount) {
                return new Intl.NumberFormat('vi-VN').format(amount) + 'đ';
            }

            function getNowTimeStr() {
                const now = new Date();
                const h = String(now.getHours()).padStart(2, '0');
                const m = String(now.getMinutes()).padStart(2, '0');
                return `${h}:${m}`;
            }

            function isDateToday(dateStr) {
                return dateStr === window.serverCurrentDate;
            }

            function timeToMinutes(tStr) {
                if (!tStr) return 0;
                const parts = tStr.split(':').map(Number);
                let h = parts[0];
                const m = parts[1] || 0;
                if (h < 5) {
                    h += 24;
                }
                return h * 60 + m;
            }

            function minutesToTime(mins) {
                const totalMinutes = mins % 1440;
                const h = Math.floor(totalMinutes / 60);
                const m = totalMinutes % 60;
                return `${String(h).padStart(2, '0')}:${String(m).padStart(2, '0')}`;
            }

            function calculateEndTime(startTimeStr, durationMinutes) {
                return minutesToTime(timeToMinutes(startTimeStr) + durationMinutes);
            }

            function formatSeconds(sec) {
                const safeSec = Math.max(0, Math.floor(sec));
                const mins = Math.floor(safeSec / 60);
                const secs = safeSec % 60;
                return `${String(mins).padStart(2, '0')}:${String(secs).padStart(2, '0')}`;
            }

            function isCourtOperating(statusStr) {
                const normalized = String(statusStr || 'hoạt động').trim().toLowerCase();
                return !['bảo trì', 'baotri', 'bao_tri'].includes(normalized);
            }

            // Khôi phục các ca giữ chỗ của chính phiên hiện tại (nếu tải lại trang) với đúng thời gian đếm ngược riêng từng sân
            function restoreExistingMyHolds() {
                if (!window.dbHoldingSlots) return;
                Object.keys(window.dbHoldingSlots).forEach(cId => {
                    const holds = window.dbHoldingSlots[cId] || [];
                    const card = document.getElementById(`court-card-${cId}`);
                    if (!card) return;

                    const cName = card.getAttribute('data-court-name');
                    const cSport = card.getAttribute('data-sport');
                    const cSportLabel = card.getAttribute('data-sport-label') || 'THỂ THAO';
                    const cPrice = parseFloat(card.getAttribute('data-court-price'));

                    holds.forEach(h => {
                        if (!h.is_mine || !h.remaining_seconds || h.remaining_seconds <= 0) return;
                        const alreadyExists = cart.some(item =>
                            String(item.courtId) === String(cId) &&
                            item.startTime === h.start &&
                            item.endTime === h.end
                        );
                        if (alreadyExists) return;

                        const durationMins = Math.max(30, timeToMinutes(h.end) - timeToMinutes(h.start));
                        const itemTotal = Math.round(cPrice * (durationMins / 60));

                        cart.push({
                            courtId: String(cId),
                            courtName: cName,
                            sport: cSport,
                            sportLabel: cSportLabel,
                            date: selectedDate,
                            startTime: h.start,
                            endTime: h.end,
                            duration: durationMins,
                            price: cPrice,
                            total: itemTotal,
                            expiresAt: Date.now() + (h.remaining_seconds * 1000)
                        });
                    });
                });

                if (cart.length > 0) {
                    ensureHoldTickerRunning();
                }
            }

            // Khởi tạo danh sách khung giờ bắt đầu (:00 & :30 từ 05:00 đến 00:00)
            function populateStartTimeOptions() {
                const timeSelect = document.getElementById('bookingStartTimeInput');
                const isToday = isDateToday(document.getElementById('bookingDateInput').value);
                const nowMins = timeToMinutes(getNowTimeStr());
                const previousVal = timeSelect.value || selectedStartTime;

                timeSelect.innerHTML = '';
                let firstValidOption = null;

                const slots = [];
                for (let h = 5; h <= 23; h++) {
                    for (const m of [0, 30]) {
                        slots.push({ h, m, slotStr: `${String(h).padStart(2, '0')}:${String(m).padStart(2, '0')}` });
                    }
                }
                slots.push({ h: 0, m: 0, slotStr: '00:00' });

                slots.forEach(slot => {
                    const slotMins = timeToMinutes(slot.slotStr);
                    if (isToday && slotMins <= nowMins) {
                        return;
                    }

                    const opt = document.createElement('option');
                    opt.value = slot.slotStr;
                    opt.textContent = slot.h < 5 ? `${slot.slotStr} (Sáng hôm sau)` : slot.slotStr;

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

            // Cập nhật trạng thái toàn bộ thẻ sân & vẽ Timeline 2 tầng 1:1
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
                    const cStatus = card.getAttribute('data-court-status');
                    const operating = isCourtOperating(cStatus);

                    const matchSport = (selectedSport === 'all' || cSport === selectedSport);
                    const matchSearch = (!searchQuery || cName.toLowerCase().includes(searchQuery));

                    if (matchSport && matchSearch) {
                        card.classList.remove('hidden');
                        visibleCount++;
                    } else {
                        card.classList.add('hidden');
                        return;
                    }

                    const courtBookings = (window.dbBookedSlots && (window.dbBookedSlots[cId] || window.dbBookedSlots[String(cId)] || window.dbBookedSlots[Number(cId)])) || [];
                    const courtHolds = (window.dbHoldingSlots && (window.dbHoldingSlots[cId] || window.dbHoldingSlots[String(cId)] || window.dbHoldingSlots[Number(cId)])) || [];

                    const chosenStartMins = timeToMinutes(selectedStartTime);
                    const chosenEndMins = chosenStartMins + selectedDuration;
                    const isPastClosing = chosenEndMins > DAY_END;

                    // 1. Kiểm tra trùng lịch DB
                    let conflictingBooking = null;
                    let priorBooking = null;
                    let nextBooking = null;

                    courtBookings.forEach(b => {
                        const bStartMins = timeToMinutes(b.start);
                        const bEndMins = timeToMinutes(b.end);

                        if (Math.max(chosenStartMins, bStartMins) < Math.min(chosenEndMins, bEndMins)) {
                            conflictingBooking = b;
                        }
                        if (bEndMins <= chosenStartMins) {
                            if (!priorBooking || bEndMins > timeToMinutes(priorBooking.end)) {
                                priorBooking = b;
                            }
                        }
                        if (bStartMins >= chosenEndMins) {
                            if (!nextBooking || bStartMins < timeToMinutes(nextBooking.start)) {
                                nextBooking = b;
                            }
                        }
                    });

                    // 2. Kiểm tra khách khác giữ chỗ
                    let conflictingHold = null;
                    courtHolds.forEach(h => {
                        if (h.is_mine) return;
                        if (h.remaining_seconds !== undefined && h.remaining_seconds <= 0) return;
                        const hStartMins = timeToMinutes(h.start);
                        const hEndMins = timeToMinutes(h.end);
                        if (Math.max(chosenStartMins, hStartMins) < Math.min(chosenEndMins, hEndMins)) {
                            conflictingHold = h;
                        }
                    });

                    // 3. Kiểm tra ca trong giỏ hàng của chính mình
                    const isInCartThisSlot = cart.some(item =>
                        String(item.courtId) === String(cId) &&
                        item.date === selectedDate &&
                        item.startTime === selectedStartTime &&
                        item.endTime === endTimeStr
                    );

                    const cartOverlapItem = cart.find(item =>
                        String(item.courtId) === String(cId) &&
                        item.date === selectedDate &&
                        !isInCartThisSlot &&
                        Math.max(chosenStartMins, timeToMinutes(item.startTime)) < Math.min(chosenEndMins, timeToMinutes(item.endTime))
                    );

                    // 4. Quy tắc Anti-Orphan 30p
                    let gapMinutes = -1;
                    let isAntiOrphanDead = false;
                    let isAdjacentSnap = false;
                    let snapTargetTime = null;

                    if (!conflictingBooking && !conflictingHold && !cartOverlapItem && !isPastClosing) {
                        if (priorBooking) {
                            const gapBefore = chosenStartMins - timeToMinutes(priorBooking.end);
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

                    const timelineTrack = document.getElementById(`timeline-track-${cId}`);
                    const warningBanner = document.getElementById(`warning-banner-${cId}`);
                    const slotLabel = document.getElementById(`slot-label-${cId}`);
                    const ruleTag = document.getElementById(`rule-tag-${cId}`);
                    const statusDot = document.getElementById(`status-dot-${cId}`);
                    const btnCart = document.getElementById(`btn-cart-${cId}`);

                    if (!operating) {
                        warningBanner.classList.add('hidden');
                        slotLabel.textContent = '--:-- → --:--';
                        ruleTag.textContent = 'Đang bảo trì';
                        ruleTag.className = 'font-semibold text-subtle';
                        statusDot.className = 'inline-block w-2 h-2 rounded-full bg-subtle';
                        timelineTrack.innerHTML = '<div class="w-full h-full flex items-center justify-center text-xs font-semibold text-subtle bg-stone-high">Đang tạm ngưng bảo trì</div>';
                        btnCart.disabled = true;
                        btnCart.className = 'btn-toggle-court-cart inline-flex items-center justify-center gap-1.5 px-4 py-1.5 rounded-[4px] bg-stone-high text-subtle font-display text-xs font-semibold cursor-not-allowed shrink-0';
                        btnCart.innerHTML = '<span>Bảo trì</span>';
                        return;
                    }

                    slotLabel.textContent = `${selectedStartTime} → ${endTimeStr} (${selectedDuration}p)`;

                    if (conflictingBooking) {
                        warningBanner.classList.add('hidden');
                        statusDot.className = 'inline-block w-2 h-2 rounded-full bg-clay';
                        ruleTag.className = 'font-semibold text-clay';
                        ruleTag.textContent = `Đã có người đặt (${conflictingBooking.start} - ${conflictingBooking.end})`;
                        btnCart.disabled = true;
                        btnCart.className = 'btn-toggle-court-cart inline-flex items-center justify-center gap-1.5 px-4 py-1.5 rounded-[4px] bg-stone-high text-subtle font-display text-xs font-semibold cursor-not-allowed shrink-0';
                        btnCart.innerHTML = '<span>Đã kín lịch</span>';

                    } else if (conflictingHold) {
                        warningBanner.classList.add('hidden');
                        const remainStr = formatSeconds(conflictingHold.remaining_seconds || 0);
                        statusDot.className = 'inline-block w-2 h-2 rounded-full bg-[#E5A93C]';
                        ruleTag.className = 'font-semibold text-[#92400E]';
                        ruleTag.textContent = `Khách khác đang giữ (${remainStr})`;
                        btnCart.disabled = true;
                        btnCart.className = 'btn-toggle-court-cart inline-flex items-center justify-center gap-1.5 px-4 py-1.5 rounded-[4px] bg-stone-high text-subtle font-display text-xs font-semibold cursor-not-allowed shrink-0';
                        btnCart.innerHTML = `${ICON_LOCK}<span>Đang giữ (${remainStr})</span>`;

                    } else if (isPastClosing) {
                        warningBanner.classList.add('hidden');
                        statusDot.className = 'inline-block w-2 h-2 rounded-full bg-clay';
                        ruleTag.className = 'font-semibold text-clay';
                        ruleTag.textContent = 'Vượt quá giờ đóng cửa (01:00)';
                        btnCart.disabled = true;
                        btnCart.className = 'btn-toggle-court-cart inline-flex items-center justify-center gap-1.5 px-4 py-1.5 rounded-[4px] bg-stone-high text-subtle font-display text-xs font-semibold cursor-not-allowed shrink-0';
                        btnCart.innerHTML = '<span>Quá giờ đóng cửa</span>';

                    } else if (cartOverlapItem) {
                        warningBanner.classList.add('hidden');
                        statusDot.className = 'inline-block w-2 h-2 rounded-full bg-[#E5A93C]';
                        ruleTag.className = 'font-semibold text-[#92400E]';
                        ruleTag.textContent = `Trùng ca trong phiếu (${cartOverlapItem.startTime} - ${cartOverlapItem.endTime})`;
                        btnCart.disabled = true;
                        btnCart.className = 'btn-toggle-court-cart inline-flex items-center justify-center gap-1.5 px-4 py-1.5 rounded-[4px] bg-stone-high text-subtle font-display text-xs font-semibold cursor-not-allowed shrink-0';
                        btnCart.innerHTML = '<span>Trùng ca trong phiếu</span>';

                    } else if (isInCartThisSlot) {
                        warningBanner.classList.add('hidden');
                        statusDot.className = 'inline-block w-2 h-2 rounded-full bg-clay';
                        ruleTag.className = 'font-semibold text-clay';
                        ruleTag.textContent = 'Đã trong phiếu';
                        btnCart.disabled = false;
                        btnCart.className = 'btn-toggle-court-cart inline-flex items-center justify-center gap-1.5 px-3.5 py-1.5 rounded-[4px] border border-clay text-clay hover:bg-clay/10 font-display text-xs font-bold transition-colors cursor-pointer shrink-0';
                        btnCart.innerHTML = `${ICON_TRASH}<span>Đã chọn (Bấm để xóa)</span>`;

                    } else if (isAntiOrphanDead && snapTargetTime) {
                        warningBanner.classList.remove('hidden');
                        document.getElementById(`warning-text-${cId}`).innerHTML = `Lịch đặt để lại khoảng trống <strong>${gapMinutes} phút lẻ</strong>. Chọn gợi ý đổi giờ:`;

                        const snapBtn = warningBanner.querySelector('.btn-snap-adjacent');
                        snapBtn.setAttribute('data-target-time', snapTargetTime);
                        snapBtn.textContent = `Nối tiếp từ ${snapTargetTime}`;

                        const safeTime = minutesToTime(timeToMinutes(snapTargetTime) + 60);
                        const safeBtn = warningBanner.querySelector('.btn-snap-safe');
                        safeBtn.setAttribute('data-target-time', safeTime);
                        safeBtn.textContent = `Lùi lại từ ${safeTime}`;

                        statusDot.className = 'inline-block w-2 h-2 rounded-full bg-[#E5A93C]';
                        ruleTag.className = 'font-semibold text-[#92400E]';
                        ruleTag.textContent = 'Cần đổi giờ liền mạch';
                        btnCart.disabled = true;
                        btnCart.className = 'btn-toggle-court-cart inline-flex items-center justify-center gap-1.5 px-4 py-1.5 rounded-[4px] bg-stone-high text-subtle font-display text-xs font-semibold cursor-not-allowed shrink-0';
                        btnCart.innerHTML = '<span>Chọn gợi ý đổi giờ</span>';

                    } else if (isAdjacentSnap) {
                        warningBanner.classList.add('hidden');
                        statusDot.className = 'inline-block w-2 h-2 rounded-full bg-emerald-600';
                        ruleTag.className = 'font-semibold text-muted';
                        ruleTag.textContent = 'Giờ đặt liền mạch (0 phút trống)';
                        btnCart.disabled = false;
                        btnCart.className = 'btn-toggle-court-cart inline-flex items-center justify-center gap-1.5 px-4 py-1.5 rounded-[4px] bg-turf hover:bg-turf-hover text-white font-display text-xs font-bold transition-colors cursor-pointer shrink-0';
                        btnCart.innerHTML = '<span>+ Thêm vào phiếu đặt</span>';

                    } else {
                        warningBanner.classList.add('hidden');
                        statusDot.className = 'inline-block w-2 h-2 rounded-full bg-emerald-600';
                        ruleTag.className = 'font-semibold text-muted';
                        ruleTag.textContent = 'Khung giờ hợp lệ';
                        btnCart.disabled = false;
                        btnCart.className = 'btn-toggle-court-cart inline-flex items-center justify-center gap-1.5 px-4 py-1.5 rounded-[4px] bg-turf hover:bg-turf-hover text-white font-display text-xs font-bold transition-colors cursor-pointer shrink-0';
                        btnCart.innerHTML = '<span>+ Thêm vào phiếu đặt</span>';
                    }

                    // ================= RENDER TIMELINE TRACK (1:1 VỚI MỐC 05:00 → 01:00) =================
                    timelineTrack.innerHTML = '';

                    // 1. Vùng thời gian đã qua trong ngày
                    if (isToday && nowMinutes > DAY_START) {
                        const pastEnd = Math.min(nowMinutes, DAY_END);
                        const widthPct = ((pastEnd - DAY_START) / TOTAL_DAY_MINUTES) * 100;
                        const pastEl = document.createElement('div');
                        pastEl.className = 'absolute top-0 bottom-0 left-0 bg-stone-high/90 border-r border-line flex items-center justify-center font-display text-[10px] text-subtle font-semibold';
                        pastEl.style.width = `${widthPct}%`;
                        pastEl.title = 'Thời gian đã qua';
                        if (widthPct >= 10) {
                            pastEl.textContent = 'Đã qua';
                        }
                        timelineTrack.appendChild(pastEl);
                    }

                    // 2. Các ca đã có người đặt trong DB
                    courtBookings.forEach(b => {
                        const bStart = timeToMinutes(b.start);
                        const bEnd = timeToMinutes(b.end);
                        if (bEnd <= DAY_START || bStart >= DAY_END) return;

                        const startClamped = Math.max(DAY_START, bStart);
                        const endClamped = Math.min(DAY_END, bEnd);
                        const leftPct = ((startClamped - DAY_START) / TOTAL_DAY_MINUTES) * 100;
                        const widthPct = ((endClamped - startClamped) / TOTAL_DAY_MINUTES) * 100;

                        const isConflict = Boolean(conflictingBooking) && (Math.max(chosenStartMins, bStart) < Math.min(chosenEndMins, bEnd));
                        const bEl = document.createElement('div');
                        bEl.style.left = `${leftPct}%`;
                        bEl.style.width = `${widthPct}%`;
                        bEl.style.zIndex = '5';
                        bEl.title = `Đã có người đặt: ${b.start} - ${b.end}`;

                        if (isConflict) {
                            bEl.className = 'absolute top-0.5 bottom-0.5 bg-clay text-white border border-clay rounded-[2px] flex items-center justify-center font-display text-[10px] font-bold overflow-hidden';
                        } else {
                            bEl.className = 'absolute top-1 bottom-1 striped-booked text-muted border border-line rounded-[2px] flex items-center justify-center font-display text-[10px] font-semibold overflow-hidden';
                        }
                        if (widthPct >= 7) {
                            bEl.textContent = `${b.start}-${b.end}`;
                        }
                        timelineTrack.appendChild(bEl);
                    });

                    // 3. Các ca đang giữ chỗ tạm thời (Khách khác hoặc các ca khác trong giỏ của bạn)
                    courtHolds.forEach(h => {
                        if (h.remaining_seconds !== undefined && h.remaining_seconds <= 0) return;
                        const hStart = timeToMinutes(h.start);
                        const hEnd = timeToMinutes(h.end);
                        if (hEnd <= DAY_START || hStart >= DAY_END) return;

                        if (h.is_mine && h.start === selectedStartTime && h.end === endTimeStr) {
                            return;
                        }

                        const startClamped = Math.max(DAY_START, hStart);
                        const endClamped = Math.min(DAY_END, hEnd);
                        const leftPct = ((startClamped - DAY_START) / TOTAL_DAY_MINUTES) * 100;
                        const widthPct = ((endClamped - startClamped) / TOTAL_DAY_MINUTES) * 100;

                        const hEl = document.createElement('div');
                        hEl.style.left = `${leftPct}%`;
                        hEl.style.width = `${widthPct}%`;
                        hEl.style.zIndex = '6';

                        if (h.is_mine) {
                            hEl.className = 'absolute top-0.5 bottom-0.5 bg-turf text-white border-2 border-clay rounded-[3px] flex items-center justify-center font-display text-[10px] font-bold overflow-hidden';
                            hEl.title = `Trong phiếu của bạn: ${h.start} - ${h.end}`;
                            if (widthPct >= 6.5) {
                                hEl.textContent = `${h.start}-${h.end}`;
                            }
                        } else {
                            hEl.className = 'absolute top-0.5 bottom-0.5 bg-[#E5A93C] border border-[#B47C1C] text-turf rounded-[3px] flex items-center justify-center font-display text-[9.5px] font-bold overflow-hidden px-1';
                            hEl.title = `Khách khác đang giữ chỗ: ${h.start} - ${h.end}`;
                            if (widthPct >= 6.5) {
                                hEl.textContent = `Giữ ${h.start}-${h.end}`;
                            }
                        }
                        timelineTrack.appendChild(hEl);
                    });

                    // 4. Ca đang chọn hiện tại
                    if (!conflictingBooking && !conflictingHold && !cartOverlapItem && !isPastClosing) {
                        const selStart = Math.max(DAY_START, chosenStartMins);
                        const selEnd = Math.min(DAY_END, chosenEndMins);
                        const leftPct = ((selStart - DAY_START) / TOTAL_DAY_MINUTES) * 100;
                        const widthPct = ((selEnd - selStart) / TOTAL_DAY_MINUTES) * 100;

                        const selEl = document.createElement('div');
                        selEl.style.left = `${leftPct}%`;
                        selEl.style.width = `${widthPct}%`;
                        selEl.style.zIndex = '10';

                        if (isAntiOrphanDead) {
                            selEl.className = 'absolute top-0.5 bottom-0.5 bg-[#FEF3C7] border-2 border-dashed border-[#D97706] text-[#92400E] rounded-[3px] flex items-center justify-center font-display text-[10px] font-bold overflow-hidden px-1';
                            selEl.title = `Cần đổi giờ liền mạch: ${selectedStartTime} - ${endTimeStr}`;
                        } else {
                            selEl.className = 'absolute top-0.5 bottom-0.5 bg-turf border-2 border-clay text-white rounded-[3px] flex items-center justify-center font-display text-[10px] font-bold overflow-hidden px-1';
                            selEl.title = isInCartThisSlot
                                ? `Đã trong phiếu: ${selectedStartTime} - ${endTimeStr}`
                                : `Đang chọn: ${selectedStartTime} - ${endTimeStr}`;
                        }
                        if (widthPct >= 6) {
                            selEl.textContent = `${selectedStartTime}-${endTimeStr}`;
                        }
                        timelineTrack.appendChild(selEl);
                    }
                });

                document.getElementById('visibleCourtCountBadge').textContent = `${visibleCount} sân`;
            }

            // ================= ĐẾM NGƯỢC THỜI GIAN GIỮ CHỖ ĐỘC LẬP TỪNG SÂN =================
            function getItemRemainingSeconds(item) {
                if (!item.expiresAt) return 0;
                return Math.max(0, Math.floor((item.expiresAt - Date.now()) / 1000));
            }

            function getItemRemainingTimeStr(item) {
                return formatSeconds(getItemRemainingSeconds(item));
            }

            let holdTickerInterval = null;

            function ensureHoldTickerRunning() {
                if (holdTickerInterval) return;

                holdTickerInterval = setInterval(() => {
                    const now = Date.now();
                    let expiredItemsFound = false;

                    for (let i = cart.length - 1; i >= 0; i--) {
                        const item = cart[i];
                        if (item.expiresAt && item.expiresAt <= now) {
                            expiredItemsFound = true;
                            const expiredItem = cart.splice(i, 1)[0];

                            alert(`Sân "${expiredItem.courtName}" (${expiredItem.startTime} - ${expiredItem.endTime}) đã hết thời gian giữ chỗ và được nhả tự động.`);

                            fetch(window.releaseSlotUrl, {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'Accept': 'application/json',
                                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                                },
                                body: JSON.stringify({
                                    MaSan: expiredItem.courtId,
                                    NgayDat: expiredItem.date || selectedDate,
                                    GioBatDau: expiredItem.startTime,
                                    GioKetThuc: expiredItem.endTime
                                })
                            }).then(() => fetchLatestSlots());
                        }
                    }

                    // Đếm lùi cả thời gian giữ chỗ của khách khác trên giao diện
                    let otherHoldsActive = false;
                    if (window.dbHoldingSlots) {
                        Object.keys(window.dbHoldingSlots).forEach(cId => {
                            (window.dbHoldingSlots[cId] || []).forEach(h => {
                                if (!h.is_mine && h.remaining_seconds > 0) {
                                    h.remaining_seconds = Math.max(0, h.remaining_seconds - 1);
                                    otherHoldsActive = true;
                                }
                            });
                        });
                    }

                    if (expiredItemsFound) {
                        if (cart.length === 0) {
                            document.getElementById('checkoutModal').classList.add('hidden');
                        }
                        renderReceipt();
                        fetchLatestSlots();
                        return;
                    }

                    // Cập nhật đồng hồ riêng cho từng sân trong phiếu đặt & modal
                    cart.forEach(item => {
                        const timeStr = getItemRemainingTimeStr(item);
                        document.querySelectorAll(`.item-countdown[data-court-id="${item.courtId}"][data-start="${item.startTime}"]`).forEach(el => {
                            el.textContent = timeStr;
                        });
                    });

                    if (otherHoldsActive) {
                        updateAllCourtCards();
                    }

                    if (cart.length === 0 && !otherHoldsActive) {
                        clearInterval(holdTickerInterval);
                        holdTickerInterval = null;
                    }
                }, 1000);
            }

            // ================= RENDER PHIẾU ĐẶT SÂN TRÊN FOOTER =================
            function renderReceipt() {
                const listContainer = document.getElementById('receiptCourtList');
                const emptyPlaceholder = document.getElementById('receiptEmptyPlaceholder');
                const receiptBadgeCount = document.getElementById('receiptBadgeCount');
                const summaryCourtCount = document.getElementById('summaryCourtCount');
                const summarySubtotal = document.getElementById('summarySubtotal');
                const summaryDiscount = document.getElementById('summaryDiscount');
                const summaryTotal = document.getElementById('summaryTotal');
                const btnOpenCheckout = document.getElementById('btnOpenCheckoutModal');

                if (cart.length === 0) {
                    listContainer.innerHTML = '';
                    listContainer.classList.add('hidden');
                    emptyPlaceholder.classList.remove('hidden');

                    receiptBadgeCount.textContent = '0 sân đã chọn';
                    summaryCourtCount.textContent = '0';
                    summarySubtotal.textContent = '0đ';
                    if (summaryDiscount) summaryDiscount.textContent = '-0đ';
                    summaryTotal.textContent = '0đ';
                    btnOpenCheckout.disabled = true;
                    return;
                }

                emptyPlaceholder.classList.add('hidden');
                listContainer.classList.remove('hidden');
                btnOpenCheckout.disabled = false;
                listContainer.innerHTML = '';

                let subtotal = 0;

                cart.forEach((item, index) => {
                    subtotal += item.total;

                    const itemCard = document.createElement('div');
                    itemCard.className = 'p-4 bg-stone-canvas border border-line rounded-[4px] flex flex-col justify-between space-y-3';
                    itemCard.innerHTML = `
                        <div class="space-y-1.5">
                            <div class="flex items-center justify-between gap-2">
                                <span class="font-display text-[10px] font-bold tracking-wider text-subtle uppercase">
                                    ${item.sportLabel || 'THỂ THAO'}
                                </span>
                                <span class="inline-flex items-center gap-1 text-[11px] font-display font-bold px-2 py-0.5 rounded-[3px] bg-[#FEF3C7] border border-[#F59E0B] text-[#92400E]">
                                    ${ICON_CLOCK}
                                    <span>Giữ chỗ: <strong class="item-countdown" data-court-id="${item.courtId}" data-start="${item.startTime}">${getItemRemainingTimeStr(item)}</strong></span>
                                </span>
                            </div>
                            <h3 class="font-display text-base font-bold text-turf">
                                ${item.courtName}
                            </h3>
                            <div class="text-xs text-muted flex flex-wrap items-center gap-2">
                                <span class="font-display font-semibold text-turf">${item.startTime} → ${item.endTime} (${item.duration} phút)</span>
                                <span class="text-subtle">·</span>
                                <span>Đơn giá: ${formatVnd(item.price)}/h</span>
                            </div>
                        </div>

                        <div class="flex items-center justify-between pt-3 border-t border-line/70">
                            <div>
                                <span class="text-[11px] text-subtle block">Thành tiền ca</span>
                                <span class="font-display text-base font-bold text-turf">${formatVnd(item.total)}</span>
                            </div>
                            <button type="button" onclick="window.removeItemFromReceipt(${index})" class="p-2 text-subtle hover:text-clay rounded-[4px] hover:bg-stone-high transition-colors cursor-pointer" title="Xóa sân khỏi phiếu" aria-label="Xóa ${item.courtName}">
                                ${ICON_TRASH}
                            </button>
                        </div>
                    `;
                    listContainer.appendChild(itemCard);
                });

                const discountAmount = Math.round(subtotal * (discountPercent / 100));
                const finalTotal = subtotal - discountAmount;

                receiptBadgeCount.textContent = `${cart.length} sân đã chọn`;
                summaryCourtCount.textContent = String(cart.length);
                summarySubtotal.textContent = formatVnd(subtotal);
                if (summaryDiscount) summaryDiscount.textContent = `-${formatVnd(discountAmount)}`;
                summaryTotal.textContent = formatVnd(finalTotal);
            }

            window.removeItemFromReceipt = function (index) {
                const itemToRelease = cart[index];
                if (itemToRelease) {
                    fetch(window.releaseSlotUrl, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'Accept': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        },
                        body: JSON.stringify({
                            MaSan: itemToRelease.courtId,
                            NgayDat: itemToRelease.date || selectedDate,
                            GioBatDau: itemToRelease.startTime,
                            GioKetThuc: itemToRelease.endTime
                        })
                    }).then(() => fetchLatestSlots());
                }

                cart.splice(index, 1);
                renderReceipt();
                updateAllCourtCards();
            };

            function fetchLatestSlots() {
                return fetch(`{{ route('booking.slots') }}?date=${selectedDate}`, {
                    headers: { 'Accept': 'application/json' }
                })
                    .then(res => res.json())
                    .then(data => {
                        if (data) {
                            window.dbBookedSlots = data.booked_slots || {};
                            window.dbHoldingSlots = data.holding_slots || {};
                            ensureHoldTickerRunning();
                        }
                        updateAllCourtCards();
                    })
                    .catch(() => updateAllCourtCards());
            }

            setInterval(fetchLatestSlots, 15000);

            // ================= SỰ KIỆN BỘ LỌC & TƯƠNG TÁC =================
            document.getElementById('bookingDateInput').addEventListener('change', function () {
                selectedDate = this.value;
                populateStartTimeOptions();
                fetchLatestSlots();
            });

            document.getElementById('bookingStartTimeInput').addEventListener('change', function () {
                selectedStartTime = this.value;
                updateAllCourtCards();
            });

            document.querySelectorAll('.duration-btn').forEach(btn => {
                btn.addEventListener('click', function () {
                    document.querySelectorAll('.duration-btn').forEach(b => {
                        b.classList.remove('bg-turf', 'text-white', 'border-turf');
                        b.classList.add('text-turf', 'bg-stone-canvas', 'border-line');
                    });
                    this.classList.add('bg-turf', 'text-white', 'border-turf');
                    this.classList.remove('text-turf', 'bg-stone-canvas', 'border-line');

                    selectedDuration = parseInt(this.getAttribute('data-duration'), 10) || 90;
                    updateAllCourtCards();
                });
            });

            document.getElementById('btnFilterApply').addEventListener('click', function () {
                selectedDate = document.getElementById('bookingDateInput').value;
                selectedStartTime = document.getElementById('bookingStartTimeInput').value;
                fetchLatestSlots();
            });

            document.querySelectorAll('.sport-filter-btn').forEach(btn => {
                btn.addEventListener('click', function () {
                    document.querySelectorAll('.sport-filter-btn').forEach(b => {
                        b.classList.remove('bg-turf', 'text-white', 'border-turf', 'font-bold');
                        b.classList.add('bg-stone-canvas', 'text-turf', 'border-line', 'font-semibold');
                    });
                    this.classList.add('bg-turf', 'text-white', 'border-turf', 'font-bold');
                    this.classList.remove('bg-stone-canvas', 'text-turf', 'border-line', 'font-semibold');

                    selectedSport = this.getAttribute('data-sport');
                    updateAllCourtCards();
                });
            });

            document.getElementById('courtSearchInput').addEventListener('input', function () {
                searchQuery = this.value.toLowerCase().trim();
                updateAllCourtCards();
            });

            document.addEventListener('click', function (e) {
                if (e.target.closest('.btn-snap-adjacent') || e.target.closest('.btn-snap-safe')) {
                    const btn = e.target.closest('.btn-snap-adjacent') || e.target.closest('.btn-snap-safe');
                    const targetTime = btn.getAttribute('data-target-time');
                    if (targetTime) {
                        document.getElementById('bookingStartTimeInput').value = targetTime;
                        selectedStartTime = targetTime;
                        updateAllCourtCards();
                    }
                    return;
                }

                const btn = e.target.closest('.btn-toggle-court-cart');
                if (!btn || btn.disabled || btn.classList.contains('cursor-not-allowed')) {
                    return;
                }

                const cId = btn.getAttribute('data-court-id');
                const card = document.getElementById(`court-card-${cId}`);
                const cName = card.getAttribute('data-court-name');
                const cSport = card.getAttribute('data-sport');
                const cSportLabel = card.getAttribute('data-sport-label') || 'THỂ THAO';
                const cPrice = parseFloat(card.getAttribute('data-court-price'));

                // Kiểm tra giờ thực tế nếu đặt hôm nay
                if (isDateToday(selectedDate)) {
                    const realNowStr = getNowTimeStr();
                    if (timeToMinutes(selectedStartTime) <= timeToMinutes(realNowStr)) {
                        alert(`Khung giờ ${selectedStartTime} đã qua so với thời điểm hiện tại (${realNowStr}). Vui lòng chọn khung giờ khác.`);
                        populateStartTimeOptions();
                        updateAllCourtCards();
                        return;
                    }
                }

                const endTimeStr = calculateEndTime(selectedStartTime, selectedDuration);
                if (timeToMinutes(selectedStartTime) + selectedDuration > DAY_END) {
                    alert(`Khung giờ ${selectedStartTime} - ${endTimeStr} vượt quá giờ đóng cửa (01:00 sáng). Vui lòng chọn ca ngắn hơn.`);
                    return;
                }

                const exactIndex = cart.findIndex(i =>
                    String(i.courtId) === String(cId) &&
                    i.date === selectedDate &&
                    i.startTime === selectedStartTime &&
                    i.endTime === endTimeStr
                );

                if (exactIndex > -1) {
                    window.removeItemFromReceipt(exactIndex);
                    return;
                }

                btn.disabled = true;
                btn.innerHTML = '<span>Đang giữ chỗ...</span>';

                fetch(window.holdSlotUrl, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({
                        MaSan: cId,
                        NgayDat: selectedDate,
                        GioBatDau: selectedStartTime,
                        GioKetThuc: endTimeStr
                    })
                })
                    .then(res => res.json())
                    .then(data => {
                        if (data.success) {
                            const itemTotal = Math.round(cPrice * (selectedDuration / 60));
                            const holdSecs = data.remaining_seconds || 300;
                            const expiresAt = Date.now() + (holdSecs * 1000);

                            cart.push({
                                courtId: String(cId),
                                courtName: cName,
                                sport: cSport,
                                sportLabel: cSportLabel,
                                date: selectedDate,
                                startTime: selectedStartTime,
                                endTime: endTimeStr,
                                duration: selectedDuration,
                                price: cPrice,
                                total: itemTotal,
                                expiresAt: expiresAt
                            });

                            ensureHoldTickerRunning();
                            renderReceipt();
                            fetchLatestSlots();
                        } else {
                            alert(data.message || 'Không thể giữ chỗ sân này.');
                            fetchLatestSlots();
                        }
                    })
                    .catch(() => {
                        alert('Lỗi kết nối khi gửi yêu cầu giữ chỗ sân.');
                        updateAllCourtCards();
                    })
                    .finally(() => {
                        btn.disabled = false;
                    });
            });

            // ================= MODAL XÁC NHẬN & GỬI FORM =================
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
                if (cart.length === 0) return;

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
                        <div class="flex items-center justify-between gap-3 text-xs py-2 border-b border-line/60 last:border-0">
                            <div>
                                <span class="font-display font-bold text-turf block">${item.courtName}</span>
                                <span class="text-muted">${item.startTime} → ${item.endTime} (${item.duration}p)</span>
                                <span class="inline-flex items-center gap-1 ml-2 text-[10.5px] font-display font-bold text-[#92400E] bg-[#FEF3C7] border border-[#F59E0B] px-1.5 py-0.5 rounded-[3px]">
                                    Giữ chỗ: <strong class="item-countdown" data-court-id="${item.courtId}" data-start="${item.startTime}">${getItemRemainingTimeStr(item)}</strong>
                                </span>
                            </div>
                            <span class="font-display font-bold text-turf shrink-0">${formatVnd(item.total)}</span>
                        </div>
                    `;
                });

                const discountAmount = Math.round(subtotal * (discountPercent / 100));
                modalTotalAmount.textContent = formatVnd(subtotal - discountAmount);
                checkoutModal.classList.remove('hidden');
            });

            function closeModal() {
                checkoutModal.classList.add('hidden');
            }

            btnCloseCheckoutModal.addEventListener('click', closeModal);
            btnCancelModal.addEventListener('click', closeModal);

            bookingCheckoutForm.addEventListener('submit', function (e) {
                e.preventDefault();
                const btnSubmit = document.getElementById('btnSubmitBooking');
                btnSubmit.disabled = true;
                btnSubmit.innerHTML = '<span>Đang lưu phiếu đặt...</span>';

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
                    .then(res => res.json())
                    .then(data => {
                        if (data.success) {
                            closeModal();
                            cart = [];
                            renderReceipt();
                            fetchLatestSlots();

                            const alertBox = document.createElement('div');
                            alertBox.className = 'fixed top-6 right-6 z-50 bg-turf text-white p-4 rounded-[6px] border-2 border-clay max-w-md shadow-lg';
                            alertBox.innerHTML = `
                                <div class="space-y-1">
                                    <h4 class="font-display font-bold text-sm">Đặt sân thành công</h4>
                                    <p class="text-xs text-[#d2e8db]">${data.message}</p>
                                    <p class="font-display text-xs font-semibold text-white pt-1">Tổng thanh toán: ${formatVnd(data.total || 0)}</p>
                                </div>
                            `;
                            document.body.appendChild(alertBox);
                            setTimeout(() => alertBox.remove(), 5000);
                        } else {
                            alert(data.message || 'Đã có lỗi xảy ra khi lưu phiếu đặt.');
                        }
                    })
                    .catch(() => {
                        alert('Lỗi kết nối máy chủ khi lưu phiếu đặt.');
                    })
                    .finally(() => {
                        btnSubmit.disabled = false;
                        btnSubmit.innerHTML = '<span>Hoàn tất đặt sân</span>';
                    });
            });

            // Khởi chạy ban đầu
            populateStartTimeOptions();
            restoreExistingMyHolds();
            ensureHoldTickerRunning();
            renderReceipt();
            updateAllCourtCards();
        });
    </script>
</body>

</html>
