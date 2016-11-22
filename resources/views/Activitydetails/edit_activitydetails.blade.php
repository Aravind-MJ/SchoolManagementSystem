@extends('layouts.layout')

@section('title', 'Edit Activity Details')

@section('body')

{!! Form::open(['route' => ['ActivityDetails.update',$allActivityDetails->id], 'method'=>'PATCH']) !!}
<!--{!! Form::open() !!}-->
<div class="box box-primary">
    <div class="box-body">

        
        <div class="form-group">
            {!! Form::Label('class', 'Class') !!}
            {!! Form::select('class',(['' => 'Select Class'] + $batch->class),$clasz ,['class' => 'form-control']) !!}
        </div>

             <div class="form-group">
            {!! Form::Label('division', 'Division') !!}
            {!! Form::select('division',(['' => 'Select Division'] + $batch->division),$division,['class' => 'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::Label('student_id', 'Student') !!}
            {!! Form::select('student_id', $users, $allActivityDetails->student_id ,['class' => 'form-control']) !!}
        </div> 

         <div class="form-group">
            {!! Form::Label('activity_types', 'Activity Type') !!}
            {!! Form::select('activity_types', $activity_types, $allActivityDetails->activity_id,  ['class' => 'form-control']) !!}
        </div>
 

        <div class="form-group">
            {!! Form::label('remark', 'Remark') !!}
            {!! Form::text('remark', $allActivityDetails->remark,  ['class' => 'form-control']) !!}
             {!! errors_for('question', $errors) !!}
           
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
        window.location.href='{{url("ActivityDetails/".$allActivityDetails->id."/edit")}}/?param1='+batch_id;
    });
</script>
@endsection