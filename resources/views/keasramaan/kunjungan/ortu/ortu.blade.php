@extends('layouts.app')

@section('content')

<div class="py-5">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="container">
            <div class="col-12">
                <div class="mb-4">
                    <div class="col-12 row">
                        <div class="mb-4 col">
                            <a href="/sekolah-keasramaan/kunjungan" class="btn btn-secondary">
                                Back
                            </a>
                        </div>
                        <div class="mb-4 col d-flex justify-content-end">
                            <a href="{{ route('ortu.create') }}" class="btn btn-primary">
                                Tambah
                            </a>
                        </div>
                        <!-- Form Filter -->
                        <form method="GET" action="{{ route('ortu') }}" class="mb-4">
                            <div class="row">
                                <div class="col-12 col-md-3 mb-2 mb-md-0">
                                    <input type="date" name="start_date" class="form-control" placeholder="Start Date">
                                </div>
                                <div class="col-12 col-md-3 mb-2 mb-md-0">
                                    <input type="date" name="end_date" class="form-control" placeholder="End Date">
                                </div>
                                <div class="col-12 col-md-2">
                                    <button type="submit" class="btn btn-success">Filter</button>
                                </div>
                            </div>
                        </form>
                        @if (session('success'))
                        <div class="alert alert-important alert-success alert-dismissible" role="alert">
                            <div class="d-flex">
                                <div>
                                    <!-- Download SVG icon from http://tabler-icons.io/i/check -->
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" class="icon alert-icon">
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
                        @endif
                    </div>
                </div>
                <div class="card">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Tanggal</th>
                                    <th>Nama</th>
                                    <th>asal</th>
                                    <th>Tujuan</th>
                                    <th>Keterangan</th>
                                    <th>Nomor Handphone</th>
                                    <th>Jam Kedatangan</th>
                                    <th>Jam Kepulangan</th>
                                    <th></th>
                                    <th></th>
                            </thead>
                            <tbody>
                                @php
                                $i = 1;
                                @endphp
                                @forelse ($ortu as $item)
                                <tr>
                                    <td>{{ $item->tanggal }}</td>
                                    <td>{{ $item->nama }}</td>
                                    <td>{{ $item->asal }}</td>
                                    <td>{{ $item->tujuan }}</td>
                                    <td>{{ $item->keterangan }}</td>
                                    <td>{{ $item->no_hp }}</td>
                                    <td>{{ $item->start }}</td>
                                    <td>{{ $item->end }}</td>
                                    <td>
                                        <a href="#" class="text-decoration-none" data-bs-toggle="modal"
                                            data-bs-target="#passwordModal-{{ $item->id }}">
                                            <i
                                                class="fa-regular fa-pen-to-square text-white text-xl bg-yellow p-2 rounded"></i>
                                        </a>
                                    </td>
                                    <td>
                                        <a href="#" data-bs-toggle="modal"
                                            data-bs-target="#modal-danger-{{ $item->id }}">
                                            <i class="far fa-trash-alt text-white text-xl bg-red p-2 rounded"></i>
                                        </a>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="10" class="text-center">
                                        Tidak ada Data
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="d-flex justify-content-center mt-4">
                        {{ $ortu->appends(request()->input())->links('vendor.pagination.bootstrap-5') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Danger Modal --}}
@foreach ($ortu as $item)
<form action="{{ route('kunjungan.industri.delete', $item->id) }}" method="post">
    @csrf
    @method('DELETE')
    <div class="modal modal-blur fade" id="modal-danger-{{ $item->id }}" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
            <div class="modal-content">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="modal-status bg-danger"></div>
                <div class="modal-body text-center py-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon mb-2 text-danger icon-lg" width="24" height="24"
                        viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                        stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                        <path d="M12 9v4"></path>
                        <path
                            d="M10.363 3.591l-8.106 13.534a1.914 1.914 0 0 0 1.636 2.871h16.214a1.914 1.914 0 0 0 1.636 -2.87l-8.106 -13.536a1.914 1.914 0 0 0 -3.274 0z">
                        </path>
                        <path d="M12 16h.01"></path>
                    </svg>
                    <h3>Are you sure?</h3>
                    <div class="text-secondary">Do you really want to remove this files? What you've done cannot
                        be
                        undone.</div>
                </div>
                <div class="modal-footer">
                    <div class="w-100">
                        <div class="row">
                            <div class="col"><a href="#" class="btn w-100" data-bs-dismiss="modal">
                                    Cancel
                                </a>
                            </div>
                            <div class="col">
                                <button href="#" type="submit" class="btn btn-danger w-100" data-bs-dismiss="modal">
                                    Delete
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
@endforeach

{{-- Password Modal --}}
@foreach ($ortu as $item)
<div class="modal fade" id="passwordModal-{{ $item->id }}" tabindex="-1" aria-labelledby="passwordModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="passwordModalLabel">Enter Password</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="passwordForm-{{ $item->id }}" onsubmit="return false;">
                    <div class="mb-3">
                        <label for="passwordInput-{{ $item->id }}" class="form-label">Password</label>
                        <input type="password" class="form-control" id="passwordInput-{{ $item->id }}"
                            placeholder="Enter your password">
                    </div>
                    <div id="passwordError-{{ $item->id }}" class="alert alert-danger d-none" role="alert">
                        Password salah. Silakan coba lagi.
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="submitPassword-{{ $item->id }}"
                    onclick="checkPassword({{ $item->id }})">Submit</button>
            </div>
        </div>
    </div>
</div>
@endforeach

{{-- Password Logic --}}
<script>
    // Function to check password and redirect if correct
function checkPassword(id) {
    var passwordInput = document.getElementById('passwordInput-' + id);
    var password = passwordInput.value;
    var correctPassword = '140721'; // Replace with the correct password if needed

    if (password === correctPassword) {
        // Password correct, redirect to the edit page
        window.location.href = '/sekolah-keasramaan/kunjungan/alumniOrtuTamu/edit/' + id;
    } else {
        // Show error message
        document.getElementById('passwordError-' + id).classList.remove('d-none');
        passwordInput.focus(); // Refocus the input if password is wrong
    }
}
</script>

@endsection
