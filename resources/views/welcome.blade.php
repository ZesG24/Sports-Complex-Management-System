<!DOCTYPE html>
<html class="light" lang="vi">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Khu phức hợp thể thao Anh Vinh - Đặt sân bóng đá, cầu lông, pickleball và ghép kèo giao lưu thể thao chuyên nghiệp.">
    <title>Thể thao Anh Vinh - Khu phức hợp thể thao đa năng</title>

    <!-- Google Fonts & Icons -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com?plugins=forms"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: {
                        'primary': '#158f68',
                        'primary-hover': '#0d7654',
                        'primary-light': '#e6f5ef',
                        'accent-lime': '#d8f46e',
                        'ink': '#17231f',
                        'muted': '#71807a',
                        'cream': '#f7f9f4',
                        'line': '#e4eae5'
                    },
                    fontFamily: {
                        sans: ['"Plus Jakarta Sans"', 'Inter', 'sans-serif'],
                    }
                }
            }
        }
    </script>
    <style>
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
            display: inline-block;
            vertical-align: middle;
            line-height: 1;
        }

        .court-card-transition {
            transition: transform 0.25s ease, box-shadow 0.25s ease;
        }

        .court-card-transition:hover {
            transform: translateY(-4px);
            box-shadow: 0 16px 30px -4px rgba(23, 35, 31, 0.08);
        }
    </style>
</head>

