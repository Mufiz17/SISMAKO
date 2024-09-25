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
        Schema::create('akhlak', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal');
            $table->bigInteger('siswa_id')->unsigned(); // Ensure this is bigInteger
            $table->foreign('siswa_id')->references('id')->on('siswa')->cascadeOnDelete();
            $table->text('materi');
            $table->string('type');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('akhlak');
    }
};
