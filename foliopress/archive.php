<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package FolioPress
 */

get_header();
	
if ( $foliopress_settings['foliopress_post_layout'] != 'grid_view') { 
	foliopress_layout_primary();
} ?>
		<main id="main" class="site-main">

		<?php if ( have_posts() ) : ?>

			<header class="page-header">
				<?php
				the_archive_title( '<h1 class="page-title">', '</h1>' );
				the_archive_description( '<div class="archive-description">', '</div>' );
				?>
			</header><!-- .page-header -->
			
			<?php if ( $foliopress_settings['foliopress_post_layout'] != 'list_view') { ?> 
				<div class="row glutter-14 post-grid">
			<?php } 

			/* Start the Loop */
			while ( have_posts() ) :
				the_post();

				/*
				 * Include the Post-Type-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Type name) and that will be used instead.
				 */
				get_template_part( 'template-parts/content', get_post_type() );

			endwhile;

			if ( $foliopress_settings['foliopress_post_layout'] != 'list_view') { ?> 
				</div>
			<?php } 

			if ( function_exists('wp_pagenavi' ) ) :
				wp_pagenavi();
			else: 
				the_posts_navigation();
			endif;

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif;
		?>

		</main><!-- #main -->
	<?php if ( $foliopress_settings['foliopress_post_layout'] != 'grid_view') { ?> 	
		</div><!-- #primary -->
	<?php } ?>

<?php
do_action('foliopress_sidebar');
get_footer();
