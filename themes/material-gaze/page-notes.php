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
	<center><h3>My Notes</h3></center><hr>
		<div id="primary" class="content-area">

			<?php			
			if (!$user_ID) {  
			echo "<center><h3><a href='".$url."/profile'>Login</a> First!</h3><center>";
			}
			else
			{
			
			
			?>
<?php 


				
function wp_delete_post_link($link = 'Delete This', $before = '', $after = '')
{
global $post;
if ( $post->post_type == 'unbook_notes' ) {
if ( !current_user_can( 'edit_page', $post->ID ) )
return;
} else {
if ( !current_user_can( 'edit_post', $post->ID ) )
return;
}
$link = "<a href='" . wp_nonce_url( get_bloginfo('url') . "/wp-admin/post.php?action=delete&amp;post=" . $post->ID, 'delete-post_' . $post->ID) . "'>".$link."</a>";
echo $before . $link . $after;
}
				
		
			 
				$args = array(
							'post_type'=> 'unbook_notes',
							'author'    =>  $current_user->ID,
							'post_status' => 'publish',
							'posts_per_page'=> 100,
							'order'=>'ASC'
							
							);              

						$the_query = new WP_Query( $args );
						
						if ( $the_query->have_posts() ) {
	// The Loop
	$sn_count = 1;
	while ( $the_query->have_posts() ) {
		$the_query->the_post(); ?>
		
		<div class="post" style="text-align:left;"  ><span  class="glyphicon glyphicon-pushpin"></span>
		<?php
		echo '<h4>'.$sn_count.'.'. get_the_title() . '</h4>';
		echo '<p style="text-align:left;">'.get_the_content().'</p>' ;
		?>
		<?php if( current_user_can( 'delete_post' ) ) : ?>
        <?php $nonce = wp_create_nonce('my_delete_post_nonce') ?>
        <a href="<?php echo admin_url( 'admin-ajax.php?action=my_delete_post&id=' . get_the_ID() . '&nonce=' . $nonce ) ?>" data-id="<?php the_ID() ?>" data-nonce="<?php echo $nonce ?>" class="delete-post"><span class="glyphicon glyphicon-trash"></span></a>
    <?php endif ?>
		<?php echo '</div><hr>';
		$sn_count++;
wp_reset_postdata();
	}
	}
	

 }  //login check end
?> 
<script>
var ajax_url_delete = '<?php echo admin_url( 'admin-ajax.php' ); ?>';
jQuery( document ).ready( function($) {
    $(document).on( 'click', '.delete-post', function() {
        var id = $(this).data('id');
        var nonce = $(this).data('nonce');
        var post = $(this).parents('.post:first');
        $.ajax({
            type: 'post',
            url: ajax_url_delete,
            data: {
                action: 'my_delete_post',
                nonce: nonce,
                id: id
            },
            success: function( result ) {
                if( result == 'success' ) {
                    post.fadeOut( function(){
                        post.remove();
                    });
                }
            }
        })
        return false;
    })
})
</script>
		
		</div> <!-- #primary -->

	</div>

<?php get_footer();