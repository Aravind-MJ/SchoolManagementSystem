@extends('layouts.layout')

@section('title', 'Time Table')

@section('body')

<div class="box box-success">
    <div class="box-body">
@include('tablelink')<br>
@if($table!=null)
    <div class="row">
    <?php
        $i=0;
        $days = ['Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday'];
     ?>
    @foreach($table as $key => $set)
        <div class="col-md-12">
             <div class="panel-group" id="accordion">
               <h4>
                   {{strtoupper($key)}}
               </h4>
             @foreach($set as $each)
              <div class="panel panel-default">
                <div class="panel-heading">
                  <h4 class="panel-title">
                    <a data-toggle="collapse" data-parent="" href="#collapse{{++$i}}">{{ucwords($each['name'])}}</a>
                  </h4>
                </div>
                <div id="collapse{{$i}}" class="panel-collapse collapse">
                  <div class="panel-body">
                  <table class="table table-bordered table-hover">
                  <thead>
                        <tr>
                            <th>Day/Period</th>
                            @foreach($period_head as $value)
                            <th>{{$value}}</th>
                            @endforeach
                        </tr>
                  </thead>
                  <tbody>
                    @foreach($each['table'] as $day => $periods)
                        <tr>
                            <th>{{$days[$day]}}</th>
                            @foreach($periods as $period)
                            <td>{{$period['subject_name']}}
                            @if(isset($period['relate']))
                            <br>({{$period['relate']}})
                            @endif
                            </td>
                            @endforeach
                        </tr>
                    @endforeach
                    </tbody>
                    </table>
                  </div>
                </div>
              </div>
              @endforeach
            </div>
        </div>
        @endforeach
    </div>
        @else
            <div class="box box-danger">
                <div class="box-header">
                    <div class="box-title">No timetable Available</div>
                </div>
                <div class="box-body">
                    <ul>
                        <li>A timetable may not be generated for this section yet (Current section : {{$section}}). ('HS' by Default) </li>
                        <li>The database limit for generated timetable exceeded.</li>
                    </ul>
                </div>
            </div>
        @endif

<a href="{{route('GenerateTimetable')}}@if($section!='HS')?section={{$section}}@endif" class="btn btn-primary">Generate new Timetable</a>

    </div>
</div>

@endsection