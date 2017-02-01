<?php 
/*
Plugin Name: Preloaders
Plugin URI: https://wordpress.org/plugins/preloader
Description: Preloaders is a nice and smooth preloader wordpress plugin.
Author: ShapedPlugin
Author URI: http://shapedplugin.com
Version: 1.0
License: GPL2
Text Domain: shaped_plugin
*/


/* Adding Latest jQuery from WordPress */
function preloader_wp_latest_jquery() {
	wp_enqueue_script('jquery');
}
add_action('init', 'preloader_wp_latest_jquery');

/* Adding plugin javascript active file */
function preloader_plugin_active() {
	wp_register_script( 'plugin-script-active', plugins_url('js/active.js', __FILE__) );
    wp_enqueue_script( 'plugin-script-active' );
}
add_action( 'init', 'preloader_plugin_active' );

/* Adding Plugin Custom CSS file */
function preloader_plugin_styles() {
	wp_register_style( 'plugin-style', plugins_url('css/style.css', __FILE__) );
    wp_enqueue_style( 'plugin-style' );
}
add_action( 'wp_enqueue_scripts', 'preloader_plugin_styles' );

/* HTML Content */
function preloader_main_content () {
?>
	<div id="loading">
		<div id="loading-center">
			<div id="loading-center-absolute">
				<div class="object" id="object_one"></div>
				<div class="object" id="object_two"></div>
				<div class="object" id="object_three"></div>
				<div class="object" id="object_four"></div>
			</div>
		</div>
	</div>
<?php
}
add_action ('wp_enqueue_scripts', 'preloader_main_content');

?>