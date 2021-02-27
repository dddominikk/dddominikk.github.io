<?php
/**
 * Template part for displaying results in search pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package FolioPress
 */

?>
<?php global $foliopress_settings; ?>

<div <?php post_class('post'); ?>>
	<?php if ( !has_post_format( 'quote' ) ) { // for not format quote ?>

		<header class="entry-header">
			<?php the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );

			if ( 'post' === get_post_type() && !has_post_format('link') ) { ?>

				<div class="entry-meta">
					<?php foliopress_posted_on(); ?>
				</div><!-- .entry-meta -->

			<?php } ?>
		</header><!-- .entry-header -->

	<?php } ?>

	<div class="entry-content">
		<?php if ( !has_post_format( 'link' ) && !has_post_format( 'quote' ) ) { // for format link

			the_excerpt();

			if ( str_word_count( strip_tags( get_the_content() ) ) > str_word_count( get_the_excerpt() ) ) { ?>
				<a href="<?php the_permalink(); ?>" class="readmore"><?php esc_html_e('Read More','foliopress'); ?></a>
			<?php }

		} else {
			the_content();
		} ?>
	</div><!-- .entry-content -->
</div><!-- .post -->
