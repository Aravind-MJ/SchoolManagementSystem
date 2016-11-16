@extends('layouts.layout')

@section('title', 'Add Store Details')

@section('body')

{!! Form::open(['route' => 'StoreManagement.store', 'method'=>'post']) !!}

<!--{!! Form::open() !!}-->
<div class="box box-primary">
    <div class="box-body">

        <div class="form-group">
            {!! Form::Label('store_type','Item') !!}
            {!! Form::select('store_type',['0'=>'Select Item'] + $store_type,null, ['class' => 'form-control']) !!}
        </div>

         <div class="form-group">
            {!! Form::label('item_brand', 'Brand') !!}
            {!! Form::text('item_brand', null, ['class' => 'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::Label('item_cost','Cost') !!}
            {!! Form::text('item_cost', null, ['class' => 'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::Label('item_detail','Details') !!}
            {!! Form::text('item_detail', null, ['class' => 'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::Label('item_stock','Stock') !!}
            {!! Form::text('item_stock', null, ['class' => 'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::Label('item_limit','Threshold') !!}
            {!! Form::text('item_limit', null, ['class' => 'form-control']) !!}
        </div>
        <br>
        
        <div class="form-group">
            {!! Form::submit( 'Submit', ['class'=>'btn btn-primary']) !!} 
        </div>

        {!! Form::close() !!}
    </div>
</div>
@endsection
