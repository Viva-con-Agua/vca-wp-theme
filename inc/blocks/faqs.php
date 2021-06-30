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
$id = 'faqBlock-' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'faqBlock';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}

$faqHeadline = get_field('faqHeadline');
$faqs = get_field('faqs');

// Load values and assign defaults.
if (isset($faqs) && is_array($faqs) && count($faqs) > 0) { ?>
    <div id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?> my-3">
        <?php if (isset($faqHeadline) && $faqHeadline !== '') {
            echo '<h3 class="faqHeadline">'. $faqHeadline. '</h3>';
        } ?>
        <ul class="faqsContainer">
            <?php
            $faqsIndex = 1;
            foreach ($faqs as $faq) {
                $question = $faq['question'];
                $answer = $faq['answer'];
            ?>
            <li>
                <div class="question">
                    <span>#<?php echo $faqsIndex; ?></span> <p><?php echo $question; ?></p>
                </div>
                <div class="answer" style="display: none;">
                    <?php echo $answer; ?>
                </div>
            </li>
            <?php $faqsIndex++;
            } ?>
        </ul>
    </div>
<?php } ?>
