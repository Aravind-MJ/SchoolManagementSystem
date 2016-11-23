@extends('layouts.layout')

@section('title', 'Edit Notice')

@section('content')
@section('body')

{!! Form::model($notice, ['method'=>'PATCH','route' => ['Notice.update', $notice->id]]) !!}
<div class="box box-primary">
    <div class="box-body">

        <div class="form-group">
            {!! Form::Label('class', 'Class') !!}
            {!! Form::select('class', $batch->class, null, ['class' => 'form-control']) !!}
        </div>  
        <div class="form-group">
            {!! Form::Label('division', 'Division') !!}
            {!! Form::select('division', $batch->division, null, ['class' => 'form-control']) !!}
        </div>
        <!-- message Field -->
        <div class="form-group">
            {!! Form::label('message', 'Message') !!}        
            {!! Form::textarea('message', null,  ['class' => 'form-control ckeditor']) !!}
            {!! errors_for('message', $errors) !!}
        </div>

        <br>
        
        <div class="form-group">
            {!! Form::submit( 'Submit', ['class'=>'btn btn-primary']) !!} 
        </div>

        {!! Form::close() !!}
    </div>

</div>
@stop
@section('ckeditor')
<script src="//cdn.ckeditor.com/4.5.7/standard/ckeditor.js" />
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


 
