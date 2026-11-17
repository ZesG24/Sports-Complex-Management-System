<!DOCTYPE html>
<html class="light" lang="vi">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Khu phức hợp Thể thao Anh Vinh - Đặt sân bóng đá, cầu lông, pickleball từ 05:00 đến 01:00 hàng ngày.">
    <title>Thể thao Anh Vinh - Khu phức hợp thể thao đa năng</title>

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
</head>

<body class="bg-stone-canvas text-ink font-sans antialiased min-h-screen flex flex-col">

    @include('partials.header')

    @php
        $heroCauLong = $allSan->firstWhere('MaLoai', 2);
        $heroBongDa = $allSan->firstWhere('MaLoai', 1);
        $heroPickleball = $allSan->firstWhere('MaLoai', 3);
    @endphp

    <main class="grow">
        <!-- ==================== 1. HERO SECTION (Bố cục 7/5 chuẩn tạp chí thể thao) ==================== -->
        <section class="bg-stone-low border-b border-line py-10 md:py-16">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-center">
                    <!-- Cột trái (7 cột) -->
                    <div class="lg:col-span-7 flex flex-col justify-center">
                        <span class="font-display text-xs font-bold tracking-widest text-subtle uppercase mb-2">
                            KHU PHỨC HỢP THỂ THAO ĐA NĂNG
                        </span>
                        <h1 class="font-display text-3xl sm:text-4xl lg:text-5xl font-bold text-turf tracking-tight leading-[1.15] mb-4">
                            Đặt sân nhanh chóng. Lên lịch tập luyện &amp; thi đấu dễ dàng.
                        </h1>
                        <p class="text-base sm:text-lg text-muted mb-7 leading-relaxed">
                            Hệ thống sân bóng đá, cầu lông, pickleball phục vụ từ 05:00 đến 01:00 hàng ngày.
                        </p>

                        <!-- THANH TÌM KIẾM ĐẶT SÂN: CHỈ DUY NHẤT 1 Ô NGÀY + 1 NÚT BẤM -->
                        <form action="{{ route('booking') }}" method="GET" class="bg-white border border-turf rounded-[6px] p-2 flex flex-col sm:flex-row items-stretch sm:items-center justify-between gap-3 mb-8">
                            <label for="heroDateInput" class="flex items-center gap-3 px-3 py-1.5 grow cursor-pointer">
                                <svg class="w-6 h-6 text-turf shrink-0" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5" />
                                </svg>
                                <span class="flex flex-col grow">
                                    <span class="font-display text-[11px] font-bold tracking-wider text-subtle uppercase leading-tight">
                                        NGÀY ĐẶT SÂN
                                    </span>
                                    <input type="date" id="heroDateInput" name="date"
                                           value="{{ date('Y-m-d') }}"
                                           min="{{ date('Y-m-d') }}"
                                           class="bg-transparent border-0 p-0 mt-0.5 font-display text-base font-bold text-turf focus:ring-0 cursor-pointer w-full">
                                </span>
                            </label>
                            <button type="submit" class="bg-clay hover:bg-clay-hover text-white font-display text-sm font-semibold px-6 py-3 rounded-[6px] transition-colors flex items-center justify-center gap-2 whitespace-nowrap cursor-pointer shrink-0">
                                <span>Xem lịch &amp; Đặt sân</span>
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
                                </svg>
                            </button>
                        </form>

                        <!-- Hàng 3 thông tin thực tế -->
                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 pt-5 border-t border-line">
                            <div class="border-l-2 border-turf pl-3">
                                <div class="font-display text-xl sm:text-2xl font-bold text-turf leading-tight">{{ $allSan->count() }} Sân</div>
                                <div class="text-xs sm:text-sm text-muted mt-0.5">Bóng đá, Cầu lông, Pickleball</div>
                            </div>
                            <div class="border-l-2 border-turf pl-3">
                                <div class="font-display text-xl sm:text-2xl font-bold text-turf leading-tight">05:00 – 01:00</div>
                                <div class="text-xs sm:text-sm text-muted mt-0.5">Khung giờ hoạt động</div>
                            </div>
                            <div class="border-l-2 border-turf pl-3">
                                <div class="font-display text-xl sm:text-2xl font-bold text-turf leading-tight">1 Phiếu đặt</div>
                                <div class="text-xs sm:text-sm text-muted mt-0.5">Đặt nhiều sân cùng lúc</div>
                            </div>
                        </div>
                    </div>

                    <!-- Cột phải (5 cột): Cụm ảnh mặt sân thực tế -->
                    <div class="lg:col-span-5 flex flex-col gap-2 bg-white p-2 border border-line rounded-[6px]">
                        <div class="relative h-60 md:h-68 overflow-hidden rounded-[4px] border border-line bg-stone-high">
                            <img src="{{ $heroCauLong?->HinhAnh ?? 'https://images.unsplash.com/photo-1626224583764-f87db24ac4ea?auto=format&fit=crop&w=900&q=80' }}"
                                 alt="{{ $heroCauLong?->TenSan ?? 'Sân cầu lông Thể thao Anh Vinh' }}"
                                 class="w-full h-full object-cover">
                            <span class="absolute bottom-2 left-2 bg-turf/90 text-white font-display px-2.5 py-1 text-xs font-semibold rounded-[4px]">
                                Cầu lông
                            </span>
                        </div>
                        <div class="grid grid-cols-2 gap-2">
                            <div class="relative h-36 overflow-hidden rounded-[4px] border border-line bg-stone-high">
                                <img src="{{ $heroBongDa?->HinhAnh ?? 'https://images.unsplash.com/photo-1529900748604-07564a03e7a6?auto=format&fit=crop&w=600&q=80' }}"
                                     alt="{{ $heroBongDa?->TenSan ?? 'Sân bóng đá cỏ nhân tạo' }}"
                                     class="w-full h-full object-cover">
                                <span class="absolute bottom-1.5 left-1.5 bg-turf/90 text-white font-display px-2 py-0.5 text-[11px] font-semibold rounded-[4px]">
                                    Bóng đá
                                </span>
                            </div>
                            <div class="relative h-36 overflow-hidden rounded-[4px] border border-line bg-stone-high">
                                <img src="{{ $heroPickleball?->HinhAnh ?? 'https://images.unsplash.com/photo-1554068865-24cecd4e34b8?auto=format&fit=crop&w=600&q=80' }}"
                                     alt="{{ $heroPickleball?->TenSan ?? 'Sân Pickleball' }}"
                                     class="w-full h-full object-cover">
                                <span class="absolute bottom-1.5 left-1.5 bg-turf/90 text-white font-display px-2 py-0.5 text-[11px] font-semibold rounded-[4px]">
                                    Pickleball
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- ==================== 2. DANH SÁCH SÂN THEO MÔN ==================== -->
        <section class="bg-stone-low py-12" id="court-showcase">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex flex-col md:flex-row md:items-end justify-between mb-8 gap-4 border-b border-line pb-4">
                    <div>
                        <span class="font-display text-xs font-bold tracking-widest text-subtle uppercase block mb-1">
                            HỆ THỐNG SÂN BÃI
                        </span>
                        <h2 class="font-display text-2xl sm:text-3xl font-bold text-turf tracking-tight">
                            Khám phá danh sách sân
                        </h2>
                    </div>

                    <!-- Cụm nút lọc theo môn (Không dùng emoji) -->
                    <div class="flex items-center flex-wrap gap-2" id="sportTabs">
                        <button type="button" onclick="filterSport('all')" data-target="all"
                                class="sport-tab-btn bg-turf text-white border border-turf font-display text-xs font-semibold px-4 py-2 rounded-[6px] transition-colors cursor-pointer">
                            Tất cả sân ({{ $allSan->count() }})
                        </button>
                        @foreach($loaiSanList as $loai)
                            <button type="button" onclick="filterSport('{{ $loai->MaLoai }}')" data-target="{{ $loai->MaLoai }}"
                                    class="sport-tab-btn bg-white text-muted hover:text-turf border border-line font-display text-xs font-semibold px-4 py-2 rounded-[6px] transition-colors cursor-pointer">
                                {{ $loai->TenLoai }} ({{ $loai->san_count }})
                            </button>
                        @endforeach
                    </div>
                </div>

                <!-- Lưới thẻ sân -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6" id="courtGrid">
                    @forelse($allSan as $san)
                        <article class="court-item bg-white border border-line rounded-[6px] overflow-hidden flex flex-col justify-between hover:border-turf transition-colors"
                                 data-sport-id="{{ $san->MaLoai }}">
                            <div>
                                <div class="relative h-52 overflow-hidden border-b border-line bg-stone-high">
                                    <img src="{{ $san->HinhAnh ?? 'https://images.unsplash.com/photo-1529900748604-07564a03e7a6?auto=format&fit=crop&w=800&q=80' }}"
                                         alt="{{ $san->TenSan }}"
                                         class="w-full h-full object-cover">
                                    <span class="absolute top-3 left-3 bg-turf text-white font-display text-xs font-semibold px-2.5 py-1 rounded-[4px]">
                                        {{ $san->loaiSan->TenLoai ?? 'Thể thao' }}
                                    </span>
                                </div>
                                <div class="p-4 sm:p-5">
                                    <h3 class="font-display text-lg font-bold text-turf mb-1.5">
                                        {{ $san->TenSan }}
                                    </h3>
                                    <p class="text-sm text-muted line-clamp-2 leading-relaxed">
                                        {{ $san->MoTa ?? 'Sân tập luyện và thi đấu tại Khu phức hợp Thể thao Anh Vinh.' }}
                                    </p>
                                </div>
                            </div>

                            <div class="px-4 sm:px-5 py-3.5 border-t border-line/70 flex items-center justify-between mt-auto">
                                <div>
                                    <span class="font-display text-[11px] text-subtle uppercase font-bold block">GIÁ THUÊ</span>
                                    <span class="font-display text-base font-bold text-turf">
                                        {{ number_format($san->GiaThue, 0, ',', '.') }}đ
                                        <span class="font-sans font-normal text-xs text-muted">/giờ</span>
                                    </span>
                                </div>
                                <a href="{{ route('booking', ['date' => date('Y-m-d')]) }}"
                                   class="bg-turf hover:bg-turf-hover text-white font-display text-xs font-semibold px-3.5 py-2 rounded-[6px] inline-flex items-center gap-1.5 transition-colors">
                                    <span>Đặt sân</span>
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
                                    </svg>
                                </a>
                            </div>
                        </article>
                    @empty
                        <div class="col-span-full py-12 text-center text-muted text-sm">
                            Chưa có dữ liệu sân thể thao.
                        </div>
                    @endforelse
                </div>
            </div>
        </section>

        <!-- ==================== 3. BANNER TÌM BẠN CHƠI CÙNG ==================== -->
        <section class="bg-stone-low pb-12 pt-2" id="matchmaking">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="bg-turf text-stone-canvas rounded-[6px] p-6 sm:p-8 flex flex-col md:flex-row items-start md:items-center justify-between gap-6">
                    <div class="max-w-2xl">
                        <span class="font-display text-xs font-bold tracking-widest text-[#b6cbbf] uppercase block mb-1">
                            GIAO LƯU THỂ THAO
                        </span>
                        <h2 class="font-display text-2xl sm:text-3xl font-bold text-white tracking-tight mb-2">
                            Tìm bạn chơi &amp; Ghép đội giao lưu
                        </h2>
                        <p class="text-sm sm:text-base text-[#d2e8db]/90 leading-relaxed">
                            Thiếu người ghép đội hoặc muốn tìm đối thủ giao lưu? Đặt sân và kết nối cùng cộng đồng người chơi tại Thể thao Anh Vinh.
                        </p>
                    </div>
                    <div class="shrink-0 w-full md:w-auto">
                        <a href="{{ route('booking') }}"
                           class="w-full md:w-auto bg-clay hover:bg-clay-hover text-white font-display text-sm font-semibold px-6 py-3.5 rounded-[6px] transition-colors inline-flex items-center justify-center gap-2">
                            <span>Tham gia ghép kèo</span>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </section>

        <!-- ==================== 4. CHÍNH SÁCH ƯU ĐÃI HỘI VIÊN ==================== -->
        <section class="bg-white border-t border-line py-12" id="hoi-vien">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="max-w-3xl mb-8">
                    <span class="font-display text-xs font-bold tracking-widest text-subtle uppercase block mb-1">
                        HỘI VIÊN
                    </span>
                    <h2 class="font-display text-2xl sm:text-3xl font-bold text-turf tracking-tight mb-2">
                        Chính sách ưu đãi hội viên
                    </h2>
                    <p class="text-sm sm:text-base text-muted">
                        Tích lũy chi tiêu tự động sau mỗi lần đặt sân để nâng hạng và hưởng ưu đãi giảm giá trực tiếp.
                    </p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 items-stretch">
                    @forelse($hangThanhVienList as $vip)
                        @php
                            $isFeatured = $vip->TenHang === 'VIP 2';
                        @endphp
                        <div class="bg-white {{ $isFeatured ? 'border-2 border-turf' : 'border border-line' }} rounded-[6px] p-6 flex flex-col justify-between">
                            <div>
                                <div class="flex items-center justify-between mb-4">
                                    <h3 class="font-display text-xl font-bold text-turf">{{ $vip->TenHang }}</h3>
                                    <span class="font-display text-xs font-bold px-2.5 py-1 rounded-[4px] {{ $isFeatured ? 'bg-clay text-white' : 'bg-stone-high text-turf' }}">
                                        Giảm {{ rtrim(rtrim(number_format((float) $vip->PhanTramGiamGia, 2, '.', ''), '0'), '.') }}%
                                    </span>
                                </div>

                                <div class="mb-4">
                                    <span class="font-display text-[11px] text-subtle uppercase font-semibold block">
                                        Chi tiêu tích lũy
                                    </span>
                                    <strong class="font-display text-xl font-bold text-turf">
                                        Từ {{ number_format($vip->ChiTieuToiThieu, 0, ',', '.') }}đ
                                    </strong>
                                </div>

                                <p class="text-sm text-muted mb-6 leading-relaxed">
                                    {{ $vip->QuyenLoi }}
                                </p>
                            </div>

                            <a href="{{ route('booking') }}"
                               class="w-full text-center font-display text-xs font-semibold py-2.5 rounded-[6px] transition-colors block {{ $isFeatured ? 'bg-clay hover:bg-clay-hover text-white' : 'bg-white hover:bg-stone-low border border-turf text-turf' }}">
                                Đặt sân tích điểm
                            </a>
                        </div>
                    @empty
                        <div class="col-span-full text-center text-muted text-sm">
                            Đang cập nhật chính sách hội viên.
                        </div>
                    @endforelse
                </div>
            </div>
        </section>
    </main>

    @include('partials.footer')

    <script>
        function filterSport(sportId) {
            document.querySelectorAll('.sport-tab-btn').forEach(btn => {
                if (btn.dataset.target === String(sportId)) {
                    btn.classList.add('bg-turf', 'text-white', 'border-turf');
                    btn.classList.remove('bg-white', 'text-muted', 'border-line');
                } else {
                    btn.classList.remove('bg-turf', 'text-white', 'border-turf');
                    btn.classList.add('bg-white', 'text-muted', 'border-line');
                }
            });

            document.querySelectorAll('.court-item').forEach(card => {
                if (sportId === 'all' || card.dataset.sportId === String(sportId)) {
                    card.style.display = 'flex';
                } else {
                    card.style.display = 'none';
                }
            });
        }
    </script>
</body>

</html>
