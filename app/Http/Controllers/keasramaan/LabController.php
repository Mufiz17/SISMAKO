<?php

namespace App\Http\Controllers\keasramaan;

use Illuminate\Http\Request;
use App\Models\keasramaan\Lab;
use App\Http\Controllers\Controller;
use App\Http\Requests\keasramaan\LabRequest;
use App\Models\database\DataKelas;
use App\Models\database\Guru;

class LabController extends Controller
{
    public function index()
    {
        $labs = Lab::all();
        return view('keasramaan.akses-lab.lab', compact(var_name: 'labs'));
    }

    public function create()
    {
        $guru = Guru::select(columns: ['nama', 'id'])->get();
        return view('keasramaan.akses-lab.create', compact('guru')); // Buat view untuk form tambah
    }

    public function store(LabRequest $request)
    {
        dd($request->all());
        $validated = $request->validated();
        Lab::create($validated);
        return redirect('/sekolah-keasramaan/akses-lab')->with('success', 'Data berhasil ditambahkan!');
    }

    public function edit(Lab $aksesLab)
    {
        $labs = Lab::all(); // Ambil semua data lab di database
        return view('keasramaan.akses-lab.edit', compact('labs')); // Buat view untuk form edit
    }

    public function update(LabRequest $request, Lab $aksesLab)
    {
        $validated = $request->validated();
        $aksesLab->update($validated);
        return redirect('/sekolah-keasramaan/akses-lab')->with('success', 'Data berhasil diupdate!');
    }

    public function destroy(Lab $aksesLab)
    {
        $aksesLab->delete();
        return redirect('/sekolah-keasramaan/akses-lab')->with('success', 'Data berhasil dihapus!');
    }
}
