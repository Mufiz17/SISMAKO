@extends('layouts.app')

@section('content')
    <div class="py-12 px-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="d-flex justify-content-between p-4">
                <div>
                    <a href="/administrasi" class="btn btn-primary">Kembali</a>
                </div>
                <div>
                    <a href="{{ route('waka_kurikulum.create') }}" class="btn btn-primary">Tambah</a>
                </div>
            </div>
            <div class="d-flex justify-content-center mb-3">
                <a href="{{ route('waka_kurikulum.index') }}" class="btn btn-secondary">Reset Filters</a>
            </div>
            <form method="GET" action="{{ route('waka_kurikulum.index') }}" class="mb-3">
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
                <div class="row row-card">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h3 class="card-title">Daftar Waka Kurikulum</h3>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table card-table table-vcenter text-nowrap">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Tahun Ajaran</th>
                                                <th>Nomor Bimbingan</th>
                                                <th>Waktu Bimbingan</th>
                                                <th>Nama Bimbingan</th>
                                                <th>Kekurangan Bimbingan</th>
                                                <th>Bentuk Bimbingan</th>
                                                <th>Hasil Bimbingan</th>
                                                <th>Keterangan Bimbingan</th>
                                                <th>Nomor Capaian</th>
                                                <th>Mapel Capaian</th>
                                                <th>Guru Capaian</th>
                                                <th>Target Pencapaian Materi</th>
                                                <th>Realisasi Capaian</th>
                                                <th>Kendala Capaian</th>
                                                <th>Solusi Capaian</th>
                                                <th>Keterangan Capaian</th>
                                                <th>kelas 10</th>
                                                <th>kelas 11</th>
                                                <th>kelas 12</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($wakaKurikulum as $key => $data)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $data->tahun_ajaran }}</td>
                                                    <td>{{ $data->nomor_bimbingan }}</td>
                                                    <td>{{ $data->waktu_bimbingan }}</td>
                                                    <td>{{ $data->nama_bimbingan }}</td>
                                                    <td>{{ Str::limit($data->kekurangan_bimbingan, 10, '...') }}</td>
                                                    <td>{{ Str::limit($data->bentuk_bimbingan, 10, '...') }}</td>
                                                    <td>{{ Str::limit($data->hasil_bimbingan, 10, '...') }}</td>
                                                    <td>{{ Str::limit($data->keterangan_bimbingan, 10, '...') }}</td>
                                                    <td>{{ $data->nomor_capaian }}</td>
                                                    <td>{{ $data->mapel_capaian }}</td>
                                                    <td>{{ $data->guru_capaian }}</td>
                                                    <td>{{ Str::limit($data->target_pencapaian_materi, 10, '...') }}
                                                    </td>
                                                    <td>{{ Str::limit($data->realisasi_pencapaian, 10, '...') }}</td>
                                                    <td>{{ Str::limit($data->kendala, 10, '...') }}</td>
                                                    <td>{{ Str::limit($data->solusi, 10, '...') }}</td>
                                                    <td>{{ Str::limit($data->keterangan_capaian, 10, '...') }}</td>
                                                    <td>{{ Str::limit($data->kelas_10, 10, '...') }}</td>
                                                    <td>{{ Str::limit($data->kelas_11, 10, '...') }}</td>
                                                    <td>{{ Str::limit($data->kelas_12, 10, '...') }}</td>
                                                    <td>
                                                        <a href="{{ route('waka_kurikulum.downloadFile', $data->id) }}">
                                                            <i
                                                                class="fas fa-download text-white text-xl bg-blue p-2 rounded-lg"></i>
                                                        </a>
                                                        <a href="{{ route('waka_kurikulum.exportPDF', $data->id) }}">
                                                            <i
                                                                class="fas fa-file-export text-white text-xl bg-green p-2 rounded-lg"></i>
                                                        </a>
                                                        <a href="{{ route('waka_kurikulum.edit', $data->id) }}">
                                                            <i
                                                                class="fa-regular fa-pen-to-square text-white text-xl bg-yellow p-2 rounded-lg"></i>
                                                        </a>
                                                        <form action="{{ route('waka_kurikulum.destroy', $data->id) }}"
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
                                            @empty
                                                <tr>
                                                    <td colspan="19" class="text-center">No data available</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="card-footer">
                                {{ $wakaKurikulum->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if (session('success'))
        <div class="alert alert-success alert-dismissible position-absolute bottom-0 end-0 me-3" role="alert"
            id="alertSuccess">
            <div class="d-flex">
                <div>
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon alert-icon" width="24" height="24"
                        viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                        stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                        <path d="M5 12l5 5l10 -10"></path>
                    </svg>
                </div>
                <div>
                    {{ session('success') }}
                </div>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="close"
                onclick="disabledAlert()" style="cursor: pointer;"></button>
        </div>
    @endif
    <script>
        function disabledAlert() {
            document.getElementById('alertSuccess').style.display = 'none';
        }
    </script>
@endsection
