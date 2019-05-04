@extends('layouts.frontend')

@section('content')
    <div class="row">
        @foreach($posts as $post)
            <div class="col-lg-8 offset-md-2 mt-lg-2 mb-lg-2">
                <h3><a href="{{ route('posts.show',$post->id) }}">{{ $post->title }}</a></h3>
                <p class="blog-content text-justify">{{ mb_strimwidth($post->content,0,500,'..') }}</p>
                <a class="pull-left" href="{{ route('posts.show',$post->id) }}">{{ __('Continue reading...') }}</a>
            </div>
        @endforeach
    </div>
@endsection