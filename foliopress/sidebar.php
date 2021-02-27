<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package FolioPress
 */

if ( ! is_active_sidebar( 'foliopress_right_sidebar' ) ) {
	return;
}
?>

<aside id="secondary" class="col-lg-4 widget-area" role="complementary">
	<?php dynamic_sidebar( 'foliopress_right_sidebar' ); ?>
</aside><!-- #secondary -->
