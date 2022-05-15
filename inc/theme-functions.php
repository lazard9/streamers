<?php
/**
 * Custom pagination
 */
if ( ! function_exists( 'streamers_paging_nav' ) ) :
function streamers_paging_nav() {
	global $wp_query, $wp_rewrite;

	// Don't print empty markup if there's only one page.
	if ( $wp_query->max_num_pages < 2 ) {
		return;
	}

	$paged        = get_query_var( 'paged' ) ? intval( get_query_var( 'paged' ) ) : 1;
	$pagenum_link = html_entity_decode( get_pagenum_link() );
	$query_args   = array();
	$url_parts    = explode( '?', $pagenum_link );

	if ( isset( $url_parts[1] ) ) {
		wp_parse_str( $url_parts[1], $query_args );
	}

	$pagenum_link = remove_query_arg( array_keys( $query_args ), $pagenum_link );
	$pagenum_link = trailingslashit( $pagenum_link ) . '%_%';

	$format  = $wp_rewrite->using_index_permalinks() && ! strpos( $pagenum_link, 'index.php' ) ? 'index.php/' : '';
	$format .= $wp_rewrite->using_permalinks() ? user_trailingslashit( $wp_rewrite->pagination_base . '/%#%', 'paged' ) : '?paged=%#%';

	// Set up paginated links.
	$links = paginate_links( array(
		'base'     => $pagenum_link,
		'format'   => $format,
		'total'    => $wp_query->max_num_pages,
		'current'  => $paged,
		'mid_size' => 3,
		'add_args' => array_map( 'urlencode', $query_args ),
		'prev_text' => __( 'Prev', 'streamers' ),
		'next_text' => __( 'Next', 'streamers' ),
	) );

	if ( $links ) :

		?>
		<nav class="navigation paging-navigation" role="navigation">
			<div class="pagination loop-pagination">
				<?php echo $links; ?>
			</div><!-- .pagination -->
		</nav><!-- .navigation -->
		<?php
	endif;
}
endif;

// Flush Permalinks Automatically while in development
if ($_SERVER['HTTP_HOST'] == 'localhost' || $_SERVER['HTTP_HOST'] == 'popartcode.space') {
	add_action('init', 'flush_permalinks_for_dev' );
	function flush_permalinks_for_dev() {
		flush_rewrite_rules();
	}
}

if( function_exists('acf_add_options_page') ) {

	acf_add_options_page(array(
		'page_title' 	=> 'Theme Settings',
		'menu_title'	=> 'Theme Settings',
		'menu_slug' 	=> 'theme-settings',
		'capability'	=> 'edit_posts',
		'redirect'		=> false
	));
}


// Ajax load more
add_action( 'wp_enqueue_scripts', 'my_script_enqueuer' );

function my_script_enqueuer() {
    wp_localize_script( 'streamers-site-js', 'ajax_posts', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ) ) );
}

/*wp_localize_script( 'streamers-site-js', 'ajax_posts', array(
    'ajaxurl' => admin_url( 'admin-ajax.php' ),
    'noposts' => __('No older posts found', 'streamers'),
));*/

function more_post_ajax() {

    $ppp = (isset($_POST["ppp"])) ? $_POST["ppp"] : 4;
    $page = (isset($_POST['pageNumber'])) ? $_POST['pageNumber'] : 0;

    header("Content-Type: text/html");

    $args = array(
        'suppress_filters' => true,
        'post_type' => 'post',
		'orderby' => array( 'ID' => 'DESC' ),
        'posts_per_page' => $ppp,
        'paged' => $page,
		'post_status' => 'publish',
		'ignore_sticky_posts' => true,
		'post__not_in' => get_option( 'sticky_posts' ),
    );

    $loop = new WP_Query($args);

    $out = '';

    if ($loop -> have_posts()) :  while ($loop -> have_posts()) : $loop -> the_post(); ?>

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
					<div class="streamer-article streamer-<?php echo strtolower($partner); ?>"  style="background-image: url(<?php echo $streamer_profile_url; ?>);">
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
					</div>
				</li>
			<?php endwhile; ?>
		<?php endif; ?>
	<?php
    endwhile;
    endif;
    wp_reset_postdata();
    die($out);
}

