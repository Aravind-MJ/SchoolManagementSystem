@extends('layouts.layout')

@section('title', 'Edit Class Details')

<!--@section('content')

@if (session()->has('flash_message'))
<p>{{ session()->get('flash_message') }}</p>
@endif-->

@section('body')

{!! Form::model($Batchdetails, ['method' => 'PATCH', 'route' => ['ClassDetails.update',$Batchdetails->id],'enctype' => 'multipart/form-data']) !!}
@include('flash')
<!--{!! Form::open() !!}-->
<div class="box box-primary">
    <div class="box-body">

        <!-- first_name Field -->
        <div class="form-group">
            {!! Form::label('class', 'Class') !!}
            {!! Form::text('class', null, ['class' => 'form-control', 'placeholder'=>'Enter  Batch']) !!}
            {!! errors_for('batch', $errors) !!}
        </div>
         <div class="form-group">
            {!! Form::label('division', 'Division') !!}
            {!! Form::text('division', null, ['class' => 'form-control', 'placeholder'=>'Enter Syllabus']) !!}
            {!! errors_for('syllabus', $errors) !!}
        </div>
<!--        <div class="form-group">
            {!! Form::label('time_shift', 'Time_shift') !!}
            {!! Form::select('time_shift',array('Morning' => 'Morning', 'AfterNoon' => 'AfterNoon','Evening' =>'Evening'),null, ['class' => 'form-control', 'placeholder'=>'00.00-00.00','id' => 'calendar1'])!!}
            {!! errors_for('time_shift', $errors) !!}
        </div>-->
        
        <div class="form-group">
            {!! Form::label('in_charge', 'Incharge') !!}
            {!! Form::select('in_charge',$users,null,['class' => 'form-control', 'placeholder'=>''])!!}
            {!! errors_for('name', $errors) !!}
           
        </div>
       
        <br>
        <div class="form-group">
            {!! Form::submit( 'Submit', ['class'=>'btn btn-primary']) !!} 
        </div>

        {!! Form::close() !!}
        <!--                @if($errors->any())
                    <ul class="alert alert-danger">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                @endif-->
    </div>

</div>
@stop

@endsection
@section('validation')
<script>
 $(function () {

	    $("form[name='contact']").validate({

	        rules: {
	            name: {required: true,lettersonly: true},
	            email: {required: true,email: true},
	            phone:{
	    			required: true,
	                number: true,
	                minlength:10,
	                maxlength:10,
	                },
	            message:"required"                    
	    },

			messages: {
	            name: {required: "Please enter your name",lettersonly: "Please enter  letters only"},
	            email:{required: "Please enter email", email: "Please enter valid email!"},
	            phone:{required: "Please enter your phone number.",minlength: "Enter 10 digit phone number",maxlength: "Enter 10 digit phone number"},
	            message:"Please enter message"
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

