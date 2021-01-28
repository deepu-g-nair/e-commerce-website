<!--
author: W3layouts
author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<?php
	include 'connection.php';
    include 'otp.php';
    require_once 'config.php';
    $stat=0;
    $nx = 6; 
    $otp_num=generateNumericOTP($nx); 
    if( isset($_GET['y']) && !empty( $_GET['y'] ))
	{
		
        $stat=urldecode($_GET['y']);
        $stat = encryptor('decrypt', $stat);
    }
	if(isset($_POST['button_register']))
	{
		$username=$_POST['username'];
		$no=$_POST['no'];
		$pass1=$_POST['pass1'];
		$pass2=$_POST['pass2'];
		if (ctype_digit(strval($no)) )
        {
            if($pass1==$pass2)
            {
               
                // Account details
                $apiKey = urlencode(‘buCSitKcXB8-J7LjTEsLTBzgj1FBg2puQH6WkcO3lE’);
                // Message details
                $numbers = array($no);
                $sender = urlencode(‘TXTLCL’);
                $message = rawurlencode("Your one time password (OTP) for activating your account is $otp_num");

                $numbers = implode(‘,’, $numbers);

                // Prepare data for POST request
                $data = array(‘apikey’ => $apiKey, ‘numbers’ => $numbers, “sender” => $sender, “message” => $message);
                // Send the POST request with cURL
                $ch = curl_init("https://api.textlocal.in/send/");
                curl_setopt($ch, CURLOPT_POST, true);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                $response = curl_exec($ch);
                curl_close($ch);
                echo $response;
                // Process your response here
                
                $inf=1;
                $cod=urlencode(encryptor('encrypt',$inf));
			    header("Location:registered.php?y='.$cod");
                
                
                
            }
            else
            {
                header("Location:registered.php?p=1");
                
            }
        }
        else
        {
            header("Location:registered.php?n=1");
        }

	}
    if(isset($_POST['button_otp']))
    {
        $otp=$_POST['otp'];
        if (ctype_digit(strval($otp)) && $otp==$otp_num)
        {
           
            $ins=mysqli_query($con,"INSERT INTO `user_login`(`id`, `username`, `phone_number`, `password`, `flag`) VALUES ('','$username','$no','$pass1','0')");
            if($ins>0)
            {
                session_start();
                $_SESSION['x']="$username";
                $inff=1;
                $ode=urlencode(encryptor('encrypt',$inff));
                header("Location:index.php?q='.$ode");
            }
            else
            {
                echo "no insertion";
            }
        }
        else
        {
            echo "condition error";
        }
    }
 ?>
<!DOCTYPE html>
<html>
<head>
<title>Super Market an Ecommerce Online Shopping Category Flat Bootstrap Responsive Website Template | Registered :: w3layouts</title>
<!-- for-mobile-apps -->
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Super Market Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template,
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false);
		function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- //for-mobile-apps -->
<link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
<link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
<link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
<!-- font-awesome icons -->
<link href="css/font-awesome.css" rel="stylesheet">
<!-- //font-awesome icons -->
<!-- js -->
<script src="js/jquery-1.11.1.min.js"></script>
<!-- //js -->
<link href='//fonts.googleapis.com/css?family=Raleway:400,100,100italic,200,200italic,300,400italic,500,500italic,600,600italic,700,700italic,800,800italic,900,900italic' rel='stylesheet' type='text/css'>
<link href='//fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600,600italic,700,700italic,800,800italic' rel='stylesheet' type='text/css'>
<!-- start-smoth-scrolling -->
<script type="text/javascript" src="js/move-top.js"></script>
<script type="text/javascript" src="js/easing.js"></script>
<script type="text/javascript">
	jQuery(document).ready(function($) {
		$(".scroll").click(function(event){
			event.preventDefault();
			$('html,body').animate({scrollTop:$(this.hash).offset().top},1000);
		});
	});
</script>
<style>
    input::-webkit-outer-spin-button,
input::-webkit-inner-spin-button {
  -webkit-appearance: none;
  
}
</style>
<!-- start-smoth-scrolling -->
</head>

