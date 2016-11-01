@extends('layouts.layout')

@section('title', 'Edit Subject')

@section('content')

@if (session()->has('flash_message'))
<p>{{ session()->get('flash_message') }}</p>
@endif

@section('body')

{!! Form::model($subject, ['method'=>'PATCH','route' => ['Subject.update', $subject->id]]) !!}
<div class="box box-primary">
    <div class="box-body">

        <div class="form-group">
            {!! Form::Label('subject', 'Subject') !!}
			{!! Form::text('subject', $subject->subject_name, ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::submit( 'Submit', ['class'=>'btn btn-primary']) !!} 
        </div>

        {!! Form::close() !!}
    </div>

</div>
@stop
@endsection
 
