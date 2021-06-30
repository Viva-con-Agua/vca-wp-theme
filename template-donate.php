<?php

 /* Template Name: Spenden Seite */

get_header();

if (have_posts()) : while (have_posts()) : the_post();
    $bigHeaderHeadline = get_field('bigHeaderHeadline');
    $galleryImgs = get_field('bigHeaderSlider');
    $theContent = get_the_content();
    $h1 = get_the_title();
    $theContentClass = 'my-md-4 mt-2 mb-3 mt-3';

    include('template-parts/content.php');

    include('template-parts/bellowPost.php');

    ?>
        <div class="donateNow">
            <span class="btn"><?php _e('Zum Spendenformular', 'vca'); ?></span>
        </div>
    <?php endwhile;
else:
    get_template_part('template-parts/noContent');
endif;
get_footer(); ?>

