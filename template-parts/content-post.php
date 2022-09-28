<?php
/**
 * Template part for displaying posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package streamers
 */

?>

<?php if( have_rows('streamer_card') ): ?>
	<?php while( have_rows('streamer_card') ): the_row(); ?>
		<?php
			$url_check = get_sub_field('streaming_url');
			if (strpos($url_check,'twitch') !== false) {
				$partner = 'Twitch';
			} elseif (strpos($url_check,'youtube') !== false) {
				$partner = 'YouTube';
			} elseif (strpos($url_check,'mixer') !== false) {
				$partner = 'Mixer';
			}
		
			if ( get_sub_field('streamer_profile_picture') ) {
				$streamer_profile_picture = get_sub_field('streamer_profile_picture');
				$streamer_profile_url = esc_url($streamer_profile_picture['url']);
			} else {
				$streamer_profile_url = get_template_directory_uri() . '/assets/images/streamer-placeholder.jpg';
			}
			
		?>
		<li class="streamer-li">
			<article id="post-<?php the_ID(); ?>" <?php post_class( 'streamer-article streamer-' . strtolower($partner) ); ?>   style="background-image: url(<?php echo $streamer_profile_url; ?>);" itemscope itemtype="http://schema.org/Article">
				<a class="" href="<?php the_permalink(); ?>">
					<div class="player-info">
						<div class="name">
							<?php                        
							$streamer_logo = get_sub_field('streamer_logo');
							if( !empty( $streamer_logo ) ): ?>
								<img src="<?php echo esc_url($streamer_logo['url']); ?>" alt="<?php the_sub_field('streamer_nick_name'); ?> streamer logo" width="24" height="28" />
							<?php endif; ?>
							<div>
								<span><?php the_sub_field('streamer_nick_name'); ?></span>
									<?php if( have_rows('streamer_info') ) : ?>
									<?php while( have_rows('streamer_info') ): the_row(); ?>
										<span><?php the_sub_field('real_name'); ?></span>
									<?php endwhile;?>
								<?php endif; ?>
							</div>
						</div>
						<?php if ( get_sub_field('streaming_url') ) : ?>
							<div class="platform-<?php echo strtolower($partner); ?>">
								<span class="font-<?php echo strtolower($partner); ?>"></span>
								<span class="platform"><?php echo $partner; ?></span>
							</div>
						<?php endif; ?>
					</div>
				</a>
			</article>
		</li>
	<?php endwhile; ?>
<?php endif; ?>
