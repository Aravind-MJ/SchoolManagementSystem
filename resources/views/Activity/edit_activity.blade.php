@extends('layouts.layout')

@section('title', 'Edit Activity')

<!--@section('content')

@if (session()->has('flash_message'))
<p>{{ session()->get('flash_message') }}</p>
@endif-->

@section('body')

{!! Form::model($Activitytype, ['method' => 'PATCH', 'route' => ['Activity.update',
$Activitytype->id],'enctype' => 'multipart/form-data']) !!}
@include('flash')
<!--{!! Form::open() !!}-->
<div class="box box-primary">
    <div class="box-body">

        <!-- first_name Field -->
        <div class="form-group">
            {!! Form::label('activity_type', 'Activity Type') !!}
            {!! Form::text('activity_type', null, ['class' => 'form-control', 'placeholder'=>'Enter  Activity']) !!}
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