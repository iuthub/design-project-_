@extends('layouts.backend')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">{{ __('Media Manager') }}</h3>
                        <div class="card-tools">
                            <a class="btn btn-info"
                               href="{{ route('admin.media.create') }}">{{ __('Upload New Media') }}</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="raw table-filter">
                            {{ Form::open(['route'=> 'admin.media.index','method'=> 'GET']) }}
                            <div class="col-lg-2">
                                {{ Form::select('column',$columns, $column, ['class'=> 'form-control']) }}
                            </div>
                            <div class="col-lg-2">
                                {{ Form::select('order',$orders, $order, ['class'=> 'form-control']) }}
                            </div>
                            <div class="col-lg-1">
                                {{ Form::submit(__('Sort'), ['class'=> 'btn btn-info']) }}
                            </div>
                            <div class="col-lg-6">
                                {{ Form::search('search', $search, ['class'=> 'form-control','placeholder' => __('Search Item')]) }}
                            </div>
                            <div class="col-lg-1">
                                {{ Form::submit(__('Search'), ['class'=> 'btn btn-success']) }}
                            </div>
                            {{ Form::close() }}
                        </div>

                        <div class="row">
                            @forelse($media as $medium)
                                <div class="col-lg-3">
                                    <div class="card">
                                        <div class="card-body">
                                            <img width="100%" src="{{ asset('storage/images/media/'.$medium->path) }}"
                                                 alt="">
                                            <span class="text-bold">{{ $medium->name.' ('.$medium->width.' x '.$medium->height.')' }}</span>
                                        </div>
                                        <div class="card-footer">
                                            <div class="btn-toolbar" role="toolbar">
                                                <div class="btn-group m-auto" role="group">
                                                        <a data-toggle="tooltip" title="{{ __('Download') }}" class="btn btn-outline-light" href="{{ route('admin.media.download', $medium->id) }}"><i class="fa fa-download text-primary"></i></a>

                                                        <i data-toggle="tooltip" title="{{ __('Copy url to clipboard') }}" class="fa fa-clipboard btn btn-outline-light copy-url text-dark"
                                                           data-clipboard-text="{{ asset('storage/images/media/'.$medium->path) }}"></i>

                                                    <a href="{{ route('admin.media.edit',$medium->id) }}" data-toggle="tooltip" title="{{ __('Edit') }}" class="btn btn-outline-light"><i class="fa fa-edit text-warning"></i>
                                                    </a>

                                                    <a data-method="DELETE" data-token="{{ csrf_token() }}" data-confirm="Are you sure?" href="{{ route('admin.media.destroy',$medium->id) }}" data-toggle="tooltip" title="{{ __('Delete') }}" class="btn btn-outline-light"> <i class="fa fa-trash text-danger"></i>
                                                    </a>

                                                </div>
                                            </div>




                                        </div>
                                    </div>
                                </div>
                            @empty

                            @endforelse
                        </div>
                    </div>
                    <div class="card-footer">
                        {{ $media->appends(['column'=>Request::get('column'),'order'=>Request::get('order'), 'search'=>Request::get('search')])->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ asset('js/clipboard.js') }}"></script>
    <script>
        var clipboard = new ClipboardJS('.copy-url');
        $('[data-toggle="tooltip"]').tooltip();
        $(document).on('click', '.copy-url', function () {
            $(this).attr("title", "{{ __('Copied!') }}").tooltip("_fixTitle").tooltip("show").attr("title", "{{ __('Copy url to clipboard') }}").tooltip("_fixTitle");
        });
    </script>
@endsection