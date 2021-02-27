<?php
/**
 * The template for displaying search form of the theme
 *
 *
 * @package FolioPress
 */
?>
<form action="<?php echo esc_url( home_url( '/' ) ); ?>" method="get" class="search-form">
	<label class="assistive-text"> <?php esc_html_e( 'Search', 'foliopress' ); ?> </label>
	<div class="input-group">
		<input type="search" value="<?php the_search_query(); ?>" placeholder="<?php esc_attr_e( 'Search', 'foliopress' ); ?>" class="form-control s" name="s">
		<div class="input-group-prepend">
			<button class="btn btn-info"><?php esc_html_e( 'Search', 'foliopress' ); ?></button>
		</div>
	</div>
</form><!-- .search-form -->
