<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package streamers
 */

get_header(); ?>

	<section id="primary" class="content-area">
		<main id="main" class="site-main">

			<div class="search-results-wrapper">
				
				<div class="container--big align-center">

				<?php
					if ( have_posts() ) : ?>

					<div class="streamers-filtering">
						<header class="page-header">
							<h1 class="page-title"><?php
								/* translators: %s: search query. */
								printf( esc_html__( 'Streamer Results', 'streamers' ));
							?></h1>
							<span class="search-results"><?php
								/* translators: %s: search query. */
								printf( esc_html__( 'Searched by: %s', 'streamers' ), '<span>' . get_search_query() . '</span>' );
							?></span>
						</header><!-- .page-header -->

						<ul class="streamers-ul">

							<?php
							/* Start the Loop */
							while ( have_posts() ) : the_post();

								/**
								 * Run the loop for the search to output the results.
								 * If you want to overload this in a child theme then include a file
								 * called content-search.php and that will be used instead.
								 */
								get_template_part( 'template-parts/content', 'search' );

							endwhile;
							?>
						</ul>

						<?php
						
							the_posts_navigation(array(
								'prev_text' => __(  '&#x27F5; Previous', 'streamers' ),
								'next_text' => __( 'Next &#x27F6;', 'streamers' ),
							));

						else :

							get_template_part( 'template-parts/content', 'none' ); ?>

					</div>

					<?php
						endif; ?>

				</div>

			</div>

		</main><!-- #main -->
	</section><!-- #primary -->

<?php
get_footer();
