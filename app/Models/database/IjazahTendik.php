<?php
namespace App\Models\database;
use App\Models\database\Tendik;
use Illuminate\Database\Eloquent\Model;

class IjazahTendik extends Model
{
    protected $table = 'ijazah_tendik';

    protected $fillable = [
        'id_tendik',
        'jenis_ijazah',
        'nama_file',
    ];

    public function tendik()
    {
        return $this->belongsTo(Tendik::class, 'id_tendik');
    }
}
