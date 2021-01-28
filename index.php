<!--
author: W3layouts
author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<?php
	include 'connection.php';
    require_once 'config.php';
	$status=0;
    $pop=0;
    $inf=1;
    
    $cod=urlencode(encryptor('encrypt',$inf));
	$products=mysqli_query($con,"select * from products where flag='0'");
	if( isset($_GET['q']) && !empty( $_GET['q'] ))
	{
		session_start();
        $username=$_SESSION['x'];
        $status=urldecode($_GET['q']);
        $status = encryptor('decrypt', $status);
                                               
		if(isset($_POST['button_cart']))
	  {
			$image1=$_POST['hidden_image'];
			$name1=$_POST['hidden_name'];
			$price1=$_POST['hidden_price'];
            $pcode1=$_POST['hidden_pcode'];
            $scode1=$_POST['hidden_scode'];
			$quantity1=$_POST['max_quantity'];
            $check=mysqli_query($con,"select * from cart where product_code='$pcode1'");
            if(mysqli_num_rows($check)>0)
            {
                $pop=2;
            }
            else
            {
               $sel1=mysqli_query($con,"INSERT INTO `cart`(`id`, `username`, `image`, `name`, `price`, `product_code`, `seller_code`, `max_quantity`, `entered_quantity`, `total_price`, `pincode`, `flag`) VALUES ('','$username','$image1','$name1','$price1','$pcode1','$scode1','$quantity1','1','$price1','0','0')");
                
                if($sel1>0)
                {
                    $pop=1;
                }
                else{
                    echo "no";
                } 
            }
			
		}
	$num=mysqli_query($con,"select * from cart where username='$username'");
    $num_val=mysqli_num_rows($num);
    }

?>
<!DOCTYPE html>
<html>
<head>
<title>Fresh Products Directly From Farmers - Fresh From TVM</title>
<!-- for-mobile-apps -->
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="description" content="">
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false);
		function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- //for-mobile-apps -->
<link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
<link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
<link rel = "icon" href = "images/logo.png" type = "image/x-icon"> 
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
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
<!-- start-smoth-scrolling -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.2/jquery.modal.css" integrity="sha256-I7TkE/ugn9CLcKj70NkHs+j2cTVR6PAFPoFvk5DMrXg=" crossorigin="anonymous" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.2/jquery.modal.js" integrity="sha256-Xn32xgoXnSJx7yF1Tc0WFkI8WbupFklylorHLBeu0CA=" crossorigin="anonymous"></script>
  <style>
    /* Dropdown Button */
.dropbtn {
  background: none;
  color: white;
  width: auto;
  border: none;
  cursor: pointer;
}

/* Dropdown button on hover & focus */
.dropbtn:hover, .dropbtn:focus {

}

/* The container <div> - needed to position the dropdown content */
.dropdown {
  position: relative;
  display: inline-block;
}

/* Dropdown Content (Hidden by Default) */
.dropdown-content {
  display: none;
  position: absolute;
  background-color: black;
  min-width: 170px;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  z-index: 1;
}

/* Links inside the dropdown */
.dropdown-content a {
  color: black;
  padding: 12px 16px;
  text-decoration: none;
  display: block;
}

/* Change color of dropdown links on hover */


/* Show the dropdown menu (use JS to add this class to the .dropdown-content container when the user clicks on the dropdown button) */
.show {display:block;}
    </style>  
</head>

<body>
    <?php
    if($pop==1)
    {
        ?><script> 
                  swal({
                        title: "Good job!",
                        text: "This product is added to your cart",
                        icon: "success",
                        button: "Ok",
                    });  
                  </script><?php
    }
    if($pop==2)
    {
        ?><script> 
                  swal({
                        
                        text: "This product is already added to your cart",
                        icon: "warning",
                        button: "Ok",
                    });  
                  </script><?php
    }
    ?>
