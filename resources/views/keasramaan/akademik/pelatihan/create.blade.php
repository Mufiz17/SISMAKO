@extends('layouts.app')

@section('content')
    <div class="py-5">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="col container">
                <div class="row row-cards">
                    <div class="col-12">
                        <div class="mb-4 col">
                            <a href="/sekolah-keasramaan/akademik/pelatihan" class="btn btn-secondary">
                                Back
                            </a>
                        </div>
                        <form class="card" action="{{ route('pelatihan.store') }}" method="POST"
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
                                                autocomplete='off'>
                                            @error('tanggal')
                                                <div class="text-danger mt-2"> {{ $message }} </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-4 col-md-4">
                                        <div class="mb-3">
                                            <label class="form-label">Angkatan</label>
                                            <select class="form-control" name="angkatan" id="angkatan-select">
                                                <option value="">Pilih Angkatan</option>
                                                @foreach ($angkatan as $data)
                                                    <option value="{{ $data }}"
                                                        {{ old('angkatan') == $data ? 'selected' : '' }}>
                                                        {{ $data }}</option>
                                                @endforeach
                                            </select>
                                            @error('angkatan')
                                                <div class="text-danger mt-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <!-- Nama Filter -->
                                    <div class="col-sm-4 col-md-4">
                                        <div class="mb-3">
                                            <label class="form-label">Nama</label>
                                            <select class="form-control" name="siswa_id" id="nama-select">
                                                <option value="">-- Pilih Nama --</option>
                                                <!-- Options will be populated dynamically -->
                                            </select>
                                            @error('siswa_id')
                                                <div class="text-danger mt-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-4 col-md-4">
                                        <div class="mb-3">
                                            <label for="kegiatan" class="form-label">Nama Kegiatan</label>
                                            <input type="text"
                                                class="form-control @error('kegiatan') is-invalid @enderror"
                                                id="kegiatan" name="kegiatan" placeholder="Masukan Nama Kegiatan"
                                                value="{{ old('kegiatan') }}">
                                            @error('kegiatan')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-12">
                                        <div class="mb-3">
                                            <label for="keterangan" class="form-label">Keterangan</label>
                                            <textarea class="form-control @error('keterangan') is-invalid @enderror" id="keterangan" name="keterangan"
                                                placeholder="Masukan Keterangan">{{ old('keterangan') }}</textarea>
                                            @error('keterangan')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-6">
                                        <div class="mb-3">
                                            <label for="dokumentasi" class="form-label">Dokumentasi</label>
                                            <input type="file"
                                                class="form-control @error('dokumentasi') is-invalid @enderror"
                                                id="dokumentasi" name="dokumentasi[]" multiple>
                                            @error('dokumentasi')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-6">
                                        <div class="mb-3">
                                            <label for="undangan" class="form-label">Undangan/Surat</label>
                                            <input type="file"
                                                class="form-control @error('undangan') is-invalid @enderror"
                                                id="undangan" name="undangan[]" multiple>
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
    <script>
        document.getElementById('angkatan-select').addEventListener('change', function() {
            const angkatan = this.value;
            const namesSelect = document.getElementById('nama-select');
            namesSelect.innerHTML = '<option value="">-- Pilih Nama --</option>';

            // Fetch the student names based on the selected angkatan
            fetch(`/api/siswa?angkatan=${angkatan}`)
                .then(response => response.json())
                .then(data => {
                    data.forEach(data => {
                        const option = document.createElement('option');
                        option.value = data.id;
                        console.log(data)
                        option.textContent = data.siswa.nama;
                        namesSelect.appendChild(option);
                    });
                })
                .catch(error => console.error('Error fetching names:', error));
        });
    </script>
@endsection
