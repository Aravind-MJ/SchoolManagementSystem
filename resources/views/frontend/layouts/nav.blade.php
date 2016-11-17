<div class="header" id="home">

	<div class="col-md-3 col-sm-3 col-xs-12">

	<div class="logo">
		<a href="index.html"><h1>Education Hub</h1></a>
	</div>
</div>
<!-- navigation -->

	<div class="col-md-9 col-sm-9 col-xs-12">
		<div class="ban-top-con">
			<div class="top_nav_left">
				<nav class="navbar navbar-default">
				  <div class="container-fluid">
					<!-- Brand and toggle get grouped for better mobile display -->
					<div class="navbar-header">
					  <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					  </button>
					</div>
					<!-- Collect the nav links, forms, and other content for toggling -->
					<div class="collapse navbar-collapse menu--shylock" id="bs-example-navbar-collapse-1">
					  <ul class="nav navbar-nav menu__list">
						<li class="active menu__item menu__item--current @yield('root')"><a class="menu__link" href="{{url('/')}}">Home <span class="sr-only">(current)</span></a></li>
						<li class=" menu__item @yield('About')"><a class="menu__link" href="{{url('About')}}">About us</a></li>
						<li class=" menu__item @yield('Academics')"><a class="menu__link scroll" href="#management">Academics</a></li>
						<li class=" menu__item @yield('Management')"><a class="menu__link scroll" href="#faculties">Management</a></li>
						<li class=" menu__item @yield('Blogs')"><a class="menu__link" href="{{url('Blogs')}}">Blogs</a></li>
						<li class=" menu__item "><a class="menu__link" href="{{url('Gallery')}}">Gallery</a></li>
						<li class=" menu__item "><a class="menu__link" href="{{url('Contact')}}">Contact</a></li>
						<li class=" menu__item"><a class="menu__link " href="{{url('login')}}">Login</a></li>
					  </ul>
					</div>
				  </div>
				</nav>	
				
			</div>
			<div class="clearfix"></div>
			</div>
		</div>
	<!-- //navigation -->
<!-- Slider -->
		<div class="slider">
			<div class="callbacks_container">
				<ul class="rslides" id="slider">
					<li>
						<div class="slider-img">
							<img src="{{url('frontend/images/bg2.jpg')}}" class="img-responsive" alt="education">
						</div>
						<div class="slider-info">
							<h3>Education</h3>
							<p>Education is the most powerful weapon which you can use to change the world.</p>
						</div>
					</li>
					<li>
						<div class="slider-img">
							<img src="{{url('frontend/images/bg3.jpg')}}" class="img-responsive" alt="education">
						</div>
						<div class="slider-info">
							<h3>Education</h3>
							<p>The purpose of education is to replace   an empty mind with an open one.</p>
						</div>
					</li>
					<li>
						<div class="slider-img">
							<img src="{{url('frontend/images/bg1.jpg')}}" class="img-responsive" alt="education">
						</div>
						<div class="slider-info">
							<h3>Education</h3>
							<p>Education is the most powerful weapon which you can use to change the world.</p>
						</div>
					</li>
					<li>
						<div class="slider-img">
							<img src="{{url('frontend/images/bg4.jpg')}}" class="img-responsive" alt="education">
						</div>
						<div class="slider-info">
							<h3>Education</h3>
							<p>The purpose of education is to replace   an empty mind with an open one.</p>
						</div>
					</li>
					<li>
						<div class="slider-img">
							<img src="{{url('frontend/images/bg5.jpg')}}" class="img-responsive" alt="education">
						</div>
						<div class="slider-info">
							<h3>Education</h3>
							<p>The goal of education is the advancement of knowledge and the dissemination of truth.</p>
						</div>
					</li
				</ul>
			</div>
			<div class="clearfix"></div>
		</div>
		<!-- //Slider -->
</div>