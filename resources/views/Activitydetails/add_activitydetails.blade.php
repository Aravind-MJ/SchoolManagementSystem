@extends('layouts.layout')

@section('title', 'Add Activity Details')

@section('content')

@section('body')

{!! Form::open(['route' => 'ActivityDetails.store', 'method'=>'post', 'name' => 'ad']) !!}
<!--{!! Form::open() !!}-->

<div class="box box-primary">
    <div class="box-body">

        
        <div class="form-group">
            {!! Form::Label('class', 'Class') !!}
            {!! Form::select('class',(['null' => 'Select Class'] + $batch->class),null,['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::Label('division', 'Division') !!}
            {!! Form::select('division',(['null' => 'Select division'] + $batch->division),null,['class' => 'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::Label('student_id', 'Student') !!}
            {!! Form::select('student_id',['null'=>'Select Student'] + $users, null, ['class' => 'form-control']) !!}
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
<script>
    $('#division').change(function(){  
        var claz = $('#class').val();
        var division=$('#division').val();
        if(claz!= null ){
            window.location.href='{{url("ActivityDetails/create")}}/?class='+claz+'&division='+division;
        }
    });
</script>

@endsection
@section('validation')
<script>
    
    $(function () {

        $("form[name='ad']").validate({

            rules: {
                class:"required",
                division:"required",
                student_id:"required",
                activity_types:"required",
                remark:{required: true,lettersonly: true}
                },
             messages: {
                class: "Please select Class",
                division: "Please select division",
                student_id: "Please select Student",
                activity_types: "Please select Activity Type",
                remark: {required: "Please enter Remark",lettersonly: "Please enter  letters only"}
                 },
            submitHandler: function (form) {
                form.submit();

            }
        });
    });
    
    jQuery.validator.addMethod("lettersonly", function(value, element) {
                return this.optional(element) || /^[a-zA-Z\s]+$/.test(value);},    "Letters only please"); 
</script>

@endsection