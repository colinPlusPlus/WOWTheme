<?php
/*
 * Function.php file
 * Author: Colin Williams
 *
 */

include_once('templates/nav.php');
include_once('templates/custom_header.php');
include_once('inc/wow-options.php');
include_once('inc/wow-widgets.php');
//include_once('inc/settings.php');

/*
 *
 * Add Stylesheet and Scripts
 *
 */
function wow_theme_scripts() {
	//wp_enqueue_style( 'wow-style', get_stylesheet_uri() );
	//wp_enqueue_script( 'script-name', get_template_directory_uri() . '/js/example.js', array(), '1.0.0', true );
}

add_action( 'wp_enqueue_scripts', 'wow_theme_scripts' );

/**
 *
 * add home page featured content
 *
 */

function featured_content(){
	
	echo '<section id="content">';
	if ( is_active_sidebar( 'home-content' ) )
		dynamic_sidebar( 'home-content' );
	else
		echo 'Please setup your featured content under widgets page';
	echo '</section>';

}



