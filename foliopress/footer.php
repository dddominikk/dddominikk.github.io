<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package FolioPress
 */

?>
		<?php global $foliopress_settings; ?>

		<?php if ( is_home() || is_archive() ) { 
			if ( $foliopress_settings['foliopress_post_layout'] == 'list_view' ) { ?>
				</div><!-- row -->
			<?php }
		} else { ?>
			</div><!-- row -->
		<?php	} ?>
		</div><!-- .container -->
	</div><!-- #content .site-content-->
	<footer id="colophon" class="site-footer clearfix" role="contentinfo">
		<?php if ( is_active_sidebar('foliopress_footer_sidebar') || is_active_sidebar('foliopress_footer_column2') || is_active_sidebar('foliopress_footer_column3') ) { ?>
			<div class="widget-area">
				<div class="container">
					<div class="row">
						<div class="col-md-6 col-lg">
							<?php
								// Calling the Footer Sidebar Column 1
								if ( is_active_sidebar( 'foliopress_footer_sidebar' ) ) :
									dynamic_sidebar( 'foliopress_footer_sidebar' );
								endif;
							?>
						</div><!-- footer sidebar column 1 -->
						<div class="col-md-6 col-lg">
							<?php
								// Calling the Footer Sidebar Column 2
								if ( is_active_sidebar( 'foliopress_footer_column2' ) ) :
									dynamic_sidebar( 'foliopress_footer_column2' );
								endif;
							?>
						</div><!-- footer sidebar column 2 -->
						<div class="col-md-6 col-lg">
							<?php
								// Calling the Footer Sidebar Column 3
								if ( is_active_sidebar( 'foliopress_footer_column3' ) ) :
									dynamic_sidebar( 'foliopress_footer_column3' );
								endif;
							?>
						</div><!-- footer sidebar column 3 -->
					</div><!-- .row -->
				</div><!-- .container -->
			</div><!-- .widget-area -->
		<?php } ?>
		<div class="site-info">
			<div class="container<?php echo ( $foliopress_settings['foliopress_footer_fluid'] === 1 && $foliopress_settings['foliopress_site_layout'] === 'wide' ) ? "-fluid" : "" ;?>">
				<div class="row">
					<?php if ( $foliopress_settings['foliopress_social_profiles'] != '' && $foliopress_settings['foliopress_footer_social'] == 0 ) { ?>
						<div class="<?php echo ( $foliopress_settings['foliopress_footer_info_center'] == 0 ) ? "col-lg-auto order-lg-2" : "col-12" ;?> ml-auto">
							<?php echo esc_html( foliopress_social_profiles() ); ?>
						</div>
					<?php } ?>
					<div class="copyright <?php echo ( $foliopress_settings['foliopress_footer_info_center'] == 0 ) ? "col-lg order-lg-1 text-lg-left" : "col-12" ;?>">
						<div class="theme-link">
							<?php echo esc_html__('Copyright &copy; ','foliopress') . foliopress_the_year() . foliopress_site_link(); ?>
						</div>
						<?php if ( get_privacy_policy_url() !== '' && function_exists('the_privacy_policy_link')) {
							the_privacy_policy_link('<div class="privacy-link">', '</div>');
						}
						echo foliopress_author_link() . foliopress_wp_link(); ?>
					</div><!-- .copyright -->
				</div><!-- .row -->
			</div><!-- .container -->
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
	<div class="back-to-top"><a title="<?php esc_attr_e('Go to Top','foliopress');?>" href="#masthead"></a></div>
	<div class="search-block off">
		<div class="search-toggle"></div>
		<?php get_search_form(); ?>
	</div><!-- .search-block -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
