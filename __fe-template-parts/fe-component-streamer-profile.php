<div class="streamer-wrapper">

    <span class="button-open slide-in"><span>&#8250;</span></span>

	<div class="container--medium align-center">

        <?php if( class_exists('ACF') ) : ?>

            <a name="about" class="relative-jump"></a> <!-- Scroll to the top -->

            <div class="streamer-card align-center">
                <?php if( have_rows('streamer_card') ): ?>
                    <?php while( have_rows('streamer_card') ): the_row(); ?>
                        <div class="str-left">
                            <?php 
                            if ( get_sub_field('streamer_profile_picture') ) {
                                $streamer_profile_picture = get_sub_field('streamer_profile_picture');
                                $streamer_profile_url = esc_url($streamer_profile_picture['url']);
                            } else {
                                $streamer_profile_url = get_template_directory_uri() . '/assets/images/streamer-placeholder.jpg';
                            }
                            ?>
                            <div class="img" style="background-image: url(<?php echo $streamer_profile_url; ?>);"></div>
                            <div class="col-contact__icons-wrap align-center">
                                <?php if ( get_sub_field('streamer_youtube_url') ) : ?>
                                    <a class="sn-icon" href="<?php the_sub_field('streamer_youtube_url'); ?>" target="_blank" rel=”noopener”><span class="font-youtube"></span></a>
                                <?php endif; ?>
                                <?php if ( get_sub_field('streamer_facebook_url') ) : ?>
                                    <a class="sn-icon" href="<?php the_sub_field('streamer_facebook_url'); ?>" target="_blank" rel=”noopener”><span class="font-facebook"></span></a>
                                <?php endif; ?>
                                <?php if ( get_sub_field('streamer_twitter_url') ) : ?>
                                    <a class="sn-icon" href="<?php the_sub_field('streamer_twitter_url'); ?>" target="_blank" rel=”noopener”><span class="font-twitter"></span></a>
                                <?php endif; ?>
                                <?php if ( get_sub_field('streamer_instagram_url') ) : ?>
                                    <a class="sn-icon" href="<?php the_sub_field('streamer_instagram_url'); ?>" target="_blank" rel=”noopener”><span class="font-instagram"></span></a>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="str-right">
                            <div class="name">
                                <?php                        
                                $streamer_logo = get_sub_field('streamer_logo');
                                $streamer_nick_name = get_sub_field('streamer_nick_name');
                                if( !empty( $streamer_logo ) ): ?>
                                    <img src="<?php echo esc_url($streamer_logo['url']); ?>" alt="<?php echo esc_attr($streamer_logo['alt']); ?>" width="40" height="47" />
                                <?php endif; ?>
                                <span><?php echo $streamer_nick_name; ?></span>
                            </div>
                            <div class="status">
                                <ul class="data">
                                    <?php if ( get_sub_field('streamer_country') ) : ?>
                                        <?php
                                            $country_arr = get_sub_field('streamer_country');
                                            $code = strtolower ( $country_arr[value] );
                                            $country = $country_arr[label];                                
                                        ?>
                                        <li><img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/flag/<?php echo $code; ?>.png" alt="<?php echo $country.' flag'; ?>" width="28" height="14" /> <span class="blk1"><?php echo $country; ?></span></li>
                                    <?php endif; ?>
                                    <?php
                                        $url_check = get_sub_field('streaming_url');
                                        if (strpos($url_check,'twitch') !== false) {
                                            $partner = 'Twitch';
                                        } elseif (strpos($url_check,'youtube') !== false) {
                                            $partner = 'YouTube';
                                        } elseif (strpos($url_check,'mixer') !== false) {
                                            $partner = 'Mixer';
                                        }
                                    ?>
                                    <?php if ( get_sub_field('streaming_url') ) : ?>
                                        <li>
                                            <span class="fnt font-<?php echo strtolower($partner); ?>">
                                            <a class="partner" href="<?php the_sub_field('streaming_url'); ?>" target="_blank" rel=”noopener”></span>
                                                <?php if ( get_sub_field('streaming_status') ) {
                                                    the_sub_field('streaming_status');
                                                } else {
                                                    echo $partner.' Partner';
                                                } ?>
                                            </a>
                                        </li>
                                    <?php endif; ?>
                                    <?php if ( get_sub_field('streamer_game') ) : ?>
                                        <li><span class="blk2"><span>Game: </span><?php the_sub_field('streamer_game'); ?></span</li>
                                    <?php endif; ?>
                                    
                                    <?php 
                                        if ( get_sub_field('streamer_nick_name') ) {
                                            if ( $partner === 'Twitch' ) {
                                                
                                                $streamer_twitch = strtolower( trim ( $streamer_nick_name ) );
                                                $args_for_twitch = array(
                                                    'headers' => array(
                                                        'Client-ID' => 'uv5hgc64w4aied8bugcfeywfl039z9',
                                                    )
                                                );
                                                
                                                if ( $streamer_twitch ) {
                                                    $response_twitch = wp_remote_get( 'https://api.twitch.tv/helix/streams?user_login=' . $streamer_twitch , $args_for_twitch );
                                                    if ( ! is_wp_error($response_twitch) ){                                                     
                                                        $response_twitch_data = json_decode( $response_twitch[body], true );
                                                        echo '<pre style="background: white; color: black;">';
                                                        var_dump($response_twitch_data);
                                                        echo '</pre>';
                                                        if ( !empty( $response_twitch_data ) ) {
                                                            //$type = $responseData->data[0]->type;
                                                            $type = $response_twitch_data["data"][0]["type"];
                                                        }
                                                    }
                                                }

                                                $status_twitch = ($type) ? '<li>Status: ' . $type . '</li>' : '<li>Status: Offline</li>';

                                                echo $status_twitch;

                                            } elseif ( $partner === 'Mixer' ) {

                                                $streamer_mixer = trim ( $streamer_nick_name );
                                                $args_for_mixer = array(
                                                    'headers' => array(
                                                        'Client-ID' => '47ae49dbf550653166f8df9b48ce586ac6de78d1b879f543',
                                                    )
                                                );

                                                if ( $streamer_mixer ) {
                                                    $response_mixer = wp_remote_get( 'https://mixer.com/api/v1/channels/'. $streamer_mixer , $args_for_mixer );
                                                    
                                                    if ( ! is_wp_error($response_mixer) ){  
                                                        $response_mixer_data = json_decode( $response_mixer[body], true );
                                                        
                                                        $streamer_mixer_ID = $response_mixer_data["id"];
                                                        //$online = $responseData2->type;
                                                        //$numFollowers = $response_mixer_data["numFollowers"];
                                                        $createdAt = $result = substr($response_mixer_data["createdAt"], 0, 10);
                                                        $online = $response_mixer_data["online"];
                                                        
                                                        $response_ID = wp_remote_get( 'https://mixer.com/api/v1/channels/' . $streamer_mixer_ID . '/recordings' , $args_for_mixer );
                                                        $response_ID_data = json_decode( $response_ID[body], true );
                                                        $duration = $response_ID_data[0]["duration"];
                                                    }
                                                    
                                                }

                                                $status_mixer = ($online) ? '<li>Status: Live</li>' : '<li>Status: Offline</li>';

                                                echo $status_mixer;

                                            } elseif ( $partner === 'YouTube' ) {

                                                echo '<li>Status: N/A</li>';

                                            }
                                        }
                                    ?>
                                </ul>
                            </div>
                        </div>
                    <?php endwhile; ?>
                <?php endif; ?>
            </div>
            
            <div class="about-streamer">
                <aside id="streamer-aside" class="streamer-widget-area">
                    <span class="button-close slide-out">×</span>

                    <div class="streamer-sidebar">
                        <div class="streamer-nav">
                            <ul class="data">
                                <li><a class="slide-out" href="#about">About</a></li>
                                <li><a class="slide-out" href="#gear-specs">Gear Specs</a></li>
                                <li><a class="slide-out" href="#game-settings">Game Settings</a></li>
                                <li><a class="slide-out" href="#biography">Biography</a></li>
                            </ul>
                        </div>

                        <div class="let-us-know">
                            <span>Have we missed anything?</span>
                            <button type="button" class="js-modal" data-modal="modal-streamer">Let us know!</button>
                        </div>
                    </div>
                </aside>

                <div class="streamer-spreadsheets">
                    <?php if( have_rows('streamer_info') || have_rows('streaming_schedule') ): ?>
                        <div class="st-sp-row">
                            <?php while( have_rows('streamer_info') ): the_row(); ?>
                                <div class="info frame col-left">
                                    <div class="title">
                                        <h3 class="single lh-50"><span>Streamer Info</span></h3>
                                    </div>
                                    <ul class="data">                                
                                        <li><span class="l11">Real name:</span> <span class="l13"><?php the_sub_field('real_name'); ?></span></li>
                                        <?php 
                                        $getDate = get_sub_field('birthday');
                                        if( !empty( $getDate ) ):
                                            $birthday = new DateTime($getDate); $interval = $birthday->diff(new DateTime); ?>
                                            <li><span class="l11">Birthday:</span> <span class="l13"><?php if( $interval->y >= 13) { the_sub_field('birthday'); echo ' (age '.$interval->y.')'; } else { echo 'N/A'; } ?></span></li>
                                        <?php endif; ?>
                                        <li><span class="l11">Started Streaming:</span> <span class="l13"><?php if ($createdAt) { echo $createdAt; } else { the_sub_field('started_streming'); } ?></span></li>
                                        <li><span class="l11">Last seen:</span> <span class="l13"><?php the_sub_field('last_seen'); ?></span></li>
                                        <li><span class="l11">Hours Live:</span> <span class="l13"><?php if ($duration) { echo sprintf('%02d:%02d', (int) $duration, fmod($time, 1) * 60); } else { the_sub_field('hours_live'); } ?></span></li>
                                        <li><span class="l11">Streaming Platform:</span> <spa class="l13"><?php the_sub_field('streaming_platform'); ?></span></li>
                                        <li><span class="l11">Team:</span> <span class="l13"><?php the_sub_field('team'); ?></span></li>
                                    </ul>
                                </div>
                            <?php endwhile; ?>

                            <?php while( have_rows('streaming_schedule') ): the_row(); ?>
                                <div class="schedule frame col-right">
                                    <div class="title">
                                        <h3 class="single lh-50"><span>Streaming Schedule</span></h3>
                                    </div>
                                    <ul class="data">
                                        <li><span class="l12">Sunday:</span> <span class="l13"><?php the_sub_field('sunday'); ?></span></li>
                                        <li><span class="l12">Monday:</span> <span class="l13"><?php the_sub_field('monday'); ?></span></li>
                                        <li><span class="l12">Tuesday:</span> <span class="l13"><?php the_sub_field('tuesday'); ?></span></li>
                                        <li><span class="l12">Wednesday:</span> <span class="l13"><?php the_sub_field('wednesday'); ?></span></li>
                                        <li><span class="l12">Thursday:</span> <span class="l13"><?php the_sub_field('thursday'); ?></span></li>
                                        <li><span class="l12">Friday:</span> <span class="l13"><?php the_sub_field('friday'); ?></span></li>
                                        <li><span class="l12">Saturday:</span> <span class="l13"><?php the_sub_field('saturday'); ?></span></li>                      
                                    </ul>
                                </div>
                            <?php endwhile; ?>
                        </div>
                    <?php endif; ?>

                    <a name="gear-specs" class="relative-jump"></a> 
                    <?php if( have_rows('pc_settings') || have_rows('streaming_setup') || have_rows('gear_info') ): ?>
                        <h2 class="sp-title">Streaming Specs</h2>
                        <div class="st-sp-row">
                            <?php if( have_rows('pc_settings') ): ?>
                                <div class="pc frame col-left">
                                    <?php

                                    $countVideoRows = count(get_field('pc_settings'));

                                    if( $countVideoRows > 1 ): ?>
                                        <ul class="tabs-nav">
                                            <?php
                                            $s1 = 0;
                                            while( have_rows('pc_settings') ): the_row(); $s1++; ?>
                                                <li class="tab-nav-link" data-target="#tab-pc-<?php echo $s1;?>">
                                                    <h3 class="tab-title">
                                                        <span>
                                                            <?php the_sub_field('pc_for'); ?>
                                                        </span>
                                                    </h3>
                                                </li>
                                            <?php endwhile; ?>
                                        </ul>
                                    <?php else: ?>
                                        <?php while( have_rows('pc_settings') ): the_row(); ?>
                                            <div class="title">
                                                <h3 class="single lh-100"><span><?php the_sub_field('pc_for'); ?></span></h3>
                                            </div>
                                        <?php endwhile; ?>
                                    <?php endif; ?>
    
                                    <div class="tabs-main-content">
                                        <?php 
                                        $v2 = 0;
                                        while( have_rows('pc_settings') ): the_row(); $v2++; ?>
                                            <div id="tab-pc-<?php echo $v2;?>" class="tab-content"><!-- Begins tab-one -->
                                                <div class="tab-inner">
                                                    <ul class="data">
                                                        <li><span class="l12">OS:</span> <span class="l13"><?php the_sub_field('operating_system'); ?></span></li>
                                                        <li><span class="l12">Motherboard:</span> <span class="l13"><?php the_sub_field('motherboard'); ?></span></li>
                                                        <li><span class="l12">CPU:</span> <span class="l13"><?php the_sub_field('cpu'); ?></span></li>
                                                        <li><span class="l12">GPU:</span> <span class="l13"><?php the_sub_field('gpu'); ?></span></li>
                                                        <li><span class="l12">RAM:</span> <span class="l13"><?php the_sub_field('ram'); ?></span></li>
                                                        <li><span class="l12">Case:</span> <span class="l13"><?php the_sub_field('case'); ?></span></li>
                                                        <li><span class="l12">HDD/SSD:</span> <span class="l13"><?php the_sub_field('hddssd'); ?></span></li>
                                                        <li><span class="l12">Power Supply:</span> <span class="l13"><?php the_sub_field('power_supply'); ?></span></li>
                                                        <li><span class="l12">Fans:</span> <span class="l13"><?php the_sub_field('fans'); ?></span></li>
                                                        <li><span class="l12">Liquid Cooling:</span> <span class="l13"><?php the_sub_field('liquid_cooling'); ?></span></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        <?php endwhile; ?>
                                    </div>
                                </div>
                            <?php endif; ?>

                            <?php if( have_rows('streaming_setup') ): ?>
                                <?php while( have_rows('streaming_setup') ): the_row(); ?>
                                    <div class="info frame col-right">
                                        <div class="title">
                                            <h3 class="single lh-100"><span>Streaming Setup</span></h3>
                                        </div>
                                        <ul class="data">
                                            <li><span class="l12">Camera:</span> <span class="l13"><?php the_sub_field('camera'); ?></span></li>
                                            <li><span class="l12">Webcam:</span> <span class="l13"><?php the_sub_field('webcam'); ?></span></li>
                                            <li><span class="l12">Studio Light:</span> <span class="l13"><?php the_sub_field('studio_light'); ?></span></li>
                                            <li><span class="l12">Lighting Kit:</span> <span class="l13"><?php the_sub_field('lighting_kit'); ?></span></li>
                                            <li><span class="l12">USB Hub:</span> <span class="l13"><?php the_sub_field('usb_hub'); ?></span></li>
                                            <li><span class="l12">Arm:</span> <span class="l13"><?php the_sub_field('arm'); ?></span></li>
                                            <li><span class="l12">Microphone:</span> <span class="l13"><?php the_sub_field('microphone'); ?></span></li>
                                            <li><span class="l12">Control Panel:</span> <span class="l13"><?php the_sub_field('control_panel'); ?></span></li>
                                            <li><span class="l12">Amplifier:</span> <span class="l13"><?php the_sub_field('amplifier'); ?></span></li>
                                            <li><span class="l12">Chair:</span> <span class="l13"><?php the_sub_field('chair'); ?></span></li>                      
                                        </ul>
                                    </div>
                                <?php endwhile; ?> 
                            <?php endif; ?>
                            
                            <?php if( have_rows('gear_info') ): ?>
                                <?php while( have_rows('gear_info') ): the_row(); ?>
                                    <div class="gear frame col-left">
                                        <div class="title">
                                            <h3 class="single lh-100"><span>Gear</span></h3>
                                        </div>
                                        <ul class="data">
                                            <li><span class="l12">Monitor:</span> <span class="l13"><?php the_sub_field('monitor'); ?></span></li>
                                            <li><span class="l12">Headset:</span> <span class="l13"><?php the_sub_field('headset'); ?></span></li>
                                            <li><span class="l12">Keyboard:</span> <span class="l13"><?php the_sub_field('keyboard'); ?></span></li>
                                            <li><span class="l12">Mouse:</span> <span class="l13"><?php the_sub_field('mouse'); ?></span></li>
                                            <li><span class="l12">Mousepad:</span> <span class="l13"><?php the_sub_field('mousepad'); ?></span></li>
                                        </ul>
                                    </div>
                                <?php endwhile; ?>                       
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>

                    <a name="game-settings" class="relative-jump"></a> 
                    <?php if( have_rows('video_settings') || have_rows('mouse_settings') ): ?>
                        <div class="st-sp-row">
                        <?php if( have_rows('video_settings') ): ?>
                            <div class="col-left">
                                <h2 class="sp-title">Video Settings</h2>
                                <div class="video frame">
                                    <?php

                                    $countVideoRows = count(get_field('video_settings'));

                                    if( $countVideoRows > 1 ): ?>
                                        <ul class="tabs-nav">
                                            <?php
                                            $v1 = 0;
                                            while( have_rows('video_settings') ): the_row(); $v1++; ?>
                                                <li class="tab-nav-link" data-target="#tab-video-<?php echo $v1;?>">
                                                    <h3 class="tab-title">
                                                        <span>
                                                            <?php the_sub_field('video_game_title'); ?>
                                                        </span>
                                                    </h3>
                                                </li>
                                            <?php endwhile; ?>
                                        </ul>
                                    <?php else: ?>
                                        <?php while( have_rows('video_settings') ): the_row(); ?>
                                            <div class="title">
                                                <h3 class="single lh-100"><span><?php the_sub_field('video_game_title'); ?></span></h3>
                                            </div>
                                        <?php endwhile; ?>
                                    <?php endif; ?>

                                    <div class="tabs-main-content">
                                        <?php 
                                        $v2 = 0;
                                        while( have_rows('video_settings') ): the_row(); $v2++; ?>
                                             <div id="tab-video-<?php echo $v2;?>" class="tab-content"><!-- Begins tab-one -->
                                                <div class="tab-inner">
                                                    <ul class="data">
                                                        <li><span class="l12">Resolution:</span> <span class="l13"><?php the_sub_field('resolution'); ?></span></li>
                                                        <li><span class="l12">FOV:</span> <span class="l13"><?php the_sub_field('fov'); ?></span></li>
                                                        <li><span class="l12">Render Scale:</span> <span class="l13"><?php the_sub_field('render_scale'); ?></span></li>
                                                        <li><span class="l12">Refresh Rate:</span> <span class="l13"><?php the_sub_field('refresh_rate'); ?></span></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        <?php endwhile; ?>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>

                        <?php if( have_rows('mouse_settings') ): ?>
                            <div class="col-right">
                                <h2 class="sp-title">Mouse Settings</h2>
                                <div class="mouse frame">
                                    <?php

                                    $countMouseRows = count(get_field('mouse_settings'));

                                    if( $countMouseRows > 1 ): ?>
                                        <ul class="tabs-nav">
                                            <?php
                                            $m1 = 0;
                                            while( have_rows('mouse_settings') ): the_row(); $m1++; ?>
                                                <li class="tab-nav-link" data-target="#tab-mouse-<?php echo $m1;?>">
                                                    <h3 class="tab-title">
                                                        <span>
                                                            <?php the_sub_field('mouse_game_title'); ?>
                                                        </span>
                                                    </h3>
                                                </li>
                                            <?php endwhile; ?>
                                        </ul>
                                    <?php else: ?>
                                        <?php while( have_rows('mouse_settings') ): the_row();; ?>
                                            <div class="title">
                                                <h3 class="single lh-100"><span><?php the_sub_field('mouse_game_title'); ?></span></h3>
                                            </div>
                                        <?php endwhile; ?>
                                    <?php endif; ?>

                                    <div class="tabs-main-content">
                                        <?php 
                                        $m2 = 0;
                                        while( have_rows('mouse_settings') ): the_row(); $m2++; ?>
                                             <div id="tab-mouse-<?php echo $m2;?>" class="tab-content"><!-- Begins tab-one -->
                                                <div class="tab-inner">
                                                    <ul class="data">
                                                        <li><span class="l11">DPI:</span> <span class="l13"><?php the_sub_field('dpi'); ?></span></li>
                                                        <li><span class="l11">Hz:</span> <span class="l13"><?php the_sub_field('hz'); ?></span></li>
                                                        <li><span class="l11">Sensitivity X:</span> <span class="l13"><?php the_sub_field('sensitivity_x'); ?></span></li>
                                                        <li><span class="l11">Sensitivity Y:</span> <span class="l13"><?php the_sub_field('sensitivity_y'); ?></span></li>
                                                        <li><span class="l11">Targeting Sensitivity:</span> <span class="l13"><?php the_sub_field('targeting_sensitivity'); ?></span></li>
                                                        <li><span class="l11">Scope Sensitivity:</span> <span class="l13"><?php the_sub_field('scope_sensitivity'); ?></span></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        <?php endwhile; ?>
                                    </div><!-- # tabs-main-content --> 
                                </div>
                            </div>
                        <?php endif; ?>
                        </div>
                    <?php endif; ?>

                    <a name="biography" class="relative-jump"></a> 
                    <div class="biography">
                        <h2 class="sp-title">Biography</h2>
                        <?php
                        while ( have_posts() ) : the_post();
                            
                            the_content();

                        endwhile; // End of the loop.
                        ?>
                    </div>
                </div>
            </div>

        <?php endif; ?>

    </div>
    
</div>

<!-- Modal -->
<div id="modal-streamer" class="modal">
    <div class="modal-inner" style="min-height: 300px;">
        <a class="js-close-modal">×</a>

        <div class="modal-content">
            <p>Thank you for reaching out to us and helping as keep our information up to date and accurate!</p>
            <p>Let us know what needs to be updated and we will look into a.s.a.p!</p>
        </div>

        <div class="modal-form">
            <?php echo do_shortcode( '[contact-form-7 id="11" title="Contact form 1"]' ); ?>
        </div>        
    </div><!-- .modal-inner -->
</div><!-- .modal -->
