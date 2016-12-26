@extends('layouts.layout')

@section('title', 'Add Student')

@section('body')
{!! Form::open(['action' => 'StudentController@store','method'=>'POST','enctype' => 'multipart/form-data','name' => 'add_student']) !!}
<div class="box box-primary">
    <div class="box-body">

        
    <div class= "col-md-12">
	<h2>I.PERSONAL DETAILS</h2>
        <div class="form-group col-md-6">
            <!-- first_name Field -->
            {!! Form::label('first_name', 'First Name') !!}
            {!! Form::text('first_name', null, ['class' => 'form-control', 'placeholder'=>'Enter First Name']) !!}
            {!! errors_for('first_name', $errors) !!}
        </div>
        <div class="form-group col-md-6">
            <!-- last_name Field -->
            {!! Form::label('last_name', 'Last Name') !!}
            {!! Form::text('last_name', null, ['class' => 'form-control', 'placeholder'=>'Enter Last Name']) !!}
            {!! errors_for('last_name', $errors) !!}
        </div>
		 <div class="form-group col-md-6">
            {!! Form::Label('gender', 'Gender') !!}<br>
            {!! Form::radio('gender', 'male',['checked']) !!}&nbsp{!! Form::Label('gender', 'Male') !!}
            &nbsp&nbsp&nbsp&nbsp{!! Form::radio('gender', 'female') !!}&nbsp{!! Form::Label('gender', 'Female') !!}
        </div>
    <div class="form-group col-md-6">
            {!! Form::label('dob', 'Date Of Birth') !!}
            {!! Form::text('dob', null, ['readonly' => '','class'=>'form-control', 'placeholder'=>'Date Of Birth', 'id'=>'datepicker']) !!}
            {!! errors_for('dob', $errors) !!}
        </div>
	 <div class="form-group col-md-6">
            {!! Form::label('guardian', 'Guardian') !!}
            {!! Form::text('guardian', null, ['class'=>'form-control', 'placeholder'=>'Enter guardian name ']) !!}
            {!! errors_for('guardian', $errors) !!}
        </div>
		<div class="form-group col-md-6">
            {!! Form::label('religion', 'Religion') !!}
            {!!Form::select('religion', array(0 =>'Select','Hindu' => 'Hindu','Christian' => 'Christian', 'Muslim' =>'Muslim','Jain' => 'Jain','Buddhist' =>'Buddhist','Secular' => 'Secular'),null,['class' => 'form-control', 'placeholder'=>'Enter  year'])!!}
          
        </div>
		  <div class="form-group col-md-6">
            {!! Form::label('category', 'Category') !!}
              {!!Form::select('category', array(0 =>'Select','General' => 'General','SC' => 'SC', 'ST' =>'ST','OBC' => 'OBC'),null,['class' => 'form-control', 'placeholder'=>'Enter  year'])!!}
           
        </div>
	</div>
</div>
 </div>

<div class="box box-primary">
  <div class="box-body">
    <div class= "col-md-12">
	<h2>II.Admission Details</h2>
         <div class="form-group col-md-6">
            {!! Form::Label('class', 'Class') !!}
            {!! Form::select('class', $batch->class, null, ['class' => 'form-control']) !!}
        </div>
             <div class="form-group col-md-6">
            {!! Form::Label('class', 'Division') !!}
            {!! Form::select('division', $batch->division, null, ['class' => 'form-control']) !!}
        </div>
    </div>
     <div class= "col-md-12">
        <div class="form-group col-md-6">
            <b>Hostel Facilites Needed?</b>
            &nbsp&nbsp&nbsp&nbsp<input type="radio" id="hostel" value="yes" name="hostel" onclick="sasi()" /> Yes
            &nbsp&nbsp&nbsp&nbsp<input type="radio" id="hostel" value="no" name="hostel" onclick="sasi()" checked=""  /> No
        </div>
           
        <div class="form-group col-md-6" id="sasi1" style="display:none;">
            {!! Form::Label('hostelfee', 'Hostel fee paid?') !!}
            &nbsp&nbsp&nbsp&nbsp{!! Form::radio('hostelfee', 'yes') !!}{!! Form::Label('hostelfee', 'Yes') !!}
            &nbsp&nbsp&nbsp&nbsp{!! Form::radio('hostelfee', 'no', ['checked']) !!}{!! Form::Label('hostelfee', 'No') !!}
        </div>
		 <div class="form-group col-md-6">
            {!! Form::label('Previous schoolName', 'Previous SchoolName') !!}
            {!! Form::text('school', null, ['class'=>'form-control', 'placeholder'=>'Enter School Name']) !!}
            {!! errors_for('school', $errors) !!}
        </div>
    </div>
        </div>
    
 </div> 
 
   
	<div class="box box-primary">
  <div class="box-body">
  <div class= "col-md-12"> 
  <h2> III.ID-Details</h2>
       <div class="form-group col-md-6">
            {!! Form::label('adhar', 'Adhaar Number') !!}
            {!! Form::text('adhar', null, ['class' => 'form-control','placeholder'=>'adhar']) !!}
            {!! errors_for('adhar', $errors) !!}
        </div>
        <div class="form-group col-md-6">
            {!! Form::label('sampoorna', 'Sampoorna ID') !!}
            {!! Form::text('sampoorna', null, ['class' => 'form-control','placeholder'=>'sampoorna ID']) !!}
            {!! errors_for('sampoorna', $errors) !!}
         
        </div>
        <div class="form-group col-md-6">
            {!! Form::label('photo', 'Photo') !!}
            {!! Form::file('photo', null, ['class'=>'form-control filestyle']) !!}
            {!! errors_for('photo', $errors) !!}
        </div>
		</div>
		</div>
		</div>
		<div class="box box-primary">
  <div class="box-body">
		 <div class= "col-md-12">  
