@extends('layouts.app')

@section('content')
    <div class="px-5 py-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="col">
                <div class="row row-cards">
                    <div class="col-12">
                        <div class="mb-4 col">
                            <a href="{{ route('osis.index') }}" class="btn btn-secondary">
                                Kembali
                            </a>
                        </div>
                        <form action="{{ route('osis.update', $osis->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="card p-3">
                                <h1 class="card-title text-center mt-4">Edit Data Osis</h1>
                                <div class="row">
                                    <div class="mb-3">
                                        <label class="form-label">Tahun Ajaran</label>
                                        <select class="form-control form-select" name="tahun_ajaran">
                                            <option value="">Pilih Tahun Ajaran</option>
                                            <option value="2024-2025"
                                                {{ $osis->tahun_ajaran == '2024-2025' ? 'selected' : '' }}>2024-2025
                                            </option>
                                            <option value="2025-2026"
                                                {{ $osis->tahun_ajaran == '2025-2026' ? 'selected' : '' }}>2025-2026
                                            </option>
                                            <option value="2026-2027"
                                                {{ $osis->tahun_ajaran == '2026-2027' ? 'selected' : '' }}>2026-2027
                                            </option>
                                            <option value="2027-2028"
                                                {{ $osis->tahun_ajaran == '2027-2028' ? 'selected' : '' }}>2027-2028
                                            </option>
                                            <option value="2028-2029"
                                                {{ $osis->tahun_ajaran == '2028-2029' ? 'selected' : '' }}>2028-2029
                                            </option>
                                            <option value="2029-2030"
                                                {{ $osis->tahun_ajaran == '2029-2030' ? 'selected' : '' }}>2029-2030
                                            </option>
                                        </select>
                                        @error('tahun_ajaran')
                                            <div class="text-danger mt-2"> {{ $message }} </div>
                                        @enderror
                                    </div>
                                    <div class="col-sm-6 mb-3">
                                        <label class="form-label">Struktur Organisai</label>
                                        <input type="file" name="struktur_organisasi" class="form-control">
                                        @error('struktur_organisasi')
                                            <div class="text-danger mt-2"> {{ $message }} </div>
                                        @enderror
                                        @if ($osis->struktur_organisasi)
                                            <p>{{ basename($osis->struktur_organisasi) }}</p>
                                        @endif
                                    </div>
                                    <div class="col-sm-6 mb-3">
                                        <label class="form-label">Pengurus</label>
                                        <input type="file" name="pengurus" class="form-control">
                                        @error('pengurus')
                                            <div class="text-danger mt-2"> {{ $message }} </div>
                                        @enderror
                                        @if ($osis->pengurus)
                                            <p>{{ basename($osis->pengurus) }}</p>
                                        @endif
                                    </div>
                                    <div class="col-sm-6 mb-3">
                                        <label class="form-label">Program</label>
                                        <input type="file" name="program" class="form-control">
                                        @error('program')
                                            <div class="text-danger mt-2"> {{ $message }} </div>
                                        @enderror
                                        @if ($osis->program)
                                            <p>{{ basename($osis->program) }}</p>
                                        @endif
                                    </div>
                                    <div class="col-sm-6 mb-3">
                                        <label class="form-label">Pelaksanaan & Dokumentasi</label>
                                        <input type="file" name="pelaksanaan_dan_dokumentasi" class="form-control">
                                        @error('pelaksanaan_dan_dokumentasi')
                                            <div class="text-danger mt-2"> {{ $message }} </div>
                                        @enderror
                                        @if ($osis->pelaksanaan_dan_dokumentasi)
                                            <p>{{ basename($osis->pelaksanaan_dan_dokumentasi) }}</p>
                                        @endif
                                    </div>
                                    <button type="submit" class="btn btn-primary mt-4">Update</button>

                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
