@extends('layouts.layout')

@section('title', 'Edit Bus Fee')

@section('body')
@include('flash')

{!! Form::model($busfees, ['method'=>'PATCH','route' => ['BusFee.update', $busfees->id]]) !!}

<div class="box box-primary">
    <div class="box-body">

        <div class="form-group">
            {!! Form::Label('param1', 'Batch') !!}
            {!! Form::select('param1', $batch,  $batch_id, ['class' => 'form-control']) !!}
        </div> 

        <div class="form-group">
            {!! Form::Label('student_id', 'Student') !!}
            {!! Form::select('student_id', $users,  null, ['class' => 'form-control']) !!}
        </div>  

        <div class="form-group">
            {!! Form::Label('bus_id', 'Bus') !!}
            {!! Form::select('bus_id', $buses, null, ['class' => 'form-control']) !!}
        </div>

        

        <div class="form-group">
            {!! Form::Label('fee', 'Fee') !!}
            {!! Form::text('fee', null, ['class' => 'form-control']) !!}
        </div> 
        
        <br>
        <div class="form-group">
            {!! Form::submit( 'Submit', ['class'=>'btn btn-primary']) !!} 
        </div>

        {!! Form::close() !!}
    </div>

</div>
@endsection
 
