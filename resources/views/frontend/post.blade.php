@extends('layouts.frontend')

@section('content')
    <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
            <div class="post-preview">
                <h2 class="post-title">{{ $post->title }}</h2>
                <p class="post-meta">
                    {{ __('Category:') }}<a style="text-decoration: none"
                                            href="{{ route('post.show',$post->id) }}"> {{ $post->category->name }}</a>,
                    {{ __('Posted on: :date',['date'=> $post->created_at->format('Y-m-d')]) }}
                </p>
                @if(!empty($post->feature_image))
                    <div class="featured_image text-center">
                        <img style="width: 100%" src="{{ asset('storage/posts/images/'.$post->feature_image) }}"
                             alt="Feature Image">
                    </div>
                @endif
                <p>{!! $post->content !!}</p>
            </div>
        </div>
    </div>
    <div class="row mt-5">
        <div class="col-lg-8 col-md-10 mx-auto">
            <h4 class="mb-5">{{ __('Comments') }}</h4>
            <div class="post-comments">
                <div class="comment-form mb-5">
                    {{ Form::open([]) }}
                    <div class="form-group">
                        {{ Form::label('name',__('Name')) }}
                        {{ Form::text('name',null,['class'=> 'form-control']) }}
                    </div>

                    <div class="form-group">
                        {{ Form::label('email',__('Email')) }}
                        {{ Form::email('email',null,['class'=> 'form-control']) }}
                    </div>

                    <div class="form-group">
                        {{ Form::label('comment',__('Comment')) }}
                        {{ Form::textarea('content',null,['class'=> 'form-control','rows'=>3]) }}
                    </div>

                    <div class="form-group">
                        {{ Form::submit(__('Submit'),['class'=> 'btn btn-primary']) }}
                    </div>
                    {{ Form::close() }}
                </div>
                <ul class="list-unstyled">
                    @foreach($post->comments->sortByDesc('created_at') as $comment)
                        <li>
                            <div class="comment">
                                <div class="title">
                                    <span class="name font-weight-bold">{{ $comment->authorable->name.__(' says:') }}</span>
                                    <button class="pull-right"><i class="fa fa-reply"></i> {{ __('Replay') }}</button>
                                </div>
                                <small><i class="fa fa-clock-o"></i> {{ $comment->created_at }}</small>
                                <span class="d-block text-justify mt-3">{{ $comment->content }}</span>
                            </div>
                            @if(!$comment->comments->isEmpty())
                                <ul class="mt-5 mb-5">
                                    @foreach($comment->comments as $reply)
                                        <div class="comment">
                                            <div class="title">
                                                <span class="name font-weight-bold">{{ $reply->authorable->name.__(' reply:') }}</span>
                                                <button class="pull-right"><i class="fa fa-reply"></i> {{ __('Replay') }}</button>
                                            </div>
                                            <small><i class="fa fa-clock-o"></i> {{ $reply->created_at }}</small>
                                            <span class="d-block text-justify mt-3">{{ $reply->content }}</span>
                                        </div>
                                    @endforeach
                                </ul>
                            @endif
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
@endsection