<div class="contact-wrapper"  style="background-image: url(<?php echo get_stylesheet_directory_uri(); ?>/assets/images/banner-contact.png);">

	<div class="container--intermediate align-center">

        <div class="contact-title">
            <h1 class="entry-title" itemprop="name headline"><?php the_title(); ?></h1>
        </div>

        <div class="contact-content">
            <ul>
                <li>
                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/contact_icon1.png" alt="chat with us" width="112" height="112" />
                    <p><span>Suggest a Streamer</span></p>
                    <p>Are we missing your favorite steamer?</p>
                    <p>Contact Us at: <?php echo '<a href="mailto:' . esc_html( antispambot( 'suggest.streamer@streamers.zone' ) ) . '">' . esc_html( antispambot( 'suggest.streamer@streamers.zone' ) ) . '</a>'; ?></p>
                </li>
                <li>
                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/contact_icon2.png" alt="mod team" width="112" height="112" />
                    <p><span>Join the Mod Team</span></p>
                    <p>Want to help us keep the datebase up to date?</p>
                    <p>Contact Us at: <?php echo '<a href="mailto:' . esc_html( antispambot( 'contact@streamers.zone' ) ) . '">' . esc_html( antispambot( 'contact@streamers.zone' ) ) . '</a>'; ?></p>
                </li>
                <li>
                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/contact_icon3.png" alt="support" width="112" height="112" />
                    <p><span>Report a Bug</span></p>
                    <p>Are you having issues with accessing the website?</p>
                    <p>Contact Us at: <?php echo '<a href="mailto:' . esc_html( antispambot( 'suppor@streamers.zone' ) ) . '">' . esc_html( antispambot( 'support@streamers.zone' ) ) . '</a>'; ?></p>
                </li>
            </ul>
        </div>
 
    </div>
</div>