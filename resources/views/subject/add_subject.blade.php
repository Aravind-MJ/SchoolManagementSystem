@extends('layouts.layout')

@section('title', 'Add Subject')

@section('content')

@section('body')
{!! Form::open(['action' => 'SubjectController@store','method'=>'POST']) !!}
<!--{!! Form::open() !!}-->
<div class="box box-primary">
    <div class="box-body">

        <div class="form-group">
            {!! Form::Label('subject', 'subject') !!}
			{!! Form::text('subject', null, ['class' => 'form-control', 'placeholder'=>'Subject Name']) !!}
            {!! errors_for('subject_name', $errors) !!}
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
 
