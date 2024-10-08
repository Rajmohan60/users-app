@extends('layouts.app')

@section('title', 'Create User')

@section('content')
<div class="container mt-5">
    <h2>Create User</h2>

    <!-- Display validation errors -->
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form id="createUserForm" action="{{ route('user_store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="first_name" class="form-label">First Name</label>
            <input type="text" class="form-control @error('first_name') is-invalid @enderror" id="first_name" name="first_name" value="{{ old('first_name') }}" required>
            <div class="invalid-feedback">First name is required.</div>
        </div>

        <div class="mb-3">
            <label for="last_name" class="form-label">Last Name</label>
            <input type="text" class="form-control @error('last_name') is-invalid @enderror" id="last_name" name="last_name" value="{{ old('last_name') }}" required>
            <div class="invalid-feedback">Last name is required.</div>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" required>
            <div class="invalid-feedback">A valid email address is required.</div>
        </div>

        <div class="mb-3">
            <label for="dob" class="form-label">Date of Birth</label>
            <input type="date" class="form-control" id="dob" name="dob" value="{{ old('dob', optional('dob')->format('Y-m-d')) }}" max="{{ date('Y-m-d', strtotime('-18 years')) }}" required>
            <div class="invalid-feedback">Valid date of birth is required.</div>
            <div id="ageError" class="text-danger" style="display: none;">You must be at least 18 years old.</div>
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" required>
            <div class="invalid-feedback">Password must be at least 8 characters long.</div>
        </div>

        <div class="mb-3">
            <label for="password_confirmation" class="form-label">Confirm Password</label>
            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
            <div id="confirm-password-error" class="invalid-feedback" style="display:none;">
                Passwords must match.
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Create User</button>
        <a href="{{ route('user_list') }}" class="btn btn-secondary">Back</a>
    </form>
    <script>
      document.addEventListener("DOMContentLoaded", function() {
        const form = document.getElementById('createUserForm');
        const requiredFields = ['first_name', 'last_name', 'dob', 'email', 'password', 'password_confirmation'];
        const password = document.getElementById('password');
        const passwordConfirmation = document.getElementById('password_confirmation');
        let isValid = true;

        // Function to validate required fields
        requiredFields.forEach(function(field) {
            const input = document.getElementById(field);
            input.addEventListener('input', function() {
                if (input.value.trim() === '') {
                    input.classList.add('is-invalid');
                } else {
                    input.classList.remove('is-invalid');
                }
            });
        });

        // Email validation
        const email = document.getElementById('email');
        email.addEventListener('input', function() {
            const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailPattern.test(email.value)) {
                email.classList.add('is-invalid');
            } else {
                email.classList.remove('is-invalid');
            }
        });

        // Password validation
        password.addEventListener('input', function() {
            const hasSpecialCharacter = /[!@#$%^&*(),.?":{}|<>]/.test(password.value);
            if (password.value.length < 8 || !hasSpecialCharacter) {
                password.classList.add('is-invalid');
            } else {
                password.classList.remove('is-invalid');
            }
        });

        // Password confirmation validation on input
        passwordConfirmation.addEventListener('input', function() {
            if (this.value !== password.value) {
                this.classList.add('is-invalid');
                document.getElementById('confirm-password-error').style.display = 'block';
            } else {
                this.classList.remove('is-invalid');
                document.getElementById('confirm-password-error').style.display = 'none';
            }
        });

        // Form submission validation
        form.addEventListener('submit', function(event) {
            isValid = true;

            // Validate all required fields
            requiredFields.forEach(function(field) {
                const input = document.getElementById(field);
                if (input.value.trim() === '') {
                    input.classList.add('is-invalid');
                    isValid = false; // Mark form as invalid if any required field is empty
                } else {
                    input.classList.remove('is-invalid');
                }
            });

            // Validate password confirmation
            if (passwordConfirmation.value !== password.value) {
                passwordConfirmation.classList.add('is-invalid');
                document.getElementById('confirm-password-error').style.display = 'block';
                isValid = false; // Mark form as invalid if passwords do not match
            }

            // If the form is not valid, prevent submission
            if (!isValid) {
                event.preventDefault();
            }
        });
    });
    </script>
</div>
@endsection
