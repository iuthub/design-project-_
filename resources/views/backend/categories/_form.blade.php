<div class="form-group">
    {{ Form::label('name',__('Name')) }}
    {{ Form::text('name', null, ['class'=> $errors->has('name') ? 'form-control is-invalid' : 'form-control','placeholder'=> 'Name']) }}
    <div class="invalid-feedback">{{ $errors->first('name') }}</div>
</div>
<div class="form-group">
    {{ Form::submit($buttonText, ['class'=> 'btn btn-success']) }}
</div>
