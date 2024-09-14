@extends('layouts.app')

@section('content')
    <div class="px-5 py-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="col">
                <div class="row row-cards">
                    <div class="col-12">
                        <div class="mb-4 col">
                            <a href="{{ route('waka_kesiswaan.index') }}" class="btn btn-secondary">
                                Kembali
                            </a>
                        </div>
                        <form class="card" action="{{ route('waka_kesiswaan.store') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <div id="step1">
                                <div class="card-body">
                                    <h3 class="card-title text-center">Tambah Data Waka Kesiswaan</h3>
                                    <div class="row row-cards">
                                        <div class="col-sm-6 col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label">Tahun Ajaran</label>
                                                <select class="form-control form-select" name="tahun_ajaran">
                                                    <option value="">Pilih Tahun Ajaran</option>
                                                    @foreach (generateTahunAjaran() as $tahun)
                                                        <option value="{{ $tahun }}">{{ $tahun }}</option>
                                                    @endforeach
                                                </select>
                                                @error('tahun_ajaran')
                                                    <div class="text-danger mt-2"> {{ $message }} </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="step2">
                                <div class="card-body">
                                    <h3 class="card-title">Buku Penyelesaian Kasus</h3>
                                    <div class="row row-cards">
                                        <div class="col-sm-6 col-md-4">
                                            <div class="mb-3">
                                                <label for="nomor_penyelesaian_kasus">Nomor</label>
                                                <input type="number" class="form-control" id="nomor_penyelesaian_kasus"
                                                    name="nomor_penyelesaian_kasus">
                                                @error('nomor_penyelesaian_kasus')
                                                    <div class="text-danger mt-2"> {{ $message }} </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-4">
                                            <div class="mb-3">
                                                <label for="nama_penyelesaian_kasus">Nama Kasus</label>
                                                <input type="text" class="form-control" id="nama_penyelesaian_kasus"
                                                    name="nama_penyelesaian_kasus">
                                                @error('nama_penyelesaian_kasus')
                                                    <div class="text-danger mt-2"> {{ $message }} </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-4">
                                            <div class="mb-3">
                                                <label for="tanggal_kejadian">Tanggal</label>
                                                <input type="text" class="form-control" id="tanggal_kejadian"
                                                    name="tanggal_kejadian">
                                                @error('tanggal_kejadian')
                                                    <div class="text-danger mt-2"> {{ $message }} </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-4">
                                            <div class="mb-3">
                                                <label for="uraian_kasus">Uraian Kasus</label>
                                                <input type="text" class="form-control" id="uraian_kasus"
                                                    name="uraian_kasus">
                                                @error('uraian_kasus')
                                                    <div class="text-danger mt-2"> {{ $message }} </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-4">
                                            <div class="mb-3">
                                                <label for="cara_menyelesaikan">Cara Menyelesaikan</label>
                                                <input type="text" class="form-control" id="cara_menyelesaikan"
                                                    name="cara_menyelesaikan">
                                                @error('cara_menyelesaikan')
                                                    <div class="text-danger mt-2"> {{ $message }} </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-4">
                                            <div class="mb-3">
                                                <label for="tindak_lanjut">Tindak Lanjut</label>
                                                <input type="text" class="form-control" id="tindak_lanjut"
                                                    name="tindak_lanjut">
                                                @error('tindak_lanjut')
                                                    <div class="text-danger mt-2"> {{ $message }} </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-4">
                                            <div class="mb-3">
                                                <label for="keterangan_penyelesaian_kasus">Keterangan</label>
                                                <textarea class="form-control" id="keterangan_penyelesaian_kasus" name="keterangan_penyelesaian_kasus">{{ old('keterangan_penyelesaian_kasus') }}</textarea>
                                                @error('keterangan_penyelesaian_kasus')
                                                    <div class="text-danger mt-2"> {{ $message }} </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="step3">
                                <div class="card-body">
                                    <h3 class="card-title">Buku Hubin</h3>
                                    <div class="row row-cards">
                                        <div class="col-sm-6 col-md-4">
                                            <div class="mb-3">
                                                <label for="nomor_hubin">Nomor</label>
                                                <input type="number" class="form-control" id="nomor_hubin"
                                                    name="nomor_hubin">
                                                @error('nomor_hubin')
                                                    <div class="text-danger mt-2"> {{ $message }} </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-4">
                                            <div class="mb-3">
                                                <label for="tanggal_kunjungan">Tanggal Kunjungan</label>
                                                <input type="text" class="form-control" id="tanggal_kunjungan"
                                                    name="tanggal_kunjungan">
                                                @error('tanggal_kunjungan')
                                                    <div class="text-danger mt-2"> {{ $message }} </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-4">
                                            <div class="mb-3">
                                                <label for="tempat_kunjungan">Tempat Kunjungan</label>
                                                <input type="text" class="form-control" id="tempat_kunjungan"
                                                    name="tempat_kunjungan">
                                                @error('tempat_kunjungan')
                                                    <div class="text-danger mt-2"> {{ $message }} </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-4">
                                            <div class="mb-3">
                                                <label for="nama_peserta">Nama Peserta</label>
                                                <input type="text" class="form-control" id="nama_peserta"
                                                    name="nama_peserta">
                                                @error('nama_peserta')
                                                    <div class="text-danger mt-2"> {{ $message }} </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-4">
                                            <div class="mb-3">
                                                <label for="hasil_kunjungan">Hasil Kunjungan</label>
                                                <input type="text" class="form-control" id="hasil_kunjungan"
                                                    name="hasil_kunjungan">
                                                @error('hasil_kunjungan')
                                                    <div class="text-danger mt-2"> {{ $message }} </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-4">
                                            <div class="mb-3">
                                                <label for="keterangan_hubin">Keterangan</label>
                                                <textarea class="form-control" id="keterangan_hubin" name="keterangan_hubin">{{ old('keterangan_hubin') }}</textarea>
                                                @error('keterangan_hubin')
                                                    <div class="text-danger mt-2"> {{ $message }} </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="step4">
                                <div class="card-body">
                                    <h3 class="card-title">CPD Tahun Pelajaran</h3>
                                    <div class="row row-cards">
                                        <div class="col-sm-6 col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label">Tahun Pel</label>
                                                <input type="file" name="tahun_pel" class="form-control">
                                                @error('tahun_pel')
                                                    <div class="text-danger mt-2"> {{ $message }} </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="step5">
                                <div class="card-body">
                                    <h3 class="card-title">Pelatihan Siswa</h3>
                                    <div class="row row-cards">
                                        <div class="col-sm-6 col-md-4">
                                            <div class="mb-3">
                                                <label for="nomor_pelatihan_siswa">Nomor</label>
                                                <input type="number" class="form-control" id="nomor_pelatihan_siswa"
                                                    name="nomor_pelatihan_siswa">
                                                @error('nomor_pelatihan_siswa')
                                                    <div class="text-danger mt-2"> {{ $message }} </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-4">
                                            <div class="mb-3">
                                                <label for="nama_pelatihan_siswa">Nama</label>
                                                <input type="text" class="form-control" id="nama_pelatihan_siswa"
                                                    name="nama_pelatihan_siswa">
                                                @error('nama_pelatihan_siswa')
                                                    <div class="text-danger mt-2"> {{ $message }} </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-4">
                                            <div class="mb-3">
                                                <label for="materi_pelatihan_siswa">Materi</label>
                                                <input type="text" class="form-control" id="materi_pelatihan_siswa"
                                                    name="materi_pelatihan_siswa">
                                                @error('materi_pelatihan_siswa')
                                                    <div class="text-danger mt-2"> {{ $message }} </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-4">
                                            <div class="mb-3">
                                                <label for="tempat_pelatihan_siswa">Tempat</label>
                                                <input type="text" class="form-control" id="tempat_pelatihan_siswa"
                                                    name="tempat_pelatihan_siswa">
                                                @error('tempat_pelatihan_siswa')
                                                    <div class="text-danger mt-2"> {{ $message }} </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-4">
                                            <div class="mb-3">
                                                <label for="tanggal_pelatihan_siswa">Tanggal</label>
                                                <input type="text" class="form-control" id="tanggal_pelatihan_siswa"
                                                    name="tanggal_pelatihan_siswa">
                                                @error('tanggal_pelatihan_siswa')
                                                    <div class="text-danger mt-2"> {{ $message }} </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-4">
                                            <div class="mb-3">
                                                <label for="hasil_pelatihan_siswa">Hasil</label>
                                                <input type="text" class="form-control" id="hasil_pelatihan_siswa"
                                                    name="hasil_pelatihan_siswa">
                                                @error('hasil_pelatihan_siswa')
                                                    <div class="text-danger mt-2"> {{ $message }} </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-4">
                                            <div class="mb-3">
                                                <label for="tingkat_pelatihan_siswa">Tingkat</label>
                                                <input type="text" class="form-control" id="tingkat_pelatihan_siswa"
                                                    name="tingkat_pelatihan_siswa">
                                                @error('tingkat_pelatihan_siswa')
                                                    <div class="text-danger mt-2"> {{ $message }} </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-4">
                                            <div class="mb-3">
                                                <label for="lama_jam_pelatihan_siswa">Lama dalam Jam</label>
                                                <input type="text" class="form-control" id="lama_jam_pelatihan_siswa"
                                                    name="lama_jam_pelatihan_siswa">
                                                @error('lama_jam_pelatihan_siswa')
                                                    <div class="text-danger mt-2"> {{ $message }} </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="step6">
                                <div class="card-body">
                                    <h3 class="card-title">Seminar</h3>
                                    <div class="row row-cards">
                                        <div class="col-sm-6 col-md-4">
                                            <div class="mb-3">
                                                <label for="nomor_seminar">Nomor</label>
                                                <input type="number" class="form-control" id="nomor_seminar"
                                                    name="nomor_seminar">
                                                @error('nomor_seminar')
                                                    <div class="text-danger mt-2"> {{ $message }} </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-4">
                                            <div class="mb-3">
                                                <label for="nara_sumber">Narasumber</label>
                                                <input type="text" class="form-control" id="nara_sumber"
                                                    name="nara_sumber">
                                                @error('nara_sumber')
                                                    <div class="text-danger mt-2"> {{ $message }} </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-4">
                                            <div class="mb-3">
                                                <label for="materi_seminar">Materi</label>
                                                <input type="text" class="form-control" id="materi_seminar"
                                                    name="materi_seminar">
                                                @error('materi_seminar')
                                                    <div class="text-danger mt-2"> {{ $message }} </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-4">
                                            <div class="mb-3">
                                                <label for="tanggal_seminar">Tanggal</label>
                                                <input type="text" class="form-control" id="tanggal_seminar"
                                                    name="tanggal_seminar">
                                                @error('tanggal_seminar')
                                                    <div class="text-danger mt-2"> {{ $message }} </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-4">
                                            <div class="mb-3">
                                                <label for="waktu_seminar">Waktu</label>
                                                <input type="text" class="form-control" id="waktu_seminar"
                                                    name="waktu_seminar">
                                                @error('waktu_seminar')
                                                    <div class="text-danger mt-2"> {{ $message }} </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-4">
                                            <div class="mb-3">
                                                <label for="tingkat_seminar">Tingkat</label>
                                                <input type="text" class="form-control" id="tingkat_seminar"
                                                    name="tingkat_seminar">
                                                @error('tingkat_seminar')
                                                    <div class="text-danger mt-2"> {{ $message }} </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-4">
                                            <div class="mb-3">
                                                <label for="hasil_seminar">Hasil</label>
                                                <input type="text" class="form-control" id="hasil_seminar"
                                                    name="hasil_seminar">
                                                @error('hasil_seminar')
                                                    <div class="text-danger mt-2"> {{ $message }} </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-4">
                                            <div class="mb-3">
                                                <label for="keterangan_seminar">keterangan</label>
                                                <textarea class="form-control" id="keterangan_seminar" name="keterangan_seminar">{{ old('keterangan_seminar') }}</textarea>
                                                @error('keterangan_seminar')
                                                    <div class="text-danger mt-2"> {{ $message }} </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="step7">
                                <div class="card-body">
                                    <h3 class="card-title">Piket Gromming</h3>
                                    <div class="row row-cards">
                                        <div class="col-sm-6 col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label">Piket Gromming</label>
                                                <input type="file" name="piket_gromming" class="form-control">
                                                @error('piket_gromming')
                                                    <div class="text-danger mt-2"> {{ $message }} </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer text-end">
                                <button type="button" class="btn btn-secondary" id="prevButton"
                                    style="display: none;">Previous</button>
                                <button type="button" class="btn btn-primary" id="nextButton">Next</button>
                                <button type="submit" class="btn btn-success d-none" id="submitButton">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const steps = ['step1', 'step2', 'step3', 'step4', 'step5', 'step6', 'step7'];
            let currentStep = 0;

            const nextButton = document.getElementById('nextButton');
            const prevButton = document.getElementById('prevButton');
            const submitButton = document.getElementById('submitButton');

            const toggleVisibility = (element, condition) => {
                element.style.display = condition ? 'none' : 'inline-block';
            };

            const showStep = (step) => {
                steps.forEach((id, index) => {
                    document.getElementById(id).classList.toggle('d-none', index !== step);
                });
                toggleVisibility(prevButton, step === 0);
                toggleVisibility(nextButton, step === steps.length - 1);
                submitButton.classList.toggle('d-none', step !== steps.length - 1);
            };

            nextButton.addEventListener('click', function() {
                if (currentStep < steps.length - 1) {
                    currentStep++;
                    showStep(currentStep);
                }
            });

            prevButton.addEventListener('click', function() {
                if (currentStep > 0) {
                    currentStep--;
                    showStep(currentStep);
                }
            });

            showStep(currentStep);
        });
    </script>
@endsection
