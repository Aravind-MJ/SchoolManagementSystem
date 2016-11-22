@extends('layouts.layout')

@section('title', 'Add Items')

@section('body')

{!! Form::open(['route' => 'StoreType.store', 'method'=>'post']) !!}
<!--{!! Form::open() !!}-->
<div class="box box-primary">
    <div class="box-body">

        <div class="form-group">
            {!! Form::Label('store_type','Item') !!}
            {!! Form::text('store_type', null, ['class' => 'form-control'])!!}
        </div>

        <br>
        <div class="form-group">
            {!! Form::submit( 'Submit', ['class'=>'btn btn-primary']) !!} 
        </div>

        {!! Form::close() !!}
    </div>

</div>
@endsection