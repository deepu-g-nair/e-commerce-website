<!--
author: W3layouts
author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<?php
  include 'connection.php';
  require_once 'config.php';
  $total=0;
  $pin_status=0;
  $pin_val=0;
  session_start();
	$username=$_SESSION['x'];
	$sel=mysqli_query($con,"select * from cart where username='$username' && flag='0'");
    $check=mysqli_num_rows($sel);
    if($check>0)
    {
        $status=0;
    }
    else
    {
        $status=1;
    }
    
	if(isset($_POST['button_remove']))
	{
		$pcode=$_POST['hidden_pcode'];
		$rem=mysqli_query($con,"DELETE FROM `cart` WHERE `username`='$username' && `product_code`='$pcode' && flag='0' ");
		if($rem>0)
		{
			header("Location:#");
		}
        else
        {
            echo "no";
        }
	}
    if(isset($_POST['button_pincode']))
    {
        $pin_val=1;
        $pincode=$_POST['pincode'];
        
        $pin=mysqli_query($con,"SELECT `pincode` FROM `service_area` WHERE `pincode`='$pincode'");
        if(mysqli_num_rows($pin)>0)
        {
            $pin_status=1;
        }
        else
        {
            $pin_status=2;
        }
    }
    if(isset($_POST['button_order']))
    {
        $pincoden=$_POST['hidden_pincode'];
        $pcoden=$_POST['hidden_pro'];
        $up=mysqli_query($con,"UPDATE `cart` SET `pincode`='$pincoden' WHERE `username`='$username' && flag='0'");
        if($up>0)
        {
            header("Location:checkout.php");
        }
    }
