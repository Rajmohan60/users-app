<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.7/css/dataTables.bootstrap5.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

    <style>
        body {
            background-color: rgb(185, 203, 211);
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }
        .navbar-brand {
            font-size: 40px;
            font-weight: bold;
            font-family: 'Courier New', Courier, monospace;
        }
        .navbar {
            display: flex;
            justify-content: center;
            position: relative;
        }
        .profile-icon {
            position: absolute;
            right: 20px;
            top: 10px;
            font-size: 1.5rem;
            display: flex;
            align-items: center;
        }
        .sidebar {
            min-height: calc(100vh - 56px);
            background-color: white;
        }
        .content-wrapper {
            padding: 20px;
        }
        .footer {
            text-align: center;
            background-color: #343a40;
            color: white;
            padding: 10px 0;
            margin-top: auto;
        }
    </style>
</head>
<body>
    <!-- Header -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand">Application</a>
        <div class="profile-icon dropdown">
            <a class="nav-link dropdown-toggle text-white" href="#" id="profileDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="fas fa-user-circle"></i>
            </a>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="profileDropdown">
                <li>
                    @if(auth()->check())
                      <a class="dropdown-item" href="{{ route('user_edit', auth()->user()->id) }}">Update Profile</a>
                    @endif
                </li>
                <li><hr class="dropdown-divider"></li>
                <li>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="dropdown-item">Logout</button>
                    </form>
                </li>
            </ul>
        </div>
    </nav>
    <div class="container-fluid flex-grow-1">
        {{-- <div class="row"> --}}
            <!-- Left Sidebar Menu -->
            {{-- <div class="col-md-2 sidebar p-4"> --}}
                {{-- <h5>Menu</h5> --}}
                {{-- <a href="{{ route('user.list') }}" class="text-black text-decoration-none py-2 d-block">User List</a> --}}
                {{-- <a href="{{ route('create_user') }}" class="text-black text-decoration-none py-2 d-block">Create New User</a> --}}
                {{-- <a href="{{ route('profile') }}" class="text-black text-decoration-none py-2 d-block">Profile</a> --}}
                {{-- <a href="{{ route('login') }}" class="text-black text-decoration-none py-2 d-block">Logout</a> --}}
            {{-- </div> --}}

            <!-- Main Content -->
            <div class="col-md-10 content-wrapper">
                {{-- <div class="dashboard-box bg-light shadow rounded p-4"> --}}
                    @yield('content') <!-- Place for dynamic content -->
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="footer">
        <p>User Details</p>
    </footer>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <!-- jQuery for any additional script needs -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</body>
</html>
