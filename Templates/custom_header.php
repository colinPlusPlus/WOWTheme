<?php

$defaults = array(
	'default-image'          => '',
	'random-default'         => false,
	'width'                  => 0,
	'height'                 => 440,
	'flex-height'            => false,
	'flex-width'             => false,
	'default-text-color'     => '',
	'header-text'            => true,
	'uploads'                => true,
	'wp-head-callback'       => '',
	'admin-head-callback'    => '',
	'admin-preview-callback' => '',
);
add_theme_support( 'custom-header', $defaults );

function header_background(){
	?>
	<style>
		.hero-bg {
			overflow: hidden;
			*zoom: 1;
			background: url("<?php header_image(); ?>") no-repeat center left;
			height: 440px;
			width: 100%;
		}
	</style>
	<?php
}
add_action('wp_head', 'header_background');
function custom_header(){
	//header_background();
	echo '<div class="hero-bg">';
    echo '<div class="hero-box">';
    echo'</div></div>';
}
function modify_user_contact_methods( $user_contact ){

	/* Add user contact methods */
	$user_contact['skype'] = __('Skype Username'); 
	$user_contact['twitter'] = __('Twitter Username'); 
	$user_contact['description'] = __('Bio'); 

	/* Remove user contact methods */
	unset($user_contact['description']);
	unset($user_contact['jabber']);

	return $user_contact;
}

add_filter('user_contactmethods', 'modify_user_contact_methods');