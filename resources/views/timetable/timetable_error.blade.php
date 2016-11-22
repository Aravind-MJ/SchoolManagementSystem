@extends('layouts.layout')
@section('body')
<div class="box box-primary col-md-12">
<div class="box-header">
    <div class="box-title">Table generation failed. Errors listed below</div>
</div>
<div class="box-body">
    <div class="col-md-12">
    @foreach($list_errors as $error)
        <div class="alert alert-{{$error->type}}">
            {!!$error->msg!!}
            {{--<button type="button" class="close pull-right" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"><i class="fa fa-times"></i></span></button>--}}
        </div>
    @endforeach
    <a href="{{route('Timetable.index')}}@if($section!='HS')?section={{$section}}@endif" class="btn btn-primary">Go back to Timetable Generate</a>
    </div>
</div>
</div>
@endsection
