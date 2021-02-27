<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
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

		<?php
		if ( have_posts() ) :

			if ( $foliopress_settings['foliopress_post_layout'] != 'list_view') { ?> 
				<div class="row post-grid">
			<?php } 

			/* Start the Loop */
			while ( have_posts() ) :
				the_post();

				/*
				 * Include the Post-Type-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Type name) and that will be used instead.
				 */
				get_template_part( 'template-parts/content', get_post_format() );

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
