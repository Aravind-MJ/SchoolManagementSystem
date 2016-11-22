@extends('backend.layouts.layout')
@section('title','Blog')
@section('small_title','New')
@section('blog','active')
@section('body')
<div class="box box-success">

	<div class="box-body">
		<form role="form" action="{{url('blog/store')}}" method="post" enctype="multipart/form-data">

         <div class="box-body">
		<form role="form" action="store" method="post">

			<div class="form-group">
				<label for="title" class="control-label">Title</label>
				<input class="form-control" type="text" name="blog_title">
			</div>
			<div class="form-group">
				<label for="cont" class="control-label">Content</label>
				<textarea class="form-control ckeditor" name="blog_cont"></textarea> 
			</div>
			<div class="form-group">
				<label for="img" class="control-label">Featured image</label>
				<input id="img" name="featured_image" type="file" class="filestyle">
			</div>
			<input type="hidden" name="_token" value="{{csrf_token()}}">
			<input type="submit" value="Submit" class="btn btn-primary">
		</form>
	</div>
</div>
@endsection
