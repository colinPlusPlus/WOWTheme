<?php

/*
 *
 * Register Navigation Menus
 *
 */

function wow_register_my_menus() {
  $menus = array('primary' => __('Main Menu'));
  register_nav_menus($menus);
}
add_action( 'init', 'wow_register_my_menus' );

/*$wow_defaults = array(
	'theme_location'  => 'primary',
	'menu'            => 'Main Menu',
	'container'       => '',
	'container_class' => '',
	'container_id'    => '',
	'menu_class'      => 'nav',
	'menu_id'         => '',
	'echo'            => true,
	'fallback_cb'     => 'wp_page_menu',
	'before'          => '',
	'after'           => '',
	'link_before'     => '',
	'link_after'      => '',
	'items_wrap'      => '<ul class="%2$s">%3$s</ul>',
	'depth'           => 0,
	'walker'          => ''
);*/

function navigation_menu(){
	/*echo '<div class="top-nav"></div>';
    echo '<nav class="navbar">';
    echo '<img src="assests/img/logo.png" class="img-responsive" alt="logo" title="logo" />';
    wp_nav_menu( $wow_defaults );
    echo '</nav>';*/
     // Get the nav menu based on $menu_name (same as 'theme_location' or 'menu' arg to wp_nav_menu)
    // This code based on wp_nav_menu's code to get Menu ID from menu slug

    $menu_name = 'primary';

    if ( ( $locations = get_nav_menu_locations() ) && isset( $locations[ $menu_name ] ) ) {
	$menu = wp_get_nav_menu_object( $locations[ $menu_name ] );

	$menu_items = wp_get_nav_menu_items($menu->term_id);

	$menu_list = '<nav class="navbar">'; 
	$menu_list .= '<ul class="nav">';

	foreach ( (array) $menu_items as $key => $menu_item ) {
	    $title = $menu_item->title;
	    $url = $menu_item->url;
	    $menu_list .= '<li><a href="' . $url . '">' . $title . '</a></li>';
	}
	$menu_list .= '</ul>';
	$menu_list .= '</nav>';
    } else {
	$menu_list = '<ul><li>Menu "' . $menu_name . '" not defined.</li></ul>';
    }

    return $menu_list;
}
