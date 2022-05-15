<?php
/**
 * Template part for displaying a message that posts cannot be found
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package streamers
 */

?>

<section class="no-results not-found">
	<header class="page-header">
		<h1 class="page-title"><?php esc_html_e( 'Nothing Found', 'streamers' ); ?></h1>
	</header><!-- .page-header -->

	<div class="page-content">
		<?php
		if ( is_home() && current_user_can( 'publish_posts' ) ) :

			printf(
				'<p>' . wp_kses(
				/* translators: 1: link to WP admin new post page. */
					__( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'streamers' ),
					array(
						'a' => array(
							'href' => array(),
						),
					)
				) . '</p>',
				esc_url( admin_url( 'post-new.php' ) )
			);

		elseif ( is_search() ) :
			?>

			<p><?php esc_html_e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'streamers' ); ?></p>
			<div class="search-component">
				<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ) ?>">
					<label>
						<span class="screen-reader-text"><?php _x( 'Search for:', 'label' )?></span>
						<input type="search" class="search-field" placeholder="<?php echo esc_attr_x( 'Search here for a streamer...', 'placeholder' ) ?>" value="<?php echo get_search_query() ?>" name="s" />
					</label>
					<button type="submit" class="search-submit"><span class="font-search"></span></button>
				</form>
			</div>
		
		<?php
		else :
			?>

			<p><?php esc_html_e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'streamers' ); ?></p>
			<div class="search-component">
				<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ) ?>">
					<label>
						<span class="screen-reader-text"><?php _x( 'Search for:', 'label' )?></span>
						<input type="search" class="search-field" placeholder="<?php echo esc_attr_x( 'Search here for a streamer...', 'placeholder' ) ?>" value="<?php echo get_search_query() ?>" name="s" />
					</label>
					<button type="submit" class="search-submit"><span class="font-search"></span></button>
				</form>
			</div>
			
		<?php
		endif;
		?>
	</div><!-- .page-content -->
</section><!-- .no-results -->
