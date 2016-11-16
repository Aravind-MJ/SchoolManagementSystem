@extends('layouts.layout')

@section('title', 'Edit Notice')

@section('content')
@section('body')

{!! Form::model($notice, ['method'=>'PATCH','route' => ['Notice.update', $notice->id]]) !!}
<div class="box box-primary">
    <div class="box-body">

        <div class="form-group">
            {!! Form::Label('class', 'Class') !!}
            {!! Form::select('class', $batch->class, null, ['class' => 'form-control']) !!}
        </div>  
        <div class="form-group">
            {!! Form::Label('division', 'Division') !!}
            {!! Form::select('division', $batch->division, null, ['class' => 'form-control']) !!}
        </div>
        <!-- message Field -->
        <div class="form-group">
            {!! Form::label('message', 'Message') !!}        
            {!! Form::textarea('message', null,  ['class' => 'form-control ckeditor']) !!}
            {!! errors_for('message', $errors) !!}
        </div>

        <br>
        
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
 
