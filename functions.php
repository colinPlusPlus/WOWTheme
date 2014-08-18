<?php
/*
 * Function.php file
 * Author: Colin Williams
 *
 */

/*
 *
 * Register Top Menu Bar and Main Navigation Menu
 *
 */

include_once('Templates/nav.php');

/*
 *
 * Add Stylesheet and Scripts
 *
 */
function wow_theme_scripts() {
	wp_enqueue_style( 'wow-style', get_stylesheet_uri() );
	//wp_enqueue_script( 'script-name', get_template_directory_uri() . '/js/example.js', array(), '1.0.0', true );
}

add_action( 'wp_enqueue_scripts', 'wow_theme_scripts' );




