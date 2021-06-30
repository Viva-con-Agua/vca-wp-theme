<?php

// Tiny MCE Format Auswahl
add_action('after_setup_theme', 'style_after_setup_theme');
function style_after_setup_theme(){
    add_editor_style();
}

add_filter('mce_buttons_2', 'style_mce_buttons_2');
function style_mce_buttons_2($buttons){
    array_unshift($buttons, 'styleselect');
    return $buttons;
}

add_filter('tiny_mce_before_init', 'style_tiny_mce_before_init');
function style_tiny_mce_before_init($settings){
    $settings['theme_advanced_blockformats'] = 'p,h1,h2,h3,h4';

    $style_formats = array(
        array(
            'title' => 'Button',
            'selector' => 'a',
            'wrapper' => false,
            'classes' => 'btn',
            'exact' => false
        ),
        array(
            'title' => 'Button hellblau',
            'selector' => 'a',
            'wrapper' => false,
            'classes' => 'btn blue',
            'exact' => false
        )
    );

    $settings['style_formats'] = json_encode( $style_formats );
    return $settings;
}

// Disable emojis
add_action('init', 'disable_wp_emojicons');
function disable_wp_emojicons() {
    // all actions related to emojis
    remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
    remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
    remove_action( 'wp_print_styles', 'print_emoji_styles' );
    remove_action( 'admin_print_styles', 'print_emoji_styles' );
    remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
    remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
    remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
    // filter to remove TinyMCE emojis
    add_filter( 'tiny_mce_plugins', 'disable_emojicons_tinymce' );
}
function disable_emojicons_tinymce($plugins){
    $ret = is_array( $plugins ) ? array_diff( $plugins, array( 'wpemoji' ) ) : array();
    return $ret;
}
