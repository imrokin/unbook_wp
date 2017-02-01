<?php
/**
 * The template for displaying all single posts
 *
 
 */

get_header(); ?>


<?php 
   
   //login check
    if(!$user_ID) {  
			echo "<center><h3><a href='".esc_url( get_permalink( get_page_by_title( 'Profile' ) ))."'>Login</a> First!</h3><center>";
			}
			else
			{



if($_POST['submit']=='Enroll'){

update_post_meta($post->ID,$current_user->ID,'enrolled');
}

 ?>

<div class="wrap">
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<?php
				/* Start the Loop */
				while ( have_posts() ) : the_post(); ?>

					<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	
	<header class="entry-header">
		<?php
			

			if ( is_single() ) {
				the_title( '<h1 class="entry-title">', '</h1>' );
			} else {
				the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
			}
		?>
	</header><!-- .entry-header -->

	

	<div class="entry-content">

	


<?php
 
 the_content();  

$enrolled_status=get_post_meta($post->ID,$current_user->ID,true);
echo '<h4><span class="glyphicon glyphicon-thumbs-up">&nbsp;'.ucfirst($enrolled_status).'</span></h4>';

if(!$enrolled_status=='payed' || !$enrolled_status=='enrolled'){ 

$course_price =get_post_meta( get_the_ID(), 'course_price', true );
			echo 'Rs.'.$course_price.'  Only! <br><br>';
?>
	
		<?php

			if($course_price==0){
			echo     '<form method="post" action="" >';
			echo '<input type="hidden" name="post_id" value="'.$post->ID.'"/>';
			echo '<input type="submit" name="submit" class="btn btn-primary" value="Enroll" id="enrole_course"/> <hr>';	
			echo '</form>';
			
			}
			else
			{

				?>
		    <form name="postForm" action="<?php echo esc_url( get_permalink( get_page_by_title( 'payment' ) ) ); ?>" method="POST" >
			<input type="hidden" name="txnid" value="<?php echo $txnid=time().rand(1000,99999); ?>" />
			<input type="hidden" name="amount" value="<?php echo $course_price; ?>" />
			<input type="hidden" name="firstname" value="<?php echo $current_user->display_name; ?>" />
			<input type="hidden" name="email" value="<?php echo $current_user->user_email; ?>" />
			<input type="hidden" name="phone" value="<?php echo $current_user->mobile ?>" />
			<input type="hidden" name="productinfo" value="<?php echo the_title(); ?>" />
		    <input type="hidden" name="surl" value="<?php echo esc_url( get_permalink( get_page_by_title( 'payment success' ) ) ); ?>" size="64" />
		    <input type="hidden" name="furl" value="<?php echo esc_url( get_permalink( get_page_by_title( 'payment failure' ) ) ); ?>" size="64" />
			<input type="submit" name="submit"  class="btn btn-primary" value="Pay" id="enrole_course"/><hr>
			</form>


				<?php

				
			}


			}		
		?>

		
		
			<h3>Content's</h3><hr>

<?php
// get lessons assigned to course
$args = array( 'posts_per_page' => -1,
    'meta_key'         => 'course_assigned_to',
	'meta_value'       => $post->ID,
	'post_type'        => 'unbook_lesson',
	'post_status'      => 'publish',


 );
$lastposts = get_posts( $args );


foreach ( $lastposts as $post ) :
  setup_postdata( $post ); ?>
	
	<h4><span class="glyphicon glyphicon-book"></span>&nbsp;<a href="<?php  if($enrolled_status=='enrolled' || $enrolled_status=='payed'){ the_permalink(); } ?>"><?php the_title(); ?></a></h4>
	
<?php endforeach; 
wp_reset_postdata(); 

endwhile;

//end of login check
}
?>



	</div><!-- .entry-content -->

	

</article><!-- #post-## -->


		</main><!-- #main -->
	</div><!-- #primary -->
	<?php //get_sidebar(); ?>
</div><!-- .wrap -->

<?php 

get_footer();
