<?php

// Register Custom Post Type - volunteerTeams
function registerVolunteerTeams() {
    $args = array(
        'labels' => array(
            'name'          => __('Ehrenamt Teams', 'vca'),
            'singular_name' => __('Ehrenamt Team', 'vca'),
        ),
        'description' => __( 'Ehrenamt Teams Auflistung', 'vca' ),
        'supports' => array( 'title', 'thumbnail', 'revisions', 'custom-fields'),
        'hierarchical' => false,
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'menu_position' => 20,
        'menu_icon' => 'dashicons-universal-access',
        'show_in_nav_menus' => true,
        'can_export' => true,
        'has_archive' => false,
        'exclude_from_search' => true,
        'publicly_queryable' => true,
        'show_in_rest' => true,
    );

    register_post_type( 'VolunteerTeam', $args );

}
add_action( 'init', 'registerVolunteerTeams', 0 );
