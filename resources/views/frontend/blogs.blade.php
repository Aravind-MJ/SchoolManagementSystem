@extends('frontend.layouts.layout')
@section('Blog','menu__item--current')
@section('body')
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
			<!-- First Blog Post -->
            <h3><a href="blog-post.html">Cooperate meeting on Monday</a></h3>
            <p class="lead">by <a href="index.html">John Roy, Principal</a></p>
            <p class="blog-agile1"><i class="fa fa-clock-o"></i> Posted on May 28, 2016 at 10:00 PM</p>
            <hr>
            <a href="blog-post.html">
				<div class="hover01 column">
					<div>
						<figure><img class="img-responsive img-hover" src="{{url('frontend/images/blog-img2.jpg')}}" alt=""></figure>
					</div>
				</div>
            </a>
            <hr>
            <p class="blog-agile2">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolore, veritatis, tempora, necessitatibus inventore nisi quam quia repellat ut tempore laborum possimus eum dicta id animi corrupti debitis ipsum officiis rerum.</p>
            <a class="btn btn-primary" href="blog-post.html">Read More <i class="fa fa-angle-right"></i></a>
			<hr>
			
			<!-- Second Blog Post -->
            <h3><a href="blog-post.html">Annual Sports</a></h3>
            <p class="lead">by <a href="index.php">Victor Hi, Trustee</a></p>
            <p class="blog-agile1"><i class="fa fa-clock-o"></i> Posted on May 29, 2016 at 10:45 PM</p>
            <hr>
            <a href="blog-post.html">
                <div class="hover01 column">
					<div>
						<figure><img class="img-responsive img-hover" src="{{url('frontend/images/blog-img3.jpg')}}" alt=""></figure>
					</div>
				</div>
            </a>
            <hr>
            <p class="blog-agile2">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quibusdam, quasi, fugiat, asperiores harum voluptatum tenetur a possimus nesciunt quod accusamus saepe tempora ipsam distinctio minima dolorum perferendis labore impedit voluptates!</p>
            <a class="btn btn-primary" href="blog-post.html">Read More <i class="fa fa-angle-right"></i></a>
			<hr>
			<!-- Third Blog Post -->
            
			<h3><a href="blog-post.html">Councelling for Senior Kids</a></h3>
            <p class="lead">by <a href="index.php">Jssey Roy, Chairman</a></p>
            <p class="blog-agile1"><i class="fa fa-clock-o"></i> Posted on August 30, 2016 at 10:45 PM</p>
            <hr>
            <a href="blog-post.html">
				<div class="hover01 column">
					<div>
						<figure><img class="img-responsive img-hover" src="{{url('frontend/images/blog-img1.jpg')}}" alt=""></figure>
					</div>
				</div>
            </a>
            <hr>
            <p class="blog-agile2">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cupiditate, voluptates, voluptas dolore ipsam cumque quam veniam accusantium laudantium adipisci architecto itaque dicta aperiam maiores provident id incidunt autem. Magni, ratione.</p>
            <a class="btn btn-primary" href="blog-post.html">Read More <i class="fa fa-angle-right"></i></a>
			<hr>

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