@extends('frontend.layouts.layout')
@section('Home','menu__item--current')
@section('body')

<div class="slider">
		
			<div class="callbacks_container">

				<ul class="rslides" id="slider">
@foreach($banner as $each_banner)
					<li>

						<div class="slider-img">
							<img src="{{url('images/'.$each_banner->name)}}" class="img-responsive" alt="education">
						</div>
						<div class="slider-info">
							<h3>Education</h3>
							<p>Education is the most powerful weapon which you can use to change the world.</p>
						</div>


					</li>
@endforeach
				</ul>

			</div>


			<div class="clearfix"></div>
		</div>

<!--main-content-->
<div class="agile-main" id="about">
	<div class="container">
	<!--about-->
		<div class="about">
			<h2>about us</h2>
			
			<h4>Sri Pakaravoor Manakkal Chithran Namboodirippad found the frail educational background of the village ‘Mookkuthala’ and determined to start up a new school for his people. He built a school with a landed properties of 5 acres and named it ‘The school Mookkuthala.’He started the school on 07-06-1946. The school was inagurated by Sri A V Kutty Krishna Menon. Sri.K C Kunjettan was the first Head Master of the school. There was 166 students and 14 teaching and non-teaching staff. </h4>
			<img src="{{url('frontend/images/su.jpg')}}" alt="sucess">
            <p>Sri . Chithran Namboodirippad decided to hand over the school to the EMS Govt in 1957. He presented the school to his master and then educacation minister Dr. Joseph Mundessery for ‘1’ rupee on 01-10-1957. Thus he declared his social commitment. This great man,later became the joint director of education.</p>
                                            
            <p>This historic event played a vital role on the educational upgradation of the Alamkode,Nannammukku panchayaths and nearby areas.Higher Secondary classes started in 2000.  It is our proud that our school has created so many great men in educational  cuitural and social realm. Now there are almost 100 teachers and more than 2000 students studying in this school.</p>		
		</div>
		<div class="clearfix"></div>
	<!--//about-->
	</div>
</div>
<!--meet our management-->
<div class="team" id="management">
	<div class="container">
		<h3> our academics</h3>
		<p>We encourage our students to expand their horizons and develop into independent learners based on the curriculam</p>
		<div class="w3grids">
			<div class="w3grid col-md-3">
				<img src="{{url('frontend/images/student1.jpg')}}" alt="team1" class="img1-w3l">
				<h5>Kinter Garten</h5>
				<p>Our Kindergarten fosters a love for learning. Each classroom is a nurturing, multisensory environment that supports this goal.</p>
				<!--div class="socialw3-icons">
					<i class=" so1 fa fa-facebook" aria-hidden="true"></i>
					<i class=" so2 fa fa-twitter" aria-hidden="true"></i>
					<i class=" so3 fa fa-google" aria-hidden="true"></i>
				</div-->
			</div>
			<div class="w3grid col-md-3">
				<img src="{{url('frontend/images/student2.jpg')}}" alt="team1" class="img2-w3l">
				<h5>Primary School</h5>
				<p>Along with the ICSE syllabus, we lay the foundation for young learners to develop their skills and their potential as a unique individual.</p>
				<!--div class="socialw3-icons">
					<i class=" so1 fa fa-facebook" aria-hidden="true"></i>
					<i class=" so2 fa fa-twitter" aria-hidden="true"></i>
					<i class=" so3 fa fa-google" aria-hidden="true"></i>
				</div-->
			</div>
			<div class="w3grid col-md-3">
				<img src="{{url('frontend/images/student3.jpg')}}" alt="team1" class="img3-w3l">
				<h5>Junior School</h5>
				<p>We use these key years to prepare a child for career and college. We encourage our students to expand their horizons.</p>
				<!--div class="socialw3-icons">
					<i class=" so1 fa fa-facebook" aria-hidden="true"></i>
					<i class=" so2 fa fa-twitter" aria-hidden="true"></i>
					<i class=" so3 fa fa-google" aria-hidden="true"></i>
				</div-->
			</div>
			<div class="w3grid col-md-3">
				<img src="{{url('frontend/images/student4.jpg')}}" alt="team1" class="img4-w3l">
				<h5>Senior School</h5>
				<p>The IGCSE curriculum is balanced and flexible with clear learning objectives.It combines a world class curriculum with an international perspective.</p>
				<!--div class="socialw3-icons">
					<i class=" so1 fa fa-facebook" aria-hidden="true"></i>
					<i class=" so2 fa fa-twitter" aria-hidden="true"></i>
					<i class=" so3 fa fa-google" aria-hidden="true"></i>
				</div-->
			</div>
		</div>
		<div class="clearfix"></div>
	</div>
