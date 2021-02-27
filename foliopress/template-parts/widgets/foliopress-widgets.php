<?php
/**
 /**
 * Register widget area and Sidebar.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 *
 * @package FolioPress
 */
/****************************************************************************************/

/**
 * Function to register the widget areas(sidebar) and widgets.
 */
function foliopress_widgets_init() {

	// Registering Left Sidebar
	register_sidebar( array(
		'name' 				=> __('Left Sidebar', 'foliopress') ,
		'id' 					=> 'foliopress_left_sidebar',
		'description' 		=> __('Shows widgets at Left Side.', 'foliopress') ,
		'before_widget' 	=> '<section id="%1$s" class="widget %2$s">',
		'after_widget' 	=> '</section>',
		'before_title' 	=> '<h3 class="widget-title">',
		'after_title' 		=> '</h3>',
	)	);

	// Registering Right Sidebar
	register_sidebar( array(
		'name' 				=> __('Right Sidebar', 'foliopress') ,
		'id' 					=> 'foliopress_right_sidebar',
		'description' 		=> __('Shows widgets at Right Side.', 'foliopress') ,
		'before_widget' 	=> '<section id="%1$s" class="widget %2$s">',
		'after_widget' 	=> '</section>',
		'before_title' 	=> '<h3 class="widget-title">',
		'after_title' 		=> '</h3>',
	) );

	// Registering Footer Sidebar 1
	register_sidebar( array(
		'name' 				=> __('Footer - Column 1', 'foliopress') ,
		'id' 					=> 'foliopress_footer_sidebar',
		'description' 		=> __('Shows widgets at Footer Column 1.', 'foliopress') ,
		'before_widget' 	=> '<section id="%1$s" class="widget %2$s">',
		'after_widget' 	=> '</section>',
		'before_title' 	=> '<h3 class="widget-title">',
		'after_title' 		=> '</h3>',
	) );

	// Registering Footer Sidebar 2
	register_sidebar( array(
		'name' 				=> __('Footer - Column 2', 'foliopress') ,
		'id' 					=> 'foliopress_footer_column2',
		'description' 		=> __('Shows widgets at Footer Column 2.', 'foliopress') ,
		'before_widget' 	=> '<section id="%1$s" class="widget %2$s">',
		'after_widget' 	=> '</section>',
		'before_title' 	=> '<h3 class="widget-title">',
		'after_title' 		=> '</h3>',
	) );

	// Registering Footer Sidebar 3
	register_sidebar( array(
		'name' 				=> __('Footer - Column 3', 'foliopress') ,
		'id' 					=> 'foliopress_footer_column3',
		'description' 		=> __('Shows widgets at Footer Column 3.', 'foliopress') ,
		'before_widget' 	=> '<section id="%1$s" class="widget %2$s">',
		'after_widget' 	=> '</section>',
		'before_title' 	=> '<h3 class="widget-title">',
		'after_title' 		=> '</h3>',
	) );
}
add_action('widgets_init', 'foliopress_widgets_init');