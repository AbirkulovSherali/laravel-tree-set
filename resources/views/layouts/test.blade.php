<nav class="navbar navbar-expand-lg navbar-light bg-light justify-content-between">
    <div class="nav-left">
        <div class="collapse navbar-collapse" id="navbarNav">
            <a class="navbar-brand" href="javascript:avoid(0)" style="color: #3D8EB9">
                <i class="fa fa-database" aria-hidden="true"></i>
            </a>
            <ul class="navbar-nav">
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
        </div>
    </div>
    <div class="nav-right">
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                @if(Auth::check())
                    <li class="nav-item">
                        <a class="nav-link" href="/logout"><span class="fa fa-user"></span> Logout ({{ Auth::user()->name }})</a>
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
    </div>
</nav>
