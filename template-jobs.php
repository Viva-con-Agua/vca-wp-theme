<?php

 /* Template Name: Jobs Seite */

get_header();

if (have_posts()) : while (have_posts()) : the_post();
    $bigHeaderHeadline = get_field('bigHeaderHeadline');
    $galleryImgs = get_field('bigHeaderSlider');

    $infoAreaImg = get_field('infoAreaImg');
    $infoAreaContent = get_field('infoAreaContent');

    $offer = get_field('offer');
    $notOffer = get_field('notOffer');

    $bringWithContent = get_field('bringWithContent');
    $bringWithImg = get_field('bringWithImg');

    $theContent = get_the_content();
    $theContentClass = 'mt-4';

    $h1 = get_the_title();

    if(isset($bigHeaderHeadline) && $bigHeaderHeadline != '') {
        $h1 = $bigHeaderHeadline;
    } else if(is_404()){
        $h1 = _x( 'Die Seite wurde leider nicht gefunden', 'vca' );
    }

    if (isset($galleryImgs) && is_array($galleryImgs) && count($galleryImgs) > 0) {
        $theContentClass = ' hasHeaderImg';
    }

    if(isset($theContent) && $theContent != '' || isset($h1) && $h1 !== ''){ ?>
        <section id="theContent" class="my-2 my-md-3 my-lg-4 <?php echo $theContentClass; ?>">
            <div class="container">
                <div class="row">
                    <div class="col col-md-12">
                        <div class="contentContainer">
                            <h1><?php echo $h1 ?></h1>
                            <?php the_content(); ?>
                            <div class="clear"></div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    <?php }

    if (isset($infoAreaContent) && $infoAreaContent !== '' && isset($infoAreaImg) && $infoAreaImg !== '') { ?>
        <section id="infoArea" class="my-2 my-md-3 my-lg-4">
            <?php get_template_part('template-parts/imgText', null,
                array(
                    'img' => $infoAreaImg,
                    'content' => $infoAreaContent,
                    'class' => 'right smaller',
                    'bottle' => false
                )
            ); ?>
        </section>
    <?php }

    if (isset($offer) && $offer !== '' && isset($notOffer) && $notOffer !== '') { ?>
        <section id="offer" class="my-2 my-md-3 my-lg-4 py-3 blue">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 mb-3 mb-md-0">
                        <div class="offer">
                            <?php echo $offer; ?>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="notOffer">
                            <?php echo $notOffer; ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    <?php }

    if (isset($bringWithContent) && $bringWithContent !== '' && isset($bringWithImg) && $bringWithImg !== '') { ?>
        <section id="bringWith" class="my-2 my-md-3 my-lg-4">
            <?php get_template_part('template-parts/imgText', null,
                array(
                    'img' => $bringWithImg,
                    'content' => $bringWithContent,
                    'class' => 'left smaller',
                    'bottle' => false
                )
            ); ?>
        </section>
    <?php }

    include('template-parts/bellowPost.php');

    endwhile;
else:
    get_template_part('template-parts/noContent');
endif;
get_footer(); ?>
