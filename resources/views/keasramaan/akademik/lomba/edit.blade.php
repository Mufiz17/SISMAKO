@extends('layouts.app')

@section('content')

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="col">
                <div class="row row-cards">
                    <div class="col-12">
                        <div class="mb-4 col">
                            <a href="/sekolah-keasramaan/akademik/lomba" class="btn btn-secondary">
                                Back
                            </a>
                        </div>
                        <form class="card" action="{{ route('lomba.store') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <h3 class="card-title">Data Siswa</h3>
                                <div class="row row-cards">
                                    <div class="col-sm-4 col-md-4">
                                        <div class="mb-3">
                                            <label class="form-label">Tanggal</label>
                                            <input type='date' class="form-control datepicker"
                                                placeholder="Masukan Tanggal" id="datepicker-icon-1" name="tanggal"
                                                autocomplete='off' value="{{old('tanggal', $lomba->tanggal)}}">
                                            @error('tanggal')
                                                <div class="text-danger mt-2"> {{ $message }} </div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-sm-4 col-md-4">
                                        <div class="mb-3">
                                            <label class="form-label">Nama Kegiatan</label>
                                            <input type="text"
                                                class="form-control @error('kegiatan') is-invalid @enderror"
                                                placeholder="Masukan Nama Kegiatan" name="kegiatan"
                                                value="{{ old('kegiatan', $lomba->kegiatan) }}">
                                            @error('kegiatan')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-12">
                                        <div class="mb-3">
                                            <label class="form-label">Keterangan</label>
                                            <textarea class="form-control @error('keterangan') is-invalid @enderror" placeholder="Masukan Keterangan"
                                                name="keterangan">{{ old('keterangan', $lomba->keterangan) }}</textarea>
                                            @error('keterangan')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Dokumentasi</label>
                                            <input type="file"
                                                class="form-control @error('dokumentasi') is-invalid @enderror"
                                                name="dokumentasi[]" multiple>
                                            @error('dokumentasi')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Undangan/Surat</label>
                                            <input type="file"
                                                class="form-control @error('undangan') is-invalid @enderror"
                                                name="undangan[]" multiple>
                                            @error('undangan')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer text-end">
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('js.setFilePelatihanAkademik')
    <script>
        const data = @json($lomba);
        getData(data);
    </script>
@endsection