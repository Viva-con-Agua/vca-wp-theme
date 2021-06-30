<?php

// Add Block Category
function addBlockCategory( $categories ) {
    $categories[] = array(
        'slug'  => 'vca-blocks',
        'title' => sprintf(__( 'Viva con agua', 'vca' )),
    );

    return $categories;
}
add_filter( 'block_categories', 'addBlockCategory' );

// Register ACF Blocks
function register_acf_blocks() {

    // check function exists.
    if( function_exists('acf_register_block_type') ) {

        // Gallery Slider BLock
        acf_register_block_type(array(
            'name' => 'gallerySlider',
            'title' => __('Galerie Slider', 'vca'),
            'description' => __('Bilder Slider im Carousel'),
            'render_template' => 'inc/blocks/gallerySlider.php',
            'category' => 'vca-blocks',
            'icon' => 'format-gallery',
            'mode' => 'edit',
            'keywords' => array('galerie', 'slider', 'bild', 'gallery'),
            'supports' => array(
                'align' => false,
                'mode' => false
            )
        ));

        // Video BLock
        acf_register_block_type(array(
            'name' => 'video',
            'title' => __('Video', 'vca'),
            'description' => __('Video als mp4 oder als Youtube Embed'),
            'render_template' => 'inc/blocks/video.php',
            'category' => 'vca-blocks',
            'icon' => 'format-video',
            'mode' => 'auto',
            'keywords' => array('video', 'youtube', 'player'),
            'supports' => array(
                'align' => true,
                'mode' => false
            )
        ));

        // FAQd BLock
        acf_register_block_type(array(
            'name' => 'faqs',
            'title' => __('FAQs', 'vca'),
            'description' => __('Erstellen von FAQs im Accordion'),
            'render_template' => 'inc/blocks/faqs.php',
            'category' => 'vca-blocks',
            'icon' => 'list-view',
            'mode' => 'edit',
            'keywords' => array('questions', 'fragen', 'faqs', 'faq'),
            'supports' => array(
                'align' => false,
                'mode' => false
            )
        ));

        // Info Box Block
        acf_register_block_type(array(
            'name' => 'infobox',
            'title' => __('Info Box', 'vca'),
            'description' => __('Infobox Content mit blauem Hintergrund'),
            'render_template' => 'inc/blocks/infoBox.php',
            'category' => 'vca-blocks',
            'icon' => 'text',
            'mode' => 'auto',
            'keywords' => array('info', 'box', 'content'),
            'supports' => array(
                'align' => false,
                'mode' => false
            )
        ));

        // Button Block
        acf_register_block_type(array(
            'name' => 'vcaButton',
            'title' => __('Button', 'vca'),
            'description' => __('Hier kann ein Link für einen Button hinterlegt werden.'),
            'render_template' => 'inc/blocks/button.php',
            'category' => 'vca-blocks',
            'icon' => 'button',
            'mode' => 'edit',
            'keywords' => array('Button', 'btn', 'CTA'),
            'supports' => array(
                'align' => false,
                'mode' => false
            )
        ));
    }
}
add_action('acf/init', 'register_acf_blocks');



add_filter( 'allowed_block_types', 'misha_allowed_block_types' );
function misha_allowed_block_types( $allowed_blocks ) {
    return array(
        'core/paragraph',
        'core/image',
        'core/heading',
        'core/list',
        'core/quote',
        'core/table',
        'core/code',
        'core/freeform',
        'core/html',
        'core/separator',
        'core/spacer',
        'core/shortcode',
        'core/embed',
        'core-embed/twitter',
        'core-embed/facebook',
        'core-embed/instagram',
        'core-embed/tumblr',
        'core/text-columns',
        'acf/galleryslider',
        'acf/video',
        'acf/faqs',
        'acf/infobox',
        'acf/vcabutton'
    );
}


