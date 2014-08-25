<?php
/**
 * Featured Content sidebar
 */

if ( is_active_sidebar( 'home-content' ) )
		dynamic_sidebar( 'home-content' );
	else
		echo 'Please setup your featured content under widgets page';