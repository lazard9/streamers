<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package streamers
 */

get_header();
?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">

			<div class="archive-results-wrapper">
				
				<div class="container--big align-center">

				<?php if ( have_posts() ) : ?>

					<div class="streamers-filtering">
						<header class="page-header">
							<?php
							the_archive_title( '<h1 class="page-title">', '</h1>' );
							the_archive_description( '<div class="archive-description">', '</div>' );
							?>
						</header><!-- .page-header -->

						<ul class="streamers-ul">

							<?php
							/* Start the Loop */
							while ( have_posts() ) :
								the_post();

								/*
								* Include the Post-Type-specific template for the content.
								* If you want to override this in a child theme, then include a file
								* called content-___.php (where ___ is the Post Type name) and that will be used instead.
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

						</ul>

					</div>		

				<?php
					endif;
					?>

				</div>

			</div>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
