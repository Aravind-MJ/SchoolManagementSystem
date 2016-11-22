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

        <br>
        <div class="form-group">
            {!! Form::submit( 'Submit', ['class'=>'btn btn-primary']) !!} 
        </div>

        {!! Form::close() !!}
        
    </div>

</div>
@stop

@endsection