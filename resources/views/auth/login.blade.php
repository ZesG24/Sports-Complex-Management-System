<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Đăng nhập - Thể thao Anh Vinh</title>

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

        .login-wrapper {
            position: relative;
            z-index: 2;
            width: 100%;
            max-width: 460px;
        }

        .login-card {
            background: #ffffff;
            border: 1px solid var(--line);
            border-radius: 22px;
            padding: 40px 36px;
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
            margin-bottom: 24px;
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

        .login-eyebrow {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            color: var(--green);
            font-size: 0.72rem;
            font-weight: 800;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            margin-bottom: 8px;
        }

        .login-eyebrow-line {
            width: 18px;
            height: 2px;
            background: var(--green);
            border-radius: 2px;
        }

        .login-title {
            font-family: 'Manrope', sans-serif;
            font-weight: 800;
            font-size: 1.75rem;
            letter-spacing: -0.04em;
            color: var(--ink);
            margin-bottom: 6px;
        }

        .login-subtitle {
            color: var(--muted);
            font-size: 0.92rem;
            line-height: 1.5;
            margin-bottom: 28px;
        }

        .form-label {
            font-size: 0.8rem;
            font-weight: 700;
            color: var(--ink);
            margin-bottom: 6px;
        }

        .form-control {
            height: 48px;
            border: 1px solid var(--line);
            background: #fff;
            border-radius: 12px;
            font-size: 0.92rem;
            color: var(--ink);
            padding: 10px 16px;
            transition: border-color 0.2s, box-shadow 0.2s;
        }

        .form-control:focus {
            border-color: var(--green);
            box-shadow: 0 0 0 3px rgba(21, 143, 104, 0.15);
            color: var(--ink);
            background: #fff;
        }

        .form-control::placeholder {
            color: #a4b0a9;
            font-size: 0.88rem;
        }

        .btn-submit {
            height: 48px;
            background: var(--green);
            border: 1px solid var(--green);
            border-radius: 12px;
            color: #fff;
            font-weight: 700;
            font-size: 0.92rem;
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            transition: all 0.2s ease;
            box-shadow: 0 8px 20px rgba(21, 143, 104, 0.2);
        }

        .btn-submit:hover {
            background: #0d7654;
            border-color: #0d7654;
            color: #fff;
            transform: translateY(-1px);
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
            margin-top: 24px;
            transition: color 0.15s;
        }

        .back-home-link:hover {
            color: var(--green);
        }
    </style>
</head>

<body>
    <div class="bg-pattern"></div>
    <div class="bg-glow"></div>
    <div class="bg-glow-bottom"></div>

    <div class="login-wrapper">
        <div class="login-card">
            <a href="{{ route('home') }}" class="brand-logo">
                <span class="brand-mark">AV</span>
                <span>Thể thao Anh Vinh<span class="brand-dot">.</span></span>
            </a>

            <div class="login-eyebrow">
                <span class="login-eyebrow-line"></span>
                <span>Đăng nhập hệ thống</span>
            </div>

            <h1 class="login-title">Chào mừng trở lại!</h1>


            @if ($errors->any())
            <div class="alert alert-danger py-2 px-3 small rounded-3 mb-3" style="font-size: 0.82rem; background: #fde8e8; border-color: #fbd5d5; color: #9b1c1c;">
                @foreach ($errors->all() as $error)
                <div>• {{ $error }}</div>
                @endforeach
            </div>
            @endif

            @if (session('success'))
            <div class="alert alert-success py-2 px-3 small rounded-3 mb-3" style="font-size: 0.82rem; background: #e4f6e8; border-color: #c9e6d3; color: #158f68;">
                {{ session('success') }}
            </div>
            @endif

            <form action="{{ url('/login') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="TenDangNhap" class="form-label">Tên đăng nhập</label>
                    <input type="text"
                        class="form-control @error('TenDangNhap') is-invalid @enderror"
                        id="TenDangNhap"
                        name="TenDangNhap"
                        value="{{ old('TenDangNhap') }}"
                        placeholder="Nhập tên đăng nhập"
                        required
                        autofocus>
                </div>

                <div class="mb-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <label for="MatKhau" class="form-label mb-0">Mật khẩu</label>
                    </div>
                    <input type="password"
                        class="form-control @error('MatKhau') is-invalid @enderror mt-1"
                        id="MatKhau"
                        name="MatKhau"
                        placeholder="Nhập mật khẩu của bạn"
                        required>
                </div>

                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }} style="border-color: #c1cdc5;">
                        <label class="form-check-label text-muted" for="remember" style="font-size: 0.82rem;">
                            Ghi nhớ đăng nhập
                        </label>
                    </div>
                </div>

                <button type="submit" class="btn btn-submit">
                    <span>Đăng nhập ngay</span>
                    <span>→</span>
                </button>
            </form>

            <div class="text-center mt-4" style="font-size: 0.85rem; color: var(--muted);">
                Chưa có tài khoản? <a href="{{ route('register') }}" style="color: var(--green); font-weight: 700; text-decoration: none;">Đăng ký ngay</a>
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