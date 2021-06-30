<?php

// Security: Hide Usernames from Classes
add_filter('comment_class', 'andys_remove_comment_author_class');
function andys_remove_comment_author_class($classes) {
    foreach ($classes as $key => $class) {
        if (strstr($class, "comment-author-")) {
            unset($classes[$key]);
        }
    }
    return $classes;
}

function hm_customize_register( $wp_customize )
{
   $wp_customize->remove_section('custom_css');
}
add_action( 'customize_register', 'hm_customize_register' );