<h2> 	IV.Address Details</h2>	 
        <div  class="col-md-6">
            {!! Form::label('address', 'House Name') !!}
            {!! Form::text('housename', null, ['class' => 'form-control', 'placeholder'=>'Enter House name']) !!}
            {!! errors_for('housename', $errors) !!}
        </div>
        <div  class="col-md-6">
            {!! Form::label('place', 'Place') !!}
           
            {!! Form::text('place', null, ['class' => 'form-control', 'placeholder'=>'Enter place Name']) !!}
            {!! errors_for('place', $errors) !!}
        </div>
    </div>
    <div class= "col-md-12" style="padding-top: 10px;"> 
        <div  class="col-md-6">
            {!! Form::label('district', 'District') !!}
            {!! Form::text('district', null, ['class' => 'form-control', 'placeholder'=>'Enter district name']) !!}
            {!! errors_for('district', $errors) !!}
        </div>
        <div  class="col-md-6">
            {!! Form::label('state', 'State') !!}
            {!! Form::text('state', null, ['class' => 'form-control', 'placeholder'=>'Enter state name']) !!}
            {!! errors_for('state', $errors) !!}
        </div>
    </div>
	</div>
	</div>
        <!--
            <br>
            {!! Form::text('place/street', null,  ['class'=>'form-control', 'placeholder'=>'place/street']) !!}
            {!! errors_for('place/street', $errors) !!}
             <br>
            {!! Form::text('district', null,  ['class'=>'form-control', 'placeholder'=>'District']) !!}
            {!! errors_for('district', $errors) !!}
             <br>
            {!! Form::text('State', null,  ['class'=>'form-control', 'placeholder'=>'State']) !!}
            {!! errors_for('State', $errors) !!}
            <!--
            {!! Form::text('House name', null,  ['class'=>'form-control', 'placeholder'=>'House name']) !!}
            {!! errors_for('House name', $errors) !!}
        </div>
        -->
        <div class="box box-primary">
  <div class="box-body">
    <div class= "col-md-12">  
	<h2>V.Contact Details</h2>
        <div class="form-group col-md-6">
            {!! Form::label('phone', 'Phone / Mobile') !!}
            {!! Form::text('phone', null, ['class'=>'form-control', 'placeholder'=>'Enter Phone']) !!}
            {!! errors_for('phone', $errors) !!}
        </div>
          <div class="form-group col-md-6">
            {!! Form::label('email', 'Email') !!}
            {!! Form::email('email', null, ['class' => 'form-control','placeholder'=>'Email']) !!}
            {!! errors_for('email', $errors) !!}
        </div>
      
        
    </div>
	
   
    
        <div class="form-group col-md-12">
            <div class="form-group col-md-12">
			<center>
		<br>
                {!! Form::submit( 'Submit', ['class'=>'btn btn-primary']) !!}
			</center>	
				
            </div>
        </div>
   </div>
	</div>
        
            {!! Form::close() !!}
    
   

@stop
@section('validation')
<script>
 $(function () {

        $("form[name='add_student']").validate({

            rules: {
                first_name: {required: true,lettersonly: true},
                last_name: {required: true,lettersonly: true},
                email: {required: true,email: true},
                password:{
                    required: true,
                    minlength:6,
                    },
					phone:{
						required: true,
						numberonly:true,
                    minlength:10,
					maxlength:10,
					},
					adhar:{
						required: true,
						numberonly:true,
                    minlength:12,
					maxlength:12,
					},
					sampoorna:{
						required: true,
						numberonly:true,
                    minlength:10,
					maxlength:10,
					},
             school: {required: true},
			 category: {required: true},
		
			 gender: {required: true},
			
			  dob: {required: true},
			   guardian: {required: true,lettersonly: true},
			    religion: {required: true},
				 category: {required: true},
				  class: {required: true},
				   division: {required: true},
					   housename: {required: true},
					    district: {required: true,lettersonly: true},
						 state: {required: true,lettersonly: true},
						 place: {required: true,lettersonly: true},
						  
						  

            },

            messages: {
                first_name: {required: "Please enter the First Name",lettersonly: "Please enter Letters Only"},
                last_name: {required: "Please enter the Last Name",lettersonly: "Please enter  Letters Only"},
                email:{required: "Please enter email", email: "Please enter valid email!"},
                password: {required: "Please enter the Password",minlength: "The minimum length should be 6"},
              housename: {required: "Please enter the House Name"},
			  district: {required: "Please enter the district",lettersonly: "Please enter Letters Only"},
		state: {required: "Please enter the state",lettersonly: "Please enter Letters Only"},
			   phone: {required: "Please enter the phone",minlength: "The minimum length should be 10",maxlength: "The maximum length should be 10"},
			adhar: {required: "Please enter the adhar",minlength: "The minimum length should be 12",maxlength: "The maximum length should be 12"},
				sampoorana: {required: "Please enter the ID",minlength: "The minimum length should be 10",maxlength: "The maximum length should be 10"},
            },
            submitHandler: function (form) {
                form.submit();

            }
        });
    });
    
    jQuery.validator.addMethod("lettersonly", function(value, element) {
                return this.optional(element) || /^[a-zA-Z\s]+$/.test(value);},    "Letters only please"); 
				
 jQuery.validator.addMethod("numberonly", function(value, element) {
                return this.optional(element) || /^[0-9]+$/.test(value);},    "Letters only please"); 
    
</script>
@endsection
 <script type="text/javascript">
    function sasi() {
        var chkYes = document.getElementById("hostel");
        var dvPassport = document.getElementById("sasi1");
        dvPassport.style.display = chkYes.checked ? "block" : "none";
    }
</script>