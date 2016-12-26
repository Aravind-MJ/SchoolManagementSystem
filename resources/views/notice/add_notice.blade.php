@extends('layouts.layout')

@section('title', 'Add Notice')

@section('body')

{!! Form::open(['action' => 'NoticeController@store','method'=>'POST']) !!}
<!--{!! Form::open() !!}-->
<div class="box box-primary">
    <div class="box-body">
    
     <div class="form-group">
            {!! Form::Label('class[]', 'class') !!}
            {!! Form::select('class[]', $batch,null,['id'=>'numbers','class' => 'form-control phone-numbers','multiple'=>'multiple']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('message', 'Message') !!}
            {!! Form::textarea('message', null,  ['placeholder'=>'Message', 'class' => 'form-control ckeditor']) !!}
            {!! errors_for('message', $errors) !!}
        </div>
        <br>
        <div class="form-group">
            {!! Form::submit( 'Submit', ['class'=>'btn btn-primary']) !!} 
        </div>

        {!! Form::close() !!}
    </div>

</div>
@stop
@section('ckeditor')
<script>
        $('.phone-numbers').select2();
    </script>
<script src="//cdn.ckeditor.com/4.5.7/standard/ckeditor.js" />
@stop
@endsection
 