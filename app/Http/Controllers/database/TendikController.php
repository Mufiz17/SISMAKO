<?php

namespace App\Http\Controllers\database;

use Carbon\Carbon;
use Dompdf\Dompdf;
use Dompdf\Options;
use App\Models\database\Tendik;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\View;
use App\Models\database\IjazahTendik;
use Illuminate\Support\Facades\Storage;
use App\Models\database\SertifikatTendik;
use App\Http\Controllers\Controller;
use App\Http\Requests\database\TendikRequest;

class TendikController extends Controller
{

    public function index()
    {
        $tendik = Tendik::all();
        return view('database.database.tendik.index', compact('tendik'));
    }

    public function create()
    {
        return view('database.database.tendik.add');
    }

    // public function fileSetup($file, $nama, $prefix, $namaDir, $path = '')
    // {
    //     $imageFileName = $prefix . str_replace(' ', '_', $nama) . '.' . $file->getClientOriginalExtension();
    //     $fullPath = 'img/tendik/' . $namaDir . $path . '/';

    //     // Pastikan direktori tujuan ada
    //     if (!file_exists($fullPath)) {
    //         mkdir($fullPath, 0777, true);
    //     }

    //     // Pindahkan file ke direktori tujuan
    //     $file->move(public_path($fullPath), $imageFileName);

    //     return $fullPath . $imageFileName;
    // }

    public function makeDir($folder, $nama)
    {
        $baseDir = public_path('img/' . $folder . '/' . $nama);

        if (!file_exists($baseDir)) {
            if (!mkdir($baseDir, 0777, true)) {
                throw new \Exception("Failed to create directory: $baseDir");
            }
        }

        $ijazahDir = $baseDir . '/ijazah';
        if (!file_exists($ijazahDir)) {
            if (!mkdir($ijazahDir, 0777, true)) {
                throw new \Exception("Failed to create directory: $ijazahDir");
            }
        }

        $sertifikatDir = $baseDir . '/sertifikat';
        if (!file_exists($sertifikatDir)) {
            if (!mkdir($sertifikatDir, 0777, true)) {
                throw new \Exception("Failed to create directory: $sertifikatDir");
            }
        }
    }



    // public function fileSetup($file, $nama, $prefix, $namaDir, $path = '')
    // {
    //     $imageFileName = $prefix . str_replace(' ', '_', $nama) . '.' . $file->getClientOriginalExtension();
    //     $fullPath = 'img/tendik/' . $namaDir . $path . '/';

    //     // Pastikan direktori tujuan ada
    //     if (!file_exists($fullPath)) {
    //         mkdir($fullPath, 0777, true);
    //     }

    //     // Pindahkan file ke direktori tujuan
    //     $file->move(public_path($fullPath), $imageFileName);

    //     return $fullPath . $imageFileName;
    // }

    public function fileSetup($file, $nama, $prefix, $dir, $guruh = '')
    {
        // Generate a unique file name
        $imageFileName = $prefix . str_replace(' ', '_', $nama) . '.' . $file->getClientOriginalExtension();

        // Create the full path to the directory
        $fullPath = public_path('img/tendik/' . $dir . $guruh);

        // Create the directory if it doesn't exist
        if (!file_exists($fullPath)) {
            mkdir($fullPath, 0777, true);
        }

        // Move the file to the directory
        $file->move($fullPath, $imageFileName);

        // Return the relative path for storing in the database
        return 'img/tendik/' . $dir . $guruh . '/' . $imageFileName;
    }
    public function exportPdf($id)
    {
        $tendik = Tendik::findOrFail($id);

        $html = View::make('database.template.tendik_cv', compact('tendik'))->render();

        // Instantiate Dompdf

        $options = new Options();
        $options->set('isRemoteEnabled', true);
        $options->set('isHtml5ParserEnabled', true);
        $options->set('debugCss', false);
        $options->set('debugLayout', false);
        $options->set('debugLayoutLines', false);
        $options->set('debugLayoutBlocks', false);
        $options->set('debugLayoutInline', false);
        $options->set('debugLayoutPaddingBox', false);

        $dompdf = new Dompdf($options);

        // Load HTML content
        $dompdf->loadHtml($html);

        // Set paper size and orientation
        $dompdf->setPaper('A4', 'portrait');

        // Render PDF (important step!)
        $dompdf->render();

        return $dompdf->stream($tendik->nama . '.pdf');
    }

