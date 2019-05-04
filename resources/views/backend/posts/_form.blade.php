<div class="form-group">
    {{ Form::label('title',__('Title')) }}
    {{ Form::text('title', null, ['class'=> $errors->has('title') ? 'form-control is-invalid' : 'form-control','placeholder'=> __('Title')]) }}
    <div class="invalid-feedback">{{ $errors->first('title') }}</div>
</div>
<div class="form-group">
    {{ Form::label('category',__('Category')) }}
    {{ Form::select('category_id', $categories ,null, ['class'=> $errors->has('category') ? 'form-control is-invalid' : 'form-control','placeholder'=> __('Select a category')]) }}
    <div class="invalid-feedback">{{ $errors->first('category') }}</div>
</div>
<div class="form-group">
    {{ Form::label('content',__('Content')) }}
    {{ Form::textarea('content', null, ['class'=> $errors->has('content') ? 'form-control is-invalid' : 'form-control','id'=> 'mark-down-editor']) }}
    <div class="invalid-feedback">{{ $errors->first('content') }}</div>
</div>

<div class="form-group">
    <label>
        <input type="checkbox" class="flat-red" name="is_publish" {{ $post->is_publish ? 'checked' : '' }}> {{ __("Published") }}
    </label>
</div>
<div class="form-group">
    {{ Form::submit($buttonText, ['class'=> 'btn btn-success']) }}
</div>
