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
        Schema::create('akses_lab', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal');
            $table->unsignedBigInteger ('guru_id');
            $table->unsignedBigInteger ('kelas_id');
            $table->unsignedBigInteger ('siswa_id');
            $table->text('keterangan');
            $table->time('start');
            $table->time('end');
            $table->foreign('guru_id')->references('id')->on('guru')->cascadeOnDelete();
            $table->foreign('kelas_id')->references('id')->on('data_kelas')->cascadeOnDelete();
            $table->foreign('siswa_id')->references('id')->on('siswa')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('akses_lab');
    }
};
