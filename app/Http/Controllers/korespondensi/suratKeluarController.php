<?php

namespace App\Http\Controllers\korespondensi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Models\korespondensi\SuratKeluar;
use App\Http\Requests\korespondensi\SuratKeluarRequest;

class suratKeluarController extends Controller
{
     /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $suratKeluar = SuratKeluar::all();
        return view('korespondensi.index', compact('suratKeluar'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SuratKeluarRequest $request)
    {
        // dd($request->all());
        $validated = $request->validated();

        $validated['file_surat'] = $request->file('file_surat')->store('surat-keluar');

        SuratKeluar::create($validated);

        return redirect()->route('inbox.index')->with('success', 'Data surat keluar berhasil ditambahkan');
    }



    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SuratKeluarRequest $request, $id)
    {

        dd($request->all());
        $validated = $request->validated();

        $suratKeluar = SuratKeluar::findOrFail($id);

        if ($request->hasFile('file_surat')) {
            // Hapus file lama jika ada
            if ($suratKeluar->file_surat) {
                Storage::disk('public')->delete($suratKeluar->file_surat);
            }
            // Simpan file baru
            $validated['file_surat'] = $request->file('file_surat')->store('surat-keluar');
        }

        $suratKeluar->update($validated);

        return redirect()->route('inbox.index')->with('success', 'Data surat keluar berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        SuratKeluar::findOrFail($id)->delete();
        return redirect()->route('inbox.index')->with('success', 'Data surat keluar berhasil dihapus');
    }
}
