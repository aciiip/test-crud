@extends('layouts.main')

@php
    $menus[] = [
        'link' => route('home'),
        'text' => 'Home',
        'name' => 'home',
        'icon' => 'home'
    ];
    $menus[] = [
        'link' => route('item'),
        'text' => 'Item',
        'name' => 'item',
        'icon' => 'boxes'
    ];
    $menus[] = [
        'link' => route('user_transaction'),
        'text' => 'Transaction',
        'name' => 'user_transaction',
        'icon' => 'shopping-cart'
    ];
    $menus[] = [
        'link' => route('inventory'),
        'text' => 'Inventory',
        'name' => 'inventory',
        'icon' => 'box-open'
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
                        <a href="{{$menu['link']}}" class="list-group-item list-group-item-action {{(request()->route()->getName() === $menu['name']) ? 'menu-active' : ''}}">
                            <i class="fa fa-{{$menu['icon']}}"></i>
                            <span class="mx-1">{{$menu['text']}}</span>
                        </a>
                    @endforeach
                </div>
            </div>
            <div style="padding-top: 55px;" class="overflow-auto w-100">
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
