<?php

namespace App\Http\Controllers\keasramaan;

use Illuminate\Http\Request;


use App\Models\database\Siswa;
use App\Models\keasramaan\akhlak;
use App\Http\Controllers\Controller;
use App\Http\Requests\keasramaan\AkhlakRequest;
use App\Http\Requests\keasramaan\FiqihRequest;

class fiqihController extends Controller
{
    public function index(Request $request)
    {
        // Ambil filter dari input
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
        $searchName = $request->input('search_name');
        $searchKelas = $request->input('search_kelas');

        // Mulai dengan query dasar
        $fiqih = Akhlak::where('type', 'fiqih')
            ->with([
                'siswa:id,nama,nisn',
                'siswa.dataKelas:id,id_siswa,kelas' // 'id_siswa' is the correct foreign key
            ]);

        // Filter berdasarkan tanggal jika ada input
        if ($startDate) {
            $fiqih->where('tanggal', '>=', $startDate);
        }
        if ($endDate) {
            $fiqih->where('tanggal', '<=', $endDate);
        }

        // Filter berdasarkan nama jika ada input
        if ($searchName) {
            $fiqih->whereHas('siswa', function ($query) use ($searchName) {
                $query->where('nama', 'like', '%' . $searchName . '%');
            });
        }

        // Filter berdasarkan kelas jika ada input
        if ($searchKelas) {
            $fiqih->whereHas('siswa.dataKelas', function ($query) use ($searchKelas) {
                $query->where('kelas', 'like', '%' . $searchKelas . '%');
            });
        }

        // Paginate hasil
        $fiqih = $fiqih->paginate(10);

        return view('keasramaan.jurnal.fiqih.fiqih', compact('fiqih'));
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
        return view('keasramaan.jurnal.fiqih.create', compact('angkatan', 'names'));
    }

    public function store(AkhlakRequest $request)
    {
        $validateData = $request->validated();

        akhlak::create(array_merge($validateData, ['type' => 'fiqih']));
        return redirect("/sekolah-keasramaan/jurnal-asrama/fiqih")->with("success", "Berhasil disimpan");
    }

    public function edit($id)
    {
        $fiqih = akhlak::find($id);
        return view('keasramaan.jurnal.fiqih.edit', compact('fiqih'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'tanggal' => 'required',
            'materi' => 'required',
        ], [
            'tanggal.required' => 'Tahun ajaran harus diisi',
            'materi.required' => 'Materi harus diisi',
        ]);

        akhlak::find($id)->update($validatedData);

        return redirect("/sekolah-keasramaan/jurnal-asrama/fiqih")->with("success", "Berhasil diPerbaharui");
    }

    public function destroy($id)
    {
        akhlak::findOrFail($id)->delete();
        return redirect("/sekolah-keasramaan/jurnal-asrama/fiqih")->with("success", "Berhasil dihapus");
    }
}
