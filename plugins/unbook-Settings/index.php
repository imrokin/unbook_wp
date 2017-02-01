<?php
/*
Plugin Name: UnBook-Settings
Plugin URI: http://unbook.in
Description: Unbook for Wp
Author: TB
Version: 2.0.9.1
Requires at least: 3.8
Tested up to: 4.7

Text Domain: unbook
Domain Path: /languages/
*/

/*  */
function remove_menus(){
  
  remove_menu_page( 'index.php' );                  //Dashboard
  remove_menu_page( 'jetpack' );                    //Jetpack* 
 remove_menu_page( 'edit.php' );                   //Posts
  remove_menu_page( 'upload.php' );                 //Media
 remove_menu_page( 'edit.php?post_type=page' );    //Pages
  remove_menu_page( 'edit-comments.php' );          //Comments
 remove_menu_page( 'themes.php' );                 //Appearance
 remove_menu_page( 'plugins.php' );                //Plugins
  //remove_menu_page( 'users.php' );                  //Users
 remove_menu_page( 'tools.php' );                  //Tools
remove_menu_page( 'options-general.php' );        //Settings
  
}
add_action( 'admin_menu', 'remove_menus' );

//add course custom post type

add_filter('piklist_post_types', function($post_types)
  {
    $post_types['unbook_course'] = array(
      'labels' => piklist('post_type_labels', 'Course / Test Series')
      ,'title' => __('name of course')
  
      
      ,'public' => true
      ,'admin_body_class' => array(
        'custom-body-class'
      )
      ,'has_archive' => true
      ,'supports' => array(
        'title'
        ,'editor'
      )
      
      ,'capability_type' => 'post'
      ,'edit_columns' => array(
        'title' => __('Course')
        ,'author' => __('Created By')
      )
      ,'hide_meta_box' => array(
        'slug'
        ,'author'
      )
      
    );
    return $post_types;
  });
  


//add lesson custom post type

add_filter('piklist_post_types', function($post_types)
  {
    $post_types['unbook_lesson'] = array(
      'labels' => piklist('post_type_labels', 'Lesson / Quiz')
      ,'title' => __('Name of Lesson')
  
      
      ,'public' => true
      ,'admin_body_class' => array(
        'custom-body-class'
      )
      ,'has_archive' => true
      ,'supports' => array(
        'title'
        ,'editor'
      )
      
      ,'capability_type' => 'post'
      ,'edit_columns' => array(
        'title' => __('Lesson')
        ,'author' => __('Created By')
      )
      ,'hide_meta_box' => array(
        'slug'
        ,'author'
      )
      
    );
    return $post_types;
  });


  /*//add quiz custom post type

add_filter('piklist_post_types', function($post_types)
  {
    $post_types['unbook_Quiz'] = array(
      'labels' => piklist('post_type_labels', 'Quizes')
      ,'title' => __('Name of Quiz')
  
      
      ,'public' => true
      ,'admin_body_class' => array(
        'custom-body-class'
      )
      ,'has_archive' => true
      ,'supports' => array(
        'title'
        ,'editor'
      )
      
      ,'capability_type' => 'post'
      ,'edit_columns' => array(
        'title' => __('Question')
        ,'author' => __('Created By')
      )
      ,'hide_meta_box' => array(
        'slug'
        ,'author'
      )
      
    );
    return $post_types;
  });
  */

  //add question custom post type

add_filter('piklist_post_types', function($post_types)
  {
    $post_types['unbook_question'] = array(
      'labels' => piklist('post_type_labels', 'Questions')
      ,'title' => __('Question')
  
      
      ,'public' => true
      ,'admin_body_class' => array(
        'custom-body-class'
      )
      ,'has_archive' => true
      ,'supports' => array(
        'title'
        
      )
      
      ,'capability_type' => 'post'
      ,'edit_columns' => array(
        'title' => __('Question')
        ,'author' => __('Created By')
      )
      ,'hide_meta_box' => array(
        'slug'
        ,'author'
      )
      
    );
    return $post_types;
  });

