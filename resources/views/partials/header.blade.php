@php
    $active = $active ?? match(true) {
        request()->routeIs('booking*') => 'booking',
        request()->routeIs('store*') => 'store',
        default => 'home',
    };
@endphp

<!-- ==================== HEADER: ANH VINH ATHLETIC TURF & CLAY ==================== -->
<header class="sticky top-0 z-50 w-full h-[76px] bg-white border-b border-[#c2c8c3] flex items-center">
    <div class="max-w-7xl w-full mx-auto px-4 sm:px-6 lg:px-8 flex items-center justify-between gap-4">
        <!-- Brand Logo -->
        <a href="{{ route('home') }}" class="flex items-center gap-3 group shrink-0">
            <span class="w-10 h-10 bg-[#14261e] text-white rounded-[6px] flex items-center justify-center font-bold text-lg tracking-tight">
                AV
            </span>
            <div class="flex flex-col">
                <span class="text-lg sm:text-xl font-bold text-[#14261e] leading-none tracking-tight">
                    Thể thao Anh Vinh.
                </span>
                <span class="text-[10px] font-semibold tracking-widest text-[#737874] uppercase mt-1">
                    KHU PHỨC HỢP THỂ THAO
                </span>
            </div>
        </a>

        <!-- Navigation Links -->
        <nav class="hidden md:flex items-center gap-8">
            <a href="{{ route('home') }}"
               class="text-sm pb-1 transition-colors {{ $active === 'home' ? 'font-bold text-[#14261e] border-b-2 border-[#b02d1c]' : 'font-semibold text-[#424844] hover:text-[#14261e]' }}">
                Trang chủ
            </a>

            <a href="{{ route('booking') }}"
               class="text-sm pb-1 transition-colors {{ $active === 'booking' ? 'font-bold text-[#14261e] border-b-2 border-[#b02d1c]' : 'font-semibold text-[#424844] hover:text-[#14261e]' }}">
                Đặt sân
            </a>

            <a href="{{ route('home') }}#matchmaking"
               class="text-sm font-semibold text-[#424844] hover:text-[#14261e] pb-1 flex items-center gap-1.5 transition-colors">
                <span>Tìm bạn chơi</span>
                <span class="bg-[#b02d1c] text-white text-[10px] font-bold px-1.5 py-0.5 rounded-[3px] leading-tight tracking-wide">
                    MỚI
                </span>
            </a>

            <a href="{{ route('store') }}"
               class="text-sm pb-1 transition-colors {{ $active === 'store' ? 'font-bold text-[#14261e] border-b-2 border-[#b02d1c]' : 'font-semibold text-[#424844] hover:text-[#14261e]' }}">
                Cửa hàng
            </a>
        </nav>

        <!-- Auth Actions -->
        <div class="flex items-center gap-3 shrink-0">
            @auth
                <div class="flex items-center gap-2.5 pl-3 border-l border-[#c2c8c3]">
                    <a href="{{ route('dashboard') }}" class="flex items-center gap-2.5 group cursor-pointer" title="Vào trang cá nhân">
                        <span class="w-9 h-9 rounded-full bg-[#e9e8e3] border border-[#c2c8c3] flex items-center justify-center text-[#14261e] font-bold text-sm">
                            {{ strtoupper(substr(Auth::user()->TenDangNhap, 0, 1)) }}
                        </span>
                        <div class="flex flex-col text-left">
                            <div class="flex items-center gap-1.5">
                                <span class="text-xs font-semibold text-[#14261e] group-hover:text-[#b02d1c] transition-colors truncate max-w-[100px] sm:max-w-[140px]">
                                    {{ Auth::user()->TenDangNhap }}
                                </span>
                                <span class="px-1.5 py-0.5 rounded-[3px] text-[10px] font-bold uppercase {{ Auth::user()->khachHang?->hangThanhVien ? 'bg-[#FEF3C7] border border-[#F59E0B]/50 text-[#92400E]' : 'bg-[#e9e8e3] text-[#14261e]' }}">
                                    {{ Auth::user()->ten_hang_thanh_vien }}
                                </span>
                            </div>
                        </div>
                    </a>
                    <form action="{{ route('logout') }}" method="POST" class="inline m-0">
                        @csrf
                        <button type="submit" class="p-1.5 text-[#424844] hover:text-[#b02d1c] rounded-[4px] hover:bg-[#f5f4ef] transition-colors cursor-pointer" title="Đăng xuất" aria-label="Đăng xuất">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15m3 0l3-3m0 0l-3-3m3 3H9" />
                            </svg>
                        </button>
                    </form>
                </div>
            @else
                <a href="{{ route('login') }}" class="text-sm font-semibold text-[#424844] hover:text-[#14261e] px-2.5 py-2 transition-colors">
                    Đăng nhập
                </a>
                <a href="{{ route('register') }}" class="bg-[#14261e] hover:bg-[#07281c] text-white text-sm font-semibold px-5 py-2.5 rounded-[6px] transition-colors">
                    Đăng ký
                </a>
            @endauth
        </div>
    </div>
</header>