    // public function store(TendikRequest $request)
    // {
    //     // Validasi data request
    //     $validatedData = $request->validated();
    //     $nama = str_replace(' ', '_', $request->nama);
    //     $namaDir = "img/tendik/{$nama}";

    //     // Membuat direktori untuk menyimpan file
    //     $this->makeDir('tendik', $nama);

    //     // Upload dan simpan file foto jika ada
    //     $imageNamaFoto = $request->hasFile('foto') ? $this->fileSetup($request->file('foto'), $nama, 'Foto-', $namaDir) : null;
    //     $imageNamaFotoKtp = $request->hasFile('foto_ktp') ? $this->fileSetup($request->file('foto_ktp'), $nama, 'Foto-KTP-', $namaDir) : null;
    //     $imageNamaFotoSk = $request->hasFile('foto_surat_keterangan_mengajar') ? $this->fileSetup($request->file('foto_surat_keterangan_mengajar'), $nama, 'Foto-SK-Mengajar-', $namaDir) : null;

    //     // Simpan data tendik ke database
    //     $tendik = Tendik::create(array_merge($validatedData, [
    //         'foto' => $imageNamaFoto,
    //         'foto_ktp' => $imageNamaFotoKtp,
    //         'foto_surat_keterangan_mengajar' => $imageNamaFotoSk,
    //     ]));

    //     $idTendik = $tendik->id;

    //     // Menangani upload dan penyimpanan ijazah
    //     $ijazahData = [];
    //     $ijazahTypes = [
    //         'ijazah_smp' => 'SMP',
    //         'ijazah_sma' => 'SMA',
    //         'ijazah_s1' => 'S1',
    //         'ijazah_s2' => 'S2'
    //     ];

    //     foreach ($ijazahTypes as $fileKey => $jenisIjazah) {
    //         if ($request->hasFile($fileKey)) {
    //             $imageNamaFile = $this->fileSetup($request->file($fileKey), $nama, "Foto-Ijazah-{$jenisIjazah}-", $namaDir, '/ijazah');
    //             $ijazahData[] = [
    //                 'id_tendik' => $idTendik,
    //                 'jenis_ijazah' => $jenisIjazah,
    //                 'nama_file' => $imageNamaFile
    //             ];
    //         }
    //     }

    //     if (!empty($ijazahData)) {
    //         IjazahTendik::insert($ijazahData);
    //     }

    //     // Menangani upload dan penyimpanan sertifikat
    //     $sertifikatData = [];
    //     if ($request->hasFile('foto_sertifikat')) {
    //         foreach ($request->file('foto_sertifikat') as $index => $file) {
    //             $imageNamaSertifikat = $this->fileSetup($file, $nama, 'Sertifikat-' . ($index + 1) . '-', $namaDir, '/sertifikat');
    //             $sertifikatData[] = [
    //                 'id_tendik' => $idTendik,
    //                 'nama_file' => $imageNamaSertifikat
    //             ];
    //         }
    //     }

    //     if (!empty($sertifikatData)) {
    //         SertifikatTendik::insert($sertifikatData);
    //     }

    //     return redirect()->route('tendik.index')->with('success', 'Data tendik berhasil ditambahkan.');
    // }

    public function createDirectoryIfNotExists($directory)
    {
        if (!file_exists($directory)) mkdir($directory, 0777, true);
    }

