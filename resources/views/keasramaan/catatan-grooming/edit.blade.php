@extends('layouts.app')

@section('content')
    <div class="py-5">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="col container">
                <div class="row row-cards">
                    <div class="col-12">
                        <div class="mb-4 col">
                            <a href="{{ route('catatan.grooming.index') }}" class="btn btn-secondary">Back</a>
                        </div>
                        <form class="card" action="{{ route('catatan.grooming.update', $data->id) }}" method="POST" enctype="multipart/form-data">
                            @method('PUT')
                            @csrf
                            <div class="card-body">
                                <h3 class="card-title">Catatan Grooming</h3>
                                <div class="row row-cards">
                                    <div class="col-sm-4 col-md-4">
                                        <div class="mb-3">
                                            <label class="form-label">Tanggal</label>
                                            <input type='date' class="form-control datepicker"
                                                placeholder="Masukan Tanggal" id="datepicker-icon-1" name="tanggal"
                                                autocomplete='off'
                                                value="{{ old('tanggal', $data->tanggal) }}">
                                            @error('tanggal')
                                                <div class="text-danger mt-2"> {{ $message }} </div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-sm-4 col-md-4">
                                        <div class="mb-3">
                                            <label class="form-label">Kelas</label>
                                            <select class="form-control" id="kelas_id" name="kelas_id">
                                                <option value="">Pilih Kelas</option>
                                                <option value="X" {{ $data->siswa->dataKelas[0]->kelas == 'X' ? 'selected' : '' }}>X</option>
                                                <option value="XI" {{ $data->siswa->dataKelas[0]->kelas == 'XI' ? 'selected' : '' }}>XI</option>
                                                <option value="XII" {{ $data->siswa->dataKelas[0]->kelas == 'XII' ? 'selected' : '' }}>XII</option>
                                            </select>
                                            @error('kelas_id')
                                                <div class="text-danger mt-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-4 col-md-4">
                                        <div class="mb-3">
                                            <label class="form-label">Nama Siswa</label>
                                            <select class="form-control" id="siswa_id" name="siswa_id" required>
                                                <option value="{{$data->siswa_id}}">{{$data->siswa->nama}}</option>
                                            </select>
                                            @error('siswa_id')
                                                <div class="text-danger mt-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-4 col-md-4">
                                        <div class="mb-3">
                                            <label class="form-label">Guru Piket</label>
                                            <select class="form-control" name="guru_piket_id" id="guru_id">
                                                <option value="">Pilih Nama Guru</option>
                                                @foreach ($guru as $item)
                                                    <option value="{{ $item->id }}" {{ $data->guru_piket_id == $item->id ? 'selected' : '' }}>{{ $item->nama }}</option>
                                                @endforeach
                                            </select>
                                            @error('guru_piket_id')
                                                <div class="text-danger mt-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-12">
                                        <div class="mb-3">
                                            <label for="keterangan" class="form-label">Catatan</label>
                                            <textarea class="form-control @error('keterangan') is-invalid @enderror" id="keterangan" name="catatan"
                                                placeholder="Masukan catatan">{{ old('catatan', $data->catatan) }}</textarea>
                                            @error('catatan')
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
        document.addEventListener('DOMContentLoaded', function() {
            const kelasSelect = document.getElementById('kelas_id');
            const namesSelect = document.getElementById('siswa_id');

            if (kelasSelect && namesSelect) {
                kelasSelect.addEventListener('change', function() {
                    const angkatan = this.value;

                    // Kosongkan opsi dalam select siswa sebelum menambah data baru
                    namesSelect.innerHTML = '<option value="">Pilih Nama Siswa</option>';

                    fetch(`/api/siswa/kelas?kelas=${angkatan}`)
                        .then(response => response.json())
                        .then(data => {
                            console.log(data);
                            data.forEach(siswa => {
                                const option = document.createElement('option');
                                option.value = siswa.id_siswa;
                                option.textContent = siswa.siswa.nama;
                                namesSelect.appendChild(option);
                            });
                        })
                        .catch(error => console.error('Error fetching names:', error));
                });
            }
        });
    </script>
@endsection