?>
<!DOCTYPE html>
<html>
<head>
<title>Super Market an Ecommerce Online Shopping Category Flat Bootstrap Responsive Website Template | Single Page :: w3layouts</title>
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
<link href="css/mystyle.css" rel="stylesheet" type="text/css" media="all" />
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
					<li><a> <?php echo "<i class='fa fa-user' aria-hidden='true'></i>&nbsp;$username"; ?></a></li>
					<li><a href="logout.php"> <?php echo "<i class='fa fa-logout' aria-hidden='true'></i>&nbsp; Logout"; ?></a></li>
					

				</ul>
			</div>
			<div class="product_list_header">
					<a href="cart.php">	<button class="w3view-cart" type="submit" name="submit" value=""><i class="fa fa-cart-arrow-down" aria-hidden="true"></i></button></a>
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
				<h1><a href="#"><img src="images/logo.png" style="width:100%;margin-top:-25px;margin-bottom:-16px;margin-left:-20px;" class="img-responsive"></a></h1>
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
<?php 
if($status==1)
{
    ?>
<div class="container">
    <div class="row">
        <div class="col-lg-6">
            <h4 style="text-align:center;padding-top:150px;float:right;">Your shopping cart is empty. Add products to the cart</h4>
            <center><button class="btn" style="margin-top:20px;margin-left:70px;"><i class="fa fa-shopping-cart"></i>&nbsp;<b> Continue Shopping</b></button></center>
        </div>
        <div class="col-lg-6">
            <img src="images/cart.png" style="width:500px;"> 
        </div>
    </div>
</div>
       
        
       
    
    <?php
}
else
{
  ?>
    <div class="container-fluid" style="padding:60px;padding-left:80px;">
    
    <div class="row">
    <div class="col-sm-8" style="box-shadow: 5px 10px 18px grey;">
        <div class="row">
        <h4 style="padding-left:30px;padding-top:30px;">My Shopping Cart</h4>
        </div>
        <?php
				while ($row = mysqli_fetch_assoc($sel)){
                    $sid=$row['seller_code'];
                    $sname=mysqli_query($con,"select seller_name from seller_data where id='$sid'");
                    $ssn=mysqli_fetch_row($sname);
                    $pcode=$row['product_code'];
			?>
        <form method="post">
        <div class="row">
            <hr>
            <input type="hidden" id="ppid" class="pid" name="hidden_pcode" value="<?php echo $row['product_code']; ?>">
            <div class="col-sm-3" >
                <img src="images/<?php echo $row['image']; ?>" style="margin-bottom:60px;padding-left:10px;">
            </div>
            <div class="col-sm-4">
               <h3 style="padding-top:15px"><?php echo $row['name']; ?></h3>
                <p style="font-size:11px;padding-top:5px;"><span class="glyphicon glyphicon-user"></span>&nbsp;&nbsp;<b><?php echo $ssn[0]; ?></b></p>
                <p style="font-size:11px;padding-top:15px;"><span class="glyphicon glyphicon-tasks"></span>&nbsp;&nbsp;<b>In Stock</b></p>
                 <div style="margin-top:15px;">   
                    <p style="font-size:11px;"><b style="float:left;margin-right:10px;padding-top:5px;">Qty</b>
                        <?php $max=$row['max_quantity']; ?>
                        <input type="number"  value="<?php echo $row['entered_quantity']; ?>" min="1" max="<?php echo $row['max_quantity']; ?>" class="form-control itemQty" style="width:50px;">
                     </p>
                </div>
            </div>
            <div class="col-sm-5">
                <div>
                    <b style="color:green;float:right;padding-right:30px;padding-top:15px;font-size:1.3em;"><i class='fa fa-inr' aria-hidden='true'>
                    </i>
                    <?php echo $row['total_price']; ?></b>
                    <input type="hidden" class="pprice" value="<?php echo $row['price']; ?>">
                    <button name="button_remove" style="color:red;border:none;background:none;margin-top:100px;float:right;margin-right:-74px;"><b>Remove</b></button>
                </div>
                <?php $total=$total+$row['total_price']; ?>
            </div>
        </div> </form> 
        <?php } ?>
    </div>
    <div class="col-sm-4" style="">
        <form method="post">
            <div class="row" style="box-shadow: 5px 10px 18px grey;margin-left:12px;">
                <h4 style="padding-left:30px;padding-top:30px;">Price Listing</h4>
                
                
                <div class="row">
                    <hr>
                    <div class="col-sm-6">
                        <p style="padding-left:35px;"><b>Price (1 Item)</b></p><br>
                        <p style="padding-left:35px;"><b>Total</b></p>
                    </div>
                    <div class="col-sm-6"></div>
                        <p><b style="float:right;padding-right:50px;"><i class='fa fa-inr' aria-hidden='true'></i>&nbsp;<?php echo $total; ?></b></p><br><br>
                        <p><b style="float:right;padding-right:50px;"><i class='fa fa-inr' aria-hidden='true'></i>&nbsp;<?php echo $total; ?></b></p>
                </div><hr>
                <div class="row" style="display:flex;margin-top:15px;justify-content:center;">
                   <?php 
                        if($pin_val==1)
                        {
                            ?> <input type="text" name="pincode"  minlength="6" maxlength="6" class="form-control" value="<?php echo $pincode; ?>" style="width:180px;" required><?php
                        }
                        else{
                             ?><input type="text" name="pincode" minlength="6" maxlength="6" class="form-control" placeholder="Enter pincode" style="width:180px;" required><?php
                        }
                    ?>
                    &nbsp;&nbsp;
                    <input type="submit" name="button_pincode" class="btn btn-primary" style="height:35px;" value="check availability"><br><br>
                    
                </div>
                <?php
                    if($pin_status==1)
                    {
                        ?>
                           <div class="row" style="display:flex;margin-top:10px;margin-bottom:10px;justify-content:center;">
                                <i class='fa fa-check-square-o' aria-hidden='true' style="color:green"></i>&nbsp;&nbsp;
                                <b style="font-weight:light;font-size:12px;">This product is available in your region</b>
                            </div>
                        <?php
                    }
                    if($pin_status==2)
                    {
                            ?>
                           <div class="row" style="display:flex;margin-top:10px;margin-bottom:10px;justify-content:center;">
                                <i class='fa fa-times-circle-o' aria-hidden='true' style="color:red"></i>&nbsp;&nbsp;
                                <b style="font-weight:light;font-size:12px;">This product is not available in your region</b>
                            </div>
                        <?php
                    }
                ?>
                <?php
                    if($pin_status==1)
                    {
                        ?>
                            
                            <input type="hidden" name="hidden_pincode" value="<?php echo $pincode; ?>">
                            <input type="hidden" id="pcode" name="hidden_pro">
                            <div class="row" style="display:flex;justify-content:center;">
                                <input type="submit" name="button_order" class="btn btn-success" value="Order Now" style="width:78%;height:35px;">
                            </div>
                        <?php
                    }
                else
                {
                    ?><div class="row" style="display:flex;justify-content:center;">
                        <input type="submit" class="btn btn-success" value="Order Now" style="width:78%;height:35px;" disabled> 
                    </div><?php
                }
                ?>
                <br>
            </div></form>
    </div>    
    </div>
</div>
  <?php
}
?>
<!-- //breadcrumbs -->

<!-- new -->


    
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
    <script type="text/javascript">
        $(document).ready(function(){
            $(".itemQty").on('change',function(){
                    var ab='<?php echo $max ?>';
                    var value = $(this).val();
                    if ((value !== '') && (value.indexOf('.') === -1)) {
                        $(this).val(Math.max(Math.min(value, ab), -ab));
                    }
                
                var $el=$(this).closest('form');
                
                var pid=$el.find(".pid").val();
                var pprice=$el.find(".pprice").val();
                var qty=$el.find(".itemQty").val();
                location.reload(true);
                $.ajax({
                   url:'action.php',
                   method:'post',
                   cache:false,
                   data:{qty:qty,pid:pid,pprice:pprice},
                   success:function(response){
                       console.log(response);
                   }    
                });
            });
        });
    </script>
    <script>
        var x = document.getElementById("ppid").value;
        document.getElementById("pcode").value=x;
    </script>
</body>
</html>
