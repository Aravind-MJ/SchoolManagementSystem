@extends('layouts.layout')

@section('title', 'Add Bus')

@section('body')

{!! Form::open(['route' => 'transportation.store','method'=>'POST']) !!}
<!--{!! Form::open() !!}-->
<div class="box box-primary">
    <div class="box-body">

        <div class="form-group">
            {!! Form::Label('bus_no', 'Bus Number') !!}
            {!! Form::text('bus_no', null, ['class' => 'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::Label('number_plate', 'Number Plate') !!}
            {!! Form::text('number_plate', null, ['class' => 'form-control']) !!}
        </div>  

        <div class="form-group">
            {!! Form::Label('driver', 'Driver') !!}
            {!! Form::text('driver', null, ['class' => 'form-control']) !!}
        </div> 

        <div class="form-group">
            {!! Form::Label('cleaner', 'Cleaner') !!}
            {!! Form::text('cleaner', null, ['class' => 'form-control']) !!}
        </div> 

        <div class="form-group">
            {!! Form::Label('route', 'Route') !!}
            {!! Form::text('route', null, ['class' => 'form-control']) !!}
        </div>
        
        <br>
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


 
