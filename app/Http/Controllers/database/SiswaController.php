<?php

namespace App\Http\Controllers\database;

use Dompdf\Dompdf;
use Dompdf\Options;
use App\Models\database\Siswa;
use App\Models\database\FotoSiswa;
use App\Models\database\RapotSiswa;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\View;
use App\Http\Controllers\Controller;
use App\Http\Requests\database\SiswaRequest;

class SiswaController extends Controller
{
    public function index()
    {
        $siswa = Siswa::all();
        return view('database.database.siswa.index', compact('siswa'));
    }
    public function fileSetup($file, $nama, $prefix, $namaDir, $path = '')
    {
        $imageFileName = $prefix . str_replace(' ', '_', $nama) . '.' . $file->getClientOriginalExtension();
        $fullPath = 'img/Siswa/' . $namaDir . $path . '/';

        // Pastikan direktori tujuan ada
        if (!file_exists(public_path($fullPath))) {
            mkdir($fullPath, 0777, true);
        }

        // Pindahkan file ke direktori tujuan
        $file->move($fullPath, $imageFileName);

        return '/' . $fullPath . $imageFileName;
    }
    private function createDirectoryIfNotExists($path)
    {
        if (!File::exists($path)) {
            File::makeDirectory($path, 0755, true);
        }
    }
    public function create()
    {
        return view('database.database.siswa.add');
    }
    public function store(SiswaRequest $request)
    {
        $validatedData = $request->validated();

        $nama = $request->nama;
        $namaDir = str_replace(' ', '_', $nama);
        $baseDir = public_path("img/Siswa/{$namaDir}");

        $this->createDirectoryIfNotExists($baseDir);
        $this->createDirectoryIfNotExists("{$baseDir}/foto");
        $this->createDirectoryIfNotExists("{$baseDir}/rapot");

        if ($request->hasFile('ijazah')) $imageNamaFotoIjazah = $this->fileSetup($request->file('ijazah'), $nama, 'Ijazah-', $namaDir);
        if ($request->hasFile('surat_Kelulusan')) $imageNamaFotoSurat_Kelulusan = $this->fileSetup($request->file('surat_Kelulusan'), $nama, 'Surat-Kelulusan-', $namaDir);
        if ($request->hasFile('kk')) $imageNamaFotoKK = $this->fileSetup($request->file('kk'), $nama, 'KK--', $namaDir);
        if ($request->hasFile('akta_kelahiran')) $imageNamaFotoAkta_kelahiran = $this->fileSetup($request->file('akta_kelahiran'), $nama, 'Akta-Kelahiran-', $namaDir);
        if ($request->hasFile('surat_pernyataan_calonPesertaDidik')) $imageNamaFotoSurat_pernyataan_calonPesertaDidik = $this->fileSetup($request->file('surat_pernyataan_calonPesertaDidik'), $nama, 'Surat-Pernyataan-PesertaDidik-', $namaDir);
        if ($request->hasFile('surat_pernyataan_wali')) $imageNamaFotoSurat_pernyataan_wali = $this->fileSetup($request->file('surat_pernyataan_wali'), $nama, 'KK--', $namaDir);
        if ($request->hasFile('surat_pernyataan_tidak_merokok')) $imageNamaFotoSurat_pernyataan_tidak_merokok = $this->fileSetup($request->file('surat_pernyataan_tidak_merokok'), $nama, 'Surat-pernyataan-tidak-merokok--', $namaDir);

        // Create a new siswa record
        $siswa = Siswa::create(array_merge(
            $validatedData,
            [
                'path_ijazah' => $imageNamaFotoIjazah ?? '',
                'path_surat_Kelulusan' => $imageNamaFotoSurat_Kelulusan ?? '',
                'path_kk' => $imageNamaFotoKK ?? '',
                'path_akta_kelahiran' => $imageNamaFotoAkta_kelahiran ?? '',
                'path_surat_pernyataan_calonPesertaDidik' => $imageNamaFotoSurat_pernyataan_calonPesertaDidik ?? '',
                'path_surat_pernyataan_wali' => $imageNamaFotoSurat_pernyataan_wali ?? '',
                'path_surat_pernyataan_tidak_merokok' => $imageNamaFotoSurat_pernyataan_tidak_merokok ?? ''
            ]
        ));

        $rapotType = [
            'rapot_kelas7' => 'VII',
            'rapot_kelas8' => 'VIII',
            'rapot_kelas9' => 'IX'
        ];

        $fotoTypes = [
            'foto_kelas10' => 'X',
            'foto_kelas11' => 'XI',
            'foto_kelas12' => 'XII'
        ];

        $rapot_data = [];
        $foto_data = [];

        foreach ($rapotType as $file_key => $JenisRapot) {
            if ($request->hasFile($file_key)) {
                $image_name = $this->fileSetup($request->file($file_key), $nama, "Foto-Rapot-{$JenisRapot}-", $namaDir, '/rapot');
                $rapot_data[] = [
                    'id_siswa' => $siswa->id,
                    'rapot_kelas' => $JenisRapot,
                    'path_file' => $image_name ?? ''
                ];
            }
        }

        foreach ($fotoTypes as $file_key => $JenisFoto) {
            if ($request->hasFile($file_key)) {
                $image_name = $this->fileSetup($request->file($file_key), $nama, "Foto-{$JenisFoto}-", $namaDir, '/foto');
                $foto_data[] = [
                    'id_siswa' => $siswa->id,
                    'jenis_foto' => $JenisFoto,
                    'path_file' => $image_name ?? ''
                ];
            }
        }

        if (!empty($rapot_data)) {
            RapotSiswa::insert($rapot_data);
        }

        if (!empty($foto_data)) {
            FotoSiswa::insert($foto_data);
        }

        return redirect()->route('siswa.index')->with('success', 'Data berhasil ditambahkan');
    }
    public function edit($id)
    {
        $siswa = Siswa::with('rapotSiswa', 'fotoSiswa')->findOrFail($id);
        // Check if tanggal_masuk is being treated as a Carbon instance
        if (!$siswa->tanggal_masuk instanceof \Carbon\Carbon) {
            $siswa->tanggal_masuk = \Carbon\Carbon::parse($siswa->tanggal_masuk);
            $siswa->tanggal_lahir = \Carbon\Carbon::parse($siswa->tanggal_lahir);
        }
        return view('database.database.siswa.edit', compact('siswa'));
    }
    // public function update(SiswaRequest $request, $id)
    // {
    //     $validatedData = $request->validated();
    //     $siswa = Siswa::findOrFail($id);

