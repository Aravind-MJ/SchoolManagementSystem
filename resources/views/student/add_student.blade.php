@extends('layouts.layout')

@section('title', 'Add Student')

@section('content')

<!--@if (session()->has('flash_message'))-->
<p></p>
<!--@endif-->

@section('body')

{!! Form::open(['action' => 'StudentController@store','method'=>'POST','enctype' => 'multipart/form-data']) !!}
@include('flash')
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
            {!! Form::Label('batch', 'Class') !!}
            {!! Form::select('batch_id', $batch, null, ['class' => 'form-control']) !!}
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
        <div class="form-group"> hostel needed?
            <input type="radio" id="hostel" value="yes" name="hostel" onclick="sasi()" /> Yes
            <input type="radio" id="hostel" value="no" name="hostel" onclick="sasi()" /> NO
     </div>
           
            <div class="form-group" id="sasi1">
            {!! Form::Label('hostelfee', 'Hostel fee paid?') !!}<br>
            {!! Form::radio('hostelfee', 'yes') !!}{!! Form::Label('hostelfee', 'yes') !!}
            {!! Form::radio('hostelfee', 'no') !!}{!! Form::Label('hostelfee', 'no') !!}
        </div>

        <div class="form-group">
            {!! Form::label('address', 'Address') !!}
            {!! Form::textarea('address', null,  ['class'=>'form-control', 'placeholder'=>'Address']) !!}
            {!! errors_for('address', $errors) !!}
        </div>
        
        <div class="form-group">
            {!! Form::label('phone', 'Phone') !!}
            {!! Form::text('phone', null, ['class'=>'form-control', 'placeholder'=>'Enter Phone']) !!}
            {!! errors_for('phone', $errors) !!}
        </div>
        
        <div class="form-group">
            {!! Form::label('school', 'School') !!}
            {!! Form::text('school', null, ['class'=>'form-control', 'placeholder'=>'Enter School Name']) !!}
            {!! errors_for('school', $errors) !!}
        </div>
        
        <div class="form-group">
            {!! Form::label('cee_rank', 'CEE Rank') !!}
            {!! Form::text('cee_rank', null, ['class'=>'form-control', 'placeholder'=>'Enter CEE Rank']) !!}
            {!! errors_for('cee_rank', $errors) !!}
        </div>
        
        <div class="form-group">
            {!! Form::label('percentage', 'Percentage') !!}
            {!! Form::text('percentage', null, ['class'=>'form-control', 'placeholder'=>'Enter Percentage']) !!}
            {!! errors_for('percentage', $errors) !!}
        </div>

        <!-- email Field -->
        <div class="form-group">
            {!! Form::label('email', 'Email') !!}
            {!! Form::email('email', null, ['class' => 'form-control','placeholder'=>'Email']) !!}
            {!! errors_for('email', $errors) !!}
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
