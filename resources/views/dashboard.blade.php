@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <div class="container centered-container">
        <div class="dashboard-box text-center">
            <h2>Welcome to your Dashboard</h2>
            <p>You have successfully logged in.</p>

            <form action="{{ route('logout') }}" method="POST">
                @csrf
                {{-- <button type="submit" class="btn btn-danger">Logout</button> --}}
            </form>
        </div>
    </div>
@endsection
