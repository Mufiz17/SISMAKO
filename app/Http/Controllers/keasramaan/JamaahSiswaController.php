<?php

namespace App\Http\Controllers\keasramaan;

use Carbon\Carbon;
use Dompdf\Dompdf;
use Dompdf\Options;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\database\Siswa;
use App\Models\database\DataKelas;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\View;
use App\Models\keasramaan\JamaahSiswa;
use App\Http\Requests\keasramaan\JamaahRequest;
use App\Models\keasramaan\DokumentasiJamaahSiswa;

class JamaahSiswaController extends Controller
{
    public function index(Request $request)
    {
        $tanggal = $request->input('tanggal');
        $kelas = $request->input('kelas');
        $sholat = $request->input('sholat');

        $query = JamaahSiswa::select(
            'dokumentasi_jamaah_siswa.id',
            'dokumentasi_jamaah_siswa.tanggal',
            'dokumentasi_jamaah_siswa.kelas',
            'dokumentasi_jamaah_siswa.sholat',
            'dokumentasi_jamaah_siswa.path_dokumentasi'
        )
            ->join('dokumentasi_jamaah_siswa', 'jamaah_siswa.dokumentasi_jamaah', '=', 'dokumentasi_jamaah_siswa.id')
            ->groupBy(
                'dokumentasi_jamaah_siswa.id',
                'dokumentasi_jamaah_siswa.tanggal',
                'dokumentasi_jamaah_siswa.kelas',
                'dokumentasi_jamaah_siswa.sholat',
                'dokumentasi_jamaah_siswa.path_dokumentasi'
            );

        if ($tanggal) {
            $query->where('dokumentasi_jamaah_siswa.tanggal', $tanggal);
        }

        if ($kelas) {
            $query->where('dokumentasi_jamaah_siswa.kelas', $kelas);
        }

        if ($sholat) {
            $query->where('dokumentasi_jamaah_siswa.sholat', $sholat);
        }

        $query->orderBy('dokumentasi_jamaah_siswa.tanggal', 'desc');

        $dataJamaahSiswa = $query->get();

        return view('keasramaan.jamaah.index', compact('dataJamaahSiswa'));
    }

    // Show the form for creating a new resource
    public function create()
    {
        $dataKelas = DataKelas::with('siswa:id,nama')
            ->where('kelas', '!=', 'lulus')
            ->get()
            ->sortBy(function ($kelas) {
                return $kelas->siswa->nama;
            });

        return view('keasramaan.jamaah.add', compact('dataKelas'));
    }

    public function edit($tanggal, $kelas, $sholat, $id)
    {
        // Ambil data jamaah dari tabel jamaah_siswa berdasarkan dokumentasi_jamaah_siswa.id yang sesuai dengan $id
        $dataJamaah = JamaahSiswa::where('dokumentasi_jamaah', $id)
            ->with('siswa:id,nama')
            ->get();

        // Ambil dokumentasi dari tabel dokumentasi_jamaah_siswa berdasarkan ID
        $dokumentasi = DokumentasiJamaahSiswa::find($id);

        // Kirim data ke view
        return view('keasramaan.jamaah.edit', compact('id', 'dataJamaah', 'dokumentasi', 'tanggal', 'kelas', 'sholat'));
    }

    public function store(JamaahRequest $request)
    {
        $request->validated();
        $pathDokumentasi = null;
        if ($request->hasFile('path_dokumentasi')) {
            $pathDokumentasi = $this->handleFileUpload($request, $request->kelas, $request->sholat);
        }

        $dokumen = DokumentasiJamaahSiswa::create(
            [
                'tanggal' => now(),
                'kelas' => $request->kelas,
                'sholat' => $request->sholat,
                'path_dokumentasi' => $pathDokumentasi ?? ''
            ]
        );


        // Process each student entry
        foreach ($request->siswa_ids as $siswaId) {
            if (isset($request->status[$siswaId]) && isset($request->nama_siswa[$siswaId])) {
                JamaahSiswa::create([
                    'dokumentasi_jamaah' => $dokumen->id,
                    'id_siswa' => $siswaId,
                    'status_jamaah' => $request->status[$siswaId],
                ]);
            }
        }

        return redirect()->route('jamaah.index')
            ->with('success', 'Jamaah Siswa created successfully.');
    }

