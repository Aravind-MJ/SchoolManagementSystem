@extends('layouts.layout')

@section('title', 'Edit Item Details')

@section('body')

{!! Form::open(['route' => ['StoreManagement.update', $Store->id], 'method'=>'PATCH']) !!}
<!--{!! Form::open() !!}-->
<div class="box box-primary">
    <div class="box-body">
       <div class="form-group">
            {!! Form::Label('store_type', 'Item') !!}
            {!! Form::select('store_type',  $store_type, $Store->type_id, ['class' => 'form-control']) !!}
        </div> 

         <div class="form-group">
            {!! Form::Label('item_brand', 'Brand') !!}
            {!! Form::text('item_brand', $Store->item_brand, ['class' => 'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::Label('item_cost','Cost') !!}
            {!! Form::text('item_cost', $Store->item_cost, ['class' => 'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::Label('item_detail','Details') !!}
            {!! Form::text('item_detail', $Store->item_detail, ['class' => 'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::Label('item_stock','Stock') !!}
            {!! Form::text('item_stock', $Store->item_stock, ['class' => 'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::Label('item_limit','Threshold') !!}
            {!! Form::text('item_limit', $Store->item_limit, ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::submit( 'Submit', ['class'=>'btn btn-primary']) !!} 
        </div>

        {!! Form::close() !!}
    </div>

</div>
@endsection
