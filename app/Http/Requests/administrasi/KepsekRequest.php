<?php

namespace App\Http\Requests\administrasi;

use Illuminate\Foundation\Http\FormRequest;

class KepsekRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'tahun_ajaran' => 'required',
            'proker_kepsek' => 'nullable|file|max:2048',
            'rkts' => 'nullable|file|max:2048',
            'rkjm' => 'nullable|file|max:2048',
            'prog_jangka_panjang' => 'nullable|file|max:2048',
            'rkas' => 'nullable|file|max:2048',
            // Penilaian Bulanan Guru
            'nomor_penilaian' => 'integer',
            'nama_guru' => 'string',
            'nilai_tepat_waktu' => 'string',
            'penilaian_kumulatif_siswa' => 'string',
            'capaian_materi' => 'string',
            'prestasi' => 'string',
            'bulan' => 'string',
            'keterangan_penilaian_bulanan' => 'string',
            // Daftar Pembagian Tugas Guru
            'nomor_pembagian_tugas' => 'integer',
            'nama_pembagian_tugas' => 'string',
            'kelas' => 'string',
            'jabatan' => 'string',
            'mapel' => 'string',
            'jumlah_jp' => 'string',
            'keterangan_pembagian_tugas' => 'string'
        ];
    }
}
