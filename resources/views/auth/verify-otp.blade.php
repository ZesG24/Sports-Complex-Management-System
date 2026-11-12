<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Xác thực mã OTP - Thể thao Anh Vinh</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Manrope:wght@600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        :root {
            --ink: #17231f;
            --muted: #71807a;
            --green: #158f68;
            --lime: #d8f46e;
            --cream: #f7f9f4;
            --line: #e4eae5;
        }

        body {
            margin: 0;
            background-color: var(--cream);
            color: var(--ink);
            font-family: 'DM Sans', sans-serif;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 30px 16px;
            position: relative;
            overflow-x: hidden;
        }

        .bg-pattern {
            position: absolute;
            inset: 0;
            background-image: radial-gradient(#dce8df 1.2px, transparent 1.2px);
            background-size: 20px 20px;
            opacity: 0.8;
            pointer-events: none;
        }

        .bg-glow {
            position: absolute;
            width: 500px;
            height: 500px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(216, 244, 110, 0.45) 0%, rgba(247, 249, 244, 0) 70%);
            top: -150px;
            right: -100px;
            pointer-events: none;
        }

        .bg-glow-bottom {
            position: absolute;
            width: 450px;
            height: 450px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(21, 143, 104, 0.12) 0%, rgba(247, 249, 244, 0) 70%);
            bottom: -150px;
            left: -100px;
            pointer-events: none;
        }

        .otp-wrapper {
            position: relative;
            z-index: 2;
            width: 100%;
            max-width: 480px;
        }

        .otp-card {
            background: #ffffff;
            border: 1px solid var(--line);
            border-radius: 22px;
            padding: 42px 36px;
            box-shadow: 0 20px 60px rgba(25, 60, 42, 0.08);
            text-align: center;
        }

        .otp-icon-wrapper {
            display: inline-grid;
            place-items: center;
            width: 64px;
            height: 64px;
            border-radius: 20px;
            background: #ebf7e8;
            color: var(--green);
            font-size: 1.8rem;
            margin-bottom: 20px;
        }

        .otp-title {
            font-family: 'Manrope', sans-serif;
            font-weight: 800;
            font-size: 1.75rem;
            letter-spacing: -0.04em;
            margin-bottom: 8px;
            color: var(--ink);
        }

        .otp-subtitle {
            color: var(--muted);
            font-size: 0.88rem;
            line-height: 1.55;
            margin-bottom: 24px;
        }

        .otp-subtitle strong {
            color: var(--ink);
        }

        /* 6 ô OTP */
        .otp-inputs {
            display: flex;
            gap: 10px;
            justify-content: center;
            margin: 24px 0;
        }

        .otp-digit {
            width: 48px;
            height: 56px;
            border: 2px solid var(--line);
            border-radius: 12px;
            background: #fafbfa;
            font-family: 'Manrope', sans-serif;
            font-size: 1.5rem;
            font-weight: 800;
            color: var(--ink);
            text-align: center;
            transition: all 0.15s ease-in-out;
        }

        .otp-digit:focus {
            background: #fff;
            border-color: var(--green);
            box-shadow: 0 0 0 4px rgba(21, 143, 104, 0.15);
            outline: none;
        }

        .btn-submit {
            height: 48px;
            background: var(--green);
            color: #ffffff;
            font-weight: 700;
            font-size: 0.92rem;
            border-radius: 11px;
            border: none;
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            transition: all 0.2s;
            margin-top: 10px;
        }

        .btn-submit:hover {
            background: #0f7a57;
            color: #ffffff;
            box-shadow: 0 10px 24px rgba(21, 143, 104, 0.28);
        }

        .demo-otp-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 8px 14px;
            border-radius: 999px;
            background: #fdf3cf;
            border: 1px solid #fae8a4;
            color: #8c6808;
            font-size: 0.8rem;
            font-weight: 700;
            margin-bottom: 20px;
        }

        .demo-otp-badge code {
            font-size: 1rem;
            font-weight: 800;
            color: #725200;
            letter-spacing: 2px;
            background: transparent;
            padding: 0;
        }

        .resend-box {
            margin-top: 24px;
            padding-top: 18px;
            border-top: 1px solid var(--line);
            font-size: 0.85rem;
            color: var(--muted);
        }

        .btn-resend {
            background: none;
            border: none;
            color: var(--green);
            font-weight: 700;
            padding: 0;
            cursor: pointer;
            text-decoration: underline;
        }

        .btn-resend:disabled {
            color: #a1aca5;
            cursor: not-allowed;
            text-decoration: none;
        }

        .back-link {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            color: var(--muted);
            font-size: 0.84rem;
            font-weight: 600;
            text-decoration: none;
            margin-top: 20px;
            transition: color 0.15s;
        }

        .back-link:hover {
            color: var(--green);
        }
    </style>
