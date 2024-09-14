<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKepsekTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('kepsek', function (Blueprint $table) {
            $table->id();
            $table->string('tahun_ajaran');
            // Adding columns for Proker
            $table->string('proker_kepsek')->nullable();
            // Adding columns for RKTS
            $table->string('rkts')->nullable();
            // Adding columns for RKJM
            $table->string('rkjm')->nullable();
            // Adding columns for Prog. Jangka Panjang
            $table->string('prog_jangka_panjang')->nullable();
            // Adding columns for RKAS
            $table->string('rkas')->nullable();
            // Adding columns for Penilaian Bulanan Guru
            $table->integer('nomor_penilaian');
            $table->string('nama_guru');
            $table->string('nilai_tepat_waktu');
            $table->string('penilaian_kumulatif_siswa');
            $table->string('capaian_materi');
            $table->string('prestasi');
            $table->string('bulan');
            $table->text('keterangan_penilaian_bulanan');
            // Adding columns for Daftar Pembagian Tugas Guru
            $table->integer('nomor_pembagian_tugas');
            $table->string('nama_pembagian_tugas');
            $table->string('kelas');
            $table->string('jabatan');
            $table->string('mapel');
            $table->string('jumlah_jp');
            $table->text('keterangan_pembagian_tugas');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kepsek');
    }
};
