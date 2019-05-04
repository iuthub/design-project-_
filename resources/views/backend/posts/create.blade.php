@extends('layouts.backend')

@section('style')
    <link rel="stylesheet" href="{{ asset('vendor/simplemde-markdown-editor/css/simplemde.min.css') }}">
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
    <script>
        var simplemde = new SimpleMDE({
            toolbarTips: true,
            promptURLs: true,
            showIcons: ["code", "table"],
            hideIcons: ["side-by-side", "fullscreen"]
        });
    </script>
@endsection