    //     // Menghapus folder lama jika ada
    //     $oldDirname = str_replace(' ', '_', $siswa->nama);
    //     $baseDirOld = public_path('img/siswa/' . $oldDirname);
    //     if (File::exists($baseDirOld)) {
    //         File::deleteDirectory($baseDirOld);
    //     }

    //     $nama = $request->nama;
    //     $namaDir = str_replace(' ', '_', $nama);
    //     $baseDir = public_path("img/Siswa/{$namaDir}");

    //     $this->createDirectoryIfNotExists($baseDir);
    //     $this->createDirectoryIfNotExists("{$baseDir}/foto");
    //     $this->createDirectoryIfNotExists("{$baseDir}/rapot");

    //     if ($request->hasFile('ijazah')) $imageNamaFotoIjazah = $this->fileSetup($request->file('ijazah'), $nama, 'Ijazah-', $namaDir);
    //     if ($request->hasFile('surat_Kelulusan')) $imageNamaFotoSurat_Kelulusan = $this->fileSetup($request->file('surat_Kelulusan'), $nama, 'Surat-Kelulusan-', $namaDir);
    //     if ($request->hasFile('kk')) $imageNamaFotoKK = $this->fileSetup($request->file('kk'), $nama, 'KK--', $namaDir);
    //     if ($request->hasFile('akta_kelahiran')) $imageNamaFotoAkta_kelahiran = $this->fileSetup($request->file('akta_kelahiran'), $nama, 'Akta-Kelahiran-', $namaDir);
    //     if ($request->hasFile('surat_pernyataan_calonPesertaDidik')) $imageNamaFotoSurat_pernyataan_calonPesertaDidik = $this->fileSetup($request->file('surat_pernyataan_calonPesertaDidik'), $nama, 'Surat-Pernyataan-PesertaDidik-', $namaDir);
    //     if ($request->hasFile('surat_pernyataan_wali')) $imageNamaFotoSurat_pernyataan_wali = $this->fileSetup($request->file('surat_pernyataan_wali'), $nama, 'KK--', $namaDir);
    //     if ($request->hasFile('surat_pernyataan_tidak_merokok')) $imageNamaFotoSurat_pernyataan_tidak_merokok = $this->fileSetup($request->file('surat_pernyataan_tidak_merokok'), $nama, 'Surat-pernyataan-tidak-merokok--', $namaDir);

