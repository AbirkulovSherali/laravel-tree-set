<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        <title>Tree</title>
    </head>
    <body>
        <div id="wrapper">
            <div class="container">
                <nav class="navbar navbar-expand-lg navbar-light bg-light justify-content-between">
                    <div class="nav-left">
                        <div class="collapse navbar-collapse" id="navbarNav">
                            <a class="navbar-brand" href="javascript:avoid(0)" style="color: #3D8EB9">
                                <i class="fa fa-database" aria-hidden="true"></i>
                            </a>
                            <ul class="navbar-nav">
                                <li class="nav-item {{ (isset($link) && $link == 'home') ? 'active' : '' }}">
                                    <a class="nav-link" href="/">Home</a>
                                </li>
                                <li class="nav-item {{ (isset($link) && $link == 'categories') ? 'active' : '' }}">
                                    <a class="nav-link" href="/categories">Categories</a>
                                </li>
                                <li class="nav-item {{ (isset($link) && $link == 'posts') ? 'active' : '' }}">
                                    <a class="nav-link" href="/posts">Posts</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="nav-right">
                        <div class="collapse navbar-collapse" id="navbarNav">
                            <ul class="navbar-nav">
                                @if(Auth::check())
                                    <li class="nav-item">
                                        <a class="nav-link" href="/logout">Logout ({{ Auth::user()->name }})</a>
                                    </li>
                                @else
                                    <li class="nav-item {{ (isset($link) && $link == 'login') ? 'active' : '' }}">
                                        <a class="nav-link" href="/login">Login</a>
                                    </li>
                                    <li class="nav-item {{ (isset($link) && $link == 'register') ? 'active' : '' }}">
                                        <a class="nav-link" href="/registration">Registration</a>
                                    </li>
                                @endif

                            </ul>
                        </div>
                    </div>
                </nav>
            </div>
            <div id="content" style="margin-top: 20px">
                @yield('content')
            </div>
        </div>

        <script src="{{ asset('js/jquery.js') }}"></script>
        <script src="{{ asset('js/main.js') }}"></script>
        <script type="text/javascript">
            // # Transfer variables from PHP to JavaScript
            window.csrf_token = '{{ csrf_token() }}' || null;
            window.auth = JSON.parse('{!! json_encode(Auth::user()) !!}') || {};
        </script>
    </body>
</html>
