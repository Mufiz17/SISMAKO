@extends('layouts.app')

@section('content')
<livewire:layout.header />
<div class="card">
    <div class="py-6" style="background-image: url('dist/img/gif/bg.png'); background-size: cover; min-height: 92vh;">
        <div class="container ">
            <div class="row d-flex justify-content-center">
                <style>
                    .hover-shadow:hover {
                        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
                    }

                    .card-body img {
                        max-width: 40%;
                        height: auto;
                    }

                    .card-title {
                        font-size: 1.25rem;
                        font-family: 'Poppins', sans-serif;
                        font-weight: bold;
                        color: white;
                    }

                    .img-custom {
                        max-width: 40%;
                        height: auto;
                        margin-right: 12px;
                    }

                    .card-custom {
                        background-color: rgba(0, 123, 255, 0.25);
                    }

                    .card-custom-red {
                        background-color: rgba(255, 0, 0, 0.25);
                    }

                    .card-custom-green {
                        background-color: rgba(0, 128, 0, 0.25);
                    }
                </style>

                @php
                $cards = [
                [
                'url' => '/database',
                'img' => 'dist/img/gif/protection.gif',
                'title' => 'Database',
                'color' => 'card-custom',
                ],
                [
                'url' => '/korespondensi',
                'img' => 'dist/img/gif/passport.gif',
                'title' => 'Korespondensi',
                'color' => 'card-custom',
                ],
                [
                'url' => '/administrasi',
                'img' => 'dist/img/gif/files.gif',
                'title' => 'Administrasi',
                'color' => 'card-custom-red',
                ],
                [
                'url' => '/penilaian',
                'img' => 'dist/img/gif/passed.gif',
                'title' => 'Penilaian',
                'color' => 'card-custom',
                ],
                [
                'url' => '/sarpras',
                'img' => 'dist/img/gif/school.gif',
                'title' => 'Sarpras',
                'color' => 'card-custom-red',
                ],
                [
                'url' => '/finance',
                'img' => 'dist/img/gif/dollar.gif',
                'title' => 'Keuangan',
                'color' => 'card-custom-green',
                ],
                [
                'url' => '/pkg',
                'img' => 'dist/img/gif/360-feedback.gif',
                'title' => 'Penilaian Kinerja Guru (PKG)',
                'color' => 'card-custom-red',
                ],
                [
                'url' => '/sekolah-keasramaan',
                'img' => 'dist/img/gif/quran.gif',
                'title' => 'Sekolah dan Keasramaan',
                'color' => 'card-custom-green',
                ],
                ];
                @endphp

                @foreach ($cards as $card)
                <div class="col-12 col-sm-6 col-md-4 text-center">
                    <a href="{{ route('pin', ['redirect_url' => $card['url']]) }}" class="text-decoration-none">
                        <div class="card shadow-sm mb-4 hover-shadow {{ $card['color'] }}">
                            <div class="card-body d-flex align-items-center justify-content-center">
                                <img src="{{ asset($card['img']) }}" alt="" class="img-fluid img-custom">
                                <h2 class="card-title">{{ $card['title'] }}</h2>
                            </div>
                        </div>
                    </a>
                </div>
                @endforeach

                <div class="col-12 col-sm-6 col-md-4 text-center">
                    <a href="{{ route('created-by') }}" class="text-decoration-none">
                        <div class="card shadow-sm mb-4 hover-shadow" style="background-color: rgba(0, 128, 0, 0.25);">
                            <div class="card-body d-flex align-items-center justify-content-center">
                                <img src="{{ asset('dist/img/gif/management-consulting.gif') }}" alt=""
                                    class="img-fluid img-custom">
                                <h2 class="card-title">Created By</h2>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
