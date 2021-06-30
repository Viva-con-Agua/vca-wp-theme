<?php

$news = array( 'cat' => $GLOBALS['ownId']['news'],  'posts_per_page' => 3);
$newsLoop = new WP_Query( $news );

?>
<section id="newsTeaser" class="py-md-4 py-3 whitebg">
    <div class="container">
        <div class="row fadeInRow">
            <div class="col">
                <h3 class="mb-mb-3 mb-2"><?php _e('Neuigkeiten', 'vca'); ?></h3>
            </div>
        </div>
        <div class="row fadeInRow">
                <?php while ( $newsLoop->have_posts() ) : $newsLoop->the_post();
                    get_template_part('template-parts/news/postContent');

                    wp_reset_postdata();
                endwhile; ?>
            <div class="col col-md-12 mt-md-3 mt-0">
                <a class="btn" href="<?php echo get_category_link($GLOBALS['ownId']['news']); ?>"><?php _e('Mehr neuigkeiten', 'vca'); ?></a>
            </div>
        </div>
    </div>
</section>
