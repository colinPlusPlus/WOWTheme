<?php
/**
 * Register our sidebars and widgetized areas.
 *
 */
function wow_home_content_sidebar() {

	register_sidebar( array(
		'name' => 'Home Content Widget',
		'id' => 'home-content',
		'before_widget' => '<div class="blog-roll">',
		'after_widget' => '</div>',
		'before_title' => '<h3>',
		'after_title' => '</h3>',
	) );
}
add_action( 'widgets_init', 'wow_home_content_sidebar' );