    // Display the specified resource
    public function show(JamaahSiswa $jamaahSiswa)
    {
        return view('jamaah_siswa.show', compact('jamaahSiswa'));
    }

    public function update(JamaahRequest $request, $tanggal, $kelas, $sholat, $id)
    {
        // Validasi request
        $request->validated();

        // Handle file upload if a new file is provided
        $pathDokumentasi = null;
        if ($request->hasFile('path_dokumentasi')) {
            $pathDokumentasi = $this->handleFileUpload($request, $kelas, $request->sholat);
        }

        // Update or create the documentation entry
        $dokumen = DokumentasiJamaahSiswa::findOrFail($id);

        // Update the document with new data
        $dokumen->update([
            'kelas' => $kelas,
            'tanggal' => $tanggal,
            'sholat' => $request->sholat,
            'path_dokumentasi' => $pathDokumentasi ?? $dokumen->path_dokumentasi,
        ]);

        // Debugging: Ensure status and siswa_ids arrays are set correctly
        Log::info('Updating JamaahSiswa records', [
            'siswa_ids' => $request->siswa_ids,
            'status' => $request->status
        ]);

        // Update each student record
        foreach ($request->siswa_ids as $index => $siswa_id) {
            $status = $request->status[$siswa_id] ?? null;

            if ($status) {
                // Check if the ID exists in JamaahSiswa table
                $siswaExists = JamaahSiswa::where('id', $siswa_id)->exists();
                if (!$siswaExists) {
                    Log::error('JamaahSiswa ID does not exist', ['siswa_id' => $siswa_id]);
                    continue; // Skip to the next iteration
                }

                // Update record
                JamaahSiswa::updateOrCreate(
                    [
                        'id' => $siswa_id, // Use ID directly
                        'dokumentasi_jamaah' => $dokumen->id, // Associate with documentation
                    ],
                    [
                        'kelas' => $kelas,
                        'status_jamaah' => $status,
                        'sholat' => $request->sholat,
                    ]
                );
            } else {
                // Handle case where status is missing for the given siswa_id
                Log::warning('No status found for siswa_id', ['siswa_id' => $siswa_id]);
            }
        }

        return redirect()->route('jamaah.index')
            ->with('success', 'Jamaah Siswa updated successfully.');
    }

    private function handleFileUpload(Request $request, $kelas, $sholat)
    {
        if ($request->hasFile('path_dokumentasi')) {
            $file = $request->file('path_dokumentasi');

            // Generate a unique file name using a hash
            $originalName = $file->getClientOriginalName();
            $hash = md5($originalName . time());
            $extension = $file->getClientOriginalExtension();
            $uniqueName = 'Dokumentasi-' . $kelas . '-' . $sholat . '-' . $hash . '.' . $extension;

            // Move the file to the designated directory with the unique name
            $file->move(public_path('/files/jamaah/'), $uniqueName);

            return '/files/jamaah/' . $uniqueName;
        }

        return null;
    }

    public function destroy($id)
    {
        // Find the DokumentasiJamaahSiswa entry
        $dokumen = DokumentasiJamaahSiswa::find($id);

        if (!$dokumen) {
            return redirect()->route('jamaah.index')
                ->with('error', 'Dokumentasi Jamaah Siswa not found.');
        }

        // Delete associated file if it exists
        if ($dokumen->path_dokumentasi && public_path($dokumen->path_dokumentasi)) {
            public_path($dokumen->path_dokumentasi);
        }

        // Delete the DokumentasiJamaahSiswa entry
        $dokumen->delete();

        // Optionally, you might want to delete related JamaahSiswa records
        JamaahSiswa::where('dokumentasi_jamaah', $id)->delete();

        return redirect()->route('jamaah.index')
            ->with('success', 'Dokumentasi Jamaah Siswa deleted successfully.');
    }


