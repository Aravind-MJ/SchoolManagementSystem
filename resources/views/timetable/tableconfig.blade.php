@extends('layouts.layout')

@section('title', 'Time Table')

@section('content')

@section('body')

@include('tablelink')

      {!! Form::open(['action' => 'TimetableController@timetable_config','method'=>'POST']) !!}
     
      <div class="box box-success">
	      <div class="box-body">
				<table id="example2" border='1' class="table table-bordered table-hover">
        <div class="form-group">
        {!! Form::label('day', 'No of working days in a week') !!}
        {!! Form::text('no_of_days_week', null, ['class' => 'form-control', 'placeholder'=>'']) !!}
        </div>
         <div class="form-group">
        {!! Form::label('hour', 'No of working hours in a day') !!}
       {!! Form::text('no_of_hours_day', null, ['class' => 'form-control', 'placeholder'=>'']) !!}
        </div>
          <div class="form-group">
            {!! Form::submit( 'Save', ['class'=>'btn btn-primary']) !!} 
        </div>

                    </table>

{!! Form::close() !!}


@endsection