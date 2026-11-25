<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasColumn('phukienthue', 'TienCoc')) {
            Schema::table('phukienthue', function (Blueprint $table) {
                $table->dropColumn('TienCoc');
            });
        }

        if (Schema::hasColumn('phieuthue', 'TongTienCoc')) {
            Schema::table('phieuthue', function (Blueprint $table) {
                $table->dropColumn('TongTienCoc');
            });
        }

        if (Schema::hasColumn('chitietphieuthue', 'TienCoc')) {
            Schema::table('chitietphieuthue', function (Blueprint $table) {
                $table->dropColumn('TienCoc');
            });
        }
    }

    public function down(): void
    {
        if (! Schema::hasColumn('phukienthue', 'TienCoc')) {
            Schema::table('phukienthue', function (Blueprint $table) {
                $table->decimal('TienCoc', 10, 2)->default(0)->after('GiaThue');
            });
        }

        if (! Schema::hasColumn('phieuthue', 'TongTienCoc')) {
            Schema::table('phieuthue', function (Blueprint $table) {
                $table->decimal('TongTienCoc', 10, 2)->default(0)->after('TongTienThue');
            });
        }

        if (! Schema::hasColumn('chitietphieuthue', 'TienCoc')) {
            Schema::table('chitietphieuthue', function (Blueprint $table) {
                $table->decimal('TienCoc', 10, 2)->default(0)->after('DonGiaThue');
            });
        }
    }
};
