<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('donhang', function (Blueprint $table) {
            $table->id('MaDonHang');
            $table->unsignedBigInteger('MaKH');
            $table->string('TenNguoiNhan');
            $table->string('SDTNguoiNhan');
            $table->string('EmailNguoiNhan')->nullable();
            $table->string('DiaChiNguoiNhan');
            $table->decimal('TongTien', 10, 2)->default(0);
            $table->string('PhuongThucThanhToan');
            $table->string('TrangThai')->default('cho_xu_ly');
            $table->string('LoaiDonHang'); // 'sanpham', 'doanthucuong'
            $table->date('NgayTaoDonHang');
            $table->timestamps();

            $table->foreign('MaKH')->references('MaKH')->on('khachhang')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('donhang');
    }
};

