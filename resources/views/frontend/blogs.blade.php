@extends('frontend.layouts.layout')
@section('Blogs','menu__item--current')
@section('body')

			<div class="callbacks_container">
				<div class="slider-img">
							<img src="frontend/images/SLIDE.jpg" class="img-responsive" alt="education" width="100%" height="200px">
						</div>
				</div>
				<!--ul class="rslides" id="slider">
					<li>
						<div class="slider-img">
							<img src="images/bg2.jpg" class="img-responsive" alt="education" >
						</div>
						<div class="slider-info">
							<h3>Education</h3>
							<p>Education is the most powerful weapon which you can use to change the world.</p>
						</div>
					</li>
				</ul-->
		
			
		<!-- //Slider -->
</div>
<!-- blogs start-->
<section class="blog-w3ls">	
	<div class="container">
		<!-- Page Heading/Breadcrumbs -->
        <div class="row">
            <div class="col-lg-12">
                <h2 class="page-header text-center">Blog</h2>
            </div>
        </div>
        <!-- /.row -->
		<div class="row">
		<!-- Blog Entries Column -->
        <div class="col-md-8">
		@foreach($data as $blog)	<!-- First Blog Post -->
		<div class="col-md-12">
            <h3><a href="blog-post.html">{{$blog->blog_title}}</a></h3>
           
            <hr>
            <a href="{{url('Blog/'.$blog->id)}}">
				<div class="hover01 column">
					<div>
						<figure><img class="img-responsive img-hover" src="{{url('images/'.$blog->blog_img)}}" alt=""></figure>
					</div>
				</div>
            </a>
            <hr>
            <p class="blog-agile2">{{$blog->blog_cont}}...</p>
            <a class="btn btn-primary" href="{{url('Blog/'.$blog->id)}}">Read More <i class="fa fa-angle-right"></i></a>
			<hr>
			</div>
@endforeach	
            <!-- Pager -->
            <ul class="pager">
                <li class="previous">
                    <a href="#">&larr; Older</a>
                </li>
                <li class="next">
                    <a href="#">Newer &rarr;</a>
                </li>
            </ul>
		</div>
		<!-- Blog Sidebar Widgets Column -->
        <div class="col-md-4">
			<section class="blogwell-w3ls">
				<!-- Blog Search Well -->
				<div class="well">
					<h4>Blog Search</h4>
					<form action="#" method="post">
						<div class="input-group">
							<input type="text" class="form-control" id="search" placeholder="Search" required/>
							<span class="input-group-btn">
								<button class="btn btn-default" type="submit" ><i class="fa fa-search"></i></button>
							</span>
						</div>
					</form>
					<!-- /.input-group -->
				</div>
				<!-- Blog Categories Well -->
				<div class="well">
					<h4>Blog Categories</h4>
					<div class="row">
						<div class="col-lg-12">
							<ul class="list-unstyled">
								<li><a href="#"><span class="fa fa-hand-o-right" aria-hidden="true"></span>Cooperate meeting on Monday<span class="fa fa-hand-o-left" aria-hidden="true"></span></a></li>
								<li><a href="#"><span class="fa fa-hand-o-right" aria-hidden="true"></span>Annual Sports Meet<span class="fa fa-hand-o-left" aria-hidden="true"></span></a></li>
								<li><a href="#"><span class="fa fa-hand-o-right" aria-hidden="true"></span>Councelling for Juniors<span class="fa fa-hand-o-left" aria-hidden="true"></span></a></li>
								<li><a href="#"><span class="fa fa-hand-o-right" aria-hidden="true"></span>Cooperate meeting on Monday<span class="fa fa-hand-o-left" aria-hidden="true"></span></a></li>
								<li><a href="#"><span class="fa fa-hand-o-right" aria-hidden="true"></span>Pta Meetings<span class="fa fa-hand-o-left" aria-hidden="true"></span></a></li>
								<li><a href="#"><span class="fa fa-hand-o-right" aria-hidden="true"></span>New Book Release in Library<span class="fa fa-hand-o-left" aria-hidden="true"></span></a></li>
								<li><a href="#"><span class="fa fa-hand-o-right" aria-hidden="true"></span>Annual Report presentation<span class="fa fa-hand-o-left" aria-hidden="true"></span></a></li>
								<li><a href="#"><span class="fa fa-hand-o-right" aria-hidden="true"></span>Intr School Arts Fest<span class="fa fa-hand-o-left" aria-hidden="true"></span></a></li>
							</ul>
						</div>
						<!-- /.col-lg-6 -->
					</div>
					<!-- /.row -->
				</div>
				<!-- Side Widget Well -->
				<div class="well">
					<h4>Side Widget Well</h4>
					<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Inventore, perspiciatis adipisci accusamus laudantium odit aliquam repellat tempore quos aspernatur vero.</p>
				</div>
			</section>	
		</div>
		</div>
        <!-- /.row -->
        <hr>
    </div>
    <!-- /.container -->
</section>	

@endsection