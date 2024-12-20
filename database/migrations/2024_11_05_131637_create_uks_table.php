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
        Schema::create('uks', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal');
            $table->text('keluhan');
            $table->text('penanganan');
            $table->unsignedBigInteger ('guru_id');
            $table->unsignedBigInteger ('siswa_id');
            $table->foreign('siswa_id')->references('id')->on('siswa')->cascadeOnDelete();
            $table->foreign(columns: 'guru_id')->references('id')->on('guru')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('uks');
    }
};
