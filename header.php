<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package streamers
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<link rel="icon" type="image/png" href="<?php echo get_template_directory_uri(); ?>/favicon.jpg"/>

	<?php wp_head(); ?>
</head>

<body <?php body_class(); if(is_front_page()) {echo ' itemscope itemtype="https://schema.org/WebSite"';} elseif(is_page()) {echo ' itemscope itemtype="https://schema.org/WebPage"';} elseif(is_home()) {echo ' itemscope itemtype="http://schema.org/Blog"';} ?>>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'streamers' ); ?></a>

	<header id="masthead" class="site-header">
		<?php if ( ! is_front_page() && ! is_page('filter-streamers') ): ?>
			<div class="header-content container--medium">
				<a class="site-branding" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
					<img src="<?php echo get_template_directory_uri(); ?>/assets/images/logo.png" alt="<?php bloginfo( 'name' ); ?> Logo" title="<?php bloginfo( 'name' ); ?>">
				</a><!-- .site-branding -->
				
				<div class="header-search">
					<div class="search-position">
						<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ) ?>">
							<label>
								<span class="screen-reader-text"><?php _x( 'Search for:', 'label' )?></span>
								<input type="search" class="search-field" placeholder="<?php echo esc_attr_x( 'Type to search...', 'placeholder' ) ?>" value="<?php echo get_search_query() ?>" name="s" />
							</label>
							<button type="submit" class="search-submit"><span class="font-search"></span></button>
						</form>
						<span id="toggle-search" class="font-search toggle-search"></span>
					</div>			
				</div>
				
			</div>
		<?php endif; ?>
	</header><!-- #masthead -->

	<div id="content" class="site-content">
