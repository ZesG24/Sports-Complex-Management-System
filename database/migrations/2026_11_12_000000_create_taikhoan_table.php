<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('taikhoan', function (Blueprint $table) {
            $table->id('MaTK');
            $table->string('TenDangNhap')->unique();
            $table->string('MatKhau');
            $table->string('LoaiTK')->default('khachhang'); // 'admin', 'khachhang', 'nhanvien'
            $table->rememberToken();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('taikhoan');
    }
};
