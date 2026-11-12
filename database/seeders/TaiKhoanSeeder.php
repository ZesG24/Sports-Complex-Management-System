<?php

namespace Database\Seeders;

use App\Models\KhachHang;
use App\Models\TaiKhoan;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class TaiKhoanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Tài khoản Chủ sân (Owner - Toàn quyền cấu hình, quản trị)
        TaiKhoan::firstOrCreate(
            ['TenDangNhap' => 'owner'],
            [
                'MatKhau' => Hash::make('owner123'),
                'LoaiTK' => 'owner',
            ]
        );

        // 2. Tài khoản Quản trị viên / POS (Admin - Quản lý, bán hàng tại quầy)
        TaiKhoan::firstOrCreate(
            ['TenDangNhap' => 'admin'],
            [
                'MatKhau' => Hash::make('admin123'),
                'LoaiTK' => 'admin',
            ]
        );

        // 3. Tài khoản Khách hàng (User - Đặt sân, mua sắm online)
        $khachHangTK = TaiKhoan::firstOrCreate(
            ['TenDangNhap' => 'user'],
            [
                'MatKhau' => Hash::make('123456'),
                'LoaiTK' => 'user',
            ]
        );

        // Tạo thông tin khách hàng tương ứng cho tài khoản user
        KhachHang::firstOrCreate(
            ['MaTK' => $khachHangTK->MaTK],
            [
                'HoTen' => 'Nguyễn Văn A',
                'SDT' => '0912345678',
                'Email' => 'khachhang@gmail.com',
                'DiaChi' => 'Quận 1, TP. Hồ Chí Minh',
            ]
        );
    }
}
