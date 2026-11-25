<?php

namespace Database\Seeders;

use App\Models\PhuKienThue;
use Illuminate\Database\Seeder;

class PhuKienThueSeeder extends Seeder
{
    public function run(): void
    {
        $items = [
            [
                'MaLoai' => 2, // Cầu lông
                'TenPhuKien' => 'Giày cầu lông sân thảm',
                'PhanLoai' => 'giay',
                'GiaThue' => 30000.00,
                'TongSoLuong' => 20,
                'SoLuongKhaDung' => 20,
                'MoTa' => 'Giày đế kếp chuyên dụng chống trượt trên sân thảm cầu lông và pickleball (đủ size 38–44, khách ghi chú size khi thuê).',
                'TinhTrang' => 'hoat_dong',
            ],
            [
                'MaLoai' => 1, // Bóng đá
                'TenPhuKien' => 'Giày bóng đá đinh dăm TF',
                'PhanLoai' => 'giay',
                'GiaThue' => 35000.00,
                'TongSoLuong' => 16,
                'SoLuongKhaDung' => 16,
                'MoTa' => 'Giày đá bóng đinh dăm TF bám sân cỏ nhân tạo (đủ size 39–44, khách ghi chú size khi thuê).',
                'TinhTrang' => 'hoat_dong',
            ],
            [
                'MaLoai' => 2, // Cầu lông
                'TenPhuKien' => 'Vợt cầu lông Li-Ning Carbon',
                'PhanLoai' => 'vot',
                'GiaThue' => 40000.00,
                'TongSoLuong' => 12,
                'SoLuongKhaDung' => 12,
                'MoTa' => 'Vợt cầu lông căng sẵn 10.5kg phù hợp giao lưu và tập luyện.',
                'TinhTrang' => 'hoat_dong',
            ],
            [
                'MaLoai' => 3, // Pickleball
                'TenPhuKien' => 'Vợt Pickleball sợi Carbon',
                'PhanLoai' => 'vot',
                'GiaThue' => 45000.00,
                'TongSoLuong' => 12,
                'SoLuongKhaDung' => 12,
                'MoTa' => 'Vợt Pickleball nhẹ, dễ kiểm soát bóng cho mọi trình độ.',
                'TinhTrang' => 'hoat_dong',
            ],
            [
                'MaLoai' => 1, // Bóng đá
                'TenPhuKien' => 'Bộ áo Bib chia đội (10 áo)',
                'PhanLoai' => 'phu_kien',
                'GiaThue' => 25000.00,
                'TongSoLuong' => 6,
                'SoLuongKhaDung' => 6,
                'MoTa' => 'Bộ 10 áo lưới phân biệt màu đội bóng đá 5 người / 7 người.',
                'TinhTrang' => 'hoat_dong',
            ],
            [
                'MaLoai' => 1, // Bóng đá
                'TenPhuKien' => 'Bóng đá Động Lực thi đấu',
                'PhanLoai' => 'phu_kien',
                'GiaThue' => 20000.00,
                'TongSoLuong' => 10,
                'SoLuongKhaDung' => 10,
                'MoTa' => 'Bóng đá tiêu chuẩn sân cỏ nhân tạo 5 người / 7 người, bơm căng sẵn.',
                'TinhTrang' => 'hoat_dong',
            ],
            [
                'MaLoai' => 1, // Bóng đá
                'TenPhuKien' => 'Găng tay thủ môn có xương',
                'PhanLoai' => 'phu_kien',
                'GiaThue' => 25000.00,
                'TongSoLuong' => 8,
                'SoLuongKhaDung' => 8,
                'MoTa' => 'Găng tay thủ môn mút dày bám bóng, có thanh bảo vệ ngón tay.',
                'TinhTrang' => 'hoat_dong',
            ],
            [
                'MaLoai' => 3, // Pickleball
                'TenPhuKien' => 'Bộ 3 bóng Pickleball thi đấu',
                'PhanLoai' => 'phu_kien',
                'GiaThue' => 15000.00,
                'TongSoLuong' => 15,
                'SoLuongKhaDung' => 15,
                'MoTa' => 'Bộ 3 bóng Pickleball chuẩn 40 lỗ độ nảy ổn định cho sân thi đấu.',
                'TinhTrang' => 'hoat_dong',
            ],
            [
                'MaLoai' => null, // Dùng chung mọi môn
                'TenPhuKien' => 'Bảng lật tỉ số thể thao',
                'PhanLoai' => 'phu_kien',
                'GiaThue' => 20000.00,
                'TongSoLuong' => 6,
                'SoLuongKhaDung' => 6,
                'MoTa' => 'Bảng lật điểm 4 chữ số dùng cho cầu lông, pickleball và giải bóng đá mini.',
                'TinhTrang' => 'hoat_dong',
            ],
        ];

        foreach ($items as $item) {
            PhuKienThue::updateOrCreate(
                ['TenPhuKien' => $item['TenPhuKien']],
                $item
            );
        }
    }
}
