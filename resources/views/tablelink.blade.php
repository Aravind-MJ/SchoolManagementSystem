            <ul class="nav nav-tabs">
              <li class="{{ set_active_admin('Timetable') }}"><a href="{{route('Timetable.index')}}@if($section!='HS')?section={{$section}}@endif">Table Generation</a></li>
              <li class="{{ set_active('Timetable/init') }}"><a href="{{route('Timetable.show','init')}}@if($section!='HS')?section={{$section}}@endif">Table Options</a></li>
              <li class="{{ set_active('Timetable/config') }}"><a href="{{route('Timetable.show','config')}}@if($section!='HS')?section={{$section}}@endif">Table Configurations</a></li>
            </ul>