@extends('layouts.app')

@section('content')
    <div class="px-5 py-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="d-flex justify-content-between p-4">
                <div>
                    <a href="/administrasi" class="btn btn-primary">Kembali</a>
                </div>
                <div>
                    <a href="{{ route('mapel.create') }}" class="btn btn-primary">Tambah</a>
                </div>
            </div>
            <div class="d-flex justify-content-center mb-3">
                <a href="{{ route('mapel.index') }}" class="btn btn-secondary">Reset Filters</a>
            </div>
            <form method="GET" action="{{ route('mapel.index') }}" class="mb-3">
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
                    <div class="col-lg-3 col-md-4 col-sm-6 mb-3">
                        <div class="form-group">
                            <label for="kelas">Kelas:</label>
                            <select id="kelas" name="kelas" class="form-control" onchange="this.form.submit()">
                                <option value="">Semua</option>
                                @foreach ($kelasOptions as $option)
                                    <option value="{{ $option }}" {{ $kelasFilter == $option ? 'selected' : '' }}>
                                        {{ $option }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-4 col-sm-6 mb-3">
                        <div class="form-group">
                            <label for="mapel">Mapel:</label>
                            <select id="mapel" name="mapel" class="form-control" onchange="this.form.submit()">
                                <option value="">Semua</option>
                                @foreach ($mapelOptions as $option)
                                    <option value="{{ $option }}" {{ $mapelFilter == $option ? 'selected' : '' }}>
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
                                <h1 class="card-title">Daftar Mata Pelajaran</h1>
                            </div>
                            <div class="table-responsive">
                                <table class="table card-table table-vcenter text-nowrap text-center">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Tahun Ajaran</th>
                                            <th>Kelas</th>
                                            <th>Mapel</th>
                                            <th>PKG</th>
                                            <th>Kategori Kurikulum</th>
                                            <th>Silabus</th>
                                            <th>KI KD & SKL</th>
                                            <th>Kode Etik</th>
                                            <th>Program Semester</th>
                                            <th>Program Tahunan</th>
                                            <th>Kaldik Sekolah</th>
                                            <th>JAK</th>
                                            <th>Analisi Waktu</th>
                                            <th>Daftar Hadir Siswa</th>
                                            <th>Jadwal Pelajaran</th>
                                            <th>Kisi-kisi, Soal, Kartu Soal</th>
                                            <th>RPP 1</th>
                                            <th>Pendukung RPP 1</th>
                                            <th>RPP 2</th>
                                            <th>Pendukung RPP 2</th>
                                            <th>RPP 3</th>
                                            <th>Pendukung RPP 3</th>
                                            <th>RPP 4</th>
                                            <th>Pendukung RPP 4</th>
                                            <th>RPP 5</th>
                                            <th>Pendukung RPP 5</th>
                                            <th>RPP 6</th>
                                            <th>Pendukung RPP 6</th>
                                            <th>RPP 7</th>
                                            <th>Pendukung RPP 7</th>
                                            <th>RPP 8</th>
                                            <th>Pendukung RPP 8</th>
                                            <th>RPP 9</th>
                                            <th>Pendukung RPP 9</th>
                                            <th>RPP 10</th>
                                            <th>Pendukung RPP 10</th>
                                            <th>RPP 11</th>
                                            <th>Pendukung RPP 11</th>
                                            <th>RPP 12</th>
                                            <th>Pendukung RPP 12</th>
                                            <th>RPP 13</th>
                                            <th>Pendukung RPP 13</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($mapels as $item)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $item->tahun_ajaran }}</td>
                                                <td>{{ $item->kelas }}</td>
                                                <td>{{ $item->mapel }}</td>
                                                <td>{{ $item->kategori_kurikulum }}</td>
                                                <td>{{ Str::limit($item->pkg, 10, '...') }}</td>
                                                <td>{{ Str::limit($item->silabus, 10, '...') }}</td>
                                                <td>{{ Str::limit($item->ki_kd_skl, 10, '...') }}</td>
                                                <td>{{ Str::limit($item->kode_etik, 10, '...') }}</td>
                                                <td>{{ Str::limit($item->program_semester, 10, '...') }}</td>
                                                <td>{{ Str::limit($item->program_tahunan, 10, '...') }}</td>
                                                <td>{{ Str::limit($item->kaldik_sekolah, 10, '...') }}</td>
                                                <td>{{ Str::limit($item->jak, 10, '...') }}</td>
                                                <td>{{ Str::limit($item->analisi_waktu, 10, '...') }}</td>
                                                <td>{{ Str::limit($item->daftar_hadir_siswa, 10, '...') }}</td>
                                                <td>{{ Str::limit($item->jadwal_pelajaran, 10, '...') }}</td>
                                                <td>{{ Str::limit($item->kisi_kisi_soal_kartu_soal, 10, '...') }}</td>
                                                <td>{{ Str::limit($item->rpp_1, 10, '...') }}</td>
                                                <td>{{ Str::limit($item->pendukung_rpp_1, 10, '...') }}</td>
                                                <td>{{ Str::limit($item->rpp_2, 10, '...') }}</td>
                                                <td>{{ Str::limit($item->pendukung_rpp_2, 10, '...') }}</td>
                                                <td>{{ Str::limit($item->rpp_3, 10, '...') }}</td>
                                                <td>{{ Str::limit($item->pendukung_rpp_3, 10, '...') }}</td>
                                                <td>{{ Str::limit($item->rpp_4, 10, '...') }}</td>
                                                <td>{{ Str::limit($item->pendukung_rpp_4, 10, '...') }}</td>
                                                <td>{{ Str::limit($item->rpp_5, 10, '...') }}</td>
                                                <td>{{ Str::limit($item->pendukung_rpp_5, 10, '...') }}</td>
                                                <td>{{ Str::limit($item->rpp_6, 10, '...') }}</td>
                                                <td>{{ Str::limit($item->pendukung_rpp_6, 10, '...') }}</td>
                                                <td>{{ Str::limit($item->rpp_7, 10, '...') }}</td>
                                                <td>{{ Str::limit($item->pendukung_rpp_7, 10, '...') }}</td>
                                                <td>{{ Str::limit($item->rpp_8, 10, '...') }}</td>
                                                <td>{{ Str::limit($item->pendukung_rpp_8, 10, '...') }}</td>
                                                <td>{{ Str::limit($item->rpp_9, 10, '...') }}</td>
                                                <td>{{ Str::limit($item->pendukung_rpp_9, 10, '...') }}</td>
                                                <td>{{ Str::limit($item->rpp_10, 10, '...') }}</td>
                                                <td>{{ Str::limit($item->pendukung_rpp_10, 10, '...') }}</td>
                                                <td>{{ Str::limit($item->rpp_11, 10, '...') }}</td>
                                                <td>{{ Str::limit($item->pendukung_rpp_11, 10, '...') }}</td>
                                                <td>{{ Str::limit($item->rpp_12, 10, '...') }}</td>
                                                <td>{{ Str::limit($item->pendukung_rpp_12, 10, '...') }}</td>
                                                <td>{{ Str::limit($item->rpp_13, 10, '...') }}</td>
                                                <td>{{ Str::limit($item->pendukung_rpp_13, 10, '...') }}</td>
                                                <td>
                                                    <a href="{{ route('mapel.download', $item->id) }}">
                                                        <i
                                                            class="fas fa-download text-white text-xl bg-blue p-2 rounded-lg"></i>
                                                    </a>
                                                    <a href="{{ route('mapel.edit', $item->id) }}">
                                                        <i
                                                            class="fa-regular fa-pen-to-square text-white text-xl bg-yellow p-2 rounded-lg"></i>
                                                    </a>
                                                    <form action="{{ route('mapel.destroy', $item->id) }}" method="POST"
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
                                {{ $mapels->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
