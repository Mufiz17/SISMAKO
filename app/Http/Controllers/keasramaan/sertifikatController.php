<?php

namespace App\Http\Controllers\keasramaan;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\database\Siswa;
use App\Http\Controllers\Controller;
use App\Http\Requests\keasramaan\SertifikatRequest;
use App\Models\keasramaan\sertifikat;
use Illuminate\Support\Facades\Storage;

class sertifikatController extends Controller
{
    public function index()
    {
        $sertifikat = sertifikat::with(['siswa:id,nama,nisn'])->get();
        return view('keasramaan.quran.sertifikat.sertif', compact('sertifikat'));
    }

    public function create(Request $request)
    {
        $mutasiFilter = $request->query('angkatan', '');

        $angkatan = Siswa::distinct()->pluck('angkatan');
        $defaultAngkatan = $request->angkatan;
        $names = $defaultAngkatan ? Siswa::where('angkatan', $defaultAngkatan)->get(['id', 'nama', 'angkatan']) : collect();

        return view('keasramaan.quran.sertifikat.create', compact('angkatan', 'names'));
    }

    public function store(SertifikatRequest $request)
    {
        $validateData = $request->validated();

        // Simpan file yang diunggah dengan nama acak
        $fileFields = [
            'juz_30',
            'juz_29',
            'juz_28',
            'juz_umum',
        ];

        foreach ($fileFields as $fileField) {
            if ($request->hasFile($fileField)) {
                $file = $request->file($fileField);
                $originalName = Str::random(30) . '.' . $file->getClientOriginalExtension();
                $validateData[$fileField] = $file->storeAs('al-quran/sertifikat', $originalName, 'public');
            }
        }

        sertifikat::create($validateData);

        return redirect('/sekolah-keasramaan/al-quran/sertif')->with('success', 'Data berhasil ditambahkan');
    }

    public function edit($id)
    {
        $sertifikat = sertifikat::findOrFail($id);
        return view('keasramaan.quran.sertifikat.edit', compact('sertifikat'));
    }

    public function update(Request $request, $id)
    {
        $sertifikat = sertifikat::findOrFail($id);

        $validateData = $request->validate([
            'tanggal' => 'required',
            'juz_30' => 'file|max:10240|mimes:pdf,jpg,jpeg,png',
            'juz_29' => 'file|max:10240|mimes:pdf,jpg,jpeg,png',
            'juz_28' => 'file|max:10240|mimes:pdf,jpg,jpeg,png',
            'juz_umum' => 'file|max:10240|mimes:pdf,jpg,jpeg,png',
        ], [
            'tanggal.required' => 'Tahun ajaran harus diisi',
        ]);

        $fileFields = [
            'juz_30',
            'juz_29',
            'juz_28',
            'juz_umum',
        ];

        foreach ($fileFields as $fileField) {
            if ($request->hasFile($fileField)) {
                // Hapus file lama jika ada
                if ($sertifikat->$fileField) {
                    Storage::disk('public')->delete($sertifikat->$fileField);
                }
                // Simpan file baru
                $file = $request->file($fileField);
                $originalName = Str::random(30) . '.' . $file->getClientOriginalExtension();
                $validateData[$fileField] = $file->storeAs('al-quran/sertifikat', $originalName, 'public');
            } else {
                // Biarkan nilai file tetap seperti sebelumnya jika tidak ada file baru yang diunggah
                $validateData[$fileField] = $sertifikat->$fileField;
            }
        }

        $sertifikat->update($validateData);

        return redirect('/sekolah-keasramaan/al-quran/sertif')->with('success', 'Data berhasil diperbaharui');
    }

    public function destroy($id)
    {
        $sertifikat = sertifikat::findOrFail($id);

        $fileFields = [
            'juz_30',
            'juz_29',
            'juz_28',
            'juz_umum',
        ];

        // Hapus file-file yang ada
        foreach ($fileFields as $fileField) {
            if ($sertifikat->$fileField) {
                Storage::disk('public')->delete($sertifikat->$fileField);
            }
        }

        // Hapus data sertifikat dari database
        $sertifikat->delete();

        return redirect('/sekolah-keasramaan/al-quran/sertif')->with('success', 'Data berhasil dihapus');
    }
}
