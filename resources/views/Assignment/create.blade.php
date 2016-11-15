@extends('layouts.layout')

@section('title', 'Add Assignment')

@section('content')

@section('body')

@include('flash')

{!! Form::open(['action' => 'AssignmentController@store','method'=>'POST'])  !!}
<!--{!! Form::open() !!}-->
<div class="box box-primary">
    <div class="box-body">

        <!-- first_name Field -->
        <div class="form-group">
            {!! Form::label('question', 'Question') !!}
            {!! Form::textarea('question', null, ['class' => 'form-control ckeditor', 'placeholder'=>'Question']) !!}
        <!--    {!! errors_for('first_name', $errors) !!}-->
        </div>
		
		 <div class="form-group">
            {!! Form::label('Submission Date', 'Submission') !!}
            {!! Form::text('submit', null, ['class'=>'form-control', 'placeholder'=>'Submission', 'id'=>'datepicker']) !!}
          <!--  {!! errors_for('dob', $errors) !!}-->
        </div>
	
        {!! Form::close() !!}
       
    </div>

</div>
@section('ckeditor')
<script src="//cdn.ckeditor.com/4.5.7/standard/ckeditor.js" />
@stop
@endsection