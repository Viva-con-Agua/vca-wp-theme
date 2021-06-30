<?php

// Add our HTML5 Pagination
add_action('init', 'html5wp_pagination');
function html5wp_pagination() {
    global $wp_query;
    $big = 999999999;
    echo paginate_links(
        array(
            'base' => str_replace($big, '%#%', get_pagenum_link($big)),
            'format' => '?paged=%#%',
            'current' => max(1, get_query_var('paged')),
            'total' => $wp_query -> max_num_pages
        )
    );
}
