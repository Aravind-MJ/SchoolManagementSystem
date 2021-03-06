
<!-- Left side column. contains the sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- search form -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search...">
                <span class="input-group-btn">
                    <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                    </button>
                </span>
            </div>
        </form>
        <!-- /.search form -->
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
            <li class="header">MAIN NAVIGATION</li>
            <li class="{{ set_active('/') }}{{ set_active('admin') }}{{ set_active('sadmin') }}">
                <a href="{{ url('/login') }}">
                    <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                </a>
            </li>
            @if($user->inRole('management'))
            <li class="treeview {{ set_active('create/admin') }}{{ set_active('list/admins') }}">
                <a href="#">
                    <i class="fa fa-dashboard"></i> <span>Admin</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{ url('create/admin') }}"><i class="fa fa-circle-o"></i>Add Admin</a></li>
                    <li><a href="{{ url('list/admins') }}"><i class="fa fa-circle-o"></i>List Admin</a></li>
                </ul>
            </li>
            @endif
           @if($user->inRole('management')||$user->inRole('admins'))
            <li class="treeview {{ set_active('Faculty') }}">
                <a href="#">
                    <i class="fa fa-user"></i>
                    <span>Faculty</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{URL::route('Faculty.create')}}"><i class="fa fa-circle-o"></i> Add Faculty</a></li>
                    <li><a href="{{URL::route('Faculty.index')}}"><i class="fa fa-circle-o"></i> List Faculty</a></li>
                </ul>
            </li>

            <li class="treeview {{ set_active('Student') }}">
                <a href="#">
                    <i class="fa fa-slideshare"></i>
                    <span>Student Registration</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{ route("Student.create") }}"><i class="fa fa-circle-o"></i> Add Student</a></li>
                    <li><a href="{{ route("Student.index") }}"><i class="fa fa-circle-o"></i> List Student</a></li>
                </ul>
            </li>
            @endif
            @if($user->inRole('student'))
            <li><a href="{{URL::route('notice.getNotice')}}"><i class="fa fa-bell"></i> List Notice</a></li>
            @endif
            @if($user->inRole('management')||$user->inRole('admins'))
        <li class="treeview {{ set_active('Subject') }}">
                <a href="#">
                    <i class="fa fa-bookmark-o"></i>
                    <span>Subject</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{ route("Subject.create") }}"><i class="fa fa-circle-o"></i> Add Subject</a></li>
                    <li><a href="{{ route("Subject.index") }}"><i class="fa fa-circle-o"></i> List Subject</a></li>
                </ul>
            </li>    
		<li class="treeview {{ set_active('Notice') }}">
                <a href="#">
                    <i class="fa fa-bell"></i>
                    <span>Notice</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{URL::route('Notice.create')}}"><i class="fa fa-circle-o"></i> Add Notice</a></li>
                    <li><a href="{{URL::route('Notice.index')}}"><i class="fa fa-circle-o"></i> List Notice</a></li>
                </ul>
            </li>
            <li class="treeview {{ set_active('ExamType') }}">
                <a href="#">
                    <i class="fa fa-edit"></i>
                    <span>Exam Type</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{URL::route('ExamType.create')}}"><i class="fa fa-circle-o"></i> Add Exam Type</a></li>
                    <li><a href="{{URL::route('ExamType.index')}}"><i class="fa fa-circle-o"></i> List Exam Type</a></li>
                </ul>
            </li>
            
            <li class="treeview {{ set_active('ExamDetails') }}">
                <a href="#">
                    <i class="fa fa-file-text-o"></i>
                    <span>Exam Details</span>
                    <span class="pull-right-container">
                        <span class="fa fa-angle-left pull-right"></span>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{URL::route('ExamDetails.create')}}"><i class="fa fa-circle-o"></i> Add Exam Details</a></li>
                    <li><a href="{{URL::route('ExamDetails.index')}}"><i class="fa fa-circle-o"></i> List Exam Details</a></li>
                </ul>
            </li>
            <li class="treeview {{ set_active('FeeTypes') }}">
                <a href="#">
                    <i class="fa fa-twitch"></i>
                    <span>Fee Types</span>
                    <span class="pull-right-container">
                        <span class="fa fa-angle-left pull-right"></span>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{URL::route('FeeTypes.create')}}"><i class="fa fa-circle-o"></i> Add Fee Types</a></li>
                    <li><a href="{{URL::route('FeeTypes.index')}}"><i class="fa fa-circle-o"></i> List Fee Types</a></li>
                </ul>
            </li>

            <li class="treeview {{ set_active('ClassDetails') }}">
                <a href="#">
                    <i class="fa fa-delicious"></i>
                    <span>Class Details</span>
                    <span class="pull-right-container">
                        <span class="fa fa-angle-left pull-right"></span>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{URL::route('ClassDetails.create')}}"><i class="fa fa-circle-o"></i> Add Class Details</a></li>
                    <li><a href="{{URL::route('ClassDetails.index')}}"><i class="fa fa-circle-o"></i> List Class Details</a></li>
                </ul>
            </li>
            @endif
            @if($user->inRole('student'))
                <li class="{{ set_active('attendance') }}"><a href="{{ url('attendance/student/'.\App\Encrypt::encrypt($user->id)) }}">
                    <i class="fa fa-files-o"></i> View Attendance</a>
                </li>
            @else
                @if($user->inRole('faculty'))
                <li><a href="{{ url('Search') }}">
                    <i class="fa fa-files-o"></i> Search Students</a>
                </li>
                @endif
                <li class="treeview {{ set_active('attendance') }}{{ set_active('mark/attendance') }}">
                    <a href="#">
                    <i class="fa fa-files-o"></i>
                    <span>Attendance</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>

                    </a>
                    <ul class="treeview-menu">
                            <li><a href="{{ url('attendance/mark') }}"><i class="fa fa-circle-o"></i> Mark Attendance</a></li>
                            <li><a href="{{ url('attendance/batch') }}"><i class="fa fa-circle-o"></i> Attendance By Batch</a></li>
                            <li><a href="{{ url('attendance/student') }}"><i class="fa fa-circle-o"></i> Attendance By Students</a></li>
                            @if(!$user->inRole('faculty'))
                                <li><a href="{{ url('edit/attendance') }}"><i class="fa fa-circle-o"></i> Edit Attendance</a></li>
                            @endif
                    </ul>
                </li>
            @endif
                @if(!$user->inRole('student'))
                <li class="treeview {{ set_active('mark') }}">
                    <a href="#">
                        <i class="fa fa-sliders"></i>
                        <span>Marks</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="{{URL::route('mark.create')}}"><i class="fa fa-circle-o"></i> Add Mark</a></li>
                        <li><a href="{{URL::route('mark.index')}}"><i class="fa fa-circle-o"></i> List Mark</a></li>
                    </ul>
                </li>
                @else
                    <li><a href="{{url('Marks')}}"><i class="fa fa-sliders"></i>Marks</a></li>
                @endif
                @if(!$user->inRole('student')&&!$user->inRole('faculty'))
                    <li class="treeview {{ set_active('SendAnSms') }}">
                        <a href="#">
                        <i class="fa fa-envelope"></i>
                        <span>SMS</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li class="{{ set_active('SendAnSms/students') }}"><a href="{{ url('SendAnSms/students') }}"><i class="fa fa-circle-o"></i> SMS Students</a></li>
                        <li class="{{ set_active('SendAnSms/batches') }}"><a href="{{ url('SendAnSms/batches') }}"><i class="fa fa-circle-o"></i> SMS Batch</a></li>
                        <li class="{{ set_active('SendAnSms/faculty') }}"><a href="{{ url('SendAnSms/faculty') }}"><i class="fa fa-circle-o"></i> SMS Faculty</a></li>
                        <li class="{{ set_active('SmsHistory') }}"><a href="{{ url('SmsHistory') }}"><i class="fa fa-circle-o"></i> SMS History</a></li>
                    </ul>
                </li>
                @endif
				@if(false)
					 <li class="treeview {{ set_active('SendAnSms') }}">
                        <a href="{{url('/Timetable')}}">
                        <i class="fa fa-table"></i>
                        <span>Time table</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                        </a>
					
					</li>
				@endif
                    @if($user->inRole('student'))
                    <li class="treeview {{ set_active('Assignment') }}">
                         <a href="{{url('/assignment')}}">
                        <i class="fa fa-file-text-o"></i>
                        <span>Assignment</span>
                        </a>
                    </li>
                    @endif
                @if($user->inRole('management')||$user->inRole('admins')||$user->inRole('faculty'))
                    <li class="treeview {{ set_active('Assignment') }}">
                         <a>
                        <i class="fa fa-file-text-o"></i>
                        <span>Assignment</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                        </a>
                <ul class="treeview-menu">
                    <li><a href="{{URL::route('Assignment.create')}}"><i class="fa fa-circle-o"></i> Add Assignment</a></li>
                    <li><a href="{{URL::route('Assignment.index')}}"><i class="fa fa-circle-o"></i> List Assignment</a></li>
                </ul>
                    </li>
                    @endif
		        @if($user->inRole('management')||$user->inRole('admins'))

                    <li class="treeview {{ set_active('Library') }}">
                        <a href="{{url('/library')}}">
                        <i class="fa fa-book"></i>
                        <span>Library</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                        </a>
                        <ul class="treeview-menu">
                        <li><a href="{{URL::route('Library.create')}}"><i class="fa fa-circle-o"></i> Add Book</a></li>
                        <li><a href="{{URL::route('Library.index')}}"><i class="fa fa-circle-o"></i> List Book</a></li>
                        {{--<li><a href="{{ url('library/issue') }}"><i class="fa fa-circle-o"></i> Issue Book</a></li>--}}
                    </ul>
                    </li>
                @endif
				@if($user->inRole('management')||$user->inRole('admins'))
                    <li class="treeview {{ set_active('Hostel') }}">
                        <a href="{{url('/hostel')}}">
                        <i class="fa fa-hotel"></i>
                        <span>Hostel</span>
                        <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                        </span>
                       </a>
                        <ul class="treeview-menu">
                        <li><a href="{{URL::route('Hostel.index')}}"><i class="fa fa-circle-o"></i>Hostel Students</a></li>
                         <li><a href="{{URL::route('Hostel.create')}}"><i class="fa fa-circle-o"></i>Dayscholer</a></li>
                   
                    </ul>
                    </li>
                    <li class="treeview {{ set_active('Fee') }}">
                        <a href="{{url('/hostel')}}">
                        <i class="fa fa-hotel"></i>
                        <span>Fee Details for Hostel Students</span>
                        <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                        </span>
                        </a>
                        <ul class="treeview-menu">
                        <li><a href="{{URL::route('Fee.index')}}"><i class="fa fa-circle-o"></i>Paid Students</a></li>
                     
                    </ul>     
                    </li>
                    <li class="treeview {{ set_active('SendAnSms') }}">
                        <a href="{{url('/hostel')}}">
                        <i class="fa fa-hotel"></i>
                     <span>Hostel Fee</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{URL::route('Hostel.edit')}}"><i class="fa fa-circle-o"></i>Hostel Fee</a></li></ul>
                @endif
				@if($user->inRole('management')||$user->inRole('admins'))
                    <li class="treeview {{ set_active('transportation') }}">
                        <a href="{{url('/transportation')}}">
						<i class="fa fa-bus"></i>
                        <span>Transportation</span>
                        <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                        </span>
                        </a>

                        <ul class="treeview-menu">
                        <li><a href="{{route('transportation.create')}}" class="fa fa-circle-o"></i>Add Bus</a></li>
                        <li><a href="{{route('transportation.index')}}" class="fa fa-circle-o"></i>List Bus</a></li>                        
                        <li><a href="{{route('BusFee.create')}}" class="fa fa-circle-o"></i>Add Bus Fee</a></li>                        
                        <li><a href="{{route('BusFee.index')}}" class="fa fa-circle-o"></i>List Bus Fee</a></li> 
                        <li><a href="{{route('FeeStatus.create')}}" class="fa fa-circle-o"></i>Add Fee Status</a></li>                        
                        <li><a href="{{route('FeeStatus.index')}}" class="fa fa-circle-o"></i>List Fee Status</a></li>
                        </ul>
                    </li>
                @endif
				@if($user->inRole('management')||$user->inRole('admins'))
                    <li class="treeview {{ set_active('StoreType') }}">
                    <a href="#">
                        <i class="fa fa-shopping-cart "></i>
                        <span>Store Management</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                        </a>
                     <ul class="treeview-menu">
                            <li><a href="{{URL::route('StoreType.create')}}"><i class="fa fa-circle-o"></i> Add Category Items</a></li>
                            <li><a href="{{URL::route('StoreType.index')}}"><i class="fa fa-circle-o"></i> List Category Items</a></li>
                            <li><a href="{{URL::route('StoreManagement.create')}}"><i class="fa fa-circle-o"></i> Add Item Details</a></li>
                            <li><a href="{{URL::route('StoreManagement.index')}}"><i class="fa fa-circle-o"></i> List Item Details</a></li>
                          </ul>
                    </li>
                @endif


				@if($user->inRole('management')||$user->inRole('admins'))
                    <li class="treeview {{ set_active('Activity') }}">
                        <a href="#">
						<i class="fa fa-trophy"></i>
                        <span>Activity Types</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="{{URL::route('Activity.create')}}"><i class="fa fa-circle-o"></i> Add Activity</a></li>
                            <li><a href="{{URL::route('Activity.index')}}"><i class="fa fa-circle-o"></i> List Activity</a></li>
                        </ul>
                    </li>
                @endif

                @if($user->inRole('management')||$user->inRole('admins'))
                    <li class="treeview {{ set_active('ActivityDetails') }}">
                        <a href="#">
                        <i class="fa fa-gamepad"></i>
                        <span>Activity Details</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="{{URL::route('ActivityDetails.create')}}"><i class="fa fa-circle-o"></i> Add Activity Detail</a></li>
                            <li><a href="{{URL::route('ActivityDetails.index')}}"><i class="fa fa-circle-o"></i> List Activity Detail</a></li>
                        </ul>
                    </li>
                @endif
                    
            <li class="header">Settings</li>
            <li><a href="{{url('changePassword/'. \App\Encrypt::encrypt($user->id))}}"><i class="fa fa-circle-o text-orange"></i> <span>Change Password</span></a></li>
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>
