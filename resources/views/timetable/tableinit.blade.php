@extends('layouts.layout')

@section('title', 'Time Table')

@section('content')

@section('body')

@include('flash')

@include('tablelink')
      {!! Form::open(array('url' => 'Table Generation')) !!}

      <div class="box box-success">
      
        <div class="box-body">
        <table id="example2" border='1' class="table table-bordered table-hover">
        
        <div class="form-group">
        {!! Form::label('batch', 'Batch') !!}
        {!! Form::select('batch',$batch,null,['class' => 'form-control', 'placeholder'=>''])!!}
        {!! errors_for('batch', $errors) !!}
        </div>
         <div class="form-group">
        {!! Form::label('faculty', 'Faculty') !!}
        {!! Form::select('faculty',$faculty,null,['class' => 'form-control', 'placeholder'=>''])!!}
        {!! errors_for('faculty', $errors) !!}
        </div>
        <div class="form-group">
        {!! Form::label('subject', 'Subject') !!}
        {!! Form::select('subject',$subject,null,['class' => 'form-control', 'placeholder'=>''])!!}
        {!! errors_for('subject', $errors) !!}
       </div>
</table>
{!! Form::close() !!}


@endsection
