@include('layouts.includes.header')

@include('layouts.includes.top_header_frontend')

<!-- Content Wrapper. Contains page content -->
<div class="container-fluid main-container">
    <!-- Main content -->
    <section class="content">
        @yield('content')
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
@include('layouts.includes.frontend_footer')
