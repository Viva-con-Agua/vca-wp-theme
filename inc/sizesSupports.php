<?php

if (function_exists('add_theme_support')) {
    // Add Menu Support
    add_theme_support('menus');

    // Add Thumbnail Theme Support
    add_theme_support('post-thumbnails');
    add_image_size('biggest', 2000, '', true);
    add_image_size('large', 1600, '', true);
    add_image_size('large-medium', 1200, '', true);
    add_image_size('medium', 800, '', true);
    add_image_size('mediumHeight', '', 800, true);
    add_image_size('postThumb', 600, 388, true);
    add_image_size('postThumbSmall', 350, 226, true);
    add_image_size('memberThumb', 455, 600, true);
    add_image_size('small', 500, '', true);
    add_image_size('smallHeight', '', 500, true);
    add_image_size('tiny', 320, '', true);
    add_image_size('blockGallery', '', 320, true);
    add_image_size('placeholder', 60, '', true);

    // Localisation Support
    load_theme_textdomain('html5blank', get_template_directory() . '/languages');

    // Remove thumbnail width and height dimensions that prevent fluid images in the_thumbnail
    add_filter('post_thumbnail_html', 'remove_thumbnail_dimensions', 10);
    add_filter('image_send_to_editor', 'remove_thumbnail_dimensions', 10);
    function remove_thumbnail_dimensions($html) {
        $html = preg_replace('/(width|height)=\"\d*\"\s/', "", $html);
        return $html;
    }

    // Custom Gravatar in Settings > Discussion
    add_filter('avatar_defaults', 'html5blankgravatar');
    function html5blankgravatar($avatar_defaults) {
        $myavatar = get_template_directory_uri() . '/assets/img/gravatar.png';
        $avatar_defaults[$myavatar] = "Custom Gravatar";
        return $avatar_defaults;
    }


}
