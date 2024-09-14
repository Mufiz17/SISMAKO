@extends('layouts.app')

@section('content')
    @include('database.inc.form')

    <div class="py-5">
        <div class="container">
            <div class="row">
                @php
                    $cards = [
                        [
                            'url' => 'administrasi-keguruan/mapel',
                            'img' => 'mapel-unscreen.gif',
                            'title' => 'Mata Pelajaran',
                            'bg' => 'bg-danger',
                        ],
                        [
                            'url' => '#',
                            'img' => 'bk-unscreen.gif',
                            'title' => 'Bimbingan Konseling',
                            'bg' => 'bg-danger',
                        ],
                        [
                            'url' => 'administrasi-keguruan/kepalaLabKom',
                            'img' => 'lab-unscreen.gif',
                            'title' => 'Kepala LABKOM',
                            'bg' => 'bg-danger',
                        ],
                        [
                            'url' => 'administrasi-keguruan/osis',
                            'img' => 'student-unscreen.gif',
                            'title' => 'OSIS SMK',
                            'bg' => 'bg-primary',
                        ],
                        [
                            'url' => 'administrasi-keguruan/perpustakaan',
                            'img' => 'shelves-unscreen.gif',
                            'title' => 'Library',
                            'bg' => 'bg-primary',
                        ],
                        [
                            'url' => 'administrasi-keguruan/walas',
                            'img' => 'professor-unscreen.gif',
                            'title' => 'Wali Kelas',
                            'bg' => 'bg-primary',
                        ],
                        [
                            'url' => 'administrasi-keguruan/kepsek',
                            'img' => 'headmaster-unscreen.gif',
                            'title' => 'Kepala Sekolah',
                            'bg' => 'bg-primary',
                        ],
                        [
                            'url' => 'administrasi-keguruan/waka-kurikulum',
                            'img' => 'approved-unscreen.gif',
                            'title' => 'Waka Kurikulum',
                            'bg' => 'bg-success',
                        ],
                        [
                            'url' => 'administrasi-keguruan/waka-kesiswaan',
                            'img' => 'kesiswaan-unscreen.gif',
                            'title' => 'Waka Kesiswaan',
                            'bg' => 'bg-success',
                        ],
                        [
                            'url' => 'administrasi-keguruan/supervisi',
                            'img' => 'supervisi-unscreen.gif',
                            'title' => 'Supervisi',
                            'bg' => 'bg-success',
                        ],
                    ];
                @endphp

                @foreach ($cards as $card)
                    <div class="col-md-{{ in_array($loop->iteration, [4, 5, 6, 7]) ? 3 : 4 }}">
                        <a href="{{ $card['url'] }}" class="text-decoration-none">
                            <div class="card {{ $card['bg'] }} shadow-sm mb-4">
                                <div class="card-body d-flex align-items-center">
                                    <img src="{{ asset('dist/img/gif/' . $card['img']) }}" alt=""
                                        class="img-fluid me-3" style="width: 50%; height: auto;">
                                    <h2 class="card-title text-white" style="font-size: 1.5rem; font-weight: bold;">
                                        {{ $card['title'] }}</h2>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
