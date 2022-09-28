<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package streamers
 */

?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer">
		<div class="site-info">
			<div class="info-inner">
				<nav id="footer-navigation" class="footer-navigation">
					<?php
					wp_nav_menu( array(
						'theme_location' => 'menu-2',
						'menu_id'        => 'secundary-menu',
						'menu_class'     => 'secundary-menu',
						'container'      => false
					) );
					?>
				</nav><!-- #site-navigation -->
				<div class="col-contact__icons-wrap">
					<?php if ( get_field('add_facebook_url', 'options') ) : ?>
						<a class="sn-icon" href="<?php echo get_field('add_facebook_url', 'options'); ?>" target="_blank" rel=”noopener”><span class="font-facebook"></span></a>
					<?php endif; ?>
					<?php if ( get_field('add_linkedin_url', 'options') ) : ?>
						<a class="sn-icon" href="<?php echo get_field('add_linkedin_url', 'options'); ?>" target="_blank" rel=”noopener”><span class="font-linkedin"></span></a>
					<?php endif; ?>
					<?php if ( get_field('add_twitter_url', 'options') ) : ?>
						<a class="sn-icon" href="<?php echo get_field('add_twitter_url', 'options'); ?>" target="_blank" rel=”noopener”><span class="font-twitter"></span></a>
					<?php endif; ?>
					<?php if ( get_field('add_instagram_url', 'options') ) : ?>
						<a class="sn-icon" href="<?php echo get_field('add_instagram_url', 'options'); ?>" target="_blank" rel=”noopener”><span class="font-instagram"></span></a>
					<?php endif; ?>
				</div>
			</div>
		</div>

		<div class="copyright">
			All rights and copyrights reserved to Madskil Gaming ltd | All trademarks and registred trademarks are the property of their respective owners | Design by <a href="https://www.popwebdesign.net/index_eng.html" title="Digital agency">Popart Studio</a>.
		</div><!-- .copyright -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>