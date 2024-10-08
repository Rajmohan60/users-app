@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Welcome to the Home Page</h1>

        <p>You are logged in as <strong>{{ Auth::user()->name }}</strong>.</p>

        <div class="links">
            <a href="{{ route('user_list') }}">User List</a>
            <a href="{{ route('logout') }}">Logout</a>
        </div>
    </div>
@endsection
