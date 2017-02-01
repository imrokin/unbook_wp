<?php
/**
 * The template for displaying all pages.
 *
 * @package scrollme
 */

get_header();
global $wpdb,$user_ID;
 $url=site_url();

 ?>

 <?php
$code_entered=($_POST['referal_code']);
//echo $code_entered;
$args = array(
	'role'         => 'student',
	'meta_key'     => 'referal_code',
	'meta_value'   => $code_entered,
 ); 
//get_users(  ); 
$blogusers = get_users( $args );
// Array of stdClass objects.
if(!empty($code_entered)){
foreach ( $blogusers as $bloguser ) {
	
	if ( $bloguser->ID==$current_user->ID ){
		$own_code=true;
	}
	elseif(!$current_user->referal_used){
		//get logged in users credits
		$credit_current_user=$current_user->referal_credits ;
		//get donor users credits
		$credit=$bloguser->referal_credits;
		//update loged in users credits
		update_user_meta( $current_user->ID, 'referal_credits',$credit_current_user+1 );
		//to diable input for furthure promo codes.
		update_user_meta( $current_user->ID, 'referal_used',1 );
		//updates doner users credits
		update_user_meta($bloguser->ID , 'referal_credits',$credit+1 );
		$credits_updated=true;
		
	}
}

}
?>		
 
	<div class="container clearfix">
		<div id="primary" class="content-area">
<center><h3>Referal Code</h3></center><hr>
			

				<?php get_template_part( 'template-parts/content', 'page' ); 
if (!$user_ID) {  
			echo "<center><h3><a href='".$url."/profile'>Login</a> First!</h3><center>";
			}
			else
			{
?>

			<form method="post" name="search-course" action="" class="learn-press-search-course-form">
		<?php  if($current_user->referal_used){ ?>	
	<input type="text" readonly required name="" class="search-course-input" value="" placeholder="Can be used only once. Disabled Now.">
	
	<?php	} else { ?>
	
	<input type="text" required name="referal_code" class="search-course-input" value="" placeholder="Referal Code...">
	<?php   }    ?>
	<center><button style="float:none;"class="search-course-button">Apply</button><center>
</form>

<center> Your Referal Code <center>
<h2>
<?php global $current_user;
      get_currentuserinfo();

	  echo  $current_user->referal_code . "\n";
	 

?>
 </h2>
 <center><p>Your Credits : <?php 
if(isset($current_user->referal_credits)){
echo $current_user->referal_credits . "\n";

}
else
{echo "0";}

	?></p><center>
 <center><p>Share with friends to unlock Free Lectures</p><center>
  <center><p style="color:red;"><?php	if(isset($own_code)){echo "you cant use your own Code!";}else
  if(isset($credits_updated)){echo "Credits Updated!";
  
  }

}//login check finish
?></p><center>
			
		</div><!-- #primary -->

		<?php get_sidebar('left'); ?>
		<?php get_sidebar('right'); ?>
	</div>

<?php get_footer();

