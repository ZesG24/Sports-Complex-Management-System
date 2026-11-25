<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Gộp các dòng trùng tên phụ kiện (trước đây tách theo KichThuoc) trước khi xóa cột
        if (Schema::hasColumn('phukienthue', 'KichThuoc')) {
            $groups = DB::table('phukienthue')
                ->select('TenPhuKien')
                ->groupBy('TenPhuKien')
                ->havingRaw('COUNT(*) > 1')
                ->pluck('TenPhuKien');

            foreach ($groups as $tenPhuKien) {
                $rows = DB::table('phukienthue')
                    ->where('TenPhuKien', $tenPhuKien)
                    ->orderBy('MaPKThue')
                    ->get();

                $primary = $rows->first();
                $duplicateIds = $rows->skip(1)->pluck('MaPKThue')->all();

                DB::table('phukienthue')
                    ->where('MaPKThue', $primary->MaPKThue)
                    ->update([
                        'TongSoLuong' => $rows->sum('TongSoLuong'),
                        'SoLuongKhaDung' => $rows->sum('SoLuongKhaDung'),
                    ]);

                DB::table('phukienthue')
                    ->whereIn('MaPKThue', $duplicateIds)
                    ->delete();
            }

            Schema::table('phukienthue', function (Blueprint $table) {
                $table->dropColumn('KichThuoc');
            });
        }

        if (! Schema::hasColumn('chitietphieuthue', 'GhiChu')) {
            Schema::table('chitietphieuthue', function (Blueprint $table) {
                $table->text('GhiChu')->nullable()->after('TienCoc');
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasColumn('chitietphieuthue', 'GhiChu')) {
            Schema::table('chitietphieuthue', function (Blueprint $table) {
                $table->dropColumn('GhiChu');
            });
        }

        if (! Schema::hasColumn('phukienthue', 'KichThuoc')) {
            Schema::table('phukienthue', function (Blueprint $table) {
                $table->string('KichThuoc')->default('Freesize')->after('PhanLoai');
            });
        }
    }
};
