@extends('layouts.app')

@section('content')
<div class="container py-5 bg-white my-5 rounded">
    <div class="row">
        <div class="col-md-6">
            <h2 class="h1 font-weight-bold text-dark">Enter Password</h2>
            <p class="mt-3 text-muted">
                Please enter your password to proceed.
            </p>
        </div>

        <div class="col-md-6">
            <form action="{{ route('checkPw') }}" method="POST">
                @csrf
                <div class="input-group">
                    <input type="password" class="form-control me-3" id="exampleInputPassword1" name="password"
                        placeholder="Enter your password" aria-label="Enter your password"
                        aria-describedby="button-addon2" autofocus style="max-width: 500px;">
                    <button class="btn btn-primary rounded" type="submit" id="button-addon2">Submit</button>
                </div>
                <input type="hidden" name="redirect_url" value="{{ request('redirect_url') }}">
                <p class="mt-3 text-muted">
                    No spam, unsubscribe at any time.
                </p>
                <a href="/" class="btn btn-secondary mt-2" id="backButton">Back</a>
            </form>
        </div>
    </div>
</div>
<script>
    document.getElementById('backButton').addEventListener('click', function(event) {
        event.preventDefault(); // Mencegah perilaku default tombol back
        const currentUrl = window.location.pathname;

        // Daftar URL yang akan mengarah ke /sekolah-keasramaan
        const specialUrls = ['/jamaah', '/patroli/asrama', '/sekolah-keasramaan/akses-lab'];

        if (specialUrls.includes(currentUrl)) {
            // Arahkan ke /sekolah-keasramaan jika match
            window.location.href = '/sekolah-keasramaan';
        } else {
            // Arahkan ke halaman sebelumnya jika tidak match
            window.history.back();
        }
    });
</script>
@endsection
