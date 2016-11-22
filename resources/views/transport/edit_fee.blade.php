@extends('layouts.layout')

@section('title', 'Edit Bus Fee')

@section('body')


{!! Form::model($busfees, ['method'=>'PATCH','route' => ['BusFee.update', $busfees->id]]) !!}

<div class="box box-primary">
    <div class="box-body">

       <div class="form-group col-md-6">
            {!! Form::Label('class', 'Class') !!}
            {!! Form::select('class',(['' => 'Select Class'] + $batch->class),$clasz ,['class' => 'form-control']) !!}
        </div>

             <div class="form-group col-md-6">
            {!! Form::Label('division', 'Division') !!}
            {!! Form::select('division',(['' => 'Select Division'] + $batch->division),$division,['class' => 'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::Label('student_id', 'Student') !!}
            {!! Form::select('student_id', $users,  null, ['class' => 'form-control']) !!}
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
<script type="text/javascript">
    $('#class').change(function(){  
        var clasz = $('#class').val();
        var division=$('#division').val();
        if(clasz!= null ){
            window.location.href='{{url("BusFee/".$busfees->id."/edit")}}/?class='+clasz+'&division='+division;
        }
    });
    $('#division').change(function(){  
        var clasz = $('#class').val();
        var division=$('#division').val();
        if(clasz!= null ){
            window.location.href='{{url("BusFee/".$busfees->id."/edit")}}/?class='+clasz+'&division='+division;
        }
    });
</script>
@endsection
