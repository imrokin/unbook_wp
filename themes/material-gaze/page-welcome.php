<?php
/**
 * The template for displaying all pages.
 *
 * @package scrollme
 */
 global $wpdb;
 $url=site_url();
 
 
 
 
 

get_header();



 ?>
<style>
.row{width:100%;}
.clm{width:50%; float:left; height:12vh; padding:2%; }

</style>



	<div class="container clearfix">
	<center><h4>Welcome</h4></center><hr>
<center><h4><?php echo $current_user->display_name ; ?></h4><center>
	 <div id="primary" class="content-area">
      <div class="row">
	  <div class="clm">
	 <span class="glyphicon glyphicon-user"></span>
	 <center><h4><a href="<?php echo esc_url( get_permalink( get_page_by_title( 'Profile' ) ) ); ?>">Profile</a></h4><center>
	  </div>
	  <div class="clm">
	   <span class="glyphicon glyphicon-th-large"></span>
	  <center><h4><a href="<?php echo esc_url( get_permalink( get_page_by_title( 'All Courses' ) ) ); ?>">All Courses</a></h4><center>
	  </div>
	  
	  </div>
	  <hr>
	  <div class="row">
	  <div class="clm">
	  <span class="glyphicon glyphicon-tasks"></span>
	 <center><h4><a href="<?php echo esc_url( get_permalink( get_page_by_title( 'My Courses' ) ) ); ?>">My Courses</a></h4><center>
	  </div>
	  <div class="clm">
	   <span class="glyphicon glyphicon-certificate"></span>
	  <center><h4><a href="<?php echo esc_url( get_permalink( get_page_by_title( 'Test Series' ) ) ); ?>">Test Series</a></h4><center>
	  </div>
	  
	  </div>
	  <hr>
	  <div class="row">
	  <div class="clm">
	  <span class="glyphicon glyphicon-list-alt"></span>
	 <center><h4><a href="<?php echo esc_url( get_permalink( get_page_by_title( 'Current Affairs' ) ) ); ?>">Current Affairs</a></h4><center>
	  </div>
	  <div class="clm">
	  <span class="glyphicon glyphicon-folder-open"></span>
	  <center><h4><a href="<?php echo esc_url( get_permalink( get_page_by_title( 'Free Lectures' ) ) ); ?>">Free Lectures</a></h4><center>
	  </div>
	  
	  </div>
	  <hr>
	  
	  <div class="row">
	  
	  <div class="clm">
	  <span class="glyphicon glyphicon-scale"></span>
	   <center><h4><a href="<?php echo esc_url( get_permalink( get_page_by_title( 'Student Statistics' ) ) ); ?>">Insight</a></h4><center>
	   
	  </div>
	  <div class="clm" style="">
	   <span class="glyphicon glyphicon-edit"></span>
	  <center><h4><a href="<?php echo esc_url( get_permalink( get_page_by_title( 'Notes' ) ) ); ?>">My Notes</a></h4><center>
	  </div>
	  
	  </div>
	  <hr>

	  <div class="row">
	  
	  <div class="clm">
	  <span class="glyphicon glyphicon-thumbs-up"></span>
	   <center><h4><a href="<?php echo esc_url( get_permalink( get_page_by_title( 'Promo Code' ) ) ); ?>">Referal Code</a></h4><center>
	   
	  </div>
	 
	  
	  </div>
	  <hr>
			
			
			
 
			

			
			
		
		
		</div> <!-- #primary -->

			<?php  get_sidebar('left'); ?>
		<?php get_sidebar('right'); ?>
	</div>

<?php get_footer();