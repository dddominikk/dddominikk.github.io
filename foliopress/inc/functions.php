<?php
/**
 * FolioPress functions and definitions
 *
 * This file contains all the functions and it's defination that particularly can't be
 * in other files.
 *
 * @package FolioPress
 */

/**
 * Default Option
 */
function foliopress_get_option_defaults() {
	$foliopress_array_of_default_settings = array(
		'foliopress_site_layout' 						=> get_theme_mod('foliopress_site_layout', 'wide'),
		'foliopress_content_layout' 					=> get_theme_mod('foliopress_content_layout','right'),
		'foliopress_header_fixed'						=> get_theme_mod('foliopress_header_fixed',0),
		'foliopress_header_fluid'						=> get_theme_mod('foliopress_header_fluid',1),
		'foliopress_hide_search' 						=> get_theme_mod('foliopress_hide_search',0),
		'foliopress_social_profiles'					=> get_theme_mod('foliopress_social_profiles',''),
		'foliopress_my_avatar'							=> get_theme_mod('foliopress_my_avatar',''),
		'foliopress_my_info_title'						=> get_theme_mod('foliopress_my_info_title',''),
		'foliopress_my_desc'							=> get_theme_mod('foliopress_my_desc',''),
		'foliopress_my_info_social'						=> get_theme_mod('foliopress_my_info_social',0),
		'foliopress_post_layout' 						=> get_theme_mod('foliopress_post_layout','grid_view'),
		'foliopress_featured_image'						=> get_theme_mod('foliopress_featured_image', 1),
		'foliopress_footer_social'						=> get_theme_mod('foliopress_footer_social',0),
		'foliopress_footer_info_center'					=> get_theme_mod('foliopress_footer_info_center',0),
		'foliopress_footer_fluid'						=> get_theme_mod('foliopress_footer_fluid',0)
	);
	return apply_filters( 'foliopress_get_option_defaults', $foliopress_array_of_default_settings );
}

/**
 * Social Profiles
 */
if ( !function_exists( 'foliopress_social_profiles' ) ) {
	function foliopress_social_profiles() {
		$foliopress_settings = foliopress_get_option_defaults(); ?>

		<div class="social-profiles">
			<ul class="clearfix">
				<?php $social_arr = explode(',',$foliopress_settings['foliopress_social_profiles']);
				foreach ($social_arr as $value) { ?>
					<li><a title="<?php esc_attr_e( 'Social Profiles', 'foliopress' ); ?>" href="<?php echo esc_url(trim($value)); ?>"></a></li>
				<?php } ?>
			</ul>
		</div><!-- .social-profiles -->
		
	<?php }
}

if ( !function_exists('foliopress_layout_primary') ) {
	function foliopress_layout_primary() {

		$foliopress_settings = foliopress_get_option_defaults();

		global $post;
		if ($post) {
			$foliopress_meta_layout = get_post_meta($post->ID, 'foliopress_sidebarlayout', true);
		}
		$foliopress_custom_layout = $foliopress_settings['foliopress_content_layout'];

		if ( empty($foliopress_meta_layout) || is_archive() || is_search() || is_home() ) {
			$foliopress_meta_layout = 'default';
		}

		if ( 'default' == $foliopress_meta_layout ) {
			if ( ('right' == $foliopress_custom_layout) || ('nosidebar' == $foliopress_custom_layout) ) {
				$class = 'col-lg-8 ';
			}
			elseif ( 'left' == $foliopress_custom_layout ) {
				$class = 'col-lg-8 order-lg-2 ';
			}
			elseif ( 'fullwidth' == $foliopress_custom_layout ) {
				$class = 'col-lg-12 ';
			}
		}
		elseif ( ('meta-right' == $foliopress_meta_layout) || ('meta-nosidebar' == $foliopress_meta_layout) ) {
			$class = 'col-lg-8 ';
		}
		elseif ( 'meta-left' == $foliopress_meta_layout ) {
			$class = 'col-lg-8 order-lg-2 ';
		}
		elseif ( 'meta-fullwidth' == $foliopress_meta_layout ) {
			$class = 'col-lg-12 ';
		}

		echo '<div id="primary" class="' . $class . 'content-area">';

	}
}