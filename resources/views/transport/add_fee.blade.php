@extends('layouts.layout')

@section('title', 'Add Bus Fee')

@section('body')


<!--{!! Form::open() !!}-->
<div class="box box-primary">
    <div class="box-body">
        <div class="form-group">
			{!! Form::open(['route' => 'BusFee.store','method'=>'POST']) !!}
            {!! Form::Label('param1', 'Batch') !!}
            {!! Form::select('param1',(['0' => 'Select batch'] + $batch),$batch_id,['class' => 'form-control']) !!}
			{!! Form::close() !!}
        </div> 
		<div class="form-group">
		<table id="example1" class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>SL.No</th>                   
                    <th>Student</th>
                    <th>Bus</th>
                    <th>Fee</th>
                    <th>Update</th>
                    <th>Clear</th>
                </tr>
            </thead>
            <tbody>
            <?php $i=1 ?>
            
                @foreach( $users as $user )
                
                <tr>
                    <td>{{ $i }}</td>
                  
                    <td>{{ $user->first_name}} {{ $user->last_name}}</td>
						@if($user->bus_id==null)
							<td colspan="4"><center><a href="{{url('BusFee/create')}}/?param1={{$batch_id}}&student_id={{$user->id}}"
							{!! Form::button( 'Add', ['class'=>'btn btn-primary','style'=>'width:200px;']) !!}</a></center> </td>
						@else
                    <td>{!! Form::select('bus_id_list', (['0' => 'Select bus'] + $buses), $user->bus_id	, ['class' => 'form-control']) !!}</td>
                       <td>{!! Form::text('fee_text',$user->bus_fee, ['class' => 'form-control']) !!}</td>  
					   
					  <td> <div class="form-group">
					  {!! Form::open(['route' =>['BusFee.update', $user->table_id],'method'=>'PATCH']) !!}
					  {!! Form::hidden('param1', $batch_id, ['class' => 'form-control']) !!}
					  {!! Form::hidden('student_id', $user->id, ['class' => 'form-control']) !!}
					  {!! Form::hidden('bus_id', $user->bus_id, ['class' => 'form-control']) !!}
					  {!! Form::hidden('fee',$user->bus_fee, ['class' => 'form-control']) !!}
					  {!! Form::submit( 'Update', ['class'=>'btn btn-primary']) !!} 		  
					  {!! Form::close() !!}
					  </div>  </td>			
                    <td class=center>
                        {!! Form::open(['route' => ['BusFee.destroy', $user->table_id], 'method' => 'DELETE', 'class' => 'delete']) !!}                        
                        <button type="submit" class="btn btn-danger">Clear</button>
						
                        {!! Form::close() !!}
                    </td>	
					@endif
					</tr>
					<?php $i++ ?>
					@endforeach

                    </tbody>
            </table>
        {!! Form::close() !!}
        <div class="form-group">
            {!! Form::submit( 'Submit', ['class'=>'btn btn-primary']) !!} 
        </div>
        
    </div>

</div>
@endsection
@section('pagescript')
<script type="text/javascript">
    $('#param1').change(function(){  
        var batch_id = $('#param1').val();
        window.location.href='{{url("BusFee")}}/?param1='+batch_id;
    });
	
	$('select[name="bus_id_list"]').change(function(){
		var val = $('select[name="bus_id_list"]').val();
		$('input[name="bus_id"]').attr('value',val);
	});
	
	$('input[name="fee_text"]').change(function(){
		var val = $('input[name="fee_text"]').val();
		$('input[name="fee"]').attr('value',val);
	});
	if (typeof(console) != "undefined") {
		alert = console.log; 
	}
</script>
@endsection
@section('confirmDelete')
<script>
    $(".delete").on("submit", function(){
        return confirm("Do you want to delete this item?");
    });
</script>
@stop
@section('dataTable')
<script type="text/javascript">
    $(function () {
        $("#example1").dataTable();
        $('#example2').dataTable({
            "bPaginate": true,
            "bLengthChange": false,
            "bFilter": true,
            "bSort": true,
            "bInfo": true,
            "bAutoWidth": false
        });
    });
</script>
@stop
@endsection