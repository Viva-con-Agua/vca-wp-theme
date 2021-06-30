<?php

/* Add rel um Fancybox nutzen zu können */
add_filter('the_content', 'addlightboxrel_replace');
function addlightboxrel_replace($content){
    global $post;
    $pattern = "/<a(.*?)href=('|\")(.*?).(bmp|gif|jpeg|jpg|png)('|\")(.*?)>/i";
    $replacement = '<a$1data-fancybox="fancy" href=$2$3.$4$5$6>';
    $content = preg_replace($pattern, $replacement, $content);
    $content = str_replace("%LIGHTID%", $post->ID, $content);
    return $content;
}

/* ADD LAZYLOADER TO ALL IMAGES –> Dazu immer den Aufruf im JS und fertig */
add_filter('the_content', 'add_image_placeholders', 99);
function add_image_placeholders( $content ) {
    // Don't lazyload for feeds, previews, mobile
    if( is_feed() || is_preview() || ( function_exists( 'is_mobile' ) && is_mobile() ) )
        return $content;

    // Don't lazy-load if the content has already been run through previously
    if ( false !== strpos( $content, 'data-src' ) )
        return $content;

    // This is a pretty simple regex, but it works
    $lazyPlaceholderImg = $GLOBALS['placeholder'];
    $content = preg_replace( '#<img([^>]+?)src=[\'"]?([^\'"\s>]+)[\'"]?([^>]*)>#', sprintf( '<img${1}src="%s" data-src="${2}"${3}><noscript><img${1}src="${2}"${3}></noscript>', $lazyPlaceholderImg ), $content );

    if($content){
        $pattern ="/<img(.*?)class=\"(.*?)\"(.*?)>/i";
        $replacement = '<img$1class="$2 lazy"$3>';
        $content = preg_replace($pattern, $replacement, $content);
    }
    return $content;
}

// Erweitert die direkte Youtube einbundung um Wrapper
add_filter('embed_oembed_html', 'custom_oembed_filter', 10, 4);
function custom_oembed_filter($html, $url, $attr, $post_ID) {
    $return = $html;
    if (strpos($url, 'youtube') !== false) {
        $return = '<div class="embed-container"><div class="video-container">'.$html.'</div></div>';
    } else {
        $return = '<div class="embed-container">'.$html.'</div>';
    }

    return $return;
}

// Allow shortcodes
add_filter('the_excerpt', 'do_shortcode');
add_filter('widget_text', 'do_shortcode');

// Remove <p> tags
add_filter('the_excerpt', 'shortcode_unautop');
add_filter('widget_text', 'shortcode_unautop');

// Replaces double line-breaks with paragraph elements.
remove_filter('the_excerpt', 'wpautop');


