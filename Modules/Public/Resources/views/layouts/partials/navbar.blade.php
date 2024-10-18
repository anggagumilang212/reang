<nav class="navbar py-lg-4 pr-5 pl-5 navbar-expand-md navbar-dark fixed-top bg-primary shadow">
    <a class="navbar-brand" href="">{{ config('app.name') }}</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse"
        aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarCollapse">
        <ul class="navbar-nav ml-auto">
            &nbsp;&nbsp;&nbsp;
            <li class="nav-item text-dark {{ Request::is('/') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('public.home') }}">Home</a>
            </li>&nbsp;&nbsp;&nbsp;
            <li class="nav-item text-dark {{ Request::is('blog*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('public.blog') }}">Blog</a>
            </li>&nbsp;&nbsp;&nbsp;
            <li class="nav-item text-dark {{ Request::is('store*', 'product*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('public.store') }}">Store</a>
            </li>&nbsp;&nbsp;&nbsp;
            <li class="nav-item text-dark {{ Request::is('about') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('public.about') }}">About</a>
            </li>&nbsp;&nbsp;&nbsp;
            @if (Route::has('login'))
                @auth
                    <li class="nav-item text-dark">
                        <a href="{{ route('home') }}" class="nav-link">Dashboard</a>
                    </li>
                @else
                    <li class="nav-item text-dark">
                        <a href="{{ route('login') }}" class="nav-link">Log
                            in</a>
                    </li>&nbsp;&nbsp;&nbsp;
                    @if (Route::has('register'))
                        <li class="nav-item text-dark">
                            <a href="{{ route('register') }}" class="nav-link">Register</a>
                        </li>&nbsp;&nbsp;&nbsp;
                    @endif
                @endauth
            @endif
        </ul>
    </div>
</nav>
