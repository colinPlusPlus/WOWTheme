<?php
/*
 * Author: Colin Williams
 */

//add custom admin menu
add_action('admin_menu', 'wow_appearence_menu');

function wow_appearence_menu(){
	$page_title = 'WOW Nutrition Settings';
	$menu_title = 'WOW Nutrition Settings';
	$capability = 'administrator';
	$menu_slug = 'wow-theme-settings';
	$function = 'wow_settings';
	$icon_url = get_template_directory_uri() .'/WOWTheme/assets/images/settings_icon.gif';
	
	add_menu_page( $page_title, $menu_title, $capability, $menu_slug, $function, $icon_url );
}

function wow_settings(){
	$current_user = wp_get_current_user();
	$user_id = $current_user->ID;

	if( !user_can($user_id, 'create_users' ) )
		return false;
	?>
	<div class="wrap">
		<h2>WOW Settings</h2>
		<form id="featured_upload" method="post" action="#" enctype="multipart/form-data">
			<input type="file" name="my_image_upload" id="my_image_upload"  multiple="false" />
			<input type="hidden" name="post_id" id="post_id" value="55" />
			<?php wp_nonce_field( 'my_image_upload', 'my_image_upload_nonce' ); ?>
			<input id="submit_my_image_upload" name="submit_my_image_upload" type="submit" value="Upload" />
		</form>
	</div>

<?php
// Check that the nonce is valid, and the user can edit this post.
if ( 
	isset( $_POST['my_image_upload_nonce'], $_POST['post_id']) 
	&& wp_verify_nonce( $_POST['my_image_upload_nonce'], 'my_image_upload' )
	&& current_user_can( 'edit_post', $_POST['post_id'] )
) {
	// The nonce was valid and the user has the capabilities, it is safe to continue.

	// These files need to be included as dependencies when on the front end.
	require_once( ABSPATH . 'wp-admin/includes/image.php' );
	require_once( ABSPATH . 'wp-admin/includes/file.php' );
	require_once( ABSPATH . 'wp-admin/includes/media.php' );
	
	// Let WordPress handle the upload.
	// Remember, 'my_image_upload' is the name of our file input in our form above.
	$attachment_id = media_handle_upload( 'my_image_upload', $_POST['post_id'] );
	
	if ( is_wp_error( $attachment_id ) ) {
		// There was an error uploading the image.
		echo 'error';
	} else {
		// The image was uploaded successfully!
		echo wp_get_attachment_image(  $_POST['post_id'] );
		the_attachment_link( 4, true );
		echo 'success!';
	}

} else {

	// The security check failed, maybe show the user an error.
	echo ' The security check failed, maybe show the user an error.';
}
}
