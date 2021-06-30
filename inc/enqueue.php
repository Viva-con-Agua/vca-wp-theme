<?php

// Add Conditional Page Scripts
add_action('init', 'html5blank_styles');
function html5blank_styles() {
    if (!is_admin() && !is_login_page()) {
        wp_register_style('ownstyles', get_template_directory_uri() . '/assets/dist/css/style.css', array(), '1.0', 'all');
        wp_enqueue_style('ownstyles');
    }
}

add_action('wp_enqueue_scripts', 'html5blank_header_scripts');
function html5blank_header_scripts() {
    if (!is_admin()) {

        wp_deregister_script('jquery');
        // Deregister WordPress jQuery
        wp_register_script('jquery',  get_template_directory_uri() . '/assets/dist/js/jquery/jquery.min.js', array(), '3.5.1', true);
        // Google CDN jQuery
        wp_enqueue_script('jquery');
        // Enqueue it!

        wp_register_script('html5blankscripts', get_template_directory_uri() . '/assets/dist/js/main.js', array(), '', true);
        wp_enqueue_script('html5blankscripts');


        if(isset($GLOBALS['mapBoxToken']) && $GLOBALS['mapBoxToken'] !== '' && is_page_template('template-volunteer.php')){
            wp_register_script('mapboxScript',  get_template_directory_uri() . '/assets/dist/js/mapbox/mapbox-gl.js' , array(), '', true); // Custom scripts
            wp_enqueue_script('mapboxScript'); // Enqueue it!
        }
    }
}

// Remove 'text/css' from our enqueued stylesheet
add_filter('style_loader_tag', 'html5_style_remove');
add_filter('script_loader_tag', 'html5_style_remove');
function html5_style_remove($tag) {
    return preg_replace('~\s+type=["\'][^"\']++["\']~', '', $tag);
}

// add_filter('script_loader_tag', 'add_defer_attribute', 10, 2);
function add_defer_attribute($tag, $handle) {
   // add script handles to the array below
   $scripts_to_defer = array('html5blankscripts', 'another-handle');

   foreach($scripts_to_defer as $defer_script) {
      if ($defer_script === $handle) {
         return str_replace(' src', ' defer="defer" src', $tag);
      }
   }
   return $tag;
}

// add_filter('script_loader_tag', 'add_async_attribute', 10, 2);
function add_async_attribute($tag, $handle) {
   // add script handles to the array below
   $scripts_to_async = array('js-cookie', 'google_maps_api');

   foreach($scripts_to_async as $async_script) {
      if ($async_script === $handle) {
         return str_replace(' src', ' async="async" src', $tag);
      }
   }
   return $tag;
}

// custo Editor Style
add_action('admin_init', 'my_theme_add_editor_styles');
function my_theme_add_editor_styles() {
    add_editor_style( 'custom-editor-style.css' );
}

// Enable Threaded Comments
add_action('get_header', 'enable_threaded_comments');
function enable_threaded_comments() {
    if (!is_admin()) {
        if (is_singular() AND comments_open() AND (get_option('thread_comments') == 1)) {
            wp_enqueue_script('comment-reply');
        }
    }
}

