<?php
/**
 * The template for displaying all pages.
 *
 * @package scrollme
 */
 global $wpdb;
 $url=site_url();
 
 
 
 
 

get_header(); ?>

	<div class="container clearfix">
	<center><h3>Test Series</h3></center><hr>
		<div class="wrap">
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">


			<?php			
			if (!$user_ID) {  
			echo "<center><h3><a href='".$url."/profile'>Login</a> First!</h3><center>";
			}
			else
			{
			
			
			?>
<?php 

				$args = array(
							'post_type'=> 'unbook_course',
							'post_status' => 'publish',
							'tax_query' => array(
											array(
												'taxonomy' => 'category',
												'field' => 'slug',
												'terms' => 'test-series'
											)),
							'posts_per_page'=> 100,
							'order'=>'ASC'
							
							);              

						$the_query = new WP_Query( $args );
						
						if ( $the_query->have_posts() ) {
							
							?>
							<style>
							.post img{width:100%; min-height:120px; max-height:120px;}
							.post{width:48%; padding:1%; float:left; box-shadow: grey 1px 1px 10px; margin:1%;}						</style>
							<?php
	// The Loop
	
	while ( $the_query->have_posts() ) {
		$the_query->the_post(); ?>
		
		<div class="post" style="text-align:left;"  >
		<?php if ( has_post_thumbnail() ) : ?>
	    <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
		<?php the_post_thumbnail(); ?>
	    </a>
        <?php endif; ?>
		<?php
		echo '<center><h4><a style="text-align:left;" href="'.get_permalink( get_the_ID(),$leavename = false ).'">'.get_the_title().'</a></h4><center>' ;
		?>
		
		<?php echo '</div>';
		$sn_count++;
wp_reset_postdata();
	}
	}
	

 }  //login check end
?> 
    </main>
    </div>
	
		</div> <!-- #primary -->

	</div>

<?php get_footer();