<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('hoadon', function (Blueprint $table) {
            $table->string('MaGiaoDich', 100)->nullable()->index()->after('TrangThai');
        });
    }

    public function down(): void
    {
        Schema::table('hoadon', function (Blueprint $table) {
            $table->dropIndex(['MaGiaoDich']);
            $table->dropColumn('MaGiaoDich');
        });
    }
};
