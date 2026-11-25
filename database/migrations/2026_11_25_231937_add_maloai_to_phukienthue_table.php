<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasColumn('phukienthue', 'MaLoai')) {
            Schema::table('phukienthue', function (Blueprint $table) {
                $table->unsignedBigInteger('MaLoai')->nullable()->after('MaPKThue');
                $table->foreign('MaLoai')->references('MaLoai')->on('loaisan')->nullOnDelete();
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasColumn('phukienthue', 'MaLoai')) {
            Schema::table('phukienthue', function (Blueprint $table) {
                $table->dropForeign(['MaLoai']);
                $table->dropColumn('MaLoai');
            });
        }
    }
};