</div>
<!--//meet our management-->

<!--welcome-->
<div class="w3l-welcome">
	<div class="container">
		<div class=" agile-welcome">
			<div class="text-w3">
				<h4>welcome to our university</h4>
				<p>Our School Provides vast features for the students.</p>
			</div>
			<div class="grids">
				<div class="grid">
					<div class="icons">
						<i class="fa fa-book" aria-hidden="true"></i>
					</div>
					<div class="text">
						<h5>SKILLED TEACHERS</h5>
						<p>What we think guides how we view the world, including how we view challenging students.</p>
					</div>
				</div>
				<div class="grid">
					<div class="icons">
						<i class="fa fa-thumbs-up" aria-hidden="true"></i>
					</div>
					<div class="text">
						<h5>Career Growth</h5>
						<p>We provide the resources to help you build your skills and be seen for the value you bring to your work.</p>
					</div>
				</div>
				<div class="grid">
					<div class="icons">
						<i class="fa fa-table" aria-hidden="true"></i>
					</div>
					<div class="text">
						<h5>BIG LIBRARY</h5>
						<p>The Big Library Read program is open to all OverDrive library and school partners worldwide.</p>
					</div>
				</div>
				
				<div class="grid">
					<div class="icons">
						<i class="fa fa-laptop" aria-hidden="true"></i>
					</div>
					<div class="text">
						<h5>WELL EQUIPPED LABS</h5>
						<p>Conduct experiments that replicate or illustrate a scientific principle introduced in the course.</p>
					</div>
				</div>

			</div>
			<div class="w3-img">
				<img src="{{url('frontend/images/man2.jpg')}}" alt="image" />
			</div>
			<div class="clearfix"></div>
		</div>
	</div>
</div>
<!--//welcome-->





