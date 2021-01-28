<!--
author: W3layouts
author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<?php
  include 'connection.php';
  require_once 'config.php';
  session_start();
	$username=$_SESSION['x'];
  $a=0;
  $n='n';
    $pc='pc';
  $q='q';
  $p='p';
  $pro='';
$pin='';
$re=0;
	$sel=mysqli_query($con,"select * from cart where username='$username' and flag='0'");
  if(isset($_POST['button_final']))
  {
    $name=$_POST['name'];
    $mnumber=$_POST['mnumber'];
    $address=$_POST['address'];
    $landmark=$_POST['landmark'];
    $pincode=$_POST['pincode'];
    while ($row5 = mysqli_fetch_assoc($sel))
    {
      $n=$_POST['n'.$row5['id']];
        
      $q=$_POST['q'.$row5['id']];
      $p=$_POST['p'.$row5['id']];
      $pro=$pro.$n.'('.$q.')'.'-'.$p.'/';
    }
    $total_price=$_POST['total_price'];
    date_default_timezone_set('Asia/Kolkata');
    $date=date("d-m-Y");
    $time=date("h:i:s");
    $ins=mysqli_query($con,"INSERT INTO `placed_orders`(`id`, `username`, `name`, `phone_number`, `address`, `landmark`, `pincode`, `product`, `total_price`, `date`, `time`) VALUES ('','$username','$name','$mnumber','$address','$landmark','$pincode','$pro','$total_price','$date','$time')");
    if($ins>0)
    {
       $sell=mysqli_query($con,"select * from cart where username='$username' and flag='0'");
        while ($row1 = mysqli_fetch_assoc($sell))
        {
            $pc=$_POST['pc'.$row1['id']];
            $qq=$_POST['q'.$row1['id']];
            $oq=mysqli_query($con,"SELECT `max_quantity` FROM `products` WHERE `product_code`='$pc'");
            mysqli_query($con,"UPDATE `products` SET `max_quantity`=`max_quantity`-$qq  WHERE `product_code`='$pc'");
             mysqli_query($con,"UPDATE `cart` SET `flag`='1' WHERE `username`='$username' && `product_code`='$pc'");
        }
      
      //$ifo=1;
      //$coe=urlencode(encryptor('encrypt',$ifo));
      //header("Location:checkout.php?t_order_success=.$coe'");
    }
  }