    public function exportPdfPerSholat(Request $request, $tanggal, $kelas, $sholat)
    {
        // Join with dokumentasi_jamaah_siswa to filter based on tanggal, kelas, and sholat
        $query = JamaahSiswa::query()
            ->join('siswa', 'jamaah_siswa.id_siswa', '=', 'siswa.id') // Join with siswa table
            ->join('dokumentasi_jamaah_siswa', 'jamaah_siswa.dokumentasi_jamaah', '=', 'dokumentasi_jamaah_siswa.id') // Join with dokumentasi_jamaah_siswa table
            ->where('dokumentasi_jamaah_siswa.tanggal', $tanggal) // Filter based on dokumentasi_jamaah_siswa columns
            ->where('dokumentasi_jamaah_siswa.kelas', $kelas)
            ->where('dokumentasi_jamaah_siswa.sholat', $sholat)
            ->orderBy('siswa.nama', 'asc')
            ->select('jamaah_siswa.*', 'siswa.nama as nama_siswa');

        $jamaahSiswa = $query->get();

        $dokumentasiSiswa = DokumentasiJamaahSiswa::query()
            ->where('tanggal', $tanggal)
            ->where('kelas', $kelas)
            ->where('sholat', $sholat)
            ->get();

        // Generate HTML from a view
        $html = View::make('database.template.jamaahSiswa', compact('jamaahSiswa', 'dokumentasiSiswa', 'kelas', 'tanggal', 'sholat'))->render();

        // Instantiate Dompdf
        $options = new Options();
        $options->set('isRemoteEnabled', true);
        $options->set('isHtml5ParserEnabled', true);

        $dompdf = new Dompdf($options);

        // Load HTML content
        $dompdf->loadHtml($html);

        // Set paper size and orientation
        $dompdf->setPaper('A4');

        // Render PDF
        $dompdf->render();

        // Stream the generated PDF to the browser
        return $dompdf->stream('jamaah_siswa.pdf');
    }

    public function exportPdfPerHari(Request $request, $tanggal, $kelas)
    {
        $prayers = ['Subuh', 'Dzuhur', 'Ashar', 'Maghrib', 'Isya'];

        $dataBySholat = [];
        foreach ($prayers as $sholat) {
            $query = JamaahSiswa::query()
                ->join('siswa', 'jamaah_siswa.id_siswa', '=', 'siswa.id')
                ->join('dokumentasi_jamaah_siswa', 'jamaah_siswa.dokumentasi_jamaah', '=', 'dokumentasi_jamaah_siswa.id')
                ->where('dokumentasi_jamaah_siswa.tanggal', $tanggal)
                ->where('dokumentasi_jamaah_siswa.kelas', $kelas)
                ->where('dokumentasi_jamaah_siswa.sholat', $sholat) // Filter berdasarkan sholat
                ->orderBy('siswa.nama', 'asc')
                ->select('jamaah_siswa.*', 'siswa.nama as nama_siswa', 'dokumentasi_jamaah_siswa.sholat', 'status_jamaah')
                ->get();

            $dataBySholat[$sholat] = $query;
        }

        $html = View::make('database.template.jamaahSiswaPerHari', compact('dataBySholat', 'kelas', 'tanggal'))->render();

        $options = new Options();
        $options->set('isRemoteEnabled', true);
        $options->set('isHtml5ParserEnabled', true);

        $dompdf = new Dompdf($options);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4');
        $dompdf->render();

        return $dompdf->stream('jamaah_siswa_' . $kelas . '_' . $tanggal . '.pdf');
    }


