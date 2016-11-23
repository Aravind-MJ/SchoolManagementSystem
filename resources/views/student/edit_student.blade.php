@extends('layouts.layout')

@section('title', 'Edit Student Details')

@section('content')
@section('body')

<div class="row">
    @include('flash')
    <div class="col-md-6 col-md-offset-1">
        <div class="box box-primary">
            <div class="box-header">
                <h3 class="box-title">Student-Profile Details</h3>
            </div>
            <div class="box-body">
                {!! Form::model($user,['method'=>'POST','route' => ['studentProfilen.update',$user->enc_id]]) !!}

                <fieldset>

                    <!--@include('flash')-->

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
                        {!! Form::submit('Edit Student', ['class' => 'btn btn-lg btn-primary btn-block']) !!}
                    </div>

                </fieldset>
                {!! Form::close() !!}
            </div>
        </div>

    </div>
    <!--</div>
    <div class="row">-->
    <div class="col-md-6 col-md-offset-1">
        <div class="box box-primary">
            <div class="box-header">
                <h3 class="box-title">Student-Personal Details</h3>
            </div>
                <div class="box-body">

                    {!! Form::model($student, ['method'=>'PATCH','route' => ['Student.update', $student->id],'enctype' => 'multipart/form-data']) !!}

                    <div class="form-group">
                        {!! Form::Label('batch', 'Class') !!}
                        {!! Form::select('class', $batch->class, null, ['class' => 'form-control']) !!}
                    </div>
                 <div class="form-group">
                        {!! Form::Label('batch', 'Division') !!}
                        {!! Form::select('division', $batch->division, null, ['class' => 'form-control']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::Label('gender', 'Gender') !!}<br>
                        {!! Form::radio('gender', 'male') !!}{!! Form::Label('gender', 'Male') !!}
                        {!! Form::radio('gender', 'female') !!}{!! Form::Label('gender', 'Female') !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('dob', 'Date Of Birth') !!}
                        {!! Form::text('dob', null, ['class'=>'form-control', 'placeholder'=>'Date Of Birth', 'id'=>'datepicker']) !!}
                        {!! errors_for('dob', $errors) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('guardian', 'Guardian') !!}
                        {!! Form::text('guardian', null, ['class'=>'form-control', 'placeholder'=>'Enter guardian name ']) !!}
                        {!! errors_for('guardian', $errors) !!}
                    </div>
        </div>
        <div class= "col-md-12">
        <div class="form-group col-md-6">
            {!! Form::Label('Religion', 'Religion') !!}<br>
            {!! Form::radio('religion', 'Hindu') !!}{!! Form::Label('Religion', 'Hindu') !!}
            {!! Form::radio('religion', 'Christian') !!}{!! Form::Label('Religion', 'Christian') !!}
            {!! Form::radio('religion', 'Muslim') !!}{!! Form::Label('Religion', 'Muslim') !!}
            {!! Form::radio('religion', 'Jain') !!}{!! Form::Label('Religion', 'Jain') !!}
            {!! Form::radio('religion', 'Buddhist') !!}{!! Form::Label('Religion', 'Buddhist') !!}
            {!! Form::radio('religion', 'Secular') !!}{!! Form::Label('Religion', 'Secular') !!}
        </div>

        <div class="form-group col-md-6">
            {!! Form::Label('category', 'Category') !!}<br>
            {!! Form::radio('category', 'General') !!}{!! Form::Label('Category', 'Genaral') !!}
            {!! Form::radio('category', 'SC') !!}{!! Form::Label('Category', 'SC') !!}
            {!! Form::radio('category', 'ST') !!}{!! Form::Label('Category', 'ST') !!}
            {!! Form::radio('category', 'OBC') !!}{!! Form::Label('Category', 'OBC') !!}
        </div>
        </div>
        <div class= "col-md-12">
        <div class="form-group col-md-6"><b>HOSTEL FACILITIES NEEDED?</b>
            <input type="radio" id="hostel" value="yes" name="hostel" onclick="sasi()" /> Yes
            <input type="radio" id="hostel" value="no" name="hostel" onclick="sasi()" /> NO
     </div>
           
            <div class="form-group col-md-6" id="sasi1">
            {!! Form::Label('hostelfee', 'Hostel fee paid?') !!}<br>
            {!! Form::radio('hostelfee', 'yes') !!}{!! Form::Label('hostelfee', 'yes') !!}
            {!! Form::radio('hostelfee', 'no') !!}{!! Form::Label('hostelfee', 'no') !!}
        </div>
        </div>
               <div class="form-group col-md-6">
            {!! Form::label('housename', 'House Name') !!}
            {!! Form::text('housename', null,  ['class'=>'form-control', 'placeholder'=>'House name']) !!}
            {!! errors_for('housename', $errors) !!}
            <br>
            {!! Form::label('place', 'Place') !!}
            {!! Form::text('place', null,  ['class'=>'form-control', 'placeholder'=>'place/street']) !!}
            {!! errors_for('place/street', $errors) !!}
             <br>
             {!! Form::label('district', 'District') !!}
            {!! Form::text('district', null,  ['class'=>'form-control', 'placeholder'=>'District']) !!}
            {!! errors_for('district', $errors) !!}
        </div>
           <div class="form-group col-md-6">
            {!! Form::label('state', 'State') !!}   
            {!! Form::text('state', null, ['class' => 'form-control', 'placeholder'=>'Enter state name']) !!}
            {!! errors_for('state', $errors) !!}
        </div>

       <div class="form-group col-md-6">
            {!! Form::label('phone', 'Phone') !!}
            {!! Form::text('phone', null, ['class'=>'form-control', 'placeholder'=>'Enter Phone']) !!}
            {!! errors_for('phone', $errors) !!}
        </div>
                  <div class="form-group col-md-6">
                        {!! Form::label('school', 'School') !!}
                        {!! Form::text('school', null, ['class'=>'form-control', 'placeholder'=>'Enter School Name']) !!}
                        {!! errors_for('school', $errors) !!}
                    </div>

                    <img src="{{ asset('images/students/'. $student->photo) }}"  alt="photo" width="50" height="50"/>
                   <div class="form-group col-md-6">
                        {!! Form::label('photo', 'Photo') !!}
                        {!! Form::file('photo', null, ['class'=>'form-control']) !!}
<!--                    {!! errors_for('photo', $errors) !!}-->
                    </div>
                  <div class="form-group col-md-6">
                        {!! Form::submit( 'Edit Student', ['class'=>'btn btn-lg btn-primary btn-block']) !!} 
                    </div>
                  

                    {!! Form::close() !!}
                </div>
              </div>

        </div>
    </div>
</div>
@stop

@endsection
<script type="text/javascript">
    function sasi() {
        var chkYes = document.getElementById("hostel");
        var dvPassport = document.getElementById("sasi1");
        dvPassport.style.display = chkYes.checked ? "block" : "none";
    }
</script>
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

