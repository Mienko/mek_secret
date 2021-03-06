<?php
/**
 * mek_secret functions and definitions
 *
 * @package mek_secret
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 800; /* pixels */
}

if ( ! function_exists( 'mek_secret_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function mek_secret_setup() {

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 */
	load_theme_textdomain( 'mek_secret', get_template_directory() . '/languages' );

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
		'primary' => __( 'Primary Menu', 'mek_secret' ),
	) );
	
	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption'
	) );

	/*
	 * Enable support for Post Formats.
	 * See http://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		//'aside',
		'image'
		//, video', 'quote', 'link'
	) );

	// Setup the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'mek_secret_custom_background_args', array(
		'default-color' => 'fafbfc',
		'default-image' => '',
	) ) );
}
endif; // mek_secret_setup
add_action( 'after_setup_theme', 'mek_secret_setup' );

/**
 * Change media settings when the theme is switched to.
 */
function mek_secret_media_settings() {
	// Setup Default WordPress settings
	$core_settings = array(
		'medium_size_w' => 300 , // Media medium size width
		'medium_size_h' => 9999, // Media medium size height
		'large_size_w' => 960,  // Media large size width
		'large_size_h' => 9999, // Media large size height
	);
	foreach ( $core_settings as $k => $v ) {
		update_option( $k, $v );
	}
	// Lets let the admin know whats going on.
	$msg = '
		<div class="error">
		<p>The ' . get_option( 'current_theme' ) . 'theme has changed your WordPress default <a href="' . admin_url() . 'options-media.php" title="See Settings">media settings</a>.</p>
		</div>';
	add_action( 'admin_notices', $c = create_function( '', 'echo "' . addcslashes( $msg, '"' ) . '";' ) );
}
//add_action( 'after_switch_theme', 'mek_secret_media_settings' );

/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function mek_secret_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'mek_secret' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
}
add_action( 'widgets_init', 'mek_secret_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function mek_secret_scripts() {
	wp_enqueue_style( 'mek_secret-style', get_template_directory_uri() . '/style.css' );

   wp_register_script( 'mek_secret-parallax', get_template_directory_uri() . '/js/parallax.js', array('jquery'), '20140828', true );
	wp_enqueue_script( 'mek_secret-navigation', get_template_directory_uri() . '/js/navigation.js', array('jquery'), '20120206', true );
	wp_enqueue_script( 'mek_secret-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'mek_secret_scripts' );

/**
 * Enqueue parallax script if a header image is loaded in .page-header.
 */
function mek_enqueue_parallax( $args ) {
		  wp_enqueue_script( 'mek_secret-parallax' );
        return $args;
}
add_filter( 'theme_mod_header_image', 'mek_enqueue_parallax' );

/**
 * Implement the Custom Header feature.
 */
//require get_template_directory() . '/inc/custom-header.php';
add_theme_support('custom-header');

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

/**
 * Image sizes.
 *
 * Fun with featured images (post thumbnails), custom headers and other mischievous media.
 */
add_image_size( 'header' , '9999' , '816' , false );
