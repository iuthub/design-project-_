@extends('admin.master.master')

@section('title', 'Media Uploader')

@section('headcode')
	{{ Html::style('assets/common/js/dropzone/dropzone.min.css') }}
	<style type="text/css">
		.uploadimagepreview{
			list-style: none;
		}
		.uploadimagepreview > li > div:first-child {
		    border-radius: 10px;
		    height: 75px;
		    overflow: hidden;
		    width: 75px;
		    margin: 10px;
		}
		.uploadimagepreview > li > div{
			float: left;
		}
		.uploadimagepreview > li > div:last-child {
			margin-top: 30px;
		}
		.uploadimagepreview > li > div span {
		    display: block;
		    position: relative;
		    height: 100%;
		    width: 100%;
		    left: 50%;
		    position: relative;
		}
		.uploadimagepreview img {
		    height: 120px;
		    left: 50%;
		    margin-left: -50%;
		    position: absolute;
		    top: 0;
		    width: auto;
		    display: table;
		    transform: translateX(-50%);
		}
	</style>
@endsection

@section('breadcambs', '<i class="fa fa-dashboard"></i> Media Uploader')

@section('bodycode')
<div class="row">
    <div class="col-md-12">
    	{{ Form::open(array('route'=>['mediauploadprocess'], 'class'=> 'dropzone', 'id' => 'addImages', 'method'=>'post')) }}
    	{{Form::close()}}
	</div>
</div>
<div class="row">
    <div class="col-md-12">
    	<ul class="uploadimagepreview">
    		
    	</ul>
	</div>
</div>
@endsection

@section('jscode')
	{{ Html::script('assets/common/js/dropzone/dropzone.min.js') }}
	<script type="text/javascript">
		$(document).ready(function(){
			Dropzone.options.addImages ={
				maxFilesize : 2,
				clickable : true,
				acceptedFiles : 'image/jpg, image/jpeg, image/png, image/gif, image/JPG, image/JPEG, image/PNG, image/GIF',
				success : function(file, response){
					if(file.status == 'success'){
						handleDropzoneFileUpload.handleSuccess(response);
					}
					// else{
					// 	handleDropzoneFileUpload.handleError(response);
					// }
				}
			};

			var handleDropzoneFileUpload = {
				// handleError: function(response){
				// 	myDropzone.removeFile(file);
				// },
				handleSuccess: function(response){
					var imageul = $('.uploadimagepreview');
					var mybasepath = window.location.origin;
					var imagesrc = mybasepath + '/' + response.filepath + response.filename;
					$(imageul).prepend('<li class="clearfix"><div><span><img src="'+imagesrc+'"></span></div> <div>'+ imagesrc +'</div></li>')
				}
			}
		})
	</script>
@endsection