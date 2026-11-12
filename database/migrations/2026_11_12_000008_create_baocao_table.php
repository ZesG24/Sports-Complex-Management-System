<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('baocao', function (Blueprint $table) {
            $table->id('MaBaoCao');
            $table->date('NgayBaoCao');
            $table->decimal('TongTienSan', 12, 2)->default(0);
            $table->decimal('TongTienDoAnThucUong', 12, 2)->default(0);
            $table->decimal('TongTienSanPham', 12, 2)->default(0);
            $table->timestamps();
        });

        // Thêm FK cho hoadon -> baocao sau khi baocao đã tạo
        Schema::table('hoadon', function (Blueprint $table) {
            $table->foreign('MaBaoCao')->references('MaBaoCao')->on('baocao')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::table('hoadon', function (Blueprint $table) {
            $table->dropForeign(['MaBaoCao']);
        });
        Schema::dropIfExists('baocao');
    }
};

