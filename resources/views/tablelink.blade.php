            <ul class="nav nav-tabs">
              <li class="{{ set_active_admin('Timetable') }}"><a href="{{route('Timetable.index')}}@if($section!='HS')?section={{$section}}@endif">Table Generation</a></li>
              <li class="{{ set_active('Timetable/init') }}"><a href="{{route('Timetable.show','init')}}@if($section!='HS')?section={{$section}}@endif">Table Options</a></li>
              <li class="{{ set_active('Timetable/config') }}"><a href="{{route('Timetable.show','config')}}@if($section!='HS')?section={{$section}}@endif">Table Configurations</a></li>
            </ul>
			{{--<div class="col-md-4">--}}
                {{--<a href="{{route('Timetable.index')}}" class="btn btn-primary btn-block">Table Generation</a>--}}
            {{--</div>--}}

			{{--<div class="col-md-4">--}}
			    {{--<a href="{{route('Timetable.show','init')}}" class="btn btn-success btn-block">Table Options</a>--}}
			{{--</div>--}}

			{{--<div class="col-md-4">--}}
                {{--<a href="{{route('Timetable.show','config')}}" class="btn btn-warning btn-block">Table Configurations</a>--}}
            {{--</div>--}}