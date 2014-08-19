<?php

/*
 *
 * Register Navigation Menus
 *
 */

add_action( 'init', 'wow_register_my_menus' );
function wow_register_my_menus() {
  
  $menus = array('primary' => __('Main Menu'));
  register_nav_menus($menus);

}

function wow_navigation_menu(){
	
    // This code based on wp_nav_menu's code to get Menu ID from menu slug from the Wordpress Codex

    $menu_name = 'primary';

    if ( ( $locations = get_nav_menu_locations() ) && isset( $locations[ $menu_name ] ) ) {
	
	$menu = wp_get_nav_menu_object( $locations[ $menu_name ] );
	$menu_items = wp_get_nav_menu_items($menu->term_id);

	$menu_list = '<nav class="navbar">'; 
	$menu_list .= '<img src="assests/img/logo.png" class="img-responsive" alt="logo" title="logo" />';
	$menu_list .= '<ul class="nav">';

	foreach ( (array) $menu_items as $key => $menu_item ) {
	    
	    $title = $menu_item->title;
	    $url = $menu_item->url;
	    if (is_page($title) ||  is_front_page() && strtolower($title) == 'home'){
	    	$menu_list .= '<li class="active"><a href="' . $url . '">' . $title . '</a></li>';	
	    }
	    elseif (strtolower($title) == 'contact') {
	    	$menu_list .= '<li class="btn-contact last"><a href="' . $url . '">' . $title . '</a></li>';
	    }
	    else{
	    	$menu_list .= '<li><a href="' . $url . '">' . $title . '</a></li>';
	    }    
	}

	$menu_list .= '</ul>';
	$menu_list .= '</nav>';

    } 
    else {
	
	$menu_list = '<ul><li>Menu "' . $menu_name . '" not defined.</li></ul>';
    
    }

    echo $menu_list;
}
