<?php
/**
 * Vive functions and definitions
 *
 * @package Vive
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 640; /* pixels */
}

if ( ! function_exists( 'vive_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function vive_setup() {

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Vive, use a find and replace
	 * to change 'vive' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'vive', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'vive' ),
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

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'vive_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
}
endif; // vive_setup
add_action( 'after_setup_theme', 'vive_setup' );

/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function vive_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'vive' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
}
add_action( 'widgets_init', 'vive_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function vive_scripts() {

	wp_enqueue_style( 'google-fonts-source-sans', '//fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700' );

	wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/bower_components/font-awesome/css/font-awesome.min.css' );

	wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/less/bootstrap.css' );

	wp_enqueue_style( 'vive-style', get_stylesheet_uri() );

	wp_enqueue_script( 'bootstrap-transition', get_template_directory_uri() . '/bower_components/bootstrap/js/transition.js', array('jquery'), '', true );

	wp_enqueue_script( 'bootstrap-collapse', get_template_directory_uri() . '/bower_components/bootstrap/js/collapse.js', array('jquery'), '', true );

	wp_enqueue_script( 'bootstrap-tooltip', get_template_directory_uri() . '/bower_components/bootstrap/js/tooltip.js', array('jquery'), '', true );

	wp_enqueue_script( 'bootstrap-dropdown', get_template_directory_uri() . '/bower_components/bootstrap/js/dropdown.js', array('jquery'), '', true );

	wp_enqueue_script( 'bootstrap-tabs', get_template_directory_uri() . '/bower_components/bootstrap/js/tab.js', array('jquery'), '', true );

	wp_enqueue_script( 'smooth-scroll', get_template_directory_uri() . '/bower_components/smooth-scroll/dist/js/smooth-scroll.js', array(), '', true );

	wp_enqueue_script( 'moment', get_template_directory_uri() . '/bower_components/moment/moment.js', array(), '', true );

	wp_enqueue_script( 'pikaday', get_template_directory_uri() . '/bower_components/pikaday/pikaday.js', array(), '', true );

	wp_enqueue_script( 'vive-scripts', get_template_directory_uri() . '/js/scripts.js', array(), '', true );

	wp_enqueue_script( 'vive-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20120206', true );

	wp_enqueue_script( 'vive-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'vive_scripts' );

/**
 * Implement the Custom Header feature.
 */
//require get_template_directory() . '/inc/custom-header.php';

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
 *	Add Slug to Body Class
 */
//Page Slug Body Class
function add_slug_body_class( $classes ) {
	global $post;
	if ( isset( $post ) ) {
	$classes[] = $post->post_type . '-' . $post->post_name;
	}
	return $classes;
}
add_filter( 'body_class', 'add_slug_body_class' );

/**
 *  Vive Custom Post Types
 */
add_action( 'init', 'vive_register_post_types');
function vive_register_post_types() {

	// Specials
	$labels = array(
		'name'               => _x( 'Specials', 'post type general name', 'vive' ),
		'singular_name'      => _x( 'Special', 'post type singular name', 'vive' ),
		'menu_name'          => _x( 'Specials', 'admin menu', 'vive' ),
		'name_admin_bar'     => _x( 'Special', 'add new on admin bar', 'vive' ),
		'add_new'            => _x( 'Add New', 'specials', 'vive' ),
		'add_new_item'       => __( 'Add New Special', 'vive' ),
		'new_item'           => __( 'New Special', 'vive' ),
		'edit_item'          => __( 'Edit Special', 'vive' ),
		'view_item'          => __( 'View Special', 'vive' ),
		'all_items'          => __( 'All Specials', 'vive' ),
		'search_items'       => __( 'Search Specials', 'vive' ),
		'parent_item_colon'  => __( 'Parent Specials:', 'vive' ),
		'not_found'          => __( 'No specials found.', 'vive' ),
		'not_found_in_trash' => __( 'No specials found in Trash.', 'vive' )
	);
	$args = array(
		'labels'             => $labels,
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'specials' ),
		'capability_type'    => 'post',
		'has_archive'        => false, // False to prevent actual page to show archive
		'hierarchical'       => false,
		'menu_position'      => null,
		'supports'           => array( 'title', 'editor', 'thumbnail', 'excerpt' )
	);
	register_post_type( 'specials', $args );

	// Accommodations
	$labels = array(
		'name'               => _x( 'Accommodations', 'post type general name', 'vive' ),
		'singular_name'      => _x( 'Accommodation', 'post type singular name', 'vive' ),
		'menu_name'          => _x( 'Accommodations', 'admin menu', 'vive' ),
		'name_admin_bar'     => _x( 'Accommodation', 'add new on admin bar', 'vive' ),
		'add_new'            => _x( 'Add New', 'accommodations', 'vive' ),
		'add_new_item'       => __( 'Add New Accommodation', 'vive' ),
		'new_item'           => __( 'New Accommodation', 'vive' ),
		'edit_item'          => __( 'Edit Accommodation', 'vive' ),
		'view_item'          => __( 'View Accommodation', 'vive' ),
		'all_items'          => __( 'All Accommodations', 'vive' ),
		'search_items'       => __( 'Search Accommodations', 'vive' ),
		'parent_item_colon'  => __( 'Parent Accommodations:', 'vive' ),
		'not_found'          => __( 'No accommodations found.', 'vive' ),
		'not_found_in_trash' => __( 'No accommodations found in Trash.', 'vive' )
	);
	$args = array(
		'labels'             => $labels,
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'accommodations' ),
		'capability_type'    => 'post',
		'has_archive'        => false, // False to prevent actual page to show archive
		'hierarchical'       => false,
		'menu_position'      => null,
		'supports'           => array( 'title', 'editor', 'thumbnail' )
	);
	register_post_type( 'accommodations', $args );

	// Galleries
	$labels = array(
		'name'               => _x( 'Galleries', 'post type general name', 'vive' ),
		'singular_name'      => _x( 'Gallery', 'post type singular name', 'vive' ),
		'menu_name'          => _x( 'Galleries', 'admin menu', 'vive' ),
		'name_admin_bar'     => _x( 'Gallery', 'add new on admin bar', 'vive' ),
		'add_new'            => _x( 'Add New', 'galleries', 'vive' ),
		'add_new_item'       => __( 'Add New Gallery', 'vive' ),
		'new_item'           => __( 'New Gallery', 'vive' ),
		'edit_item'          => __( 'Edit Gallery', 'vive' ),
		'view_item'          => __( 'View Gallery', 'vive' ),
		'all_items'          => __( 'All Galleries', 'vive' ),
		'search_items'       => __( 'Search Galleries', 'vive' ),
		'parent_item_colon'  => __( 'Parent Galleries:', 'vive' ),
		'not_found'          => __( 'No galleries found.', 'vive' ),
		'not_found_in_trash' => __( 'No galleries found in Trash.', 'vive' )
	);
	$args = array(
		'labels'             => $labels,
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'galleries' ),
		'capability_type'    => 'post',
		'has_archive'        => false, // False to prevent actual page to show archive
		'hierarchical'       => false,
		'menu_position'      => null,
		'supports'           => array( 'title' )
	);
	register_post_type( 'galleries', $args );

}
