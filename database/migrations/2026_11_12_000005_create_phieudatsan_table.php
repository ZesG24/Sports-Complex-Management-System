<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('phieudatsan', function (Blueprint $table) {
            $table->id('MaDatSan');
            $table->unsignedBigInteger('MaKH');
            $table->date('NgayDat');
            $table->decimal('TongTien', 10, 2)->default(0);
            $table->string('TrangThai')->default('cho_xac_nhan');
            $table->text('GhiChu')->nullable();
            $table->timestamps();

            $table->foreign('MaKH')->references('MaKH')->on('khachhang')->onDelete('cascade');
        });

        // Chi tiết đặt sân (1 phiếu có thể đặt nhiều sân với khung giờ và đơn giá độc lập)
        Schema::create('chitietphieudatsan_san', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('MaDatSan');
            $table->unsignedBigInteger('MaSan');
            $table->time('GioBatDau');
            $table->time('GioKetThuc');
            $table->decimal('DonGia', 10, 2); // Lưu đơn giá thuê 1 giờ tại thời điểm đặt
            $table->timestamps();

            $table->foreign('MaDatSan')->references('MaDatSan')->on('phieudatsan')->onDelete('cascade');
            $table->foreign('MaSan')->references('MaSan')->on('san')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('chitietphieudatsan_san');
        Schema::dropIfExists('phieudatsan');
    }
};
