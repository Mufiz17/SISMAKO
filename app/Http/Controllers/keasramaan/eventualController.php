<?php

namespace App\Http\Controllers\keasramaan;

use Illuminate\Http\Request;
use App\Models\database\Siswa;
use App\Http\Controllers\Controller;
use App\Http\Requests\keasramaan\EventualRequest;
use App\Models\keasramaan\pelatihan;
use Illuminate\Support\Facades\Storage;

class eventualController extends Controller
{
    public function index()
    {
        $eventual = pelatihan::where('type', 'eventual')->with(['siswa:id,nama,nisn'])->get();
        return view('keasramaan.akademik.volentir.volentir', compact('eventual'));
    }

    public function create(Request $request)
    {
        $mutasiFilter = $request->query('angkatan', ''); // Default empty filter

        // Fetch distinct angkatan values from Siswa model
        $angkatan = Siswa::distinct()->pluck('angkatan');

        // Get the selected angkatan from the request or default to an empty string
        $defaultAngkatan = $request->angkatan;

        // Fetch names for the selected angkatan if available
        $names = $defaultAngkatan ? Siswa::where('angkatan', $defaultAngkatan)->get(['id', 'nama', 'angkatan']) : collect();
        return view('keasramaan.akademik.volentir.create', compact('angkatan', 'names'));
    }

    public function store(EventualRequest $request)
    {
        $validateData = $request->validated();

        $fileFields = ['dokumentasi', 'undangan'];

        foreach ($fileFields as $fileField) {
            if ($request->hasFile($fileField)) {
                $files = $request->file($fileField);
                $storedFiles = [];

                foreach ($files as $index => $file) {
                    if ($index < 3) { // Batas maksimal 3 file
                        $originalName = $file->getClientOriginalName();
                        $storedFiles[] = $file->storeAs($fileField, $originalName, 'public');
                    }
                }
                $validateData[$fileField] = json_encode($storedFiles);
            }
        }

        pelatihan::create(array_merge($validateData, ['type' => 'eventual', 'siswa_id' => $request->siswa_id]));
        return redirect('/sekolah-keasramaan/akademik/eventual')->with('success', 'Data berhasil ditambahkan');
    }


    public function edit($id)
    {
        $eventual = pelatihan::findOrFail($id);
        return view('keasramaan.akademik.volentir.edit', compact('eventual'));
    }

    public function update(EventualRequest $request, $id)
    {
        $validateData = $request->validated();

        $eventual = pelatihan::findOrFail($id);

        $fileFields = ['dokumentasi', 'undangan'];

        foreach ($fileFields as $fileField) {
            if ($request->hasFile($fileField)) {
                $files = $request->file($fileField);
                $storedFiles = [];

                foreach ($files as $index => $file) {
                    if ($index < 3) {
                        // Hapus file lama jika ada
                        $existingFiles = json_decode($eventual->$fileField);
                        if (isset($existingFiles[$index])) {
                            Storage::delete($existingFiles[$index]);
                        }

                        $originalName = $file->getClientOriginalName();
                        $storedFiles[] = $file->storeAs($fileField, $originalName);
                    }
                }
                $validateData[$fileField] = json_encode($storedFiles);
            } else {
                $validateData[$fileField] = $eventual->$fileField;
            }
        }
        $eventual->update($validateData);
        return redirect('/sekolah-keasramaan/akademik/eventual')->with('success', 'Data berhasil diperbaharui');
    }


    public function destroy($id)
    {
        $eventual = pelatihan::findOrFail($id);

        $fileFields = [
            'dokumentasi',
            'undangan',
        ];

        foreach ($fileFields as $fileField) {
            if ($eventual->$fileField) {
                Storage::delete($eventual->$fileField);
            }
        }

        $eventual->delete();

        return redirect('/sekolah-keasramaan/akademik/eventual')->with('success', 'Data berhasil dihapus');
    }
}
