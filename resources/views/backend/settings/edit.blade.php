@extends('layouts.backend')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">{{ __('Settings') }}</h3>
                    </div>
                    <div class="card-body">
                        {{ Form::open(['route'=>'admin.settings']) }}
                        @method('PUT')
                        <div class="form-group">
                            {{ Form::label('facebook_link',__('Facebook Link')) }}
                            {{ Form::text('facebook_link', old('facebook_link', optional($settings->firstWhere('slug','facebook_link'))->value),['class'=> 'form-control']) }}
                        </div>
                        <div class="form-group">
                            {{ Form::label('linkedin_link',__('Linkedin Link')) }}
                            {{ Form::text('linkedin_link', old('linkedin_link', optional($settings->firstWhere('slug','linkedin_link'))->value),['class'=> 'form-control']) }}
                        </div>

                        <div class="form-group">
                            {{ Form::label('twitter_link',__('Twitter Link')) }}
                            {{ Form::text('twitter_link', old('twitter_link', optional($settings->firstWhere('slug','twitter_link'))->value),['class'=> 'form-control']) }}
                        </div>

                        <div class="form-group">
                            {{ Form::label('github_link',__('Github Link')) }}
                            {{ Form::text('github_link', old('github_link', optional($settings->firstWhere('slug','github_link'))->value),['class'=> 'form-control']) }}
                        </div>

                        <div class="form-group">
                            {{ Form::label('stackoverfollow_link',__('Stackoverfollow Link')) }}
                            {{ Form::text('stackoverfollow_link', old('stackoverfollow_link', optional($settings->firstWhere('slug','stackoverfollow_link'))->value),['class'=> 'form-control']) }}
                        </div>

                        <div class="form-group">
                            {{ Form::submit('Update',['class'=> 'btn btn-primary']) }}
                        </div>

                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


