<?php

 global $wpdb;
get_header(); ?>

<div class="wrap">
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
<hr><center><h2>Payment Failed!</h2></center><hr>
			

<?php 
			//login check
    if(!$user_ID) {  
			echo "<center><h3><a href='".esc_url( get_permalink( get_page_by_title( 'Profile' ) ))."'>Login</a> First!</h3><center>";
			}
			else
			{



			if(isset($_POST['status'])){
				if($_POST['status']=="failure"){
					echo "<center><h3>Payment Failed.<br>Details Are Below.</h3><center>";
					echo "<center><p>Failure Reason: ".$_POST['unmappedstatus']."</p><center>";
					echo "<center><p>Txn Id: ".$_POST['txnid']."</p><center>";
					echo "<center><p>Name: ".$_POST['firstname']."</p><center>";
					echo "<center><p>Email: ".$_POST['email']."</p><center>";
					echo "<center><p>Amount: ".$_POST['amount']."</p><center>";
					echo "<center><p>Phone No: ".$_POST['phone']."</p><center>";
					echo "<center><p>Product Info: ".$_POST['productinfo']."</p><center>";
				}
			}

echo "<center><h3><a href='".esc_url( get_permalink( get_page_by_title( 'Welcome' ) ))."'>Back</a> to Home!</h3><center>";
}
			?>





		</main><!-- #main -->
	</div><!-- #primary -->
</div><!-- .wrap -->

<?php get_footer();
