@extends('layouts.layout')

@section('title', 'Add Class Details')

<!--@section('content')

@if (session()->has('flash_message'))
<p>{{ session()->get('flash_message') }}</p>
@endif-->

@section('body')

{!! Form::open(['route' => 'BatchDetails.store', 'method'=>'post','enctype' => 'multipart/form-data']) !!}
@include('flash')
<!--{!! Form::open() !!}-->
<div class="box box-primary">
    <div class="box-body">

        <!-- first_name Field -->
        <div class="form-group">
            {!! Form::label('batch', 'Class') !!}
            {!! Form::text('batch', null, ['class' => 'form-control', 'placeholder'=>'Enter  Batch']) !!}
            {!! errors_for('batch', $errors) !!}
        </div>
         <div class="form-group">
            {!! Form::label('syllabus', 'Division') !!}
            {!! Form::text('syllabus', null, ['class' => 'form-control', 'placeholder'=>'Enter Syllabus']) !!}
            {!! errors_for('syllabus', $errors) !!}
        </div>
        <div class="form-group">
            {!! Form::label('time_shift', 'Time_shift') !!}
            {!! Form::select('time_shift',array('Morning' => 'Morning', 'AfterNoon' => 'AfterNoon','Evening' =>'Evening'),null, ['class' => 'form-control', 'placeholder'=>'00.00-00.00','id' => 'calendar1'])!!}
            {!! errors_for('time_shift', $errors) !!}
        </div>
       
         <div class="form-group">
            {!! Form::label('year', 'Year') !!}
            {!!Form::selectYear('year', 2010, 2020,null,['class' => 'form-control', 'placeholder'=>'Enter  year'])!!}
            {!! errors_for('year', $errors) !!}
        </div>
        <div class="form-group">
            {!! Form::label('in_charge', 'Incharge') !!}
            {!! Form::select('in_charge',$users,null,['class' => 'form-control', 'placeholder'=>''])!!}
            {!! errors_for('in_charge', $errors) !!}
            <!--{!! errors_for('first_name', $errors) !!}-->
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