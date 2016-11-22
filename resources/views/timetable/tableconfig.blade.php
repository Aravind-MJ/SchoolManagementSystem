@extends('layouts.layout')

@section('title', 'Time Table')

@section('content')

@section('body')
      {!! Form::open(['action' => 'TimetableController@timetable_config','method'=>'POST']) !!}
     
      <div class="box box-success">
	      <div class="box-body">
            @include('tablelink')
				<table id="example2" border='1' class="table table-bordered table-hover">
        <br/><div class="form-group">
		<div class="col-md-4">
        {!! Form::label('day', 'No of working days in a week') !!}
		</div>
		<div class="col-md-8">
        {!! Form::select('no_of_days_week', array(1=>1,2=>2,'3'=>3,4=>4,5=>5,6=>6,7=>7), $current_no_of_days_week, ['class' => 'form-control']) !!}
		</div>
		<br/><br/>
        </div>
         <div class="form-group">
		 <div class="col-md-4">
        {!! Form::label('hour', 'No of working periods in a day') !!}
		</div>
		<div class="col-md-8">
      {!! Form::select('no_of_hours_day', array(1=>1,2=>2,3=>3,4=>4,5=>5,6=>6,7=>7,8=>8,9=>9), $current_no_of_hours_day, ['class' => 'form-control']) !!}
      {!! Form::hidden('section',$section) !!}
	   </div>
        </div>
		<br/><br/>
        <div class="form-group" style="text-align:center">
            {!! Form::submit( 'Save', ['class'=>'btn btn-primary']) !!} 
        </div>

                    </table>

{!! Form::close() !!}


@endsection