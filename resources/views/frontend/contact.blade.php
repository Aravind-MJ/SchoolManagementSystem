@extends('frontend.layouts.layout')
@section('Contact','menu__item--current')
@section('body')
<!-- contact us -->
			<div class="callbacks_container">
				<div class="slider-img">
							<img src="frontend/images/SLIDE.jpg" class="img-responsive" alt="education" width="100%" height="200px">
						</div>
						
				

<div class="contact">
	<div class="container">
		<div class="contact-agile">
			<div class="contact-top">
				<h2>Contact</h2>
				<p> </p>
			</div>
			<div class="contact-bottom">
				<div class="col-md-4 contact-left">
					<h3>Contact info</h3>
					<p class="con-para">Our Customer Service team are happy to help with any queries or problems you may have. Our offices are open from 8:30am until 9pm Mon-Fri (except Bank Holidays). Please call or mak queries on th below datas if outside the UK or email us here.</p>
					<div class="contact-add">
							<p class="fa fa-envelope">  info@example.com</p>
							<p class="fa fa-map-marker">      BD 2 Mars, N° 136, Morocco Casablanca</p><br>
							<p class="fa fa-phone">  +2158 85467</p>
						</div>
						<ul class="face">
							<li class="active"><a href="#">facebook </a><span>/</span></li>
							<li><a href="#">twitter </a><span>/</span></li>
							<li><a href="#">linkedin </a><span>/</span></li>
							<li><a href="#">dribbble </a></li>
						</ul>

				</div>
				<div class="col-md-8 contact-right">
					<form action="{{url('Contact')}}" method="post" name="contact">
					{{csrf_field()}}

						<div class="col-md-6"><input type="text" name="name" placeholder="Name" style="width: 100%"></div>
                        <div class="col-md-6"><input type="text" class="email" name="email" placeholder="Email" style="width: 100%"></div>
                        <div class="col-md-12"><input type="text" class="in-phone" name="phone" placeholder="Phone"></div>
                        <div class="col-md-12"><textarea name="message" placeholder="Message" ></textarea></div>
                        <div class="col-md-12"><input type="submit" value="Send"></div>
					</form>
				</div>
			    <div class="clearfix"> </div>
			</div>
			<div class="map">
				<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d158857.7281066703!2d-0.24168144921176335!3d51.5287718408761!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47d8a00baf21de75%3A0x52963a5addd52a99!2sLondon%2C+UK!5e0!3m2!1sen!2sin!4v1465382361097"> </iframe>
			</div>
		</div>
	</div>
</div>
<!--contact end here-->
<!-- end contact -->
@endsection
@section('validation')
<script>
    
    $(function () {

	    $("form[name='contact']").validate({

	        rules: {
	            name: {required: true,lettersonly: true},
	            email: {required: true,email: true},
	            phone:{
	    			required: true,
	                number: true,
	                minlength:10,
	                maxlength:10,
	                },
	            message:"required"                    
	    },

			messages: {
	            name: {required: "Please enter your name",lettersonly: "Please enter  letters only"},
	            email:{required: "Please enter email", email: "Please enter valid email!"},
	            phone:{required: "Please enter your phone number.",minlength: "Enter 10 digit phone number",maxlength: "Enter 10 digit phone number"},
	            message:"Please enter message"
	        },
			submitHandler: function (form) {
				form.submit();

	        }
	    });
    });
    
    jQuery.validator.addMethod("lettersonly", function(value, element) {
                return this.optional(element) || /^[a-zA-Z\s]+$/.test(value);},    "Letters only please"); 
</script>
@endsection