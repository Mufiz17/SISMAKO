@extends('layouts.app')

@section('content')
    <div class="px-5 py-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="col">
                <div class="row row-cards">
                    <div class="col-12">
                        <div class="mb-4 col">
                            <a href="{{ route('kepsek.index') }}" class="btn btn-secondary">
                                Kembali
                            </a>
                        </div>
                        <form class="card" action="{{ route('kepsek.store') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <div id="step1">
                                <div class="card-body">
                                    <h3 class="card-title text-center">Tambah Data Kepsek</h3>
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
                                    <h3 class="card-title">Upload File</h3>
                                    <div class="row row-cards">
                                        <div class="col-sm-6 col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label">Proker</label>
                                                <input type="file" name="proker_kepsek" class="form-control">
                                                @error('proker_kepsek')
                                                    <div class="text-danger mt-2"> {{ $message }} </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label">RKTS</label>
                                                <input type="file" name="rkts" class="form-control">
                                                @error('rkts')
                                                    <div class="text-danger mt-2"> {{ $message }} </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label">RKJM</label>
                                                <input type="file" name="rkjm" class="form-control">
                                                @error('rkjm')
                                                    <div class="text-danger mt-2"> {{ $message }} </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label">Prog. Jangka Panjang</label>
                                                <input type="file" name="prog_jangka_panjang" class="form-control">
                                                @error('prog_jangka_panjang')
                                                    <div class="text-danger mt-2"> {{ $message }} </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label">RKAS</label>
                                                <input type="file" name="rkas" class="form-control">
                                                @error('rkas')
                                                    <div class="text-danger mt-2"> {{ $message }} </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="step3">
                                <div class="card-body">
                                    <h3 class="card-title">Penilaian Bulanan Guru</h3>
                                    <div class="row row-cards">
                                        <div class="col-sm-6 col-md-4">
                                            <div class="mb-3">
                                                <label for="nomor_penilaian">Nomor</label>
                                                <input type="number" class="form-control" id="nomor_penilaian"
                                                    name="nomor_penilaian">
                                                @error('nomor_penilaian')
                                                    <div class="text-danger mt-2"> {{ $message }} </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-4">
                                            <div class="mb-3">
                                                <label for="nama_guru">Nama Guru</label>
                                                <input type="text" class="form-control" id="nama_guru" name="nama_guru">
                                                @error('nama_guru')
                                                    <div class="text-danger mt-2"> {{ $message }} </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-4">
                                            <div class="mb-3">
                                                <label for="nilai_tepat_waktu">Nilai Tepat Waktu</label>
                                                <input type="text" class="form-control" id="nilai_tepat_waktu"
                                                    name="nilai_tepat_waktu">
                                                @error('nilai_tepat_waktu')
                                                    <div class="text-danger mt-2"> {{ $message }} </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-4">
                                            <div class="mb-3">
                                                <label for="penilaian_kumulatif_siswa">Penilaian Kumulatif
                                                    Siswa</label>
                                                <input type="text" class="form-control" id="penilaian_kumulatif_siswa"
                                                    name="penilaian_kumulatif_siswa">
                                                @error('penilaian_kumulatif_siswa')
                                                    <div class="text-danger mt-2"> {{ $message }} </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-4">
                                            <div class="mb-3">
                                                <label for="capaian_materi">Capaian Materi</label>
                                                <input type="text" class="form-control" id="capaian_materi"
                                                    name="capaian_materi">
                                                @error('capaian_materi')
                                                    <div class="text-danger mt-2"> {{ $message }} </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-4">
                                            <div class="mb-3">
                                                <label for="prestasi">Prestasi</label>
                                                <input type="text" class="form-control" id="prestasi"
                                                    name="prestasi">
                                                @error('prestasi')
                                                    <div class="text-danger mt-2"> {{ $message }} </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-4">
                                            <div class="mb-3">
                                                <label for="bulan">Bulan</label>
                                                <input type="text" class="form-control" id="bulan"
                                                    name="bulan">
                                                @error('bulan')
                                                    <div class="text-danger mt-2"> {{ $message }} </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-4">
                                            <div class="mb-3">
                                                <label for="keterangan_penilaian_bulanan">Keterangan</label>
                                                <textarea class="form-control" id="keterangan_penilaian_bulanan" name="keterangan_penilaian_bulanan">{{ old('keterangan_penilaian_bulanan') }}</textarea>
                                                @error('keterangan_penilaian_bulanan')
                                                    <div class="text-danger mt-2"> {{ $message }} </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="step4">
                                <div class="card-body">
                                    <h3 class="card-title">Daftar Pembagian Tugas Guru</h3>
                                    <div class="row row-cards">
                                        <div class="col-sm-6 col-md-4">
                                            <div class="mb-3">
                                                <label for="nomor_pembagian_tugas">Nomor</label>
                                                <input type="number" class="form-control" id="nomor_pembagian_tugas"
                                                    name="nomor_pembagian_tugas">
                                                @error('nomor_pembagian_tugas')
                                                    <div class="text-danger mt-2"> {{ $message }} </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-4">
                                            <div class="mb-3">
                                                <label for="nama_pembagian_tugas">Nama</label>
                                                <input type="text" class="form-control" id="nama_pembagian_tugas"
                                                    name="nama_pembagian_tugas">
                                                @error('nama_pembagian_tugas')
                                                    <div class="text-danger mt-2"> {{ $message }} </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-4">
                                            <div class="mb-3">
                                                <label for="kelas">kelas</label>
                                                <input type="text" class="form-control" id="kelas"
                                                    name="kelas">
                                                @error('kelas')
                                                    <div class="text-danger mt-2"> {{ $message }} </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-4">
                                            <div class="mb-3">
                                                <label for="jabatan">Jabatan</label>
                                                <input type="text" class="form-control" id="jabatan"
                                                    name="jabatan">
                                                @error('jabatan')
                                                    <div class="text-danger mt-2"> {{ $message }} </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-4">
                                            <div class="mb-3">
                                                <label for="mapel">Mapel</label>
                                                <input type="text" class="form-control" id="mapel"
                                                    name="mapel">
                                                @error('mapel')
                                                    <div class="text-danger mt-2"> {{ $message }} </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-4">
                                            <div class="mb-3">
                                                <label for="jumlah_jp">Jumlah Jp</label>
                                                <input type="text" class="form-control" id="jumlah_jp"
                                                    name="jumlah_jp">
                                                @error('jumlah_jp')
                                                    <div class="text-danger mt-2"> {{ $message }} </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-4">
                                            <div class="mb-3">
                                                <label for="keterangan_pembagian_tugas">Keterangan</label>
                                                <textarea class="form-control" id="keterangan_pembagian_tugas" name="keterangan_pembagian_tugas">{{ old('keterangan_pembagian_tugas') }}</textarea>
                                                @error('keterangan_pembagian_tugas')
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
            const steps = ['step1', 'step2', 'step3', 'step4'];
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
