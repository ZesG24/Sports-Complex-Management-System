<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // 1. Bảng Phụ kiện / Dụng cụ cho thuê tại sân (tách biệt với kho hàng bán đứt)
        Schema::create('phukienthue', function (Blueprint $table) {
            $table->id('MaPKThue');
            $table->string('TenPhuKien');
            $table->string('PhanLoai')->default('giay'); // 'giay', 'vot', 'phu_kien'
            $table->string('KichThuoc')->default('Freesize');
            $table->decimal('GiaThue', 10, 2);
            $table->decimal('TienCoc', 10, 2)->default(0);
            $table->integer('TongSoLuong')->default(0);
            $table->integer('SoLuongKhaDung')->default(0);
            $table->string('HinhAnh')->nullable();
            $table->text('MoTa')->nullable();
            $table->string('TinhTrang')->default('hoat_dong'); // 'hoat_dong', 'ngung_cho_thue'
            $table->timestamps();
        });

        // 2. Bảng Phiếu thuê phụ kiện (cho phép gắn với Phiếu đặt sân hoặc thuê lẻ tại quầy POS)
        Schema::create('phieuthue', function (Blueprint $table) {
            $table->id('MaPhieuThue');
            $table->unsignedBigInteger('MaKH')->nullable();
            $table->unsignedBigInteger('MaDatSan')->nullable();
            $table->string('TenKhachThue');
            $table->string('SDTKhachThue');
            $table->date('NgayThue');
            $table->dateTime('ThoiGianMuon')->nullable();
            $table->dateTime('ThoiGianTra')->nullable();
            $table->decimal('TongTienThue', 10, 2)->default(0);
            $table->decimal('TongTienCoc', 10, 2)->default(0);
            $table->string('TrangThai')->default('dat_truoc'); // 'dat_truoc', 'dang_muon', 'da_tra', 'da_huy'
            $table->text('GhiChu')->nullable();
            $table->timestamps();

            $table->foreign('MaKH')->references('MaKH')->on('khachhang')->onDelete('set null');
            $table->foreign('MaDatSan')->references('MaDatSan')->on('phieudatsan')->onDelete('set null');
        });

        // 3. Chi tiết phiếu thuê (PHIEUTHUE ↔ PHUKIENTHUE)
        Schema::create('chitietphieuthue', function (Blueprint $table) {
            $table->unsignedBigInteger('MaPhieuThue');
            $table->unsignedBigInteger('MaPKThue');
            $table->integer('SoLuong');
            $table->decimal('DonGiaThue', 10, 2);
            $table->decimal('TienCoc', 10, 2)->default(0);

            $table->primary(['MaPhieuThue', 'MaPKThue']);
            $table->foreign('MaPhieuThue')->references('MaPhieuThue')->on('phieuthue')->onDelete('cascade');
            $table->foreign('MaPKThue')->references('MaPKThue')->on('phukienthue')->onDelete('cascade');
        });

        // 4. Bổ sung cột doanh thu thuê phụ kiện vào bảng báo cáo
        Schema::table('baocao', function (Blueprint $table) {
            $table->decimal('TongTienThuePhuKien', 12, 2)->default(0)->after('TongTienSanPham');
        });
    }

    public function down(): void
    {
        Schema::table('baocao', function (Blueprint $table) {
            $table->dropColumn('TongTienThuePhuKien');
        });

        Schema::dropIfExists('chitietphieuthue');
        Schema::dropIfExists('phieuthue');
        Schema::dropIfExists('phukienthue');
    }
};
