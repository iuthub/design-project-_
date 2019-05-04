@extends('layouts.frontend')

@section('content')
    <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
            {{ Form::open(['route'=>['contact']]) }}
            <div class="form-group">
                {{ Form::label('name',__('Name')) }}
                {{ Form::text('name', get_name_for_comment_form(),['class'=> $errors->has('name') ? 'form-control is-invalid' : 'form-control','required','placeholder' => 'Robin Hood']) }}
                <span class="invalid-feedback">{{ $errors->first('name') }}</span>
            </div>

            <div class="form-group">
                {{ Form::label('email',__('Email')) }}
                {{ Form::email('email',get_email_for_comment_form(),['class'=> $errors->has('email') ? 'form-control is-invalid' : 'form-control','required','placeholder' => 'robin.hood@example.com']) }}
                <span class="invalid-feedback">{{ $errors->first('email') }}</span>
            </div>

            <div class="form-group">
                {{ Form::label('website',__('Website')) }}
                {{ Form::text('website',null,['class'=> $errors->has('website') ? 'form-control is-invalid' : 'form-control','placeholder' => 'http://example.com']) }}
                <span class="invalid-feedback">{{ $errors->first('website') }}</span>
            </div>

            <div class="form-group">
                {{ Form::label('message',__('Message')) }}
                {{ Form::textarea('message',null,['class'=> $errors->has('message') ? 'form-control is-invalid' : 'form-control','rows'=>3,'required']) }}
                <span class="invalid-feedback">{{ $errors->first('message') }}</span>
            </div>

            <div class="form-group button-group">
                {{ Form::submit(__('Send'),['class'=> 'btn btn-primary']) }}
            </div>
            {{ Form::close() }}
        </div>
    </div>

@endsection