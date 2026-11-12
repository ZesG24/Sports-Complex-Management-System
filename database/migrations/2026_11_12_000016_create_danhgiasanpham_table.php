<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('danhgiasanpham', function (Blueprint $table) {
            $table->id('MaDGSanPham');
            $table->unsignedBigInteger('MaKH');
            $table->unsignedBigInteger('MaDonHang');
            $table->unsignedBigInteger('MaSanPham');
            $table->tinyInteger('Diem'); // 1-5
            $table->text('NoiDung')->nullable();
            $table->date('NgayDanhGia');
            $table->timestamps();

            $table->foreign('MaKH')->references('MaKH')->on('khachhang')->onDelete('cascade');
            $table->foreign('MaDonHang')->references('MaDonHang')->on('donhang')->onDelete('cascade');
            $table->foreign('MaSanPham')->references('MaSanPham')->on('sanpham')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('danhgiasanpham');
    }
};

