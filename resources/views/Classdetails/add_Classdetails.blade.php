@extends('layouts.layout')

@section('title', 'Add Class Details')

@section('content')

@section('body')

{!! Form::open(['route' => 'ClassDetails.store', 'method'=>'post','enctype' => 'multipart/form-data']) !!}

<!--{!! Form::open() !!}-->
<div class="box box-primary">
    <div class="box-body">

        <!-- first_name Field -->
        <div class="form-group">
            {!! Form::label('class', 'Class') !!}
            {!! Form::text('class', null, ['class' => 'form-control', 'placeholder'=>'Enter  Batch']) !!}
           {!! errors_for('class', $errors) !!}
        </div>
         <div class="form-group">
            {!! Form::label('division', 'Division') !!}
            {!! Form::text('division', null, ['class' => 'form-control', 'placeholder'=>'Enter Syllabus']) !!}
             {!! errors_for('division', $errors) !!}
        </div>
       
        <div class="form-group">
            {!! Form::label('in_charge', 'Incharge') !!}
            {!! Form::select('in_charge',$users,null,['class' => 'form-control', 'placeholder'=>''])!!}
            {!! errors_for('in_charge', $errors) !!}
            <!--{!! errors_for('first_name', $errors) !!}-->
        </div>
       
        <br>
        <div class="form-group">
            {!! Form::submit( 'Submit', ['class'=>'btn btn-primary']) !!} 
        </div>

        {!! Form::close() !!}
       
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

