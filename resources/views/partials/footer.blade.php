<!-- ==================== FOOTER: ANH VINH ATHLETIC TURF & CLAY ==================== -->
<footer class="w-full bg-[#14261e] text-[#faf9f4] border-t border-[#2e4d3f] pt-10 pb-8 mt-auto">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 mb-8">
            <!-- Cột 1: Thương hiệu -->
            <div>
                <div class="flex items-center gap-2.5 mb-3">
                    <span class="w-8 h-8 bg-[#faf9f4] text-[#14261e] rounded-[4px] flex items-center justify-center font-bold text-sm">
                        AV
                    </span>
                    <span class="text-lg font-bold text-[#faf9f4] tracking-tight">
                        Thể thao Anh Vinh.
                    </span>
                </div>
                <p class="text-sm text-[#d2e8db]/85 leading-relaxed">
                    Khu phức hợp thể thao đa năng phục vụ tập luyện và thi đấu hàng ngày.
                </p>
            </div>

            <!-- Cột 2: Liên kết -->
            <div>
                <h4 class="text-xs font-bold text-[#faf9f4] tracking-wider uppercase mb-4">
                    LIÊN KẾT
                </h4>
                <ul class="space-y-2 text-sm text-[#d2e8db]/85">
                    <li><a href="{{ route('home') }}" class="hover:text-white transition-colors">Trang chủ</a></li>
                    <li><a href="{{ route('booking') }}" class="hover:text-white transition-colors">Đặt sân thể thao</a></li>
                    <li><a href="{{ route('home') }}#matchmaking" class="hover:text-white transition-colors">Tìm bạn chơi</a></li>
                    <li><a href="{{ route('store') }}" class="hover:text-white transition-colors">Cửa hàng dụng cụ</a></li>
                </ul>
            </div>

            <!-- Cột 3: Bộ môn phục vụ -->
            <div>
                <h4 class="text-xs font-bold text-[#faf9f4] tracking-wider uppercase mb-4">
                    BỘ MÔN PHỤC VỤ
                </h4>
                <ul class="space-y-2 text-sm text-[#d2e8db]/85">
                    @if(isset($loaiSanList) && count($loaiSanList) > 0)
                        @foreach($loaiSanList as $loai)
                            <li>{{ $loai->TenLoai }} ({{ $loai->san_count ?? $loai->san()->count() }} sân)</li>
                        @endforeach
                    @else
                        <li>Bóng đá</li>
                        <li>Cầu lông</li>
                        <li>Pickleball</li>
                    @endif
                </ul>
            </div>

            <!-- Cột 4: Thông tin hoạt động -->
            <div>
                <h4 class="text-xs font-bold text-[#faf9f4] tracking-wider uppercase mb-4">
                    THÔNG TIN HOẠT ĐỘNG
                </h4>
                <ul class="space-y-2 text-sm text-[#d2e8db]/85">
                    <li>05:00 – 01:00 (hàng ngày)</li>
                    <li>Hotline: 0988 123 456</li>
                    <li>Khu phức hợp Thể thao Anh Vinh</li>
                </ul>
            </div>
        </div>

        <div class="pt-5 border-t border-[#d2e8db]/20 flex flex-col sm:flex-row items-center justify-between gap-3 text-xs text-[#d2e8db]/75">
            <div>
                © {{ date('Y') }} Thể thao Anh Vinh.
            </div>
            <div class="flex items-center gap-3">
                <a href="{{ route('booking') }}" class="hover:text-white transition-colors">Quy định đặt sân</a>
                <span>·</span>
                <a href="{{ route('booking') }}" class="hover:text-white transition-colors">Chính sách hủy sân</a>
                <span>·</span>
                <a href="{{ route('home') }}" class="hover:text-white transition-colors">Liên hệ</a>
            </div>
        </div>
    </div>
</footer>
