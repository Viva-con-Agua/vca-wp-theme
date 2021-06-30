<?php
/**
 * Custom Feeds for Instagram Item Template
 * Adds an image, link, and other data for each post in the feed
 *
 * @version 2.1 Instagram Feed by Smash Balloon
 *
 */

// Don't load directly
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

$permalink = SB_Instagram_Parse::get_permalink( $post );
$media_url = SB_Instagram_Display_Elements::get_optimum_media_url( $post, $settings );
$placeholder = get_stylesheet_directory_uri() . '/assets/img/placeholder.png';
$instaContent = '<a target="_blank" href="'. esc_url( $permalink ). '"><div class="instaContent lazy" data-bg="'. $media_url. '" style="background-image: url('. $placeholder. ');"></div></a>';
?>

<div class="instaContainer" >
    <?php echo $instaContent; ?>
</div>
