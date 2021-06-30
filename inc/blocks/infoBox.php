<?php

/**
 * Video Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'infoboxBlock-' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'infoboxBlock';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}

// Load values and assign defaults.
$infoBoxContent = get_field('infoBoxContent');

if (isset($infoBoxContent) && $infoBoxContent !== '') {
?>
    <div id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?>">
        <div class="infoBoxContentContainer blue">
            <?php echo $infoBoxContent; ?>
        </div>
    </div>
<?php } ?>