<!-- header -->
	<div class="agileits_header">
		<div class="container">
			<div class="w3l_offers">
				<p><a style="color:white;">Delivery Time : 5pm to 7pm</a></p>
			</div>
			<div class="agile-login">
				<ul style="float:right;margin-right:-90px;">
					<li>
						<?php if($status==0)
							{
								?><a href="registered.php"> Create Account </a><?php
							}
							else {
								?>
                                <div class="dropdown">
                                  <button onclick="myFunction()" class="dropbtn">
                                      <?php echo "<i class='fa fa-user' aria-hidden='true'></i>&nbsp;$username"; ?>
                                      <i class='fa fa-angle-down' style="font-weight:bold;" aria-hidden='true'></i>
                                    </button>
                                  <div id="myDropdown" class="dropdown-content" style="margin-top:15px;margin-left:-45px;">
                                    <a href="tracker.php" style="color:white;float:left;">
                                        <i class='fa fa-map-marker' style="color:blue;font-size:17px;" aria-hidden='true'></i>&nbsp;&nbsp;&nbsp;Order Tracker
                                      </a>
                                    <a href="#" style="color:white;float:left;">
                                        <i class='fa fa-history' style="color:blue;font-size:17px;" aria-hidden='true'></i>&nbsp;&nbsp;&nbsp;
                                        Order History
                                      </a>
                                    <a href="#" style="color:white;float:left;">
                                        <i class='fa fa-key' style="color:blue;font-size:17px;" aria-hidden='true'></i>&nbsp;&nbsp;&nbsp;
                                        Reset Password
                                      </a>
                                    <a href="logout.php" style="color:white;float:left;">
                                        <i class='fa fa-sign-out' style="color:blue;font-size:17px;" aria-hidden='true'></i>&nbsp;&nbsp;&nbsp;
                                        Logout
                                      </a>  
                                  </div>
                                </div>
                        
                        <?php
							}
						 ?>

					</li>
					<li>
						<?php if($status==0)
							{
								?><a href="login.php"> Login </a><?php
							}
							else {
								?><a href="logout.php"> <?php echo "<i class='fa fa-logout' aria-hidden='true'></i>&nbsp; Logout"; ?></a><?php
							}
						 ?>
					</li>
					

				</ul>
			</div>
			<div class="product_list_header" style="float:right">
					<?php
						if($status==0)
						{
								?><button class="w3view-cart" type="submit" name="submit" onclick=all()><i class="fa fa-cart-arrow-down" aria-hidden="true"></i></button><?php
						}
						else {
								?><a href="cart.php"><button class="w3view-cart" type="submit" name="submit" ><i class="fa fa-cart-arrow-down" aria-hidden="true"></i></button><span style=" background-color: #6394F8;
                                                                        border-radius: 10px;
                                                                        color: white;
                                                                        display: inline-block;
                                                                        font-size: 12px;
                                                                        line-height: 1;
                                                                        padding: 1px 5px 3px;
                                                                        text-align: center;
                                                                        margin-left:-10px;
                                                                        margin-top:16px;
                                                                        vertical-align: middle;
                                                                        white-space: nowrap;"><?php echo $num_val; ?></span></a><?php
						}
					 ?>
					

			</div>
			<div class="clearfix"> </div>
		</div>
	</div>
	<div class="logo_products">
		<div class="container">
		<div class="w3ls_logo_products_left1">
				<ul class="phone_email" style="padding-top:7px;padding-left:15px;">
                    <li style="color:#25b81e;"><i class="fa fa-phone" aria-hidden="true"></i><a href="tel:7356291025" style="color:black">Order online : (+0123) 234 567</a></li>

				</ul>
			</div>
			<div class="w3ls_logo_products_left">
				<h1>
					<?php if($status==0)
						{
                    ?><center><a href="#"><img src="images/logo.png" style="width:100%;margin-top:-25px;margin-bottom:-16px;margin-left:-20px;" class="img-responsive"></a></center><?php
						}
						else {
							?><a href="#"><img src="images/logo.png" style="width:100%;margin-top:-25px;margin-bottom:-16px;margin-left:-20px;" class="img-responsive"></a><?php
						}
					 ?>
				</h1>
			</div>
		<div class="w3ls_logo_products_left1">
				<ul class="phone_email" style="padding-left:125px;padding-top:10px;">
                    <li style="color:#25b81e;"><i class="fa fa-envelope" aria-hidden="true"></i>&nbsp;&nbsp;<a href="mailto:support@fft.com" style="color:black">Mail to : support@fft.com</a></li>

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
									<li><a href="about.html">About Us</a></li>
									<li><a href="gourmet.html">How we works</a></li>
									<li>
                                        <?php 
                                        if($status==0)
                                        {
                                            ?><a href="seller.php">Be a Seller</a><?php
                                        }
                                        else
                                        {
                                           ?> <a href="seller.php<?php echo '?q='.$cod ?>">Be a Seller</a><?php
                                        }
                                        ?>
                                    </li>
									<li><a href="proudsellers.php">Our Proud Sellers</a></li>
									<li><a href="offers.html">Advertise Here</a></li>
									<li><a href="offers.html">Customer Service</a></li>
									<li><a href="contact.html">Contact</a></li>
								</ul>
							</div>
							</nav>
			</div>
		</div>

