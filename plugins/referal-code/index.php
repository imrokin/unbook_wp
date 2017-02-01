<?php
/*
Plugin Name: Referal Code
Plugin URI: http://unbook.in
Description: for referal code system
Author: TB
Version: 1.0
Requires at least: 3.8
Tested up to: 4.7

Text Domain: unbook
Domain Path: /languages/
*/




add_action( 'user_register', 'referal_code_save', 10, 1 );

function referal_code_save( $user_id ) {


			$str = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';

			$shuffled = substr(str_shuffle($str), 0, 8);
			
			update_user_meta($user_id, 'referal_code', $shuffled);
			
			
}

//fucntion for promotional videos post type
add_filter('piklist_post_types', function($post_types)
  {
    $post_types['free_videos'] = array(
      'labels' => piklist('post_type_labels', 'Free Videos')
     // ,'title' => __('Enter a new Demo Title')
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