<!--faculty-->
<div class="w3-faculty" id="faculties">
	<div class="container">
		<div class="faculty-head">
			<h5>meet our management</h5>
			<p>“The King’s School is under the umbrella of The King’s Educational Trust (Registered), floated by the original visionaries of this dream.” </p>
		</div>
		<div class="main-faculty">
			<div class="f1 col-md-3 faculty1">
				<ul class="demo-2 effect">
					<li>
					   <h3 class="zero">PRINCIPAL</h3>
					   <p class="zero">Lorem ipsum dolor sit amet.</p>
					</li>
					 <li><img class="top" src="{{url('frontend/images/f1.jpg')}}" alt=""/></li>
				</ul>
				<h4>John Roy</h4>
				<p>John Roy is the Senior Fellow for Education Policy and a retired assistant dean of Cleveland State University’s Cleveland-Marshall.</p>
				<div class="social-icons">
					<i class="s1 fa fa-facebook" aria-hidden="true"></i>
					<i class="s2 fa fa-twitter" aria-hidden="true"></i>
					<i class="s3 fa fa-google" aria-hidden="true"></i>
				</div>
			</div>
			<div class="f2 col-md-3 faculty1">
				<ul class="demo-2 effect">
					<li>
					   <h3 class="zero">CHAIRMAN</h3>
					   <p class="zero">Lorem ipsum dolor sit amet.</p>
					</li>
					 <li><img class="top" src="{{url('frontend/images/f6.jpg')}}" alt=""/></li>
				</ul>
				<h4>Jesse Roy</h4>
				<p>Jesse Roy has worked at PNC Bank for 25 years and serves as vice president in Network Planning & Delivery.</p>
				<div class="social-icons">
					<i class=" s1 fa fa-facebook" aria-hidden="true"></i>
					<i class=" s2 fa fa-twitter" aria-hidden="true"></i>
					<i class=" s3 fa fa-google" aria-hidden="true"></i>
				</div>
			</div>
			<div class="f3 col-md-3 faculty1">
				<ul class="demo-2 effect">
					<li>
					   <h3 class="zero">BUSINESS MANAGER</h3>
					   <p class="zero">Lorem ipsum dolor sit amet.</p>
					</li>
					 <li><img class="top" src="{{url('frontend/images/f3.jpg')}}" alt=""/></li>
				</ul>
				<h4>Xena Wob</h4>
				<p>Xena Wob works as an assistant vice president for private banking at Fifth Third Bank. She has over 25 years experience.</p>
				<div class="social-icons">
					<i class=" s1 fa fa-facebook" aria-hidden="true"></i>
					<i class=" s2 fa fa-twitter" aria-hidden="true"></i>
					<i class=" s3 fa fa-google" aria-hidden="true"></i>
				</div>
			</div>
			<div class="f4 col-md-3 faculty1">
				<ul class="demo-2 effect">
					<li>
					   <h3 class="zero">TRUSTEE</h3>
					   <p class="zero">Lorem ipsum dolor sit amet.</p>
					</li>
					 <li><img class="top" src="{{url('frontend/images/f4.jpg')}}" alt=""/></li>
				</ul>
				<h4>Victor Hi</h4>
				<p>Victor Hi currently works in security for the Cleveland Clinic Foundation. He is also retired as a claims representative for State.</p>
				<div class="social-icons">
					<i class="s1 fa fa-facebook" aria-hidden="true"></i>
					<i class="s2 fa fa-twitter" aria-hidden="true"></i>
					<i class="s3 fa fa-google" aria-hidden="true"></i>
				</div>
			</div>
			
			<div class="clearfix"></div>
		</div>
	</div>
</div>
<!--//faculty-->




<div class="team news" id="news">
	<div class="container">
		<div class="open-head">
			<h6>Gallery</h6>
			<p>“The King’s School is under the umbrella of The King’s Educational Trust (Registered), floated by the original visionaries of this dream.” </p>
		</div>
					<div class="news-grids">
					@foreach($data as $row)
						<div class="col-md-4 news-grid">
							<img src="{{url('images/'.$row->image)}}" class="img-responsive" alt=""/>
							<div class="w3grid col-md-12 news-text">
								<h5>{{$row->name}}</h5>
								<p class="open-head">{{$row->description}}</p>
								
                         			 <div class="map">
						  				<a href=  "{{url('Gallery/'.$row->id)}}">Read More
						  				</a>
						  			 </div>
							</div>
						</div>
					@endforeach
						</div>
						<div class="clearfix"></div>
					</div>
		</div>
				</div>




<!--contact-->
<div class="agile-contact" id="contact">
	<div class="left-contact">

			<h6>contact us</h6>
			<ul>
				<li><i class="fa fa-envelope" aria-hidden="true"></i><a href="mailto:info@example.com">info@example.com</a></li>
				<li><i class="fa fa-phone" aria-hidden="true"></i>+2158 85467</li>
				<li><i class="fa fa-map-marker" aria-hidden="true"></i>BD 2 Mars, N° 136, Morocco Casablanca</li>
			</ul>
	
	</div>
	<div class="right-contact">
		<div class="map">
			<iframe class="mapp" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d5662244.714693903!2d-2.279153484594319!3d46.13545249359953!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xd54a02933785731%3A0x6bfd3f96c747d9f7!2sFrance!5e0!3m2!1sen!2sin!4v1471606088687" frameborder="0" style="border:0" allowfullscreen></iframe>
			<form action="#" method="post">
				<input placeholder="Name" name="Name" class="name" type="text" required=""><br>
				<input placeholder="E-mail" name="Name" class="name" type="text" required=""><br>
				<textarea placeholder="Message"></textarea><br>
				<input type="submit" value="send message">
			</form>
		</div>
	</div>
	<div class="clearfix"></div>
</div>
<!--//contact-->

<!--//main-content-->
@endsection
