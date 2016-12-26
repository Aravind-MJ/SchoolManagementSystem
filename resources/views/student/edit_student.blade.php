@extends('layouts.layout')

@section('title', 'Edit Student Details')

@section('body')
<div class="row">
    
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
                        {!! Form::submit('Update Student', ['class' => 'btn btn-lg btn-primary btn-block']) !!}
                    </div>
                </fieldset>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
    
    <div class="col-md-6 col-md-offset-1">
        <div class="box box-primary">
            <div class="box-header">
                <h3 class="box-title">Student-Admission Details</h3>
            </div>
            <div class="box-body">
                <div class= "col-md-12">
                    <div class="form-group col-md-6">
                        {!! Form::model($student, ['method'=>'PATCH','route' => ['Student.update', $student->id],'enctype' => 'multipart/form-data']) !!}
                        <!--div class="form-group"-->
                        {!! Form::Label('batch', 'Class') !!}
                        {!! Form::select('class', $batch->class, null, ['class' => 'form-control']) !!}
                    </div>
                    <div class="form-group col-md-6">
                        <!--div class="form-group"-->
                        {!! Form::Label('batch', 'Division') !!}
                        {!! Form::select('division', $batch->division, null, ['class' => 'form-control']) !!}
                    </div>
                </div>
                <div class= "col-md-12">
                    <div class="form-group col-md-6">
                        <!--div class="form-group"-->
                        {!! Form::Label('gender', 'Gender') !!}<br>
                        {!! Form::radio('gender', 'male') !!}{!! Form::Label('gender', 'Male') !!}
                        {!! Form::radio('gender', 'female') !!}{!! Form::Label('gender', 'Female') !!}
                    </div>
                </div>
                <div class= "col-md-12">
                    <div class="form-group col-md-6">
                        <!--div class="form-group"-->
                        {!! Form::label('dob', 'Date Of Birth') !!}
                        {!! Form::text('dob', date('d-m-Y',strtotime($student->dob)), ['class'=>'form-control', 'placeholder'=>'Date Of Birth', 'id'=>'datepicker']) !!}
                        {!! errors_for('dob', $errors) !!}
                    </div>
                    <div class="form-group col-md-6">
                        <!--div class="form-group"-->
                        {!! Form::label('guardian', 'Guardian') !!}
                        {!! Form::text('guardian', null, ['class'=>'form-control', 'placeholder'=>'Enter guardian name ']) !!}
                        {!! errors_for('guardian', $errors) !!}
                    </div>
                </div>
                <div class= "col-md-12">
                    <div class="form-group col-md-12">
                       <!--div class="form-group"-->
                       {!! Form::label('religion', 'Religion') !!}
                       {!!Form::select('religion', array(0 =>'Select','Hindu' => 'Hindu','Christian' => 'Christian', 'Muslim' =>'Muslim','Jain' => 'Jain','Buddhist' =>'Buddhist','Secular' => 'Secular'),null,['class' => 'form-control', 'placeholder'=>'Enter  year'])!!}
                   </div>
               </div>
               <div class= "col-md-12">
                   <div class="form-group col-md-12">
                       <!--div class="form-group"-->
                       {!! Form::label('category', 'Category') !!}
                       {!!Form::select('category', array(0 =>'Select','General' => 'General','SC' => 'SC', 'ST' =>'ST','OBC' => 'OBC'),null,['class' => 'form-control', 'placeholder'=>'Enter  year'])!!}
                   </div>
               </div>
               <div class= "col-md-12">
                   <div class="form-group col-md-6">
                       <b>Hostel Facilites Needed?</b>
                       <input type="radio" id="hostel" value="yes" name="hostel" onclick="sasi()" @if($student->hostel=='yes') checked @endif/> Yes
                       <input type="radio" id="hostel" value="no" name="hostel" onclick="sasi()" @if($student->hostel=='no') checked @endif/> NO
                   </div>
           
                   <div class="form-group col-md-6" id="sasi1" @if($student->hostel=='no') style="display: none;" @endif>
                       {!! Form::Label('hostelfee', 'Hostel fee paid?') !!}
                       {!! Form::radio('hostelfee', 'yes') !!}{!! Form::Label('hostelfee', 'yes') !!}
                       {!! Form::radio('hostelfee', 'no') !!}{!! Form::Label('hostelfee', 'no') !!}
                   </div>
               
			   </div>
			   </div>
			   </div>
			   </div>
			      <div class="col-md-6 col-md-offset-1">
        <div class="box box-primary">
            <div class="box-header">
                <h3 class="box-title">Student-Identification Details</h3>
            </div>
            <div class="box-body">
               <div class= "col-md-12">
			   
                   <div class="form-group col-md-6">
                       {!! Form::label('housename', 'House Name') !!}
                       {!! Form::text('housename', null,  ['class'=>'form-control', 'placeholder'=>'House name']) !!}
                       {!! errors_for('housename', $errors) !!}
                   </div>
                   <div class="form-group col-md-6">
                       {!! Form::label('place', 'Place') !!}
                       {!! Form::text('place', null,  ['class'=>'form-control', 'placeholder'=>'place/street']) !!}
                       {!! errors_for('place/street', $errors) !!}
                   </div>
               </div>
               <div class= "col-md-12">
                   <div class="form-group col-md-6">
                       {!! Form::label('district', 'District') !!}
                       {!! Form::text('district', null,  ['class'=>'form-control', 'placeholder'=>'District']) !!}
                       {!! errors_for('district', $errors) !!}
                   </div>
                   <div class="form-group col-md-6">
                       {!! Form::label('state', 'State') !!}   
                       {!! Form::text('state', null, ['class' => 'form-control', 'placeholder'=>'Enter state name']) !!}
                       {!! errors_for('state', $errors) !!}
                   </div>
               </div>
               <div class= "col-md-12">
                   <div class="form-group col-md-6">
                       {!! Form::label('phone', 'Phone') !!}
                       {!! Form::text('phone', null, ['class'=>'form-control', 'placeholder'=>'Enter Phone']) !!}
                       {!! errors_for('phone', $errors) !!}
                   </div>
                   
                   <div class="form-group col-md-6">
                   {!! Form::label('adhar', 'Adhar Number') !!}
                   {!! Form::text('adhar', null, ['class' => 'form-control','placeholder'=>'adhar']) !!}
                   {!! errors_for('adhar', $errors) !!}
                   </div>
                 <div class="form-group col-md-6">
                   {!! Form::label('sampoorna', 'Sampoorna ID') !!}
                   {!! Form::text('sampoorna', null, ['class' => 'form-control','placeholder'=>'sampoorna ID']) !!}
                  {!! errors_for('sampoorna', $errors) !!}
         
                    </div>
                   <div class="form-group col-md-6">
                       {!! Form::label('school', 'School') !!}
                       {!! Form::text('school', null, ['class'=>'form-control', 'placeholder'=>'Enter School Name']) !!}
                       {!! errors_for('school', $errors) !!}
                    </div>
               </div>
               <div class= "col-md-12">
                   <div class="form-group col-md-6">
                       {!! Form::label('photo', 'Photo') !!}<br>
                       <img src="{{ asset('images/students/'. $student->photo) }}"  alt="photo" width="70" height="70"/><br><br>
                       {!! Form::file('photo', null, ['class'=>'form-control']) !!}
<!--                   {!! errors_for('photo', $errors) !!}-->
                   </div>
               </div>
			   
            
               <div class= "col-md-12">
                 <div class="form-group">
                        {!! Form::submit('Update Student', ['class' => 'btn btn-lg btn-primary btn-block']) !!}
                    </div>
               </div> 
  </div>
        </div>
    </div>
</div>			   
               {!! Form::close() !!}
          
@stop

@endsection
<script type="text/javascript">
    function sasi() {
        var chkYes = document.getElementById("hostel");
        var dvPassport = document.getElementById("sasi1");
        dvPassport.style.display = chkYes.checked ? "block" : "none";
    }
</script>