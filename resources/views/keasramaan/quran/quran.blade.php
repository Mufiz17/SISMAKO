@extends('layouts.app')

@section('content')
    @include('database.inc.form')
    <div class="py-12">
        <div class="container">
            <div class="row">
                <div class="col-12 row">
                    <div class="mb-4">
                        <a href="/sekolah-keasramaan" class="btn btn-secondary">
                            Back
                        </a>
                    </div>
                    <!-- Card 1 -->
                    <div class="col-md-4">
                        <a href="/sekolah-keasramaan/al-quran/tahfidz" class="text-decoration-none">
                            <div class="card shadow-sm mb-4 hover-shadow" style="background-color:  rgba(255, 0, 0, 0.25);">
                                <div class="card-body d-flex align-items-center">
                                    <img src="{{ asset('dist/img/gif/rub-el-hizb.gif') }}" alt=""
                                        style="width: 50%; height: auto; margin-right: 16px;">
                                    <h2 class="card-title text-xl font-semibold mb-0"
                                        style="font-size: 1.5rem; font-family: 'Poppins', sans-serif; font-weight: bold; color: white;">
                                        Tahfidz
                                    </h2>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-4">
                        <a href="/sekolah-keasramaan/al-quran/tahsin" class="text-decoration-none">
                            <div class="card shadow-sm mb-4 hover-shadow"
                                style="background-color:  rgba(0, 123, 255, 0.25);">
                                <div class="card-body d-flex align-items-center">
                                    <img src="{{ asset('dist/img/gif/recomendation.gif') }}" alt=""
                                        style="width: 50%; height: auto; margin-right: 16px;">
                                    <h2 class="card-title text-xl font-semibold mb-0"
                                        style="font-size: 1.5rem; font-family: 'Poppins', sans-serif; font-weight: bold; color: white;">
                                        Tahsin
                                    </h2>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-4">
                        <a href="/sekolah-keasramaan/al-quran/sertif" class="text-decoration-none">
                            <div class="card shadow-sm mb-4 hover-shadow" style="background-color:  rgba(0, 128, 0, 0.25);">
                                <div class="card-body d-flex align-items-center">
                                    <img src="{{ asset('dist/img/gif/certificate.gif') }}" alt=""
                                        style="width: 50%; height: auto; margin-right: 16px;">
                                    <h2 class="card-title text-xl font-semibold mb-0"
                                        style="font-size: 1.5rem; font-family: 'Poppins', sans-serif; font-weight: bold; color: white;">
                                        Sertifikat
                                    </h2>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