?>
<!DOCTYPE html>
<html>
<head>
<title></title>
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
<link href='https://fonts.googleapis.com/css?family=ABeeZee' rel='stylesheet'>
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
				<h1><a href="index.php?q=1"><img src="images/logo.png" style="width:100%;margin-top:-25px;margin-bottom:-16px;margin-left:-20px;" class="img-responsive"></a></h1>
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
<!-- checkout -->
<br><br>
<div class="container">
  <div class="alert alert-danger alert-dismissible" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <p style="font-family: 'ABeeZee';font-size:13px;">Currently we support only Cash On Delivery ( COD ) service</p>
  </div><br><br>
  <div class="row">
    <form method="post">
    <div class="col-md-6">
      <div class="panel panel-primary" style="width:75%;">
        <div class="panel-heading">
          <h3 class="panel-title" style="padding-left:10px">Order Summary</h3>
        </div>
        <div class="panel-body">
          <?php
    				while ($row = mysqli_fetch_assoc($sel)){
          ?>
          <div class="row">
            <div class="col-md-8" style="padding-left:25px">
              <h5 style="font-family: 'ABeeZee';margin-bottom:8px;margin-top:8px;">
                
              <?php echo $row['name'];?>
              <input type="hidden" name="<?php echo $n.$row['id'] ?>" value="<?php echo $row['name'];?>">
                  <input type="hidden" name="<?php echo $pc.$row['id'] ?>" value="<?php echo $row['product_code'];?>">

              (<?php echo $row['entered_quantity'] ?> Item)
              <input type="hidden" name="<?php echo $q.$row['id'] ?>" value="<?php echo $row['entered_quantity'];?>">

              </h5>
            </div>
            <div class="col-md-4">
              <h5 style="font-family: 'ABeeZee';margin-bottom:8px;margin-top:8px;"><i class="fa fa-inr" aria-hidden="true"></i>

                <?php echo $row['price'] * $row['entered_quantity'];?>
                <input type="hidden" name="<?php echo $p.$row['id'] ?>" value="<?php echo $row['price'] * $row['entered_quantity'];?>">
                  <?php $pin=$row['pincode']; ?>
              <?php  $a=$a+($row['price'] * $row['entered_quantity']);
                ?>
              </h5>
            </div>
          </div>
                
           <?php  } ?>
            <div class="row">
                <div class="col-md-8" style="padding-left:25px">
                    <h5 style="font-family: 'ABeeZee';margin-bottom:8px;margin-top:8px;">
                        Delivery Charge
                    </h5>      
                </div>
                <div class="col-md-4">
                    <h5 style="font-family: 'ABeeZee';margin-bottom:8px;margin-top:8px;"><i class="fa fa-inr" aria-hidden="true"></i>
                        <?php  
                       
                        $pinx=mysqli_query($con,"SELECT * FROM `service_area` WHERE `pincode`='$pin'");
                        $pin2=mysqli_fetch_assoc($pinx);
                        echo $pin2['delivery_charge'];
                        $a=$a+$pin2['delivery_charge'];
                        ?>
                    </h5>
                </div>
            </div>
            <div class="row">
                <div class="col-md-8" style="padding-left:25px">
                    <h5 style="font-family: 'ABeeZee';margin-bottom:8px;margin-top:8px;">
                        Service Charge
                    </h5>      
                </div>
                <div class="col-md-4">
                    <h5 style="font-family: 'ABeeZee';margin-bottom:8px;margin-top:8px;"><i class="fa fa-inr" aria-hidden="true"></i>
                       0
                    </h5>
                </div>
            </div>
        </div>
        <div class="panel-footer">
          <div class="row">
            <div class="col-md-8" style="padding-left:25px">
              <h5 style="font-family: 'ABeeZee'">
                Total
              </h5>
            </div>
            <div class="col-md-4">
              <h5 style="font-family: 'ABeeZee'"><i class="fa fa-inr" aria-hidden="true"></i> <?php echo $a; ?> </h5>
              <input type="hidden" name="total_price" value="<?php echo $a; ?>">
            </div>
          </div>

        </div>
      </div>
    </div>
    <div class="col-md-6">
      <div style="border:4px solid whitesmoke;padding:30px;">

                <h2 style="margin-bottom:25px">Fillup Your Details</h2>
                <input type="text" name="name" placeholder="Full Name" class="form-control" style="margin-bottom: 20px;" required>
                <input type="text" name="mnumber" placeholder="Phone Number" minlength="10" maxlength="10" class="form-control" style="margin-bottom: 20px;" required>
                <textarea name="address" placeholder="Delivery Address" rows="4" cols="80" class="form-control" style="margin-bottom: 20px;" required></textarea>
                <input type="text" name="landmark" placeholder="Nearest Landmark" class="form-control" style="margin-bottom: 20px;" required>
                <input type="text" value="<?php echo $pin; ?>" minlength="6" maxlength="6" class="form-control" style="margin-bottom: 20px;" disabled>
                 <input type="hidden" name="pincode" value="<?php echo $pin; ?>">
                <input type="submit" name="button_final" value="Checkout" class="btn btn-success" style="width:100px;background:#25b81e;" required>

      </div>

    </div></form>
  </div>
</div>
<br><br>


<!-- //checkout -->

<?php
if(isset($_GET['t_order_success']))
{
  $inf=1;
$cod=urlencode(encryptor('encrypt',$inf));
    $m=urldecode($_GET['t_order_success']);
    $sttus = encryptor('decrypt', $m);
  if ($sttus==1) {
    ?> <script>
        var codd='<?php echo $cod?>';
          swal({

                text: "Your order has been received successfully . We will reach you soon . Thanks for shopping ",
                icon: "success",
                successMode: true,
                
              })
          .then((willDelete) =>
          {
              if (willDelete)
              {
                location.replace("index.php?q="+codd);
              }
          });

    </script>
    <?php

  }
}

 ?>

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
