@extends('layouts.layout')

@section('title', 'Add Activity Details')

@section('body')

{!! Form::open(['route' => 'ActivityDetails.store', 'method'=>'post']) !!}
<!--{!! Form::open() !!}-->

<div class="box box-primary">
    <div class="box-body">

        
      <div class="form-group">
            {!! Form::Label('class', 'class') !!}
            {!! Form::select('class', $batch->class, null, ['class' => 'form-control', 'id' =>'class' ]) !!}
        </div>      
 <div class="form-group">
            {!! Form::Label('division', 'division') !!}
            {!! Form::select('division', $batch->division, null, ['class' => 'form-control', 'id' =>'division']) !!}
        </div>    
        <div class="form-group">
            {!! Form::Label('student_id', 'Student') !!}
            {!! Form::select('student_id',['0'=>'Select Student'] + $users, null, ['class' => 'form-control']) !!}
        </div> 

         <div class="form-group">
            {!! Form::Label('activity_types', 'Activity Type') !!}
            {!! Form::select('activity_types',[null=>'Select Activity'] + $activity_types, null,  ['class' => 'form-control']) !!}
        </div>
 

        <div class="form-group">
            {!! Form::label('remark', 'Remark') !!}
            {!! Form::text('remark', null,  ['placeholder'=>'Remark', 'class' => 'form-control']) !!}
           
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
        var batch_id = $('#class').val();
        window.location.href='{{url("ActivityDetails/create")}}/?param1='+batch_id;
    });
</script>

@endsection