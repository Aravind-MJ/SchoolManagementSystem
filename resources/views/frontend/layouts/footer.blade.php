<div class="w3l-footer">
	<div class="container">
		<div class="left-w3">
			<a href="#">education hub</a>
		</div>
		<div class="right-social">
			<i class="fa fa-facebook-square" aria-hidden="true"></i>
			<i class="fa fa-twitter-square" aria-hidden="true"></i>
			<i class="fa fa-google-plus-square" aria-hidden="true"></i>
		</div>
		<div class="clearfix"></div>
		<div class="footer-nav">
			<ul>
				<li><a class="menu__link scroll" href="#home">home</a></li>
				<li><a class="menu__link scroll" href="#about">about</a></li>
				<li><a class="menu__link scroll" href="#management">management</a></li>
				<li><a class="menu__link scroll" href="#activities">activities</a></li>
				<li><a class="menu__link scroll" href="#faculties">faculties</a></li>
				<li><a class="menu__link scroll" href="#contact">contact</a></li>
			</ul>
		</div>
		<div class="copyright-agile">
			<p>&copy; 2016 Education Hub. All rights reserved | Design by <a href="http://w3layouts.com">Imrokraft Solutions Pvt. Ltd.</a></p>
		</div>
	</div>
</div>
<!--//footer-->
<!-- smooth scrolling -->
	<script type="text/javascript">
		$(document).ready(function() {
		/*
			var defaults = {
			containerID: 'toTop', // fading element id
			containerHoverID: 'toTopHover', // fading element hover id
			scrollSpeed: 1200,
			easingType: 'linear' 
			};
		*/								
		$().UItoTop({ easingType: 'easeOutQuart' });
		});
	</script>
	@yield('validation')
	<a href="#" id="toTop" style="display: block;"> <span id="toTopHover" style="opacity: 1;"> </span></a>
<!-- //smooth scrolling -->
</body>
</html>