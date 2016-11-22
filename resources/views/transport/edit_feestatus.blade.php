@extends('layouts.layout')

@section('title', 'Edit Bus Fee')

@section('body')


{!! Form::model($busfees, ['method'=>'PATCH','route' => ['FeeStatus.update', $busfees->id]]) !!}

<div class="box box-primary">
    <div class="box-body">

        <div class="form-group">
            {!! Form::Label('param1', 'Batch') !!}
            {!! Form::select('param1', $batch,  $batch_id, ['class' => 'form-control']) !!}
        </div> 

        <div class="form-group">
            {!! Form::Label('student_id', 'Student') !!}
            {!! Form::select('student_id', $users,  null, ['class' => 'form-control']) !!}
        </div>  

        <div class="form-group">
            {!! Form::Label('month', 'Month') !!}
            {!! Form::select('month', $months, null, ['class' => 'form-control']) !!}
        </div>

        

        <div class="form-group">
            {!! Form::Label('year', 'Year') !!}
            {!! Form::select('year', $dates, null, ['class' => 'form-control']) !!}
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
        window.location.href='{{url("BusFee/".$busfees->id."/edit")}}/?param1='+batch_id;
    });
</script>
@endsection
