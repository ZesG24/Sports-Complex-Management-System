<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('phieunhapsanpham', function (Blueprint $table) {
            $table->id('MaNhap');
            $table->string('NhaCungCap');
            $table->date('NgayNhap');
            $table->text('GhiChu')->nullable();
            $table->timestamps();
        });

        // Chi tiết nhập sản phẩm (PHIEUNHAPSANPHAM ↔ BIENTHESANPHAM)
        Schema::create('chitietnhapsanpham', function (Blueprint $table) {
            $table->unsignedBigInteger('MaNhap');
            $table->unsignedBigInteger('MaBienThe');
            $table->integer('SoLuongNhap');
            $table->decimal('DonGiaMua', 10, 2);

            $table->primary(['MaNhap', 'MaBienThe']);
            $table->foreign('MaNhap')->references('MaNhap')->on('phieunhapsanpham')->onDelete('cascade');
            $table->foreign('MaBienThe')->references('MaBienThe')->on('bienthesanpham')->onDelete('cascade');
        });

        // Chi tiết nhập đồ ăn thức uống (PHIEUNHAPSANPHAM ↔ DOANVATHUCUONG)
        Schema::create('chitietnhap_doanthucuong', function (Blueprint $table) {
            $table->unsignedBigInteger('MaNhap');
            $table->unsignedBigInteger('MaTP');
            $table->integer('SoLuongNhap');
            $table->decimal('DonGiaMua', 10, 2);

            $table->primary(['MaNhap', 'MaTP']);
            $table->foreign('MaNhap')->references('MaNhap')->on('phieunhapsanpham')->onDelete('cascade');
            $table->foreign('MaTP')->references('MaTP')->on('doanvathucuong')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('chitietnhap_doanthucuong');
        Schema::dropIfExists('chitietnhapsanpham');
        Schema::dropIfExists('phieunhapsanpham');
    }
};

