@extends('layouts.app')

@section('content')
    <div class="px-5 py-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="col">
                <div class="row row-cards">
                    <div class="col-12">
                        <div class="mb-4 col">
                            <a href="{{ route('perpustakaan.index') }}" class="btn btn-secondary">
                                Kembali
                            </a>
                        </div>
                        <form action="{{ route('perpustakaan.update', $perpustakaan->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="card p-3">
                                <h1 class="card-title text-center">Edit Data Perpustakaan</h1>
                                <div class="row">
                                    <div class="mb-3">
                                        <label class="form-label">Tahun Ajaran</label>
                                        <select class="form-control form-select" name="tahun_ajaran">
                                            <option value="">Pilih Tahun Ajaran</option>
                                            @foreach (generateTahunAjaran() as $tahun)
                                                <option value="{{ $tahun }}"
                                                    {{ $perpustakaan->tahun_ajaran == $tahun ? 'selected' : '' }}>
                                                    {{ $tahun }}</option>
                                            @endforeach

                                        </select>
                                        @error('tahun_ajaran')
                                            <div class="text-danger mt-2"> {{ $message }} </div>
                                        @enderror
                                    </div>
                                    <div class="col-sm-6 mb-3">
                                        <label class="form-label">Tata Tertib</label>
                                        <input type="file" name="tatib_perpustakaan" class="form-control">
                                        @error('tatib_perpustakaan')
                                            <div class="text-danger mt-2"> {{ $message }} </div>
                                        @enderror
                                        @if ($perpustakaan->tatib_perpustakaan)
                                            <p>{{ basename($perpustakaan->tatib_perpustakaan) }}</p>
                                        @endif
                                    </div>
                                    <div class="col-sm-6 mb-3">
                                        <label class="form-label">Denah</label>
                                        <input type="file" name="denah_perpustakaan" class="form-control">
                                        @error('denah_perpustakaan')
                                            <div class="text-danger mt-2"> {{ $message }} </div>
                                        @enderror
                                        @if ($perpustakaan->denah_perpustakaan)
                                            <p>{{ basename($perpustakaan->denah_perpustakaan) }}</p>
                                        @endif
                                    </div>
                                    <div class="col-sm-6 mb-3">
                                        <label class="form-label">Daftar Buku</label>
                                        <input type="file" name="daftar_buku" class="form-control">
                                        @error('daftar_buku')
                                            <div class="text-danger mt-2"> {{ $message }} </div>
                                        @enderror
                                        @if ($perpustakaan->daftar_buku)
                                            <p>{{ basename($perpustakaan->daftar_buku) }}</p>
                                        @endif
                                    </div>
                                    <div class="col-sm-6 mb-3">
                                        <label class="form-label">Proker</label>
                                        <input type="file" name="proker_perpus" class="form-control">
                                        @error('proker_perpus')
                                            <div class="text-danger mt-2"> {{ $message }} </div>
                                        @enderror
                                        @if ($perpustakaan->proker_perpus)
                                            <p>{{ basename($perpustakaan->proker_perpus) }}</p>
                                        @endif
                                    </div>
                                    <div class="col-sm-6 mb-3">
                                        <label class="form-label">Struktur</label>
                                        <input type="file" name="struktur" class="form-control">
                                        @error('struktur')
                                            <div class="text-danger mt-2"> {{ $message }} </div>
                                        @enderror
                                        @if ($perpustakaan->struktur)
                                            <p>{{ basename($perpustakaan->struktur) }}</p>
                                        @endif
                                    </div>
                                    <div class="col-sm-6 mb-3">
                                        <label class="form-label">Surat Keputusan</label>
                                        <input type="file" name="sk" class="form-control">
                                        @error('sk')
                                            <div class="text-danger mt-2"> {{ $message }} </div>
                                        @enderror
                                        @if ($perpustakaan->sk)
                                            <p>{{ basename($perpustakaan->sk) }}</p>
                                        @endif
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Daftar pengunjung</label>
                                        <input type="file" name="daftar_pengunjung" class="form-control">
                                        @error('daftar_pengunjung')
                                            <div class="text-danger mt-2"> {{ $message }} </div>
                                        @enderror
                                        @if ($perpustakaan->daftar_pengunjung)
                                            <p>{{ basename($perpustakaan->daftar_pengunjung) }}</p>
                                        @endif
                                    </div>
                                    <button type="submit" class="btn btn-primary">Update</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