<!-- //navigation -->
	<!-- main-slider -->
		<ul id="demo1">
			<li>
				<img src="images/11.jpg" alt="" />
				<!--Slider Description example-->
				<div class="slide-desc">
					<h3>Buy Rice Products Are Now On Line With Us</h3>
				</div>
			</li>
			<li>
				<img src="images/22.jpg" alt="" />
				  <div class="slide-desc">
					<h3>Whole Spices Products Are Now On Line With Us</h3>
				</div>
			</li>

			<li>
				<img src="images/44.jpg" alt="" />
				<div class="slide-desc">
					<h3>Whole Spices Products Are Now On Line With Us</h3>
				</div>
			</li>
		</ul>

	<div class="newproducts-w3agile" style="background:white;">
		<div class="container">
			<h3>New Products</h3>

				<div class="agile_top_brands_grids">
					<?php
							while ($row = mysqli_fetch_assoc($products))
							{
					?>
					<div class="col-md-3 top_brand_left-1" style="margin-bottom:35px;">
						<div class="hover14 column">
							<div class="agile_top_brand_left_grid">
								
								<div class="agile_top_brand_left_grid1">
									<figure>
										<form method="post">
										<div class="snipcart-item block">
											<div class="snipcart-thumb">
                                                
                                                <input type="hidden" name="hidden_pcode" value="<?php echo $row['product_code']; ?>">
												<a><img alt=" " src="images/<?php echo $row['image']; ?>"></a>
												<input type="hidden" class="pimage" name="hidden_image" value="<?php echo $row['image']; ?>">
                                                <p style="font-size:1em"><B><?php echo $row['name']; ?></B></p>
													<input type="hidden" class="pname" name="hidden_name" value="<?php echo $row['name']; ?>">
												<div>
													
													<?php 
                                                        $selle_id= $row['seller_code'];
                                                        $selle=mysqli_query($con,"SELECT `seller_name` FROM `seller_data` WHERE `id`='$selle_id'");
                                                        $ss=mysqli_fetch_array($selle);
                                                        
                                                    ?>
                                                    
                                                    <p style="margin-left:5px;" >
                                                        <span class="glyphicon glyphicon-user"></span>&nbsp;
                                                        <?php echo $ss['0'] ; ?>
                                                        <input type="hidden" name="hidden_scode" class="pseller" value="<?php echo $row['seller_code']; ?>">
                                                    </p>
												</div>
												<input type="hidden" class="pquantity" name="max_quantity" value="<?php echo $row['max_quantity']; ?>">
                                                
													<h4 style="font-family:serif"><i class='fa fa-inr' aria-hidden='true'></i>&nbsp;<?php echo $row['price']; ?></h4>
														<input type="hidden" class="pprice" name="hidden_price" value="<?php echo $row['price']; ?>">
											</div>
											<div class="snipcart-details top_brand_home_details">

													<fieldset>
														<?php
														if($status==0)
														{
															?><input type="submit" value="Add to cart" style="background:#25b81e;" class="button"><?php
														}
														else {
                                                        ?><input type="submit" name="button_cart" value="Addd to cart" style="background:#25b81e;" class="button"><?php
														}
														 ?>
                                                        
													</fieldset>

											</div>
										</div></form>
									</figure>
								</div>
							</div>
						</div>
					</div>
					<?php
								}
							?>

						<div class="clearfix"> </div>
				</div>
		</div>
	</div>
<!-- //new -->
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
    
    <!-- AJAX -->
    
    <script>
    /* When the user clicks on the button,
toggle between hiding and showing the dropdown content */
function myFunction() {
  document.getElementById("myDropdown").classList.toggle("show");
}

// Close the dropdown menu if the user clicks outside of it
window.onclick = function(event) {
  if (!event.target.matches('.dropbtn')) {
    var dropdowns = document.getElementsByClassName("dropdown-content");
    var i;
    for (i = 0; i < dropdowns.length; i++) {
      var openDropdown = dropdowns[i];
      if (openDropdown.classList.contains('show')) {
        openDropdown.classList.remove('show');
      }
    }
  }
}
    </script>
</body>
</html>
