@extends('layouts.layout')

@section('title', 'Edit Item Details')
@section('body')

{!! Form::model($StoreType, ['method' => 'PATCH', 'route' => ['StoreType.update', $StoreType->id]]) !!}

<div class="box box-primary">
    <div class="box-body">

        
        <div class="form-group">
            {!! Form::label('store_type', 'Item') !!}
            {!! Form::text('store_type', null, ['class' => 'form-control']) !!}
          
        </div>

        <div class="form-group">
            {!! Form::label('item_brand', 'Brand') !!}
            {!! Form::text('item_brand', null, ['class' => 'form-control']) !!}
          
        </div>

        <div class="form-group">
            {!! Form::label('item_cost', 'Cost') !!}
            {!! Form::text('item_cost', null, ['class' => 'form-control']) !!}
          
        </div>

        <div class="form-group">
            {!! Form::label('item_stock', 'Stock') !!}
            {!! Form::text('item_stock', null, ['class' => 'form-control']) !!}
          
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