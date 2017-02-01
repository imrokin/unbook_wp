<?php

 global $wpdb;
get_header(); ?>


<div class="wrap"  >
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main" >
<hr><center><h2> Processing Payment</h2></center><hr>

<?php 

//login check
    if(!$user_ID) {  
			echo "<center><h3><a href='".esc_url( get_permalink( get_page_by_title( 'Profile' ) ))."'>Login</a> First!</h3><center>";
			}
			else
			{


// Change the Merchant key here as provided by Payumoney
$MERCHANT_KEY = "4HlaZIzU";

// Change the Merchant Salt as provided by Payumoney
$SALT = "rvBbTm4lT9";


	$firstname =$_POST['firstname'];
	$email =$_POST['email'];
	$phone =$_POST['phone'];
	$productinfo =$_POST['productinfo'];
	$service_provider =$_POST['service_provider'];
	$amount =$_POST['amount'];
	$txnid =$_POST['txnid'];
	$productinfo =$_POST['productinfo'];
	$surl =$_POST['surl'];
	$furl =$_POST['furl'];
	

	//$ =$_POST[''];

	$hashseq=$MERCHANT_KEY.'|'.$txnid.'|'.$amount.'|'.$productinfo.'|'.$firstname.'|'.$email.'|||||||||||'.$SALT;
	$hash =strtolower(hash("sha512", $hashseq)); 
	

?>	

<table>
<tr><td>Transaction Id</td><td><strong><?php echo $_POST['txnid']; ?></strong></td><td>Amount: </td><td><strong>Rs. <?php echo $_POST['amount']; ?></strong></td>
</table>
<div >
<br>

</div>		
<div>
	<form name="postForm" action="https://secure.payu.in/_payment" method="POST" >
		<input type="hidden" name="key" value="<?php echo $MERCHANT_KEY; ?>" />
		<input type="hidden" name="hash" value="<?php echo $hash;  ?>"/>
		<input type="hidden" name="txnid" value="<?php echo $_POST['txnid'];  ?>" />
		<input type="hidden" name="amount" value="<?php echo $_POST['amount'];  ?>" />
		<input type="hidden" name="firstname" value="<?php echo $_POST['firstname'];  ?>" />
		<input type="hidden" name="email" value="<?php echo $_POST['email'];  ?>" />
		<input type="hidden" name="phone" value="<?php echo $_POST['phone'];  ?>" />
		<input type="hidden" name="productinfo" value="<?php echo $_POST['productinfo'];  ?>" />
		<input type="hidden" name="service_provider" value="payu_paisa" size="64" />
		<input type="hidden" name="surl" value="<?php echo $_POST['surl'];  ?>" />
		<input type="hidden" name="furl" value="<?php echo $_POST['furl'];  ?>" />
		<input type="submit" name="" value="Pay  RS.<?php echo $_POST['amount'];  ?>" />
		
	</form>
</div>

<?php
}
?>




		</main><!-- #main -->
	</div><!-- #primary -->
</div><!-- .wrap -->

<?php get_footer();
