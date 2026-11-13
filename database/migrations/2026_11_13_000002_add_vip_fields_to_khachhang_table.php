<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('khachhang', function (Blueprint $table) {
            $table->unsignedBigInteger('MaHang')->nullable()->after('MaTK');
            $table->integer('DiemTichLuy')->default(0)->after('MaHang');
            $table->decimal('TongChiTieu', 12, 2)->default(0)->after('DiemTichLuy');
            $table->dateTime('NgayHetHanVIP')->nullable()->after('TongChiTieu');

            $table->foreign('MaHang')->references('MaHang')->on('hangthanhvien')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::table('khachhang', function (Blueprint $table) {
            $table->dropForeign(['MaHang']);
            $table->dropColumn(['MaHang', 'DiemTichLuy', 'TongChiTieu', 'NgayHetHanVIP']);
        });
    }
};
