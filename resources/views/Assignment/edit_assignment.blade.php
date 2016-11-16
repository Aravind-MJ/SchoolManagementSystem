@extends('layouts.layout')

@section('title', 'Edit Assignment')

@section('content')

@if (session()->has('flash_message'))
<p>{{ session()->get('flash_message') }}</p>
@endif

@section('body')

{!! Form::model($assignment, ['method'=>'PATCH','route' => ['Assignment.update', $assignment->id]]) !!}
<div class="box box-primary">
    <div class="box-body">

        <div class="form-group">
            {!! Form::Label('batch', 'Batch') !!}
            {!! Form::select('batch_id', $batch, null, ['class' => 'form-control']) !!}
        </div>  
        
        <!-- message Field -->
        <div class="form-group">
            {!! Form::label('question', 'question') !!}        
            {!! Form::textarea('question', null,  ['class' => 'form-control ckeditor']) !!}
            {!! errors_for('question', $errors) !!}
        </div>

        <br>
        <div class="form-group">
            {!! Form::label('sdate', 'Submission Date') !!}
            {!! Form::text('sdate', null, ['class'=>'form-control', 'placeholder'=>'Submission Date', 'id'=>'datepicker1']) !!}
            
        </div>
        <div class="form-group">
            {!! Form::submit( 'Submit', ['class'=>'btn btn-primary']) !!} 
        </div>

        {!! Form::close() !!}
    </div>
</div>
@stop
@section('ckeditor')
<script src="//cdn.ckeditor.com/4.5.7/standard/ckeditor.js" />
@stop
@endsection
 
