<?php

namespace App\Http\Controllers\administrasi;

use ZipArchive;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Models\administrasi\Kepsek;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use App\Http\Requests\administrasi\KepsekRequest;

class KepsekController extends Controller
{
    public function index(Request $request)
    {
        $tahunAjaranFilter = $request->query('tahun_ajaran', '');

        $query = Kepsek::query();

        if ($tahunAjaranFilter) {
            $query->where('tahun_ajaran', $tahunAjaranFilter);
        }

        $kepsek = Kepsek::latest()->paginate(10);

        $tahunAjaranOptions = Kepsek::select('tahun_ajaran')->distinct()->pluck('tahun_ajaran');

        return view('administrasi.kepsek.index', compact('kepsek', 'tahunAjaranOptions', 'tahunAjaranFilter'));
    }

    public function create()
    {
        return view('administrasi.kepsek.create');
    }

    public function store(KepsekRequest $request)
    {
        $validateData = $request->validated();

        $fileFields = [
            'proker_kepsek',
            'rkts',
            'rkjm',
            'prog_jangka_panjang',
            'rkas',
        ];

        foreach ($fileFields as $fileField) {
            if ($request->file($fileField)) {
                $file = $request->file($fileField);
                $originalName = $file->getClientOriginalName();
                $validateData[$fileField] = $file->storeAs($fileField, $originalName);
            }
        }

        Kepsek::create($validateData);

        return redirect()->route('kepsek.index')->with('success', 'Data Kepsek created successfully.');
    }

    public function edit($id)
    {
        $kepsek = Kepsek::findOrFail($id);
        return view('administrasi.kepsek.edit', compact('kepsek'));
    }

    public function update(KepsekRequest $request, $id)
    {
        $kepsek = Kepsek::findOrFail($id);

        $validateData = $request->validated();

        $fileFields = [
            'proker_kepsek',
            'rkts',
            'rkjm',
            'prog_jangka_panjang',
            'rkas',
        ];

        foreach ($fileFields as $fileField) {
            if ($request->hasFile($fileField)) {
                // Jika ada file baru, hapus file lama jika ada
                if (isset($validateData[$fileField])) {
                    $oldFile = $validateData[$fileField];
                    if ($oldFile && Storage::exists($oldFile)) {
                        Storage::delete($oldFile);
                    }
                }
                // Simpan file baru
                $file = $request->file($fileField);
                $originalName = $file->getClientOriginalName();
                $validateData[$fileField] = $file->storeAs($fileField, $originalName);
            } else {
                // Jika tidak ada file baru, pertahankan data lama
                if (isset($validateData[$fileField])) {
                    $validateData[$fileField] = $validateData[$fileField];
                }
            }
        }

        $kepsek->update($validateData);

        return redirect()->route('kepsek.index')->with('success', 'Data Kepsek berhasil diubah!');
    }

    public function destroy($id)
    {
        $kepsek = Kepsek::find($id);

        $fileFields = [
            'proker_kepsek',
            'rkts',
            'rkjm',
            'prog_jangka_panjang',
            'rkas',
        ];

        foreach ($fileFields as $fileField) {
            if ($kepsek->$fileField) {
                Storage::delete($kepsek->$fileField);
            }
        }

        $kepsek->delete();

        return redirect()->route('kepsek.index')->with('success', 'Data Kepsek berhasil dihapus!');
    }

    public function downloadFiles($id)
    {
        $kepsek = Kepsek::findOrFail($id);

        $directories = [
            'proker_kepsek',
            'rkts',
            'rkjm',
            'prog_jangka_panjang',
            'rkas',
        ];

        // Create a temporary file to store the zip
        $zipFileName = 'Kepsek_files_' . $kepsek->tahun_ajaran . '.zip';
        $zipFilePath = storage_path('app/temp/' . $zipFileName);

        // Ensure the temp directory exists
        if (!Storage::exists('temp')) {
            Storage::makeDirectory('temp');
            Log::info('Created temp directory: ' . storage_path('app/temp'));
        }

        // Initialize zip archive
        $zip = new ZipArchive;
        if ($zip->open($zipFilePath, ZipArchive::CREATE | ZipArchive::OVERWRITE) === TRUE) {
            foreach ($directories as $dir) {
                if ($kepsek->$dir) {
                    $filePath = storage_path('app/' . $kepsek->$dir);
                    if (file_exists($filePath)) {
                        $zip->addFile($filePath, $dir . '/' . basename($filePath));
                    }
                }
            }
            $zip->close();

            // Download the created zip file
            return response()->download($zipFilePath)->deleteFileAfterSend(true);
        } else {
            return back()->with('error', 'Failed to create zip file');
        }
    }

    public function exportPDF($id)
    {
        $data = Kepsek::findOrFail($id);
        $pdf = FacadePdf::loadView('administrasi.kepsek.pdf', compact('data'));
        return $pdf->download('administrasi.kepsek.pdf');
    }
}
