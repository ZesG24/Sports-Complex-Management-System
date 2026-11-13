<!DOCTYPE html>
<html class="light" lang="vi">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Danh sách hệ thống sân thể thao tại Thể thao Anh Vinh - Khám phá chi tiết sân bóng đá, cầu lông, pickleball.">
    <title>Danh sách sân thể thao - Thể thao Anh Vinh</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">

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

    <!-- Header -->
    <header class="sticky top-0 z-50 bg-white/95 backdrop-blur-md border-b border-line">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-20 flex items-center justify-between">
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

            <nav class="hidden md:flex items-center gap-8">
                <a href="{{ route('home') }}" class="text-muted hover:text-ink font-semibold text-sm transition-colors">Trang chủ</a>
                <a href="{{ route('courts.index') }}" class="text-primary font-bold border-b-2 border-primary pb-1 text-sm">Danh sách sân</a>
                <a href="{{ route('booking') }}" class="text-muted hover:text-ink font-semibold text-sm transition-colors">Đặt sân</a>
                <a href="{{ route('store') }}" class="text-muted hover:text-ink font-semibold text-sm transition-colors">Cửa hàng</a>
            </nav>

            <div class="flex items-center gap-3">
                @auth
                    <div class="inline-flex items-center gap-2.5 bg-white border border-line rounded-full py-1.5 px-3.5 shadow-sm">
                        <span class="w-8 h-8 rounded-full bg-accent-lime text-ink font-bold flex items-center justify-center text-sm">
                            {{ strtoupper(substr(Auth::user()->TenDangNhap, 0, 1)) }}
                        </span>
                        <span class="text-xs font-bold text-ink">{{ Auth::user()->TenDangNhap }}</span>
                        <span class="px-1.5 py-0.5 rounded {{ Auth::user()->khachHang?->hangThanhVien ? 'bg-amber-100 text-amber-800 border border-amber-300' : 'bg-primary-light text-primary' }} text-[10px] font-extrabold uppercase">
                            {{ Auth::user()->ten_hang_thanh_vien }}
                        </span>
                    </div>
                @else
                    <a href="{{ route('login') }}" class="text-sm font-semibold text-muted hover:text-ink px-3 py-2">Đăng nhập</a>
                    <a href="{{ route('register') }}" class="px-4 py-2 rounded-full bg-primary hover:bg-primary-hover text-white text-sm font-bold shadow-sm transition-all">Đăng ký</a>
                @endauth
            </div>
        </div>
    </header>

    <!-- Main -->
    <main class="flex-grow py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Breadcrumbs -->
            <div class="flex items-center gap-2 text-xs text-muted mb-6">
                <a href="{{ route('home') }}" class="hover:text-primary">Trang chủ</a>
                <span>→</span>
                <span class="font-bold text-ink">Danh sách sân thể thao</span>
            </div>

            <!-- Page Title & Toolbar -->
            <div class="flex flex-col md:flex-row md:items-end justify-between gap-4 mb-8">
                <div>
                    <h1 class="text-3xl font-extrabold text-ink tracking-tight">Hệ thống sân bãi Thể thao Anh Vinh</h1>
                    <p class="text-sm text-muted mt-1">Khám phá chi tiết cơ sở vật chất, mặt sân thi đấu và giá thuê theo từng vị trí.</p>
                </div>
            </div>

            <!-- Filter & Search Toolbar -->
            <div class="bg-white rounded-2xl border border-line p-4 mb-8 shadow-sm">
                <form action="{{ route('courts.index') }}" method="GET" class="grid grid-cols-1 md:grid-cols-12 gap-3 items-center">
                    <!-- Search input -->
                    <div class="md:col-span-5">
                        <div class="relative">
                            <span class="material-symbols-outlined absolute left-3.5 top-2.5 text-muted text-[18px]">search</span>
                            <input type="text" name="search" value="{{ request('search') }}" placeholder="Tìm kiếm theo tên sân..." class="w-full bg-cream pl-10 pr-4 py-2.5 rounded-xl border border-line text-sm text-ink placeholder:text-muted focus:outline-none focus:border-primary">
                        </div>
                    </div>

                    <!-- Filter sport -->
                    <div class="md:col-span-4">
                        <select name="loai" class="w-full bg-cream px-3.5 py-2.5 rounded-xl border border-line text-sm font-semibold text-ink focus:outline-none focus:border-primary">
                            <option value="">Tất cả các môn thể thao</option>
                            @foreach($loaiSanList as $loai)
                                <option value="{{ $loai->MaLoai }}" {{ request('loai') == $loai->MaLoai ? 'selected' : '' }}>
                                    {{ $loai->TenLoai }} ({{ $loai->san_count }} sân)
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Submit & Reset -->
                    <div class="md:col-span-3 flex items-center gap-2">
                        <button type="submit" class="flex-1 py-2.5 rounded-xl bg-primary hover:bg-primary-hover text-white text-sm font-bold shadow-sm transition-all">
                            Lọc kết quả
                        </button>
                        @if(request('loai') || request('search'))
                            <a href="{{ route('courts.index') }}" class="p-2.5 rounded-xl border border-line text-muted hover:text-ink hover:bg-cream text-xs font-bold transition-all" title="Xóa bộ lọc">
                                <span class="material-symbols-outlined text-[18px]">restart_alt</span>
                            </a>
                        @endif
                    </div>
                </form>
            </div>

            <!-- Courts Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse($courts as $san)
                    <div class="bg-white rounded-2xl border border-line overflow-hidden court-card-transition flex flex-col">
                        <div class="relative h-56 w-full overflow-hidden bg-slate-100 group">
                            <img src="{{ $san->HinhAnh ?? 'https://images.unsplash.com/photo-1529900748604-07564a03e7a6?auto=format&fit=crop&w=800&q=80' }}" 
                                 alt="{{ $san->TenSan }}" 
                                 class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                            
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

                            <div class="absolute top-3 right-3 px-2 py-0.5 rounded-lg bg-black/60 backdrop-blur-md text-white text-xs font-bold flex items-center gap-1">
                                <span class="text-amber-400">★</span> 5.0
                            </div>
                        </div>

                        <div class="p-6 flex-grow flex flex-col justify-between space-y-4">
                            <div>
                                <h3 class="text-xl font-bold text-ink">
                                    {{ $san->TenSan }}
                                </h3>
                                <p class="text-xs text-muted mt-2 leading-relaxed">
                                    {{ $san->MoTa ?? 'Mặt sân thi đấu tiêu chuẩn cao cấp, hệ thống chiếu sáng LED chống chói.' }}
                                </p>
                            </div>

                            <div class="pt-4 border-t border-line flex items-center justify-between">
                                <div>
                                    <span class="text-[11px] text-muted block">Giá thuê sân:</span>
                                    <span class="text-xl font-extrabold text-primary">
                                        {{ number_format($san->GiaThue, 0, ',', '.') }}đ
                                        <span class="text-xs font-normal text-muted">/giờ</span>
                                    </span>
                                </div>
                                <a href="{{ route('booking') }}?sport={{ urlencode($san->loaiSan->TenLoai ?? '') }}&san_id={{ $san->MaSan }}" class="px-4 py-2.5 rounded-xl bg-primary hover:bg-primary-hover text-white text-xs font-bold shadow-sm transition-all flex items-center gap-1.5">
                                    <span>Đặt lịch ngay</span>
                                    <span class="material-symbols-outlined text-[16px]">calendar_month</span>
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full py-16 text-center text-muted bg-white rounded-2xl border border-line">
                        <span class="material-symbols-outlined text-4xl text-muted/50 mb-2">sports</span>
                        <p class="font-bold text-base text-ink">Không tìm thấy sân phù hợp</p>
                        <p class="text-xs text-muted mt-1">Vui lòng thử lại với từ khóa hoặc môn thể thao khác.</p>
                    </div>
                @endforelse
            </div>

            <!-- Pagination -->
            <div class="mt-8">
                {{ $courts->links() }}
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-white border-t border-line py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center text-xs text-muted">
            © {{ date('Y') }} Thể thao Anh Vinh. Hotline hỗ trợ: 0988 123 456.
        </div>
    </footer>
</body>
</html>

