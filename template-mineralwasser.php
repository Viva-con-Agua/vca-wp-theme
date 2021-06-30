<?php

 /* Template Name: Mineralwasser Seite */

get_header();

if (have_posts()) : while (have_posts()) : the_post();
    $bigHeaderHeadline = get_field('bigHeaderHeadline');
    $galleryImgs = get_field('bigHeaderSlider');

    $mineralwasser = get_field('mineralwasser');

    $theContent = get_the_content();
    $theContentClass = 'mt-md-4 mt-3';

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
                    <div class="col-12">
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

    if (isset($mineralwasser) && is_array($mineralwasser) && count($mineralwasser) > 0) { ?>
        <section id="yearlyReports" class="my-md-4 my-3">
            <div class="container">
                <div class="row">
                    <?php foreach ($mineralwasser as $gebindeart) {
                        $gebindeart = $gebindeart['gebindeart'];
                        $mineralwasserImg = $mineralwasserImg['Img'];
                        $mineralwasserFile = $mineralwasserFile['file'];
                        $mineralwasserUrl = $mineralwasserUrl['url'];
                        ?>
                        <div class="col-sm-6 col-md-3">
                            <a target="_blank" href="<?php echo $reportUrl; ?>">
                                <div class="reportContainer">
                                    <?php echo getPicture($mineralwasserImg['ID'], 'small', 'lazy', array('small')); ?>
                                    <div class="reportTitle">
                                        <?php echo $mineralwasserTitle; ?>
                                    </div>
									<div class="reportTitle">
                                        <?php echo $mineralwasserUrl; ?>
                                    </div>
                                </div>
                            </a>
                        </div>
                    <?php } ?>
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
