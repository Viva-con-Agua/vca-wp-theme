<?php

// Register Custom Post Type - Teams
function registerPress() {
    $args = array(
        'labels' => array(
            'name'          => __('Presse', 'vca'),
            'singular_name' => __('Pressmeldung', 'vca'),
        ),
        'description' => __( 'Pressemeldungen', 'vca' ),
        'supports' => array( 'title', 'editor', 'thumbnail', 'revisions', 'custom-fields'),
        'hierarchical' => false,
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'menu_position' => 20,
        'menu_icon' => 'dashicons-media-document',
        'show_in_nav_menus' => true,
        'can_export' => true,
        'has_archive' => true,
        'exclude_from_search' => true,
        'publicly_queryable' => true,
        'show_in_rest' => true,
    );

    register_post_type( 'Presse', $args );

}
add_action( 'init', 'registerPress', 0 );
