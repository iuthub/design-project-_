@extends('layouts.backend')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">{{ __('Add New Category') }}</h3>
                        <div class="card-tools">
                            <a class="btn btn-info"
                               href="{{ route('admin.categories.index') }}">{{ __('Back') }}</a>
                        </div>
                    </div>
                    <div class="card-body">
                        {{ Form::open(['route'=> 'admin.categories.store']) }}
                            @include('backend.categories._form',['buttonText' => 'Create'])
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
