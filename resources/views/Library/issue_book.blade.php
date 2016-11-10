@extends('layouts.layout')

@section('title', 'Library Management')

@section('content')

@if (session()->has('flash_message'))
<p>{{ session()->get('flash_message') }}</p>
@endif

@section('body')

<div class="row">
    @include('flash')
    <div class="col-md-9 col-md-offset-1">
        <div class="box box-primary">
            <div class="box-header">
                <h3 class="box-title">Find Student</h3>
            </div>
            <div class="box-body">
                <div class="form-group">
                    
                    
                </div>
            </div>
        </div>

    </div>
    <!--</div>
    <div class="row">-->
    <div class="col-md-9 col-md-offset-1">
        <div class="box box-primary">
            <div class="box-header">
                <h3 class="box-title">Issue/Return Book</h3>
            </div>
            <div class="box-body">


            </div>

        </div>
    </div>
</div>
@stop

@endsection