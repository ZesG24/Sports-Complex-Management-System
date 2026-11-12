<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('hoadon', function (Blueprint $table) {
            $table->id('MaHD');
            $table->unsignedBigInteger('MaDatSan');
            $table->date('NgayLap');
            $table->decimal('TongTien', 10, 2);
            $table->text('GhiChu')->nullable();
            $table->string('TenPhuongThuc');
            $table->unsignedBigInteger('MaBaoCao')->nullable();
            $table->timestamps();

            $table->foreign('MaDatSan')->references('MaDatSan')->on('phieudatsan')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('hoadon');
    }
};

