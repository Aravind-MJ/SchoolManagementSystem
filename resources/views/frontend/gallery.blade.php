@extends('frontend.layouts.layout')
@section('Gallery','menu__item--current')
@section('body')

			<div class="callbacks_container">
				<div class="slider-img">
							<img src="{{url('frontend/images/SLIDE.jpg')}}" class="img-responsive" alt="education" width="100%" height="200px">
						</div>
		

<!--activities-->
<div class="gallery" id="activities">
	<div class="container">
	  <div class="gallery-main">
	  	<div class="gallery-top">
	  		<h2 class="page-header text-center">Our Gallery</h3>
	  	</div>
	  	<div class="col-md-12 col-sm-12 col-xs-12 galp">
        	<h2 class="galp_h">{{$event->name}}</h2>
		</div>
		<p class="container">{{$event->description}}</p>
		
		<div class="gallery-bott">
		@foreach($data as $row)

			<div class="col-md-4 col1 gallery-grid">
				<a href="{{url('images/'.$row->name)}}" class="b-link-stripe b-animate-go  thickbox">

						<figure class="effect-bubba">
							<img class="img-responsive" src="{{url('images/'.$row->name)}}" alt="">
							<figcaption>
								<h4 class="gal"></h4>
								<p class="gal1">{{$row->caption}} </p>	
							</figcaption>			
						</figure>
					</a>
					</div>
		@endforeach
					<!-- <div class="col-md-4 col1 gallery-grid">
						<a href="{{url('frontend/images/g2.jpg')}}" class="b-link-stripe b-animate-go  thickbox">
						<figure class="effect-bubba">
							<img class="img-responsive" src="{{url('frontend/images/g2.jpg')}}" alt="">
							<figcaption>
								<h4 class="gal">Store</h4>
								<p class="gal1">“Live as if you were to die tomorrow. Learn as if you were to live forever.” </p>	
							</figcaption>			
						</figure>
						</a>
					</div>
					<div class="col-md-4 col1 gallery-grid">
						<a href="{{url('frontend/images/g3.jpg')}}" class="b-link-stripe b-animate-go  thickbox">
						<figure class="effect-bubba">
							<img class="img-responsive" src="{{url('frontend/images/g3.jpg')}}" alt="">
							<figcaption>
								<h4 class="gal">Projects & Programs</h4>
								<p class="gal1">“Live as if you were to die tomorrow. Learn as if you were to live forever.” </p>	
							</figcaption>			
						</figure>
						</a>
					</div>
			     <div class="col-md-4 col1 gallery-grid">
				  <a href="{{url('frontend/images/g4.jpg')}}" class="b-link-stripe b-animate-go  thickbox">
						<figure class="effect-bubba">
							<img class="img-responsive" src="{{url('frontend/images/g4.jpg')}}" alt="">
							<figcaption>
								<h4 class="gal">Hostel</h4>
								<p class="gal1">“Live as if you were to die tomorrow. Learn as if you were to live forever.” </p>	
							</figcaption>			
						</figure>
					</a>
					</div>
					<div class="col-md-4 col1 gallery-grid">
						<a href="{{url('frontend/images/g5.jpg')}}" class="b-link-stripe b-animate-go  thickbox">
						<figure class="effect-bubba">
							<img class="img-responsive" src="{{url('frontend/images/g5.jpg')}}" alt="">
							<figcaption>
								<h4 class="gal">Laboratory</h4>
								<p class="gal1">“Live as if you were to die tomorrow. Learn as if you were to live forever.” </p>	
							</figcaption>			
						</figure>
						</a>
					</div>
					<div class="col-md-4 col1 gallery-grid">
						<a href="{{url('frontend/images/g6.jpg')}}" class="b-link-stripe b-animate-go  thickbox">
						<figure class="effect-bubba">
							<img class="img-responsive" src="{{url('frontend/images/g6.jpg')}}" alt="">
							<figcaption>
								<h4 class="gal">Smart Classes</h4>
								<p class="gal1">“Live as if you were to die tomorrow. Learn as if you were to live forever.” </p>	
							</figcaption>			
						</figure>
						</a>
					</div>
					<div class="col-md-4 col1 gallery-grid">
						<a href="{{url('frontend/images/g7.jpg')}}" class="b-link-stripe b-animate-go  thickbox">
						<figure class="effect-bubba">
							<img class="img-responsive" src="{{url('frontend/images/g7.jpg')}}" alt="">
							<figcaption>
								<h4 class="gal">Career Development</h4>
								<p class="gal1">“Live as if you were to die tomorrow. Learn as if you were to live forever.” </p>	
							</figcaption>			
						</figure>
						</a>
					</div>
					<div class="col-md-4 col1 gallery-grid">
						<a href="{{url('frontend/images/g8.jpg')}}" class="b-link-stripe b-animate-go  thickbox">
						<figure class="effect-bubba">
							<img class="img-responsive" src="{{url('frontend/images/g8.jpg')}}" alt="">
							<figcaption>
								<h4 class="gal">Canteen</h4>
								<p class="gal1">“Live as if you were to die tomorrow. Learn as if you were to live forever.” </p>	
							</figcaption>			
						</figure>
						</a>
					</div>
					<div class="col-md-4 col1 gallery-grid">
						<a href="{{url('frontend/images/g9.jpg')}}" class="b-link-stripe b-animate-go  thickbox">
						<figure class="effect-bubba">
							<img class="img-responsive" src="{{url('frontend/images/g9.jpg')}}" alt="">
							<figcaption>
								<h4 class="gal">Sports & Athletics</h4>
								<p class="gal1">“Live as if you were to die tomorrow. Learn as if you were to live forever.” </p>	
							</figcaption>			
						</figure>
						</a>
					</div> -->
			     <div class="clearfix"> </div>
			</div>
		</div>
	</div>
</div>
<!--//activities-->
@endsection
<!--footer-->
