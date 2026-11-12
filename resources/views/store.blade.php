<!DOCTYPE html>
<html lang="vi">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="Mua sắm đồ thể thao và thuê dụng cụ tại Thể thao Anh Vinh.">
        <title>Cửa hàng - Thể thao Anh Vinh</title>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Manrope:wght@500;600;700;800&display=swap" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="store-page">
        <header class="site-header store-header">
            <nav class="navbar navbar-expand-lg">
                <div class="container">
                    <a class="navbar-brand d-flex align-items-center gap-2" href="{{ url('/') }}"><span class="brand-mark">AV</span><span>Thể thao Anh Vinh<span class="brand-dot">.</span></span></a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#storeNavigation" aria-controls="storeNavigation" aria-expanded="false" aria-label="Mở menu"><span class="navbar-toggler-icon"></span></button>
                    <div class="collapse navbar-collapse" id="storeNavigation">
                        <ul class="navbar-nav mx-auto gap-lg-3"><li class="nav-item"><a class="nav-link" href="{{ url('/') }}">Trang chủ</a></li><li class="nav-item"><a class="nav-link" href="{{ route('booking') }}">Đặt sân</a></li><li class="nav-item"><a class="nav-link active" href="{{ route('store') }}">Cửa hàng</a></li></ul>
                        <div class="d-flex align-items-center gap-3 mt-3 mt-lg-0"><a class="login-link" href="#">Đăng nhập</a><button class="store-cart-button" type="button"><span class="store-cart-icon">♧</span><span>Giỏ hàng</span><b id="cartCount">0</b></button></div>
                    </div>
                </div>
            </nav>
        </header>
        <main>
            <section class="store-hero"><div class="hero-pattern"></div><div class="container position-relative"><div class="store-breadcrumb"><a href="{{ url('/') }}">Trang chủ</a><span>→</span><strong>Cửa hàng</strong></div><div class="row align-items-center g-5"><div class="col-lg-6"><span class="eyebrow"><span class="eyebrow-line"></span> CỬA HÀNG THỂ THAO</span><h1>Đủ đồ chơi.<br><span class="text-primary">Đủ năng lượng.</span></h1><p class="hero-copy">Mọi thứ bạn cần cho một buổi vận động trọn vẹn — từ đôi giày đầu tiên đến món nước mát sau trận đấu.</p><a class="btn btn-primary btn-lg" href="#san-pham">Khám phá sản phẩm <span class="arrow">→</span></a></div><div class="col-lg-6"><div class="store-hero-visual"><div class="store-floating-card store-floating-card-top"><span>✦</span><div><strong>Được yêu thích</strong><small>Giày Active Run</small></div></div><div class="store-product-stage"><span class="stage-glow"></span><span class="stage-product">👟</span><span class="stage-label">MOVE<br><small>WITH US</small></span></div><div class="store-floating-card store-floating-card-bottom"><span>✓</span><div><strong>Giao tại sân</strong><small>Tiện lợi sau khi đặt sân</small></div></div></div></div></div></div></section>
            <section class="store-categories" id="san-pham"><div class="container"><div class="section-heading d-flex justify-content-between align-items-end"><div><span class="eyebrow">MUA SẮM THEO NHU CẦU</span><h2>Chọn đúng đồ,<br>chơi đúng gu.</h2></div><span class="store-result-count d-none d-md-block" id="storeResultCount">{{ count($products) }} sản phẩm</span></div><div class="store-category-list" role="tablist" aria-label="Danh mục sản phẩm">@foreach ($categories as $category)<button class="store-category-button {{ $loop->first ? 'is-active' : '' }}" type="button" data-category="{{ $category['slug'] }}" role="tab" aria-selected="{{ $loop->first ? 'true' : 'false' }}"><span>{{ $category['icon'] }}</span>{{ $category['label'] }}</button>@endforeach</div><div class="row g-4 store-product-grid">@foreach ($products as $product)<div class="col-sm-6 col-lg-4 store-product-column" data-product-category="{{ $product['category'] }}"><article class="store-product-card"><div class="store-product-image store-product-image-{{ $product['tone'] }}">@if ($product['badge'])<span class="store-product-badge">{{ $product['badge'] }}</span>@endif<button class="store-wishlist" type="button">♡</button><span class="store-product-emoji">{{ $product['icon'] }}</span></div><div class="store-product-content"><span class="store-product-category">{{ $product['category_label'] }}</span><h3>{{ $product['name'] }}</h3><div class="store-product-footer"><div><strong>{{ $product['price'] }}</strong>@if ($product['old_price'])<del>{{ $product['old_price'] }}</del>@endif</div><button class="store-add-button" type="button" data-product="{{ $product['name'] }}">+</button></div></div></article></div>@endforeach</div><div class="store-empty-state d-none" id="storeEmptyState">Chưa có sản phẩm trong danh mục này.</div></div></section>
            <section class="store-service-strip"><div class="container"><div class="row g-4"><div class="col-md-4"><div class="store-service"><span>↗</span><div><strong>Nhận tại sân</strong><small>Đặt trước, nhận nhanh khi đến chơi</small></div></div></div><div class="col-md-4"><div class="store-service"><span>↻</span><div><strong>Thuê dụng cụ dễ dàng</strong><small>Tiết kiệm cho những buổi chơi bất chợt</small></div></div></div><div class="col-md-4"><div class="store-service"><span>✓</span><div><strong>Sản phẩm chọn lọc</strong><small>Ưu tiên chất lượng và trải nghiệm</small></div></div></div></div></div></section>
        </main>
        <footer class="site-footer"><div class="container d-flex flex-column flex-md-row justify-content-between align-items-center gap-3"><a class="navbar-brand d-flex align-items-center gap-2" href="{{ url('/') }}"><span class="brand-mark">AV</span><span>Thể thao Anh Vinh<span class="brand-dot">.</span></span></a><p class="mb-0">© 2025 Thể thao Anh Vinh. Cùng nhau sống năng động hơn.</p><div class="footer-links"><a href="#">Trợ giúp</a><a href="#">Điều khoản</a><a href="#">Liên hệ</a></div></div></footer>
        <div class="store-toast" id="storeToast" role="status" aria-live="polite"></div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>