<body class="bg-cream text-ink font-sans antialiased min-h-screen flex flex-col">

    <!-- ==================== HEADER ==================== -->
    <header class="sticky top-0 z-50 bg-white/95 backdrop-blur-md border-b border-line">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-20 flex items-center justify-between">
            <!-- Brand Logo -->
            <a href="{{ route('home') }}" class="flex items-center gap-3 group">
                <span class="w-11 h-11 rounded-xl bg-accent-lime text-ink flex items-center justify-center font-extrabold text-xl shadow-sm group-hover:scale-105 transition-transform">
                    AV
                </span>
                <div class="flex flex-col">
                    <span class="text-xl font-extrabold tracking-tight text-ink flex items-center">
                        Thể thao Anh Vinh<span class="text-primary font-black">.</span>
                    </span>
                    <span class="text-[11px] font-semibold text-muted uppercase tracking-wider -mt-1">
                        Khu phức hợp thể thao
                    </span>
                </div>
            </a>

            <!-- Navigation Links -->
            <nav class="hidden md:flex items-center gap-8">
                <a href="{{ route('home') }}" class="text-primary font-bold border-b-2 border-primary pb-1 text-sm">Trang chủ</a>
                <a href="{{ route('booking') }}" class="text-muted hover:text-ink font-semibold text-sm transition-colors">Đặt sân</a>
                <a href="#matchmaking" class="text-muted hover:text-ink font-semibold text-sm transition-colors flex items-center gap-1.5">
                    Tìm bạn chơi
                    <span class="px-2 py-0.5 rounded-full bg-accent-lime text-ink text-[10px] font-extrabold uppercase">Mới</span>
                </a>
                <a href="{{ route('store') }}" class="text-muted hover:text-ink font-semibold text-sm transition-colors">Cửa hàng</a>
            </nav>

            <!-- User Authentication / Actions -->
            <div class="flex items-center gap-3">
                @auth
                <div class="inline-flex items-center gap-2.5 bg-white border border-line rounded-full py-1.5 px-3.5 shadow-sm">
                    <span class="w-8 h-8 rounded-full bg-accent-lime text-ink font-bold flex items-center justify-center text-sm">
                        {{ strtoupper(substr(Auth::user()->TenDangNhap, 0, 1)) }}
                    </span>
                    <div class="flex flex-col text-left">
                        <div class="flex items-center gap-1.5">
                            <span class="text-xs font-bold text-ink">{{ Auth::user()->TenDangNhap }}</span>
                            <span class="px-1.5 py-0.5 rounded {{ Auth::user()->khachHang?->hangThanhVien ? 'bg-amber-100 text-amber-800 border border-amber-300' : 'bg-primary-light text-primary' }} text-[10px] font-extrabold uppercase">
                                {{ Auth::user()->ten_hang_thanh_vien }}
                            </span>
                        </div>
                    </div>
                    <form action="{{ route('logout') }}" method="POST" class="inline m-0">
                        @csrf
                        <button type="submit" class="text-muted hover:text-red-600 p-1 rounded-md transition-colors" title="Đăng xuất">
                            <span class="material-symbols-outlined text-[18px]">logout</span>
                        </button>
                    </form>
                </div>
                @else
                <a href="{{ route('login') }}" class="text-sm font-semibold text-muted hover:text-ink px-3 py-2">Đăng nhập</a>
                <a href="{{ route('register') }}" class="inline-flex items-center justify-center px-4 py-2 rounded-full bg-primary hover:bg-primary-hover text-white text-sm font-bold shadow-sm transition-all">
                    Đăng ký
                </a>
                @endauth
            </div>
        </div>
    </header>

    <!-- ==================== MAIN CONTENT ==================== -->
    <main class="flex-grow">
        <!-- 1. HERO SECTION & QUICK SEARCH BAR -->
        <section class="relative pt-12 pb-16 overflow-hidden bg-gradient-to-b from-white via-cream to-cream">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <!-- Hero Header Text -->
                <div class="text-center max-w-4xl mx-auto mb-10">
                    <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-accent-lime/80 border border-accent-lime text-ink font-bold text-xs uppercase tracking-wider mb-4 shadow-sm">
                        <span class="material-symbols-outlined text-[16px] text-primary" style="font-variation-settings: 'FILL' 1;">verified</span>
                        KHU PHỨC HỢP THỂ THAO ĐA NĂNG HIỆN ĐẠI
                    </div>
                    <h1 class="text-4xl sm:text-5xl lg:text-6xl font-extrabold text-ink tracking-tight leading-tight mb-5">
                        Chơi thể thao đỉnh cao.<br>
                        <span class="text-primary relative inline-block">
                            Đặt sân &amp; Ghép kèo
                            <span class="absolute -bottom-1 left-0 w-full h-2 bg-accent-lime -z-10 rounded-full"></span>
                        </span> dễ dàng.
                    </h1>
                    <p class="text-base sm:text-lg text-muted max-w-2xl mx-auto leading-relaxed">
                        Hệ thống sân cầu lông, pickleball, bóng đá tiêu chuẩn BWF, Decoturf, FIFA. Trải nghiệm dịch vụ đẳng cấp, tiện nghi máy lạnh, đèn LED chống chói 24/7.
                    </p>
                </div>

                <!-- Hero Quick Search Bar (Chỉ chọn ngày chuẩn như Stitch) -->
                <form action="{{ route('booking') }}" method="GET" class="bg-white p-2.5 sm:p-3 rounded-full border border-line shadow-lg shadow-ink/5 mx-auto mb-12 max-w-3xl">
                    <div class="flex flex-col sm:flex-row items-center justify-between gap-3 p-1">
                        <label for="heroDateInput" class="flex items-center gap-3 px-5 py-2.5 rounded-full hover:bg-cream transition-colors cursor-pointer group flex-grow w-full sm:w-auto">
                            <div class="w-11 h-11 rounded-full bg-primary-light flex items-center justify-center text-primary group-hover:bg-primary group-hover:text-white transition-colors flex-shrink-0">
                                <span class="material-symbols-outlined text-[22px]">calendar_today</span>
                            </div>
                            <div class="flex flex-col text-left flex-grow">
                                <span class="text-xs text-muted uppercase tracking-wider font-bold">Chọn ngày đặt</span>
                                <div class="flex items-center gap-2">
                                    <input type="date" id="heroDateInput" name="date" value="{{ date('Y-m-d') }}"
                                        class="bg-transparent border-0 p-0 text-base sm:text-lg font-bold text-ink focus:ring-0 cursor-pointer font-sans">
                                </div>
                                <span class="text-[11px] font-medium text-primary mt-0.5 flex items-center gap-1">
                                    <span class="material-symbols-outlined text-[13px]">info</span>
                                    Đặt nhiều sân cùng lúc trong 1 phiếu
                                </span>
                            </div>
                        </label>
                        <button type="submit" class="w-full sm:w-auto px-8 h-14 bg-primary text-white font-bold text-base rounded-full hover:bg-primary-hover active:scale-[0.98] transition-all flex items-center justify-center gap-2 shadow-md shadow-primary/20 flex-shrink-0 cursor-pointer">
                            <span>Tìm &amp; Đặt sân trống</span>
                            <span class="material-symbols-outlined text-[20px]">arrow_forward</span>
                        </button>
                    </div>
                </form>

                <!-- Trust & Performance Stats chuẩn Stitch -->
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4 max-w-4xl mx-auto pt-2">
                    <div class="flex items-center justify-center gap-3 p-3 bg-white/70 rounded-xl border border-line/60">
                        <span class="material-symbols-outlined text-primary text-[24px]">stadium</span>
                        <div class="text-left">
                            <div class="text-base font-bold text-ink">{{ $allSan->count() }}+ Sân</div>
                            <div class="text-xs text-muted">Tiêu chuẩn quốc tế</div>
                        </div>
                    </div>
                    <div class="flex items-center justify-center gap-3 p-3 bg-white/70 rounded-xl border border-line/60">
                        <span class="material-symbols-outlined text-primary text-[24px]">sports_score</span>
                        <div class="text-left">
                            <div class="text-base font-bold text-ink">12.000+</div>
                            <div class="text-xs text-muted">Lượt đặt mỗi tháng</div>
                        </div>
                    </div>
                    <div class="flex items-center justify-center gap-3 p-3 bg-white/70 rounded-xl border border-line/60">
                        <span class="material-symbols-outlined text-amber-500 text-[24px]" style="font-variation-settings: 'FILL' 1;">star</span>
                        <div class="text-left">
                            <div class="text-base font-bold text-ink">4.9 / 5.0</div>
                            <div class="text-xs text-muted">Hài lòng tuyệt đối</div>
                        </div>
                    </div>
                    <div class="flex items-center justify-center gap-3 p-3 bg-white/70 rounded-xl border border-line/60">
                        <span class="material-symbols-outlined text-primary text-[24px]">ac_unit</span>
                        <div class="text-left">
                            <div class="text-base font-bold text-ink">100% Máy lạnh</div>

                        </div>
                    </div>
                </div>
            </div>
        </section>
        </div>
        </section>

        <!-- 2. KHU VỰC KHÁM PHÁ DANH SÁCH SÂN THEO MÔN (Interactive Court Showcase) -->
        <section class="py-16 bg-cream border-t border-line" id="court-showcase">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <!-- Section Header -->
                <div class="flex flex-col md:flex-row md:items-end justify-between gap-4 mb-8">
                    <div>
                        <div class="flex items-center gap-2 mb-2">
                            <span class="w-2.5 h-2.5 rounded-full bg-primary"></span>
                            <span class="text-xs font-bold text-primary uppercase tracking-wider">Hệ thống sân thể thao</span>
                        </div>
                        <h2 class="text-2xl sm:text-3xl font-extrabold text-ink tracking-tight">
                            Hệ thống sân bãi đạt chuẩn thi đấu
                        </h2>
                        <p class="text-sm text-muted mt-1">
                            Xem hình ảnh thực tế, tiện ích mặt sân và bảng giá thuê minh bạch theo từng vị trí.
                        </p>
                    </div>
                    <a href="{{ route('courts.index') }}" class="inline-flex items-center gap-1.5 text-sm font-bold text-primary hover:text-primary-hover group transition-colors">
                        <span>Xem tất cả sân trên trang riêng</span>
                        <span class="material-symbols-outlined text-[18px] group-hover:translate-x-1 transition-transform">arrow_forward</span>
                    </a>
                </div>

                <!-- Filter Tabs theo môn -->
                <div class="flex items-center gap-2.5 overflow-x-auto pb-4 mb-8 scrollbar-none" id="sportTabs">
                    <button type="button" onclick="filterSport('all')" class="sport-tab-btn active-tab px-5 py-2.5 rounded-full bg-primary text-white font-bold text-sm shadow-sm transition-all" data-target="all">
                        Tất cả sân ({{ $allSan->count() }})
                    </button>
                    @foreach($loaiSanList as $loai)
                    <button type="button" onclick="filterSport('{{ $loai->MaLoai }}')" class="sport-tab-btn px-5 py-2.5 rounded-full bg-white text-muted hover:text-ink border border-line font-bold text-sm transition-all flex items-center gap-2" data-target="{{ $loai->MaLoai }}">
                        <span>
                            @if(str_contains(strtolower($loai->TenLoai), 'bóng đá')) ⚽
                            @elseif(str_contains(strtolower($loai->TenLoai), 'cầu lông')) 🏸
                            @elseif(str_contains(strtolower($loai->TenLoai), 'pickleball')) 🎾
                            @else 🏆 @endif
                        </span>
                        <span>{{ $loai->TenLoai }} ({{ $loai->san_count }})</span>
                    </button>
                    @endforeach
                </div>

                <!-- Lưới hiển thị danh sách thẻ sân -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6" id="courtGrid">
                    @forelse($allSan as $san)
                    <div class="court-item bg-white rounded-2xl border border-line overflow-hidden court-card-transition flex flex-col" data-sport-id="{{ $san->MaLoai }}">
                        <!-- Ảnh sân & Badges -->
                        <div class="relative h-52 w-full overflow-hidden bg-slate-100 group">
                            <img src="{{ $san->HinhAnh ?? 'https://images.unsplash.com/photo-1529900748604-07564a03e7a6?auto=format&fit=crop&w=800&q=80' }}"
                                alt="{{ $san->TenSan }}"
                                class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">

                            <!-- Badge Loại môn & Vị trí -->
                            <div class="absolute top-3 left-3 flex flex-wrap gap-1.5">
                                <span class="px-2.5 py-1 rounded-full bg-white/95 backdrop-blur-md text-[11px] font-extrabold text-ink shadow-sm">
                                    {{ $san->loaiSan->TenLoai ?? 'Thể thao' }}
                                </span>
                                @if(str_contains(strtolower($san->TenSan), 'vip'))
                                <span class="px-2.5 py-1 rounded-full bg-accent-lime text-ink text-[11px] font-extrabold shadow-sm">
                                    VIP Bìa ★
                                </span>
                                @elseif(str_contains(strtolower($san->TenSan), 'giữa'))
                                <span class="px-2.5 py-1 rounded-full bg-slate-100 text-muted text-[11px] font-bold shadow-sm">
                                    Tiêu chuẩn giữa
                                </span>
                                @elseif(str_contains(strtolower($san->TenSan), 'bìa'))
                                <span class="px-2.5 py-1 rounded-full bg-emerald-50 text-primary text-[11px] font-bold shadow-sm">
                                    Tiêu chuẩn bìa
                                </span>
                                @endif
                            </div>

                            <!-- Đánh giá sao -->
                            <div class="absolute top-3 right-3 px-2 py-0.5 rounded-lg bg-black/60 backdrop-blur-md text-white text-xs font-bold flex items-center gap-1">
                                <span class="text-amber-400">★</span> 5.0
                            </div>
                        </div>

                        <!-- Nội dung chi tiết sân -->
                        <div class="p-5 flex-grow flex flex-col justify-between space-y-4">
                            <div>
                                <h3 class="text-lg font-bold text-ink">
                                    {{ $san->TenSan }}
                                </h3>
                                <p class="text-xs text-muted line-clamp-2 mt-1.5 leading-relaxed">
                                    {{ $san->MoTa ?? 'Mặt sân thi đấu tiêu chuẩn cao cấp, hệ thống chiếu sáng LED chống chói.' }}
                                </p>
                            </div>

                            <!-- Giá thuê sân -->
                            <div class="pt-3 border-t border-line flex items-center justify-between">
                                <div>
                                    <span class="text-[11px] text-muted block">Giá thuê sân:</span>
                                    <span class="text-lg font-extrabold text-primary">
                                        {{ number_format($san->GiaThue, 0, ',', '.') }}đ
                                        <span class="text-xs font-normal text-muted">/giờ</span>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="col-span-full py-12 text-center text-muted">
                        Chưa có dữ liệu sân thể thao.
                    </div>
                    @endforelse
                </div>
            </div>
        </section>

        <!-- 3. SECTION TÍNH NĂNG MỚI: TÌM BẠN CHƠI CÙNG (Matchmaking Community) -->
        <section class="py-16 bg-white" id="matchmaking">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="relative bg-gradient-to-r from-emerald-800 via-primary to-teal-900 rounded-3xl p-8 sm:p-12 text-white overflow-hidden shadow-xl">
                    <div class="relative z-10 max-w-2xl space-y-4">
                        <span class="px-3 py-1 rounded-full bg-accent-lime text-ink text-xs font-extrabold uppercase tracking-wider">
                            Cộng đồng thể thao Anh Vinh
                        </span>
                        <h2 class="text-3xl sm:text-4xl font-extrabold tracking-tight">
                            Không còn lo thiếu người chơi cùng!
                        </h2>
                        <p class="text-white/80 text-sm sm:text-base leading-relaxed">
                            Bạn đã đặt sân nhưng thiếu người ghép đội? Hoặc đang tìm kèo giao lưu trình độ phù hợp? Tham gia ngay sàn ghép kèo thể thao sôi động nhất khu vực.
                        </p>
                        <div class="pt-2 flex flex-wrap gap-3">
                            <a href="{{ route('booking') }}" class="px-6 py-3 rounded-full bg-accent-lime hover:brightness-105 text-ink font-bold text-sm shadow-md transition-all flex items-center gap-2">
                                <span>Tham gia ghép kèo ngay</span>
                                <span class="material-symbols-outlined text-[18px]">group_add</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- 4. SECTION CHÍNH SÁCH HỘI VIÊN VIP -->
        <section class="py-16 bg-cream border-t border-line">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center max-w-3xl mx-auto mb-12">
                    <span class="text-xs font-bold text-primary uppercase tracking-wider">Chính sách ưu đãi hội viên</span>
                    <h2 class="text-2xl sm:text-3xl font-extrabold text-ink tracking-tight mt-1">
                        Đặc quyền Hội viên Thể thao Anh Vinh
                    </h2>
                    <p class="text-sm text-muted mt-2">
                        Tích lũy chi tiêu tự động sau mỗi lần đặt sân và mua hàng để nâng hạng và hưởng ưu đãi trọn đời.
                    </p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 max-w-5xl mx-auto">
                    @forelse($hangThanhVienList as $vip)
                    <div class="bg-white rounded-2xl border {{ $vip->TenHang === 'VIP 2' ? 'border-primary ring-2 ring-primary/20 shadow-lg' : 'border-line' }} p-6 flex flex-col justify-between space-y-4">
                        <div>
                            <div class="flex items-center justify-between">
                                <h3 class="text-xl font-extrabold text-ink">{{ $vip->TenHang }}</h3>
                                <span class="px-2.5 py-1 rounded-full {{ $vip->TenHang === 'VIP 3' ? 'bg-amber-100 text-amber-800' : ($vip->TenHang === 'VIP 2' ? 'bg-accent-lime text-ink' : 'bg-slate-100 text-muted') }} text-xs font-extrabold">
                                    Giảm {{ $vip->PhanTramGiamGia }}%
                                </span>
                            </div>
                            <div class="mt-4">
                                <span class="text-xs text-muted">Điều kiện tích lũy:</span>
                                <strong class="block text-base font-bold text-ink">
                                    Từ {{ number_format($vip->ChiTieuToiThieu, 0, ',', '.') }}đ
                                </strong>
                            </div>
                            <p class="text-xs text-muted mt-3 leading-relaxed border-t border-line/60 pt-3">
                                {{ $vip->QuyenLoi }}
                            </p>
                        </div>
                        <div class="pt-2">
                            <a href="{{ route('booking') }}" class="block text-center py-2.5 rounded-xl {{ $vip->TenHang === 'VIP 2' ? 'bg-primary text-white hover:bg-primary-hover' : 'bg-cream text-ink hover:bg-slate-200' }} text-xs font-bold transition-all">
                                Đặt sân tích điểm ngay
                            </a>
                        </div>
                    </div>
                    @empty
                    <div class="col-span-full text-center text-muted">Đang cập nhật chính sách VIP...</div>
                    @endforelse
                </div>
            </div>
        </section>
    </main>

    <!-- ==================== FOOTER ==================== -->
    <footer class="bg-white border-t border-line py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div class="space-y-3">
                    <div class="flex items-center gap-2">
                        <span class="w-8 h-8 rounded-lg bg-accent-lime text-ink flex items-center justify-center font-extrabold">AV</span>
                        <span class="text-lg font-extrabold text-ink">Thể thao Anh Vinh.</span>
                    </div>
                    <p class="text-xs text-muted leading-relaxed">
                        Khu phức hợp thể thao hàng đầu - Nơi thỏa mãn đam mê và nâng tầm phong độ thi đấu.
                    </p>
                </div>
                <div>
                    <h4 class="text-xs font-bold uppercase tracking-wider text-ink mb-3">Liên kết nhanh</h4>
                    <ul class="space-y-2 text-xs text-muted">
                        <li><a href="{{ route('home') }}" class="hover:text-primary">Trang chủ</a></li>
                        <li><a href="{{ route('courts.index') }}" class="hover:text-primary">Danh sách sân</a></li>
                        <li><a href="{{ route('booking') }}" class="hover:text-primary">Đặt sân online</a></li>
                        <li><a href="{{ route('store') }}" class="hover:text-primary">Cửa hàng dụng cụ</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-xs font-bold uppercase tracking-wider text-ink mb-3">Bộ môn phục vụ</h4>
                    <ul class="space-y-2 text-xs text-muted">
                        @foreach($loaiSanList as $loai)
                        <li>{{ $loai->TenLoai }} ({{ $loai->san_count }} sân)</li>
                        @endforeach
                    </ul>
                </div>
                <div>
                    <h4 class="text-xs font-bold uppercase tracking-wider text-ink mb-3">Thông tin liên hệ</h4>
                    <p class="text-xs text-muted leading-relaxed">
                        📍 Khu phức hợp Thể thao Anh Vinh<br>
                        📞 Hotline đặt sân: 0988 123 456<br>
                        ⏰ Mở cửa: 05:00 – 23:00 hàng ngày
                    </p>
                </div>
            </div>
            <div class="mt-8 pt-8 border-t border-line text-center text-xs text-muted">
                © {{ date('Y') }} Thể thao Anh Vinh. Bản quyền thuộc về Khu phức hợp thể thao Anh Vinh.
            </div>
        </div>
    </footer>

    <!-- Interactive Scripts for Filter & Modal -->
    <script>
        function filterSport(sportId) {
            // Update active state on tab buttons
            document.querySelectorAll('.sport-tab-btn').forEach(btn => {
                if (btn.dataset.target === String(sportId)) {
                    btn.classList.add('bg-primary', 'text-white');
                    btn.classList.remove('bg-white', 'text-muted');
                } else {
                    btn.classList.remove('bg-primary', 'text-white');
                    btn.classList.add('bg-white', 'text-muted');
                }
            });

            // Filter court grid items
            const cards = document.querySelectorAll('.court-item');
            cards.forEach(card => {
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