<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('thamgia_timban', function (Blueprint $table) {
            $table->id('MaThamGia');
            $table->unsignedBigInteger('MaBaiDang');
            $table->unsignedBigInteger('MaKH');
            $table->string('TrangThai')->default('cho_duyet');
            $table->text('LoiNhan')->nullable();
            $table->dateTime('NgayDangKy')->useCurrent();
            $table->timestamps();

            $table->foreign('MaBaiDang')->references('MaBaiDang')->on('baidangtimban')->onDelete('cascade');
            $table->foreign('MaKH')->references('MaKH')->on('khachhang')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('thamgia_timban');
    }
};
