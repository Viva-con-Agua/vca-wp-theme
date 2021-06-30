<?php

/**
 * Gallery Slider Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'galleryBlock-' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'galleryBlock';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}

// Load values and assign defaults.
$sliderblock = get_field('sliderblock');

if (isset($sliderblock) && is_array($sliderblock) && count($sliderblock) > 0) {
?>
    <div id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?>">

        <?php if (count($sliderblock) > 2) { ?>
            <div class="gallerySliderBlock swiper-container">
                <div class="swiper-wrapper">
                    <?php foreach ($sliderblock as $sliderImg) { ?>
                        <div class="swiper-slide">
                            <?php echo getPicture($sliderImg['ID'], 'blockGallery', 'lazy', array('blockGallery')); ?>
                        </div>
                    <?php } ?>
                </div>
                <div class="swiper-nav">
                    <div class="swiper-button-next"></div>
                    <div class="swiper-button-prev"></div>
                </div>
            </div>
        <?php } else { ?>
            <div class="gallerySliderBlock galleryGrid d-flex justify-content-center align-items-center">
                <?php foreach ($sliderblock as $sliderImg) { ?>
                    <?php echo getPicture($sliderImg['ID'], 'blockGallery', 'lazy', array('blockGallery')); ?>
                <?php } ?>
            </div>
        <?php } ?>
    </div>
<?php } ?>
