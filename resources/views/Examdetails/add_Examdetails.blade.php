@extends('layouts.layout')

@section('title', 'Add Exam Details')

@section('body')

{!! Form::open(['route' => 'ExamDetails.store', 'method'=>'post','enctype' => 'multipart/form-data']) !!}

<div class="box box-primary">
    <div class="box-body">

        <!-- first_name Field -->
        <div class="form-group">
            {!! Form::label('exam_type', 'Examtype') !!}
            {!! Form::select('type_id',$Examtype,null,['class' => 'form-control', 'placeholder'=>''])!!}
            {!! errors_for('exam_type', $errors) !!}
            <!--{!! errors_for('first_name', $errors) !!}-->
        </div>
        <div class="form-group">
            {!! Form::label('exam_date', 'Exam_date') !!}
            {!! Form::text('exam_date', null, ['class' => 'form-control', 'placeholder'=>'','id' => 'datepicker1'])!!}
            {!! errors_for('exam_date', $errors) !!}
        </div>
        
           <div class="form-group">
            {!! Form::label('total_mark', 'TotalMark') !!}
            {!! Form::text('total_mark', null, ['class' => 'form-control', 'placeholder'=>'Totalmark'])!!}
            {!! errors_for('total_mark', $errors) !!}
         </div>
        <br>
        <div class="form-group">
            {!! Form::submit( 'Submit', ['class'=>'btn btn-primary']) !!} 
        </div>

        {!! Form::close() !!}
        <!--                @if($errors->any())
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                @endif-->
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

