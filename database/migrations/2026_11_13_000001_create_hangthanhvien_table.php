<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('hangthanhvien', function (Blueprint $table) {
            $table->id('MaHang');
            $table->string('TenHang');
            $table->decimal('ChiTieuToiThieu', 12, 2)->default(0);
            $table->decimal('PhanTramGiamGia', 5, 2)->default(0);
            $table->text('QuyenLoi')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('hangthanhvien');
    }
};
