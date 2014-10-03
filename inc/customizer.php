<?php

require_once( 'color-darken.php' );

/**
 * WOWtheme Theme Customizer
 *
 * @link http://codex.wordpress.org/Theme_Customization_API
 * @since wow_theme 1.0
 * @package WOWtheme
 */

class WowTheme_Customize {
  /**
   * This hooks into 'customize_register' (available as of WP 3.4) and allows
   * you to add new sections and controls to the Theme Customize screen.
   *
   * Note: To enable instant preview, we have to actually write a bit of custom
   * javascript. See live_preview() for more.
   *
   * @see add_action('customize_register',$func)
   * @param \WP_Customize_Manager $wp_customize
   * @link http://ottopress.com/2012/how-to-leverage-the-theme-customizer-in-your-own-themes/
   * @since wow_theme 1.0
   */
  public static function register ( $wp_customize ) {

    //Define a new section (if desired) to the Theme Customizer
    $wp_customize->add_section( 'wow_theme_options',
      array(
        'title' => __( 'WowTheme Options', 'wow_theme' ), //Visible title of section
        'priority' => 35, //Determines what order this appears in
        'capability' => 'edit_theme_options', //Capability needed to tweak
        'description' => __('Allows you to customize some example settings for wow_theme.', 'wow_theme'), //Descriptive tooltip
      )
    );

    /* *
     * Register new settings to the WP database...
     * */

    // Primary Color Settings
    $wp_customize->add_setting( 'wowtheme_options[color_primary]', //No need to use a SERIALIZED name, as `theme_mod` settings already live under one db record
      array(
        'default' => '#c2278f', //Default setting/value to save
        'type' => 'option', //Is this an 'option' or a 'theme_mod'?
        'capability' => 'edit_theme_options', //Optional. Special permissions for accessing this setting.
        //'transport' => 'postMessage', //What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
      )
    );

    //Link Color Settings
    $wp_customize->add_setting( 'wowtheme_options[color_link]', //No need to use a SERIALIZED name, as `theme_mod` settings already live under one db record
      array(
        'default' => '#a6e433', //Default setting/value to save
        'type' => 'option', //Is this an 'option' or a 'theme_mod'?
        'capability' => 'edit_theme_options', //Optional. Special permissions for accessing this setting.
       // 'transport' => 'postMessage', //What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
      )
    );

    /*
     * Add controls to the settings defined above
     */

    $wp_customize->add_control( new WP_Customize_Color_Control( //Instantiate the color control class
      $wp_customize, //Pass the $wp_customize object (required)
      'wowtheme_options[color_primary]', //Set a unique ID for the control
      array(
        'label' => __( 'Primary Color', 'wow_theme' ), //Admin-visible name of the control
        'section' => 'colors', //ID of the section this control should render in (can be one of yours, or a WordPress default section)
        'settings' => 'wowtheme_options[color_primary]', //Which setting to load and manipulate (serialized is okay)
        'priority' => 10, //Determines the order this control appears in for the specified section
      )
    ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( //Instantiate the color control class
      $wp_customize, //Pass the $wp_customize object (required)
      'wowtheme_options[color_link]', //Set a unique ID for the control
      array(
        'label' => __( 'Link Color', 'wow_theme' ), //Admin-visible name of the control
        'section' => 'colors', //ID of the section this control should render in (can be one of yours, or a WordPress default section)
        'settings' => 'wowtheme_options[color_link]', //Which setting to load and manipulate (serialized is okay)
        'priority' => 10, //Determines the order this control appears in for the specified section
      )
    ) );

    //4. We can also change built-in settings by modifying properties. For instance, let's make some stuff use live preview JS...
    $wp_customize->get_setting( 'blogname' )->transport = 'postMessage';
    $wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';
    $wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
    $wp_customize->get_setting( 'background_color' )->transport = 'postMessage';
  }

  /**
   * This will output the custom WordPress settings to the live theme's WP head.
   *
   * Used by hook: 'wp_head'
   *
   * @see add_action('wp_head',$func)
   * @since wow_theme 1.0
   */
  public static function header_output() {

    $options = get_option('wowtheme_options');

    ?>
    <!--Customizer CSS-->
    <style type="text/css">

      <?php //Top Navigation ?>
      <?php self::generate_css( '.top-nav', 'background-color', 'color_primary'); ?>
      <?php self::generate_css( '.bottom-nav', 'background-color', 'color_primary'); ?>

      <?php self::generate_css( '.nav li.active a, .nav li a:hover', 'color', 'color_link'); ?>
      <?php self::generate_css( '.nav li.btn-contact', 'background-color', 'color_link'); ?>
      <?php self::generate_css( '.nav li.btn-contact', 'box-shadow','', color_darken( $options['color_link'] ), ' 0px 3px 0px'); ?>
      <?php self::generate_css( '.nav li.btn-contact:hover', 'background-color','color_primary'); ?>
      <?php self::generate_css( '.nav li.btn-contact:hover', 'box-shadow','', color_darken( $options['color_primary'] ), ' 0px 1px 0px'); ?>

      <?php self::generate_css( '.hero-box .learn-btn', 'background-color', 'color_primary'); ?>
      <?php self::generate_css( '.hero-box .learn-btn', 'box-shadow','', color_darken( $options['color_primary'] ), ' 0px 3px 0px'); ?>
      <?php self::generate_css( '.hero-box .learn-btn:hover', 'box-shadow', '', color_darken( $options['color_primary'] ), ' 0px 1px 0px' ); ?>

      <?php self::generate_css( 'div.content-area .site-main .content h1 a, div.content-area .site-main .content-alt h1 a', 'color', 'color_primary' ); ?>
      <?php self::generate_css( 'div.content-area .site-main .content h1 a:hover, div.content-area .site-main .content-alt h1 a:hover', 'color', '', color_darken( $options[ 'color_primary' ], 50 ) ); ?>

      <?php self::generate_css('div.content-area .site-main .content span.read-btn, div.content-area .site-main .content-alt span.read-btn', 'background-color', 'color_link'); ?>
      <?php self::generate_css('div.content-area .site-main .content span.read-btn, div.content-area .site-main .content-alt span.read-btn', 'box-shadow', '', color_darken( $options[ 'color_link' ] ), ' 0px 3px 0px' ); ?>
      <?php self::generate_css('div.content-area .site-main .content span.read-btn:hover, div.content-area .site-main .content-alt span.read-btn:hover', 'box-shadow', '', color_darken( $options[ 'color_primary' ] ), ' 0px 1px 0px' ); ?>
      <?php self::generate_css('div.content-area .site-main .content span.read-btn:hover, div.content-area .site-main .content-alt span.read-btn:hover', 'background-color', '', color_darken( $options[ 'color_primary' ] ) ); ?>


    </style>
    <!--/Customizer CSS-->
  <?php
  }

  /**
   * This outputs the javascript needed to automate the live settings preview.
   * Also keep in mind that this function isn't necessary unless your settings
   * are using 'transport'=>'postMessage' instead of the default 'transport'
   * => 'refresh'
   *
   * Used by hook: 'customize_preview_init'
   *
   * @see add_action('customize_preview_init',$func)
   * @since wow_theme 1.0
   */
  public static function live_preview() {
    wp_enqueue_script(
      'wow_theme-themecustomizer', // Give the script a unique ID
      get_template_directory_uri() . '/assets/js/customizer.js', // Define the path to the JS file
      array(  'jquery', 'customize-preview' ), // Define dependencies
      '', // Define a version (optional)
      true // Specify whether to put in footer (leave this true)
    );
  }

  /**
   * This will generate a line of CSS for use in header output. If the setting
   * ($mod_name) has no defined value, the CSS will not be output.
   *
   * @uses get_theme_mod()
   * @param string $selector CSS selector
   * @param string $style The name of the CSS *property* to modify
   * @param string $mod_name The name of the 'theme_mod' option to fetch
   * @param string $prefix Optional. Anything that needs to be output before the CSS property
   * @param string $postfix Optional. Anything that needs to be output after the CSS property
   * @param bool $echo Optional. Whether to print directly to the page (default: true).
   * @return string Returns a single line of CSS with selectors and a property.
   * @since wow_theme 1.0
   */
  public static function generate_css( $selector, $style, $mod_name, $prefix='', $postfix='', $echo=true ) {
    $return = '';
    $mod = get_theme_mod($mod_name);
    $options = get_option('wowtheme_options');

    if ( empty( $mod_name ) && ! empty( $prefix ) ){
      $return = sprintf('%s { %s:%s; }',
        $selector,
        $style,
        $prefix.$postfix
      );
      if ( $echo ) {
        echo $return;
      }
    }

    if ( ! empty( $mod ) ) {
      $return = printf('%s { %s:%s; }',
        $selector,
        $style,
        $prefix.$mod.$postfix
      );
      if ( $echo ) {
        echo $return;
      }
    }
    elseif ( ! empty($options) ){
      $return = sprintf('%s { %s:%s; }',
        $selector,
        $style,
        $prefix.$options[$mod_name].$postfix
      );
      if ( $echo ) {
        echo $return;
      }
    }
    return $return;
  }
}

// Setup the Theme Customizer settings and controls...
add_action( 'customize_register' , array( 'WowTheme_Customize' , 'register' ) );

// Output custom CSS to live site
add_action( 'wp_head' , array( 'WowTheme_Customize' , 'header_output' ) );

// Enqueue live preview javascript in Theme Customizer admin screen
add_action( 'customize_preview_init' , array( 'WowTheme_Customize' , 'live_preview' ) );
