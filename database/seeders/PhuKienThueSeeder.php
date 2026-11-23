<?php

namespace Database\Seeders;

use App\Models\PhuKienThue;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class PhuKienThueSeeder extends Seeder
{
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        PhuKienThue::truncate();
        Schema::enableForeignKeyConstraints();

        $items = [
            [
                'TenPhuKien' => 'Giày cầu lông sân thảm',
                'PhanLoai' => 'giay',
                'KichThuoc' => '40',
                'GiaThue' => 30000.00,
                'TienCoc' => 150000.00,
                'TongSoLuong' => 6,
                'SoLuongKhaDung' => 6,
                'MoTa' => 'Giày đế kếp chuyên dụng chống trượt trên sân thảm cầu lông và pickleball.',
                'TinhTrang' => 'hoat_dong',
            ],
            [
                'TenPhuKien' => 'Giày cầu lông sân thảm',
                'PhanLoai' => 'giay',
                'KichThuoc' => '41',
                'GiaThue' => 30000.00,
                'TienCoc' => 150000.00,
                'TongSoLuong' => 8,
                'SoLuongKhaDung' => 8,
                'MoTa' => 'Giày đế kếp chuyên dụng chống trượt trên sân thảm cầu lông và pickleball.',
                'TinhTrang' => 'hoat_dong',
            ],
            [
                'TenPhuKien' => 'Giày cầu lông sân thảm',
                'PhanLoai' => 'giay',
                'KichThuoc' => '42',
                'GiaThue' => 30000.00,
                'TienCoc' => 150000.00,
                'TongSoLuong' => 6,
                'SoLuongKhaDung' => 6,
                'MoTa' => 'Giày đế kếp chuyên dụng chống trượt trên sân thảm cầu lông và pickleball.',
                'TinhTrang' => 'hoat_dong',
            ],
            [
                'TenPhuKien' => 'Giày bóng đá đinh dăm TF',
                'PhanLoai' => 'giay',
                'KichThuoc' => '41',
                'GiaThue' => 35000.00,
                'TienCoc' => 150000.00,
                'TongSoLuong' => 8,
                'SoLuongKhaDung' => 8,
                'MoTa' => 'Giày đá bóng đinh dăm TF bám sân cỏ nhân tạo.',
                'TinhTrang' => 'hoat_dong',
            ],
            [
                'TenPhuKien' => 'Giày bóng đá đinh dăm TF',
                'PhanLoai' => 'giay',
                'KichThuoc' => '42',
                'GiaThue' => 35000.00,
                'TienCoc' => 150000.00,
                'TongSoLuong' => 8,
                'SoLuongKhaDung' => 8,
                'MoTa' => 'Giày đá bóng đinh dăm TF bám sân cỏ nhân tạo.',
                'TinhTrang' => 'hoat_dong',
            ],
            [
                'TenPhuKien' => 'Vợt cầu lông Li-Ning Carbon',
                'PhanLoai' => 'vot',
                'KichThuoc' => 'Freesize',
                'GiaThue' => 40000.00,
                'TienCoc' => 200000.00,
                'TongSoLuong' => 12,
                'SoLuongKhaDung' => 12,
                'MoTa' => 'Vợt cầu lông căng sẵn 10.5kg phù hợp giao lưu và tập luyện.',
                'TinhTrang' => 'hoat_dong',
            ],
            [
                'TenPhuKien' => 'Vợt Pickleball sợi Carbon',
                'PhanLoai' => 'vot',
                'KichThuoc' => 'Freesize',
                'GiaThue' => 45000.00,
                'TienCoc' => 200000.00,
                'TongSoLuong' => 12,
                'SoLuongKhaDung' => 12,
                'MoTa' => 'Vợt Pickleball nhẹ, dễ kiểm soát bóng cho mọi trình độ.',
                'TinhTrang' => 'hoat_dong',
            ],
            [
                'TenPhuKien' => 'Bộ áo Bib chia đội (10 áo)',
                'PhanLoai' => 'phu_kien',
                'KichThuoc' => 'Freesize',
                'GiaThue' => 25000.00,
                'TienCoc' => 100000.00,
                'TongSoLuong' => 6,
                'SoLuongKhaDung' => 6,
                'MoTa' => 'Bộ 10 áo lưới phân biệt màu đội bóng đá 5 người / 7 người.',
                'TinhTrang' => 'hoat_dong',
            ],
        ];

        foreach ($items as $item) {
            PhuKienThue::create($item);
        }
    }
}
