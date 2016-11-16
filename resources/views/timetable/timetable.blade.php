@extends('layouts.layout')

@section('title', 'Time Table')

@section('content')

@section('body')

<div class="box box-success">
    <div class="box-body">
@include('tablelink')

<a href="{{route('Timetable.create')}}" class="btn btn-primary">Generate</a>

    </div>
</div>

@endsection