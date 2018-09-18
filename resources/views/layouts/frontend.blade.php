@include('layouts.includes.frontend.header')

<!-- Page Header -->
<header class="masthead" style="background-image: url('{{ asset('img/home-bg.jpg') }}')">
    <div class="overlay"></div>
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-10 mx-auto">
                <div class="site-heading">

                </div>
            </div>
        </div>
    </div>
</header>

<!-- Main Content -->
<div class="container">
   @yield('content')
</div>

@include('layouts.includes.frontend.footer')
