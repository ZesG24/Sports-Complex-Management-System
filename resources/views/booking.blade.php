<!DOCTYPE html>
<html lang="vi">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="Chọn sân, ngày và khung giờ phù hợp tại Thể thao Anh Vinh.">
        <title>Đặt sân - Thể thao Anh Vinh</title>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Manrope:wght@500;600;700;800&display=swap" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="booking-page">
        <header class="site-header booking-header">
            <nav class="navbar navbar-expand-lg">
                <div class="container">
                    <a class="navbar-brand d-flex align-items-center gap-2" href="{{ url('/') }}" aria-label="Thể thao Anh Vinh trang chủ">
                        <span class="brand-mark">AV</span><span>Thể thao Anh Vinh<span class="brand-dot">.</span></span>
                    </a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#bookingNavigation" aria-label="Mở menu">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="bookingNavigation">
                        <ul class="navbar-nav mx-auto gap-lg-3">
                            <li class="nav-item"><a class="nav-link" href="{{ url('/') }}">Trang chủ</a></li>
                            <li class="nav-item"><a class="nav-link active" href="{{ route('booking') }}">Đặt sân</a></li>
                            <li class="nav-item"><a class="nav-link" href="{{ route('store') }}">Cửa hàng</a></li>
                        </ul>
                        <div class="d-flex align-items-center gap-3 mt-3 mt-lg-0">
                            <a class="login-link" href="#">Đăng nhập</a>
                            <a class="register-link" href="#">Đăng ký</a>
                        </div>
                    </div>
                </div>
            </nav>
        </header>

        <main>
            <section class="booking-hero">
                <div class="hero-pattern"></div>
                <div class="container position-relative">
                    <div class="booking-breadcrumb"><a href="{{ url('/') }}">Trang chủ</a><span>→</span><strong>Đặt sân</strong></div>
                    <div class="row align-items-end g-4">
                        <div class="col-lg-7">
                            <span class="eyebrow"><span class="eyebrow-line"></span> BẮT ĐẦU CUỘC VUI</span>
                            <h1>Chọn sân.<br><span class="text-primary">Lên lịch chơi.</span></h1>
                            <p class="hero-copy mb-0">Chọn ngày và thời lượng chơi. Thể thao Anh Vinh sẽ hiển thị những sân còn trống phù hợp với môn thể thao bạn đã chọn.</p>
                            <p class="booking-context">Môn thể thao đã chọn: <strong id="selectedSportLabel">—</strong></p>
                        </div>
                        <div class="col-lg-5">
                            <div class="booking-progress">
                                <div class="progress-step is-active"><span>1</span><small>Môn thể thao</small></div>
                                <i></i>
                                <div class="progress-step is-active"><span>2</span><small>Chọn sân</small></div>
                                <i></i>
                                <div class="progress-step"><span>3</span><small>Xác nhận</small></div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section class="booking-workspace">
                <div class="container">
                    <div class="booking-toolbar">
                        <div class="toolbar-item">
                            <span class="toolbar-icon">▣</span>
                            <div><label for="bookingDate">Ngày đặt sân</label><input id="bookingDate" class="form-control" type="date"></div>
                        </div>
                        <div class="toolbar-item">
                            <span class="toolbar-icon">◷</span>
                            <div><label for="bookingDuration">Thời lượng chơi</label><select id="bookingDuration" class="form-select"><option value="">Chọn thời lượng</option><option value="60">60 phút</option><option value="90">90 phút</option><option value="120">120 phút</option></select></div>
                        </div>
                        <div class="toolbar-note"><button class="btn btn-primary rounded-pill filter-submit" id="filterCourts" type="button">Lọc sân trống <span>→</span></button></div>
                    </div>

                    <div class="row g-4 align-items-start">
                        <div class="col-xl-8">
                            <div class="results-heading d-flex justify-content-between align-items-end">
                                <div><span class="eyebrow">GỢI Ý CHO BẠN</span><h2>Sân còn trống</h2></div>
                            </div>
                            <div class="form-message text-danger" id="filterMessage" role="status"></div>
                            <div class="court-list d-none" id="courtList">
                                <article class="court-card" data-sport="football">
                                    <div class="court-thumb court-thumb-riverside"><span class="court-label">NỔI BẬT</span><span class="court-symbol">⚽</span></div>
                                    <div class="court-info"><div class="d-flex justify-content-between gap-3"><div><h3>Sân 1</h3></div><div class="court-rating">★ 4.9</div></div><div class="court-meta"><span>▣ Sân 5 người</span><span>◷ Mở đến 23:00</span></div><div class="time-slots" data-court="Sân 1"><button class="time-slot" type="button" data-time="17:00 – 18:30">17:00 – 18:30</button><button class="time-slot" type="button" data-time="18:30 – 20:00">18:30 – 20:00</button><button class="time-slot" type="button" data-time="20:00 – 21:30">20:00 – 21:30</button></div><div class="court-bottom"><strong>250.000đ <small>/ 60 phút</small></strong><button class="choose-court" type="button">Chọn sân <span>→</span></button></div></div>
                                </article>
                                <article class="court-card" data-sport="football">
                                    <div class="court-thumb court-thumb-greenfield"><span class="court-symbol">✦</span></div>
                                    <div class="court-info"><div class="d-flex justify-content-between gap-3"><div><h3>Sân 2</h3></div><div class="court-rating">★ 4.8</div></div><div class="court-meta"><span>▣ Sân 7 người</span><span>◷ Mở đến 22:00</span></div><div class="time-slots" data-court="Sân 2"><button class="time-slot" type="button" data-time="16:00 – 18:00">16:00 – 18:00</button><button class="time-slot" type="button" data-time="18:00 – 20:00">18:00 – 20:00</button><button class="time-slot" type="button" data-time="20:00 – 21:00">20:00 – 21:00</button></div><div class="court-bottom"><strong>320.000đ <small>/ 60 phút</small></strong><button class="choose-court" type="button">Chọn sân <span>→</span></button></div></div>
                                </article>
                                <article class="court-card" data-sport="badminton pickleball">
                                    <div class="court-thumb court-thumb-central"><span class="court-symbol">◌</span></div>
                                    <div class="court-info"><div class="d-flex justify-content-between gap-3"><div><h3>Sân 3</h3></div><div class="court-rating">★ 4.7</div></div><div class="court-meta"><span>▣ 8 sân trong nhà</span><span>◷ Mở đến 22:30</span></div><div class="time-slots" data-court="Sân 3"><button class="time-slot" type="button" data-time="17:30 – 19:00">17:30 – 19:00</button><button class="time-slot" type="button" data-time="19:00 – 20:30">19:00 – 20:30</button><button class="time-slot" type="button" data-time="20:30 – 21:30">20:30 – 21:30</button></div><div class="court-bottom"><strong>180.000đ <small>/ 60 phút</small></strong><button class="choose-court" type="button">Chọn sân <span>→</span></button></div></div>
                                </article>
                            </div>
                        </div>

                        <aside class="col-xl-4">
                            <div class="booking-summary">
                                <div class="summary-top"><div><span class="eyebrow">TÓM TẮT LỰA CHỌN</span><h2>Thông tin đặt sân</h2></div><span class="summary-icon">⌑</span></div>
                                <div class="summary-empty" id="summaryEmpty"><div class="empty-icon">◷</div><strong>Chưa chọn khung giờ</strong><p>Hãy chọn sân và giờ chơi phù hợp ở danh sách bên trái.</p></div>
                                <div class="summary-selected d-none" id="summarySelected"><div class="selected-court"><span class="selected-icon">✓</span><div><strong id="selectedCourt">Sân 1</strong><small id="selectedLocation">Bóng đá · Sân 5 người</small></div></div><dl><div><dt>Ngày đặt sân</dt><dd id="selectedDate">—</dd></div><div><dt>Khung giờ</dt><dd id="selectedTime">—</dd></div><div><dt>Thời lượng</dt><dd id="selectedDuration">—</dd></div></dl><div class="summary-total"><span>Tạm tính</span><strong id="selectedPrice">—</strong></div><button class="btn btn-primary w-100 rounded-pill summary-continue" type="button">Tiếp tục đặt sân <span>→</span></button></div>
                                <p class="summary-help">Bạn có thể thay đổi lựa chọn trước khi xác nhận.</p>
                            </div>
                        </aside>
                    </div>
                </div>
            </section>
        </main>
        <footer class="site-footer"><div class="container d-flex flex-column flex-md-row justify-content-between align-items-center gap-3"><a class="navbar-brand d-flex align-items-center gap-2" href="{{ url('/') }}"><span class="brand-mark">AV</span><span>Thể thao Anh Vinh<span class="brand-dot">.</span></span></a><p class="mb-0">© 2025 Thể thao Anh Vinh. Cùng nhau sống năng động hơn.</p><div class="footer-links"><a href="#">Trợ giúp</a><a href="#">Điều khoản</a><a href="#">Liên hệ</a></div></div></footer>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>
