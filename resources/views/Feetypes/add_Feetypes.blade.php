@extends('layouts.layout')

@section('title', 'Add Feetypes')

@section('content')



@section('body')
{!! Form::open(['route' => 'FeeTypes.store', 'method'=>'post','enctype' => 'multipart/form-data']) !!}

<!--{!! Form::open() !!}-->
<div class="box box-primary">
    <div class="box-body">

        <!-- first_name Field -->
        <div class="form-group">
            {!! Form::label('name', 'FeeTypes') !!}
            {!! Form::text('name', null, ['class' => 'form-control', 'placeholder'=>'Enter  Name']) !!}
            {!! errors_for('name', $errors) !!}
        </div>

        <br>
        <div class="form-group">
            {!! Form::submit( 'Submit', ['class'=>'btn btn-primary']) !!} 
        </div>

        {!! Form::close() !!}
       
        <!--                @if($errors->any())
                    <ul class="alert alert-danger">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
              </ul>
                @endif-->
    </div>

</div>
@stop

@endsection