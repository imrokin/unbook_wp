<?php

@ini_set( 'upload_max_size' , '256M' );
@ini_set( 'post_max_size', '128M');
@ini_set( 'max_execution_time', '300' );

/**
 * This program is free software; you can redistribute it and/or modify it under the terms of the GNU
 * General Public License as published by the Free Software Foundation; either version 2 of the License,
 * or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without
 * even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *
 * You should have received a copy of the GNU General Public License along with this program; if not, write
 * to the Free Software Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA 02110-1301 USA
 */

/* Add the child theme setup function to the 'after_setup_theme' hook. */
add_action( 'after_setup_theme', 'material_gaze_theme_setup' );

/**
 * Setup function.  All child themes should run their setup within this function.  The idea is to add/remove
 * filters and actions after the parent theme has been set up.  This function provides you that opportunity.
 *
 * @since  1.0.0
 * @access public
 * @return void
 */

function material_gaze_theme_setup() {
	/* Add a custom background to overwrite the defaults. */
	add_theme_support(
		'custom-background',
		array(
			'default-color' => 'eeeeee',
			'default-image' => '',
		)
	);

	/* Add a custom header to overwrite the defaults. */
	add_theme_support(
		'custom-header',
		array(
			'default-text-color' => 'ffffff',
			'default-image'      => '%2$s/images/headers/blue.jpg',
			'random-default'     => false,
			'wp-head-callback'   => 'material_gaze_custom_header_wp_head',
		)
	);

	/* Register default headers. */
	register_default_headers(
		array(
			'blue' => array(
				'url'           => '%2$s/images/headers/blue.jpg',
				'thumbnail_url' => '%2$s/images/headers/blue-thumb.jpg',
				'description'   => __( 'default', 'material-gaze' )
			),
			'red' => array(
				'url'           => '%2$s/images/headers/red.jpg',
				'thumbnail_url' => '%2$s/images/headers/red-thumb.jpg',
				'description'   => __( 'red', 'material-gaze' )
			),
		)
	);

	/* Custom editor stylesheet. */
	add_editor_style( '//fonts.googleapis.com/css?family=Roboto:400,300,300italic,400italic,500,700|Roboto+Condensed:400,300,700' );
	/* Add a custom default color for the "primary" color option. */
	add_filter( 'theme_mod_color_primary', 'material_gaze_color_primary' );
	/* Load stylesheets. */
	add_action( 'wp_enqueue_scripts', 'material_gaze_enqueue_styles', 0 );
}

/**
 * Add a default custom color for the theme's "primary" color option.
 *
 * @since  1.0.0
 * @access public
 * @param  string  $hex
 * @return string
 */
function material_gaze_color_primary( $hex ) {
	return $hex ? $hex : '2196F3';
}

function material_gaze_enqueue_styles() {
	wp_enqueue_style( 'material-gaze-fonts', '//fonts.googleapis.com/css?family=Roboto:400,300,300italic,400italic,500,700|Roboto+Condensed:400,300,700' );
}

