<?php get_header();
if (have_posts()) : while (have_posts()) : the_post();
    $bigHeaderHeadline = get_field('bigHeaderHeadline');
    $galleryImgs = get_field('bigHeaderSlider');
    $theContent = get_the_content();
    $h1 = get_the_title();
    $theContentClass = 'mb-md-4 mb-3 mt-md-4 mt-3';

    include('template-parts/content.php');

    include('template-parts/bellowPost.php');

    endwhile;
else:
    get_template_part('template-parts/noContent');
endif;
get_footer(); ?>