    public function store(TendikRequest $request)
    {
        $validatedData = $request->validated();
        $nama = str_replace(' ', '_', $request->nama);
        $baseDir = "img/tendik/{$nama}";

        $this->createDirectoryIfNotExists(public_path($baseDir));
        $this->createDirectoryIfNotExists(public_path("{$baseDir}/ijazah"));
        $this->createDirectoryIfNotExists(public_path("{$baseDir}/sertifikat"));

        // Upload the main images
        $imageNamaFoto = $request->hasFile('foto') ? $this->fileSetup($request->file('foto'), $request->nama, 'Foto-', $nama) : null;
        $imageNamaFotoKtp = $request->hasFile('foto_ktp') ? $this->fileSetup($request->file('foto_ktp'), $request->nama, 'Foto-KTP-', $nama) : null;
        $imageNamaFotoSk = $request->hasFile('foto_surat_keterangan_mengajar') ? $this->fileSetup($request->file('foto_surat_keterangan_mengajar'), $request->nama, 'Foto-SK-Mengajar-', $nama) : null;

        $tendik = Tendik::create(array_merge($validatedData, [
            'foto' => $imageNamaFoto,
            'foto_ktp' => $imageNamaFotoKtp,
            'foto_surat_keterangan_mengajar' => $imageNamaFotoSk,
        ]));

        // Debug: check if $tendik is created
        // dd($tendik);

        // Prepare Ijazah data
        $ijazahData = [];
        $ijazahTypes = [
            'ijazah_smp' => 'SMP',
            'ijazah_sma' => 'SMA',
            'ijazah_s1' => 'S1',
            'ijazah_s2' => 'S2',
            'ijazah_s3' => 'S3'
        ];

        foreach ($ijazahTypes as $fileKey => $jenisIjazah) {
            if ($request->hasFile($fileKey)) {
                $imageNamaFile = $this->fileSetup($request->file($fileKey), $request->nama, "Foto-Ijazah-{$jenisIjazah}-", $nama, '/ijazah');
                $ijazahData[] = [
                    'id_tendik' => $tendik->id,
                    'jenis_ijazah' => $jenisIjazah,
                    'nama_file' => $imageNamaFile
                ];
            }
        }

        // // Debug: check if $ijazahData is populated correctly
        // dd($ijazahData);

        if ($ijazahData) {
            IjazahTendik::insert($ijazahData);
        }

        // // Prepare Sertifikat data
        $sertifikatData = [];
        if ($request->hasFile('foto_sertifikat')) {
            foreach ($request->file('foto_sertifikat') as $index => $file) {
                $imageNamaSertifikat = $this->fileSetup($file, $request->nama, 'Sertifikat-' . ($index + 1) . '-', $nama, '/sertifikat');
                $sertifikatData[] = [
                    'id_tendik' => $tendik->id,
                    'nama_file' => $imageNamaSertifikat
                ];
            }
        }

        // // Debug: check if $sertifikatData is populated correctly
        // dd($sertifikatData);

        if ($sertifikatData) {
            SertifikatTendik::insert($sertifikatData);
        }

        return redirect()->route('tendik.index')->with('success', 'Data berhasil ditambahkan');
    }

    // public function update(TendikRequest $request, $id)
    // {
    //     $validatedData = $request->validated();

    //     $guru = Tendik::findOrFail($id);

    //     // Handle old directory removal only if the name has changed
    //     $oldDirname = str_replace(' ', '_', $guru->nama);
    //     $newDirname = str_replace(' ', '_', $request->nama);

    //     if ($oldDirname !== $newDirname) {
    //         $baseDirOld = public_path('img/tendik/' . $oldDirname);
    //         if (File::exists($baseDirOld)) {
    //             File::deleteDirectory($baseDirOld);
    //         }
    //     }

    //     // Prepare new directory
    //     $baseDir = public_path("img/tendik/{$newDirname}");
    //     $this->createDirectoryIfNotExists($baseDir);
    //     $this->createDirectoryIfNotExists("{$baseDir}/ijazah");
    //     $this->createDirectoryIfNotExists("{$baseDir}/sertifikat");

    //     // Handle file uploads
    //     $imageNamaFoto = $request->hasFile('foto') ? $this->fileSetup($request->file('foto'), $request->nama, 'Foto-', $newDirname) : $guru->foto;
    //     $imageNamaFotoKtp = $request->hasFile('foto_ktp') ? $this->fileSetup($request->file('foto_ktp'), $request->nama, 'Foto-KTP-', $newDirname) : $guru->foto_ktp;
    //     $imageNamaFotoSk = $request->hasFile('foto_surat_keterangan_mengajar') ? $this->fileSetup($request->file('foto_surat_keterangan_mengajar'), $request->nama, 'Foto-SK-Mengajar-', $newDirname) : $guru->foto_surat_keterangan_mengajar;

