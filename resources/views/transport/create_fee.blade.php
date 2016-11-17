@extends('layouts.layout')

@section('title', 'Create Bus Fee')

@section('body')
{!! Form::open(['route' => 'BusFee.store','method'=>'POST']) !!}
<!--{!! Form::open() !!}-->
<div class="box box-primary">
    <div class="box-body">
        <div class="form-group">
            {!! Form::Label('student_id', 'Student') !!}
            {!! Form::text('student',$users->first_name.' '.$users->last_name, ['class' => 'form-control','readonly']) !!}
            {!! Form::hidden('student_id', $selected_user, ['class' => 'form-control']) !!}
            {!! Form::hidden('param1', $selected_batch, ['class' => 'form-control']) !!}
            
        </div>  

        <div class="form-group">
            {!! Form::Label('bus_id', 'Bus') !!}
            {!! Form::select('bus_id', (['0' => 'Select bus'] + $buses), null, ['class' => 'form-control']) !!}
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
<script type="text/javascript">
    $('#param1').change(function(){  
        var batch_id = $('#param1').val();
        window.location.href='{{url("BusFee")}}/?param1='+batch_id;
    });
</script>
@endsection
