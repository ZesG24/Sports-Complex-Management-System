<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('khachhang', function (Blueprint $table) {
            $table->id('MaKH');
            $table->string('HoTen');
            $table->string('SDT');
            $table->string('Email')->nullable();
            $table->string('DiaChi')->nullable();
            $table->unsignedBigInteger('MaTK');
            $table->timestamps();

            $table->foreign('MaTK')->references('MaTK')->on('taikhoan')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('khachhang');
    }
};

