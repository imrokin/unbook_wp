<?php
/**
 * The template for displaying all pages.
 *
 * @package scrollme
 */
 global $wpdb,$user_ID;
 $url=site_url();

get_header(); ?>

	<div class="container clearfix">
		<div id="primary" class="content-area">
		<center><h3>Free Lectures</h3></center><hr>

			<?php get_template_part( 'template-parts/content', 'page' );
			
			
			if (!$user_ID) {  
			echo "<center><h3><a href='".$url."/profile'>Login</a> First!</h3><center>";
			}
			else
			{
			 $video_numbers=$current_user->referal_credits;
			 if($video_numbers>0){
				$args = array(
							'post_type'=> 'free_videos',
							'post_status' => 'publish',
							'posts_per_page'=> $video_numbers,
							'order'=>'ASC'
							);              

						$the_query = new WP_Query( $args );
						
						if ( $the_query->have_posts() ) {
	// The Loop
	while ( $the_query->have_posts() ) {
		$the_query->the_post();
		echo '<span>' . get_the_title() . '</span>';
		echo do_shortcode(get_the_content());
wp_reset_postdata();
	}
	}
			 }
			 else{
				 echo "<center><h3>Share your <a href='".$url."/promo-code'>Referal Code</a> with your friends to unlock Videos</h3><center>";
			 }
	

	
				
			}						
		?>

			
			
		</div><!-- #primary -->

		<?php get_sidebar('left'); ?>
		<?php get_sidebar('right'); ?>
	</div>

<?php get_footer();