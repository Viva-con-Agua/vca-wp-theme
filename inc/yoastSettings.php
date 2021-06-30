<?php

// Remove YOAST Comment
if(defined('WPSEO_VERSION')){
    add_action('get_header', 'remove_yoast_comment');
    add_action('wp_head', 'remove_yoast_comment_complete', 999);

    function remove_yoast_comment() {
        ob_start('remove_yoast_comment_replace');
    }

    function remove_yoast_comment_replace($html) {
        return preg_replace( '/^<!--.*?[Y]oast.*?-->$/mi', '', $html );
    }

    function remove_yoast_comment_complete() {
        ob_end_flush();
    }
}
