<?php
/***
 *
 * Wow Theme Options
 * Author: Colin Williams
 * Author URL: http://mainstreetcreativeco.com
 * This was inspired by: Lee Pham's article entitled "Integrating the WP Media Uploader Into Your Theme With jQuery."
 * URL: http://code.tutsplus.com/articles/integrating-the-wp-media-uploader-into-your-theme-with-jquery--wp-29320
 *
 */

add_action( 'after_setup_theme', 'wptuts_default_options' );
function wptuts_default_options() {
    // Check whether or not the 'wptuts_options' exists
    // If not, create new one.
    if ( ! get_option( 'wptuts_options' ) ) {
        $options = array(
            'logo' => '',
            'favicon' => '',
            'color' => '#c2278f',
            'name' => 'Judy French',
            'bio' => 'Ottawa\'s best kept secrect, Judy French has been serving the metro capital area for the last 15 years as a Nutrition Expert & Lifestyle Coach. She has helped countless individuals in their persuit of healthiness and happiness.'
        );
        update_option( 'wptuts_options', $options );
    }
}

add_action( 'admin_menu', 'wptuts_add_page' );
function wptuts_add_page() {
    $wptuts_options_page = add_theme_page( 'WowTheme', 'WowTheme Options', 'manage_options', 'wptuts', 'wptuts_options_page' );
    add_action( 'admin_print_scripts-' . $wptuts_options_page, 'wptuts_print_scripts' );
}
function wptuts_options_page() {
    ?>
    <div class='wrap'>
        <div id='icon-tools' class='icon32'><br /></div>
        <h2>WowTheme Options Page</h2>
        <?php if ( isset( $_GET['settings-updated'] ) && $_GET['settings-updated'] ) : ?>
            <div class='updated'><p><strong>Settings saved.</strong></p></div>
        <?php endif; ?>
        <form action='options.php' method='post'>
            <?php settings_fields( 'wptuts_options' ); ?>
            <?php do_settings_sections( 'wptuts' ); ?>
            <?php submit_button(); ?>
        </form>
    </div>
    <?php
}

add_action( 'admin_init', 'wptuts_add_options' );
function wptuts_add_options() {
    // Register new options
    register_setting( 'wptuts_options', 'wptuts_options', 'wptuts_options_validate' );
    add_settings_section( 'wptuts_section', 'WowTheme Options Section', 'wptuts_section_callback', 'wptuts' );
    add_settings_field( 'wptuts_logo', 'WowTheme Logo', 'wptuts_logo_callback', 'wptuts', 'wptuts_section' );
    add_settings_field( 'wptuts_favicon', 'WowTheme Favicon', 'wptuts_favicon_callback', 'wptuts', 'wptuts_section' );
    add_settings_field( 'wptuts_name', 'Full Name', 'wptuts_name_callback', 'wptuts', 'wptuts_section' );
    add_settings_field( 'wptuts_bio', 'Short Bio', 'wptuts_bio_callback', 'wptuts', 'wptuts_section' );
    add_settings_field( 'wptuts_color_picker', 'WowTheme Color Picker', 'wptuts_color_picker_callback', 'wptuts', 'wptuts_section' );
}
 
function wptuts_options_validate( $values ) {
    //foreach ( $values as $n => $v )
    //    $values[$n] = esc_url( $v );
    return $values;
}

function wptuts_section_callback() { /* Print nothing */ };
 
function wptuts_logo_callback() {
    $options = get_option( 'wptuts_options' );
    ?>
    <span class='upload'>
        <input type='text' id='wptuts_logo' class='regular-text text-upload' name='wptuts_options[logo]' value='<?php echo esc_url( $options["logo"] ); ?>'/>
        <input type='button' class='button button-upload' value='Upload an image'/><br />
        <img style='max-width: 200px; display: block;' src='<?php echo esc_url( $options["logo"] ); ?>' class='preview-upload' />
    </span>
    <?php
}
 
function wptuts_favicon_callback() {
    $options = get_option( 'wptuts_options' );
    ?>
    <span class='upload'>
        <input type='text' id='wptuts_favicon' class='regular-text text-upload' name='wptuts_options[favicon]' value='<?php echo esc_url( $options["favicon"] ); ?>'/>
        <input type='button' class='button button-upload' value='Upload an image'/><br />
        <img style='max-width: 300px; display: block;' src='<?php echo esc_url( $options["favicon"] ); ?>' class='preview-upload'/>
    </span>
    <?php
}

function wptuts_name_callback() {
    $options = get_option( 'wptuts_options' );
    ?>
    <span class='upload'>
        <input type='text' id="wptuts_name" class='regular-text' name='wptuts_options[name]' value='<?php echo $options["name"]; ?>'/>
    </span>
    <?php
}

function wptuts_bio_callback() {
    $options = get_option( 'wptuts_options' );
    ?>
    <span class='upload'>
        <textarea id="wptuts_bio" class='regular-text' name='wptuts_options[bio]' rows="5" cols="40"><?php echo $options["bio"]; ?></textarea>
    </span>
    <?php
}

function wptuts_color_picker_callback(){
	$options = get_option('wptuts_options');
	?>
	<input type="color"  name='wptuts_options[color]' value="<?php echo $options['color']?>"class="top-nav" />
	<?php
}

add_action( 'wp_head', 'wow_color_picker_style');
function wow_color_picker_style(){
	$options = get_option('wptuts_options');
	?>
	<style type="text/css">
		 .top-nav{
            background-color: <?php echo $options['color']; ?>
        }   
	</style>
	<?php
}

add_action( 'admin_enqueue_scripts', 'wptuts_color_picker_scripts');
function wptuts_color_picker_scripts($hook_suffix){
	wp_enqueue_style( 'wp-color-picker');
	wp_enqueue_script( 'wptuts-color',  get_template_directory_uri() . '/assets/js/main.js', array('wp-color-picker'), false, true );
}
function wptuts_print_scripts() {
   
    wp_enqueue_media(); // Add this to invoke the 3.5 Media Uploader in our custom page.
    wp_enqueue_script( 'wptuts-upload', get_template_directory_uri() . '/assets/js/main.js', array( 'thickbox', 'media-upload' ) );
}