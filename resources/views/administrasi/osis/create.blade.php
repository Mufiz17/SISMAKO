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
                        <form action="{{ route('osis.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="card p-3">
                                <h1 class="card-title text-center mb-4">Tambah Data Osis</h1>
                                <div class="row">
                                    <div class="mb-3">
                                        <label class="form-label">Tahun Ajaran</label>
                                        <select class="form-control form-select" name="tahun_ajaran">
                                            <option value="">Pilih Tahun Ajaran</option>
                                            <option value="2024-2025">2024-2025</option>
                                            <option value="2025-2026">2025-2026</option>
                                            <option value="2026-2027">2026-2027</option>
                                            <option value="2027-2028">2027-2028</option>
                                            <option value="2028-2029">2028-2029</option>
                                            <option value="2029-2030">2029-2030</option>
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
                                    </div>
                                    <div class="col-sm-6 mb-3">
                                        <label class="form-label">Pengurus</label>
                                        <input type="file" name="pengurus" class="form-control">
                                        @error('pengurus')
                                            <div class="text-danger mt-2"> {{ $message }} </div>
                                        @enderror
                                    </div>
                                    <div class="col-sm-6 mb-3">
                                        <label class="form-label">Program</label>
                                        <input type="file" name="program" class="form-control">
                                        @error('program')
                                            <div class="text-danger mt-2"> {{ $message }} </div>
                                        @enderror
                                    </div>
                                    <div class="col-sm-6 mb-3">
                                        <label class="form-label">Pelaksanaan & Dokumentasi</label>
                                        <input type="file" name="pelaksanaan_dan_dokumentasi" class="form-control">
                                        @error('pelaksanaan_dan_dokumentasi')
                                            <div class="text-danger mt-2"> {{ $message }} </div>
                                        @enderror
                                    </div>
                                    <button type="submit" class="btn btn-primary mt-4">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
