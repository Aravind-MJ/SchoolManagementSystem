@extends('layouts.layout')

@section('title', 'Add Feedetails')

<!--@section('content')

@if (session()->has('flash_message'))
<p>{{ session()->get('flash_message') }}</p>
@endif-->

@section('body')
{!! Form::open(['route' => 'Fee.store', 'method'=>'post','enctype' => 'multipart/form-data']) !!}
@include('flash')
<!--{!! Form::open() !!}-->
  <div class="col-md-6 col-md-offset-1">
        <div class="box box-primary">
          <div class="box-body">
                 
                  
                     <div class="form-group">
                        {!! Form::label('batch', 'Class') !!}
                        {!! Form::select('batch',$batch,null, ['class'=>'form-control', 'placeholder'=>'enter name']) !!}
                        {!! errors_for('student_name', $errors) !!}
                     </div>
                     <!--
                    <div class="form-group">
                        {!! Form::label('year', 'Year') !!}
                     {!!Form::selectYear('year', 2010, 2020,null,['class' => 'form-control', 'placeholder'=>'Enter  year'])!!}
                        {!! errors_for('first', $errors) !!}
                    </div>
                    -->
                    <div class="form-group">
                       {!! Form::label('month', 'Month') !!}
                       {!!Form::select('month', array(
                                         "1" => "January", "2" => "February", "3" => "March", "4" => "April",
                                         "5" => "May", "6" => "June", "7" => "July", "8" => "August",
                                         "9" => "September", "10" => "October", "11" => "November", "12" => "December",),
                                         null,['class' => 'form-control', 'placeholder'=>'Enter Month'])!!}
                        {!! errors_for('month', $errors) !!}
                    </div>
                     <div class="form-group">
                        {!! Form::label('fee', 'Fee') !!}
                        {!! Form::text('fee',null, ['class'=>'form-control', 'placeholder'=>'Enter Fee']) !!}
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