    public function exportPdfPerRange(Request $request, $startDate, $endDate, $kelas)
    {
        $prayers = ['Subuh', 'Dzuhur', 'Ashar', 'Maghrib', 'Isya'];
        $dateRange = Carbon::parse($startDate)->toPeriod(Carbon::parse($endDate)->addDay());
        $totalDays = Carbon::parse($startDate)->diffInDays(Carbon::parse($endDate)) + 1;
        $totalPrayers =  $totalDays * 5; // Correct calculation for total prayer slots
        // $totalPrayers += 1;
        // Initialize scores and detailed points
        $studentScores = [];
        $studentDetails = [];

        // Initialize counters for "Sakit" and "Alpha"
        $studentAbsences = [];
        $studentSick = [];

        foreach ($dateRange as $date) {
            foreach ($prayers as $sholat) {
                $query = JamaahSiswa::query()
                    ->join('siswa', 'jamaah_siswa.id_siswa', '=', 'siswa.id')
                    ->join('dokumentasi_jamaah_siswa', 'jamaah_siswa.dokumentasi_jamaah', '=', 'dokumentasi_jamaah_siswa.id')
                    ->where('dokumentasi_jamaah_siswa.tanggal', $date->format('Y-m-d'))
                    ->where('dokumentasi_jamaah_siswa.kelas', $kelas)
                    ->where('dokumentasi_jamaah_siswa.sholat', $sholat)
                    ->orderBy('siswa.nama', 'asc')
                    ->select('jamaah_siswa.*', 'siswa.nama as nama_siswa', 'dokumentasi_jamaah_siswa.sholat', 'status_jamaah')
                    ->get();

                foreach ($query as $record) {
                    $idSiswa = $record->id_siswa;

                    if (!isset($studentScores[$idSiswa])) {
                        $studentScores[$idSiswa] = 0; // Initialize score to 0
                        $studentDetails[$idSiswa] = []; // Initialize details to empty array

                        // Initialize absence counters
                        $studentAbsences[$idSiswa] = 0;
                        $studentSick[$idSiswa] = 0;
                        $studentIzin[$idSiswa] = 0;
                    }

                    if ($record->status_jamaah == 'Hadir') {
                        $studentScores[$idSiswa]++; // Increment for Hadir

                        // Add detail for each sholat
                        if (!isset($studentDetails[$idSiswa][$sholat])) {
                            $studentDetails[$idSiswa][$sholat] = 0;
                        }
                        $studentDetails[$idSiswa][$sholat]++;
                    } elseif ($record->status_jamaah == 'Sakit') {
                        $studentSick[$idSiswa]++;
                    } elseif($record->status_jamaah == 'Izin') {
                        $studentIzin[$idSiswa]++;
                    }
                    else {
                        $studentAbsences[$idSiswa]++;
                    }
                }
            }
        }

        // Normalize scores to a maximum of 7 points
        foreach ($studentScores as $idSiswa => $score) {
            // Ensure the score is between 0 and 7
            $studentScores[$idSiswa] = max(0, min(7, $score));
        }

        // Fetch names for the final report
        $students = Siswa::whereIn('id', array_keys($studentScores))->pluck('nama', 'id')->toArray();
        foreach ($studentScores as $idSiswa => $score) {
            $studentScores[$idSiswa] = [
                'score' => $score,
                'details' => $studentDetails[$idSiswa], // Include detailed points
                'sick' => $studentSick[$idSiswa] ?? 0, // Include sick count
                'absences' => $studentAbsences[$idSiswa] ?? 0, // Include absences count
                'name' => $students[$idSiswa] ?? 'Unknown',
                'izin' => $studentIzin[$idSiswa] ?? 0
            ];
        }

        // Generate the HTML content for the PDF
        $html = View::make('database.template.jamaahSiswaPerMinggu', compact('totalPrayers', 'kelas', 'startDate', 'endDate', 'prayers', 'studentScores'))->render();

        // Initialize Dompdf with options
        $options = new Options();
        $options->set('isRemoteEnabled', true);
        $options->set('isHtml5ParserEnabled', true);

        $dompdf = new Dompdf($options);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();

        // Stream the PDF to the browser
        return $dompdf->stream('jamaah_siswa_' . $kelas . '_' . $startDate . '_to_' . $endDate . '.pdf');
    }
}
