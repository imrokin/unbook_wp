<?php
/*
Plugin Name: OTP
Plugin URI: http://unbook.in
Description: OTP
Author: TB
Version: 2.0.9.1
Requires at least: 3.8
Tested up to: 4.7

Text Domain: unbook
Domain Path: /languages/
*/

define('__ROOT__', dirname(dirname(__FILE__))); 
require_once(__ROOT__.'/otp/registration-form.php'); 

//otp custom post type

add_filter('piklist_post_types', function($post_types)
  {
    $post_types['unbook_otp'] = array(
      'labels' => piklist('post_type_labels', 'OTP')
     
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
      ,'status' => array(
      	'publish' => array(
          'label' => 'Fresh'
          ,'public' => true
        ),
        'expired_sys' => array(
          'label' => 'Expired: By system'
          ,'public' => true
        )
       
      )
    );
    return $post_types;
  });
  
  
  add_action('init',function(){
$msg = 'UnBook.in
OTP for registration is: TEST (Valid for 2 hours only).';

//notify_sms('9910544620',$msg);
});


if(! function_exists('notify_sms')){
    
    function notify_sms($mobile=0,$msg='') {
    
    if( is_valid_mobile($mobile) AND '' != $msg ){ // phone number is valid and message also exists
             
        //uname=20120003&pass=123456&send=PROMO&dest=9835613280&msg=hi&priority=1&schtm=2013-04-14 11:22
        $data = array(
                'uname'=>'20170072',
                'pass' => 'HyoTf(+',
		'send' => 'UnBook',
                'msg' => $msg,
                'priority'=>1,
                'dest' => $mobile,
                
            );
        
        $url  = 'http://103.247.98.91/API/SendMsg.aspx?' . http_build_query($data);
        
        file_get_contents($url);
    }
	
	}
}
		function is_valid_mobile($mobile=0){
		return preg_match('/^\d{10}$/',$mobile);
		}

		
//this function is used basically for generating OTP  and OTP for password resetting.
function generate_and_send_otp($mobile,$digits = 6, $check_mobile = false){
//Default 3 length otp pin will be sent to the user.

if( $check_mobile AND !username_exists($mobile) ){
console_log('error occured...user does not exists');
return;
}

if( empty($mobile) OR !is_valid_mobile($mobile) ){
console_log('error occured...mobile number not valid');
return;
} 


$otp_pin = rand(pow(10, $digits-1), pow(10, $digits)-1);

$existing_id = get_saved_otp($mobile);

$new_otp_id = $existing_id ? $existing_id : wp_insert_post( array('post_type' => 'unbook_otp','post_status'=>'publish') );

if ( ! add_post_meta($new_otp_id,'mobile',$mobile,true) ) { 

   update_post_meta( $new_otp_id,'mobile',$mobile );

}

if ( ! add_post_meta($new_otp_id,'otp_pin',$otp_pin,true) ) { 

   update_post_meta( $new_otp_id , 'otp_pin' , $otp_pin );

}


// Update the post into the database
  
 if($new_otp_id){

$message_text = 'UnBook.in OTP for password reset is: '.$otp_pin.' (Valid for 2 hours only).';

if(! $check_mobile ){
    $message_text = 'UnBook.in OTP for registration is: '.$otp_pin.' (Valid for 2 hours only).';

}

notify_sms($mobile,$message_text); 

}

return true;
}

//geting saved otp from DB
function get_saved_otp($mobile){
$otp_id='';
$args = array( 
	'posts_per_page' => 1,
 	'post_type' =>'unbook_otp'
 	
      ,'meta_query' => array(
 		array('key'=>'mobile','value' => $mobile )
 		//array('key'=>'otp_pin','value' => $otp_pin )
 		
 	
 	)
      ,'date_query' => array(
     array(
           'after' => '2 hours ago'
           )));
           
$otp_list =  get_posts( $args );

if(empty($otp_list)){
return false;
}
	foreach($otp_list as $o){
		$otp_id = (int) $o->ID;
	}
	
return $otp_id;
}



function verifiy_otp_registration($mobile,$otp_pin){
//$user_id=false;
$args = array( 
	'posts_per_page' => 1,
 	'post_type' =>'unbook_otp'
 	,'meta_query' => array(
      
      
 		array('key'=>'mobile','value' => $mobile ),
 		array('key'=>'otp_pin','value' => $otp_pin )
 		
 	
 	)
      ,'date_query' => array(
     		array(
           'after' => '2 hours ago'
           )));
           
$list = get_posts( $args );
//wp_die(var_dump($list));

 if(empty($list)){
 return false;
 }

 return true;

};


//for sedin otp ajax 
function my_ajax_function(){

/*
$msg = 'YouLorry.com
OTP for registration is: TARUNB (Valid for 2 hours only).';

notify_sms($_REQUEST['mobile'],$msg); 
echo 'sent'; 
	die();
return; */


	generate_and_send_otp( $_REQUEST['mobile'] ,$digits = 6, false);
	echo 'sent'; 
	die();
	return; 
}
add_action('wp_ajax_nopriv_unbook','my_ajax_function');
add_action('wp_ajax_unbook','my_ajax_function');
//------------

function my_ajax_check_function(){
	
	$result_ok = verifiy_otp_registration( $_REQUEST['mobile'] , $_REQUEST['otp_pin'] );
	echo $result_ok? 'true':'false';
	die();
}
add_action('wp_ajax_nopriv_unbook_verify','my_ajax_check_function');
add_action('wp_ajax_unbook_verify','my_ajax_check_function');



