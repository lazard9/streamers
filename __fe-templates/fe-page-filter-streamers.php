<?php
/**
 * Template Name: Filter Streamers
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package streamers
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">

			<?php
			get_template_part( '__fe-template-parts/fe-component', 'banner-homepage' );
			get_template_part( '__fe-template-parts/fe-component', 'streamers-filter' );
			?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
