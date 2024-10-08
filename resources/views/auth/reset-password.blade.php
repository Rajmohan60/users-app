@extends('layouts.blanks')

@section('content')
<div class="container" style="max-width: 400px; padding: 20px; border: 1px solid #ddd; border-radius: 10px;background-color: white;">
    <h2>Reset Password</h2>

    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif

    @if ($errors->has('token'))
        <div class="alert alert-danger" role="alert">
            {{ $errors->first('token') }}
        </div>
    @endif

    <form action="{{ route('password.update') }}" method="POST" id="resetPasswordForm">
        @csrf
        <input type="hidden" name="token" value="{{ $token }}">

        <div class="mb-3">
            <label for="email" class="form-label">Email address</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ old('email', '') }}" required>
            <div class="invalid-feedback">Please enter a valid email address.</div>
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">New Password</label>
            <input type="password" class="form-control" id="password" name="password" required minlength="8">
            <div class="invalid-feedback">
                Password must be at least 8 characters long and contain at least one special character.
            </div>
        </div>

        <div class="mb-3">
            <label for="password_confirmation" class="form-label">Confirm Password</label>
            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
            <div class="invalid-feedback">Passwords do not match.</div>
        </div>

        <button type="submit" class="btn btn-primary">Reset Password</button>
    </form>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('resetPasswordForm');
    const emailInput = document.getElementById('email');
    const passwordInput = document.getElementById('password');
    const passwordConfirmationInput = document.getElementById('password_confirmation');

    form.addEventListener('submit', function (event) {
        let valid = true;

        const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailPattern.test(emailInput.value)) {
            emailInput.classList.add('is-invalid');
            valid = false;
        } else {
            emailInput.classList.remove('is-invalid');
        }

        const passwordPattern = /^(?=.*[!@#$%^&*()])[A-Za-z\d!@#$%^&*()]{8,}$/;
        if (!passwordPattern.test(passwordInput.value)) {
            passwordInput.classList.add('is-invalid');
            valid = false;
        } else {
            passwordInput.classList.remove('is-invalid');
        }

        if (passwordInput.value !== passwordConfirmationInput.value) {
            passwordConfirmationInput.classList.add('is-invalid');
            valid = false;
        } else {
            passwordConfirmationInput.classList.remove('is-invalid');
        }

        if (!valid) {
            event.preventDefault();
        }
    });
});
</script>
@endsection
