<div class="text-block-wrapper">

	<div class="container--medium align-center">

        <div class="streamer-content">

            <?php while ( have_posts() ) : the_post();

                the_title( '<h1 class="entry-title" itemprop="name headline">', '</h1>' );?>

                <div class="entry-content" itemprop="articleBody">
                    <?php the_content(); ?>
                </div>
            
            <?php endwhile; ?>
 
        </div>

    </div>
</div>