@extends('layouts.layout')

@section('title', 'Edit Activity')

@section('body')

{!! Form::model($Activitytype, ['method' => 'PATCH', 'route' => ['Activity.update',
$Activitytype->id],'enctype' => 'multipart/form-data','id'=>'activity']) !!}
@include('flash')
<!--{!! Form::open() !!}-->
<div class="box box-primary">
    <div class="box-body">

        <!-- first_name Field -->
        <div class="form-group">
            {!! Form::label('activity_type', 'Activity Type') !!}
            {!! Form::text('activity_type', null, ['class' => 'form-control', 'placeholder'=>'Enter  Activity']) !!}
            <!--{!! errors_for('first_name', $errors) !!}-->
        </div>
        <div class="form-group">
            {!! Form::submit( 'Submit', ['class'=>'btn btn-primary']) !!} 
        </div>

        {!! Form::close() !!}
        
    </div>

</div>
@endsection
@section('validation')
<script>
    
    $(function () {

        $("form#activity").validate({

            errorElement: 'div',
            rules: {
                activity_type: {required: true,lettersonly: true}
                },
             messages: {
                activity_type: {required: "Please enter Activity Type",lettersonly: "Please enter  letters only"}
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