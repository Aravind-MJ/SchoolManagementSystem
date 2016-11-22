@extends('frontend.layouts.layout')
@section('Blogs','menu__item--current')
@section('body')
<div class="callbacks_container">
	<div class="slider-img">
		<img src="{{url('frontend/images/SLIDE.jpg')}}" class="img-responsive" alt="education" width="100%" height="200px">
	</div>
</div>

<div class="container">
	<div class="col-md-8">

		<div class="col-md-12">
            <h3>{{$blog->blog_title}}</h3>
           
            <hr>
            
				<div class="column">
					<div>
						<figure><img src="{{url('images/'.$blog->blog_img)}}" alt="" width="70%" height="200px"/></figure>
					</div>
				</div>
       
            <hr>
            <p class="blog-agile2">{{$blog->blog_cont}}</p>
           
			<hr>
		</div>
	</div>
</div>
@endsection