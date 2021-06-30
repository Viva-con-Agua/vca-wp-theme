<?php

$imgTextImg = get_field('memberTeaserImg');
$imgTextContent = get_field('memberTeaserContent');

?>
<section id="memberTeaser" class="py-3 py-lg-4 blue">
    <?php get_template_part('template-parts/imgText', null,
        array(
            'img' => $imgTextImg,
            'content' => $imgTextContent,
            'class' => 'left',
            'bottle' => false
        )
    ); ?>
</section>
