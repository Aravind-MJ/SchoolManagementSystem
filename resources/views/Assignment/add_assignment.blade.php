@extends('layouts.layout')

@section('title', 'Add Assignment')

@section('content')

@section('body')



{!! Form::open(['route' => 'Assignment.store','method'=>'POST']) !!}

<div class="box box-primary">
    <div class="box-body">

          <div class="form-group">
            {!! Form::Label('class', 'class') !!}
            {!! Form::select('class', $batch->class, null, ['class' => 'form-control']) !!}
        </div>      
 <div class="form-group">
            {!! Form::Label('division', 'division') !!}
            {!! Form::select('division', $batch->division, null, ['class' => 'form-control']) !!}
        </div>    

        <div class="form-group">
            {!! Form::label('question', 'question') !!}
            {!! Form::textarea('question', null,  ['placeholder'=>'Question', 'class' => 'form-control ckeditor']) !!}
             {!! errors_for('question', $errors) !!}
           
        </div>
        <div class="form-group">
            {!! Form::label('submit', 'Submission Date') !!}
            {!! Form::text('submit', null, ['class'=>'form-control', 'placeholder'=>'Submission Date', 'id'=>'datepicker1']) !!}
            
        </div>

        <div class="form-group">
            {!! Form::submit( 'Submit', ['class'=>'btn btn-primary']) !!} 
        </div>
    </div>
</div>
{!! Form::close() !!}
@section('ckeditor')
<script src="//cdn.ckeditor.com/4.5.7/standard/ckeditor.js" />
@stop
@endsection
 
