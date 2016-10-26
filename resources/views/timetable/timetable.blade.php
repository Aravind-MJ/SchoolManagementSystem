@extends('layouts.layout')

@section('title', 'Time Table')

@section('content')

@section('body')

@include('flash')
{!! Form::open(array('url' => 'foo/bar')) !!}
<div class="box box-primary">
    <div class="box-body">

		{!! HTML::link('/', 'testing')!!}
		
	</div>
</div>
{!! Form::close() !!}
@stop

@endsection