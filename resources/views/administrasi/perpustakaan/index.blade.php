@extends('layouts.app')

@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex justify-between p-4">
                <a href="/administrasi" class="btn btn-primary">
                    Back
                </a>
                <a href="{{ route('perpustakaan.create') }}" class="btn btn-primary">
                    Add Data Perpustakaan
                </a>
            </div>
            <div class="col flex flex-wrap justify-center">
                <a href="{{ route('perpustakaan.index') }}" class="btn btn-secondary mb-3">Reset Filters</a>
            </div>
            <form method="GET" action="{{ route('perpustakaan.index') }}"
                class="mb-3 flex flex-wrap justify-center gap-4">
                <div class="col-lg-3">
                    <div class="form-group">
                        <label for="tahun_ajaran">Tahun Ajaran:</label>
                        <select id="tahun_ajaran" name="tahun_ajaran" class="form-control"
                            onchange="this.form.submit()">
                            <option value="">Semua</option>
                            @foreach ($tahunAjaranOptions as $option)
                                <option value="{{ $option }}"
                                    {{ $tahunAjaranFilter == $option ? 'selected' : '' }}>{{ $option }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </form>
            <div class="col">
                <div class="row row-cards">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h3 class="card-title">Daftar Perpustakaan</h3>
                            </div>
                            <div class="table-responsive">
                                <table class="table card-table table-vcenter text-nowrap">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Tahun Ajaran</th>
                                            <th>Tatib</th>
                                            <th>Denah</th>
                                            <th>Daftar Buku</th>
                                            <th>Proker</th>
                                            <th>Struktur</th>
                                            <th>Surat Keputusan</th>
                                            <th>Daftar Pengunjung</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($perpustakaan as $item)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $item->tahun_ajaran }}</td>
                                                <td>{{ Str::limit($item->tatib_perpustakaan, 10, '...') }}</td>
                                                <td>{{ Str::limit($item->denah_perpustakaan, 10, '...') }}</td>
                                                <td>{{ Str::limit($item->daftar_buku, 10, '...') }}</td>
                                                <td>{{ Str::limit($item->proker_perpus, 10, '...') }}</td>
                                                <td>{{ Str::limit($item->struktur, 10, '...') }}</td>
                                                <td>{{ Str::limit($item->sk, 10, '...') }}</td>
                                                <td>{{ Str::limit($item->daftar_pengunjung, 10, '...') }}</td>
                                                <td>
                                                    <a href="{{ route('perpustakaan.download', $item->id) }}">
                                                        <i
                                                            class="fas fa-download text-white text-xl bg-blue p-2 rounded-lg"></i>
                                                    </a>
                                                    <a href="{{ route('perpustakaan.edit', $item->id) }}">
                                                        <i
                                                        class="fa-regular fa-pen-to-square text-white text-xl bg-yellow p-2 rounded-lg"></i>
                                                    </a>
                                                    <form action="{{ route('perpustakaan.destroy', $item->id) }}"
                                                        method="POST" style="display: inline-block;">
                                                        @csrf
                                                        @method('DELETE')

                                                        <button type="button"
                                                            class="far fa-trash-alt text-white text-xl bg-red p-2 rounded-lg"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#modal-danger"></button>

                                                        <!-- Modal -->
                                                        <div class="modal modal-blur fade" id="modal-danger"
                                                            tabindex="-1" role="dialog" aria-hidden="true">
                                                            <div class="modal-dialog modal-sm modal-dialog-centered"
                                                                role="document">
                                                                <div class="modal-content">
                                                                    <button type="button" class="btn-close"
                                                                        data-bs-dismiss="modal"
                                                                        aria-label="Close"></button>
                                                                    <div class="modal-status bg-danger"></div>
                                                                    <div class="modal-body text-center py-4">
                                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                                            class="icon mb-2 text-danger icon-lg"
                                                                            width="24" height="24"
                                                                            viewBox="0 0 24 24" stroke-width="2"
                                                                            stroke="currentColor" fill="none"
                                                                            stroke-linecap="round"
                                                                            stroke-linejoin="round">
                                                                            <path stroke="none" d="M0 0h24v24H0z"
                                                                                fill="none"></path>
                                                                            <path d="M12 9v4"></path>
                                                                            <path
                                                                                d="M10.363 3.591l-8.106 13.534a1.914 1.914 0 0 0 1.636 2.871h16.214a1.914 1.914 0 0 0 1.636 -2.87l-8.106 -13.536a1.914 1.914 0 0 0 -3.274 0z">
                                                                            </path>
                                                                            <path d="M12 16h.01"></path>
                                                                        </svg>
                                                                        <h3>Are you sure?</h3>
                                                                        <div class="text-secondary text-wrap"
                                                                            style="word-wrap: break-word; overflow-wrap: break-word;">
                                                                            Do you really want to remove this file? This
                                                                            action cannot be undone.
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <div class="w-100">
                                                                            <div class="row">
                                                                                <div class="col">
                                                                                    <button type="button"
                                                                                        class="btn w-100"
                                                                                        data-bs-dismiss="modal">Cancel</button>
                                                                                </div>
                                                                                <div class="col">
                                                                                    <button type="submit"
                                                                                        class="btn btn-danger w-100">Delete</button>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="card-footer">
                                {{ $perpustakaan->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection