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
	<center><h3>Current Affairs</h3></center><hr>
		<div id="primary" class="content-area">

			<?php 
			
			if (!$user_ID) {  
			echo "<center><h3><a href='".$url."/profile'>Login</a> First!</h3><center>";
			}
			else
			{
			
			
			?>
<?php 

					$args = array(
							'post_type'=> 'unbook_current',
							'post_status' => 'publish',
							'posts_per_page'=> 100,
							'order'=>'DEC'
							
							);              

						$the_query = new WP_Query( $args );
						
						if ( $the_query->have_posts() ) {
	// The Loop
	$sn_count = 1;
	while ( $the_query->have_posts() ) {
		$the_query->the_post();


		$current_month = get_the_date('F');

        if( $the_query->current_post === 0 ) { 

           the_date( 'F Y' );

        }else{ 

            $f = $the_query->current_post - 1;       
            $old_date =   mysql2date( 'F', $the_query->posts[$f]->post_date ); 

            if($current_month != $old_date) {

               echo '<h3>'.the_date( 'F Y' ).'</h3>';

            }

        }


		echo '<div style="text-align:left;"><span  class="glyphicon glyphicon-bullhorn"></span>';
		echo '<h4>'.$sn_count.'.'. get_the_title() . '</h4>';
		echo '<p style="text-align:left;">'.get_the_content().'</p></div>' ;
		
		echo '<hr>';



			$sn_count++;
wp_reset_postdata();
	}
	}
	



	?>
	
	
	
	
	
<?php 
 }  //login check end
?> 
		
			
		</div> <!-- #primary -->

	</div>

<?php get_footer();