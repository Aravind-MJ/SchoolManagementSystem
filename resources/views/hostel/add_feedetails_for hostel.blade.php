@extends('layouts.layout')

@section('title', 'Add Feedetails')

<!--@section('content')

@if (session()->has('flash_message'))
<p>{{ session()->get('flash_message') }}</p>
@endif-->

@section('body')
{!! Form::open(['route' => 'Feedetails.store', 'method'=>'post','enctype' => 'multipart/form-data']) !!}
@include('flash')
<!--{!! Form::open() !!}-->
  <div class="col-md-6 col-md-offset-1">
        <div class="box box-primary">
          <div class="box-body">
                 
                  <div class="form-group">
                        {!! Form::label('student_name', 'StudentName') !!}
                        {!! Form::select('student_name',$users,null, ['class'=>'form-control', 'placeholder'=>'enter name']) !!}
                        {!! errors_for('student_name', $errors) !!}
                  </div>
                     <div class="form-group">
                        {!! Form::label('batch', 'StudentName') !!}
                        {!! Form::select('batch',$batch,null, ['class'=>'form-control', 'placeholder'=>'enter name']) !!}
                        {!! errors_for('student_name', $errors) !!}
                     </div>
                    <div class="form-group">
                        {!! Form::label('year', 'Year') !!}
                        {!! Form::text('year',null, ['class'=>'form-control', 'placeholder'=>'First-Installment']) !!}
                        {!! errors_for('first', $errors) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('month', 'Month') !!}
                        {!! Form::text('month',null, ['class'=>'form-control', 'placeholder'=>'Second-Installment']) !!}
                        {!! errors_for('month', $errors) !!}
                    </div>
                     <div class="form-group">
                        {!! Form::label('fee', 'Fee') !!}
                        {!! Form::text('fee',null, ['class'=>'form-control', 'placeholder'=>'Third-Installment']) !!}
                        {!! errors_for('fee', $errors) !!}
                    </div>
                   
                    <div class="form-group">
                        {!! Form::submit( 'Submit', ['class'=>'btn btn-lg btn-primary btn-block']) !!} 
                    </div>
       
        
               {!! Form::close() !!}
 </div>     </div>
  </div>
@stop

@endsection