<body>
<!-- header -->
	<div class="agileits_header">
		<div class="container">
			<div class="w3l_offers">
				<p>Delivery Time : 5pm to 7pm</p>
			</div>
			<div class="agile-login">
				<ul style="float:right">
					<li><a href="registered.php"> Create Account </a></li>
					<li><a href="login.php">Login</a></li>
					

				</ul>
			</div>
			<div class="product_list_header">

						<button class="w3view-cart" type="submit" name="submit" value=""><i class="fa fa-cart-arrow-down" aria-hidden="true"></i></button>
				
			</div>
			<div class="clearfix"> </div>
		</div>
	</div>

	<div class="logo_products">
		<div class="container">
		<div class="w3ls_logo_products_left1">
				<ul class="phone_email">
                    <li style="color:#25b81e;"><i class="fa fa-phone" aria-hidden="true"></i><a href="tel:7356291025" style="color:black">Order online : (+0123) 234 567</a></li>

				</ul>
			</div>
			<div class="w3ls_logo_products_left">
				<h1><a href="index.php"><img src="images/logo.png" style="width:100%;margin-top:-25px;margin-bottom:-16px;margin-left:-20px;" class="img-responsive"></a></h1>
			</div>
		<div class="w3l_search">
			<ul class="phone_email" style="list-style-type:none;margin-top:15px;">
                <li style="color:#25b81e;"><i class="fa fa-envelope" aria-hidden="true"></i>&nbsp;&nbsp;<a href="mailto:info@example.com" style="color:black">Mail to : support@fft.com</a></li>

				</ul>
		</div>

			<div class="clearfix"> </div>
		</div>
	</div>
<!-- //header -->
<!-- navigation -->
<div class="navigation-agileits" style="background:#25b81e;">
	<div class="container">
		<nav class="navbar navbar-default">
						<!-- Brand and toggle get grouped for better mobile display -->
						<div class="navbar-header nav_2">
							<button type="button" class="navbar-toggle collapsed navbar-toggle1" data-toggle="collapse" data-target="#bs-megadropdown-tabs">
								<span class="sr-only">Toggle navigation</span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
							</button>
						</div>
						<div class="collapse navbar-collapse" id="bs-megadropdown-tabs">
							<ul class="nav navbar-nav">
								<li class="active"><a href="index.php" class="act">Home</a></li>
								<!-- Mega Menu -->
								<li><a href="#">About Us</a></li>
								<li><a href="gourmet.html">How we works</a></li>
								<li><a href="offers.html">Be a Seller</a></li>
								<li><a href="offers.html">Our Proud Sellers</a></li>
								<li><a href="offers.html">Advertise Here</a></li>
								<li><a href="offers.html">Customer Service</a></li>
								<li><a href="contact.html">Contact</a></li>
							</ul>
						</div>
						</nav>
		</div>
	</div>

<!-- //navigation -->
<!-- breadcrumbs -->
	
<!-- //breadcrumbs -->
    
<?php 
if($stat==0)
{
?>        
<!-- register -->
	<div class="register">
		<div class="container">
			<h2>Register Here</h2>
			<div class="login-form-grids">
				<form method="post">
				<h5>profile information</h5>
				<form action="#" method="post">
					<input type="text" name="username" placeholder="Full Name" required >
					<input type="text" name="no" placeholder="Phone Number" minlength="10" maxlength="10" required >
                    <?php
						if(isset($_GET['n']))
						{
							$m=$_GET['n'];
							if ($m==1) {
								echo "<a style='color:red;'>Invalid Phone Number </a>";
							}
						}

						 ?>

				<h6>Login information</h6>


					<input type="password" name="pass1" placeholder="Create Password" minlength="4" maxlength="8" required=" " >
					<input type="password" name="pass2" placeholder="Re-enter Password" minlength="4" maxlength="8" required=" " >
                     <?php
						if(isset($_GET['p']))
						{
							$mx=$_GET['p'];
							if ($mx==1) {
								echo "<a style='color:red;'>Entered passwords are not matching</a>";
							}
						}

						 ?>
					<div class="register-check-box">
						<div class="check">
							<label class="checkbox"><input type="checkbox" name="checkbox" required><i> </i>I accept the terms and conditions</label>
						</div>
					</div>
					<input type="submit" value="Register" name="button_register">
				</form>
			</div>

		</div>
	</div>
<?php 
}
else
{ echo $otp_num;
?>
        
      <div class="register">
		<div class="container">
			
			<div class="login-form-grids">
				<h5 style="text-align:center;text-transform:capitalize;">We have send a six digit one time password (OTP) to your phone number</h5>
				<form action="#" method="post">
					<input type="text" name="otp" placeholder="Enter OTP" minlength="4" maxlength="4" required >  
                    <input type="submit" value="Confirm OTP" name="button_otp">
				</form>
            </div>   
          </div>
        </div>  
<?php        
    }
