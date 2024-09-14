@extends('layouts.app')

@section('content')
    <div class="px-5 py-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="col">
                <div class="row row-cards">
                    <div class="col-12">
                        <div class="mb-4 col">
                            <a href="{{ route('supervisi.index') }}" class="btn btn-secondary">
                                Kembali
                            </a>
                        </div>
                        <h1 class="card-title text-center">Edit Data Wali Kelas</h1>
                        <form action="{{ route('supervisi.update', $supervisi->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label class="form-label">Tahun Ajaran</label>
                                <select class="form-control form-select" name="tahun_ajaran">
                                    <option value="">Pilih Tahun Ajaran</option>
                                    @foreach (generateTahunAjaran() as $tahun)
                                        <option value="{{ $tahun }}"
                                            {{ $supervisi->tahun_ajaran == $tahun ? 'selected' : '' }}>{{ $tahun }}
                                        </option>
                                    @endforeach

                                </select>
                                @error('tahun_ajaran')
                                    <div class="text-danger mt-2"> {{ $message }} </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Nama Guru</label>
                                <input type="text" name="nama_guru" value="{{ $supervisi->nama_guru }}"
                                    class="form-control">
                                @error('nama_guru')
                                    <div class="text-danger mt-2"> {{ $message }} </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Kelas</label>
                                <input type="text" name="kelas" value="{{ $supervisi->kelas }}" class="form-control">
                                @error('kelas')
                                    <div class="text-danger mt-2"> {{ $message }} </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Mapel</label>
                                <input type="text" name="mapel" value="{{ $supervisi->mapel }}" class="form-control">
                                @error('mapel')
                                    <div class="text-danger mt-2"> {{ $message }} </div>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
