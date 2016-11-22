@extends('backend.layouts.layout')
@section('title','EventGallery')
@section('small_title','New')
@section('event','active')
@section('body')
<div class="box box-success">
	<div class="box-body">
	
		<form role="form" action="{{url('event/edit/'.$id)}}" enctype="multipart/form-data" method="post">
			{{csrf_field()}}
			<div class="form-group">
				<label for="title" class="control-label">Event-Name</label>
				<input class="form-control" type="text" name="evtname" value="{{$event->name}}">
			</div>
			<div class="form-group">
				<label for="cont" class="control-label">Description</label>

				<textarea class="form-control ckeditor" name="descrp">{{$event->description}}</textarea>	
			</div>
			<div class="form-group">
				<label for="img" class="control-label">Featured image</label>
				<input id="img" name="img" type="file" class="filestyle" >				
			</div>
			<input type="hidden" name="_token" value="{{csrf_token()}}">
			<input type="submit" value="Submit" class="btn btn-primary">
		</form>
	</div>
</div>
@endsection