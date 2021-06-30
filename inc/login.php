<?php

add_filter('login_headerurl', 'loginLogoUrl');
function loginLogoUrl() {
    return 'https://herrlich.media';
}

add_filter('login_headertitle', 'loginLogoTitle');
function loginLogoTitle() {
    return 'Powered by herrlich media';
}

add_action('wp_before_admin_bar_render', 'removeWpLogo');
function removeWpLogo() {
    global $wp_admin_bar;
    $wp_admin_bar -> remove_menu('wp-logo');
}

add_filter( 'update_footer', 'RemoveFooterVersion', 9999);
function RemoveFooterVersion() {
    echo '';
}

add_filter('admin_footer_text', 'dashboardFooter', 9999);
function dashboardFooter() {
    echo 'Powered by <a href="https://herrlich.media">herrlich media</a>';
}

// Custom Admin Backend Login
add_action('login_enqueue_scripts', 'customLoginStyles');
function customLoginStyles() {
    echo '<link rel="stylesheet" type="text/css" href="' . get_bloginfo('template_directory') . '/assets/dist/css/login/hmLoginWP.css" />';
}

// Remove Admin bar
 add_filter('show_admin_bar', 'remove_admin_bar');
function remove_admin_bar() {

    if (is_user_logged_in() && $_SERVER["HTTP_HOST"] != $GLOBALS['localUrl']) {
        return true;
    }
}

function move_admin_bar() {
    echo '
    <style type="text/css">
    body {margin-top: -32px;padding-bottom: 0;}
    body.admin-bar #wphead {padding-top: 0;}
    body.admin-bar #footer {padding-bottom: 28px;}
    #wpadminbar { top: auto !important;bottom: 0;}
    #wpadminbar .quicklinks .menupop ul { bottom: 28px;}
    </style>';
}
add_action( 'wp_head', 'move_admin_bar' );
