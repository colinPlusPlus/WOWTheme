<?php
/*
 * Author: Colin Williams
 * This code snippet is an interperatation found here at
 * http://code.tutsplus.com/articles/how-to-integrate-the-wordpress-media-uploader-in-theme-and-plugin-options--wp-26052
 *
 */

//add custom admin menu
add_action('admin_menu', 'wow_appearence_menu');

function wow_appearence_menu(){
	$page_title = 'WOW Nutrition Settings';
	$menu_title = 'WOW Nutrition Settings';
	$capability = 'manage_options';
	$menu_slug = 'wow-theme-settings';
	$function = 'wow_settings';
	//$icon_url = get_template_directory_uri() .'/WOWTheme/assets/images/settings_icon.gif';
	
	add_theme_page( $page_title, $menu_title, $capability, $menu_slug, $function );
}

function wow_settings(){

   /* //must check that the user has the required capability 
    if (!current_user_can('manage_options'))
    {
      wp_die( __('You do not have sufficient permissions to access this page.') );
    }

    // variables for the field and option names 
    $opt_name = 'mt_favorite_color';
    $hidden_field_name = 'mt_submit_hidden';
    $data_field_name = 'mt_favorite_color';

    // Read in existing option value from database
    $opt_val = get_option( $opt_name );

    // See if the user has posted us some information
    // If they did, this hidden field will be set to 'Y'
    if( isset($_POST[ $hidden_field_name ]) && $_POST[ $hidden_field_name ] == 'Y' ) {
        // Read their posted value
        $opt_val = $_POST[ $data_field_name ];

        // Save the posted value in the database
        update_option( $opt_name, $opt_val );

        // Put an settings updated message on the screen

?>
<div class="updated"><p><strong><?php _e('settings saved.', 'menu-test' ); ?></strong></p></div>
<?php

    }

    // Now display the settings editing screen

    echo '<div class="wrap">';

    // header

    echo "<h2>" . __( 'Menu Test Plugin Settings', 'menu-test' ) . "</h2>";

    // settings form
    
    ?>

<form name="form1" method="post" action="">
<input type="hidden" name="<?php echo $hidden_field_name; ?>" value="Y">

<p><?php _e("Favorite Color:", 'menu-test' ); ?> 
<input type="text" name="<?php echo $data_field_name; ?>" value="<?php echo $opt_val; ?>" size="20">
</p><hr />

<p class="submit">
<input type="submit" name="Submit" class="button-primary" value="<?php esc_attr_e('Save Changes') ?>" />
</p>

</form>
</div>

<?php*/
 
	$current_user = wp_get_current_user();
	$user_id = $current_user->ID;

	if( !user_can($user_id, 'manage_options' ) )
		return false;
	?>
	<div class="wrap">
		<h2>WOW Settings</h2>
		<label for="upload_image">
    <input id="upload_image" type="text" size="36" name="ad_image" value="http://" /> 
    <input id="upload_image_button" class="button" type="button" value="Upload Image" />
    <br />Enter a URL or upload an image
</label>
	</div>

<?php
}

// enqueue and register scripts
add_action('admin_enqueue_scripts', 'wow_settings_scripts');

function wow_settings_scripts() {
	if (isset($_GET['page']) && $_GET['page'] == 'wow-theme-settings') {
		wp_enqueue_media();
		wp_register_script('wow-my-upload', get_template_directory_uri().'/assets/js/main.js', array('jquery'));
		wp_enqueue_script('wow-my-upload');
	}
}
