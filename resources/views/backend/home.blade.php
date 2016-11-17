@extends('backend.layouts.layout')
@section('home','active')
@section('body')

<?php
    $user = \Illuminate\Support\Facades\Auth::user();
?>
@section('title', 'admin')

    @include('flash')

    <div class="row">
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-teal" style="height: 110px;">
                <div class="inner">
                  <h3>Blog</h3>
                  <p>{{$data}}</p>
                </div>
                <div class="icon">
                  <i class="fa fa-pencil"></i>
                </div>
                {{--<a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>--}}
              </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-orange" style="height: 110px;">
                <div class="inner">
                  <h3>Event</h3>
                  <p>{{$eventCount}}</p>
              
                </div>
                <div class="icon">
                  <i class="fa fa-cubes"></i>
                </div>
                {{--<a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>--}}
              </div>
            </div>
            <!-- ./col -->
           
          </div>

@endsection
<!--<div class="jumbotron">
        <h1>Admin Page</h1>
        <p>This page is  admins only!</p>
</div>-->

    
