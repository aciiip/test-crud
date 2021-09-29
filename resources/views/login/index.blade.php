@extends('layouts.main')

@section('title', 'Login')

@section('main')
    <div style="width: 100vw; height: 100vh; display: flex; justify-content: center; align-items: center; background-color: dodgerblue; flex-direction: column;">
        @if(\Illuminate\Support\Facades\Session::has('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{\Illuminate\Support\Facades\Session::get('error')}}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif
        <div class="card p-4">
            <form method="post" action="{{route('loginAction')}}">
                {{ csrf_field() }}
                <div style="padding-bottom: 10px;">
                    <h3 style="margin: 0; text-align: center">Login</h3>
                </div>
                <div style="margin-top: 25px">
                    <input class="form-control" required name="username" placeholder="Username" style="width: 300px;" />
                </div>
                <div style="margin-top: 20px">
                    <input class="form-control" required name="password" placeholder="Password" type="password" />
                </div>
                <div style="margin-top: 30px">
                    <button style="width: 100%;" class="btn btn-primary">Login</button>
                </div>
            </form>
        </div>
    </div>
@endsection
