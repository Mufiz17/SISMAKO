<?php

namespace App\Http\Controllers\keasramaan;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\database\Siswa;
use App\Models\keasramaan\pelatihan;
use App\Http\Controllers\Controller;
use App\Http\Requests\keasramaan\PelatihanRequest;
use Illuminate\Support\Facades\Storage;

class lombaController extends Controller
{
    public function index(Request $request)
    {
        // Ambil tanggal dan nama dari input
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
        $searchName = $request->input('search_name');

        // Mulai dengan query dasar
        $lomba = Pelatihan::where('type', 'lomba')
            ->with(['siswa:id,nama,nisn']);

        // Tambahkan filter tanggal jika ada input
        if ($startDate) {
            $lomba->where('tanggal', '>=', $startDate);
        }
        if ($endDate) {
            $lomba->where('tanggal', '<=', $endDate);
        }

        // Tambahkan filter nama jika ada input
        if ($searchName) {
            $lomba->whereHas('siswa', function ($query) use ($searchName) {
                $query->where('nama', 'like', '%' . $searchName . '%');
            });
        }

        // Paginate hasil
        $lomba = $lomba->paginate(10);

        return view('keasramaan.akademik.lomba.lomba', compact('lomba'));
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
        return view('keasramaan.akademik.lomba.create', compact('angkatan', 'names'));
    }

    public function store(PelatihanRequest $request)
    {
        $validateData = $request->validated();

        $fileFields = ['dokumentasi', 'undangan'];

        foreach ($fileFields as $fileField) {
            if ($request->hasFile($fileField)) {
                $files = $request->file($fileField);
                $storedFiles = [];

                foreach ($files as $index => $file) {
                    if ($index < 3) { // Batas maksimal 3 file
                        $originalName = Str::random(30) . '.' . $file->getClientOriginalExtension();
                        $filePath = $file->storeAs('akademik/pelatihan', $originalName, 'public');

                        // Store each file path in the $storedFiles array
                        $storedFiles[] =  $filePath;
                    }
                }
                // Convert $storedFiles to JSON and store it in $validateData
                $validateData[$fileField] = json_encode($storedFiles);
            }
        }

        pelatihan::create(array_merge($validateData, ['type' => 'lomba', 'siswa_id' => $request->siswa_id]));
        return redirect('/sekolah-keasramaan/akademik/lomba')->with('success', 'Data berhasil ditambahkan');
    }


    public function edit($id)
    {
        $lomba = pelatihan::findOrFail($id);
        return view('keasramaan.akademik.lomba.edit', compact('lomba'));
    }

    public function update(Request $request, $id)
    {
        $validateData = $request->validate([
            'tanggal' => 'required',
            'kegiatan' => 'required',
            'keterangan' => 'required',
            'dokumentasi.' => 'file|max:10240',
            'undangan.' => 'file|max:10240',
        ],[
            'dokumentasi.*.file' => 'Dokumen Dokumentasi harus berformat file (.pdf,.docx,.jpg,.png)',
            'undangan.*.file' => 'Dokumen Undangan harus berformat file (.pdf,.docx,.jpg,.png)',
            'tanggal.required' => 'Tanggal harus diisi',
            'kegiatan.required' => 'Kegiatan harus diisi',
            'keterangan.required' => 'Keterangan harus diisi',
        ]);

        $lomba = pelatihan::findOrFail($id);

        $fileFields = ['dokumentasi', 'undangan'];

        foreach ($fileFields as $fileField) {
            if ($request->hasFile($fileField)) {
                $files = $request->file($fileField);
                $storedFiles = [];

                foreach ($files as $index => $file) {
                    if ($index < 3) {
                        // Hapus file lama jika ada
                        $existingFiles = json_decode($lomba->$fileField);
                        if (isset($existingFiles[$index])) {
                            Storage::delete($existingFiles[$index]);
                        }

                        $originalName = $file->getClientOriginalName();
                        $storedFiles[] = $file->storeAs($fileField, $originalName);
                    }
                }
                $validateData[$fileField] = json_encode($storedFiles);
            } else {
                $validateData[$fileField] = $lomba->$fileField;
            }
        }
        $lomba->update($validateData);
        return redirect('/sekolah-keasramaan/akademik/lomba')->with('success', 'Data berhasil diperbaharui');
    }


    public function destroy($id)
    {
        $lomba = pelatihan::findOrFail($id);

        $fileFields = [
            'dokumentasi',
            'undangan',
        ];

        foreach ($fileFields as $fileField) {
            if ($lomba->$fileField) {
                Storage::delete($lomba->$fileField);
            }
        }

        $lomba->delete();

        return redirect('/sekolah-keasramaan/akademik/lomba')->with('success', 'Data berhasil dihapus');
    }
}
