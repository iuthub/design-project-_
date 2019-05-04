@extends('layouts.backend')

@section('title', 'Add New Media')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">{{ __('Add New Media') }}</h3>
                        <div class="card-tools">
                            <a class="btn btn-info"
                               href="{{ route('admin.media.index') }}">{{ __('Media Manager') }}</a>
                        </div>
                    </div>
                    <div class="card-body">
                        {{ Form::open(['route'=>['admin.media.store'], 'class'=> 'dropzone', 'id' => 'addImages', 'files'=>true]) }}
                        <div class="form-group">
                            {{ Form::label('name', __('Name')) }}
                            {{ Form::text('name', null , ['class'=> $errors->has('name') ? 'form-control is-invalid' : 'form-control']) }}
                            <span class="invalid-feedback">{{ $errors->first('name') }}</span>
                        </div>
                        <div class="form-group">
                            {{ Form::label('file', __('File')) }}
                            <div class="custom-file">
                                {{ Form::file('file', ['class'=>$errors->has('file') ? 'custom-file-input is-invalid' : 'custom-file-input']) }}
                                <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                <span class="invalid-feedback">{{ $errors->first('file') }}</span>
                            </div>
                        </div>
                        <div class="form-group">
                            {{ Form::submit(__('Upload'), ['class'=>'btn btn-success']) }}
                        </div>
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('script')
    <script>
        $(document).ready(function () {
            $('#file').on('change',function(e){
                var fileName = e.target.files[0].name;
                console.log(e.target.files);
                $('.custom-file-label').html(fileName);
            });
        });
    </script>
@endsection