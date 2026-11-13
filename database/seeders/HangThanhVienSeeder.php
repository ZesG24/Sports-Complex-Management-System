<?php

namespace Database\Seeders;

use App\Models\HangThanhVien;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class HangThanhVienSeeder extends Seeder
{
    public function run(): void
    {
        $tiers = [
            [
                'MaHang' => 1,
                'TenHang' => 'VIP 1',
                'ChiTieuToiThieu' => 1000000,
                'PhanTramGiamGia' => 5.00,
                'QuyenLoi' => 'Giảm 5% chi phí đặt sân và mua sản phẩm.',
            ],
            [
                'MaHang' => 2,
                'TenHang' => 'VIP 2',
                'ChiTieuToiThieu' => 5000000,
                'PhanTramGiamGia' => 10.00,
                'QuyenLoi' => 'Giảm 10% chi phí đặt sân, miễn phí nước suối.',
            ],
            [
                'MaHang' => 3,
                'TenHang' => 'VIP 3',
                'ChiTieuToiThieu' => 15000000,
                'PhanTramGiamGia' => 15.00,
                'QuyenLoi' => 'Giảm 15% chi phí đặt sân và mua sắm, miễn phí nước suối.',
            ],
        ];

        Schema::disableForeignKeyConstraints();
        HangThanhVien::truncate();
        Schema::enableForeignKeyConstraints();

        foreach ($tiers as $tier) {
            HangThanhVien::create($tier);
        }
    }
}
