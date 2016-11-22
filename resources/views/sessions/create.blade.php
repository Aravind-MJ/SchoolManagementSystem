<!DOCTYPE HTML>
<html>
<head>
<title>SMS</title>
<script src="backend/js/jquery.min.js"></script>
<!-- Custom Theme files -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css">
<link href="backend/css/style.css" rel="stylesheet" type="text/css" media="all"/>
<!-- for-mobile-apps -->
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
<!-- //for-mobile-apps -->
<!--Google Fonts-->
<link href='//fonts.googleapis.com/css?family=Roboto+Condensed:400,700' rel='stylesheet' type='text/css'>
</head>
<body>
<!--header start here-->

<div class="header">
         <div class="col-md-8 div_back" style="height:100px;"></div>
			<div class="col-md-4 div_back">
			<div class="back_admin" > <button class="but1"><span>Back to Home </span></button>	</div>
			</div>
		<div class="header-main">
		
			
		       <h1>SMS LOGIN FORM</h1>
			<div class="header-bottom">
				<div class="header-right w3agile">
					
					<div class="header-left-bottom agileinfo">
						
					 <form action="{{route('sessions.store')}}" method="post">
					 
@include('flash')
						<input type="text" name="email" placeholder="Email"/>							
					    <input type="password" name="password"/>
						{{csrf_field()}}
						<div class="remember">
			             <span class="checkbox1">
							   <label class="checkbox"><input type="checkbox" name="remember" checked=""><i> </i>Remember me</label>
						 </span>
						 <div class="forgot">
						 	<h6><a href="{{ url('forgot_password') }}">Forgot Password?</a></h6>
						 </div>
						<div class="clear"> </div>
					  </div>
					   
						<input type="submit" value="Login">
					</form>	
					
					<!-- <div class="header-left-top">
						<div class="sign-up"> <h2>or</h2> </div>
					
					</div>
					<div class="header-social wthree">
							<a href="#" class="face"><h5>Facebook</h5></a>
							<a href="#" class="twitt"><h5>Twitter</h5></a>
						</div> -->
						
				</div>
				</div>
			  
			</div>
		</div>
		
		<div style="text-align:center">

					
					<p><strong>Management User:</strong> management@management.com<br>
                    <strong>Management Password:</strong> sentinelmanagement</p>

                    <p><strong>Administrator User:</strong> administrator@administrator.com<br>
                    <strong>Administrator Password:</strong> sentineladministrator</p>

                    <p><strong>Admin User:</strong> admin@admin.com<br>
                    <strong>Admin Password:</strong> sentineladmin</p>

                    <p><strong>Student User:</strong> user@user.com<br>
                    <strong>Student User Password:</strong> sentineluser</p>
                    
                    <p><strong>Faculty User:</strong> faculty@faculty.com<br>
                    <strong>Faculty Password:</strong> sentinelfaculty</p>
        </div>
</div>
<!--header end here-->

<!--footer end here-->
<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>
</html>