@extends('layouts.layout')

@section('title', 'Edit Faculty')

@section('content')

@section('body')


<div class="row">
    <div class="col-md-6 col-md-offset-1">
        <div class="box box-primary">
            <div class="box-header">
                <h3 class="box-title">Faculty Profile Details</h3>
            </div>
            <div class="box-body">
                {!! Form::model($user,['method'=>'POST','route' => ['facultyProfile.update',$user->enc_id], 'name' => 'Faculty']) !!}

                <fieldset>
                    
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
                        {!! Form::submit('Edit Faculty', ['class' => 'btn btn-lg btn-primary btn-block']) !!}
                    </div>

                </fieldset>
                {!! Form::close() !!}
            </div>
        </div>

    </div>

    {!! Form::model($faculty, ['method' => 'PATCH', 'route' => ['Faculty.update', $faculty->enc_id],'enctype' => 'multipart/form-data','name' => 'Faculty1']) !!}
    <div class="col-md-6 col-md-offset-1">
        <div class="box box-primary">
            <div class="box-header">
                <h3 class="box-title">Faculty Personal Details</h3>
            </div>
            <div class="box-body">

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
                
                <img src="{{ asset('images/'. $faculty->photo) }}"  alt="photo" width="50" height="50"/>
                <div class="form-group">
                    {!! Form::label('photo', 'Photo') !!}
                    {!! Form::file('photo', null, ['class'=>'form-control']) !!}
<!--                {!! errors_for('photo', $errors) !!}-->
                </div>

                <br>
                <div class="form-group">
                    {!! Form::submit( 'Submit', ['class'=>'btn btn-primary']) !!} 
                </div>

                {!! Form::close() !!}
                @if($errors->any())
                <ul class="alert alert-danger">
                    @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
                @endif
            </div>
        </div>
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
            },

            messages: {
                first_name: {required: "Please Enter the First Name",lettersonly: "Please Enter Letters only"},
                last_name: {required: "Please Enter the Last Name",lettersonly: "Please Enter  Letters only"},
            },

            submitHandler: function (form) {
                form.submit();

            }
        });

        $("form[name='Faculty1']").validate({
            errorElement: 'div',
            rules: {
                    qualification: {required: true,dot: true},
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
                    photo:{
                        accept: "jpeg,jpg,png"
                    }
                                     
            },

            messages: {
                    
                phone:{required: "Please Enter the Phone Number.",minlength: "Enter 10 Digit Phone Number",maxlength: "Enter 10 Digit Phone Number",number: "Please Enter a valid Phone Number"},
                qualification: {required: "Please Enter the Qualification",dot: "Please Enter a valid Qualification"},
                address:{required: "Please Enter the Address",minlength: "Please Enter a valid Address"},
                photo:{ accept: "Please add a jpg,jpeg or png image"},
            },
            submitHandler: function (form) {
                form.submit();

            }
        });
    });
    
    jQuery.validator.addMethod("lettersonly", function(value, element) {
    return this.optional(element) || /^[a-zA-Z\s]+$/.test(value);}); 
    jQuery.validator.addMethod("dot", function(value, element) {
        return this.optional(element) || /^[a-zA-Z\ .-]+$/.test(value);});
</script>
@endsection

 