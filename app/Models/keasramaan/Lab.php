<?php

namespace App\Models\keasramaan;

use App\Models\database\Guru;
use App\Models\database\Siswa;
use App\Models\database\DataKelas;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Lab extends Model
{
    use HasFactory;
    protected $table = 'akses_lab';
    protected $fillable = ['tanggal', 'guru_id', 'kelas_id', 'siswa_id', 'keterangan', 'start', 'end'];

    public function guru()
    {
        return $this->belongsTo(Guru::class, 'guru_id');
    }

    // Definisikan relasi dengan model DataKelas
    public function kelas()
    {
        return $this->belongsTo(DataKelas::class, 'kelas_id');
    }

    // Definisikan relasi dengan model Siswa
    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'siswa_id');
    }
}
