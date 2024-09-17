@extends('layouts.app')

@section('content')
<div class="py-5">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="container">
            <div class="col-12">
                <div class="mb-4">
                    <div class="col-12 row">
                        <div class="mb-4 col">
                            <a href="/sekolah-keasramaan" class="btn btn-secondary">
                                Back
                            </a>
                        </div>
                        <div class="mb-4 col d-flex justify-content-end">
                            <a href="{{ route('lab.create') }}" class="btn btn-primary">
                                Tambah
                            </a>
                        </div>
                        @if (session('success'))
                        <div class="alert alert-important alert-success alert-dismissible" role="alert">
                            <div class="d-flex">
                                <div>
                                    <!-- Download SVG icon from http://tabler-icons.io/i/check -->
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" class="icon alert-icon">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <path d="M5 12l5 5l10 -10"></path>
                                    </svg>
                                </div>
                                <div>
                                    {{ session('success') }}
                                </div>
                            </div>
                            <a class="btn-close" data-bs-dismiss="alert" aria-label="close"></a>
                        </div>
                        @endif
                    </div>
                </div>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Tanggal</th>
                            <th>Guru</th>
                            <th>Kelas</th>
                            <th>Siswa</th>
                            <th>Keterangan</th>
                            <th>Start</th>
                            <th>End</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($labs as $aksesLab)
                        <tr>
                            <td>{{ $aksesLab->tanggal }}</td>
                            <td>{{ $aksesLab->guru_id->name ?? 'N/A' }}</td>
                            <td>{{ $aksesLab->kelas_id->name ?? 'N/A' }}</td>
                            <td>{{ $aksesLab->siswa_id->name ?? 'N/A' }}</td>
                            <td>{{ $aksesLab->keterangan }}</td>
                            <td>{{ $aksesLab->start }}</td>
                            <td>{{ $aksesLab->end }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
