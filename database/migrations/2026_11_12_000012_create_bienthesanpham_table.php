<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('bienthesanpham', function (Blueprint $table) {
            $table->id('MaBienThe');
            $table->unsignedBigInteger('MaSanPham');
            $table->string('KichThuoc');
            $table->integer('SoLuongTon')->default(0);
            $table->timestamps();

            $table->foreign('MaSanPham')->references('MaSanPham')->on('sanpham')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bienthesanpham');
    }
};

