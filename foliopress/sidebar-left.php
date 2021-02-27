<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package FolioPress
 */

if ( ! is_active_sidebar( 'foliopress_left_sidebar' ) ) {
	return;
}
?>

<aside id="secondary" class="col-lg-4 widget-area order-lg-1" role="complementary">
	<?php dynamic_sidebar( 'foliopress_left_sidebar' ); ?>
</aside><!-- #secondary -->
