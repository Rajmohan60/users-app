@extends('layouts.app')

@section('title', 'user_edit')

@section('content')
<div class="container mt-5">
    <h2>Edit Profile</h2>

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

    <form id="editProfileForm" action="{{ route('user_update', $user->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="first_name" class="form-label">First Name</label>
            <input type="text" class="form-control" id="first_name" name="first_name" value="{{ old('first_name', '') }}" required>
            <div class="invalid-feedback">First name is required.</div>
        </div>

        <div class="mb-3">
            <label for="last_name" class="form-label">Last Name</label>
            <input type="text" class="form-control" id="last_name" name="last_name" value="{{ old('last_name', '') }}" required>
            <div class="invalid-feedback">Last name is required.</div>
        </div>

        <div class="mb-3">
            <label for="dob" class="form-label">Date of Birth</label>
            <input type="date" class="form-control" id="dob" name="dob" value="{{ old('dob', optional('')->format('Y-m-d')) }}" max="{{ date('Y-m-d', strtotime('-18 years')) }}" required>
            <div class="invalid-feedback">Valid date of birth is required.</div>
            <div id="ageError" class="text-danger" style="display: none;">You must be at least 18 years old.</div>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ old('email', '') }}" required>
            <div class="invalid-feedback">A valid email address is required.</div>
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password" placeholder="Leave blank to keep current password">
            <div class="invalid-feedback">Password must be at least 8 characters long.</div>
        </div>

        <div class="mb-3">
            <label for="password_confirmation" class="form-label">Confirm Password</label>
            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Leave blank to keep current password">
            <div class="invalid-feedback">Passwords must match.</div>
        </div>

        <button type="submit" class="btn btn-primary">Update Profile</button>
        <a href="{{ route('user_list') }}" class="btn btn-secondary">Back</a>

    </form>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
    const form = document.getElementById('editProfileForm');
    const requiredFields = ['first_name', 'last_name', 'dob', 'email'];
    const password = document.getElementById('password');
    const passwordConfirmation = document.getElementById('password_confirmation');
    const email = document.getElementById('email');
    const dobInput = document.getElementById('dob');
    const ageError = document.getElementById('ageError');

    // Function to validate required fields
    function validateRequiredField(input) {
        if (input.value.trim() === '') {
            input.classList.add('is-invalid');
            return false;
        } else {
            input.classList.remove('is-invalid');
            return true;
        }
    }

    // Validate each required field on input
    requiredFields.forEach(function(field) {
        const input = document.getElementById(field);
        input.addEventListener('input', function() {
            validateRequiredField(input);
        });
    });

    // Email validation
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
        if (password.value && password.value.length < 8) {
            password.classList.add('is-invalid');
        } else {
            password.classList.remove('is-invalid');
        }
    });

    // Password confirmation validation
    passwordConfirmation.addEventListener('input', function() {
        if (passwordConfirmation.value && password.value !== passwordConfirmation.value) {
            passwordConfirmation.classList.add('is-invalid');
        } else {
            passwordConfirmation.classList.remove('is-invalid');
        }
    });

    // Form submission validation
    form.addEventListener('submit', function(event) {
        let formIsValid = true;

        // Validate required fields
        requiredFields.forEach(function(field) {
            const input = document.getElementById(field);
            if (!validateRequiredField(input)) {
                formIsValid = false;
            }
        });

        // Email validation
        const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailPattern.test(email.value)) {
            email.classList.add('is-invalid');
            formIsValid = false;
        }

        // Password validation (if entered)
        if (password.value && password.value.length < 8) {
            password.classList.add('is-invalid');
            formIsValid = false;
        }

        // Password confirmation validation
        if (password.value && password.value !== passwordConfirmation.value) {
            passwordConfirmation.classList.add('is-invalid');
            formIsValid = false;
        }

        // Prevent form submission if validation fails
        if (!formIsValid) {
            event.preventDefault(); // Stop form submission
        }

        // Clear password fields if left empty
        if (password.value === '' && passwordConfirmation.value === '') {
            password.value = '';
            passwordConfirmation.value = '';
        }
    });
});
    </script>
</div>
@endsection
