<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Đăng ký tài khoản - Thể thao Anh Vinh</title>

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
            padding: 40px 16px;
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

        .register-wrapper {
            position: relative;
            z-index: 2;
            width: 100%;
            max-width: 540px;
        }

        .register-card {
            background: #ffffff;
            border: 1px solid var(--line);
            border-radius: 22px;
            padding: 42px 40px;
            box-shadow: 0 20px 60px rgba(25, 60, 42, 0.08);
        }

        .brand-logo {
            font-family: 'Manrope', sans-serif;
            font-size: 1.35rem;
            font-weight: 800;
            letter-spacing: -0.06em;
            color: var(--ink);
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 22px;
        }

        .brand-mark {
            display: grid;
            place-items: center;
            width: 36px;
            height: 36px;
            border-radius: 11px;
            background: var(--lime);
            font-size: 1.15rem;
            font-weight: 800;
            color: #1c3025;
        }

        .brand-dot {
            color: var(--green);
        }

        .register-eyebrow {
            display: flex;
            align-items: center;
            gap: 8px;
            color: var(--green);
            font-size: 0.72rem;
            font-weight: 800;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            margin-bottom: 8px;
        }

        .register-eyebrow-line {
            width: 20px;
            height: 2px;
            background: var(--green);
        }

        .register-title {
            font-family: 'Manrope', sans-serif;
            font-weight: 800;
            font-size: 1.85rem;
            letter-spacing: -0.04em;
            margin-bottom: 6px;
            color: var(--ink);
        }

        .register-subtitle {
            color: var(--muted);
            font-size: 0.88rem;
            margin-bottom: 24px;
            line-height: 1.5;
        }

        .form-label {
            font-size: 0.78rem;
            font-weight: 700;
            color: var(--ink);
            margin-bottom: 6px;
            letter-spacing: -0.01em;
        }

        .form-label .required-dot {
            color: #e02424;
            margin-left: 2px;
        }

        .form-control {
            height: 48px;
            border: 1px solid var(--line);
            border-radius: 11px;
            font-size: 0.88rem;
            color: var(--ink);
            background: #fafbfa;
            padding: 0 16px;
            transition: all 0.15s ease-in-out;
        }

        .form-control:focus {
            background: #fff;
            border-color: var(--green);
            box-shadow: 0 0 0 3px rgba(21, 143, 104, 0.14);
            color: var(--ink);
        }

        .form-control::placeholder {
            color: #9aa8a1;
            font-size: 0.84rem;
        }

        .form-hint {
            font-size: 0.74rem;
            color: var(--muted);
            margin-top: 5px;
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
            margin-top: 14px;
        }

        .btn-submit:hover {
            background: #0f7a57;
            color: #ffffff;
            box-shadow: 0 10px 24px rgba(21, 143, 104, 0.28);
        }

        .back-home-link {
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

        .back-home-link:hover {
            color: var(--green);
        }

        .auth-switch {
            text-align: center;
            margin-top: 22px;
            padding-top: 18px;
            border-top: 1px solid var(--line);
            font-size: 0.85rem;
            color: var(--muted);
        }

        .auth-switch a {
            color: var(--green);
            font-weight: 700;
            text-decoration: none;
        }

        .auth-switch a:hover {
            text-decoration: underline;
        }

        @media (max-width: 575.98px) {
            .register-card {
                padding: 30px 22px;
            }
        }
    </style>
</head>

<body>
    <div class="bg-pattern"></div>
    <div class="bg-glow"></div>
    <div class="bg-glow-bottom"></div>

    <div class="register-wrapper">
        <div class="register-card">
            <a href="{{ route('home') }}" class="brand-logo">
                <span class="brand-mark">AV</span>
                <span>Thể thao Anh Vinh<span class="brand-dot">.</span></span>
            </a>

            <div class="register-eyebrow">
                <span class="register-eyebrow-line"></span>
                <span>Đăng ký thành viên</span>
            </div>

            <h1 class="register-title">Tạo tài khoản mới</h1>
            <p class="register-subtitle">Điền thông tin để tham gia đặt sân và mua sắm phụ kiện thể thao.</p>

            @if ($errors->any())
            <div class="alert alert-danger py-2 px-3 small rounded-3 mb-3" style="font-size: 0.82rem; background: #fde8e8; border-color: #fbd5d5; color: #9b1c1c;">
                @foreach ($errors->all() as $error)
                <div>• {{ $error }}</div>
                @endforeach
            </div>
            @endif

            <form action="{{ route('register') }}" method="POST">
                @csrf

                <!-- Họ và tên -->
                <div class="mb-3">
                    <label for="HoTen" class="form-label">Họ và tên <span class="required-dot">*</span></label>
                    <input type="text"
                        class="form-control @error('HoTen') is-invalid @enderror"
                        id="HoTen"
                        name="HoTen"
                        value="{{ old('HoTen') }}"
                        placeholder="Ví dụ: Nguyễn Văn A"
                        required
                        autofocus>
                </div>

                <!-- SĐT và Email trên 2 cột (hoặc 1 cột mobile) -->
                <div class="row g-3 mb-3">
                    <div class="col-sm-6">
                        <label for="SDT" class="form-label">Số điện thoại <span class="required-dot">*</span></label>
                        <input type="tel"
                            class="form-control @error('SDT') is-invalid @enderror"
                            id="SDT"
                            name="SDT"
                            value="{{ old('SDT') }}"
                            placeholder="0912345678"
                            required>
                    </div>
                    <div class="col-sm-6">
                        <label for="Email" class="form-label">Email <span class="required-dot">*</span></label>
                        <input type="email"
                            class="form-control @error('Email') is-invalid @enderror"
                            id="Email"
                            name="Email"
                            value="{{ old('Email') }}"
                            placeholder="email@example.com"
                            required>
                    </div>
                    <div class="col-12 mt-1">
                        <div class="form-hint">🔒 Email này sẽ được dùng để nhận mã xác thực OTP.</div>
                    </div>
                </div>

                <!-- Tên đăng nhập -->
                <div class="mb-3">
                    <label for="TenDangNhap" class="form-label">Tên đăng nhập <span class="required-dot">*</span></label>
                    <input type="text"
                        class="form-control @error('TenDangNhap') is-invalid @enderror"
                        id="TenDangNhap"
                        name="TenDangNhap"
                        value="{{ old('TenDangNhap') }}"
                        placeholder="Chọn tên đăng nhập (chữ & số, không dấu)"
                        required>
                </div>

                <!-- Mật khẩu và Xác nhận mật khẩu -->
                <div class="row g-3 mb-4">
                    <div class="col-sm-6">
                        <label for="MatKhau" class="form-label">Mật khẩu <span class="required-dot">*</span></label>
                        <input type="password"
                            class="form-control @error('MatKhau') is-invalid @enderror"
                            id="MatKhau"
                            name="MatKhau"
                            placeholder="Ít nhất 6 ký tự"
                            required>
                    </div>
                    <div class="col-sm-6">
                        <label for="MatKhau_confirmation" class="form-label">Xác nhận mật khẩu <span class="required-dot">*</span></label>
                        <input type="password"
                            class="form-control"
                            id="MatKhau_confirmation"
                            name="MatKhau_confirmation"
                            placeholder="Nhập lại mật khẩu"
                            required>
                    </div>
                </div>

                <button type="submit" class="btn btn-submit">
                    <span>Tiếp tục nhận mã OTP</span>
                    <span>→</span>
                </button>
            </form>

            <div class="auth-switch">
                Đã có tài khoản? <a href="{{ route('login') }}">Đăng nhập ngay</a>
            </div>

            <div class="text-center">
                <a href="{{ route('home') }}" class="back-home-link">
                    <span>←</span> Quay lại Trang chủ
                </a>
            </div>
        </div>
    </div>
</body>

</html>

