<?php
/**
 * Custom Feeds for Instagram Footer Template
 * Adds pagination and html for errors and resized images
 *
 * @version 2.1 Instagram Feed by Smash Balloon
 *
 */

// Don't load directly
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

?>

<div class="col-xs-8 col-sm-4 col-xs-offset-2 col-sm-offset-1">
    <div class="instaField">
        <div class="instaField-content">
            <h3 class="strong--light"><strong><?php _e( 'Instagram','vca' ); ?></strong></h3>
            <a class="btn" target="_blank" href="<?php echo esc_url( 'https://www.instagram.com/' . $first_username ); ?>"><?php _e( 'Folgen','vca' ); ?></a>
        </div>
    </div>
</div>
