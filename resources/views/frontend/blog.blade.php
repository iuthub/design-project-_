@extends('layouts.frontend')

@section('content')
    <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
            @foreach($posts as $post)
            <div class="post-preview">
                <a href="{{ route('post.show',$post->id) }}">
                    <h2 class="post-title">{{ $post->title }}</h2>
                </a>
                <p class="post-meta">
                    {{ __('Category:') }}<a style="text-decoration: none" href="{{ route('post.show',$post->id) }}"> {{ $post->category->name }}</a>
                    {{ __('Posted on: :date',['date'=> $post->created_at->format('Y-m-d')]) }}
                </p>
                <p class="post-description">{{ str_limit($post->content, 200) }}</p>
            </div>
            <hr>
            @endforeach
            {{ $posts->links() }}
        </div>
    </div>
@endsection