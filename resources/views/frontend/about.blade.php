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
					<p>As per the references in ‘Aithihya mala’ written by kottarathil Sankunny, the name ‘Mookkuthala’ is derived  from ‘ Mukthisthalam’ or Mukkavala. This village is situated at the southern border of Malappuram district, in Nannammukku panchayath.  </p>
				</div>

				<div class="col-md-6 about-right">
					<img src="{{url('frontend/images/ab.jpg')}}" width="100%" height="400px" alt="" class="img-responsive">
				</div>
				<div class="col-md-12 about-left">
					<p>This village was educationally backward in the past Because the people had to go faraway places like Ponnani,Kumaranellure and Chavakkad for their studies.At this  juncture came the most generous and benevolent intellectual called Pakaravoor Manakkal Chithran Namboodirippad. He had been in Madras for his higher studies. Sri Chithran Namboodirippad found the frail educational background of his village and determined to start up a new school for his people.He built a school with a landed properties of 5 acres and named it ‘The school Mookkuthala.’He started the school on 07-06-1946. The school was inagurated by Sri A V Kutty Krishna Menon. Sri.K C Kunjettan was the first Head Master of the school. There was 166 students and 14 teaching and non-teaching staff. 
					Sri . Chithran Namboodirippad decided to hand over the school to the EMS Govt in 1957. He presented the school to his master and then educacation minister Dr. Joseph Mundessery for ‘1’ rupee on 01-10-1957. Thus he declared his social commitment. This great man,later became the joint director of education.
                                                                             
					This historic event played a vital role on the educational upgradation of the Alamkode,Nannammukku panchayaths and nearby areas.Higher Secondary classes started in 2000. It is one of the best schools in Malappuram district. It is our proud that our sghool has created so many great men in educational  cuitural and social realm. Now there are almost 100 teachers and more than 2000 students studying in this school.</p>
				</div>
			
            </div>
		</div>
			   <!--<div class="clearfix"> </div>-->
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