    //     // Update the Guru record with validated data
    //     $guru->update(array_merge(
    //         $validatedData,
    //         [
    //             'foto' => $imageNamaFoto,
    //             'foto_ktp' => $imageNamaFotoKtp,
    //             'foto_surat_keterangan_mengajar' => $imageNamaFotoSk,
    //         ]
    //     ));

    //     $ijazahData = [];
    //     $ijazahTypes = [
    //         'ijazah_smp' => 'SMP',
    //         'ijazah_sma' => 'SMA',
    //         'ijazah_s1' => 'S1',
    //         'ijazah_s2' => 'S2'
    //     ];

    //     foreach ($ijazahTypes as $fileKey => $jenisIjazah) {
    //         if ($request->hasFile($fileKey)) {
    //             $imageNamaFile = $this->fileSetup($request->file($fileKey), $request->nama, "Foto-Ijazah-{$jenisIjazah}-", $newDirname, '/ijazah');
    //             $ijazahData[] = [
    //                 'id_tendik' => $id,
    //                 'jenis_ijazah' => $jenisIjazah,
    //                 'nama_file' => $imageNamaFile
    //             ];
    //         }
    //     }

    //     //Delete data ijazah
    //     IjazahTendik::where('id_tendik', $id)->delete();

    //     //Create new data ijazah
    //     if (!empty($ijazahData)) IjazahTendik::insert($ijazahData);

    //     $sertifikatData = [];

    //     // //Delete data Sertifikat
    //     SertifikatTendik::where('id_tendik', $id)->delete();

    //     if ($request->hasFile('foto_sertifikat')) {
    //         $files = $request->file('foto_sertifikat');
    //         $sertifikatDir = 'img/guru/' . $newDirname . '/sertifikat';

    //         foreach ($files as $index => $file) {
    //             $imageNamaSertifikat = $this->fileSetup($file, $request->nama, 'Sertifikat-' . ($index + 1) . '-', $newDirname, '/sertifikat');
    //             $sertifikatData[] = ['id_tendik' => $id, 'nama_file' => $imageNamaSertifikat];
    //         }
    //     }

    //     if (!empty($sertifikatData)) SertifikatTendik::insert($sertifikatData);

    //     return redirect()->route('tendik.index')->with('success', 'Data berhasil di update');
    // }


