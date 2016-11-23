@extends('layouts.layout')

@section('title', 'Add Store Details')

@section('body')

{!! Form::open(['route' => 'StoreManagement.store', 'method'=>'post']) !!}

<!--{!! Form::open() !!}-->
<div class="box box-primary">
    <div class="box-body">

        <div class="form-group">
            {!! Form::Label('store_type','Item') !!}
            {!! Form::select('store_type',['0'=>'Select Item'] + $store_type,null, ['class' => 'form-control']) !!}
        </div>

         <div class="form-group">
            {!! Form::label('item_brand', 'Brand') !!}
            {!! Form::text('item_brand', null, ['class' => 'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::Label('item_cost','Cost') !!}
            {!! Form::text('item_cost', null, ['class' => 'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::Label('item_detail','Details') !!}
            {!! Form::text('item_detail', null, ['class' => 'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::Label('item_stock','Stock') !!}
            {!! Form::text('item_stock', null, ['class' => 'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::Label('item_limit','Threshold') !!}
            {!! Form::text('item_limit', null, ['class' => 'form-control']) !!}
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


