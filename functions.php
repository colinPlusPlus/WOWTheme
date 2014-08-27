<?php
/**
 * WOWtheme functions and definitions
 *
 * @package WOWtheme
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 640; /* pixels */
}

if ( ! function_exists( 'wow_theme_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function wow_theme_setup() {

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on WOWtheme, use a find and replace
	 * to change 'wow-theme' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'wow-theme', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => __( 'Main Menu', 'wow-theme' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 * See http://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'aside', 'image', 'video', 'quote', 'link',
	) );

	// Setup the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'wow_theme_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
}
endif; // wow_theme_setup
add_action( 'after_setup_theme', 'wow_theme_setup' );

/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function wow_theme_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'wow-theme' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<div class="green-top">',
		'after_widget'  => '</div>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1></div><div class="black-body">',
	) );

	register_sidebar( array(
		'name' => 'Featured Content Widget',
		'id' => 'home-content',
		'before_widget' => '<div class="blog-roll">',
		'after_widget' => '</div>',
		'before_title' => '<h3>',
		'after_title' => '</h3>',
	) );

	register_sidebar( array(
		'name' => 'Footer Left',
		'id' => 'footer-left',
		'before_widget' => '<div class="widget">',
		'after_widget' => '</div>',
		'before_title' => '<h3>',
		'after_title' => '</h3>',
	) );

	register_sidebar( array(
		'name' => 'Footer Center',
		'id' => 'footer-center',
		'before_widget' => '<div class="widget">',
		'after_widget' => '</div>',
		'before_title' => '<h3>',
		'after_title' => '</h3>',
	) );

	register_sidebar( array(
		'name' => 'Footer Right',
		'id' => 'footer-right',
		'before_widget' => '<div class="widget last">',
		'after_widget' => '</div>',
		'before_title' => '<h3>',
		'after_title' => '</h3>',
	) );

	register_widget( 'Featured_Post_Widget' );
}
add_action( 'widgets_init', 'wow_theme_widgets_init' );

// Replaces the excerpt "more" text by a link
function new_excerpt_more($more) {
       global $post;
	return '<a class="moretag" href="'. get_permalink($post->ID) . '"><span class="read-btn">Read more</span> </a>';
}
add_filter('excerpt_more', 'new_excerpt_more');

/**
 * Enqueue scripts and styles.
 */
function wow_theme_scripts() {
	wp_enqueue_style( 'wow-theme-style', get_stylesheet_uri() );

	wp_enqueue_style( 'wow-theme-main-style', get_template_directory_uri(). '/assets/css/main.css' );

	wp_enqueue_script( 'wow-theme-navigation', get_template_directory_uri() . '/assets/js/navigation.js', array(), '20120206', true );

	wp_enqueue_script( 'wow-theme-skip-link-focus-fix', get_template_directory_uri() . '/assets/js/skip-link-focus-fix.js', array(), '20130115', true );

	wp_enqueue_script( 'jquery');

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'wow_theme_scripts' );


//Set header_image to the background url 
add_action('wp_head', 'wow_header_background');

function wow_header_background(){
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

function wow_custom_header(){
	$options = get_option( 'wptuts_options' );
	$the_query = new WP_Query(array('pagename' => 'about', 'post_type' => 'page'));
	$main_bio = '<div class="hero-bg">';
    $main_bio .= '<div class="hero-box">';
    if ( isset ($options['name']) && isset($options['bio'])) {
    	$main_bio .= '<h1>'. $options['name'] . '</h1>';
    	$main_bio .= '<span></span>';
    	$main_bio .= '<p>'.$options['bio'].'</p>';
    	if ( $the_query->have_posts() ){
    		//while($the_query->have_posts()){
    			$the_query->the_post();
    			$main_bio .= '<a href="'. get_permalink() .'"> <span class="learn-btn">Learn More</span></a>';
    		//}
    	}
    }

    
    $main_bio .=' </div></div>';

    echo $main_bio;
}

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
//require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
//require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
//require get_template_directory() . '/inc/jetpack.php';



require get_template_directory() .'/templates/nav.php';
require get_template_directory() .'/templates/custom_header.php';
require get_template_directory() .'/inc/wow-options.php';
require get_template_directory() .'/inc/wow-widgets.php';
require get_template_directory() .'/inc/featured-post-widget.php';


/*function featured_content(){

	echo '<section id="content">';
	if ( is_active_sidebar( 'home-content' ) )
		dynamic_sidebar( 'home-content' );
	else
		echo 'Please setup your featured content under widgets page';
	echo '</section>';

}*/