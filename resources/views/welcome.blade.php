<!DOCTYPE html>
<html lang="vi">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="Đặt sân tại Thể thao Anh Vinh nhanh chóng, tiện lợi và minh bạch.">
        <title>Thể thao Anh Vinh - Đặt sân dễ dàng</title>

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Manrope:wght@500;600;700;800&display=swap" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body>
        <header class="site-header">
            <nav class="navbar navbar-expand-lg">
                <div class="container">
                    <a class="navbar-brand d-flex align-items-center gap-2" href="#trang-chu" aria-label="Thể thao Anh Vinh trang chủ">
                        <span class="brand-mark">AV</span>
                        <span>Thể thao Anh Vinh<span class="brand-dot">.</span></span>
                    </a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavigation" aria-controls="mainNavigation" aria-expanded="false" aria-label="Mở menu">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="mainNavigation">
                        <ul class="navbar-nav mx-auto gap-lg-3">
                            <li class="nav-item"><a class="nav-link active" href="#trang-chu">Trang chủ</a></li>
                            <li class="nav-item"><a class="nav-link" href="#loai-san">Loại sân</a></li>
                            <li class="nav-item"><a class="nav-link" href="{{ route('store') }}">Cửa hàng</a></li>
                        </ul>
                        <div class="d-flex align-items-center gap-3 mt-3 mt-lg-0">
                            @auth
                                <div class="user-greeting-pill">
                                    <span class="user-avatar-circle">{{ strtoupper(substr(Auth::user()->TenDangNhap, 0, 1)) }}</span>
                                    <span class="user-info-text">
                                        <span>Xin chào,</span>
                                        <strong class="user-name">{{ Auth::user()->TenDangNhap }}</strong>
                                        <span class="user-role-badge badge-{{ Auth::user()->LoaiTK }}">{{ Auth::user()->LoaiTK === 'owner' ? 'Chủ sân' : (Auth::user()->LoaiTK === 'admin' ? 'Admin' : 'Khách hàng') }}</span>
                                    </span>
                                    <form action="{{ route('logout') }}" method="POST" class="d-inline m-0">
                                        @csrf
                                        <button type="submit" class="btn-logout" title="Đăng xuất">Đăng xuất</button>
                                    </form>
                                </div>
                            @else
                                <a class="login-link" href="{{ route('login') }}">Đăng nhập</a>
                                <a class="register-link" href="{{ route('register') }}">Đăng ký</a>
                            @endauth
                        </div>
                    </div>
                </div>
            </nav>
        </header>

        <main id="trang-chu">
            <section class="hero-section">
                <div class="hero-pattern"></div>
                <div class="container position-relative">
                    <div class="row align-items-center g-5">
                        <div class="col-lg-6">
                            <span class="eyebrow"><span class="eyebrow-line"></span> THỂ THAO ANH VINH</span>
                            <h1>Chơi thể thao.<br><span class="text-primary">Đặt sân thật dễ.</span></h1>
                            <p class="hero-copy">Chọn môn thể thao, tìm khung giờ phù hợp và đặt sân tại Thể thao Anh Vinh chỉ trong vài bước.</p>
                            <div class="hero-proof d-flex align-items-center gap-3">
                                <div class="avatar-stack" aria-hidden="true"><span>MH</span><span>TN</span><span>LK</span><span class="avatar-more">+</span></div>
                                <div><strong>Sân chất lượng</strong><span> phục vụ mỗi ngày</span><div class="stars">★★★★★ <small>Không gian sạch sẽ, tiện nghi</small></div></div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="hero-visual">
                                <div class="visual-card visual-card-top"><span class="mini-icon">✓</span><div><strong>Đặt sân thành công!</strong><small>Sân 1 · Hôm nay, 19:00</small></div></div>
                                <div class="court-scene">
                                    <div class="court-lines"></div><span class="player player-one"></span><span class="player player-two"></span><span class="ball"></span>
                                </div>
                                <div class="visual-card visual-card-bottom"><span class="mini-icon time-icon">◷</span><div><strong>Khung giờ linh hoạt</strong><small>Chọn giờ chơi theo lịch của bạn</small></div></div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section class="booking-strip" id="dat-san">
                <div class="container">
                    <div class="booking-box">
                        <div class="booking-heading"><span class="search-badge">⌕</span><div><h2>Tìm sân phù hợp</h2><p>Điền thông tin để bắt đầu</p></div></div>
                        <form class="row g-3 align-items-end" id="bookingForm">
                            <div class="col-md-8 col-lg-8"><label for="sportType">Môn thể thao</label><select class="form-select" id="sportType"><option value="">Chọn môn thể thao</option><option value="football">Bóng đá</option><option value="badminton">Cầu lông</option><option value="pickleball">Pickleball</option></select></div>
                            <div class="col-md-4 col-lg-4"><button class="btn btn-primary w-100" type="submit">Chọn ngày và giờ <span class="arrow">→</span></button></div>
                        </form>
                        <div class="form-message" id="formMessage" role="status"></div>
                    </div>
                </div>
            </section>

            <section class="section-space" id="loai-san">
                <div class="container">
                    <div class="section-heading d-flex justify-content-between align-items-end">
                        <div><span class="eyebrow">CHỌN MÔN THỂ THAO</div>
                        <a class="text-link d-none d-md-block" href="#dat-san">Xem tất cả sân <span>→</span></a>
                    </div>
                    <div class="row g-4 mt-2">
                        <div class="col-md-4"><a class="sport-card football-card" href="{{ route('booking', ['sport' => 'football']) }}"><div class="sport-illustration football-ball">⚽</div><div class="sport-card-content"><span>01</span><h3>Bóng đá</h3><p>Sân 5, sân 7 chất lượng cao</p><b>Khám phá <span>→</span></b></div></a></div>
                        <div class="col-md-4"><a class="sport-card badminton-card" href="{{ route('booking', ['sport' => 'badminton']) }}"><div class="sport-illustration badminton-racket">◌</div><div class="sport-card-content"><span>02</span><h3>Cầu lông</h3><p>Không gian thoải mái, chuyên nghiệp</p><b>Khám phá <span>→</span></b></div></a></div>
                        <div class="col-md-4"><a class="sport-card pickleball-card" href="{{ route('booking', ['sport' => 'pickleball']) }}"><div class="sport-illustration pickleball-paddle">●</div><div class="sport-card-content"><span>03</span><h3>Pickleball</h3><p>Trải nghiệm môn thể thao mới</p><b>Khám phá <span>→</span></b></div></a></div>
                    </div>
                </div>
            </section>

        </main>
        <footer class="site-footer"><div class="container d-flex flex-column flex-md-row justify-content-between align-items-center gap-3"><a class="navbar-brand d-flex align-items-center gap-2" href="#trang-chu"><span class="brand-mark">AV</span><span>Thể thao Anh Vinh<span class="brand-dot">.</span></span></a><p class="mb-0">© 2025 Thể thao Anh Vinh. Cùng nhau sống năng động hơn.</p><div class="footer-links"><a href="#dat-san">Trợ giúp</a><a href="#dat-san">Điều khoản</a><a href="#dat-san">Liên hệ</a></div></div></footer>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>
