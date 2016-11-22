@extends('layouts.layout')

@section('title', 'Add ClassDetails')

@section('content')

@section('body')

{!! Form::open(['route' => 'ClassDetails.store', 'method'=>'post','enctype' => 'multipart/form-data']) !!}

<!--{!! Form::open() !!}-->
<div class="box box-primary">
    <div class="box-body">

        <!-- first_name Field -->
        <div class="form-group">
            {!! Form::label('class', 'Class') !!}
            {!! Form::text('class', null, ['class' => 'form-control', 'placeholder'=>'Enter  Batch']) !!}
            {!! errors_for('batch', $errors) !!}
        </div>
         <div class="form-group">
            {!! Form::label('division', 'Division') !!}
            {!! Form::text('division', null, ['class' => 'form-control', 'placeholder'=>'Enter Syllabus']) !!}
            {!! errors_for('syllabus', $errors) !!}
        </div>
       
         <div class="form-group">
            {!! Form::label('year', 'Year') !!}
            {!!Form::selectYear('year', 2010, 2020,null,['class' => 'form-control', 'placeholder'=>'Enter  year'])!!}
            {!! errors_for('year', $errors) !!}
        </div>
        <div class="form-group">
            {!! Form::label('in_charge', 'Incharge') !!}
            {!! Form::select('in_charge',$users,null,['class' => 'form-control', 'placeholder'=>''])!!}
            {!! errors_for('in_charge', $errors) !!}
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