@extends('layouts.app')

@section('content')
    @include('layouts.livewire.header')

    <div class="container custom-container my-3">
        <div class="row row-cards">
            <div class="col-12">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div>
                        <a href="{{ route('school-purchases.create') }}" class="btn btn-primary" data-bs-toggle="modal"
                            data-bs-target="#modal-report">Tambah</a>
                        <a href="{{ route('school-purchases.print') }}" class="btn btn-success">Print PDF</a>
                    </div>

                    <form action="{{ route('school-purchases.index') }}" method="get" class="d-flex align-items-end">
                        @csrf
                        <div class="row g-2 align-items-center">
                            <div class="col-auto">
                                <select name="tahun_pembelian" class="form-control" style="width: 150px;"
                                    value="{{ request('tahun_pembelian') }}">
                                    <option value="">Tahun</option>
                                    <option value="2024">2024</option>
                                    <option value="2023">2023</option>
                                    <option value="2022">2022</option>
                                    <option value="2021">2021</option>
                                </select>
                            </div>
                            <div class="col-auto">
                                <select name="bulan_pembelian" class="form-control" style="width: 150px;"
                                    value="{{ request('bulan_pembelian') }}">
                                    <option value="">Bulan</option>
                                    <option value="01">Januari</option>
                                    <option value="02">Februari</option>
                                    <option value="03">Maret</option>
                                    <option value="04">April</option>
                                    <option value="05">Mei</option>
                                    <option value="06">Juni</option>
                                    <option value="07">Juli</option>
                                    <option value="08">Agustus</option>
                                    <option value="09">September</option>
                                    <option value="10">Oktober</option>
                                    <option value="11">November</option>
                                    <option value="12">Desember</option>
                                </select>
                            </div>
                            <div class="col-auto">
                                <button type="submit" class="btn btn-primary">Search</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="modal modal-blur fade" id="modal-report" tabindex="-1" style="display: none;" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered">
                    <form action="{{ route('school-purchases.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Pembelian</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body row row-cards">
                                <div class="col-md-3">
                                    <div class="mb-3">
                                        <label class="form-label">Tanggal Pembelian</label>
                                        <input type="date" name="tanggal_pembelian" class="form-control"
                                            placeholder="Pilih Tanggal" autofocus autocomplete="off"
                                            value="{{ old('tanggal_pembelian') }}">
                                        @error('tanggal_pembelian')
                                            <div class="text-danger mt-2">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-3">
                                    <div class="mb-3">
                                        <label class="form-label">Kode Barang</label>
                                        <input type="text" name="kode" class="form-control" autofocus
                                            autocomplete="off" placeholder="Kode Barang" value="{{ old('kode') }}">
                                        @error('kode')
                                            <div class="text-danger mt-2">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Nama Barang</label>
                                        <input type="text" name="nama_barang" class="form-control"
                                            placeholder="Nama Barang" autofocus autocomplete="off"
                                            value="{{ old('nama_barang') }}">
                                        @error('nama_barang')
                                            <div class="text-danger mt-2">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-4">
                                    <div class="mb-3">
                                        <label class="form-label">Harga Satuan</label>
                                        <input type="text" id="harga" name="harga_satuan" class="form-control"
                                            placeholder="Rp. ..." autofocus autocomplete="off"
                                            value="{{ old('harga_satuan') }}">
                                        @error('harga_satuan')
                                            <div class="text-danger mt-2">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-3">
                                    <div class="mb-3">
                                        <label class="form-label">Jumlah</label>
                                        <input type="number" id="jumlah_baik" name="jumlah_baik" class="form-control"
                                            placeholder="Jumlah" autofocus autocomplete="off"
                                            value="{{ old('jumlah_baik') }}">
                                        @error('jumlah')
                                            <div class="text-danger mt-2">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="mb-3">
                                        <label class="form-label">Total Harga</label>
                                        <input type="text" id="total" name="total_harga" class="form-control"
                                            autofocus autocomplete="off" placeholder="Total Harga"
                                            value="{{ old('total_harga') }}">
                                        @error('total_harga')
                                            <div class="text-danger mt-2">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Pembeli</label>
                                        <input type="text" name="pembeli" class="form-control" autofocus
                                            autocomplete="off" placeholder="Pembeli" value="{{ old('pembeli') }}">
                                        @error('pembeli')
                                            <div class="text-danger mt-2">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Toko</label>
                                        <input type="text" name="toko" class="form-control" autofocus
                                            autocomplete="off" placeholder="Toko" value="{{ old('toko') }}">
                                        @error('toko')
                                            <div class="text-danger mt-2">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label class="form-label">Keterangan</label>
                                        <textarea rows="3" name="deskripsi" class="form-control" placeholder="Keterangan" autofocus
                                            autocomplete="off"></textarea>
                                        @error('deskripsi')
                                            <div class="text-danger mt-2">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label class="form-label" for="gambar">Upload Gambar</label>
                                        <input type="file" name="gambar[]" id="gambar" class="form-control"
                                            multiple>
                                        @error('gambar')
                                            <div class="text-danger mt-2">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary ms-auto">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round" class="icon">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <path d="M12 5l0 14"></path>
                                        <path d="M5 12l14 0"></path>
                                    </svg>
                                    Tambahkan
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="col-12">
                <div class="card" style="height: 60vh">
                    <div class="card-body card-body-scrollable card-body-scrollable-shadow p-0 rounded">
                        <style>
                            .table-responsive {
                                position: relative;
                                height: 59vh;
                                overflow-y: auto;
                            }

                            .table-responsive thead th {
                                position: sticky;
                                top: 0;
                                z-index: 1;
                                background: white;
                            }

                            .table-responsive tbody tr:nth-child(odd) {
                                background-color: #f9f9f9;
                            }

                            .table th,
                            .table td {
                                white-space: nowrap;
                            }

                            .table th.w-4,
                            .table td.w-4 {
                                width: 4%;
                            }

                            .table th.w-10,
                            .table td.w-10 {
                                width: 10%;
                            }

                            .table th.w-20,
                            .table td.w-20 {
                                width: 20%;
                            }

                            .table th.w-15,
                            .table td.w-15 {
                                width: 15%;
                            }
                        </style>
                        <div class="table-responsive">
                            <table class="table table-vcenter card-table">
                                <thead class="sticky-top">
                                    <tr>
                                        <th class="w-4">No</th>
                                        <th class="w-10">Tanggal Pembelian</th>
                                        <th class="w-15">Nama Barang</th>
                                        <th class="w-10">Kode Barang</th>
                                        <th class="w-10">Harga Satuan</th>
                                        <th class="w-10">Jumlah(B/R)</th>
                                        <th class="w-10">Total Harga</th>
                                        <th class="w-10">Pembeli</th>
                                        <th class="w-10">Toko</th>
                                        <th class="w-20">Keterangan</th>
                                        <th class="w-10">Opsi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $i = 1;
                                    @endphp
                                    @forelse ($schoolPurchases as $item)
                                        <tr>
                                            <td>{{ $i++ }}</td>
                                            <td>{{ $item->tanggal_pembelian }}</td>
                                            <td>{{ $item->nama_barang }}</td>
                                            <td>{{ $item->kode }}</td>
                                            <td>{{ $item->harga_satuan }}</td>
                                            <td>
                                                <span class="badge bg-green text-green-fg">{{ $item->jumlah_baik }}</span>
                                                /
                                                <span class="badge bg-red text-red-fg">{{ $item->jumlah_rusak }}</span>
                                            </td>
                                            <td>{{ $item->total_harga }}</td>
                                            <td>{{ $item->pembeli }}</td>
                                            <td>{{ $item->toko }}</td>
                                            <td>{{ $item->deskripsi }}</td>
                                            <td>
                                                <div class="btn-group">
                                                    <div class="col-6 col-sm-4 col-md-2 col-xl-auto me-2">
                                                        <a href="{{ route('school-purchases.edit', $item->id) }}"
                                                            class="btn w-100 btn-icon btn-success">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                height="24" viewBox="0 0 24 24" fill="none"
                                                                stroke="currentColor" stroke-width="2"
                                                                stroke-linecap="round" stroke-linejoin="round"
                                                                class="icon icon-tabler icons-tabler-outline icon-tabler-edit">
                                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                                <path
                                                                    d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" />
                                                                <path
                                                                    d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" />
                                                                <path d="M16 5l3 3" />
                                                            </svg>
                                                        </a>
                                                    </div>
                                                    <div class="col-6 col-sm-4 col-md-2 col-xl-auto me-2">
                                                        <a href="{{ route('school-purchases.destroy', $item->id) }}"
                                                            class="btn w-100 btn-icon btn-danger" data-bs-toggle="modal"
                                                            data-bs-target="#modal-delete-{{ $item->id }}">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                height="24" viewBox="0 0 24 24" fill="none"
                                                                stroke="currentColor" stroke-width="2"
                                                                stroke-linecap="round" stroke-linejoin="round"
                                                                class="icon icon-tabler icons-tabler-outline icon-tabler-trash">
                                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                                <path d="M4 7l16 0" />
                                                                <path d="M10 11l0 6" />
                                                                <path d="M14 11l0 6" />
                                                                <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" />
                                                                <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" />
                                                            </svg>
                                                        </a>
                                                    </div>
                                                    <div class="col-6 col-sm-4 col-md-2 col-xl-auto me-2">
                                                        <a href="{{ route('school-purchases.download', $item->id) }}"
                                                            class="btn w-100 btn-icon btn-primary">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                height="24" viewBox="0 0 24 24" fill="none"
                                                                stroke="currentColor" stroke-width="2"
                                                                stroke-linecap="round" stroke-linejoin="round"
                                                                class="icon icon-tabler icons-tabler-outline icon-tabler-download">
                                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                                <path d="M4 17v2a2 2 0 0 0 2 2h12a2 2 0 0 0 2 -2v-2" />
                                                                <path d="M7 11l5 5l5 -5" />
                                                                <path d="M12 4l0 12" />
                                                            </svg>
                                                        </a>
                                                    </div>
                                                </div>
                                            </td>
                                            <div class="modal modal-blur fade" id="modal-delete-{{ $item->id }}"
                                                tabindex="-1" style="display: none;" aria-hidden="true">
                                                <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
                                                    <form action="{{ route('school-purchases.destroy', $item->id) }}"
                                                        method="post">
                                                        @csrf
                                                        @method('delete')
                                                        <div class="modal-content">
                                                            <button type="button" class="btn-close"
                                                                data-bs-dismiss="modal" aria-label="Close"></button>
                                                            <div class="modal-status bg-danger"></div>
                                                            <div class="modal-body text-center py-4">
                                                                <!-- Download SVG icon from http://tabler-icons.io/i/alert-triangle -->
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                    height="24" viewBox="0 0 24 24"
                                                                    fill="currentColor"
                                                                    class="icon mb-2 text-danger icon-lg mx-auto icon-tabler-alert-triangle">
                                                                    <path stroke="none" d="M0 0h24v24H0z"
                                                                        fill="none" />
                                                                    <path
                                                                        d="M12 1.67c.955 0 1.845 .467 2.39 1.247l.105 .16l8.114 13.548a2.914 2.914 0 0 1 -2.307 4.363l-.195 .008h-16.225a2.914 2.914 0 0 1 -2.582 -4.2l.099 -.185l8.11 -13.538a2.914 2.914 0 0 1 2.491 -1.403zm.01 13.33l-.127 .007a1 1 0 0 0 0 1.986l.117 .007l.127 -.007a1 1 0 0 0 0 -1.986l-.117 -.007zm-.01 -7a1 1 0 0 0 -.993 .883l-.007 .117v4l.007 .117a1 1 0 0 0 1.986 0l.007 -.117v-4l-.007 -.117a1 1 0 0 0 -.993 -.883z" />
                                                                </svg>
                                                                <h3>Apakah Anda Yakin?</h3>
                                                                <div class="text-secondary">Apakah Anda
                                                                    benar-benar ingin menghapus data ini?
                                                                    Apa
                                                                    yang telah Anda lakukan tidak dapat
                                                                    dibatalkan.</div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <div class="w-100">
                                                                    <div class="row">
                                                                        <div class="col"><a href="#"
                                                                                class="btn w-100" data-bs-dismiss="modal">
                                                                                Batal
                                                                            </a></div>
                                                                        <div class="col"> <button type="submit"
                                                                                class="btn btn-danger w-100"
                                                                                data-bs-dismiss="modal">
                                                                                Hapus
                                                                            </button></div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="11" class="text-center">Tidak ada data</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                            {{ $schoolPurchases->links() }} <!-- Pastikan ini dipanggil pada hasil paginasi -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @session('success')
        <div class="alert alert-important alert-success alert-dismissible position-absolute bottom-0 end-0 me-3"
            role="alert">
            <div class="d-flex">
                <div>
                    <!-- Download SVG icon from http://tabler-icons.io/i/check -->
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
            <a class="btn-close" data-bs-dismiss="alert" aria-label="close"></a>
        </div>
    @endsession
    <script>
        const hargaInput = document.getElementById('harga');
        const jumlahInput = document.getElementById('jumlah_baik');
        const totalInput = document.getElementById('total');

        function formatRupiah(angka, prefix) {
            var number_string = angka.replace(/[^,\d]/g, '').toString(),
                split = number_string.split(','),
                sisa = split[0].length % 3,
                rupiah = split[0].substr(0, sisa),
                ribuan = split[0].substr(sisa).match(/\d{3}/gi);

            if (ribuan) {
                separator = sisa ? '.' : '';
                rupiah += separator + ribuan.join('.');
            }

            rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
            return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
        }

        function calculateTotal() {
            const harga = parseFloat(hargaInput.value.replace(/[^,\d]/g, '')) || 0;
            const jumlah = parseFloat(jumlahInput.value) || 0;
            const total = harga * jumlah;
            totalInput.value = formatRupiah(total.toString(), 'Rp. ');
        }

        hargaInput.addEventListener('input', function(e) {
            hargaInput.value = formatRupiah(this.value, 'Rp. ');
            calculateTotal();
        });

        jumlahInput.addEventListener('input', calculateTotal);

        document.addEventListener("DOMContentLoaded", function() {
            @if ($errors->any())
                var myModalUpd = new bootstrap.Modal(document.getElementById('modal-update'));
                myModalUpd.show();
            @endif
            @if ($errors->any())
                var myModalNew = new bootstrap.Modal(document.getElementById('modal-report'));
                myModalNew.show();
            @endif
        });
    </script>
@endsection
