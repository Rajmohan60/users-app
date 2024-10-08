<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-rosybrown">
    <div class="container vh-100 d-flex justify-content-center align-items-center">
        <div class="login-box bg-light shadow rounded p-4">
            <h2 class="text-center">Update Profile</h2>
            <form action="{{ route('profile_update', auth()->user()->id) }}" method="POST">
                @csrf
                @method('PUT') <!-- Use PUT for updates -->

                <!-- Email Address -->
                <div class="mb-3">
                    <label for="email" class="form-label">Email address</label>
                    <input type="email" name="email" class="form-control" id="email" value="{{ auth()->user()->email }}" required>
                    @error('email')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Password -->
                <div class="mb-3">
                    <label for="password" class="form-label">New Password</label>
                    <input type="password" name="password" class="form-control" id="password"
                           pattern="(?=.*[!@#$%^&*])[A-Za-z\d@$!%*?&]{8,}"
                           title="Password must be at least 8 characters long and contain at least one special character." required>
                    @error('password')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Confirm Password -->
                <div class="mb-3">
                    <label for="password_confirmation" class="form-label">Confirm Password</label>
                    <input type="password" name="password_confirmation" class="form-control" id="password_confirmation"
                           pattern="(?=.*[!@#$%^&*])[A-Za-z\d@$!%*?&]{8,}"
                           title="Password must be at least 8 characters long and contain at least one special character." required>
                </div>

                <button type="submit" class="btn btn-primary w-100">Update</button>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