    public function update(TendikRequest $request, $id)
{
    // Validasi data request
    $validatedData = $request->validated();

    // Ambil data tendik berdasarkan ID
    $guru = Tendik::findOrFail($id);

    // Ubah nama directory lama jika nama tendik berubah
    $oldDirname = str_replace(' ', '_', $guru->nama);
    $newDirname = str_replace(' ', '_', $request->nama);

    if ($oldDirname !== $newDirname) {
        $baseDirOld = public_path('img/tendik/' . $oldDirname);
        if (File::exists($baseDirOld)) {
            File::deleteDirectory($baseDirOld);
        }
    }

    // Siapkan direktori baru
    $baseDir = public_path("img/tendik/{$newDirname}");
    $this->createDirectoryIfNotExists($baseDir);
    $this->createDirectoryIfNotExists("{$baseDir}/ijazah");
    $this->createDirectoryIfNotExists("{$baseDir}/sertifikat");

    // Tangani upload file (foto, foto KTP, foto SK Mengajar)
    $imageNamaFoto = $request->hasFile('foto') ? $this->fileSetup($request->file('foto'), $request->nama, 'Foto-', $newDirname) : $guru->foto;
    $imageNamaFotoKtp = $request->hasFile('foto_ktp') ? $this->fileSetup($request->file('foto_ktp'), $request->nama, 'Foto-KTP-', $newDirname) : $guru->foto_ktp;
    $imageNamaFotoSk = $request->hasFile('foto_surat_keterangan_mengajar') ? $this->fileSetup($request->file('foto_surat_keterangan_mengajar'), $request->nama, 'Foto-SK-Mengajar-', $newDirname) : $guru->foto_surat_keterangan_mengajar;

    // Update data Tendik
    $guru->update(array_merge(
        $validatedData,
        [
            'foto' => $imageNamaFoto,
            'foto_ktp' => $imageNamaFotoKtp,
            'foto_surat_keterangan_mengajar' => $imageNamaFotoSk,
        ]
    ));

    // Proses data Ijazah
    $ijazahData = [];
    $ijazahTypes = [
        'ijazah_smp' => 'SMP',
        'ijazah_sma' => 'SMA',
        'ijazah_s1' => 'S1',
        'ijazah_s2' => 'S2'
    ];

    foreach ($ijazahTypes as $fileKey => $jenisIjazah) {
        if ($request->hasFile($fileKey)) {
            $imageNamaFile = $this->fileSetup($request->file($fileKey), $request->nama, "Foto-Ijazah-{$jenisIjazah}-", $newDirname, '/ijazah');
            $ijazahData[] = [
                'id_tendik' => $id,
                'jenis_ijazah' => $jenisIjazah,
                'nama_file' => $imageNamaFile
            ];
        }
    }

    // Hapus data ijazah lama
    IjazahTendik::where('id_tendik', $id)->delete();

    // Simpan data ijazah baru
    if (!empty($ijazahData)) IjazahTendik::insert($ijazahData);

    // Proses data Sertifikat
    $sertifikatData = [];
    SertifikatTendik::where('id_tendik', $id)->delete();

    if ($request->hasFile('foto_sertifikat')) {
        $files = $request->file('foto_sertifikat');
        $sertifikatDir = 'img/guru/' . $newDirname . '/sertifikat';

        foreach ($files as $index => $file) {
            $imageNamaSertifikat = $this->fileSetup($file, $request->nama, 'Sertifikat-' . ($index + 1) . '-', $newDirname, '/sertifikat');
            $sertifikatData[] = ['id_tendik' => $id, 'nama_file' => $imageNamaSertifikat];
        }
    }

    // Simpan data sertifikat baru
    if (!empty($sertifikatData)) SertifikatTendik::insert($sertifikatData);

    // Redirect ke halaman index dengan pesan sukses
    return redirect()->route('tendik.index')->with('success', 'Data berhasil di update');
}

    public function edit($id)
    {
        $tendik = Tendik::with('ijazah', 'sertifikat')->findOrFail($id);

        // Pastikan bahwa atribut tanggal adalah instance dari Carbon
        if (!$tendik->tanggal_lahir instanceof Carbon) {
            $tendik->tanggal_lahir = new Carbon($tendik->tanggal_lahir);
        }
        if (!$tendik->tanggal_masuk instanceof Carbon) {
            $tendik->tanggal_masuk = new Carbon($tendik->tanggal_masuk);
        }
        if (!$tendik->tanggal_keluar instanceof Carbon) {
            $tendik->tanggal_keluar = new Carbon($tendik->tanggal_keluar);
        }

        $namatendik = strtolower(str_replace(' ', '_', $tendik->nama)); // Ubah sesuai format yang diinginkan
        $folderPath = "public/img/{$namatendik}/sertifikat/";

        // Periksa apakah folder ada dan ambil semua file
        $ijazahFiles = [];
        if (Storage::exists($folderPath)) {
            $ijazahFiles = Storage::files($folderPath);
        } else {
        }

        return view('database.database.tendik.edit', compact('tendik', 'ijazahFiles'));
    }

    public function destroy($id)
    {
        $data = Tendik::findOrFail($id);
        $namaDir = str_replace(' ', '_', $data->nama);

        // Path direktori
        $baseDir = public_path('img/tendik/' . $namaDir);

        // Hapus direktori dan semua isinya
        if (File::exists($baseDir)) {
            File::deleteDirectory($baseDir);
        }

        // Hapus data dari database
        $data->delete();

        return redirect()->route('tendik.index')->with('success', 'Data berhasil dihapus');
    }
}
