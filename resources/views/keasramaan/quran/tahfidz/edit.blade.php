@extends('layouts.app')

@section('content')
<div class="py-5">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="col container">
            <div class="row row-cards">
                <div class="col-12">
                    <div class="mb-4 col">
                        <a href="/sekolah-keasramaan/al-quran/tahfidz" class="btn btn-secondary">
                            Back
                        </a>
                    </div>
                    <form class="card" action="{{ route('tahfidz.update', $tahfidz->id) }}" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="card-body">
                            <h3 class="card-title">Data Tambahan</h3>
                            <div class="row row-cards">
                                <div class="col-sm-4 col-md-4">
                                    <div class="mb-3">
                                        <label class="form-label">Tanggal</label>
                                        <input type="date" class="form-control datepicker" placeholder="Masukan Tanggal"
                                            id="datepicker-icon-1" name="tanggal" autocomplete="off"
                                            value="{{ $tahfidz->tanggal }}">
                                    </div>
                                </div>
                                <div class="col-sm-3 col-md-4">
                                    <div class="mb-3">
                                        <label class="form-label">Surat</label>
                                        <input type="text" class="form-control" placeholder="Masukan Surat" name="surat"
                                            value="{{ $tahfidz->surat }}">
                                    </div>
                                </div>
                                <div class="col-sm-3 col-md-4">
                                    <div class="mb-3">
                                        <label class="form-label">Ayat</label>
                                        <input type="text" class="form-control" placeholder="Masukan Ayat" name="ayat"
                                            value="{{ $tahfidz->ayat }}">
                                    </div>
                                </div>
                                <div class="col-sm-3 col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Predikat</label>
                                        <select class="form-control form-select" name="predikat" required>
                                            <option value="">Pilih Predikat Hafalan</option>
                                            <option value="Sempurna" {{ (old('predikat') ?? $tahfidz->predikat) ==
                                                'Sempurna' ? 'selected' : '' }}>Sempurna
                                            </option>
                                            <option value="Baik" {{ (old('predikat') ?? $tahfidz->predikat) == 'Baik' ?
                                                'selected' : '' }}>Baik
                                            </option>
                                            <option value="Cukup" {{ (old('predikat') ?? $tahfidz->predikat) == 'Cukup'
                                                ? 'selected' : '' }}>Cukup
                                            </option>
                                        </select>

                                    </div>
                                </div>
                                <div class="col-sm-3 col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Pengajar</label>
                                        <select class="form-control form-select" name="pengajar" required>
                                            <option value="">Pilih Nama Pengajar</option>
                                            <option value="Ahmad Dahlan" {{ (old('pengajar') ?? $tahfidz->pengajar) ==
                                                'Ahmad Dahlan' ? 'selected' : '' }}>Ahmad Dahlan
                                            </option>
                                            <option value="Ahmad Rifai" {{ (old('pengajar') ?? $tahfidz->pengajar) ==
                                                'Ahmad Rifai' ? 'selected' : '' }}>Ahmad Rifai
                                            </option>
                                            <option value="Ratno Wijaya" {{ (old('pengajar') ?? $tahfidz->pengajar) ==
                                                'Ratno Wijaya' ? 'selected' : '' }}>Ratno Wijaya
                                            </option>
                                            <option value="Diandra (Mentor)" {{ (old('pengajar') ?? $tahfidz->pengajar)
                                                == 'Diandra (Mentor)' ? 'selected' : '' }}>Diandra (Mentor)
                                            </option>
                                            <option value="Hafith (Mentor)" {{ (old('pengajar') ?? $tahfidz->pengajar)
                                                == 'Hafith (Mentor)' ? 'selected' : '' }}>Hafith (Mentor)
                                            </option>
                                            <option value="Akram (Mentor)" {{ (old('pengajar') ?? $tahfidz->pengajar) ==
                                                'Akram (Mentor)' ? 'selected' : '' }}>Akram (Mentor)a
                                            </option>
                                            <option value="Zainul (Mentor)" {{ (old('pengajar') ?? $tahfidz->pengajar)
                                                == 'Zainul (Mentor)' ? 'selected' : '' }}>Zainul (Mentor)
                                            </option>
                                        </select>
                                        @error('pengajar')
                                        <div class="text-danger mt-2"> {{ $message }} </div>
                                        @enderror
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="card-footer text-end">
                            <button type="submit" class="btn btn-success" id="submitButton">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
