<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package FolioPress
 */

?>
<?php global $foliopress_settings;

if ( ($foliopress_settings['foliopress_post_layout'] != 'list_view') && ( !is_single() ) ) { ?>
	<div <?php post_class('col-sm-6 col-lg-4'); ?> >
		<?php $attachment_id = get_post_thumbnail_id(); ?>
		<a class="entry-wrap" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" <?php if( has_post_thumbnail() && !has_post_format('quote') ): ?> style="background-image:url('<?php echo esc_url( wp_get_attachment_image_url( $attachment_id, 'full' ) )?>');" <?php endif; ?> >
			<?php if ( is_sticky() && is_home() && ! is_paged() ) { ?> 
				<span class="sticky-post"></span>
			<?php } ?>
			<div class ="entry-main">
				<?php if (!has_post_format('quote') ) { ?>
					<h2 class="entry-title"><?php the_title();?></h2><!-- .entry-title -->
					<p><?php echo substr( get_the_excerpt(), 0, 126 ); ?></p>
				<?php } else {
					the_content();
				} ?>
			</div><!-- .entry-main -->
		</a><!-- .entry-wrap -->
	</div><!-- post -->
<?php } else { ?>
<div <?php post_class(); ?>>
	<?php if ( !has_post_format( 'quote' ) ) { // for not format quote ?>
		<header class="entry-header">
			<?php if ( is_sticky() && is_home() && !is_paged() ) { ?>
				<span class="sticky-post"></span>
			<?php } 
			if ( 'post' === get_post_type() ) { 
				if ( !has_post_format( 'link' ) ){ // for not format link ?>
					<div class="entry-meta">
						<span class="cat-links">
							<?php the_category(', '); ?>
						</span><!-- .cat-links -->
					</div><!-- .entry-meta -->
				<?php } 
			} ?>

			<?php 
			if ( is_singular() ) {
				the_title( '<h1 class="entry-title">', '</h1>' );
			} else {
				the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
			} ?>
			
			<?php if ( 'post' === get_post_type() ) { 
				if ( !has_post_format( 'link' ) ){ ?>
					<div class="entry-meta">
						<?php foliopress_posted_on(); ?>
					</div><!-- .entry-meta -->
				<?php } 
			} ?>
		</header><!-- .entry-header -->
	<?php } ?>
	<?php if ( has_post_thumbnail() && !is_single() ) { ?>
		<figure class="post-featured-image">
			<a title="<?php the_title_attribute(); ?>" href="<?php the_permalink(); ?>"><?php the_post_thumbnail(); ?></a>
		</figure><!-- .post-featured-image -->
	<?php } ?>
	<div class="entry-content">
		<?php 
		if ( is_single() ) {

			the_content();

		} else {

			if ( !has_post_format( 'link' ) && !has_post_format( 'quote' ) ) {

				the_excerpt();

				if ( str_word_count( strip_tags( get_the_content() ) ) > str_word_count( get_the_excerpt() ) ) { ?>
					<a href="<?php the_permalink(); ?>" class="readmore"><?php esc_html_e('Read More','foliopress'); ?></a>
				<?php }

			} else {
				the_content();
			}
		} ?>
	</div><!-- .entry-content -->
	<?php
	if ( is_single() ) {
		echo get_the_tag_list('<footer class="entry-meta"><span class="tag-links">', ', ', '</span><!-- .tag-links --></footer><!-- .entry-meta -->');
	}
	wp_link_pages( array(
		'before' 			=> '<div class="page-links">' . esc_html__( 'Pages: ', 'foliopress' ),
		'separator'			=> '',
		'link_before'		=> '<span>',
		'link_after'		=> '</span>',
		'after'				=> '</div>'
	) ); ?>
</div><!-- .post -->
<?php } ?>