    //     $siswa->update(array_merge(
    //         $validatedData,
    //         [
    //             'path_ijazah' => $imageNamaFotoIjazah ?? '',
    //             'path_surat_Kelulusan' => $imageNamaFotoSurat_Kelulusan ?? '',
    //             'path_kk' => $imageNamaFotoKK ?? '',
    //             'path_akta_kelahiran' => $imageNamaFotoAkta_kelahiran ?? '',
    //             'path_surat_pernyataan_calonPesertaDidik' => $imageNamaFotoSurat_pernyataan_calonPesertaDidik ?? '',
    //             'path_surat_pernyataan_wali' => $imageNamaFotoSurat_pernyataan_wali ?? '',
    //             'path_surat_pernyataan_tidak_merokok' => $imageNamaFotoSurat_pernyataan_tidak_merokok ?? ''
    //         ]
    //     ));

    //     RapotSiswa::where('id_siswa', $id)->delete();
    //     FotoSiswa::where('id_siswa', $id)->delete();

    //     $rapotType = [
    //         'rapot_kelas7' => 'VII',
    //         'rapot_kelas8' => 'VIII',
    //         'rapot_kelas9' => 'IX'
    //     ];

    //     $fotoTypes = [
    //         'foto_kelas10' => 'X',
    //         'foto_kelas11' => 'XI',
    //         'foto_kelas12' => 'XII'
    //     ];

    //     $rapot_data = [];
    //     $foto_data = [];

    //     foreach ($rapotType as $file_key => $JenisRapot) {
    //         if ($request->hasFile($file_key)) {
    //             $image_name = $this->fileSetup($request->file($file_key), $request->nama, "Foto-Rapot-{$JenisRapot}-", $namaDir, '/rapot');
    //             $rapot_data[] = [
    //                 'id_siswa' => $siswa->id,
    //                 'rapot_kelas' => $JenisRapot,
    //                 'path_file' => $image_name ?? ''
    //             ];
    //         }
    //     }

    //     foreach ($fotoTypes as $file_key => $JenisFoto) {
    //         if ($request->hasFile($file_key)) {
    //             $image_name = $this->fileSetup($request->file($file_key), $request->nama, "Foto-{$JenisFoto}-", $namaDir, '/foto');
    //             $foto_data[] = [
    //                 'id_siswa' => $siswa->id,
    //                 'jenis_foto' => $JenisFoto,
    //                 'path_file' => $image_name ?? ''
    //             ];
    //         }
    //     }

    //     if (!empty($rapot_data)) {
    //         RapotSiswa::insert($rapot_data);
    //     }

    //     if (!empty($foto_data)) {
    //         FotoSiswa::insert($foto_data);
    //     }

    //     return redirect()->route('siswa.index')->with('success', 'Data berhasil di update');
    // }