add_action( 'wp_head', 'material_gaze_wp_head' );
function material_gaze_wp_head() {
	$style = '';
	$hex = get_theme_mod( 'color_primary', '' );
	$style .= "#menu-primary .search-form .search-toggle, .display-header-text #header { background: #{$hex}; } ";
	$style .= "input[type='date']:focus, input[type='datetime']:focus, input[type='datetime-local']:focus, input[type='email']:focus, input[type='month']:focus, input[type='number']:focus, input[type='password']:focus, input[type='search']:focus, input[type='tel']:focus, input[type='text']:focus, input[type='time']:focus, input[type='url']:focus, input[type='week']:focus,
textarea:focus, select:focus { border-bottom-color: #{$hex}; box-shadow: 0 1px 0 0 #{$hex}; } ";
	echo "\n" . '<style type="text/css">' . trim( $style ) . '</style>' . "\n";
}

function material_gaze_custom_header_wp_head() {
	if ( !display_header_text() )
		return;
	$hex = get_header_textcolor();
	if ( empty( $hex ) )
		return;
	$style = "body.custom-header #branding, #site-title { color: #{$hex}; }";
	echo "\n" . '<style type="text/css" id="custom-header-css">' . trim( $style ) . '</style>' . "\n";
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function material_gaze_customize_preview_js() {
	wp_enqueue_script( 'material_gaze_customizer', trailingslashit( CHILD_THEME_URI ) .  'js/customizer.js', array( 'customize-preview' ), '20130508', true );
}

add_action( 'customize_preview_init', 'material_gaze_customize_preview_js' );



// my function for unboook



/*. my fucntionss */

//for saving answers from frontend

add_action('wp_head','my_ajaxurl_question');
function my_ajaxurl_question() {
$html = '<script type="text/javascript">';
$html .= 'var ajaxurl = "' . admin_url( 'admin-ajax.php' ) . '"';
$html .= '</script>';
echo $html;
}


add_action('wp_ajax_save_answer', 'save_answer_ajax');
function save_answer_ajax() {
    $post_id = $_POST['post_id'];
    $student_answer= $_POST['student_answer'];
    $current_user= $_POST['current_user'];

  echo $post_id;
  echo $student_answer;

    
    update_post_meta($post_id,$current_user,$student_answer);

   
}



//for ajax image upload subjetive answers
add_action('wp_ajax_cvf_upload_files', 'cvf_upload_files');
add_action('wp_ajax_nopriv_cvf_upload_files', 'cvf_upload_files'); // Allow front-end submission 

function cvf_upload_files(){
    

  /* img upload */

 $condition_img=7;
 $img_count = count(explode( ',',$_POST["image_gallery"] )); 

 if(!empty($_FILES["my_file_upload"])){

 require_once( ABSPATH . 'wp-admin/includes/image.php' );
 require_once( ABSPATH . 'wp-admin/includes/file.php' );
 require_once( ABSPATH . 'wp-admin/includes/media.php' );
  
   
 $files = $_FILES["my_file_upload"];  
 $attachment_ids=array();
 $attachment_idss='';

 if($img_count>=1){
 $imgcount=$img_count;
 }else{
 $imgcount=1;
 }
  

 $ul_con='';

 foreach ($files['name'] as $key => $value) {            
   if ($files['name'][$key]) { 
    $file = array( 
     'name' => $files['name'][$key],
     'type' => $files['type'][$key], 
     'tmp_name' => $files['tmp_name'][$key], 
     'error' => $files['error'][$key],
     'size' => $files['size'][$key]
    ); 
    $_FILES = array ("my_file_upload" => $file); 
    
    
    foreach ($_FILES as $file => $array) {              
      
      if($imgcount>=$condition_img){ break; } 

     require_once(ABSPATH . "wp-admin" . '/includes/image.php');
     require_once(ABSPATH . "wp-admin" . '/includes/file.php');
     require_once(ABSPATH . "wp-admin" . '/includes/media.php');
     
     //$newupload = my_handle_attachment($file,$pid); 

     $attach_id = media_handle_upload( $file, $post_id );
      $attachment_ids[] = $attach_id; 

      $image_link = wp_get_attachment_image_src( $attach_id, apply_filters( 'easy_image_gallery_linked_image_size', 'thumbnail' ) );
    $ul_con.='<div id="li_'.$attach_id.'"><img   src="'.$image_link[0].'"  class="thumb "><br>
           <a onclick="remove_img('.$attach_id.')" href="javascript:;" class="delete check">Remove</a> 
      </div>'; 
      
    }
    if($imgcount>$condition_img){ break; } 
    $imgcount++;
   } 
  }

  
 } 
/*img upload */

 $image_gallery=$_POST['image_gallery'];

$attachment_idss = array_filter( $attachment_ids  );
$attachment_idss =  implode( ',', $attachment_idss );  

 if($image_gallery){ $attachment_idss=$image_gallery.",".$attachment_idss;  }


$arr = array();
$arr['attachment_idss'] = $attachment_idss;
$arr['ul_con'] =$ul_con; 

echo json_encode( $arr );
 die();

}


//add student answer checking page in quiz

add_action('admin_menu' , 'brdesign_enable_pages'); 
 
function brdesign_enable_pages() {
    add_submenu_page('edit.php?post_type=unbook_lesson', 'Students Answers', 'Student answers', 'edit_posts', basename(__FILE__), 'unbook_answer_check');
}


//function to fetch student answers in subjective questions
function unbook_answer_check(){
	echo '<h4>Chose student to start Marking!</h4>';


echo '<form action="" method="POST" ><select name="student_id">';

$blogusers = get_users( array( 'role' => 'student' ) );
// Array of WP_User objects.
foreach ( $blogusers as $user ) {
	echo '<option value="'.$user->ID.'">' . esc_html( $user->nickname ) . '</option>';
}
echo '</select><input type="submit" value="Get Answers"/></form>';


if($_POST['markes_awarded']){  
$markes_awarded=$_POST['markes_awarded'];
$question_id=$_POST['question_id'];
$student_id=$_POST['student_id'];
	update_user_meta($student_id,$question_id,$markes_awarded);
   }



if($_POST){

$student_id=$_POST['student_id'];

$args = array( 'posts_per_page' => -1,
    'meta_key'         => $student_id,
	'post_type'        => 'unbook_question',
	'post_status'      => 'publish',


 );


$student_answer = get_posts( $args );

foreach ($student_answer as $answer) {
	
	if($answer->question_type == 'subjective'){ 
	  echo '<h3>'.$answer->post_title.'&nbsp; | Marks Assigned  '.$answer->question_mark.'</h3><hr>' ;
	  echo '<p>'.$answer->$student_id.'</p><br>' ;


//marks awarding input b0x starts here
             
echo 'Marks Awarded <form action="" method="post">
<input type="text" name="markes_awarded" value="'.get_user_meta($student_id,$answer->ID,true).'"/>
<input type="hidden" name="question_id" value="'.$answer->ID.'"/>
<input type="hidden" name="student_id" value="'.$student_id.'"/>
<input type="submit" value="Save Marks"/>
</form>';

             }

}



	
		



	

}






}


