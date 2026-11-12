<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Chi tiết đơn hàng sản phẩm (DONHANG ↔ BIENTHESANPHAM)
        Schema::create('chitietdonhang_sanpham', function (Blueprint $table) {
            $table->unsignedBigInteger('MaDonHang');
            $table->unsignedBigInteger('MaBienThe');
            $table->integer('SoLuong');
            $table->decimal('DonGiaBan', 10, 2);

            $table->primary(['MaDonHang', 'MaBienThe']);
            $table->foreign('MaDonHang')->references('MaDonHang')->on('donhang')->onDelete('cascade');
            $table->foreign('MaBienThe')->references('MaBienThe')->on('bienthesanpham')->onDelete('cascade');
        });

        // Chi tiết đơn hàng đồ ăn thức uống (DONHANG ↔ DOANVATHUCUONG)
        Schema::create('chitietdonhang_doanthucuong', function (Blueprint $table) {
            $table->unsignedBigInteger('MaDonHang');
            $table->unsignedBigInteger('MaTP');
            $table->integer('SoLuong');
            $table->decimal('DonGiaBan', 10, 2);

            $table->primary(['MaDonHang', 'MaTP']);
            $table->foreign('MaDonHang')->references('MaDonHang')->on('donhang')->onDelete('cascade');
            $table->foreign('MaTP')->references('MaTP')->on('doanvathucuong')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('chitietdonhang_doanthucuong');
        Schema::dropIfExists('chitietdonhang_sanpham');
    }
};

