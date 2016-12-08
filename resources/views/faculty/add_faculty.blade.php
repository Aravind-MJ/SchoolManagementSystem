@extends('layouts.layout')

@section('title', 'Add Faculty')

@section('content')

@section('body')


{!! Form::open(['action' => 'FacultyController@store','enctype' => 'multipart/form-data', 'name' => 'Faculty']) !!}
<!--{!! Form::open() !!}-->
<div class="box box-primary">
    <div class="box-body">

        <!-- first_name Field -->
        <div class="form-group">
            {!! Form::label('first_name', 'First Name') !!}
            {!! Form::text('first_name', null, ['class' => 'form-control', 'placeholder'=>'Enter First Name']) !!}
            {!! errors_for('first_name', $errors) !!}
        </div>

        <!-- last_name Field -->
        <div class="form-group">
            {!! Form::label('last_name', 'Last Name') !!}
            {!! Form::text('last_name', null, ['class' => 'form-control', 'placeholder'=>'Enter Last Name']) !!}
            {!! errors_for('last_name', $errors) !!}
        </div>

        <div class="form-group">
            {!! Form::label('qualification', 'Qualification') !!}
            {!! Form::text('qualification', null, ['class'=>'form-control', 'placeholder'=>'Enter Qualification']) !!}
            {!! errors_for('qualification', $errors) !!}
        </div>

        <div class="form-group">
            {!! Form::label('phone', 'Phone') !!}
            {!! Form::text('phone', null, ['class'=>'form-control', 'placeholder'=>'Enter Phone']) !!}
            {!! errors_for('phone', $errors) !!}
        </div>

        <div class="form-group">
            {!! Form::label('address', 'Address') !!}
            {!! Form::textarea('address', null,  ['class'=>'form-control', 'placeholder'=>'Address']) !!}
            {!! errors_for('address', $errors) !!}
        </div>

        <!-- email Field -->
        <div class="form-group">
            {!! Form::label('email', 'Email') !!}
            {!! Form::email('email', null, ['class' => 'form-control','placeholder'=>'Email']) !!}
            {!! errors_for('email', $errors) !!}
        </div>

        <!-- Password field -->
        <div class="form-group">
            {!! Form::label('password', 'Password') !!}
            {!! Form::password('password', ['class' => 'form-control', 'placeholder'=>'Password']) !!}
            {!! errors_for('password', $errors) !!}
        </div>

        <!-- Password Confirmation field -->
        <div class="form-group">
            {!! Form::label('password_confirmation', 'Repeat Password') !!}
            {!! Form::password('password_confirmation', ['class' => 'form-control', 'placeholder'=>'Repeat Password'] )!!}
            {!! errors_for('password_confirmation', $errors) !!}
        </div> 

        <div class="form-group">
            {!! Form::label('photo', 'Photo') !!}
            {!! Form::file('photo', null, ['class'=>'form-control']) !!}
            {!! errors_for('photo', $errors) !!}
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

        $("form[name='Faculty']").validate({
            errorElement: 'div',
            rules: {
                first_name: {required: true,lettersonly: true},
                last_name: {required: true,lettersonly: true},
                qualification: {required: true,dot: true},
                email: {required: true,email: true},
                phone:{
                    required: true,
                    number: true,
                    minlength:10,
                    maxlength:10,
                    },
                address:{
                    required: true,
                    minlength:6,
                    },
                password:{
                    required: true,
                    minlength:6,
                    },
                password_confirmation:{
                    required: true,
                    minlength:6,
                    },
                photo:{
                    required:true,
                    accept: "jpeg,jpg,png"
                }
                                 
            },

            messages: {
                first_name: {required: "Please Enter the First Name",lettersonly: "Please Enter Letters only"},
                last_name: {required: "Please Enter the Last Name",lettersonly: "Please Enter  Letters only"},
                email:{required: "Please Enter Mail-id", email: "Please Enter a valid Mail-id!"},
                phone:{required: "Please Enter the Phone Number.",minlength: "Enter 10 Digit Phone Number",maxlength: "Enter 10 Digit Phone Number",number: "Please Enter a valid Phone Number"},
                qualification: {required: "Please Enter the Qualification",dot: "Please Enter a valid Qualification"},
                address:{required: "Please Enter the Address",minlength: "Please Enter a valid Address"},
                password:{required: "Please Enter the Address",minlength: "Password should contain atleast 6 characters"},
                password_confirmation:{required: "Please Confirm the Password",minlength: "Please Confirm the Password"},
                photo:{required: "Please Add the Photo", accept: "Please add a jpg,jpeg or png image"},
            },
            submitHandler: function (form) {
                form.submit();

            }
        });
    });
    
    jQuery.validator.addMethod("lettersonly", function(value, element) {
                return this.optional(element) || /^[a-zA-Z\s]+$/.test(value);},    "Letters only please"); 
    jQuery.validator.addMethod("dot", function(value, element) {
                return this.optional(element) || /^[a-zA-Z\ .-]+$/.test(value);},    " only please"); 
</script>
@endsection

