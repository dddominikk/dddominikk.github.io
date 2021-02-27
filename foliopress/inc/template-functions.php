<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package FolioPress
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */

function foliopress_body_classes( $classes ) {
	$foliopress_settings = foliopress_get_option_defaults();

	if ( $foliopress_settings['foliopress_site_layout'] == 'narrow' ) {
		$classes[] = 'narrow-layout';
	}

	// Adds a class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	if ( has_header_video() && has_header_image() ) {
		if ( is_front_page() && is_home() ) {
			$classes[] = '';
		} elseif ( is_front_page() ) {
			$classes[] = '';
		} else {
			$classes[] = 'header-image';
		}
	} elseif ( has_header_image() ) {
		$classes[] = 'header-image';
	}

	return $classes;
}
add_filter( 'body_class', 'foliopress_body_classes' );

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function foliopress_pingback_header() {
	if ( is_singular() && pings_open() ) {
		echo '<link rel="pingback" href="', esc_url( get_bloginfo( 'pingback_url' ) ), '">';
	}
}
add_action( 'wp_head', 'foliopress_pingback_header' );

function foliopress_sidebar_content() {

	$foliopress_settings = foliopress_get_option_defaults();

	global $post;
	if ($post) {
		$foliopress_meta_layout = get_post_meta($post->ID, 'foliopress_sidebarlayout', true);
	}
	$foliopress_custom_layout = $foliopress_settings['foliopress_content_layout'];

	if ( empty($foliopress_meta_layout) || is_archive() || is_search() || is_home() ) {
		$foliopress_meta_layout = 'default';
	}
	
	if ( is_home() || is_archive() ) {
		if ( $foliopress_settings['foliopress_post_layout'] == 'list_view' ) {
			if ( 'default' == $foliopress_meta_layout ) {
				if ( 'right' == $foliopress_custom_layout ) {
					get_sidebar(); //used sidebar.php
				}
				elseif ( 'left' == $foliopress_custom_layout ) {
					get_sidebar('left'); //used sidebar-left.php
				}
				else {
					return; // doesnot display sidebar
				}
			}
			elseif ( 'meta-right' == $foliopress_meta_layout ) {
				get_sidebar(); //used sidebar.php
			}
			elseif ( 'meta-left' == $foliopress_meta_layout ) {
				get_sidebar('left'); //used sidebar-left.php
			}
			else {
				return; // doesnot display sidebar
			}
		}
	} else {
		if ( 'default' == $foliopress_meta_layout ) {
			if ( 'right' == $foliopress_custom_layout ) {
				get_sidebar(); //used sidebar.php
			}
			elseif ( 'left' == $foliopress_custom_layout ) {
				get_sidebar('left'); //used sidebar-left.php
			}
			else {
				return; // doesnot display sidebar
			}
		}
		elseif ( 'meta-right' == $foliopress_meta_layout ) {
			get_sidebar(); //used sidebar.php
		}
		elseif ( 'meta-left' == $foliopress_meta_layout ) {
			get_sidebar('left'); //used sidebar-left.php
		}
		else {
			return; // doesnot display sidebar
		}
	}
}
add_action( 'foliopress_sidebar', 'foliopress_sidebar_content');
