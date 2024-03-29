<!-- Template part: Streamer Load More - similar to Filter!!! -->

<div class="streamers-filter-wrapper">

	<div class="container--big align-center">

		<?php if( class_exists('ACF') ) : ?>

			<div class="streamers-filtering">

				<?php
					$args_gc = array(
						'post_type' => 'post',
						'posts_per_page' => 500,
						'post_status' => 'publish',
						'ignore_sticky_posts' => true,
					);

					$loop_gc = new WP_Query($args_gc);

				if( $loop_gc->have_posts() ) : 
					while ($loop_gc->have_posts()) : $loop_gc->the_post();
						if( have_rows('streamer_card') ):
							while( have_rows('streamer_card') ): the_row();
							
								$url_check = get_sub_field('streaming_url');
								if (strpos($url_check,'twitch') !== false) {
									$platforms = 'Twitch';
								} elseif (strpos($url_check,'youtube') !== false) {
									$platforms = 'YouTube';
								} elseif (strpos($url_check,'mixer') !== false) {
									$platforms = 'Mixer';
								}

								$platforms_wsp[] = $platforms;
								
								$games_wsp[] = trim ( ( get_sub_field ('streamer_game') ) );
									
								$country_arr = get_sub_field ('streamer_country');
								$countrys_wsp[] = $country_arr[label];
								
							endwhile;
						endif;
					endwhile;
					?>

					<h2 class="fltr-title">Browse Streamers</h2>
					<span class="featured">FEATURED STREAMERS</span>
					
					<div class="filter-by">
						<span class="filters">Filters</span>
						<ul>
							<li>
								<div class="dropdown">
									<button id="buttonDropdown4" class="dropbtn">PLATFORM <span>&#x25BE;</span></button>
									<div><span id="selectedPlatform" class="filter-selection">Showing all</span></div>
									<div id="myDropdown4" class="dropdown-content">
										<div>
											<span class="font-search"></span>
											<input type="text" placeholder="Search.." id="myInput4" class="myImputStyle">
										</div>
										<a class="btn4 cat-button1 active1" data-btn="btn1" data-target="cat-all">Show all</a>
										<?php
										$platforms_unique = array_unique ($platforms_wsp);
										sort ($platforms_unique);
										foreach ( $platforms_unique as $platforms ) {
											if($platforms !== '') {
												$platforms_cat = strtolower( $platforms );	
												echo '<a class="btn4 cat-button1" data-btn="btn1" data-target="cat-'.$platforms_cat.'">';
												echo $platforms;
												echo '</a>';
											}
										}
										?>
									</div>
								</div>
							</li>
							<li>
								<div class="dropdown">
									<button id="buttonDropdown5" class="dropbtn">GAME <span>&#x25BE;</span></button>
									<div><span id="selectedGame" class="filter-selection">Showing all</span></div>
									<div id="myDropdown5" class="dropdown-content">
										<div>
											<span class="font-search"></span>
											<input type="text" placeholder="Search.." id="myInput5" class="myImputStyle">
										</div>
										<a class="btn5 cat-button2 active2" data-btn="btn2" data-target="cat-all">Show all</a>
										<?php
										$games_unique = array_unique ($games_wsp);
										sort ($games_unique);
										foreach ( $games_unique as $game ) {
											if($game !== '') {
												$game_cat = strtolower( trim( preg_replace("/[^a-zA-Z0-9]/", "-", $game) ) );	
												echo '<a class="btn5 cat-button2" data-btn="btn2" data-target="cat-'.$game_cat.'">';
												echo $game;
												echo '</a>';
											}
										}
										?>
									</div>
								</div>
							</li>
							<li>
								<div class="dropdown">
									<button id="buttonDropdown6" class="dropbtn">COUNTRY <span>&#x25BE;</span></button>
									<div><span id="selectedCountry" class="filter-selection">Showing all</span></div>
									<div id="myDropdown6" class="dropdown-content">
										<div>
											<span class="font-search"></span>
											<input type="text" placeholder="Search.." id="myInput6" class="myImputStyle">
										</div>
										<a class="btn6 cat-button3 active3" data-btn="btn3" data-target="cat-all">Show all</a>
										<?php
										$countrys_unique = array_unique ($countrys_wsp);
										sort ($countrys_unique);
										foreach ( $countrys_unique as $country ) {
											if($country !== '') {
												$country_cat = strtolower( trim( preg_replace("/[^a-zA-Z0-9]/", "-", $country ) ) );	
												echo '<a class="btn6 cat-button3" data-btn="btn3" data-target="cat-'.$country_cat.'">';
												echo $country;
												echo '</a>';
											}
										}
										?>
									</div>
								</div>
							</li>
						</ul>
					</div>
				<?php endif; ?>

				<?php
				$args_st = array(
					'post_type' => 'post',
					'posts_per_page' => 7,
					'meta_key' => 'ordinal_number',
					'orderby' => 'meta_value_num',
					'order' => 'asc',
					'post_status' => 'publish',
					'post__in' => get_option( 'sticky_posts' ),
					//'ignore_sticky_posts' => true,
				);

				$loop_st = new WP_Query($args_st);

				if( $loop_st->have_posts() ) : 
				?>
					<ul id="ajax-posts" class="streamers-ul filter-cat-results">
						<?php

						while ($loop_st->have_posts()) : $loop_st->the_post();

						?>
						<?php if( have_rows('streamer_card') ): ?>
							<?php while( have_rows('streamer_card') ): the_row();
								
								$url_check = get_sub_field('streaming_url');
								if (strpos($url_check,'twitch') !== false) {
									$partner = 'Twitch';
								} elseif (strpos($url_check,'youtube') !== false) {
									$partner = 'YouTube';
								} elseif (strpos($url_check,'mixer') !== false) {
									$partner = 'Mixer';
								}
								
								$game_wsp = trim( get_sub_field('streamer_game') );
								$game = preg_replace("/[^a-zA-Z0-9]/", "-", $game_wsp);
								
								$country_arr = get_sub_field('streamer_country');
								$country_wsp = $country_arr[label];
								$country = preg_replace("/[^a-zA-Z0-9]/", "-", $country_wsp);
							
								if ( get_sub_field('streamer_profile_picture') ) {
									$streamer_profile_picture = get_sub_field('streamer_profile_picture');
									$streamer_profile_url = esc_url($streamer_profile_picture['url']);
								} else {
									$streamer_profile_url = get_template_directory_uri() . '/assets/images/streamer-placeholder.jpg';
								}									
									
								?>
								<li class="streamer-li">
									<article  id="post-<?php the_ID(); ?>" <?php post_class( 'streamer-article streamer-' . strtolower($partner) ); ?> style="background-image: url(<?php echo $streamer_profile_url; ?>);">
										<a href="<?php the_permalink(); ?>">
											<div class="player-info">
												<div class="name">
													<?php                        
													$streamer_logo = get_sub_field('streamer_logo');
													if( !empty( $streamer_logo ) ): ?>
														<img src="<?php echo esc_url($streamer_logo['url']); ?>" alt="<?php the_sub_field('streamer_nick_name'); ?> streamer logo" width="24" height="28" />
													<?php endif; ?>
													<div>
														<span><!--<?php the_title(); ?>--><?php the_sub_field('streamer_nick_name'); ?></span>
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
						<?php 
							endwhile;
							wp_reset_postdata();
						?>
						<li class="streamer-li last-element">
							<div class="streamer-article">
								<div class="suggest-creator">
									<span class="cant-find">Can't find the <span>streamer</span> you are looking for?</span>
									<button type="button" class="js-modal" data-modal="modal-homepage">SUGGEST A CREATOR</button>
								</div>
							</div>
						</li>
					</ul>

					<button id="more_posts" class="load-more" data-category="1" type="button">LOAD MORE</button>

				<?php endif; ?>
			</div>
		<?php endif; ?>
	</div>
</div>

<!-- Modal -->
<div id="modal-homepage" class="modal">
    <div class="modal-inner" style="min-height: 300px;">
        <a class="js-close-modal">×</a>

        <div class="modal-content">
            <p>Sorry we weren't able to find the Streamer that you were looking for.</p>
			<p>Let us know below so we can add them!</p>
        </div>

        <div class="modal-form">
            <?php echo do_shortcode( '[contact-form-7 id="11" title="Contact form 1"]' ); ?>
        </div>
    </div><!-- .modal-inner -->
</div><!-- .modal -->