add_action('wp_ajax_nopriv_more_post_ajax', 'more_post_ajax');
add_action('wp_ajax_more_post_ajax', 'more_post_ajax');


/**
 * Extend WordPress search to include custom fields
 *
 * https://adambalee.com
 */

/**
 * Join posts and postmeta tables
 *
 * http://codex.wordpress.org/Plugin_API/Filter_Reference/posts_join
 */
function cf_search_join( $join ) {
    global $wpdb;

    if ( is_search() ) {    
        $join .=' LEFT JOIN '.$wpdb->postmeta. ' ON '. $wpdb->posts . '.ID = ' . $wpdb->postmeta . '.post_id ';
    }

    return $join;
}
//add_filter('posts_join', 'cf_search_join' );

/**
 * Modify the search query with posts_where
 *
 * http://codex.wordpress.org/Plugin_API/Filter_Reference/posts_where
 */
function cf_search_where( $where ) {
    global $pagenow, $wpdb;

    if ( is_search() ) {
        $where = preg_replace(
            "/\(\s*".$wpdb->posts.".post_title\s+LIKE\s*(\'[^\']+\')\s*\)/",
            "(".$wpdb->posts.".post_title LIKE $1) OR (".$wpdb->postmeta.".meta_value LIKE $1)", $where );
    }

	/*echo '<pre>';
	print_r($where);
	echo '</pre>';*/
    return $where;
}
//add_filter( 'posts_where', 'cf_search_where' );

/**
 * Prevent duplicates
 *
 * http://codex.wordpress.org/Plugin_API/Filter_Reference/posts_distinct
 */
function cf_search_distinct( $where ) {
    global $wpdb;

    if ( is_search() ) {
        return "DISTINCT";
    }

    return $where;
}
//add_filter( 'posts_distinct', 'cf_search_distinct' );

/**
 * Add the custom columns to the Consulting post type.
 */
add_filter( 'manage_post_posts_columns', 'set_custom_edit_post_columns' );
function set_custom_edit_post_columns($columns) {
    $columns['ordinal_number'] = __( 'Ordinal Number', 'streamers' );

    return $columns;
}

/*
 * Add columns to exhibition post list
 */
add_action ( 'manage_post_posts_custom_column', 'custom_post_column', 10, 2 );
function custom_post_column ( $column, $post_id ) {
  switch ( $column ) {
    case 'ordinal_number':
      echo get_post_meta ( $post_id, 'ordinal_number', true );
    break;
  }
}

/*
 * If single result redirect search result page to post
 */
add_action( 'template_redirect', 'fb_single_result' );
function fb_single_result() {

    if (is_search()) {
        global $wp_query;

        if ( 1 === $wp_query->post_count ) {
            wp_redirect( get_permalink( $wp_query->posts['0']->ID ) );
            exit();
        }
    }
}

/**
 * Search SQL filter for matching against post title only.
 *
 * @link    http://wordpress.stackexchange.com/a/11826/1685
 *
 * @param   string      $search
 * @param   WP_Query    $wp_query
 */
function wpse_11826_search_by_title( $search, $wp_query ) {
    if ( ! empty( $search ) && ! empty( $wp_query->query_vars['search_terms'] ) ) {
        global $wpdb;

        $q = $wp_query->query_vars;
        $n = ! empty( $q['exact'] ) ? '' : '%';

        $search = array();

        foreach ( ( array ) $q['search_terms'] as $term )
            $search[] = $wpdb->prepare( "$wpdb->posts.post_title LIKE %s", $n . $wpdb->esc_like( $term ) . $n );

        if ( ! is_user_logged_in() )
            $search[] = "$wpdb->posts.post_password = ''";

        $search = ' AND ' . implode( ' AND ', $search );
    }

    return $search;
}

add_filter( 'posts_search', 'wpse_11826_search_by_title', 10, 2 );
