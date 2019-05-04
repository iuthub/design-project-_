@extends('layouts.backend')

@section('style')
    <link rel="stylesheet" href="{{ asset('vendor/simplemde-markdown-editor/css/simplemde.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/iCheck/all.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/select2/select2.min.css') }}">
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">{{ __('Add New Post') }}</h3>
                        <div class="card-tools">
                            <a class="btn btn-info"
                               href="{{ route('admin.posts.index') }}">{{ __('Back') }}</a>
                        </div>
                    </div>
                    <div class="card-body">
                        {{ Form::open(['route'=>'admin.posts.store']) }}
                            @include('backend.posts._form',['buttonText'=> __('Create')])
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ asset('vendor/simplemde-markdown-editor/js/simplemde.min.js') }}"></script>
    <script src="{{ asset('vendor/iCheck/icheck.min.js') }}"></script>
    <script src="{{ asset('vendor/select2/select2.full.min.js') }}"></script>
    <script>
        var simplemde = new SimpleMDE({
            toolbarTips: true,
            promptURLs: true,
            showIcons: ["code", "table"],
            hideIcons: ["side-by-side", "fullscreen"]
        });
        $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
            checkboxClass: 'icheckbox_flat-green',
            radioClass: 'iradio_flat-green'
        });

        $('.select2').select2({
            tags: true,
            tokenSeparators: [',', ' ']
        });

    </script>
@endsection
