
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
                <a href="/">
                    <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                </a>
            </li>

            <li class="treeview">
                <a href="#">
                    <i class="fa fa-sliders"></i>
                    <span>Banner</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                <ul class="treeview-menu">
                    <li><a href="#"><i class="fa fa-circle-o"></i> Add Banner</a></li>
                    <li><a href="#"><i class="fa fa-circle-o"></i> List Banner</a></li>
                </ul>
                </a>
            </li>

            <li class="treeview">
                <a href="#">
                    <i class="fa fa-edit"></i>
                    <span>Blog</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{URL::route('ExamType.create')}}"><i class="fa fa-circle-o"></i> Add Blog</a></li>
                    <li><a href="{{URL::route('ExamType.index')}}"><i class="fa fa-circle-o"></i> List Blog</a></li>
                </ul>
            </li>

            <li class="treeview">
                <a href="#">
                    <i class="fa fa-envelope"></i>
                    <span>News And Events</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{URL::route('ExamType.create')}}"><i class="fa fa-circle-o"></i> Add News And Events</a></li>
                    <li><a href="{{URL::route('ExamType.index')}}"><i class="fa fa-circle-o"></i> List News And Events</a></li>
                </ul>
            </li>
                    
            <li class="header">Settings</li>
            <li></i> <span>Change Password</span></a></li>
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>
