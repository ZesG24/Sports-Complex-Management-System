<!DOCTYPE html>
<html class="light" lang="vi">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Xác thực mã OTP - Thể thao Anh Vinh</title>

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

        <!-- ==================== CỘT TRÁI (5/12): THƯƠNG HIỆU & TIẾN TRÌNH ==================== -->
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

            <div class="space-y-6">
                <div class="relative h-40 w-full rounded-[4px] border border-white/15 overflow-hidden bg-turf-hover hidden sm:block">
                    <img src="https://i.ibb.co/KpNpqgfx/Gemini-Generated-Image-3iuonn3iuonn3iuo.png"
                         alt="Khu phức hợp Thể thao Anh Vinh"
                         class="w-full h-full object-cover">
                </div>

                <!-- Tiến trình 2 bước: Bước 1 hoàn tất, Bước 2 đang chọn -->
                <div>
                    <div class="flex items-start gap-3">
                        <span class="w-6 h-6 rounded-full border border-[#d2e8db]/50 text-[#d2e8db] flex items-center justify-center shrink-0 mt-0.5">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                            </svg>
                        </span>
                        <div>
                            <div class="font-display font-medium text-sm text-[#d2e8db]/85">
                                Bước 01: Điền thông tin tài khoản
                            </div>
                            <div class="text-xs text-[#d2e8db]/60 mt-0.5">
                                Đã ghi nhận thông tin đăng ký
                            </div>
                        </div>
                    </div>

                    <div class="w-px h-5 bg-white/25 ml-3 my-1"></div>

                    <div class="flex items-start gap-3">
                        <span class="w-6 h-6 rounded-full bg-clay text-white font-display font-bold text-xs flex items-center justify-center shrink-0 mt-0.5">
                            2
                        </span>
                        <div>
                            <div class="font-display font-semibold text-sm text-white">
                                Bước 02: Xác thực mã OTP qua Email
                            </div>
                            <div class="text-xs text-[#d2e8db]/80 mt-0.5">
                                Nhập mã OTP 6 chữ số để kích hoạt tài khoản
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="border-t border-white/15 pt-4 flex items-center justify-between gap-2 text-xs text-[#d2e8db]/80 font-display">
                <a href="{{ route('register') }}" class="inline-flex items-center gap-1.5 hover:text-white transition-colors">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
                    </svg>
                    <span>Thay đổi thông tin đăng ký</span>
                </a>
                <span>05:00 – 01:00</span>
            </div>
        </aside>

        <!-- ==================== CỘT PHẢI (7/12): NHẬP MÃ OTP ==================== -->
        <section class="md:w-7/12 bg-white p-6 sm:p-8 lg:p-10 flex flex-col justify-center">
            <div class="flex items-center justify-between gap-3 mb-5">
                <span class="w-11 h-11 rounded-[6px] bg-stone-low border border-line flex items-center justify-center text-turf">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75" />
                    </svg>
                </span>
                <span class="bg-[#ffdad4]/70 text-[#8e1306] font-display text-[11px] font-bold tracking-wider uppercase px-2.5 py-1 rounded-[4px]">
                    BƯỚC 02 / XÁC THỰC EMAIL
                </span>
            </div>

            <h1 class="font-display text-2xl sm:text-3xl font-bold text-turf tracking-tight mb-2">
                Xác thực mã OTP
            </h1>
            <p class="text-sm text-muted leading-relaxed mb-5">
                Chúng tôi đã gửi mã xác thực 6 chữ số đến địa chỉ email
                <strong class="font-display text-turf font-bold block sm:inline mt-0.5 sm:mt-0">{{ $email ?? $maskedEmail }}</strong>
            </p>

            @if ($errors->any())
                <div role="alert" tabindex="-1" id="otpErrorSummary" class="mb-4 p-3 rounded-[4px] bg-[#ffdad6]/50 border border-clay text-[#93000a] text-xs space-y-0.5">
                    @foreach ($errors->all() as $error)
                        <div>{{ $error }}</div>
                    @endforeach
                </div>
            @endif

            @if (session('success'))
                <div role="status" class="mb-4 p-3 rounded-[4px] bg-[#d2e8db]/60 border border-turf/30 text-turf text-xs font-medium">
                    {{ session('success') }}
                </div>
            @endif

            <form id="otpForm" action="{{ route('register.verify-otp.submit') }}" method="POST">
                @csrf
                <input type="hidden" name="otp" id="fullOtpInput">

                <!-- 6 ô nhập số OTP (Cho phép dán trực tiếp theo chuẩn WCAG 2.2 AA) -->
                <div class="grid grid-cols-6 gap-2 sm:gap-3 my-4" role="group" aria-label="Mã xác thực OTP 6 chữ số">
                    @for ($i = 1; $i <= 6; $i++)
                        <input type="text"
                               inputmode="numeric"
                               maxlength="1"
                               pattern="[0-9]*"
                               aria-label="Chữ số OTP thứ {{ $i }}"
                               @if ($i === 1) autocomplete="one-time-code" autofocus @endif
                               required
                               class="otp-digit w-full h-13 sm:h-14 rounded-[4px] bg-stone-canvas border border-line focus:border-2 focus:border-turf focus:ring-0 focus:bg-white font-display text-xl sm:text-2xl font-bold text-turf text-center transition-colors p-0">
                    @endfor
                </div>

                <p class="text-xs text-subtle mb-5">
                    Bạn có thể dán trực tiếp mã OTP 6 chữ số vào ô đầu tiên.
                </p>

                <button type="submit" id="submitBtn" class="w-full h-[46px] bg-clay hover:bg-clay-hover text-white font-display font-semibold text-sm rounded-[6px] transition-colors flex items-center justify-center gap-2 cursor-pointer">
                    <span>Xác nhận &amp; Hoàn tất</span>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
                    </svg>
                </button>
            </form>

            <!-- Gửi lại mã & điều hướng -->
            <div class="border-t border-line/70 mt-6 pt-5 space-y-3 text-xs sm:text-sm">
                <form id="resendForm" action="{{ route('register.resend-otp') }}" method="POST" class="flex items-center justify-between gap-2">
                    @csrf
                    <span class="text-muted">Chưa nhận được mã?</span>
                    <span class="font-display">
                        <button type="submit"
                                id="resendBtn"
                                {{ $secondsRemaining > 0 ? 'disabled' : '' }}
                                class="font-bold text-turf underline decoration-1 underline-offset-4 hover:text-clay disabled:text-subtle disabled:no-underline disabled:cursor-not-allowed cursor-pointer transition-colors">
                            Gửi lại mã OTP
                        </button>
                        <span id="countdownText" class="text-clay font-bold ml-1" style="{{ $secondsRemaining > 0 ? '' : 'display: none;' }}">
                            (<span id="timer">{{ $secondsRemaining }}</span>s)
                        </span>
                    </span>
                </form>

                <div class="flex items-center justify-between gap-2 pt-1 text-xs text-subtle">
                    <a href="{{ route('register') }}" class="font-display font-semibold text-turf hover:text-clay transition-colors">
                        ← Thay đổi thông tin đăng ký
                    </a>
                    <span>Hotline: 0988 123 456</span>
                </div>
            </div>
        </section>

    </main>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const digits = Array.from(document.querySelectorAll('.otp-digit'));
            const fullInput = document.getElementById('fullOtpInput');
            const otpForm = document.getElementById('otpForm');

            function updateFullInput() {
                const code = digits.map(d => d.value).join('');
                fullInput.value = code;
                return code;
            }

            digits.forEach((input, index) => {
                input.addEventListener('input', function (e) {
                    const val = e.target.value.replace(/[^0-9]/g, '');
                    e.target.value = val ? val[0] : '';

                    if (val && index < digits.length - 1) {
                        digits[index + 1].focus();
                    }

                    const fullCode = updateFullInput();
                    if (fullCode.length === 6) {
                        otpForm.submit();
                    }
                });

                input.addEventListener('keydown', function (e) {
                    if (e.key === 'Backspace' && !input.value && index > 0) {
                        digits[index - 1].focus();
                    } else if (e.key === 'ArrowLeft' && index > 0) {
                        digits[index - 1].focus();
                    } else if (e.key === 'ArrowRight' && index < digits.length - 1) {
                        digits[index + 1].focus();
                    }
                });

                input.addEventListener('paste', function (e) {
                    e.preventDefault();
                    const pastedData = (e.clipboardData || window.clipboardData).getData('text').replace(/[^0-9]/g, '');
                    if (!pastedData) return;

                    for (let i = 0; i < digits.length; i++) {
                        digits[i].value = pastedData[i] || '';
                    }

                    const targetIndex = Math.min(pastedData.length, digits.length - 1);
                    digits[targetIndex].focus();

                    const fullCode = updateFullInput();
                    if (fullCode.length === 6) {
                        otpForm.submit();
                    }
                });
            });

            otpForm.addEventListener('submit', function (e) {
                const code = updateFullInput();
                if (code.length !== 6) {
                    e.preventDefault();
                    alert('Vui lòng nhập đủ 6 chữ số mã OTP.');
                    digits.find(d => !d.value)?.focus();
                }
            });

            let seconds = {{ (int) $secondsRemaining }};
            const timerEl = document.getElementById('timer');
            const countdownEl = document.getElementById('countdownText');
            const resendBtn = document.getElementById('resendBtn');

            if (seconds > 0) {
                const interval = setInterval(function () {
                    seconds--;
                    if (timerEl) timerEl.textContent = String(seconds);

                    if (seconds <= 0) {
                        clearInterval(interval);
                        if (countdownEl) countdownEl.style.display = 'none';
                        if (resendBtn) resendBtn.removeAttribute('disabled');
                    }
                }, 1000);
            }

            const errorSummary = document.getElementById('otpErrorSummary');
            if (errorSummary) {
                errorSummary.focus();
            }
        });
    </script>
</body>

</html>
