@extends('layouts.app')

@section('content')
    <div class="px-5 py-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="col">
                <div class="row row-cards">
                    <div class="col-12">
                        <div class="mb-4 col">
                            <a href="{{ route('kepalaLabKom.index') }}" class="btn btn-secondary">
                                Kembali
                            </a>
                        </div>
                        <form action="{{ route('kepalaLabKom.update', $kepalaLabKom->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="card p-3">
                                <h3 class="card-title text-center">Edit Data Kepala Lab. Komputer</h3>
                                <div class="row">
                                    <div class="mb-3">
                                        <label class="form-label">Tahun Ajaran</label>
                                        <select class="form-control form-select" name="tahun_ajaran">
                                            <option value="">Pilih Tahun Ajaran</option>
                                            @foreach (generateTahunAjaran() as $tahun)
                                                <option value="{{ $tahun }}"
                                                    {{ $kepalaLabKom->tahun_ajaran == $tahun ? 'selected' : '' }}>
                                                    {{ $tahun }}</option>
                                            @endforeach
                                        </select>
                                        @error('tahun_ajaran')
                                            <div class="text-danger mt-2"> {{ $message }} </div>
                                        @enderror
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="mb-3">
                                            <label class="form-label">Tatib</label>
                                            <input type="file" name="tatib_lab" class="form-control">
                                            @error('tatib_lab')
                                                <div class="text-danger mt-2"> {{ $message }} </div>
                                            @enderror
                                            @if ($kepalaLabKom->tatib_lab)
                                                <p>{{ basename($kepalaLabKom->tatib_lab) }}</p>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-sm-6 mb-3">
                                        <label class="form-label">Denah</label>
                                        <input type="file" name="denah_lab" class="form-control">
                                        @error('denah_lab')
                                            <div class="text-danger mt-2"> {{ $message }} </div>
                                        @enderror
                                        @if ($kepalaLabKom->denah_lab)
                                            <p>{{ basename($kepalaLabKom->denah_lab) }}</p>
                                        @endif
                                    </div>
                                    <div class="col-sm-6 mb-3">
                                        <label class="form-label">Data Lab</label>
                                        <input type="file" name="data_lab" class="form-control">
                                        @error('data_lab')
                                            <div class="text-danger mt-2"> {{ $message }} </div>
                                        @enderror
                                        @if ($kepalaLabKom->data_lab)
                                            <p>{{ basename($kepalaLabKom->data_lab) }}</p>
                                        @endif
                                    </div>
                                    <div class="col-sm-6 mb-3">
                                        <label class="form-label">Data Pengguna</label>
                                        <input type="file" name="data_pengguna" class="form-control">
                                        @error('data_pengguna')
                                            <div class="text-danger mt-2"> {{ $message }} </div>
                                        @enderror
                                        @if ($kepalaLabKom->data_pengguna)
                                            <p>{{ basename($kepalaLabKom->data_pengguna) }}</p>
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
