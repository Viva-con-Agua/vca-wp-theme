<?php

// Disable Self Pingbacks
function wpsites_disable_self_pingbacks( &$links ) {
  foreach ( $links as $l => $link )
        if ( 0 === strpos( $link, get_option( 'home' ) ) )
            unset($links[$l]);
}
add_action( 'pre_ping', 'wpsites_disable_self_pingbacks' );

// Recovery Mail Adress Change
add_filter( 'recovery_mode_email', 'send_sumun_the_recovery_mode_email', 10, 2 );
    function send_sumun_the_recovery_mode_email( $email, $url ) {
    $email['to'] = 'wordpress@herrlich-media.de';
    return $email;
}

// block WP enum scans
// https://m0n.co/enum
if (!is_admin()) {
    // default URL format
    if (preg_match('/author=([0-9]*)/i', $_SERVER['QUERY_STRING'])) {
        rrTo404();
    }
    add_filter('redirect_canonical', 'shapeSpaceCheckEnum', 10, 2);
}
function shapeSpaceCheckEnum($redirect, $request) {
    // permalink URL format
    if (preg_match('/\?author=([0-9]*)(\/*)/i', $request)) {
        rrTo404();
    } else {
        return $redirect;
    }
}

// 404 redirect
function rrTo404() {
    global $post;
    global $wp_query;
    $wp_query->set_404();
    status_header(404);
}

// Chck for Login Page
function is_login_page() {
    return in_array($GLOBALS['pagenow'], array('wp-login.php', 'wp-register.php'));
}

// writeLog('THIS IS THE START OF MY CUSTOM DEBUG');
if(!function_exists('writeLog')){
    function writeLog($log){
        if(WP_DEBUG ===  true){
            if(is_array($log) || is_object($log)){
                error_log(print_r($log, true));
            } else {
                error_log($log);
            }
        }
    }
}

// Dynamic Excerpt
function getExcerptDynLength($text, $lenth){
    $the_excerpt = strip_tags(strip_shortcodes($text)); //Strips tags and images
    $words = explode(' ', $the_excerpt, $lenth + 1);
    if(count($words) > $lenth){
        array_pop($words);
        array_push($words, '…');
        $the_excerpt = implode(' ', $words);
    }

    $the_excerpt = '<p>' . $the_excerpt . '</p>';
    return $the_excerpt;
}

// Remove QueryString ?ver in Scripts
add_filter( 'script_loader_src', 'wp_performance_remove_script_version', 15, 1 );
add_filter( 'style_loader_src', 'wp_performance_remove_script_version', 15, 1 );
function wp_performance_remove_script_version( $src ) {
    if(!is_admin() && !current_user_can('administrator') && !current_user_can('editor')){
        $parts = explode('?ver', $src);
        return $parts[0];
    }
    return $src;
}
function convertYoutube($string) {
    return preg_replace(
        "/\s*[a-zA-Z\/\/:\.]*youtu(be.com\/watch\?v=|.be\/)([a-zA-Z0-9\-_]+)([a-zA-Z0-9\/\*\-\_\?\&\;\%\=\.]*)/i",
        "https://www.youtube.com/embed/$2\&autohide=1&autoplay=1",
        $string
    );
}

