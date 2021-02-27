<?php
/**
 * Contains all current date, year and link of the theme
 *
 *
 * @package FolioPress
 */
?>
<?php
/**
 * To display the current year.
 *
 */
function foliopress_the_year() {
	return date_i18n( 'Y' );
}
/**
 * To display a link back to the site.
 *
 */
function foliopress_site_link() {
	return ' <a href="' . esc_url( home_url( '/' ) ) . '" title="' . esc_attr( get_bloginfo( 'name', 'display' ) ) . '">' . get_bloginfo( 'name', 'display' ) . '</a>';
}
/**
 * To display a link to WordPress.org.
 *
 */
function foliopress_wp_link() {
	return '<div class="wp-link">' .
		sprintf(
			esc_html__('Proudly Powered by: %s', 'foliopress'),
			'<a href="http://wordpress.org/" target="_blank" title="' . esc_attr__('WordPress', 'foliopress'). '">' . esc_html__('WordPress', 'foliopress') . '</a>'
		) . '</div>';
}
/**
 * To display a link to author.
 *
 */
function foliopress_author_link() {
	return '<div class="author-link">' .
		sprintf(
			esc_html__('Theme by: %s', 'foliopress'),
			'<a href="https://www.themehorse.com/" target="_blank" title="' . esc_attr__('Theme Horse', 'foliopress') . '" >' . esc_html__('Theme Horse', 'foliopress' ) . '</a>'
		) . '</div>';
}
