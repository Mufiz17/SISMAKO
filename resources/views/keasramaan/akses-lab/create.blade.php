@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Tambah Akses Lab</h1>
        <form action="{{ route('lab.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="tanggal">Tanggal</label>
                <input type="date" class="form-control" id="tanggal" name="tanggal" required>
            </div>
            <div class="form-group">
                <label for="guru_id">Guru</label>
                <select class="form-control" id="guru_id" name="guru_id" required>
                    <option value="" selected>Pilih Nama Guru</option>
                    @foreach ($guru as $item)
                        <option value="{{ $item->id }}">{{ $item->nama }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="kelas_id">Kelas</label>
                <select class="form-control" id="kelas_id" name="kelas_id" required>
                    <option value="" selected>Pilih Kelas</option>
                    <option value="X">X</option>
                    <option value="XI">XI</option>
                    <option value="XII" >XII</option>
                </select>
            </div>
            <div class="form-group">
                <label for="siswa_id">Siswa</label>
                <select class="form-control" id="siswa_id" name="siswa_id" required>
                </select>
            </div>
            <div class="form-group">
                <label for="keterangan">Keterangan</label>
                <textarea class="form-control" id="keterangan" name="keterangan"></textarea>
            </div>
            <div class="form-group">
                <label for="start">Jam Mulai</label>
                <input type="time" class="form-control" id="start" name="start" required>
            </div>
            <div class="form-group">
                <label for="end">Jam Selesai</label>
                <input type="time" class="form-control" id="end" name="end" required>
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
    </div>
    <script>
document.addEventListener('DOMContentLoaded', function () {
    const kelasSelect = document.getElementById('kelas_id');
    if (kelasSelect) {
        kelasSelect.addEventListener('change', function() {
            const angkatan = this.value;
            const namesSelect = document.getElementById('siswa_id');
            namesSelect.innerHTML = '<option value="">-- Pilih Nama --</option>';

            // Fetch the student names based on the selected angkatan
            fetch(`/api/siswa/kelas?kelas=${angkatan}`)
                .then(response => response.json())
                .then(data => {
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
