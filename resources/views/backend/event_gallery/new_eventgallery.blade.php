@extends('backend.layouts.layout')
@section('title','EventGallery')
@section('small_title','New')
@section('event','active')
@section('body')
<div class="box box-success">
	<div class="box-body">
	
		<form role="form" action="{{url('event/new')}}" enctype="multipart/form-data" method="post">
			{{csrf_field()}}
			<div class="form-group">
				<label for="title" class="control-label">Event-Name</label>
				<input class="form-control" type="text" name="evtname">
			</div>
			<div class="form-group">
				<label for="cont" class="control-label">Description</label>
				<textarea class="form-control ckeditor" type="text area" name="descrp"></textarea>
			</div>
			<div class="form-group">
				<label for="img" class="control-label">Featured image</label>
				<input id="img" name="img" type="file" class="filestyle">				
			</div>
			<input type="submit" value="NEXT" class="btn btn-primary">
		</form>
	</div>
</div>
@endsection