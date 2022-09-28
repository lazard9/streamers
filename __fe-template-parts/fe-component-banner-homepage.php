<div class="banner-homepage" style="background-image: url(<?php echo get_stylesheet_directory_uri(); ?>/assets/images/banner-homepage.png);">
	<div class="banner-homepage-caption">
		<h1>
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>">
				<img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/logo.png" alt="Streamers.Zone" />
				<!-- Streamers<span></span>Zone -->
			</a>
		</h1>
		<p>Streamers.Zone is <span>the premier database</span> for all things streaming!</p>
		<div class="search-component">
			<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ) ?>">
				<label>
					<span class="screen-reader-text"><?php _x( 'Search for:', 'label' )?></span>
					<input type="search" class="search-field" placeholder="<?php echo esc_attr_x( 'Search here for a streamer...', 'placeholder' ) ?>" value="<?php echo get_search_query() ?>" name="s" />
				</label>
				<button type="submit" class="search-submit"><span class="font-search"></span></button>
			</form>
		</div>
	</div>
</div><!-- .banner-example -->