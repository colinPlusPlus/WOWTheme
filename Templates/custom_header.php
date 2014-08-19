<?php

$defaults = array(
	'default-image'          => '',
	'random-default'         => false,
	'width'                  => 0,
	'height'                 => 440,
	'flex-height'            => false,
	'flex-width'             => false,
	'default-text-color'     => '',
	'header-text'            => false,
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