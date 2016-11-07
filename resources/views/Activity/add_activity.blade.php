@extends('layouts.layout')

@section('title', 'Add Activity')

@section('body')
@include('flash')
{!! Form::open(['route' => 'Activity.store', 'method'=>'post','enctype' => 'multipart/form-data']) !!}
<!--{!! Form::open() !!}-->
<div class="box box-primary">
    <div class="box-body">

        <div class="form-group">
            {!! Form::Label('activity_type', 'Activity Type') !!}
            {!! Form::text('activity_type', null, ['class' => 'form-control']) !!}
        </div>
        <br>
        <div class="form-group">
            {!! Form::submit( 'Submit', ['class'=>'btn btn-primary']) !!} 
        </div>

        {!! Form::close() !!}
    </div>

</div>
@endsection