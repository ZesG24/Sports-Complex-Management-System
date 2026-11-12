<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('san', function (Blueprint $table) {
            $table->id('MaSan');
            $table->string('TenSan');
            $table->decimal('GiaThue', 10, 2);
            $table->string('TinhTrang')->default('trong'); // 'trong', 'dangdung', 'baotri'
            $table->text('MoTa')->nullable();
            $table->unsignedBigInteger('MaLoai');
            $table->timestamps();

            $table->foreign('MaLoai')->references('MaLoai')->on('loaisan')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('san');
    }
};

