@extends('backend.layouts.layout')
@section('title','ListEvent')
@section('small_title','New')
@section('event','active')
@section('body')


<div class="box box-success">
	<div class="box-body">


<table id="example2" class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th><center>Sl.No</center></th>
                    <th><center>Name</center></th>
                    <th><center>Description</center></th>
                    <th><center>CoverImage</center></th>
					<th><center>Gallery</center></th>
                    <th><center>Edit</center></th>
                    <th><center>Delete</center></th>
                </tr>
            </thead>
            <tbody>
			<?php $i=1 ?>
                @foreach( $allevent as $event )
                <tr>
                    <td><center>{{ $i }}</center></td>
                    <td><center>{!! $event->name !!}</center></td>
                    <td><center>{{ $event->description }}</center></td>
					<td><center><img src="{{ url('images/'.$event->image) }}" alt="{{ $event->image }}" height="50px" width="100px" ></center></td>
					<td><center><input type="button" value="ViewGallery" class="btn btn-danger" onclick="window.location.href='{{url('event/gallery/'.$event->id)}}'"></center></td>
					<td><center><input type="button" value="Edit"  onclick="window.location.href='{{url('event/edit/'.$event->id)}}'" class="btn btn-danger"></center> </td>
                    <td><center><input type="button" value="Delete" onclick="confirmDelete('{{url('event/destroy/'.$event->id)}}')" class="btn btn-danger"></center></td>
            <?php $i++ ?>   
				@endforeach
            </tbody>



</table>
</div>
</div>
@endsection