@extends('layouts.frontend')

@section('content')
    <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
            <div class="post-preview">
                <h2 class="post-title">{{ $post->title }}</h2>
                <p class="post-meta">
                    {{ __('Category:') }}<a style="text-decoration: none"
                                            href="{{ route('post.show',$post->id) }}"> {{ $post->category->name }}</a>
                    {{ __('Posted on: :date',['date'=> $post->created_at->format('Y-m-d')]) }}
                </p>
                @if(!empty($post->feature_image))
                    <div class="featured_image text-center">
                        <img style="width: 100%" src="{{ asset('storage/images/posts/'.$post->feature_image) }}"
                             alt="Feature Image">
                    </div>
                @endif
                <p>{{ \Illuminate\Mail\Markdown::parse($post->content) }}</p>
            </div>
        </div>
    </div>
    <div class="row mt-5">
        <div class="col-lg-8 col-md-10 mx-auto">
            <h4 class="mb-5">{{ __('Comments') }}</h4>
            <div class="post-comments">
                <div class="comment-form mb-5">
                    {{ Form::open(['route'=>['post.comment',$post->id]]) }}
                    <div class="form-group">
                        {{ Form::label('name',__('Name')) }}
                        {{ Form::text('name',null,['class'=> 'form-control','required']) }}
                        <span class="invalid-feedback">{{ $errors->first('name') }}</span>
                    </div>

                    <div class="form-group">
                        {{ Form::label('email',__('Email')) }}
                        {{ Form::email('email',null,['class'=> 'form-control','required']) }}
                        <span class="invalid-feedback">{{ $errors->first('email') }}</span>
                    </div>

                    <div class="form-group">
                        {{ Form::label('comment',__('Comment')) }}
                        {{ Form::textarea('content',null,['class'=> 'form-control','rows'=>3,'required']) }}
                        <span class="invalid-feedback">{{ $errors->first('content') }}</span>
                    </div>

                    <div class="form-group button-group">
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
                                    <button class="pull-right reply " data-comment-id="{{ $comment->id }}"><i
                                                class="fa fa-reply"></i> {{ __('Reply') }}</button>
                                </div>
                                <small><i class="fa fa-clock-o"></i> {{ $comment->created_at }}</small>
                                <span class="d-block text-justify mt-3">{{ $comment->content }}</span>
                            </div>
                            @if(!$comment->comments->isEmpty())
                                <ul class="mb-5">
                                    @foreach($comment->comments as $reply)
                                        <div class="comment-reply mt-5">
                                            <div class="title">
                                                <span class="name font-weight-bold">{{ $reply->authorable->name.__(' reply:') }}</span>
                                                <button class="pull-right reply" data-comment-id="{{ $comment->id }}">
                                                    <i class="fa fa-reply"></i> {{ __('Reply') }}</button>
                                            </div>
                                            <small><i class="fa fa-clock-o"></i> {{ $reply->created_at }}</small>
                                            <span class="d-block text-justify mt-3">{{ $reply->content }}</span>
                                        </div>
                                    @endforeach
                                    <div class="reply-form mt-5" id="comment-reply-{{ $comment->id }}"></div>
                                </ul>
                            @else
                                <div class="reply-form mt-5" id="comment-reply-{{ $comment->id }}"></div>
                            @endif
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function () {
            $(document).on('click', '.reply', function (e) {
                e.preventDefault();
                var commentId = $(this).data('comment-id');
                var replyForm = $('.comment-form').children().clone();
                replyForm.prepend('<input name="comment_id" value="'+ commentId +'" type="hidden">');
                replyForm.find('.button-group').append('<button id="close-reply-form" class="btn btn-warning">{{ __('Close') }}</button>');
                $('.reply-form').empty();
                $('#comment-reply-'+commentId).html(replyForm);
            });
            $(document).on('click','#close-reply-form', function (e) {
                e.preventDefault();
                $('.reply-form').html('');
            });
        });
    </script>
@endsection