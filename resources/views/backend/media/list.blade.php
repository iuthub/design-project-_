<div class="raw table-filter">
    {{ Form::open(['method'=> 'GET','id'=> 'media-filter']) }}
    <div class="col-lg-2">
        {{ Form::select('column',$columns, $column, ['class'=> 'form-control']) }}
    </div>
    <div class="col-lg-2">
        {{ Form::select('order',$orders, $order, ['class'=> 'form-control']) }}
    </div>
    <div class="col-lg-1">
        {{ Form::submit(__('Sort'), ['class'=> 'btn btn-info media-filter-submit']) }}
    </div>
    <div class="col-lg-6">
        {{ Form::search('search', $search, ['class'=> 'form-control','placeholder' => __('Search Item')]) }}
    </div>
    <div class="col-lg-1">
        {{ Form::submit(__('Search'), ['class'=> 'btn btn-success media-filter-submit']) }}
    </div>
    {{ Form::close() }}
</div>

<div class="row">
    @forelse($media as $medium)
        <div class="col-lg-3">
            <div class="card">
                <div class="card-body">
                    <a class="medium" href="javascript:;">
                        <img class="media-img" width="100%" src="{{ asset('storage/images/media/'.$medium->path) }}"
                             alt="">
                    </a>
                    <span class="text-bold">{{ $medium->name.' ('.$medium->width.' x '.$medium->height.')' }}</span>
                </div>
            </div>
        </div>
    @empty

    @endforelse
</div>
{{ $media->appends(['column'=>Request::get('column'),'order'=>Request::get('order'), 'search'=>Request::get('search')])->links() }}
