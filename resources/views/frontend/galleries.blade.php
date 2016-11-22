@extends('frontend.layouts.layout')
@section('Galleries','menu__item--current')
@section('body')

			<div class="callbacks_container">
				<div class="slider-img">
							<img src="{{url('frontend/images/SLIDE.jpg')}}" class="img-responsive" alt="education" width="100%" height="200px">
				</div>
<div class="team_gal news" id="news">
	<div class="container">
		<div class="about-top">
				<h2>Galleries</h2>
			</div>
		<div class="news-grids">
		@foreach($data as $row)
			<div class="col-md-4 news-grid">
				<img src="{{url('images/'.$row->image)}}" class="img-responsive" alt=""/>
					
						<h5>{{$row->name}}</h5>
							<p> 05 December </p>
							<p class="blog-agile2">{{$row->description}}</p>
							<a class="btn btn-primary" href="{{url('Gallery/'.$row->id)}}">Read More <i class="fa fa-angle-right"></i></a>
						
					</div>
					@endforeach
			</div>
			<div class="clearfix"></div>
	</div>
</div>
<!--activities-->

<!--//activities-->
@endsection
<!--footer-->
