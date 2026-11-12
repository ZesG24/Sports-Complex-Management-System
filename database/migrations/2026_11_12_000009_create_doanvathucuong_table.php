<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('doanvathucuong', function (Blueprint $table) {
            $table->id('MaTP');
            $table->string('TenThucPham');
            $table->decimal('GiaBan', 10, 2);
            $table->text('MoTa')->nullable();
            $table->integer('SoLuongTon')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('doanvathucuong');
    }
};

