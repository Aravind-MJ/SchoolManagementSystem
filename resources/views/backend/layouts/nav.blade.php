<!-- =============================================== -->

<!-- Left side column. contains the sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">

            </div>
            <div class="pull-left info">
                <p></p>
                <a href="#"><i class="fa fa-circle text-success"></i></a>
            </div>
        </div>
        <!-- search form -->
        {{--<form action="#" method="get" class="sidebar-form">--}}
            {{--<div class="input-group">--}}
                {{--<input type="text" name="q" class="form-control" placeholder="Search...">--}}
              {{--<span class="input-group-btn">--}}
                {{--<button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>--}}
                {{--</button>--}}
              {{--</span>--}}
            {{--</div>--}}
        {{--</form>--}}
        <!-- /.search form -->
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
            <li class="header">MAIN NAVIGATION</li>
            <li class="treeview @yield('home')">
                <a href="{{url('/home')}}">
                    <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                </a></li>
                        <li class="treeview @yield('event')">
                            <a href="#">
                                <i class="fa fa-pencil-square-o"></i> <span>Events</span>
                                <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                                </span>
                            </a>
                                <ul class="treeview-menu">
                                    <li><a href="{{url('event/new')}}"><i class="fa fa-plus-square-o"></i>Add New Event</a></li>
                                    <li><a href="{{url('event')}}"><i class="fa fa-bars"></i>Event list</a></li>
                                </ul>
                        </li>


                        <li class="treeview @yield('blog')">
                            <a href="#">
                                <i class="fa fa-pencil-square-o"></i> <span>Blog</span>
                                <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                                </span>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="{{url('blog/new')}}"><i class="fa fa-plus-square-o"></i>Add New Blog</a></li>
                                <li><a href="{{url('blog/list')}}"><i class="fa fa-bars"></i>Blog list</a></li>
                            </ul>
                        </li>

                        <li class="treeview @yield('banner')">
                                        <a href="{{url('/banner')}}">
                                            <i class="fa fa-image"></i> <span>Banner</span>
                                        </a></li>


            <li class="header">Settings</li>
            <li><a href="{{url('changePassword')}}"><i class="fa fa-circle-o text-orange"></i> <span>Change Password</span></a></li>
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>

<!-- =============================================== -->