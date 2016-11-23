@extends('layouts.layout')

@section('title', 'Add Bus Fee')

@section('body')

{!! Form::open(['route' => 'BusFee.store','method'=>'POST']) !!}
<!--{!! Form::open() !!}-->
<div class="box box-primary">
    <div class="box-body">


        <div class="form-group col-md-6">
            {!! Form::Label('class', 'Class') !!}
            {!! Form::select('class',(['' => 'Select Class'] + $batch->class),$clasz ,['class' => 'form-control']) !!}
        </div>

             <div class="form-group col-md-6">
            {!! Form::Label('division', 'Division') !!}
            {!! Form::select('division',(['' => 'Select Division'] + $batch->division),$division,['class' => 'form-control']) !!}

        </div>

        <div class="form-group">
           {!! Form::Label('student_id', 'Student') !!}
            {!! Form::select('student_id',(['' => 'Select Student'] + $users),null,['class' => 'form-control']) !!}
        </div>  

        <div class="form-group">
            {!! Form::Label('bus_id', 'Bus') !!}
            {!! Form::select('bus_id', (['' => 'Select Bus'] + $buses), null, ['class' => 'form-control']) !!}
        </div>

        

        <div class="form-group">
            {!! Form::Label('fee', 'Fee') !!}
            {!! Form::text('fee', null, ['class' => 'form-control']) !!}
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
        var clasz = $('#class').val();
        var division=$('#division').val();
        if(clasz!= null ){
            window.location.href='{{url("BusFee/create")}}/?class='+clasz+'&division='+division;
        }
    });
    $('#division').change(function(){  
        var clasz = $('#class').val();
        var division=$('#division').val();
        if(clasz!= null ){
            window.location.href='{{url("BusFee/create")}}/?class='+clasz+'&division='+division;
        }
    });
</script>
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

