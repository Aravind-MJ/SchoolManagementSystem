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
        {!! Form::select('no_of_days_week', array(1,2,3,4,5,6,7), null, ['class' => 'form-control']) !!}
		</div>
		<br/><br/>
        </div>
         <div class="form-group">
		 <div class="col-md-4">
        {!! Form::label('hour', 'No of working hours in a day') !!}
		</div>
		<div class="col-md-8">
      {!! Form::select('no_of_hours_day', array(1,2,3,4,5,6,7,8,9), null, ['class' => 'form-control']) !!}
	   </div>
        </div>
		<br/><br/>
        <div class="form-group" style="text-align:center">
            {!! Form::submit( 'Save', ['class'=>'btn btn-primary']) !!} 
        </div>

                    </table>

{!! Form::close() !!}


@endsection