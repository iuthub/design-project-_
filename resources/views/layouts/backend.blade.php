@include('layouts.includes.header')

@include('layouts.includes.top_header')

@include('layouts.includes.sidebar')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
@if(isset($breadcrumbs) && !is_null($breadcrumbs))
    @include('layouts.includes.breadcrumb')
@endif
<!-- Main content -->
    <section class="content">
        @yield('content')
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
@include('layouts.includes.footer')
