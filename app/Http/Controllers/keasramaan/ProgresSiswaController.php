<?php

namespace App\Http\Controllers\keasramaan;

use DateTime;
use Illuminate\Http\Request;
use App\Models\database\Siswa;
use App\Http\Controllers\Controller;

class ProgresSiswaController extends Controller
{
    public function index(Request $request, $nisn)
    {
        // Retrieve start_date and end_date from query parameters
        $start_date = $request->query('start_date');
        $end_date = $request->query('end_date');

        // Mengonversi string tanggal ke objek DateTime
        $start = new DateTime($start_date);
        $end = new DateTime($end_date);

        // Menghitung selisih hari antara dua tanggal
        $interval = $start->diff($end);

        // Mendapatkan jumlah hari
        $jumlah_hari = $interval->days;

        // dd($jumlah_hari);

        // Retrieve siswa data with related models
        $siswa = Siswa::where('nisn', $nisn)
            ->select('id', 'nama', 'nisn', 'tahun_pelajaran')
            ->with([
                'fotoSiswa',
                'dataKelas',
                'tahfidzSiswa' => function ($query) use ($start_date, $end_date) {
                    $query->betweenDates($start_date, $end_date)->latest('tanggal');
                },
                'tahsinSiswa' => function ($query) use ($start_date, $end_date) {
                    $query->betweenDates($start_date, $end_date)->latest('tanggal')->first();
                },
                'sertifikatSiswa',
                // 'jurnalAsramaSiswa' => function ($query) use ($start_date, $end_date) {
                //     $query->betweenDates($start_date, $end_date);
                // },
                'pelatihanSiswa' => function ($query) use ($start_date, $end_date) {
                    $query->betweenDates($start_date, $end_date);
                }
            ])
            ->firstOrFail();
        // Ensure jurnalAsramaSiswa is not null and categorize it
        $jurnalAsramaSiswa = $siswa->jurnalAsramaSiswa ?: collect();

        // Categorize jurnalAsramaSiswa data by 'type'
        $jurnalData = $jurnalAsramaSiswa->groupBy('type');

        $jumlah_minggu = ceil($jumlah_hari / 7);

        $tajwidData = $jurnalData->get('tajwid', collect())->take(-6);
        $tafsirData = $jurnalData->get('tafsir', collect())->take(-6);
        $fiqihData = $jurnalData->get('fiqih', collect())->take(-6);
        $akhlakData = $jurnalData->get('akhlak', collect())->take(-6);


        // Combine all data into a single array
        $combinedData = [
            'akhlak' => $akhlakData,
            'fiqih' => $fiqihData,
            'tafsir' => $tafsirData,
            'tajwid' => $tajwidData,
        ];

        // Add the combined data to the siswa object
        $siswa->jurnalAsramaSiswa = $combinedData;

        return response()->json([
            'status' => 'success',
            'data' => $siswa
        ]);
        // Return the combined data to the view
        // return view('keasramaan.progresSiswa', compact('siswa', 'start_date', 'end_date'));
    }

    public function getData(Request $request, $nisn)
    {
        // Retrieve start_date and end_date from query parameters
        $start_date = $request->query('start_date');
        $end_date = $request->query('end_date');

        // Mengonversi string tanggal ke objek DateTime
        $start = new DateTime($start_date);
        $end = new DateTime($end_date);

        // Menghitung selisih hari antara dua tanggal
        $interval = $start->diff($end);
        $jumlah_hari = $interval->days;
        $jumlah_minggu = ceil($jumlah_hari / 7);

        // Retrieve siswa data with related models
        $siswa = Siswa::where('nisn', $nisn)
            ->select('id', 'nama', 'nisn', 'tahun_pelajaran')
            ->with([
                'fotoSiswa',
                'dataKelas',
                'tahfidzSiswa' => function ($query) use ($start_date, $end_date) {
                    $query->betweenDates($start_date, $end_date)->latest('tanggal');
                },
                'tahsinSiswa' => function ($query) use ($start_date, $end_date) {
                    $query->betweenDates($start_date, $end_date)->latest('tanggal')->first();
                },
                'sertifikatSiswa',
                'pelatihanSiswa' => function ($query) use ($start_date, $end_date) {
                    $query->betweenDates($start_date, $end_date);
                }
            ])
            ->firstOrFail();

        // Ensure jurnalAsramaSiswa is not null and categorize it
        $jurnalAsramaSiswa = $siswa->jurnalAsramaSiswa ?: collect();

        // Categorize jurnalAsramaSiswa data by 'type'
        $jurnalData = $jurnalAsramaSiswa->groupBy('type');

        // Mengambil data jurnal dengan maksimal 6 entri terakhir
        $tajwidData = $jurnalData->get('tajwid', collect())->take(-6);
        $tafsirData = $jurnalData->get('tafsir', collect())->take(-6);
        $fiqihData = $jurnalData->get('fiqih', collect())->take(-6);
        $akhlakData = $jurnalData->get('akhlak', collect())->take(-6);

        // Menggabungkan semua data dalam satu array
        $combinedData = [
            'akhlak' => $akhlakData,
            'fiqih' => $fiqihData,
            'tafsir' => $tafsirData,
            'tajwid' => $tajwidData,
            'jumlah_hari' => $jumlah_hari,
            'jumlah_minggu' => $jumlah_minggu,
        ];

        // Menambahkan data jurnal ke dalam siswa
        $siswa->jurnalAsramaSiswa = $combinedData;

        // Mengembalikan data dalam format JSON
        return response()->json([
            'status' => 'success',
            'data' => $siswa
        ]);
    }
}
