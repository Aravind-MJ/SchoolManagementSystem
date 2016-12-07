@extends('layouts.layout')

@section('title', 'Edit Admin')

@section('body')
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Edit</h3>
                    </div>
                    <div class="box-body">
                        {!! Form::open(['route' => ['registration.update',$user->enc_id], 'name' => 'edit']) !!}
                        <fieldset>

                            @include('flash')

                            <!-- Email field -->
                            <div class="form-group">
                                {!! Form::text('email', $user->email, ['disabled' => '', 'class' => 'form-control', 'required' => 'required'])!!}
                                {!! errors_for('email', $errors) !!}
                            </div>

                            <!-- First name field -->
                            <div class="form-group">
                                {!! Form::text('first_name', $user->first_name, ['placeholder' => 'First Name', 'class' => 'form-control', 'required' => 'required'])!!}
                                {!! errors_for('first_name', $errors) !!}
                            </div>

                            <!-- Last name field -->
                            <div class="form-group">
                                {!! Form::text('last_name', $user->last_name, ['placeholder' => 'Last Name', 'class' => 'form-control', 'required' => 'required'])!!}
                                {!! errors_for('last_name', $errors) !!}
                            </div>

                            <!-- Submit field -->
                            <div class="form-group">
                                {!! Form::submit('Edit Admin', ['class' => 'btn btn-lg btn-primary btn-block']) !!}
                            </div>
                            <div class="form-group">
                            <input class="form-button" type="reset" value="Clear form">
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

        $("form[name='edit']").validate({
            errorElement: 'div',
            rules: {
                first_name: {required: true,lettersonly: true},
                last_name: {required: true,lettersonly: true},                 
            },

            messages: {
                first_name: {required: "Please Enter the First Name",lettersonly: "Please Enter  Letters Only"},
                last_name: {required: "Please Enter the Last Name",lettersonly: "Please Enter  Letters Only"},
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