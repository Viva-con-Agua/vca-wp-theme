<?php

$imgTextImg = get_field('aboutTeaserImg');
$imgTextContent = get_field('aboutTeaserContent');

?>
<section id="aboutTeaser" class="py-3 py-md-4 blue">
    <?php get_template_part('template-parts/imgText', null,
        array(
            'img' => $imgTextImg,
            'content' => $imgTextContent,
            'class' => '',
            'bottle' => false
        )
    ); ?>
</section>
