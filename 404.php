<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package streamers
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">

			<div class="error-page-wrapper">
				<section class="error-404 not-found container--medium align-center">
					<header class="page-header">
						<h1 class="page-title"><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'streamers' ); ?></h1>
					</header><!-- .page-header -->

					<div class="page-content">
						<p><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'streamers' ); ?></p>

						<div class="search-component">
							<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ) ?>">
								<label>
									<span class="screen-reader-text"><?php _x( 'Search for:', 'label' )?></span>
									<input type="search" class="search-field" placeholder="<?php echo esc_attr_x( 'Search here for a streamer...', 'placeholder' ) ?>" value="<?php echo get_search_query() ?>" name="s" />
								</label>
								<button type="submit" class="search-submit"><span class="font-search"></span></button>
							</form>
						</div>

					</div><!-- .page-content -->
				</section><!-- .error-404 -->
			</div>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