//add wp default categories to unbook_question CPT

add_action( 'init', 'sk_add_category_taxonomy_to_events' );
function sk_add_category_taxonomy_to_events() {
  register_taxonomy_for_object_type( 'category', 'unbook_question' );
  register_taxonomy_for_object_type( 'category', 'unbook_course' );
}
  

add_action('wp_head','my_ajaxurl');
function my_ajaxurl() {
$html = '<script type="text/javascript">';
$html .= 'var ajaxurl = "' . admin_url( 'admin-ajax.php' ) . '"';
$html .= '</script>';
echo $html;
}



//current affairs custom post type

add_filter('piklist_post_types', function($post_types)
  {
    $post_types['unbook_current'] = array(
      'labels' => piklist('post_type_labels', 'Current Affairs')
     
      ,'menu_icon' => piklist('url', 'piklist') . '/parts/img/piklist-menu-icon.svg'
      ,'page_icon' => piklist('url', 'piklist') . '/parts/img/piklist-page-icon-32.png'
      
      ,'public' => true
      ,'admin_body_class' => array(
        'custom-body-class'
      )
      ,'has_archive' => true
      ,'supports' => array(
        'title'
        ,'editor'
      )
      
      ,'capability_type' => 'post'
      ,'edit_columns' => array(
        'title' => __('Demo')
        ,'author' => __('Assigned to')
      )
      ,'hide_meta_box' => array(
        'slug'
        ,'author'
      )
      
    );
    return $post_types;
  });



//User Notes custom post type

add_filter('piklist_post_types', function($post_types)
  {
    $post_types['unbook_notes'] = array(
      'labels' => piklist('post_type_labels', 'Notes')
     
      ,'menu_icon' => piklist('url', 'piklist') . '/parts/img/piklist-menu-icon.svg'
      ,'page_icon' => piklist('url', 'piklist') . '/parts/img/piklist-page-icon-32.png'
      
      ,'public' => false
      ,'admin_body_class' => array(
        'custom-body-class'
      )
      ,'has_archive' => true
      ,'supports' => array(
        'title'
        ,'editor'
      )
      
      ,'capability_type' => 'post'
      ,'edit_columns' => array(
        'title' => __('Demo')
        ,'author' => __('Assigned to')
      )
      ,'hide_meta_box' => array(
        'slug'
        ,'author'
      )
      
    );
    return $post_types;
  });
  
  
  
  
  function apf_enqueuescripts()
{
   
    wp_localize_script( 'apf', 'apfajax', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ) ) );
}
add_action('wp_enqueue_scripts', apf_enqueuescripts);
  
  
  //unbook notes ajax function
  function apf_addpost() {
    $results = '';
 
    $title = $_POST['apftitle'];
    $content =  $_POST['apfcontents'];
 
    $post_id = wp_insert_post( array(
        'post_title'        => $title,
        'post_content'      => $content,
    'post_type'     => 'unbook_notes', 
        'post_status'       => 'publish',
        'post_author'       => $current_user->ID,
    ) );
 
    if ( $post_id != 0 )
    {
        $results = '*Note Saved';
    }
    else {
        $results = '*Error occurred while adding the post';
    }
    // Return the String
    die($results);
}

add_action( 'wp_ajax_nopriv_apf_addpost', 'apf_addpost' );
add_action( 'wp_ajax_apf_addpost', 'apf_addpost' );



add_action( 'wp_ajax_my_delete_post', 'my_delete_post' );
function my_delete_post(){
 
    $permission = check_ajax_referer( 'my_delete_post_nonce', 'nonce', false );
    if( $permission == false ) {
        echo 'error';
    }
    else {
        wp_delete_post( $_REQUEST['id'] );
        echo 'success';
    }
 
    die();
 
}



  
  