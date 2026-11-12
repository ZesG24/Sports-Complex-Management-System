<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('danhgiasan', function (Blueprint $table) {
            $table->id('MaDGSan');
            $table->unsignedBigInteger('MaKH');
            $table->unsignedBigInteger('MaSan');
            $table->unsignedBigInteger('MaDatSan');
            $table->tinyInteger('Diem'); // 1-5
            $table->text('NoiDung')->nullable();
            $table->date('NgayDanhGia');
            $table->timestamps();

            $table->foreign('MaKH')->references('MaKH')->on('khachhang')->onDelete('cascade');
            $table->foreign('MaSan')->references('MaSan')->on('san')->onDelete('cascade');
            $table->foreign('MaDatSan')->references('MaDatSan')->on('phieudatsan')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('danhgiasan');
    }
};

