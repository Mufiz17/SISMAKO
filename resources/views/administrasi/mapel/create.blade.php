@extends('layouts.app')

@section('content')
    <div class="px-5 py-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="col">
                <div class="row row-cards">
                    <div class="col-12">
                        <div class="mb-4 col">
                            <a href="{{ route('mapel.index') }}" class="btn btn-secondary">
                                Kembali
                            </a>
                        </div>
                        <form class="card" action="{{ route('mapel.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div id="step1">
                                <div class="card-body">
                                    <h3 class="card-title text-center mb-4">Tambah Data Mata Pelajaran</h3>
                                    <div class="row row-cards">
                                        <div class="col-sm-6 col-md-6">
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
                                        <div class="col-sm-6 col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label">Kelas</label>
                                                <select class="form-control form-select" name="kelas">
                                                    <option value="">Pilih Kelas</option>
                                                    <option value="X">X</option>
                                                    <option value="XI">XI</option>
                                                    <option value="XII">XII</option>
                                                    <option value="XIII">XIII</option>
                                                </select>
                                                @error('kelas')
                                                    <div class="text-danger mt-2"> {{ $message }} </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-6">
                                            <div class="mb-3">
                                                <label class="mb-2" for="mapel">Mapel</label>
                                                <input type="text" class="form-control" id="mapel" name="mapel"
                                                    required>
                                                @error('mapel')
                                                    <div class="text-danger mt-2"> {{ $message }} </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label">Kategori Kurikulum</label>
                                                <select class="form-control form-select" name="kategori_kurikulum">
                                                    <option value="">Pilih Kategori Kurikulum</option>
                                                    <option value="K13">K13</option>
                                                    <option value="KUMER">KUMER</option>
                                                </select>
                                                @error('kategori_kurikulum')
                                                    <div class="text-danger mt-2"> {{ $message }} </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="step2">
                                <div class="card-body">
                                    <h3 class="card-title">Buku Kerja 1</h3>
                                    <div class="row row-cards">
                                        <div class="col-sm-6 col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label">PKG</label>
                                                <input type="file" name="pkg" class="form-control">
                                                @error('pkg')
                                                    <div class="text-danger mt-2"> {{ $message }} </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label">Silabus</label>
                                                <input type="file" name="silabus" class="form-control">
                                                @error('silabus')
                                                    <div class="text-danger mt-2"> {{ $message }} </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label">KI KD & SKL</label>
                                                <input type="file" name="ki_kd_skl" class="form-control">
                                                @error('ki_kd_skl')
                                                    <div class="text-danger mt-2"> {{ $message }} </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="step3">
                                <div class="card-body">
                                    <h3 class="card-title">Buku Kerja 2</h3>
                                    <div class="row row-cards">
                                        <div class="col-sm-6 col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label">Kode Etik, Ikrar Guru, dll</label>
                                                <input type="file" name="kode_etik" class="form-control">
                                                @error('kode_etik')
                                                    <div class="text-danger mt-2"> {{ $message }} </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label">Program Semester</label>
                                                <input type="file" name="program_semester" class="form-control">
                                                @error('program_semester')
                                                    <div class="text-danger mt-2"> {{ $message }} </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label">Program Tahunan</label>
                                                <input type="file" name="program_tahunan" class="form-control">
                                                @error('program_tahunan')
                                                    <div class="text-danger mt-2"> {{ $message }} </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label">Kaldik Sekolah</label>
                                                <input type="file" name="kaldik_sekolah" class="form-control">
                                                @error('kaldik_sekolah')
                                                    <div class="text-danger mt-2"> {{ $message }} </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label">JAK</label>
                                                <input type="file" name="jak" class="form-control">
                                                @error('jak')
                                                    <div class="text-danger mt-2"> {{ $message }} </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label">Analisi Waktu</label>
                                                <input type="file" name="analisi_waktu" class="form-control">
                                                @error('analisi_waktu')
                                                    <div class="text-danger mt-2"> {{ $message }} </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="step4">
                                <div class="card-body">
                                    <h3 class="card-title">Buku Kerja 3</h3>
                                    <div class="row row-cards">
                                        <div class="col-sm-6 col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label">Daftar Hadir Siswa</label>
                                                <input type="file" name="daftar_hadir_siswa" class="form-control">
                                                @error('daftar_hadir_siswa')
                                                    <div class="text-danger mt-2"> {{ $message }} </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label">Jadwal Pelajaran</label>
                                                <input type="file" name="jadwal_pelajaran" class="form-control">
                                                @error('jadwal_pelajaran')
                                                    <div class="text-danger mt-2"> {{ $message }} </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label">Kisi-kisi, Soal, Kartu Soal</label>
                                                <input type="file" name="kisi_kisi_soal_kartu_soal"
                                                    class="form-control">
                                                @error('kisi_kisi_soal_kartu_soal')
                                                    <div class="text-danger mt-2"> {{ $message }} </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="step5">
                                <div class="card-body">
                                    <h3 class="card-title">Buku Kerja 4 - (Isi sesuai yang dibutuhkan!)</h3>
                                    <div class="row row-cards">
                                        <div class="col-sm-6 col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label">RPP 1</label>
                                                <input type="file" name="rpp_1" class="form-control">
                                                @error('rpp_1')
                                                    <div class="text-danger mt-2"> {{ $message }} </div>
                                                @enderror
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Pendukung RPP 1</label>
                                                <input type="file" name="pendukung_rpp_1" class="form-control">
                                                @error('pendukung_rpp_1')
                                                    <div class="text-danger mt-2"> {{ $message }} </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label">RPP 2</label>
                                                <input type="file" name="rpp_2" class="form-control">
                                                @error('rpp_2')
                                                    <div class="text-danger mt-2"> {{ $message }} </div>
                                                @enderror
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Pendukung RPP 2</label>
                                                <input type="file" name="pendukung_rpp_2" class="form-control">
                                                @error('pendukung_rpp_2')
                                                    <div class="text-danger mt-2"> {{ $message }} </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label">RPP 3</label>
                                                <input type="file" name="rpp_3" class="form-control">
                                                @error('rpp_3')
                                                    <div class="text-danger mt-2"> {{ $message }} </div>
                                                @enderror
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Pendukung RPP 3</label>
                                                <input type="file" name="pendukung_rpp_3" class="form-control">
                                                @error('pendukung_rpp_3')
                                                    <div class="text-danger mt-2"> {{ $message }} </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label">RPP 4</label>
                                                <input type="file" name="rpp_4" class="form-control">
                                                @error('rpp_4')
                                                    <div class="text-danger mt-2"> {{ $message }} </div>
                                                @enderror
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Pendukung RPP 4</label>
                                                <input type="file" name="pendukung_rpp_4" class="form-control">
                                                @error('pendukung_rpp_4')
                                                    <div class="text-danger mt-2"> {{ $message }} </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label">RPP 5</label>
                                                <input type="file" name="pendukung_rpp_5" class="form-control">
                                                @error('pendukung_rpp_5')
                                                    <div class="text-danger mt-2"> {{ $message }} </div>
                                                @enderror
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Pendukung RPP 5</label>
                                                <input type="file" name="pendukung_rpp_5" class="form-control">
                                                @error('pendukung_rpp_5')
                                                    <div class="text-danger mt-2"> {{ $message }} </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label">RPP 6</label>
                                                <input type="file" name="rpp_6" class="form-control">
                                                @error('rpp_6')
                                                    <div class="text-danger mt-2"> {{ $message }} </div>
                                                @enderror
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Pendukung RPP 6</label>
                                                <input type="file" name="pendukung_rpp_6" class="form-control">
                                                @error('pendukung_rpp_6')
                                                    <div class="text-danger mt-2"> {{ $message }} </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label">RPP 7</label>
                                                <input type="file" name="pendukung_rpp_7" class="form-control">
                                                @error('pendukung_rpp_7')
                                                    <div class="text-danger mt-2"> {{ $message }} </div>
                                                @enderror
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Pendukung RPP 7</label>
                                                <input type="file" name="rpp_7" class="form-control">
                                                @error('rpp_7')
                                                    <div class="text-danger mt-2"> {{ $message }} </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label">RPP 8</label>
                                                <input type="file" name="pendukung_rpp_8" class="form-control">
                                                @error('pendukung_rpp_8')
                                                    <div class="text-danger mt-2"> {{ $message }} </div>
                                                @enderror
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Pendukung RPP 8</label>
                                                <input type="file" name="rpp_8" class="form-control">
                                                @error('rpp_8')
                                                    <div class="text-danger mt-2"> {{ $message }} </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label">RPP 9</label>
                                                <input type="file" name="pendukung_rpp_9" class="form-control">
                                                @error('pendukung_rpp_9')
                                                    <div class="text-danger mt-2"> {{ $message }} </div>
                                                @enderror
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Pendukung RPP 9</label>
                                                <input type="file" name="pendukung_rpp_9" class="form-control">
                                                @error('pendukung_rpp_9')
                                                    <div class="text-danger mt-2"> {{ $message }} </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label">RPP 10</label>
                                                <input type="file" name="rpp_10" class="form-control">
                                                @error('rpp_10')
                                                    <div class="text-danger mt-2"> {{ $message }} </div>
                                                @enderror
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Pendukung RPP 10</label>
                                                <input type="file" name="pendukung_rpp_10" class="form-control">
                                                @error('pendukung_rpp_10')
                                                    <div class="text-danger mt-2"> {{ $message }} </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label">RPP 11</label>
                                                <input type="file" name="rpp_11" class="form-control">
                                                @error('rpp_11')
                                                    <div class="text-danger mt-2"> {{ $message }} </div>
                                                @enderror
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Pendukung RPP 11</label>
                                                <input type="file" name="pendukung_rpp_11" class="form-control">
                                                @error('pendukung_rpp_11')
                                                    <div class="text-danger mt-2"> {{ $message }} </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label">RPP 12</label>
                                                <input type="file" name="rpp_12" class="form-control">
                                                @error('rpp_12')
                                                    <div class="text-danger mt-2"> {{ $message }} </div>
                                                @enderror
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Pendukung RPP 12</label>
                                                <input type="file" name="pendukung_rpp_12" class="form-control">
                                                @error('pendukung_rpp_12')
                                                    <div class="text-danger mt-2"> {{ $message }} </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label">RPP 13</label>
                                                <input type="file" name="rpp_13" class="form-control">
                                                @error('rpp_13')
                                                    <div class="text-danger mt-2"> {{ $message }} </div>
                                                @enderror
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Pendukung RPP 13</label>
                                                <input type="file" name="pendukung_rpp_13" class="form-control">
                                                @error('pendukung_rpp_13')
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
            const steps = ['step1', 'step2', 'step3', 'step4', 'step5'];
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
