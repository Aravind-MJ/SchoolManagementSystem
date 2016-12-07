@extends('layouts.layout')

@section('title', 'Create Admin')

@section('body')
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Register</h3>
                    </div>
                    <div class="box-body">
                        {!! Form::open(['route' => 'registration.store' , 'name' => 'Admin']) !!}
                        <fieldset>

                             <!-- First name field -->
                            <div class="form-group">
                                {!! Form::text('first_name', null, ['placeholder' => 'First Name', 'class' => 'form-control', 'required' => 'required'])!!}
                                {!! errors_for('first_name', $errors) !!}
                            </div>

                            <!-- Last name field -->
                            <div class="form-group">
                                {!! Form::text('last_name', null, ['placeholder' => 'Last Name', 'class' => 'form-control', 'required' => 'required'])!!}
                                {!! errors_for('last_name', $errors) !!}
                            </div>

                            <!-- Email field -->
                            <div class="form-group">
                                {!! Form::text('email', null, ['placeholder' => 'Email', 'class' => 'form-control', 'required' => 'required'])!!}
                                {!! errors_for('email', $errors) !!}
                            </div>

                            <!-- Password field -->
                            <div class="form-group">
                                {!! Form::password('password', ['placeholder' => 'Password', 'class' => 'form-control', 'required' => 'required'])!!}
                                {!! errors_for('password', $errors) !!}
                            </div>

                            <!-- Password Confirmation field -->
                            <div class="form-group">
                                {!! Form::password('password_confirmation', ['placeholder' => 'Password Confirm', 'class' => 'form-control', 'required' => 'required'])!!}

                            </div>

                            <!-- Submit field -->
                            <div class="form-group">
                                {!! Form::submit('Create Admin', ['class' => 'btn btn-lg btn-primary btn-block']) !!}
                            </div>

                        </fieldset>
                        {!! Form::close() !!}
                    </div>
                </div>

            </div>
        </div>

@endsection

@section('validation')
<script>
 $(function () {

        $("form[name='Admin']").validate({
            errorElement: 'div',
            rules: {
                first_name: {required: true,lettersonly: true},
                last_name: {required: true,lettersonly: true},
                email: {required: true,email: true},
                password:{
                    required: true,
                    minlength:6,
                    },
                password_confirmation:{
                    required: true,
                    },                   
            },

            messages: {
                first_name: {required: "Please Enter the First Name",lettersonly: "Please Enter  Letters Only"},
                last_name: {required: "Please Enter the Last Name",lettersonly: "Please Enter  Letters Only"},
                email:{required: "Please Enter Email", email: "Please Enter a Valid Mail-ID!"},
                password:{required: "Please Enter a 6 Digit Password",minlength: "Enter 6 Digit Password",},
                password_confirmation:{required: "Please Confirm Your Password",},
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