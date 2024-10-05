@extends('layouts.app')

@section('content')
    <div class="py-5">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="row row-cards">
                <div class="col-12 container">
                    <div class="mb-4">
                        <a href="/sekolah-keasramaan/akademik/lomba" class="btn btn-secondary">
                            Back
                        </a>
                    </div>
                    <form class="card" action="{{ route('lomba.update', $lomba->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="card-body">
                            <h3 class="card-title">Edit Data Siswa</h3>
                            <div class="row row-cards">
                                <div class="col-sm-6 col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Tanggal</label>
                                        <input type='date' class="form-control datepicker"
                                            placeholder="Masukan Tanggal" id="datepicker-icon-1" name="tanggal"
                                            autocomplete='off' value="{{ old('tanggal', $lomba->tanggal) }}">
                                        @error('tanggal')
                                            <div class="text-danger mt-2"> {{ $message }} </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-6">
                                    <div class="mb-3">
                                        <label for="kegiatan" class="form-label">Nama Kegiatan</label>
                                        <input type="text"
                                            class="form-control @error('kegiatan') is-invalid @enderror" id="kegiatan"
                                            name="kegiatan" placeholder="Masukan Nama Kegiatan"
                                            value="{{ old('kegiatan', $lomba->kegiatan) }}">
                                        @error('kegiatan')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-12">
                                    <div class="mb-3">
                                        <label for="keterangan" class="form-label">Keterangan</label>
                                        <textarea class="form-control @error('keterangan') is-invalid @enderror" id="keterangan" name="keterangan"
                                            placeholder="Masukan Keterangan">{{ old('keterangan', $lomba->keterangan) }}</textarea>
                                        @error('keterangan')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-6">
                                    <div class="mb-3">
                                        <label for="keterangan" class="form-label">Dokumentasi</label>
                                        <input type="file" multiple
                                            class="form-control @error('kegiatan') is-invalid @enderror" id="kegiatan"
                                            name="dokumentasi[]" placeholder="Masukan Nama Kegiatan"
                                            >
                                        @error('dokumentasi')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-6">
                                    <div class="mb-3">
                                        <label for="keterangan" class="form-label">Undangan</label>
                                        <input type="file" multiple
                                            class="form-control @error('kegiatan') is-invalid @enderror" id="kegiatan"
                                            name="undangan[]" placeholder="Masukan Nama Kegiatan"
                                            >
                                        @error('undangan')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer text-end">
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @include('database.js.setFilePelatihanAkademik')
    <script>
            const pelatihanData = @json($lomba);

        getData(pelatihanData);
    </script>
@endsection
