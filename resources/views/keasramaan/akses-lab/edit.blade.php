@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Akses Lab</h1>
    <form action="{{ route('lab.update', $aksesLab->id) }}" method="POST">
        @csrf
        @method('PUT')
        <!-- Tambahkan input fields dengan nilai default sesuai dengan data $aksesLab -->
        <div class="form-group">
            <label for="tanggal">Tanggal</label>
            <input type="date" class="form-control" id="tanggal" name="tanggal" value="{{ $aksesLab->tanggal }}" required>
        </div>
        <div class="form-group">
            <label for="guru_id">Guru</label>
            <select class="form-control" id="guru_id" name="guru_id" required>
                <!-- Isikan dengan opsi dari tabel guru dan pilih yang sesuai -->
            </select>
        </div>
        <div class="form-group">
            <label for="kelas_id">Kelas</label>
            <select class="form-control" id="kelas_id" name="kelas_id" required>
                <!-- Isikan dengan opsi dari tabel kelas dan pilih yang sesuai -->
            </select>
        </div>
        <div class="form-group">
            <label for="siswa_id">Siswa</label>
            <select class="form-control" id="siswa_id" name="siswa_id" required>
                <!-- Isikan dengan opsi dari tabel siswa dan pilih yang sesuai -->
            </select>
        </div>
        <div class="form-group">
            <label for="keterangan">Keterangan</label>
            <textarea class="form-control" id="keterangan" name="keterangan">{{ $aksesLab->keterangan }}</textarea>
        </div>
        <div class="form-group">
            <label for="start">Jam Mulai</label>
            <input type="time" class="form-control" id="start" name="start" value="{{ $aksesLab->start }}" required>
        </div>
        <div class="form-group">
            <label for="end">Jam Selesai</label>
            <input type="time" class="form-control" id="end" name="end" value="{{ $aksesLab->end }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</div>
@endsection
