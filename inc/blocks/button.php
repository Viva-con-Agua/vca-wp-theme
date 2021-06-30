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
$id = 'buttonBlock-' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'buttonBlock';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}

// Load values and assign defaults.
$button = get_field('button');

if (isset($button) && is_array($button) && count($button) > 0) {
    $title = $button['title'];
    $url = $button['url'];
    $target = '';
    $blank = $button['target'];

    if (isset($blank) && $blank !== '') {
        $target = 'target="'. $blank .'"';
    }
?>
    <p id="<?php echo esc_attr($id); ?>">
        <a <?php echo $target; ?> class="btn <?php echo esc_attr($className); ?>" href="<?php echo $url; ?>"><?php echo $title; ?></a>
    </p>
<?php } ?>
