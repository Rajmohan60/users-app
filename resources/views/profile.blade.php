@extends('layouts.app')

@section('title', 'Profile')

@section('content')
<div class="container mt-5">
    <h2>User Profile</h2>

    <div class="profile">
        <p><strong>First Name:</strong> {{ $profile->first_name }}</p>
        <p><strong>Last Name:</strong> {{ $profile->last_name }}</p>
        <p><strong>Date of Birth:</strong>
            {{ $profile->dob ? \Carbon\Carbon::parse($profile->dob)->format('Y-m-d') : 'N/A' }}
        </p>
        <p><strong>Email:</strong> {{ $profile->email }}</p>
    </div>

    <div class="mt-4">
        <a href="{{ route('user_edit', $profile->id) }}" class="btn btn-warning btn-sm">Edit</a>

        <form action="{{ route('user_delete', $profile->id) }}" method="POST" style="display:inline;">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this user?');">
                Delete
            </button>
        </form>

        <a href="{{ route('user_list') }}" class="btn btn-secondary btn-sm">Back</a>
    </div>
</div>
@endsection
