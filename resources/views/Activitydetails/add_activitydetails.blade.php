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
            {!! Form::select('class',($batch->class),$clasz,['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::Label('division', 'Division') !!}
            {!! Form::select('division',($batch->division),$division,['class' => 'form-control']) !!}
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
    $('#class').change(function(){
        var claz = $('#class').val();
        var division=$('#division').val();
        if(claz!= '' && division!= ''){
            window.location.href='{{url("ActivityDetails/create")}}/?class='+claz+'&division='+division;
        }
    });
    $('#division').change(function(){
            var claz = $('#class').val();
            var division=$('#division').val();
            if(claz!= '' && division!= ''){
                window.location.href='{{url("ActivityDetails/create")}}/?class='+claz+'&division='+division;
            }
        });
</script>

@endsection
@section('validation')
<script>
    
    $(function() {

        $("form[name='ad']").validate({
            errorElement: 'div',
            rules: {
                class:"required",
                division:"required",
                student_id:"required",
                activity_types:"required",
                },
             messages: {
                class: "Please Select Class",
                division: "Please Select Division",
                student_id: "Please Select Student",
                activity_types:"Please Select Activity Type",
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