</head>

<body>
    <div class="bg-pattern"></div>
    <div class="bg-glow"></div>
    <div class="bg-glow-bottom"></div>

    <div class="otp-wrapper">
        <div class="otp-card">
            <div class="otp-icon-wrapper">
                ✉️
            </div>

            <h1 class="otp-title">Xác thực mã OTP</h1>
            <p class="otp-subtitle">
                Chúng tôi đã gửi mã xác thực 6 chữ số đến địa chỉ email<br>
                <strong>{{ $maskedEmail }}</strong>
            </p>

            @if ($errors->any())
            <div class="alert alert-danger py-2 px-3 small rounded-3 mb-3 text-start" style="font-size: 0.82rem; background: #fde8e8; border-color: #fbd5d5; color: #9b1c1c;">
                @foreach ($errors->all() as $error)
                <div>• {{ $error }}</div>
                @endforeach
            </div>
            @endif

            @if (session('success'))
            <div class="alert alert-success py-2 px-3 small rounded-3 mb-3 text-start" style="font-size: 0.82rem; background: #e4f6e8; border-color: #c9e6d3; color: #158f68;">
                {{ session('success') }}
            </div>
            @endif

            <form id="otpForm" action="{{ route('register.verify-otp.submit') }}" method="POST">
                @csrf
                <input type="hidden" name="otp" id="fullOtpInput">

                <div class="otp-inputs">
                    <input type="text" class="otp-digit" inputmode="numeric" maxlength="1" pattern="[0-9]*" autofocus required>
                    <input type="text" class="otp-digit" inputmode="numeric" maxlength="1" pattern="[0-9]*" required>
                    <input type="text" class="otp-digit" inputmode="numeric" maxlength="1" pattern="[0-9]*" required>
                    <input type="text" class="otp-digit" inputmode="numeric" maxlength="1" pattern="[0-9]*" required>
                    <input type="text" class="otp-digit" inputmode="numeric" maxlength="1" pattern="[0-9]*" required>
                    <input type="text" class="otp-digit" inputmode="numeric" maxlength="1" pattern="[0-9]*" required>
                </div>

                <button type="submit" class="btn btn-submit" id="submitBtn">
                    <span>Xác nhận & Hoàn tất</span>
                    <span>→</span>
                </button>
            </form>

            <div class="resend-box">
                <form id="resendForm" action="{{ route('register.resend-otp') }}" method="POST" style="display: inline;">
                    @csrf
                    <span>Chưa nhận được mã? </span>
                    <button type="submit" class="btn-resend" id="resendBtn" {{ $secondsRemaining > 0 ? 'disabled' : '' }}>
                        Gửi lại mã OTP
                    </button>
                    <span id="countdownText" style="{{ $secondsRemaining > 0 ? '' : 'display: none;' }}">
                        (<span id="timer">{{ $secondsRemaining }}</span>s)
                    </span>
                </form>
            </div>

            <div>
                <a href="{{ route('register') }}" class="back-link">
                    <span>←</span> Thay đổi thông tin đăng ký
                </a>
            </div>
        </div>
    </div>

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
                        // Tự động submit khi đã nhập đủ 6 số
                        otpForm.submit();
                    }
                });

                input.addEventListener('keydown', function (e) {
                    if (e.key === 'Backspace' && !input.value && index > 0) {
                        digits[index - 1].focus();
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

            // Đồng hồ đếm ngược gửi lại OTP
            let seconds = {{ (int) $secondsRemaining }};
            const timerEl = document.getElementById('timer');
            const countdownEl = document.getElementById('countdownText');
            const resendBtn = document.getElementById('resendBtn');

            if (seconds > 0) {
                const interval = setInterval(function () {
                    seconds--;
                    if (timerEl) timerEl.textContent = seconds;

                    if (seconds <= 0) {
                        clearInterval(interval);
                        if (countdownEl) countdownEl.style.display = 'none';
                        if (resendBtn) resendBtn.removeAttribute('disabled');
                    }
                }, 1000);
            }
        });
    </script>
</body>

</html>

