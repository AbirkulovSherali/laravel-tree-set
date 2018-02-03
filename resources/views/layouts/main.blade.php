<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="shortcut icon" href="{{ asset('img/favicon.ico') }}" type="image/x-icon">
        <link rel="stylesheet" href="{{ asset('css/font-awesome.css') }}">
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        <title>Tree</title>
    </head>
    <body>
        <div id="app">
            <div class="container">
                <nav class="navbar navbar-expand-lg navbar-light bg-light">
                    <a class="navbar-brand" href="javascript:void(0)" style="color: #3D8EB9">
                        <i class="fa fa-database" aria-hidden="true"></i>
                    </a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse justify-content-between" id="navbarNav">
                        <ul class="navbar-nav nav-left">
                            <li class="nav-item {{ (isset($link) && $link == 'home') ? 'active' : '' }}">
                                <a class="nav-link" href="/"><span class="fa fa-home"></span> Home</a>
                            </li>
                            <li class="nav-item {{ (isset($link) && $link == 'categories') ? 'active' : '' }}">
                                <a class="nav-link" href="/categories"><span class="fa fa-navicon"></span> Categories</a>
                            </li>
                            <li class="nav-item {{ (isset($link) && $link == 'posts') ? 'active' : '' }}">
                                <a class="nav-link" href="/posts"><span class="fa fa-edit"></span> Posts</a>
                            </li>
                        </ul>
                        <ul class="navbar-nav nav-right">
                            @if(Auth::check())
                                <li class="nav-item">
                                    <a class="nav-link" href="/logout"><span class="fa fa-user"></span> Logout ({{ Auth::user()->name }})</a>
                                </li>
                                <li class="nav-item {{ (isset($link) && $link == 'chat') ? 'active' : '' }}">
                                    <a class="nav-link" href="/chat"><span class="fa fa-wechat"></span> Чат</a>
                                </li>
                            @else
                                <li class="nav-item {{ (isset($link) && $link == 'login') ? 'active' : '' }}">
                                    <a class="nav-link" href="/login"><span class="fa fa-user"></span> Login</a>
                                </li>
                                <li class="nav-item {{ (isset($link) && $link == 'register') ? 'active' : '' }}">
                                    <a class="nav-link" href="/registration"><span class="fa fa-id-card"></span> Registration</a>
                                </li>
                            @endif
                        </ul>
                    </div>
                </nav>
            </div>
            <div style="margin-top: 20px">
                @yield('content')
            </div>
        </div>
        <script type="text/javascript">
            /* Перенос необходимых переменных из PHP в JavaScript */
            window.csrf_token = '{{ csrf_token() }}' || null;
            window.auth = JSON.parse('{!! json_encode(Auth::user()) !!}') || {};
        </script>
        <script src="{{ asset('js/app.js') }}"></script>
    </body>
</html>
