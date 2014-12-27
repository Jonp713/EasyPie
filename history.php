<!doctype html>
<html>
<head>
	<link href="css/bootstrap.css" rel="stylesheet">
	<title>History</title>
	<link rel="shortcut icon" type="image/png" href="images/logonotext.png"/>
	<style>
	#section-1 img{
		
		position:absolute;
		right:-170px;
		z-index:0;

	}
	
	#section-1 {
		background-color:#0a0a0a;
		color:white;
		overflow:hidden;
		
	}
	@font-face {
	    font-family: tumblr;
	    src: url(fonts/BOOKOSB.ttf);
	}
	.tumblr{
	    font-family: tumblr;
		
		
	}
	.bigger{
		font-size:40px;
		font-weight:100;
		z-index:1;
	}
	.no-padding{
		padding:0px !important;
	}
	
	#section-2{
		
		z-index:3;
		background-color:#272727;
	}
	</style>
</head>

<?php
require("Stripe/lib/Stripe.php");

if(isset($_POST['stripeToken'])){

	// Set your secret key: remember to change this to your live secret key in production
	// See your keys here https://dashboard.stripe.com/account
	Stripe::setApiKey("sk_test_HIENUmCUQ449zYLTtgEm2XMG");

	// Get the credit card details submitted by the form
	$token = $_POST['stripeToken'];

	// Create the charge on Stripe's servers - this will charge the user's card
	try {
	$charge = Stripe_Charge::create(array(
	  "amount" => $_POST['stripeToken'], // amount in cents, again
	  "currency" => "usd",
	  "card" => $token,
	  "description" => "payinguser@example.com")
	);
	} catch(Stripe_CardError $e) {
	  // The card has been declined
	}

}

?>

<div id = "section-1">
	<span class = "col-xs-6 no-padding bigger">We started much <font class = "tumblr"><strong>humblr</strong></font></span>
	<img class = "heightme" src = "images/bg1.png">
	
	
</div>
<div id = "section-2">
	
	<form action="" method="POST">
	  <script
	    src="https://checkout.stripe.com/checkout.js" class="stripe-button"
	    data-key="pk_test_ziHLzZNgCcBT4XS1BapeHZIa"
	    data-amount="2000"
	    data-name="ICU"
	    data-description="1 Sandwich ($20.00)"
	    data-image="images/logonotext.png">
	  </script>
	</form>
</div>
<div id = "section-3">
</div>
<div id = "section-4">
</div>
<div id = "section-5">
</div>

    <script src = 'js/jquery.js' type = 'text/javascript'></script>
    <script src = "js/bootstrap.js" type = 'text/javascript'></script>

<script>


var height = $(window).height();
var width = $(window).width();

$('#section-1').height(height);
$('.heightme').height(height);


$('#section-2').css("top", height);
$('#section-3').css("top", height * 2);
$('#section-4').css("top", height * 3);
$('#section-5').css("top", height * 4);

$('#section-2').height(height);
$('#section-3').height(height);
$('#section-4').height(height);

$('#section-5').height(height);


</script>


</html>
