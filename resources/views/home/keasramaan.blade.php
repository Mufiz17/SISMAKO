@extends('layouts.app')

@section('content')
    @include('database.inc.form')

    <div class="py-12">
        <div class="container">
            <div class="row">
                <!-- Card 1 -->
                <div class="col-md-4 modals">
                    <a href="/jamaah" class="text-decoration-none">
                    {{-- <a href="#" class="text-decoration-none" data-bs-toggle="modal" data-bs-target="#passwordModal"
                        data-url="/jamaah"> --}}
                        <div class="card shadow-sm mb-4 hover-shadow" style="background-color:  rgba(0, 128, 0, 0.25);">
                            <div class="card-body d-flex align-items-center">
                                <img src="{{ asset('dist/img/gif/windows.gif') }}" alt=""
                                    style="width: 50%; height: auto; margin-right: 16px;">
                                <h2 class="card-title text-xl font-semibold mb-0"
                                    style="font-size: 1.5rem; font-family: 'Poppins', sans-serif; font-weight: bold; color: white;">
                                    Sholat Berjamaah
                                </h2>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-4 modals">
                    <a href="/patroli/asrama" class="text-decoration-none">
                    {{-- <a href="#" class="text-decoration-none" data-bs-toggle="modal" data-bs-target="#passwordModal"
                        data-url="/patroli/asrama"> --}}
                        <div class="card shadow-sm mb-4 hover-shadow" style="background-color:rgba(0, 123, 255, 0.25);">
                            <div class="card-body d-flex align-items-center">
                                <img src="{{ asset('dist/img/gif/search.gif') }}" alt=""
                                    style="width: 50%; height: auto; margin-right: 16px;">
                                <h2 class="card-title text-xl font-semibold mb-0"
                                    style="font-size: 1.5rem; font-family: 'Poppins', sans-serif; font-weight: bold; color: white;">
                                    Patroli
                                </h2>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-4">
                    <a href="sekolah-keasramaan/akademik" class="text-decoration-none">
                        <div class="card shadow-sm mb-4 hover-shadow" style="background-color: rgba(255, 0, 0, 0.25);">
                            <div class="card-body d-flex align-items-center">
                                <img src="{{ asset('dist/img/gif/education.gif') }}" alt=""
                                    style="width: 50%; height: auto; margin-right: 16px;">
                                <h2 class="card-title text-xl font-semibold mb-0"
                                    style="font-size: 1.5rem; font-family: 'Poppins', sans-serif; font-weight: bold; color: white;">
                                    Akademik
                                </h2>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-4">
                    <a href="sekolah-keasramaan/al-quran" class="text-decoration-none">
                        <div class="card shadow-sm mb-4 hover-shadow" style="background-color:  rgba(0, 128, 0, 0.25);">
                            <div class="card-body d-flex align-items-center">
                                <img src="{{ asset('dist/img/gif/al-quran.gif') }}" alt=""
                                    style="width: 50%; height: auto; margin-right: 16px;">
                                <h2 class="card-title text-xl font-semibold mb-0"
                                    style="font-size: 1.5rem; font-family: 'Poppins', sans-serif; font-weight: bold; color: white;">
                                    Al-Qur'an
                                </h2>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-4">
                    <a href="sekolah-keasramaan/jurnal-asrama" class="text-decoration-none">
                        <div class="card shadow-sm mb-4 hover-shadow" style="background-color:rgba(0, 123, 255, 0.25);">
                            <div class="card-body d-flex align-items-center">
                                <img src="{{ asset('dist/img/gif/journal.gif') }}" alt=""
                                    style="width: 50%; height: auto; margin-right: 16px;">
                                <h2 class="card-title text-xl font-semibold mb-0"
                                    style="font-size: 1.5rem; font-family: 'Poppins', sans-serif; font-weight: bold; color: white;">
                                    Jurnal Asrama
                                </h2>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="passwordModal" tabindex="-1" aria-labelledby="passwordModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="passwordModalLabel">Enter Password</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="passwordForm">
                        <div class="mb-3">
                            <label for="passwordInput" class="form-label">Password</label>
                            <input type="password" class="form-control" id="passwordInput"
                                placeholder="Enter your password">
                        </div>
                        <div id="passwordError" class="alert alert-danger d-none" role="alert">
                            Password salah. Silakan coba lagi.
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="submitPassword">Submit</button>
                </div>
            </div>
        </div>
    </div>
@endsection
