@extends('backend.layouts.layout')
@section('title','Blog')
@section('small_title','list')
@section('blog','active')
@section('body')

<div class="box box-success">
	<div class="box-body">
			<table id="example2" border='1' class="table table-bordered table-hover">
				<thead>
				<tr>
					<th>Sl.No</th>
                    <th>Title</th>
					<th>Content</th>
					<th>Image</th>
					<th>Edit</th>
                    <th>Delete</th>
					
				</tr>
			     <tbody>
                <?php $i=1 ?>
                @foreach( $allblog as $blog )
                <tr>
                    <td><center>{{ $i }}</center></td>
                  <td><center>{!! $blog->blog_title !!}</center></td>
                    <td><center>{{ $blog->blog_cont }}</center></td>
					<td><center><img src="{{ asset("images/$blog->blog_img") }}" alt="image" width="100" height="50"/></center></td>
                    
                   <td><center><input type="button" value="Edit" onclick="window.location.href='{{url('blog/edit/'.$blog->id)}}'" class="btn btn-danger"></center></td>
                    <td><center><input type="button" value="Delete" onclick="confirmDelete('{{url('blog/destroy/'.$blog->id)}}')" class="btn btn-danger"></center></td>

                    </tr>

                   <?php $i++ ?>
                @endforeach
            </tbody>

        </table>
    </div>

	 </div>
@endsection


