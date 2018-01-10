<?php
/*
Plugin Name: 	My prettyPhoto
Version:		1.0.0
Author:			I. Kancijan
Author URI:		https://github.com/IKancijan
License:		MIT
*/


defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

include 'inc/my-pp-options.php';

function myppp_scripts() {
	
		wp_enqueue_style( 'my-pp-css', plugins_url( 'css/prettyPhoto.css', __FILE__ ));
	
		wp_enqueue_script( 'my-pp', plugins_url( '/js/jquery.prettyPhoto.js', __FILE__ ), array('jquery'), '3.1.6', true );
		wp_enqueue_script( 'my-pp-script', plugins_url( '/js/mypp-script.js', __FILE__ ), array('my-pp'), '1.0.0', true );
	}
add_action( 'wp_enqueue_scripts', 'myppp_scripts' );

/**
 * Attach a class to linked images' parent anchors
 */
function give_linked_images_class($html, $id, $caption, $title, $align, $url, $size, $alt = '' ){
	$rel = "prettyPhoto";
  
	// check if there are already rel assigned to the anchor
	if ( preg_match('/<a.*? rel=".*?">/', $html) ) {
	  $html = preg_replace('/(<a.*? rel=".*?)(".*?>)/', '$1 ' . $rel . '$2', $html);
	} else {
	  $html = preg_replace('/(<a.*?)>/', '$1 rel="' . $rel . '" >', $html);
	}
	return $html;
  }
  add_filter('image_send_to_editor','give_linked_images_class',10,8);

function gallery_should_link_to_files($out, $pairs, $atts)
{
    $atts = shortcode_atts( array( 
    'link' => 'file' 
    ), $atts );
    $out['link'] = $atts['link'];
    return $out;
}
add_filter('shortcode_atts_gallery', 'gallery_should_link_to_files', 10, 3);

function mypp_values() {
	
	$myoptions = get_option('mypp_settings');
	echo "<script>var mypp_values = [{
		my_pp_theme: '".$myoptions[mypp_select_pp_theme]."'
	}];</script>";
}
add_action( 'wp_head', 'mypp_values' );