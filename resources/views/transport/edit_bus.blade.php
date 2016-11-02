@extends('layouts.layout')

@section('title', 'Edit Bus')

@section('body')
@include('flash')

{!! Form::model($buses, ['method'=>'PATCH','route' => ['transportation.update', $buses->id]]) !!}

<div class="box box-primary">
    <div class="box-body">

        <div class="form-group">
            {!! Form::Label('bus_no', 'Bus Number') !!}
            {!! Form::text('bus_no', null, ['class' => 'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::Label('number_plate', 'Number Plate') !!}
            {!! Form::text('number_plate', null, ['class' => 'form-control']) !!}
        </div>  

        <div class="form-group">
            {!! Form::Label('driver', 'Driver') !!}
            {!! Form::text('driver', null, ['class' => 'form-control']) !!}
        </div> 

        <div class="form-group">
            {!! Form::Label('cleaner', 'Cleaner') !!}
            {!! Form::text('cleaner', null, ['class' => 'form-control']) !!}
        </div> 

        <div class="form-group">
            {!! Form::Label('route', 'Route') !!}
            {!! Form::text('route', null, ['class' => 'form-control']) !!}
        </div>
        
        <br>
        <div class="form-group">
            {!! Form::submit( 'Submit', ['class'=>'btn btn-primary']) !!} 
        </div>

        {!! Form::close() !!}
    </div>

</div>
@endsection
 
