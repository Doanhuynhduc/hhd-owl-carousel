<?php
/**
 * Plugin Name:		  HHd Owl Carousel WP
 * Description:		  Owl carousel wp is a WordPress Carousel plugin based on owl carousel . You can add Image carousel in any WordPress Website. It is a responsive carousel plugin works perfectly in any Device Screen.Add Image through custom post type and have category to pull image in the carousel from any specific category.owl carousel wp is an easy plugin works using shortcode .
 * Version: 		  1.0
 * Author: 			  huynhduc
 * Author URI: 		  https://fb.com/hd7447
 */

require_once( dirname( __FILE__ ) . '/lib/active.php' );
require_once( dirname( __FILE__ ) . '/lib/deactive.php' );
include(plugin_dir_path( __FILE__ ).'/lib/cpt.php');
include(plugin_dir_path( __FILE__ ).'/lib/hhd_metadata.php');
include(plugin_dir_path( __FILE__ ).'/lib/hdd_setting_carousels.php');
include(plugin_dir_path( __FILE__ ).'/lib/hdd_add_colume.php');
include(plugin_dir_path( __FILE__ ).'/public/view.php');
function misha_include_myuploadscript() {
	/*
	 * I recommend to add additional conditions just to not to load the scipts on each page
	 * like:
	 * if ( !in_array('post-new.php','post.php') ) return;
	 */
	if ( ! did_action( 'wp_enqueue_media' ) ) {
		wp_enqueue_media();
	}
 
	 wp_enqueue_script( 'myuploadscript', plugin_dir_url(__FILE__).'inc/js/my-script.js', array('jquery'), null, false );
}
add_action( 'admin_enqueue_scripts', 'misha_include_myuploadscript' );
 

function hdd_ocw_carousel_enqueue_scripts() {
	   wp_enqueue_style('owl.=-carousel',  plugins_url( '', __FILE__ ) .'/owl-carousel/assets/owl.carousel.min.css');
	   wp_enqueue_style('owl-carousel-css',  plugins_url( '', __FILE__ ) .'/owl-carousel/assets/owl.theme.default.min.css');
	   wp_enqueue_script('owl-carousel-js',  plugins_url( '', __FILE__ ).'/owl-carousel/owl.carousel.min.js', array('jquery'), null, true);
	   wp_enqueue_script('helpt',  plugin_dir_url(__FILE__). 'inc/js/owlcarousel.js', null, null, false);
	   wp_enqueue_style('owstylecss',  plugin_dir_url(__FILE__).'/inc/css/style.css');
    }

add_action( 'wp_enqueue_scripts', 'hdd_ocw_carousel_enqueue_scripts' );


function misha_image_uploader_field( $name, $value = '') {
	$image = ' button">Upload image';
	$image_size = '150x150'; // it would be better to use thumbnail size here (150x150 or so)
	$display = 'none'; // display state ot the "Remove image" button
 
	if( $image_attributes = wp_get_attachment_image_src( $value, $image_size ) ) {
 
		// $image_attributes[0] - image URL
		// $image_attributes[1] - image width
		// $image_attributes[2] - image height
 
		$image = '"><img src="' . $image_attributes[0] . '" style="max-width:5%;display:block;" />';
		$display = 'inline-block';
 
	} 
 
	return '
	<div style="display:inline-block">
		<a href="#" class="misha_upload_image_button' . $image . '</a>
		<input type="hidden" name="' . $name . '" id="' . $name . '" value="' . esc_attr( $value ) . '" />
		<a href="#" class="misha_remove_image_button" style="display:inline-block;display:' . $display . '">Remove image</a>
	</div>';
}


function misha_image_uploader_field1( $name, $value = '') {
	$image = ' button">Upload image';
	$image_size = 'full'; 
	$display = 'none'; // display state ot the "Remove image" button
 
	if( $image_attributes = wp_get_attachment_image_src( $value, $image_size ) ) {
 
		// $image_attributes[0] - image URL
		// $image_attributes[1] - image width
		// $image_attributes[2] - image height
 
		$image = '"><img src="' . $image_attributes[0] . '" style="max-width:100%;display:block;" />';
		$display = 'inline-block';
 
	} 
 
	return '
	<div style="display:inline-block">
		<a href="#" class="misha_upload_image_button' . $image . '</a>
		<input type="hidden" name="' . $name . '" id="' . $name . '" value="' . esc_attr( $value ) . '" />
		<a href="#" class="misha_remove_image_button" style="display:inline-block;display:' . $display . '">Remove image</a>
	</div>';
}



add_action('wp_ajax_delif', 'delete_carosel_by_catid');
add_action('wp_ajax_nopriv_delif', 'delete_carosel_by_catid');
function delete_carosel_by_catid() {
	global $wpdb;
	$id = isset($_POST['id']) ? (int)$_POST['id'] : 0;
    $table = $wpdb->prefix . 'carousel';
    $delete = $wpdb->delete(
        $table,
        array( 'ID' => $id ),
        array( '%d' )
    );
}