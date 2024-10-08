@extends('layouts.blanks')

@section('content')
<div class="d-flex justify-content-center align-items-center vh-100">
    <div class="border rounded shadow" style="width: 350px; min-height: 250px; padding: 20px; overflow: hidden ;background-color: white;">
        <h2 class="text-center">Forgot Password</h2>

        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif

        <form action="{{ route('password.email') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="email" class="form-label">Email address</label>
                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" required>
                @error('email')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary w-100">Send Password Reset Link</button>
        </form>
    </div>
</div>
@endsection
