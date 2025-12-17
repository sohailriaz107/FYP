<nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
    <div class="container">
        <a class="navbar-brand" href="index.html">Deluxe</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav"
            aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="oi oi-menu"></span> Menu
        </button>

        <div class="collapse navbar-collapse" id="ftco-nav">
            <ul class="navbar-nav ml-auto">

                <li class="nav-item {{ Request::is('/') ? 'active' : '' }}">
                    <a href="{{ route('home') }}" class="nav-link">Home</a>
                </li>

                <li class="nav-item {{ Request::is('room*') ? 'active' : '' }}">
                    <a href="{{ route('room') }}" class="nav-link">Rooms</a>
                </li>

                <li class="nav-item {{ Request::is('resturent') ? 'active' : '' }}">
                    <a href="{{ route('resturent') }}" class="nav-link">Restaurant</a>
                </li>

                <li class="nav-item {{ Request::is('about') ? 'active' : '' }}">
                    <a href="{{ route('about') }}" class="nav-link">About</a>
                </li>

                <li class="nav-item {{ Request::is('contact') ? 'active' : '' }}">
                    <a href="{{ route('contact') }}" class="nav-link">Contact</a>
                </li>

                <li class="nav-item {{ Request::is('profile') ? 'active' : '' }}">
                    <a href="{{ route('profile') }}" class="nav-link">Profile</a>
                </li>

            </ul>
        </div>
    </div>
</nav>
