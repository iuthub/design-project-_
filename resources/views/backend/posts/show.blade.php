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
                        <h3 class="card-title">{{ __('Details of Post') }}</h3>
                        <div class="card-tools">
                            <a class="btn btn-warning" href="{{ route('admin.posts.edit',$post->id) }}">{{ __('Edit') }}</a>
                            <a class="btn btn-info" href="{{ route('admin.posts.index') }}">{{ __('Back') }}</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            {{ Form::label('title',__('Title')) }}
                            <span class="form-control">{{ $post->title }}</span>
                        </div>
                        <div class="form-group">
                            {{ Form::label('category',__('Category')) }}
                            <span class="form-control">{{ $categories[$post->category_id] }}</span>
                        </div>
                        <div class="form-group">
                            {{ Form::label('content',__('Content')) }}
                            {{ Form::textarea('content', $post->content, ['class'=>'form-control']) }}
                        </div>
                        <div class="form-group">
                            {{ Form::label('tags',__('Tags')) }}
                            <span class="form-control">{{ join(', ',$tags) }}</span>
                        </div>
                        <div class="form-group">
                            {{ Form::label('status',__('Status')) }}
                            <span class="form-control">{{ $post->is_publish ? __('Published') : __('Unpublished') }}</span>
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
                    hideIcons: ["side-by-side", "fullscreen"],
                    readOnly: true
                });
                simplemde.togglePreview();
            </script>
@endsection
