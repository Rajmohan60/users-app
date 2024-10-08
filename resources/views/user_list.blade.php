@extends('layouts.app')

@section('title', 'User.list')

@section('content')
<div class="container mt-5">
    <h2 class="text-center mb-4">User List</h2>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- Button to Create New User (Top Left) -->
    <div class="d-flex justify-content-start mb-3">
        <a href="{{ route('user_create') }}" class="btn btn-success">Create New User</a>
    </div>

    <!-- Search Section -->
    <div class="search-container text-center mb-3">
        <div id="search-bar" style="display: none;" class="input-group">
            <input type="text" id="search-input" class="form-control" placeholder="Search by name...">
            <button id="search-button" class="btn btn-primary">Search</button>
        </div>
    </div>

     <!-- Export Button -->
     <div class="d-flex justify-content-start mb-3">
        <a href="{{ route('export.users') }}" class="btn btn-success">Export Users to Excel</a>
    </div>

    <!-- User List Table -->
    <table class="table" id="tableuser">
        <thead>
            <tr>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Date of Birth</th>
                <th>Email</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody id="user-table-body">
            @foreach($users as $profile)
            <tr>
                <td>{{ $profile->first_name }}</td>
                <td>{{ $profile->last_name }}</td>
                <td>{{ $profile->dob ? $profile->dob->format('d-m-Y') : 'N/A' }}</td>
                <td>{{ $profile->email }}</td>
                <td>
                    <a href="{{ route('user_edit', $profile->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <a href="{{ route('profile_show', $profile->id) }}" class="btn btn-primary">View</a>
                    <form action="{{ route('user_delete', $profile->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this user?');">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Success Message Modal -->
    <div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="successModalLabel">Success</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    User created successfully!
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.datatables.net/2.1.7/js/dataTables.js"></script>
<script src="https://cdn.datatables.net/2.1.7/js/dataTables.bootstrap5.js"></script>

<script>
$(document).ready(function() {
    new DataTable('#tableuser');

    // Show the success modal if the session variable is set
    @if(session('user_created'))
        $('#successModal').modal('show');
    @endif

    // Existing search functionality...
    $('#search-button').click(function() {
        var searchQuery = $('#search-input').val().toLowerCase();
        $('#user-table-body tr').filter(function() {
            $(this).toggle($(this).children('td:first').text().toLowerCase().indexOf(searchQuery) > -1);
        });
    });

    $('#search-input').on('input', function() {
        $('#search-button').click(); // Trigger search on input change
    });
});
</script>
@endsection
