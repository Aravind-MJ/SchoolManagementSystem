@extends('layouts.layout')

@section('title', 'Time Table')

@section('content')

@section('body')

@include('tablelink')

      {!! Form::open(['action' => 'TimetableController@timetable_config','method'=>'POST']) !!}
     
      <div class="box box-success">
	      <div class="box-body">
				<table id="example2" border='1' class="table table-bordered table-hover">
        <br/><div class="form-group">
		<div class="col-md-4">
        {!! Form::label('day', 'No of working days in a week') !!}
		</div>
		<div class="col-md-8">
        {!! Form::text('no_of_days_week', null, ['class' => 'form-control', 'placeholder'=>'']) !!}
		</div>
		<br/><br/>
        </div>
         <div class="form-group">
		 <div class="col-md-4">
        {!! Form::label('hour', 'No of working hours in a day') !!}
		</div>
		<div class="col-md-8">
       {!! Form::text('no_of_hours_day', null, ['class' => 'form-control', 'placeholder'=>'']) !!}
	   </div>
        </div>
		<br/><br/>
        <div class="form-group" style="text-align:center">
            {!! Form::submit( 'Save', ['class'=>'btn btn-primary']) !!} 
        </div>

                    </table>

{!! Form::close() !!}


@endsection