<?php

 /* Template Name: Deine Aktion Seite */

get_header();

if (have_posts()) : while (have_posts()) : the_post();
    $bigHeaderHeadline = get_field('bigHeaderHeadline');
    $galleryImgs = get_field('bigHeaderSlider');

    $actionsContent = get_field('actionsContent');
    $actionsIframe = get_field('actionsIframe');

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

    if (isset($actionsContent) && $actionsContent !== '') {

        $actionsContentCol = 'col';

        if (isset($actionsIframe) && $actionsIframe !== '') {
            $actionsContentCol = 'col-md-7 mb-3 mb-md-0';
        }
        ?>
        <section id="actions" class="my-2 my-md-3 my-lg-4 <?php echo $theContentClass; ?>">
            <div class="container">
                <div class="actionsContainer py-3">
                    <div class="row">
                        <div class="<?php echo $actionsContentCol; ?>">
                            <?php echo $actionsContent; ?>
                        </div>
                        <?php if (isset($actionsIframe) && $actionsIframe !== '') { ?>
                            <div class="col-md-5">
                                <div class="actionsIframe">
                                    <iframe height="600" width="100%" frameborder="0" src="<?php echo$actionsIframe; ?>" scrolling="no"></iframe>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </section>
    <?php }

    include('template-parts/bellowPost.php');

    endwhile;
else:
    get_template_part('template-parts/noContent');
endif;
get_footer(); ?>
