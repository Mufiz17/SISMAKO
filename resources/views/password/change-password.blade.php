@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <a href="{{ route('home') }}" class="btn btn-secondary mb-4">
            Back
        </a>

        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
                <h5 class="card-title mb-0">Change Password</h5>
            </div>
            <div class="card-body">
                <form id="changePasswordForm" method="POST" action="{{ route('password.update') }}">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="currentPasswordInput" class="form-label">Current Password</label>
                        <input type="password" class="form-control" id="currentPasswordInput" name="current_password"
                               placeholder="Enter your current password" required>
                    </div>

                    <div class="mb-3">
                        <label for="newPasswordInput" class="form-label">New Password</label>
                        <input type="password" class="form-control" id="newPasswordInput" name="new_password"
                               placeholder="Enter your new password" required>
                    </div>

                    <div class="mb-3">
                        <label for="newPasswordConfirmationInput" class="form-label">Confirm New Password</label>
                        <input type="password" class="form-control" id="newPasswordConfirmationInput" name="new_password_confirmation"
                               placeholder="Confirm your new password" required>
                    </div>

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </form>
            </div>
            <div class="card-footer d-flex justify-content-end">
                <button type="submit" form="changePasswordForm" class="btn btn-primary">
                    Submit
                </button>
            </div>
        </div>
    </div>
@endsection