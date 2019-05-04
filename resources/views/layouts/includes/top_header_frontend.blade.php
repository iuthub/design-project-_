<!-- Navbar -->
<div class="container-fluid frontend-top-header border-bottom">
    <div class="row">
        <div class="col-lg-3">
            <div class="logo">
                <img src="{{ asset('img/logo.png') }}" alt="Logo">
                <span class="logo-text">{{ config('app.name') }}</span>
            </div>
        </div>
        <div class="col-lg-9">
            <nav class="navbar navbar navbar-expand bg-white navbar-light">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('blog') }}">{{ __('Home') }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('about') }}">{{ __('About Me') }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('contact') }}">{{ __('Contact') }}</a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</div>

<!-- /.navbar -->