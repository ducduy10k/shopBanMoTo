
<!DOCTYPE html>
<html>
<head>
<title>Admin page</title>

<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="keywords" content="Slide Login Form template Responsive, Login form web template, Flat Pricing tables, Flat Drop downs Sign up Web Templates, Flat Web Templates, Login sign up Responsive web template, SmartPhone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />

	 <script>
        addEventListener("load", function () {
            setTimeout(hideURLbar, 0);
        }, false);

        function hideURLbar() {
            window.scrollTo(0, 1);
        }
    </script>

	<!-- Custom Theme files -->
	<link href="{{asset('public/backend/css/style.css')}}" rel="stylesheet" type="text/css" media="all" />
	<link href="{{asset('public/backend/css/font-awesome.min.css')}}" rel="stylesheet" type="text/css" media="all" />
	<!-- //Custom Theme files -->

	<!-- web font -->
	<link href="//fonts.googleapis.com/css?family=Hind:300,400,500,600,700" rel="stylesheet">
	<!-- //web font -->

</head>
<body>

<!-- main -->
<div class="w3layouts-main"> 
	<div class="bg-layer">
		<h1>Slide Login form</h1>

		<div class="header-main">
			<div class="main-icon">
				<span class="fa fa-eercast"></span>
			</div>
			<?php
			$message = Session::get('message');
			if($message){
				echo $message;
				Session::put('message',null);
			}
			?>
			<div class="header-left-bottom">
				<form action="{{URL::to('/admin-dashboard')}}" method="post">
				{{ csrf_field() }}
					<div class="icon1">
						<span class="fa fa-user"></span>
						<input type="email" name="admin_email" placeholder="Email Address" required=""/>
					</div>
					<div class="icon1">
						<span class="fa fa-lock"></span>
						<input type="password" name="admin_password" placeholder="Password" required=""/>
					</div>
					<div class="login-check">
						 <label class="checkbox"><input type="checkbox" name="checkbox" checked=""><i> </i> Keep me logged in</label>
					</div>
					<div class="bottom">
						<button class="btn">Log In</button>
					</div>
					<div class="links">
						<p><a href="#">Forgot Password?</a></p>
						<p class="right"><a href="#">New User? Register</a></p>
						<div class="clear"></div>
					</div>
				</form>	
			</div>
			<div class="social">
				<ul>
					<li>or login using : </li>
					<li><a href="#" class="facebook"><span class="fa fa-facebook"></span></a></li>
					<li><a href="#" class="twitter"><span class="fa fa-twitter"></span></a></li>
					<li><a href="#" class="google"><span class="fa fa-google-plus"></span></a></li>
				</ul>
			</div>
		</div>
		
		{{-- <!-- copyright -->
		<div class="copyright">
			<p>© 2019 Slide Login Form . All rights reserved | Design by <a href="http://w3layouts.com/" target="_blank">W3layouts</a></p>
		</div>
		<!-- //copyright -->  --}}
	</div>
</div>	
<!-- //main -->

</body>
</html>