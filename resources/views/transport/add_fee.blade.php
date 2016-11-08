@extends('layouts.layout')

@section('title', 'Add Bus Fee')

@section('body')

{!! Form::open(['route' => 'BusFee.store','method'=>'POST']) !!}
<!--{!! Form::open() !!}-->
<div class="box box-primary">
    <div class="box-body">
        <div class="form-group">
            {!! Form::Label('param1', 'Batch') !!}
            {!! Form::select('param1',(['0' => 'Select batch'] + $batch),$batch_id,['class' => 'form-control']) !!}
        </div> 
		<div class="form-group">
		<table id="example2" class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>SL.No</th>
                    <th>Batch</th>
                    <th>Student</th>
                    <th>Bus</th>
                    <th>Fee</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
            </thead>
			<tbody>
			<?php $i=1 ?>
			
                @foreach( $users as $user )
				
                <tr>
                    <td>{{ $i }}</td>
                    <td></td>
                    <td>{{ $user->first_name}} {{ $user->last_name}}</td>
                    <td></td>
                    <td></td>
					  <td class=center>                       
                        <a href="{{route('BusFee.edit',$user->id)}}" class='btn btn-primary'>Edit</a>
                    </td>                   
                    <td class=center>
                        {!! Form::open(['route' => ['BusFee.destroy', $user->id], 'method' => 'DELETE', 'class' => 'delete']) !!}                        
                        <button type="submit" class="btn btn-danger">Delete</button>
                        {!! Form::close() !!}
                    </td>
					</tr>
					<?php $i++ ?>
					@endforeach

					</tbody>
			</table>
        {!! Form::close() !!}
		
		
    </div>

</div>
@endsection
@section('pagescript')
<script type="text/javascript">
    $('#param1').change(function(){  
        var batch_id = $('#param1').val();
        window.location.href='{{url("BusFee/create")}}/?param1='+batch_id;
    });
</script>
@endsection
