<?php
/**
 * FolioPress functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package FolioPress
 */

if ( ! function_exists( 'foliopress_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function foliopress_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on FolioPress, use a find and replace
		 * to change 'foliopress' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'foliopress', get_template_directory() . '/languages' );

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
			'primary' => esc_html__( 'Primary', 'foliopress' ),
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'foliopress_custom_background_args', array(
			'default-color' => 'f1f1f1',
			'default-image' => '',
		) ) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 100,
			'width'       => 260,
			'flex-width'  => true,
			'flex-height' => true,
		) );

		// Add Support for post-formats
		add_theme_support( 'post-formats', array(
			'quote', 'link'
		) );

	}
endif;
add_action( 'after_setup_theme', 'foliopress_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function foliopress_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'foliopress_content_width', 730 );
}
add_action( 'after_setup_theme', 'foliopress_content_width', 0 );

/**
 * Returns a "Continue reading" link for excerpts
 */
function foliopress_continue_reading() {
	if (!is_admin()) {
		return '&hellip; ';
	}
}
add_filter('excerpt_more', 'foliopress_continue_reading');

/**
 * Enqueue scripts and styles.
 */
function foliopress_scripts() {
	wp_enqueue_style( 'bootstrap-style', get_template_directory_uri().'/bootstrap/css/bootstrap.min.css', array(), '4.0.0');
	wp_enqueue_style('font-awesome-style', get_template_directory_uri().'/font-awesome/css/font-awesome.css');

	wp_register_style( 'foliopress-google-fonts', '//fonts.googleapis.com/css?family=Poppins:400,400i,500,500i,700,700i');
	wp_enqueue_style( 'foliopress-google-fonts' );

	wp_enqueue_style( 'foliopress-style', get_stylesheet_uri() );

	wp_enqueue_script('popper-script', get_template_directory_uri().'/bootstrap/js/popper.min.js', array('jquery'), '1.12.9', true);
	wp_enqueue_script('bootstrap-script', get_template_directory_uri().'/bootstrap/js/bootstrap.min.js', array('jquery'), '4.0.0', true);

	wp_enqueue_script( 'html5', get_template_directory_uri() . '/js/html5.js', array(), '3.7.3' );
	wp_script_add_data( 'html5', 'conditional', 'lt IE 9' );

	wp_enqueue_script( 'foliopress-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

	wp_enqueue_script('foliopress-scripts', get_template_directory_uri().'/js/scripts.js', array('jquery'), false, true);

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'foliopress_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Widgets and Sidebar file
 */
require get_template_directory() . '/template-parts/widgets/foliopress-widgets.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/functions.php';

/**
 * Load footer info page
 */
require get_template_directory() . '/inc/foliopress-footer-info.php';

/**
 * Load foliopress metaboxes
 */
require get_template_directory() . '/inc/foliopress-metaboxes.php';
