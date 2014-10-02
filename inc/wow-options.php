<?php

require_once( 'color-darken.php' );

/***
 *
 * wowtheme Theme Options
 * Author: Colin Williams
 * Author URL: http://mainstreetcreativeco.com
 * This was inspired by: Lee Pham's article entitled "Integrating the WP Media Uploader Into Your Theme With jQuery."
 * URL: http://code.tutsplus.com/articles/integrating-the-wp-media-uploader-into-your-theme-with-jquery--wp-29320
 *
 */

function wowtheme_default_options() {
  // Check whether or not the 'wowtheme_options' exists
  // If not, create new one.
  if ( ! get_option( 'wowtheme_options' ) ) {
    $options = array(
      'logo' => '',
      'favicon' => '',
      'color_primary' => '#c2278f',
      'color_link' => '#a6e433',
      'name' => 'Judy French',
      'bio' => 'Ottawa\'s best kept secrect, Judy French has been serving the metro capital area for the last 15 years as a Nutrition Expert & Lifestyle Coach. She has helped countless individuals in their persuit of healthiness and happiness.'
    );
    update_option( 'wowtheme_options', $options );
  }
}
add_action( 'after_setup_theme', 'wowtheme_default_options' );

function wowtheme_add_page() {
  $wowtheme_options_page = add_theme_page( 'wowtheme', 'WOWTheme Options', 'manage_options', 'wowtheme', 'wowtheme_options_page' );
  add_action( 'admin_print_scripts-' . $wowtheme_options_page, 'wowtheme_print_scripts' );
}
add_action( 'admin_menu', 'wowtheme_add_page' );

function wowtheme_options_page() {
  ?>
  <div class='wrap'>
    <div id='icon-tools' class='icon32'><br /></div>
    <h2>WOWTheme Options Page</h2>
    <?php if ( isset( $_GET['settings-updated'] ) && $_GET['settings-updated'] ) : ?>
      <div class='updated'><p><strong>Settings saved.</strong></p></div>
    <?php endif; ?>
    <form action='options.php' method='post'>
      <?php settings_fields( 'wowtheme_options' ); ?>
      <?php do_settings_sections( 'wowtheme' ); ?>
      <?php submit_button(); ?>
    </form>
  </div>
<?php
}

add_action( 'admin_init', 'wowtheme_add_options' );
function wowtheme_add_options() {
  // Register new options
  register_setting( 'wowtheme_options', 'wowtheme_options', 'wowtheme_options_validate' );
  add_settings_section( 'wowtheme_section', 'WOWTheme Options', 'wowtheme_section_callback', 'wowtheme' );
  add_settings_field( 'wowtheme_logo', 'WOWTheme Logo', 'wowtheme_logo_callback', 'wowtheme', 'wowtheme_section' );
  add_settings_field( 'wowtheme_favicon', 'WOWTheme Favicon', 'wowtheme_favicon_callback', 'wowtheme', 'wowtheme_section' );
  add_settings_field( 'wowtheme_name', 'Full Name', 'wowtheme_name_callback', 'wowtheme', 'wowtheme_section' );
  add_settings_field( 'wowtheme_bio', 'Short Bio', 'wowtheme_bio_callback', 'wowtheme', 'wowtheme_section' );
  add_settings_field( 'wowtheme_color_picker', 'WOWTheme Colors', 'wowtheme_color_picker_callback', 'wowtheme', 'wowtheme_section' );
  //add_settings_field( 'wowtheme_color_picker', 'wowthemeTheme Color Links', 'wowtheme_color_picker_callback', 'wowtheme', 'wowtheme_section' );
}

function wowtheme_options_validate( $values ) {
  //foreach ( $values as $n => $v )
  //    $values[$n] = esc_url( $v );
  return $values;
}

function wowtheme_section_callback() { /* Print nothing */ };

function wowtheme_logo_callback() {
  $options = get_option( 'wowtheme_options' );
  ?>
  <span class='upload'>
        <input type='text' id='wowtheme_logo' class='regular-text text-upload' name='wowtheme_options[logo]' value='<?php echo esc_url( $options["logo"] ); ?>'/>
        <input type='button' class='button button-upload' value='Upload an image'/><br />
        <img style='max-width: 200px; display: block;' src='<?php echo esc_url( $options["logo"] ); ?>' class='preview-upload' />
    </span>
<?php
}

function wowtheme_favicon_callback() {
  $options = get_option( 'wowtheme_options' );
  ?>
  <span class='upload'>
        <input type='text' id='wowtheme_favicon' class='regular-text text-upload' name='wowtheme_options[favicon]' value='<?php echo esc_url( $options["favicon"] ); ?>'/>
        <input type='button' class='button button-upload' value='Upload an image'/><br />
        <img style='max-width: 300px; display: block;' src='<?php echo esc_url( $options["favicon"] ); ?>' class='preview-upload'/>
    </span>
<?php
}

function wowtheme_name_callback() {
  $options = get_option( 'wowtheme_options' );
  ?>
  <span class='upload'>
        <input type='text' id="wowtheme_name" class='regular-text' name='wowtheme_options[name]' value='<?php echo $options["name"]; ?>'/>
    </span>
<?php
}

function wowtheme_bio_callback() {
  $options = get_option( 'wowtheme_options' );
  ?>
  <span class='upload'>
        <textarea id="wowtheme_bio" class='regular-text' name='wowtheme_options[bio]' rows="5" cols="40"><?php echo $options["bio"]; ?></textarea>
    </span>
<?php
}

function wowtheme_color_picker_callback(){
  $options = get_option('wowtheme_options');
  ?>
  <p>Primary Colour:</p><input type="text"  name='wowtheme_options[color_primary]' value="<?php echo $options['color_primary']?>"class="primary" />
  <p>Links:</p><input type="text"  name='wowtheme_options[color_link]' value="<?php echo $options['color_link']?>"class="links" />
<?php
}

add_action( 'wp_head', 'wowtheme_color_picker_style');
function wowtheme_color_picker_style(){
  $options = get_option('wowtheme_options');
  ?>
  <style type="text/css">
    .top-nav{
      background-color: <?php echo $options[ 'color_primary' ] ?>;
    }

    .nav li.active a, .nav li a:hover{
      color: <?php echo $options[ 'color_link' ] ?> ;
    }

    .nav li.btn-contact{
      background-color: <?php echo $options[ 'color_link' ] ?>;
      box-shadow: <?php echo color_darken( $options[ 'color_link' ] ) ?> 0px 3px 0px;
    }

    .nav li.btn-contact a {
      color: white;
    }

  </style>
<?php
}

add_action( 'admin_enqueue_scripts', 'wowtheme_color_picker_scripts');
function wowtheme_color_picker_scripts($hook_suffix){
  wp_enqueue_style( 'wp-color-picker');
  wp_enqueue_script( 'wowtheme-color',  get_template_directory_uri() . '/assets/js/main.js', array('wp-color-picker'), false, true );
}
function wowtheme_print_scripts() {

  wp_enqueue_media(); // Add this to invoke the 3.5 Media Uploader in our custom page.
  wp_enqueue_script( 'wowtheme-upload', get_template_directory_uri() . '/assets/js/main.js', array( 'thickbox', 'media-upload' ) );
}