    public function update(SiswaRequest $request, $id)
{
    $validatedData = $request->validated();
    $siswa = Siswa::findOrFail($id);

    // Menghapus folder lama jika nama siswa berubah
    $oldDirname = str_replace(' ', '_', $siswa->nama);
    $newDirname = str_replace(' ', '_', $request->nama);

    if ($oldDirname !== $newDirname) {
        $baseDirOld = public_path('img/siswa/' . $oldDirname);
        if (File::exists($baseDirOld)) {
            File::deleteDirectory($baseDirOld);
        }
    }

    // Membuat direktori baru
    $baseDir = public_path("img/siswa/{$newDirname}");
    $this->createDirectoryIfNotExists($baseDir);
    $this->createDirectoryIfNotExists("{$baseDir}/foto");
    $this->createDirectoryIfNotExists("{$baseDir}/rapot");

    // Mengatur file ijazah dan dokumen lainnya
    $imageNamaFotoIjazah = $request->hasFile('ijazah') ? $this->fileSetup($request->file('ijazah'), $request->nama, 'Ijazah-', $newDirname) : $siswa->path_ijazah;
    $imageNamaFotoSurat_Kelulusan = $request->hasFile('surat_Kelulusan') ? $this->fileSetup($request->file('surat_Kelulusan'), $request->nama, 'Surat-Kelulusan-', $newDirname) : $siswa->path_surat_Kelulusan;
    $imageNamaFotoKK = $request->hasFile('kk') ? $this->fileSetup($request->file('kk'), $request->nama, 'KK-', $newDirname) : $siswa->path_kk;
    $imageNamaFotoAkta_kelahiran = $request->hasFile('akta_kelahiran') ? $this->fileSetup($request->file('akta_kelahiran'), $request->nama, 'Akta-Kelahiran-', $newDirname) : $siswa->path_akta_kelahiran;
    $imageNamaFotoSurat_pernyataan_calonPesertaDidik = $request->hasFile('surat_pernyataan_calonPesertaDidik') ? $this->fileSetup($request->file('surat_pernyataan_calonPesertaDidik'), $request->nama, 'Surat-Pernyataan-PesertaDidik-', $newDirname) : $siswa->path_surat_pernyataan_calonPesertaDidik;
    $imageNamaFotoSurat_pernyataan_wali = $request->hasFile('surat_pernyataan_wali') ? $this->fileSetup($request->file('surat_pernyataan_wali'), $request->nama, 'Surat-Pernyataan-Wali-', $newDirname) : $siswa->path_surat_pernyataan_wali;
    $imageNamaFotoSurat_pernyataan_tidak_merokok = $request->hasFile('surat_pernyataan_tidak_merokok') ? $this->fileSetup($request->file('surat_pernyataan_tidak_merokok'), $request->nama, 'Surat-Pernyataan-Tidak-Merokok-', $newDirname) : $siswa->path_surat_pernyataan_tidak_merokok;

    // Mengupdate data siswa
    $siswa->update(array_merge(
        $validatedData,
        [
            'path_ijazah' => $imageNamaFotoIjazah,
            'path_surat_Kelulusan' => $imageNamaFotoSurat_Kelulusan,
            'path_kk' => $imageNamaFotoKK,
            'path_akta_kelahiran' => $imageNamaFotoAkta_kelahiran,
            'path_surat_pernyataan_calonPesertaDidik' => $imageNamaFotoSurat_pernyataan_calonPesertaDidik,
            'path_surat_pernyataan_wali' => $imageNamaFotoSurat_pernyataan_wali,
            'path_surat_pernyataan_tidak_merokok' => $imageNamaFotoSurat_pernyataan_tidak_merokok
        ]
    ));

    // Menghapus data rapot dan foto lama
    RapotSiswa::where('id_siswa', $id)->delete();
    FotoSiswa::where('id_siswa', $id)->delete();

    // Menyimpan data rapot baru
    $rapotType = [
        'rapot_kelas7' => 'VII',
        'rapot_kelas8' => 'VIII',
        'rapot_kelas9' => 'IX'
    ];

    $rapot_data = [];
    foreach ($rapotType as $file_key => $JenisRapot) {
        if ($request->hasFile($file_key)) {
            $image_name = $this->fileSetup($request->file($file_key), $request->nama, "Rapot-{$JenisRapot}-", $newDirname, '/rapot');
            $rapot_data[] = [
                'id_siswa' => $siswa->id,
                'rapot_kelas' => $JenisRapot,
                'path_file' => $image_name
            ];
        }
    }
    if (!empty($rapot_data)) {
        RapotSiswa::insert($rapot_data);
    }

    // Menyimpan data foto baru
    $fotoTypes = [
        'foto_kelas10' => 'X',
        'foto_kelas11' => 'XI',
        'foto_kelas12' => 'XII'
    ];

    $foto_data = [];
    foreach ($fotoTypes as $file_key => $JenisFoto) {
        if ($request->hasFile($file_key)) {
            $image_name = $this->fileSetup($request->file($file_key), $request->nama, "Foto-{$JenisFoto}-", $newDirname, '/foto');
            $foto_data[] = [
                'id_siswa' => $siswa->id,
                'jenis_foto' => $JenisFoto,
                'path_file' => $image_name
            ];
        }
    }
    if (!empty($foto_data)) {
        FotoSiswa::insert($foto_data);
    }

    return redirect()->route('siswa.index')->with('success', 'Data berhasil di update');
}


    public function destroy($id)
    {
        $data = Siswa::findOrFail($id);
        $namaDir = str_replace(' ', '_', $data->nama);
        $baseDir = public_path('img/Siswa/' . $namaDir);

        // Hapus direktori dan semua isinya
        if (File::exists($baseDir)) {
            File::deleteDirectory($baseDir);
        }

        $data->delete();
        return redirect()->route('siswa.index')->with('success', 'Data berhasil dihapus');
    }
    public function exportPdf($id)
    {
        $siswa = Siswa::with('fotoSiswa')->findOrFail($id);
        $html = View::make('database.template.siswa_cv', compact('siswa'))->render();

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
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        return $dompdf->stream($siswa->nama . '.pdf', ['Attachment' => true]);
    }
}
