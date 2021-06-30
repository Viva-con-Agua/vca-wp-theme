<?php

// Register Custom Post Type - Teams
function registerTeams() {
    $args = array(
        'labels' => array(
            'name'          => __('Teams', 'vca'),
            'singular_name' => __('Team', 'vca'),
        ),
        'description' => __( 'Team auflistung', 'vca' ),
        'supports' => array( 'title', 'thumbnail', 'revisions', 'custom-fields'),
        'hierarchical' => false,
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'menu_position' => 20,
        'menu_icon' => 'dashicons-admin-users',
        'show_in_nav_menus' => true,
        'can_export' => true,
        'has_archive' => false,
        'exclude_from_search' => true,
        'publicly_queryable' => true,
        'show_in_rest' => true,
    );

    register_post_type( 'Team', $args );

}
add_action( 'init', 'registerTeams', 0 );
