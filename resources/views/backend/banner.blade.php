@extends('backend.layouts.layout')
@section('title','Banner')
@section('small_title','Upload')
@section('banner','active')
@section('body')
<div class="box box-success">
	<div class="box-body">
	
		<form role="form" action="{{url('banner')}}" enctype="multipart/form-data" method="post">
			{{csrf_field()}}
			<div class="form-group">
				<label for="image" class="control-label">Banner image</label>
				<input id="image" name="image" type="file" class="filestyle">
			</div>
			<input type="submit" value="Upload" class="btn btn-primary">
		</form>
	</div>
</div>
@foreach($banner as $col)
    <div class="image col-lg-3 col-md-3 col-sm-6">
        <img src="{{url('images/'.$col->name)}}" />
        <div class="overlay text-center"><br>
            <a onclick="confirmDelete('{{url('banner/'.$col->id)}}')" class="btn btn-danger">Delete</a>
        </div>
    </div>
@endforeach
@endsection