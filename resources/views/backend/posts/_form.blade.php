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
    <label for="select_image">{{ __('Feature Image') }}</label>
    <div class="custom-file">
        {{ Form::file('feature_image',['class' => $errors->has('feature_image') ? 'custom-file-input is-invalid' : 'custom-file-input', 'files'=>true,'id'=> 'select_image']) }}
        {{ Form::label('select_image',__('Select Image'),['class'=> 'custom-file-label']) }}
        <div class="invalid-feedback">{{ $errors->first('feature_image') }}</div>
    </div>
</div>

<div class="form-group">
    {{ Form::label('tags','Tags') }}
    {{ Form::select('tags[]',isset($tags) ? $tags: [], isset($postTags) ? $postTags : null,['class'=>'form-control select2','multiple'=>true,'id'=>'tags']) }}
</div>

<div class="form-group">
    <label>
        {{ Form::radio('is_publish',1, true, ['class'=> 'flat-red']) }} {{ __("Publish") }}
    </label>
    <label>
        {{ Form::radio('is_publish',0, false, ['class'=> 'flat-red']) }} {{ __("Unpublish") }}
    </label>
</div>
<div class="form-group">
    {{ Form::submit($buttonText, ['class'=> 'btn btn-success']) }}
</div>
