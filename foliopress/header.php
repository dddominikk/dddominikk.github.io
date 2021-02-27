<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package FolioPress
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="profile" href="http://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php global $foliopress_settings;
$foliopress_settings = foliopress_get_option_defaults(); ?>

<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'foliopress' ); ?></a>
	<?php if (has_header_video() || has_header_image())  {
			the_custom_header_markup();
	} ?>
	<header id="masthead" class="site-header">
		<nav class="navbar navbar-expand-lg <?php echo ( $foliopress_settings['foliopress_header_fixed'] == 1 ) ? "fixed-top" : "";?>">
			<div class="container<?php echo ( $foliopress_settings['foliopress_header_fluid'] === 1 && $foliopress_settings['foliopress_site_layout'] === 'wide' ) ? "-fluid" : "";?>">
				<div class="site-branding navbar-brand">
					<?php
					the_custom_logo();
					if ( is_home() ) :
						?>
						<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
						<?php
					else :
						?>
						<h2 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h2>
						<?php
					endif;
					$foliopress_description = get_bloginfo( 'description', 'display' );
					if ( $foliopress_description || is_customize_preview() ) :
						?>
						<p class="site-description"><?php echo $foliopress_description; /* WPCS: xss ok. */ ?></p>
					<?php endif; ?>
				</div><!-- .site-branding .navbar-brand -->
				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="<?php esc_attr_e('Toggle navigation', 'foliopress'); ?>"></button>
				<div class="collapse navbar-collapse" id="navbarCollapse">
					<div id="site-navigation" class="main-navigation ml-lg-auto d-lg-flex" role="navigation">
						<?php
						if (has_nav_menu('primary')) {
							wp_nav_menu( array(
								'theme_location' 	=> 'primary',
								'container'			=> '',
								'items_wrap'		=> '<ul class="nav-menu navbar-nav d-lg-block">%3$s</ul>',
							) );
						} else {
							wp_page_menu( array(
								'before' 		=> '<ul class="nav-menu navbar-nav d-lg-block">',
								'after' 			=> '</ul>',
							) );
						}
						?>
						<?php
						if ( $foliopress_settings['foliopress_hide_search'] == 0 ) { ?>
							<div class="d-none d-lg-flex">
								<span class="search-toggle"></span>
							</div><!-- .navbar-search -->
						<?php } ?>
					</div><!-- #site-navigation .main-navigation -->
				</div>
			</div>
		</nav><!-- .navbar -->
		<?php if ( (has_post_thumbnail() && $foliopress_settings['foliopress_featured_image'] === 1) && (is_page() || is_single()) ) { ?>
			<div class="page-single-featured-image" style="background-image:url('<?php echo esc_url( get_the_post_thumbnail_url() ) ?>');"></div>
		<?php } ?>
		<?php if ( !is_front_page() && function_exists('bcn_display') ) { ?>
			<div class="page-title-wrap">
				<div class="container">
					<div class="breadcrumb">
						<?php bcn_display(); ?>
					</div> <!-- .breadcrumb -->
				</div><!-- .container -->
			</div><!-- .page-title-wrap -->
		<?php } ?>
		<?php
		if ( is_home() ) {
			if ( $foliopress_settings['foliopress_my_info_title'] != '' || $foliopress_settings['foliopress_my_desc'] != '' ) { ?>
				<div class="my-info<?php echo ($foliopress_settings['foliopress_post_layout'] != 'grid_view') ? " my-info-list-view" : ""; ?>">
					<div class="container">
						<div class="row justify-content-center">
							<?php if ( $foliopress_settings['foliopress_my_avatar'] != '') { ?>
								<div class="col-4 col-sm-3 col-lg-2">
									<img alt="<?php esc_attr_e( 'My Avatar', 'foliopress' );?>" src="<?php echo esc_url($foliopress_settings['foliopress_my_avatar']); ?>">
							</div>
							<?php }
							if ( $foliopress_settings['foliopress_my_info_title'] != '' || $foliopress_settings['foliopress_my_desc'] != '' ) { ?>
								<div class="col-sm-9 col-lg-8 text-center text-sm-left">
									<?php if ( $foliopress_settings['foliopress_my_info_title'] != '' ) { ?>
										<h2 class="entry-title"><?php echo esc_html($foliopress_settings['foliopress_my_info_title']) ?></h2>
									<?php } ?>
									<?php if ( $foliopress_settings['foliopress_my_desc'] != '' ) { ?>
										<p><?php echo esc_html($foliopress_settings['foliopress_my_desc']) ?></p>
									<?php } ?>
									<?php echo ($foliopress_settings['foliopress_social_profiles'] != '' && $foliopress_settings['foliopress_my_info_social'] == 0) ? esc_html(foliopress_social_profiles()) : ""; ?>
								</div>
							<?php } ?>
						</div><!-- .row -->
					</div><!-- .container -->
				</div><!-- .my-info -->
			<?php	}
		} ?>
	</header><!-- #masthead -->

	<div id="content" class="site-content">
		<?php if ( is_home() || is_archive() ) { ?>
			<div class="container">
				<?php if ( $foliopress_settings['foliopress_post_layout'] == 'list_view' ) { ?>
					<div class="row justify-content-center">
				<?php }
		} else { ?>
		<div class="container">
			<div class="row justify-content-center">
		<?php	} ?>
