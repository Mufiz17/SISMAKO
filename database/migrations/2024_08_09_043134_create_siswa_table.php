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
        Schema::create('siswa', function (Blueprint $table) {
            $table->id();
            $table->string('tahun_pelajaran', 20);
            $table->string('nama', 50);
            $table->string('nisn', 20);
            $table->string('nis', 20);
            $table->string('tempat_tanggal_lahir', 20);
            $table->date('tanggal_lahir');
            $table->enum('jenis_kelamin', ['Laki-laki', 'Perempuan']);
            $table->enum('agama', ['Islam', 'Kristen', 'Buddha', 'Khonghucu', 'Hindu', 'Katolik']);
            $table->string('alamat');
            $table->date('tanggal_masuk');
            $table->string('nama_ayah', 50);
            $table->string('nama_ibu', 50);
            $table->string('pekerjaan_ayah', 50);
            $table->string('pekerjaan_ibu', 50);
            $table->string('no_hp_wali', 20);
            $table->string('diterima_di_kelas', 20);
            $table->integer('angkatan');
            $table->string('asal_sekolah', 20);
            $table->string('alamat_asal_sekolah', 255);
            $table->string('path_ijazah', 100)->nullable();
            $table->string('path_surat_Kelulusan', 100)->nullable();
            $table->string('path_kk', 100)->nullable();
            $table->string('path_akta_kelahiran', 100)->nullable();
            $table->string('path_surat_pernyataan_calonPesertaDidik', 100)->nullable();
            $table->string('path_surat_pernyataan_wali', 100)->nullable();
            $table->string('path_surat_pernyataan_tidak_merokok', 100)->nullable();
            $table->enum('status_siswa', ['Aktif', 'Tidak aktif']);
            $table->integer('point')->default(300);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('siswa');
    }
};
