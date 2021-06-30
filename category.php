<?php get_header();
    $category = get_category(get_query_var('cat'));

    if ($category->term_id == $GLOBALS['ownId']['events']) {
        get_template_part('template-parts/events/loop');
    } else {
        get_template_part('loop');
    }

get_footer(); ?>
