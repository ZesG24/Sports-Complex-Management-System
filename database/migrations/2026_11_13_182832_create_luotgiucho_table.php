<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('luotgiucho', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('MaSan');
            $table->date('NgayDat');
            $table->time('GioBatDau');
            $table->time('GioKetThuc');
            $table->string('SessionId', 100)->index();
            $table->unsignedBigInteger('MaKH')->nullable();
            $table->dateTime('HetHanLuc')->index();
            $table->timestamps();

            $table->foreign('MaSan')->references('MaSan')->on('san')->onDelete('cascade');
            $table->foreign('MaKH')->references('MaKH')->on('khachhang')->onDelete('set null');
            $table->index(['MaSan', 'NgayDat', 'HetHanLuc']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('luotgiucho');
    }
};
