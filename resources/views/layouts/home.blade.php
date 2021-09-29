@extends('layouts.main')

@php
    $menus[] = [
        'link' => route('home'),
        'text' => 'Home',
        'name' => 'home'
    ];
    $menus[] = [
        'link' => route('item'),
        'text' => 'ORX Item',
        'name' => 'item'
    ];
    $menus[] = [
        'link' => '#',
        'text' => 'Lorem Ipsum Dolor Sit',
        'name' => 'lorem'
    ];
    $menus[] = [
        'link' => '#',
        'text' => 'Lorem Ipsum Dolor Sit',
        'name' => 'lorem'
    ];
@endphp

@section('main')
    <div>
        <nav class="navbar navbar-dark fixed-top text-white" style="background-color: dodgerblue;">
            <div class="container-fluid justify-content-between align-items-center">
                <div class="d-flex align-items-center">
                    <a href="#" id="drawer-toggle">
                        <span class="navbar-toggler-icon"></span>
                    </a>
                    <a class="navbar-brand mx-2" href="{{route('home')}}">Test Crud</a>
                </div>
                <div>
                    <a href="{{route('logout')}}" class="text-decoration-none text-white">
                        Logout
                    </a>
                </div>
            </div>
        </nav>
        <div class="d-flex">
            <div id="drawer">
                <div class="list-group position-fixed" style="border-radius: 0;">
                    @foreach($menus AS $menu)
                        <a href="{{$menu['link']}}" class="list-group-item list-group-item-action {{(request()->route()->getName() === $menu['name']) ? 'menu-active' : ''}}">{{$menu['text']}}</a>
                    @endforeach
                </div>
            </div>
            <div class="flex-fill" style="padding-top: 55px;">
                @yield('content')
            </div>
        </div>
    </div>
@endsection

@section('script')
    @parent
    <script>
        const win = function () {
            const w = window.innerWidth || document.documentElement.clientWidth || document.body.clientWidth;
            if (w < 992) {
                $('#drawer').removeClass('hide').addClass('hide');
            } else {
                $('#drawer').removeClass('hide');
            }
        };
        win();
        $(window).resize(win);

        $(document).ready(function () {
            $('#drawer-toggle').click(function (e) {
                e.preventDefault();
                $('#drawer').toggleClass('hide');
            });
        });
    </script>
@endsection
