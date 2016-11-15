@extends('layouts.layout')

@section('title', 'Time Table')

@section('content')

@section('body')

@include('flash')

@include('tablelink')

<a href="{{route('Timetable.create')}}" class="btn btn-primary">Generate</a>

@endsection