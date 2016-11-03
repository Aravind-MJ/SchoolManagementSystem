@extends('layouts.layout')

@section('title', 'Add Bus Fee')

@section('body')

{!! Form::open(['route' => 'BusFee.store','method'=>'POST']) !!}
<!--{!! Form::open() !!}-->
<div class="box box-primary">
    <div class="box-body">
        <div class="form-group">
            {!! Form::Label('param1', 'Batch') !!}
            {!! Form::select('param1', $batch,  $batch_id, array('placeholder' => 'Please select
             batch','class' => 'form-control','id'=>'param1')) !!}
        </div> 

        <div class="form-group">
            {!! Form::Label('student_id', 'Student') !!}
            {!! Form::select('student_id', $users, array('0'=>"Select a Batch to Show it's students"),
            null, array('class'=>'form-control','id'=>'param2', 'placeholder'=>'Search for student...','disabled')) !!}
        </div>  

        <div class="form-group">
            {!! Form::Label('bus_id', 'Bus') !!}
            {!! Form::select('bus_id', $buses, null, ['class' => 'form-control']) !!}
        </div>

        

        <div class="form-group">
            {!! Form::Label('fee', 'Fee') !!}
            {!! Form::text('fee', null, ['class' => 'form-control']) !!}
        </div> 
        
        <br>
        <div class="form-group">
            {!! Form::submit( 'Submit', ['class'=>'btn btn-primary']) !!} 
        </div>

        {!! Form::close() !!}
    </div>

</div>
@endsection
@section('pagescript')
<script>
    $('#param1').change(function () {
        var batch_id = $('#param1').val();
        $.get('{{url('progressFetchStudents')}}?batch_id=' + batch_id,
                function (response) {
                    if (response != '') {
                        $('#param2').html(response).removeAttr('disabled');
                    } else {
                        $('#param2').html('<option>No students found</option>').attr('disabled', 'disabled');
                    }
                })
    });
</script>
@endsection
@section('pagescript')
<script type="text/javascript">
    $('#param1').change(function(){
        var batch_id = $('#param1').val();
        window.location.href='{{url("BusFee/create")}}/?param1='+batch_id;
    });
</script>
@endsection
