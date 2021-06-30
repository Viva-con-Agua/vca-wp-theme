<?php

$imgTextImg = get_field('bottleTeaserImg');
$imgTextContent = get_field('bottleTeaserContent');

?>
<section id="bottle" class="py-3 py-lg-4 blue">
    <?php get_template_part('template-parts/imgText', null,
        array(
            'img' => $imgTextImg,
            'content' => $imgTextContent,
            'class' => 'left',
            'bottle' => true
        )
    ); ?>
</section>
