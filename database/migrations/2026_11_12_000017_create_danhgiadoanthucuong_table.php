<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('danhgiadoanthucuong', function (Blueprint $table) {
            $table->id('MaDGDoAn');
            $table->unsignedBigInteger('MaKH');
            $table->unsignedBigInteger('MaDonHang');
            $table->unsignedBigInteger('MaTP');
            $table->tinyInteger('Diem'); // 1-5
            $table->text('NoiDung')->nullable();
            $table->date('NgayDanhGia');
            $table->timestamps();

            $table->foreign('MaKH')->references('MaKH')->on('khachhang')->onDelete('cascade');
            $table->foreign('MaDonHang')->references('MaDonHang')->on('donhang')->onDelete('cascade');
            $table->foreign('MaTP')->references('MaTP')->on('doanvathucuong')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('danhgiadoanthucuong');
    }
};

