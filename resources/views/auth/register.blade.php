<!DOCTYPE html>
<html class="light" lang="vi">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng ký tài khoản - Thể thao Anh Vinh</title>

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

    <main class="max-w-5xl w-full bg-white border border-line rounded-[6px] overflow-hidden flex flex-col md:flex-row">

        <!-- ==================== CỘT TRÁI (5/12): THƯƠNG HIỆU & TIẾN TRÌNH ==================== -->
        <aside class="md:w-5/12 bg-turf text-stone-canvas p-6 sm:p-8 flex flex-col justify-between gap-8">
            <!-- Thương hiệu -->
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

            <!-- Ảnh mặt sân & Quy trình 2 bước -->
            <div class="space-y-6">
                <div class="relative h-44 w-full rounded-[4px] border border-white/15 overflow-hidden bg-turf-hover hidden sm:block">
                    <img src="https://i.ibb.co/KpNpqgfx/Gemini-Generated-Image-3iuonn3iuonn3iuo.png"
                         alt="Khu phức hợp Thể thao Anh Vinh"
                         class="w-full h-full object-cover">
                </div>

                <!-- Tiến trình 2 bước -->
                <div>
                    <div class="flex items-start gap-3">
                        <span class="w-6 h-6 rounded-full bg-clay text-white font-display font-bold text-xs flex items-center justify-center shrink-0 mt-0.5">
                            1
                        </span>
                        <div>
                            <div class="font-display font-semibold text-sm text-white">
                                Bước 01: Điền thông tin tài khoản
                            </div>
                            <div class="text-xs text-[#d2e8db]/80 mt-0.5">
                                Thông tin cơ bản để khởi tạo hồ sơ hội viên
                            </div>
                        </div>
                    </div>

                    <div class="w-px h-5 bg-white/20 ml-3 my-1"></div>

                    <div class="flex items-start gap-3">
                        <span class="w-6 h-6 rounded-full border border-white/35 text-[#d2e8db]/70 font-display font-semibold text-xs flex items-center justify-center shrink-0 mt-0.5">
                            2
                        </span>
                        <div>
                            <div class="font-display font-medium text-sm text-[#d2e8db]/75">
                                Bước 02: Xác thực mã OTP qua Email
                            </div>
                            <div class="text-xs text-[#d2e8db]/60 mt-0.5">
                                Nhập mã OTP 6 chữ số gửi về hộp thư
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Chân cột trái -->
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

        <!-- ==================== CỘT PHẢI (7/12): FORM ĐĂNG KÝ ==================== -->
        <section class="md:w-7/12 bg-white p-6 sm:p-8 lg:p-10 flex flex-col justify-center">
            <div class="mb-6">
                <span class="font-display text-xs font-bold tracking-wider text-clay uppercase block mb-1">
                    ĐĂNG KÝ THÀNH VIÊN
                </span>
                <h1 class="font-display text-2xl sm:text-3xl font-bold text-turf tracking-tight mb-1.5">
                    Tạo tài khoản mới
                </h1>
                <p class="text-sm text-muted">
                    Điền thông tin để tham gia đặt sân và mua sắm phụ kiện thể thao.
                </p>
            </div>

            @if ($errors->any())
                <div role="alert" tabindex="-1" id="registerErrorSummary" class="mb-5 p-3.5 rounded-[4px] bg-[#ffdad6]/50 border border-clay text-[#93000a] text-xs space-y-1">
                    <div class="font-display font-bold uppercase tracking-wide">Vui lòng kiểm tra lại thông tin:</div>
                    <ul class="list-disc pl-4 space-y-0.5">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('register') }}" method="POST" class="space-y-4" novalidate>
                @csrf

                <!-- 1. Họ và tên -->
                <div>
                    <label for="HoTen" class="block text-xs sm:text-sm font-medium text-turf mb-1.5">
                        Họ và tên <span class="text-clay font-bold">*</span>
                    </label>
                    <input type="text"
                           id="HoTen"
                           name="HoTen"
                           value="{{ old('HoTen') }}"
                           autocomplete="name"
                           placeholder="Ví dụ: Nguyễn Văn A"
                           required
                           autofocus
                           aria-invalid="{{ $errors->has('HoTen') ? 'true' : 'false' }}"
                           @error('HoTen') aria-describedby="HoTen-error" @enderror
                           class="w-full h-[44px] bg-stone-canvas border {{ $errors->has('HoTen') ? 'border-clay' : 'border-line' }} focus:border-turf focus:ring-1 focus:ring-turf focus:bg-white rounded-[4px] px-3.5 text-sm text-ink placeholder:text-subtle transition-colors">
                    @error('HoTen')
                        <p id="HoTen-error" class="mt-1 text-xs text-clay font-medium">{{ $message }}</p>
                    @enderror
                </div>

                <!-- 2. Số điện thoại & Email -->
                <div>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label for="SDT" class="block text-xs sm:text-sm font-medium text-turf mb-1.5">
                                Số điện thoại <span class="text-clay font-bold">*</span>
                            </label>
                            <input type="tel"
                                   id="SDT"
                                   name="SDT"
                                   value="{{ old('SDT') }}"
                                   autocomplete="tel"
                                   placeholder="0912345678"
                                   required
                                   aria-invalid="{{ $errors->has('SDT') ? 'true' : 'false' }}"
                                   @error('SDT') aria-describedby="SDT-error" @enderror
                                   class="w-full h-[44px] bg-stone-canvas border {{ $errors->has('SDT') ? 'border-clay' : 'border-line' }} focus:border-turf focus:ring-1 focus:ring-turf focus:bg-white rounded-[4px] px-3.5 text-sm text-ink placeholder:text-subtle transition-colors">
                            @error('SDT')
                                <p id="SDT-error" class="mt-1 text-xs text-clay font-medium">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="Email" class="block text-xs sm:text-sm font-medium text-turf mb-1.5">
                                Email <span class="text-clay font-bold">*</span>
                            </label>
                            <input type="email"
                                   id="Email"
                                   name="Email"
                                   value="{{ old('Email') }}"
                                   autocomplete="email"
                                   placeholder="email@example.com"
                                   required
                                   aria-describedby="Email-hint{{ $errors->has('Email') ? ' Email-error' : '' }}"
                                   aria-invalid="{{ $errors->has('Email') ? 'true' : 'false' }}"
                                   class="w-full h-[44px] bg-stone-canvas border {{ $errors->has('Email') ? 'border-clay' : 'border-line' }} focus:border-turf focus:ring-1 focus:ring-turf focus:bg-white rounded-[4px] px-3.5 text-sm text-ink placeholder:text-subtle transition-colors">
                            @error('Email')
                                <p id="Email-error" class="mt-1 text-xs text-clay font-medium">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <p id="Email-hint" class="flex items-center gap-1.5 text-xs text-muted mt-1.5">
                        <svg class="w-3.5 h-3.5 text-subtle shrink-0" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75" />
                        </svg>
                        <span>Email này sẽ được dùng để nhận mã xác thực OTP.</span>
                    </p>
                </div>

                <!-- Địa chỉ (tùy chọn) -->
                <div>
                    <label for="DiaChi" class="block text-xs sm:text-sm font-medium text-turf mb-1.5">
                        Địa chỉ
                    </label>
                    <input type="text"
                           id="DiaChi"
                           name="DiaChi"
                           value="{{ old('DiaChi') }}"
                           autocomplete="street-address"
                           placeholder="Số nhà, tên đường, phường/xã, quận/huyện..."
                           aria-invalid="{{ $errors->has('DiaChi') ? 'true' : 'false' }}"
                           @error('DiaChi') aria-describedby="DiaChi-error" @enderror
                           class="w-full h-[44px] bg-stone-canvas border {{ $errors->has('DiaChi') ? 'border-clay' : 'border-line' }} focus:border-turf focus:ring-1 focus:ring-turf focus:bg-white rounded-[4px] px-3.5 text-sm text-ink placeholder:text-subtle transition-colors">
                    @error('DiaChi')
                        <p id="DiaChi-error" class="mt-1 text-xs text-clay font-medium">{{ $message }}</p>
                    @enderror
                </div>

                <!-- 3. Tên đăng nhập -->
                <div>
                    <label for="TenDangNhap" class="block text-xs sm:text-sm font-medium text-turf mb-1.5">
                        Tên đăng nhập <span class="text-clay font-bold">*</span>
                    </label>
                    <input type="text"
                           id="TenDangNhap"
                           name="TenDangNhap"
                           value="{{ old('TenDangNhap') }}"
                           autocomplete="username"
                           placeholder="Chọn tên đăng nhập (chữ và số, không dấu)"
                           required
                           aria-invalid="{{ $errors->has('TenDangNhap') ? 'true' : 'false' }}"
                           @error('TenDangNhap') aria-describedby="TenDangNhap-error" @enderror
                           class="w-full h-[44px] bg-stone-canvas border {{ $errors->has('TenDangNhap') ? 'border-clay' : 'border-line' }} focus:border-turf focus:ring-1 focus:ring-turf focus:bg-white rounded-[4px] px-3.5 text-sm text-ink placeholder:text-subtle transition-colors">
                    @error('TenDangNhap')
                        <p id="TenDangNhap-error" class="mt-1 text-xs text-clay font-medium">{{ $message }}</p>
                    @enderror
                </div>

                <!-- 4. Mật khẩu & Xác nhận mật khẩu -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label for="MatKhau" class="block text-xs sm:text-sm font-medium text-turf mb-1.5">
                            Mật khẩu <span class="text-clay font-bold">*</span>
                        </label>
                        <div class="relative">
                            <input type="password"
                                   id="MatKhau"
                                   name="MatKhau"
                                   autocomplete="new-password"
                                   placeholder="Ít nhất 6 ký tự"
                                   required
                                   aria-invalid="{{ $errors->has('MatKhau') ? 'true' : 'false' }}"
                                   @error('MatKhau') aria-describedby="MatKhau-error" @enderror
                                   class="w-full h-[44px] bg-stone-canvas border {{ $errors->has('MatKhau') ? 'border-clay' : 'border-line' }} focus:border-turf focus:ring-1 focus:ring-turf focus:bg-white rounded-[4px] pl-3.5 pr-10 text-sm text-ink placeholder:text-subtle transition-colors">
                            <button type="button"
                                    data-toggle-password="MatKhau"
                                    aria-label="Hiện hoặc ẩn mật khẩu"
                                    class="absolute right-2.5 top-1/2 -translate-y-1/2 p-1 text-subtle hover:text-turf transition-colors cursor-pointer">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                            </button>
                        </div>
                        @error('MatKhau')
                            <p id="MatKhau-error" class="mt-1 text-xs text-clay font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="MatKhau_confirmation" class="block text-xs sm:text-sm font-medium text-turf mb-1.5">
                            Xác nhận mật khẩu <span class="text-clay font-bold">*</span>
                        </label>
                        <div class="relative">
                            <input type="password"
                                   id="MatKhau_confirmation"
                                   name="MatKhau_confirmation"
                                   autocomplete="new-password"
                                   placeholder="Nhập lại mật khẩu"
                                   required
                                   class="w-full h-[44px] bg-stone-canvas border border-line focus:border-turf focus:ring-1 focus:ring-turf focus:bg-white rounded-[4px] pl-3.5 pr-10 text-sm text-ink placeholder:text-subtle transition-colors">
                            <button type="button"
                                    data-toggle-password="MatKhau_confirmation"
                                    aria-label="Hiện hoặc ẩn xác nhận mật khẩu"
                                    class="absolute right-2.5 top-1/2 -translate-y-1/2 p-1 text-subtle hover:text-turf transition-colors cursor-pointer">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Submit CTA -->
                <div class="pt-2">
                    <button type="submit" class="w-full h-[46px] bg-clay hover:bg-clay-hover text-white font-display font-semibold text-sm rounded-[6px] transition-colors flex items-center justify-center gap-2 cursor-pointer">
                        <span>Tiếp tục nhận mã OTP</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
                        </svg>
                    </button>
                </div>
            </form>

            <!-- Chân Form -->
            <div class="border-t border-line/70 mt-6 pt-5 text-center text-sm text-muted">
                Đã có tài khoản?
                <a href="{{ route('login') }}" class="font-display font-bold text-turf underline decoration-1 underline-offset-4 hover:text-clay transition-colors ml-1">
                    Đăng nhập ngay
                </a>
            </div>
        </section>

    </main>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            document.querySelectorAll('[data-toggle-password]').forEach(btn => {
                btn.addEventListener('click', function () {
                    const input = document.getElementById(this.getAttribute('data-toggle-password'));
                    if (!input) return;
                    input.type = input.type === 'password' ? 'text' : 'password';
                });
            });

            const errorSummary = document.getElementById('registerErrorSummary');
            if (errorSummary) {
                errorSummary.focus();
            }
        });
    </script>
</body>

</html>
