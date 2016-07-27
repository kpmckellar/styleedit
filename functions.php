<?php
/**
 * styleedit functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package styleedit
 */

if ( ! function_exists( 'styleedit_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function styleedit_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on styleedit, use a find and replace
	 * to change 'styleedit' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'styleedit', get_template_directory() . '/languages' );

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
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary', 'styleedit' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'styleedit_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
}
endif;
add_action( 'after_setup_theme', 'styleedit_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function styleedit_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'styleedit_content_width', 640 );
}
add_action( 'after_setup_theme', 'styleedit_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function styleedit_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'styleedit' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'styleedit' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'styleedit_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function styleedit_scripts() {
	// template URI
	$templateURI = get_template_directory_uri();

	// load wordpress defaults
	wp_enqueue_style( 'styleedit-style', get_stylesheet_uri() );
	wp_enqueue_script( 'styleedit-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );
	wp_enqueue_script( 'styleedit-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}		

	// load global
	wp_enqueue_script( 'styleedit-scripts-global', $templateURI . '/js/global-scripts.js', array('jquery'), '1.0', true );	
	// load owl carousel on home and products single page
	if(is_home() || is_singular('products')){
		wp_enqueue_style( 'styleedit-owl-styles', $templateURI . '/js/owl-carousel/owl.carousel.css' );
		wp_enqueue_style( 'styleedit-owl-theme', $templateURI . '/js/owl-carousel/owl.theme.css' );	
		wp_enqueue_script( 'styleedit-owl-scripts', $templateURI . '/js/owl-carousel/owl.carousel.min.js', array('jquery'), '1.0', true );
	}

	// load homepage
	if(is_home()){
		wp_enqueue_style( 'styleedit-styles-home', $templateURI . '/css/style-home.css' );
		wp_enqueue_script( 'styleedit-scripts-home', $templateURI . '/js/home-scripts.js', array('jquery'), '1.0', true );
	}

	// load static
	if(is_page_template('template-parts/page-static.php')){
		wp_enqueue_style( 'styleedit-styles-static', $templateURI . '/css/style-static.css' );		
	}

	// load collections
	if(is_page_template('template-parts/page-collection.php')){
		wp_enqueue_style( 'styleedit-styles-collection', $templateURI . '/css/style-collection.css' );		
	}

	// load single product
	if(is_singular('products')){
		wp_enqueue_style( 'styleedit-styles-product', $templateURI . '/css/style-product.css' );
		wp_enqueue_script( 'styleedit-scripts-ui', '//code.jquery.com/ui/1.12.0/jquery-ui.js', array('jquery'), '1.0', true );		
		wp_enqueue_script( 'styleedit-scripts-product', $templateURI . '/js/product-scripts.js', array('jquery'), '1.0', true );		
	}

	// load 404 error
	if(is_404()){
		wp_enqueue_style( 'styleedit-styles-product', $templateURI . '/css/style-404.css' );		
	}
}
add_action( 'wp_enqueue_scripts', 'styleedit_scripts' );

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
 * Define CONSTANTS for settings page
 */
if ( ! defined( 'CUSTOM_LOCALE' ) )
	define( 'CUSTOM_LOCALE', '' );
	
if ( ! defined( 'CUSTOM_DIR' ) )
	define( 'CUSTOM_DIR', get_template_directory().'/inc/settings-panel' );

if ( ! defined( 'CUSTOM_URL' ) )
	define( 'CUSTOM_URL', get_template_directory_uri().'/inc/settings-panel' );

/**
 * Load Settings Page
 */
require_once get_template_directory() . '/inc/settings-panel/admin-options.php';

/**
 * Load Custom Meta Box
 */
require_once get_template_directory() . '/inc/metaboxes/meta_box.php';

/**
 * Load Post Types.
 */
require_once get_template_directory() . '/inc/post-homeSlider.php';
require_once get_template_directory() . '/inc/post-products.php';

/**
 * Register meta fields for static pages
 */
function post_page_meta($current_screen){
	if ( 'page' == $current_screen->post_type && 'post' == $current_screen->base ) {
		$prefix = 'page_';			
		$fields = array(				
			array(
			    'label' => 'Page Tablet Image',
			    'desc'  => 'The image that will be displayed on tablet devices.',
			    'id'    => $prefix.'tablet_img',			
			    'type'  => 'image'
			),
			array(
			    'label' => 'Page Mobile Image',
			    'desc'  => 'The image tht will be displayed on mobile devices.',
			    'id'    => $prefix.'mobile_img',
			    'type'  => 'image'
			),
			array(
			    'label' => 'Enable Store Locator',
			    'desc'  => 'Checking this will enable the store locator.',
			    'id'    => $prefix.'enable_locator',
			    'type'  => 'checkbox'
			)
		);
		$page_box = new custom_add_meta_box( 'page_box', 'Page Options', $fields, 'page', true );
	}
}
add_action( 'current_screen', 'post_page_meta' );