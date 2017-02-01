<?php

 global $wpdb;
get_header(); ?>

<div class="wrap">
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
<hr><center><h2> Payment Succesfull</h2></center><hr>
			
<?php 
		//login check
    if(!$user_ID) {  
			echo "<center><h3><a href='".esc_url( get_permalink( get_page_by_title( 'Profile' ) ))."'>Login</a> First!</h3><center>";
			}
			else
			{




			if(isset($_POST['status'])){
				if($_POST['status']=="success"){
					echo "<center><h4>Payment Done Successfully.<br>Details Are Below.</h4><center>";
					echo "<center><p>Txn Id: ".$_POST['txnid']."</p><center>";
					echo "<center><p>Name: ".$_POST['firstname']."</p><center>";
					echo "<center><p>Email: ".$_POST['email']."</p><center>";
					echo "<center><p>Amount: ".$_POST['amount']."</p><center>";
					echo "<center><p>Phone No: ".$_POST['phone']."</p><center>";
					echo "<center><p>Product Info: ".$_POST['productinfo']."</p><center>";
					echo "<center><p>encryptedPaymentId: ".$_POST['encryptedPaymentId']."</p><center>";
				
					$posttitle = $_POST['productinfo'];
					$postid = $wpdb->get_var( "SELECT ID FROM $wpdb->posts WHERE post_title = '" . $posttitle . "'" );
					update_post_meta($postid,$current_user->ID,'enrolled');
				}
			}
// update_post_meta($post->ID,$current_user->ID,'enrolled');
echo "<center><h3><a href='".esc_url( get_permalink( get_page_by_title( 'Welcome' ) ))."'>Back</a> to Home!</h3><center>";

		}

			?>





		</main><!-- #main -->
	</div><!-- #primary -->
</div><!-- .wrap -->

<?php get_footer();
