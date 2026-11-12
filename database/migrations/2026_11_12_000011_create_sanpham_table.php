<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('sanpham', function (Blueprint $table) {
            $table->id('MaSanPham');
            $table->string('TenSanPham');
            $table->text('MoTa')->nullable();
            $table->decimal('DonGia', 10, 2);
            $table->string('HinhAnh')->nullable();
            $table->date('NgayTao');
            $table->unsignedBigInteger('MaLoai');
            $table->timestamps();

            $table->foreign('MaLoai')->references('MaLoai')->on('loaisanpham')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sanpham');
    }
};