?>    
<!-- //register -->
<!-- //footer -->
<div class="footer">
		<div class="container">
			<div class="w3_footer_grids">
				<div class="col-md-3 w3_footer_grid">
					<h3>Contact</h3>

					<ul class="address">
						<li><i class="glyphicon glyphicon-map-marker" aria-hidden="true"></i>1234k Avenue, 4th block, <span>New York City.</span></li>
						<li><i class="glyphicon glyphicon-envelope" aria-hidden="true"></i><a href="mailto:info@example.com">info@example.com</a></li>
						<li><i class="glyphicon glyphicon-earphone" aria-hidden="true"></i>+1234 567 567</li>
					</ul>
				</div>
				<div class="col-md-3 w3_footer_grid">
					<h3>Information</h3>
					<ul class="info">
						<li><i class="fa fa-arrow-right" aria-hidden="true"></i><a href="about.html">About Us</a></li>
						<li><i class="fa fa-arrow-right" aria-hidden="true"></i><a href="contact.html">Contact Us</a></li>
						<li><i class="fa fa-arrow-right" aria-hidden="true"></i><a href="short-codes.html">Short Codes</a></li>
						<li><i class="fa fa-arrow-right" aria-hidden="true"></i><a href="faq.html">FAQ's</a></li>
						<li><i class="fa fa-arrow-right" aria-hidden="true"></i><a href="products.html">Special Products</a></li>
					</ul>
				</div>
				<div class="col-md-3 w3_footer_grid">
					<h3>Category</h3>
					<ul class="info">
						<li><i class="fa fa-arrow-right" aria-hidden="true"></i><a href="groceries.html">Groceries</a></li>
						<li><i class="fa fa-arrow-right" aria-hidden="true"></i><a href="household.html">Household</a></li>
						<li><i class="fa fa-arrow-right" aria-hidden="true"></i><a href="personalcare.html">Personal Care</a></li>
						<li><i class="fa fa-arrow-right" aria-hidden="true"></i><a href="packagedfoods.html">Packaged Foods</a></li>
						<li><i class="fa fa-arrow-right" aria-hidden="true"></i><a href="beverages.html">Beverages</a></li>
					</ul>
				</div>
				<div class="col-md-3 w3_footer_grid">
					<h3>Profile</h3>
					<ul class="info">
						<li><i class="fa fa-arrow-right" aria-hidden="true"></i><a href="products.html">Store</a></li>
						<li><i class="fa fa-arrow-right" aria-hidden="true"></i><a href="checkout.html">My Cart</a></li>
						<li><i class="fa fa-arrow-right" aria-hidden="true"></i><a href="login.html">Login</a></li>
						<li><i class="fa fa-arrow-right" aria-hidden="true"></i><a href="registered.html">Create Account</a></li>
					</ul>


				</div>
				<div class="clearfix"> </div>
			</div>
		</div>

		<div class="footer-copy">

			<div class="container">
				<p>© 2017 Super Market. All rights reserved | Design by <a href="http://w3layouts.com/">W3layouts</a></p>
			</div>
		</div>

	</div>
	<div class="footer-botm">
			<div class="container">
				<div class="w3layouts-foot">
					<ul>
						<li><a href="#" class="w3_agile_facebook"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
						<li><a href="#" class="agile_twitter"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
						<li><a href="#" class="w3_agile_dribble"><i class="fa fa-dribbble" aria-hidden="true"></i></a></li>
						<li><a href="#" class="w3_agile_vimeo"><i class="fa fa-vimeo" aria-hidden="true"></i></a></li>
					</ul>
				</div>
				<div class="payment-w3ls">
					<img src="images/card.png" alt=" " class="img-responsive">
				</div>
				<div class="clearfix"> </div>
			</div>
		</div>
<!-- //footer -->
<!-- Bootstrap Core JavaScript -->
<script src="js/bootstrap.min.js"></script>
<!-- top-header and slider -->
<!-- here stars scrolling icon -->
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
<!-- //here ends scrolling icon -->
<script src="js/minicart.min.js"></script>
<script>
	// Mini Cart
	paypal.minicart.render({
		action: '#'
	});

	if (~window.location.search.indexOf('reset=true')) {
		paypal.minicart.reset();
	}
</script>
<!-- main slider-banner -->
<script src="js/skdslider.min.js"></script>
<link href="css/skdslider.css" rel="stylesheet">
<script type="text/javascript">
		jQuery(document).ready(function(){
			jQuery('#demo1').skdslider({'delay':5000, 'animationSpeed': 2000,'showNextPrev':true,'showPlayButton':true,'autoSlide':true,'animationType':'fading'});

			jQuery('#responsive').change(function(){
			  $('#responsive_wrapper').width(jQuery(this).val());
			});

		});
</script>
<!-- //main slider-banner -->

</body>
</html>
