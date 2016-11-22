@extends('frontend.layouts.layout')
@section('About','menu__item--current')
@section('body')

<link href="{{url('frontend/css/styleabt.css')}}" rel="stylesheet" type="text/css" media="all">
			<div class="callbacks_container">
				<div class="slider-img">
							<img src="frontend/images/SLIDE.jpg" class="img-responsive" alt="education" width="100%" height="200px">
						</div>
				

<!--about strat here-->
<div class="about">
	<div class="container">
		<div class="about-main">
			<div class="about-top">
				<h2>About Us</h2>
			</div>
			<div class="about-bottom">
				<div class="col-md-6 about-left">
					<h4>There's something about Education Hub</h4>
					<p>The home school that started at Elizabeth and Jacob K. Mathai’s residence in 1998, with the goal to provide quality pre-school education for their son Joel and niece Sara Abraham, was the stage for the genesis of ‘The King’s School’. Elizabeth used the internationally acclaimed phonic system called Letterland to teach these first students and was excited with the rapid progress. Learning became fun and rewarding for the children as well as the parents.</p>
				</div>
				<div class="col-md-6 about-right">
					<img src="{{url('frontend/images/ab.jpg')}}" width="100%" height="400px" alt="" class="img-responsive">
				</div>
			   <div class="clearfix"> </div>
			</div>
		</div>
	</div>
</div>
<!--about end here-->
<div class="history">
	<div class="container">
		<div class="history-main">
	 	<div class="history-top">
	 	    <h3>Our History</h3>
	    </div>
	    <div class="history-bottom">
	    	<div class="col-md-4 history-grids">
	    		<h4>2015</h4>
	    		<p>Integer rutrum ante eu lacuestibulum libero nisl porta vel scelerisque eget malesuada at neque Vivamus eget nibh etiamursus leo.</p>
	    	</div>
	    	<div class="col-md-4 history-grids">
	    		<h4>2014</h4>
	    		<p>Integer rutrum ante eu lacuestibulum libero nisl porta vel scelerisque eget malesuada at neque Vivamus eget nibh etiamursus leo.</p>
	    	</div>
	    	<div class="col-md-4 history-grids">
	    		<h4>2013</h4>
	    		<p>Integer rutrum ante eu lacuestibulum libero nisl porta vel scelerisque eget malesuada at neque Vivamus eget nibh etiamursus leo.</p>
	    	</div>
	    	<div class="clearfix"> </div>
	    </div>
	    <div class="history-bottom">
	    	<div class="col-md-4 history-grids">
	    		<h4>2012</h4>
	    		<p>Integer rutrum ante eu lacuestibulum libero nisl porta vel scelerisque eget malesuada at neque Vivamus eget nibh etiamursus leo.</p>
	    	</div>
	    	<div class="col-md-4 history-grids">
	    		<h4>2011</h4>
	    		<p>Integer rutrum ante eu lacuestibulum libero nisl porta vel scelerisque eget malesuada at neque Vivamus eget nibh etiamursus leo.</p>
	    	</div>
	    	<div class="col-md-4 history-grids">
	    		<h4>2009</h4>
	    		<p>Integer rutrum ante eu lacuestibulum libero nisl porta vel scelerisque eget malesuada at neque Vivamus eget nibh etiamursus leo.</p>
	    	</div>
	      <div class="clearfix"> </div>
	    </div>
	 </div>
   </div>
</div>
<!--team start here-->
<div class="">
	<div class="container">
		<div class="team-main">
             <div class="team-head">
             	<h3>Our Managment</h3>          	
             </div>
             <div class="team-bottom">
             	<!-- experts -->
				<div class="team-agileits">
						<div class="col-md-3 team-agileits-grid">
							<div class="btm-right">
								<img src="{{url('frontend/images/t1.jpg')}}" alt=" ">
									<div class="captn">
										<h4>Kathrine</h4>
										<ul class="team-icons">
											<li><a class="fa" href="#"> </a></li>
											<li><a class="tw" href="#"> </a></li>
											<li><a class="g" href="#"> </a></li>
										</ul>
									</div>
							</div>
						</div>
						<div class="col-md-3 team-agileits-grid">
							<div class="btm-right">
								<img src="{{url('frontend/images/t2.jpg')}}" alt=" ">
									<div class="captn">
										<h4>Mary</h4>
										<ul class="team-icons">
											<li><a class="fa" href="#"> </a></li>
											<li><a class="tw" href="#"> </a></li>
											<li><a class="g" href="#"> </a></li>
										</ul>
									</div>
							</div>
						</div>
						<div class="col-md-3 team-agileits-grid">
							<div class="btm-right">
								<img src="{{url('frontend/images/t3.jpg')}}" alt=" ">
									<div class="captn">
										<h4>John Doe</h4>
										<ul class="team-icons">
											<li><a class="fa" href="#"> </a></li>
											<li><a class="tw" href="#"> </a></li>
											<li><a class="g" href="#"> </a></li>
										</ul>	
									</div>
							</div>
						</div>
						<div class="col-md-3 team-agileits-grid">
							<div class="btm-right">
								<img src="{{url('frontend/images/t4.jpg')}}" alt=" ">
									<div class="captn">
										<h4>Jenny</h4>
										<ul class="team-icons">
											<li><a class="fa" href="#"> </a></li>
											<li><a class="tw" href="#"> </a></li>
											<li><a class="g" href="#"> </a></li>
										</ul>
									</div>
							</div>
						</div>
						<div class="clearfix"> </div>
				</div>
				<!-- //experts -->
             </div>
		</div>
	</div>
</div>
<div><br><br></div>
<!--team end here-->

@endsection