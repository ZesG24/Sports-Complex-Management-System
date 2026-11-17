<!DOCTYPE html>
<html class="light" lang="vi">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập - Thể thao Anh Vinh</title>

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

<body class="bg-stone-low text-ink font-sans antialiased min-h-screen flex items-center justify-center py-8 px-4 sm:px-6">

    <main class="max-w-4xl w-full bg-white border border-line rounded-[6px] overflow-hidden flex flex-col md:flex-row">

        <!-- ==================== CỘT TRÁI (5/12): THƯƠNG HIỆU & THÔNG TIN HỘI VIÊN ==================== -->
        <aside class="md:w-5/12 bg-turf text-stone-canvas p-6 sm:p-8 flex flex-col justify-between gap-8">
            <div>
                <a href="{{ route('home') }}" class="inline-flex items-center gap-3 group">
                    <span class="w-10 h-10 rounded-[4px] bg-white text-turf flex items-center justify-center font-display font-bold text-base tracking-tight shrink-0">
                        AV
                    </span>
                    <div class="flex flex-col">
                        <span class="font-display font-bold text-lg text-white leading-tight tracking-tight">
                            Thể thao Anh Vinh.
                        </span>
                        <span class="font-display text-[10px] tracking-widest text-[#d2e8db]/75 uppercase font-semibold mt-0.5">
                            KHU PHỨC HỢP THỂ THAO
                        </span>
                    </div>
                </a>
            </div>

            <div class="space-y-5">
                <div class="relative h-40 w-full rounded-[4px] border border-white/15 overflow-hidden bg-turf-hover hidden sm:block">
                    <img src="https://i.ibb.co/KpNpqgfx/Gemini-Generated-Image-3iuonn3iuonn3iuo.png"
                         alt="Khu phức hợp Thể thao Anh Vinh"
                         class="w-full h-full object-cover">
                </div>

                <ul class="space-y-3 text-xs sm:text-sm text-[#d2e8db]/90 leading-relaxed">
                    <li class="flex items-start gap-2.5">
                        <svg class="w-4 h-4 text-[#d2e8db] shrink-0 mt-0.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                        </svg>
                        <span>Quản lý lịch đặt sân &amp; theo dõi thời gian giữ chỗ trực tiếp</span>
                    </li>
                    <li class="flex items-start gap-2.5">
                        <svg class="w-4 h-4 text-[#d2e8db] shrink-0 mt-0.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                        </svg>
                        <span>Tự động tích lũy chi tiêu nâng hạng hội viên VIP</span>
                    </li>
                </ul>
            </div>

            <div class="border-t border-white/15 pt-4 flex items-center justify-between gap-2 text-xs text-[#d2e8db]/80 font-display">
                <a href="{{ route('home') }}" class="inline-flex items-center gap-1.5 hover:text-white transition-colors">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
                    </svg>
                    <span>Quay lại Trang chủ</span>
                </a>
                <span>05:00 – 01:00</span>
            </div>
        </aside>

        <!-- ==================== CỘT PHẢI (7/12): FORM ĐĂNG NHẬP ==================== -->
        <section class="md:w-7/12 bg-white p-6 sm:p-8 lg:p-10 flex flex-col justify-center">
            <div class="mb-6">
                <span class="font-display text-xs font-bold tracking-wider text-clay uppercase block mb-1">
                    ĐĂNG NHẬP HỆ THỐNG
                </span>
                <h1 class="font-display text-2xl sm:text-3xl font-bold text-turf tracking-tight mb-1.5">
                    Chào mừng trở lại!
                </h1>
                <p class="text-sm text-muted">
                    Đăng nhập để đặt sân và quản lý lịch hoạt động của bạn.
                </p>
            </div>

            @if ($errors->any())
                <div role="alert" tabindex="-1" id="loginErrorSummary" class="mb-5 p-3.5 rounded-[4px] bg-[#ffdad6]/50 border border-clay text-[#93000a] text-xs space-y-0.5">
                    @foreach ($errors->all() as $error)
                        <div>{{ $error }}</div>
                    @endforeach
                </div>
            @endif

            @if (session('success'))
                <div role="status" class="mb-5 p-3.5 rounded-[4px] bg-[#d2e8db]/60 border border-turf/30 text-turf text-xs font-medium">
                    {{ session('success') }}
                </div>
            @endif

            <form action="{{ route('login') }}" method="POST" class="space-y-4" novalidate>
                @csrf

                <!-- 1. Tên đăng nhập -->
                <div>
                    <label for="TenDangNhap" class="block text-sm font-medium text-turf mb-1.5">
                        Tên đăng nhập
                    </label>
                    <input type="text"
                           id="TenDangNhap"
                           name="TenDangNhap"
                           value="{{ old('TenDangNhap') }}"
                           autocomplete="username"
                           placeholder="Nhập tên đăng nhập"
                           required
                           autofocus
                           aria-invalid="{{ $errors->has('TenDangNhap') ? 'true' : 'false' }}"
                           @error('TenDangNhap') aria-describedby="TenDangNhap-error" @enderror
                           class="w-full h-[46px] bg-stone-canvas border {{ $errors->has('TenDangNhap') ? 'border-clay' : 'border-line' }} focus:border-turf focus:ring-1 focus:ring-turf focus:bg-white rounded-[4px] px-3.5 text-sm text-ink placeholder:text-subtle transition-colors">
                    @error('TenDangNhap')
                        <p id="TenDangNhap-error" class="mt-1 text-xs text-clay font-medium">{{ $message }}</p>
                    @enderror
                </div>

                <!-- 2. Mật khẩu -->
                <div>
                    <label for="MatKhau" class="block text-sm font-medium text-turf mb-1.5">
                        Mật khẩu
                    </label>
                    <div class="relative">
                        <input type="password"
                               id="MatKhau"
                               name="MatKhau"
                               autocomplete="current-password"
                               placeholder="Nhập mật khẩu của bạn"
                               required
                               aria-invalid="{{ $errors->has('MatKhau') ? 'true' : 'false' }}"
                               @error('MatKhau') aria-describedby="MatKhau-error" @enderror
                               class="w-full h-[46px] bg-stone-canvas border {{ $errors->has('MatKhau') ? 'border-clay' : 'border-line' }} focus:border-turf focus:ring-1 focus:ring-turf focus:bg-white rounded-[4px] pl-3.5 pr-11 text-sm text-ink placeholder:text-subtle transition-colors">
                        <button type="button"
                                id="btnToggleLoginPassword"
                                aria-label="Hiện hoặc ẩn mật khẩu"
                                class="absolute right-3 top-1/2 -translate-y-1/2 p-1 text-subtle hover:text-turf transition-colors cursor-pointer">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.6" viewBox="0 0 24 24" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                        </button>
                    </div>
                    @error('MatKhau')
                        <p id="MatKhau-error" class="mt-1 text-xs text-clay font-medium">{{ $message }}</p>
                    @enderror
                </div>

                <!-- 3. Ghi nhớ đăng nhập -->
                <div class="flex items-center pt-0.5">
                    <label for="remember" class="inline-flex items-center gap-2.5 text-sm text-muted cursor-pointer select-none">
                        <input type="checkbox"
                               name="remember"
                               id="remember"
                               {{ old('remember') ? 'checked' : '' }}
                               class="w-4 h-4 rounded-[3px] border-line text-turf focus:ring-turf cursor-pointer">
                        <span>Ghi nhớ đăng nhập</span>
                    </label>
                </div>

                <!-- 4. Nút Đăng nhập -->
                <div class="pt-1">
                    <button type="submit" class="w-full h-[46px] bg-clay hover:bg-clay-hover text-white font-display font-semibold text-sm rounded-[6px] transition-colors flex items-center justify-center gap-2 cursor-pointer">
                        <span>Đăng nhập ngay</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
                        </svg>
                    </button>
                </div>
            </form>

            <!-- Chân Form -->
            <div class="border-t border-line/70 mt-6 pt-5 text-center text-sm text-muted">
                Chưa có tài khoản?
                <a href="{{ route('register') }}" class="font-display font-bold text-turf underline decoration-1 underline-offset-4 hover:text-clay transition-colors ml-1">
                    Đăng ký ngay
                </a>
            </div>
        </section>

    </main>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const toggleBtn = document.getElementById('btnToggleLoginPassword');
            const pwdInput = document.getElementById('MatKhau');
            if (toggleBtn && pwdInput) {
                toggleBtn.addEventListener('click', function () {
                    pwdInput.type = pwdInput.type === 'password' ? 'text' : 'password';
                });
            }

            const errorSummary = document.getElementById('loginErrorSummary');
            if (errorSummary) {
                errorSummary.focus();
            }
        });
    </script>
</body>

</html>
