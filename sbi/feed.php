<?php
/**
 * Custom Feeds for Instagram Main Template
 * Creates the wrapping HTML and adds settings as attributes
 *
 * @version 2.1 Instagram Feed by Smash Balloon
 *
 */
// Don't load directly
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}
$feed_styles = SB_Instagram_Display_Elements::get_feed_style( $settings ); // already escaped
$sb_images_style = SB_Instagram_Display_Elements::get_sbi_images_style( $settings ); // already escaped
$image_resolution_setting = $settings['imageres'];
$cols_setting = $settings['cols'];
$num_setting = $settings['num'];
$icon_type = $settings['font_method'];
$itmeIndex = 0;

if ( $settings['showheader'] && ! empty( $posts ) && $settings['headeroutside'] ) {
	include sbi_get_feed_template_part( 'header', $settings );
}
?>

	<?php
	if ( $settings['showheader'] && ! empty( $posts ) && !$settings['headeroutside'] ) {
		include sbi_get_feed_template_part( 'header', $settings );
	}
	?>

		<?php
		if ( ! in_array( 'ajaxPostLoad', $flags, true ) ) {
			$this->posts_loop( $posts, $settings );
		}
		?>

<?php
/**
 * Things to add before the closing "div" tag for the main feed element. Several
 * features rely on this hook such as local images and some error messages
 *
 * @param object SB_Instagram_Feed
 * @param string $feed_id
 *
 * @since 2.1/5.2
 */
do_action( 'sbi_before_feed_end', $this, $feed_id ); ?>
