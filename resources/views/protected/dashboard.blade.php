@extends('layouts.layout')

@section('title', $title)

@section('body')

    <div class="row">

            {{--<div class="col-lg-3 col-xs-6">--}}
              {{--<!-- small box -->--}}
              {{--<div class="small-box bg-aqua">--}}
                {{--<div class="inner">--}}
                  {{--<h3>{{$count['student']}}</h3>--}
                  <p>user</p>

     <!-- ./col -->
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-red">
                <div class="inner">
                  <h3>{{$count['admins']}}</h3>
                  <p>Admins</p>
                </div>
                <div class="icon">
                  <i class="fa fa-group"></i>
                </div>
                <a href="{{ url('list/admins') }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <!-- ./col -->
             <div class="col-lg-3 col-xs-6">
              <!-- small box -->
            <div class="small-box bg-green">
                <div class="inner">
                 <h3>{{$count['faculty']}}</h3>
                  <p>Faculties</p>
                </div>
                <div class="icon">
                  <i class="fa fa-user"></i>
                </div>
                <a href="{{URL::route('Faculty.index')}}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div>
                                                                           
            <!-- ./col -->
           <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-aqua">
                <div class="inner">
              <h3>{{ $count['student'] }}</h3>
                  <p>Student</p>
                </div>
                <div class="icon">
                  <i class="fa fa-users"></i>
                </div>
                <a href="{{URL::route('Student.index') }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div>
            {{--<!-- ./col -->--}}
           
            <!-- ./col -->



            {{--<div class="col-lg-3 col-xs-6">--}}
              <!-- small box -->
           {{-- <div class="small-box bg-purple">--}}
              {{-- <div class="inner">--}}
                  {{--<h3>{{$count['users']}}</h3>--}}
                  {{--<p>PTA</p>--}}
                {{--</div>--}}
                {{--<div class="icon">--}}
                  {{--<i class="fa fa-university"></i>--}}
                {{--</div>--}}
                {{--<a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>--}}
              {{--</div>--}}
            {{--</div>--}}
           

@endsection