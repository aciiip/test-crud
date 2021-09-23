@extends('layouts.main')

@section('main')
    <div class="container-fluid" style="display: flex; justify-content: space-between; align-items: center">
        <a href="{{route('home')}}">
            <h1 style="margin: 0">Test Crud</h1>
        </a>
        <a href="{{route('logout')}}">
            Logout
        </a>
    </div>
    <div>
        @yield('content')
    </div>
@endsection
