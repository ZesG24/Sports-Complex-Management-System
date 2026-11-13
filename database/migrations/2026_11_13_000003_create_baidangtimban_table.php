<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('baidangtimban', function (Blueprint $table) {
            $table->id('MaBaiDang');
            $table->unsignedBigInteger('MaKH');
            $table->unsignedBigInteger('MaChiTietDatSan')->nullable();
            $table->unsignedBigInteger('MaLoaiSan');
            $table->string('TieuDe');
            $table->text('NoiDung')->nullable();
            $table->string('TrinhDo')->default('tat_ca');
            $table->integer('SoLuongCanTim');
            $table->integer('SoLuongHienTai')->default(1);
            $table->dateTime('ThoiGianChoi')->nullable();
            $table->decimal('ChiPhiUocTinh', 10, 2)->default(0);
            $table->string('TrangThai')->default('dang_tim');
            $table->timestamps();

            $table->foreign('MaKH')->references('MaKH')->on('khachhang')->onDelete('cascade');
            $table->foreign('MaChiTietDatSan')->references('id')->on('chitietphieudatsan_san')->onDelete('set null');
            $table->foreign('MaLoaiSan')->references('MaLoai')->on('loaisan')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('baidangtimban');
    }
};
