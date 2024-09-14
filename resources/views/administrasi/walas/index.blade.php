@extends('layouts.app')

@section('content')
    <div class="px-5 py-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="d-flex justify-content-between p-4">
                <div>
                    <a href="/administrasi" class="btn btn-primary">Kembali</a>
                </div>
                <div>
                    <a href="{{ route('walas.create') }}" class="btn btn-primary">Tambah</a>
                </div>
            </div>
            <div class="d-flex justify-content-center mb-3">
                <a href="{{ route('walas.index') }}" class="btn btn-secondary">Reset Filters</a>
            </div>
            <form method="GET" action="{{ route('walas.index') }}" class="mb-3">
                <div class="row justify-content-center">
                    <div class="col-lg-3 col-md-4 col-sm-6 mb-3">
                        <div class="form-group">
                            <label for="tahun_ajaran">Tahun Ajaran:</label>
                            <select id="tahun_ajaran" name="tahun_ajaran" class="form-control"
                                onchange="this.form.submit()">
                                <option value="">Semua</option>
                                @foreach ($tahunAjaranOptions as $option)
                                    <option value="{{ $option }}"
                                        {{ $tahunAjaranFilter == $option ? 'selected' : '' }}>
                                        {{ $option }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </form>
            <div class="col">
                <div class="row row-cards">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h3 class="card-title">Daftar Wali Kelas</h3>
                            </div>
                            <div class="table-responsive">
                                <table class="table card-table table-vcenter text-nowrap text-center">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Tahun Ajaran</th>
                                            <th>Penyerahan Rapor</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($walas as $item)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $item->tahun_ajaran }}</td>
                                                <td>{{ Str::limit($item->penyerahan_rapor, 10, '...') }}</td>
                                                <td>
                                                    <a href="{{ route('walas.downloadFile', $item->id) }}">
                                                        <i
                                                            class="fas fa-download text-white text-xl bg-blue p-2 rounded-lg"></i>
                                                    </a>
                                                    <a href="{{ route('walas.edit', $item->id) }}">
                                                        <i
                                                            class="fa-regular fa-pen-to-square text-white text-xl bg-yellow p-2 rounded-lg"></i>
                                                    </a>
                                                    <form action="{{ route('walas.destroy', $item->id) }}" method="POST"
                                                        style="display: inline-block;">
                                                        @csrf
                                                        @method('DELETE')

                                                        <button type="button"
                                                            class="far fa-trash-alt text-white text-xl bg-red p-2 rounded-lg"
                                                            data-bs-toggle="modal" data-bs-target="#modal-danger"></button>

                                                        <!-- Modal -->
                                                        <div class="modal modal-blur fade" id="modal-danger" tabindex="-1"
                                                            role="dialog" aria-hidden="true">
                                                            <div class="modal-dialog modal-sm modal-dialog-centered"
                                                                role="document">
                                                                <div class="modal-content">
                                                                    <button type="button" class="btn-close"
                                                                        data-bs-dismiss="modal" aria-label="Close"></button>
                                                                    <div class="modal-status bg-danger"></div>
                                                                    <div class="modal-body text-center py-4">
                                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                                            class="icon mb-2 text-danger icon-lg"
                                                                            width="24" height="24"
                                                                            viewBox="0 0 24 24" stroke-width="2"
                                                                            stroke="currentColor" fill="none"
                                                                            stroke-linecap="round" stroke-linejoin="round">
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
                                                                                    <button type="button" class="btn w-100"
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
                                {{ $walas->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
