@extends('layouts.layout')

@section('title', 'Add Subject')

@section('content')

@section('body')
  @include('flash')
{!! Form::open(['action' => 'SubjectController@store','method'=>'POST']) !!}
<!--{!! Form::open() !!}-->
<div class="box box-primary">
    <div class="box-body">

        <div class="form-group">
            {!! Form::Label('subject', 'Subject') !!}
			{!! Form::text('subject', null, ['class' => 'form-control', 'placeholder'=>'Subject Name']) !!}
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
 
