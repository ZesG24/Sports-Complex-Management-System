<?php

namespace Database\Seeders;

use App\Models\LoaiSan;
use App\Models\San;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class SanSeeder extends Seeder
{
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        San::truncate();
        LoaiSan::truncate();
        Schema::enableForeignKeyConstraints();

        // 1. Tạo 3 loại sân
        $loaiBongDa = LoaiSan::create([
            'MaLoai' => 1,
            'TenLoai' => 'Bóng đá',
            'MoTa' => 'Sân bóng đá cỏ nhân tạo cao cấp, đèn chiếu sáng đạt chuẩn thi đấu ban đêm.',
        ]);

        $loaiCauLong = LoaiSan::create([
            'MaLoai' => 2,
            'TenLoai' => 'Cầu lông',
            'MoTa' => 'Sân cầu lông trong nhà có máy lạnh, thảm chuyên dụng chống trượt tiêu chuẩn quốc tế.',
        ]);

        $loaiPickleball = LoaiSan::create([
            'MaLoai' => 3,
            'TenLoai' => 'Pickleball',
            'MoTa' => 'Mặt sân Decoturf cao cấp chống chấn thương, trang bị đèn LED chuẩn giải đấu.',
        ]);

        // 2. Danh sách sân chi tiết
        $sanList = [
            // CẦU LÔNG (3 sân: Sân 1 VIP ở bìa, Sân 2 tiêu chuẩn ở giữa, Sân 3 tiêu chuẩn ở bìa)
            [
                'TenSan' => 'Sân cầu lông 1 (VIP bìa)',
                'MaLoai' => $loaiCauLong->MaLoai,
                'GiaThue' => 200000.00,
                'TinhTrang' => 'trong',
                'MoTa' => 'Sân VIP vị trí bìa rộng rãi, thảm Yonex cao cấp 5mm, không gian riêng tư và ghế nghỉ nệm cao cấp.',
                'HinhAnh' => 'https://i.ibb.co/KpNpqgfx/Gemini-Generated-Image-3iuonn3iuonn3iuo.png',
            ],
            [
                'TenSan' => 'Sân cầu lông 2 (Tiêu chuẩn giữa)',
                'MaLoai' => $loaiCauLong->MaLoai,
                'GiaThue' => 150000.00,
                'TinhTrang' => 'trong',
                'MoTa' => 'Sân tiêu chuẩn nằm ở dãy giữa nhà thi đấu, thảm thi đấu chuẩn BWF, đèn LED chống chói.',
                'HinhAnh' => 'https://i.ibb.co/fGNg8ynK/Gemini-Generated-Image-3iuonn3iuonn3iuo-1.png',
            ],
            [
                'TenSan' => 'Sân cầu lông 3 (Tiêu chuẩn bìa)',
                'MaLoai' => $loaiCauLong->MaLoai,
                'GiaThue' => 170000.00,
                'TinhTrang' => 'trong',
                'MoTa' => 'Sân tiêu chuẩn nằm ở vị trí bìa, thoáng mát gần lối đi, khoảng cách biên rộng rãi hơn sân giữa.',
                'HinhAnh' => 'https://i.ibb.co/vvdMPZfc/n-pickle.png',
            ],

            // PICKLEBALL (3 sân: Sân 1 tiêu chuẩn ở bìa, Sân 2 tiêu chuẩn ở giữa, Sân 3 VIP ở bìa)
            [
                'TenSan' => 'Sân Pickleball 1 (Tiêu chuẩn bìa)',
                'MaLoai' => $loaiPickleball->MaLoai,
                'GiaThue' => 180000.00,
                'TinhTrang' => 'trong',
                'MoTa' => 'Sân tiêu chuẩn nằm ở bìa ngoài thoáng gió, mặt sân Decoturf cao cấp chống trượt, di chuyển thoải mái.',
                'HinhAnh' => 'https://i.ibb.co/ccxSP8mC/Gemini-Generated-Image-3w99tk3w99tk3w99-2.png',
            ],
            [
                'TenSan' => 'Sân Pickleball 2 (Tiêu chuẩn giữa)',
                'MaLoai' => $loaiPickleball->MaLoai,
                'GiaThue' => 150000.00,
                'TinhTrang' => 'trong',
                'MoTa' => 'Sân tiêu chuẩn vị trí ở giữa cụm sân, lưới chuẩn USA Pickleball, hệ thống chiếu sáng 400 Lux.',
                'HinhAnh' => 'https://i.ibb.co/mCRkhMkL/Gemini-Generated-Image-3w99tk3w99tk3w99.png',
            ],
            [
                'TenSan' => 'Sân Pickleball 3 (VIP bìa)',
                'MaLoai' => $loaiPickleball->MaLoai,
                'GiaThue' => 220000.00,
                'TinhTrang' => 'trong',
                'MoTa' => 'Sân VIP biệt lập ở góc bìa, mặt sân chuyên nghiệp giảm chấn tối đa, ghế nghỉ VIP và đèn thi đấu 600 Lux.',
                'HinhAnh' => 'https://i.ibb.co/vvdMPZfc/n-pickle.png',
            ],

            // BÓNG ĐÁ (2 sân mini để đồng bộ với loại sân bóng đá)
            [
                'TenSan' => 'Sân bóng đá 1 (Sân 5 cỏ nhân tạo)',
                'MaLoai' => $loaiBongDa->MaLoai,
                'GiaThue' => 250000.00,
                'TinhTrang' => 'trong',
                'MoTa' => 'Sân 5 người tiêu chuẩn cỏ FIFA Pro, có mái che vòm cao và dàn đèn LED chiếu sáng ban đêm.',
                'HinhAnh' => 'https://images.unsplash.com/photo-1529900748604-07564a03e7a6?auto=format&fit=crop&w=800&q=80',
            ],
            [
                'TenSan' => 'Sân bóng đá 2 (Sân 7 cỏ nhân tạo)',
                'MaLoai' => $loaiBongDa->MaLoai,
                'GiaThue' => 350000.00,
                'TinhTrang' => 'trong',
                'MoTa' => 'Sân 7 người rộng rãi, kích thước chuẩn thi đấu, hạt cao su đàn hồi tốt, tầm nhìn thoáng đãng.',
                'HinhAnh' => 'https://images.unsplash.com/photo-1574629810360-7efbbe195018?auto=format&fit=crop&w=800&q=80',
            ],
        ];

        foreach ($sanList as $data) {
            San::create($data);
        }
    }
}
