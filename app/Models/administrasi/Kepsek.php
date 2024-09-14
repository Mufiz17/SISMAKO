<?php

namespace App\Models\administrasi;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kepsek extends Model
{
    use HasFactory;

    protected $table = 'kepsek';

    protected $fillable = [
        'tahun_ajaran',
        // Proker
        'proker_kepsek',
        // RKTS
        'rkts',
        // RKJM
        'rkjm',
        // Prog. Jangka Panjang
        'prog_jangka_panjang',
        // RKAS
        'rkas',
        // Penilaian Bulanan Guru
        'nomor_penilaian',
        'nama_guru',
        'nilai_tepat_waktu',
        'penilaian_kumulatif_siswa',
        'capaian_materi',
        'prestasi',
        'bulan',
        'keterangan_penilaian_bulanan',
        // Daftar Pembagian Tugas Guru
        'nomor_pembagian_tugas',
        'nama_pembagian_tugas',
        'kelas',
        'jabatan',
        'mapel',
        'jumlah_jp',
        'keterangan_pembagian_tugas',
    ];
}
