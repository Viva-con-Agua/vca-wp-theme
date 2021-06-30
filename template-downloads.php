<?php

 /* Template Name: Download Seite */

get_header();

if (have_posts()) : while (have_posts()) : the_post();
    $bigHeaderHeadline = get_field('bigHeaderHeadline');
    $galleryImgs = get_field('bigHeaderSlider');
    $downloadsRepeater = get_field('downloadsRepeater');

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
        <section id="theContent" class="my-2 my-md-4 <?php echo $theContentClass; ?>">
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

    if (isset($downloadsRepeater) && is_array($downloadsRepeater) && count($downloadsRepeater) > 0) {

        $groupIndex = 0;
        foreach ($downloadsRepeater as $group) {
            $downloadsHeadline = $group['downloadsHeadline'];
            $downloadsId = str_replace(' ', '_', $downloadsHeadline);
            $downloadsType = $group['downloadsType'];
            $downloadsGroups = $group['downloadsGroups'];
            $downloadGrid = $group['downloadGrid'];

            $groupClass = 'py-2 py-lg-4';

            if ($groupIndex % 2 == 0) {
                $groupClass .= ' even blue';
            }

            if ($downloadsType === 'downloadGridProduct') {
                $groupClass .= ' even blue'. $downloadsType;
            }

            if ($downloadsType === 'downloadList') {
                get_template_part('template-parts/downloads/downloadList', null,
                    array(
                        'headline' =>  $downloadsHeadline,
                        'downloadsGroups' => $downloadsGroups,
                        'class' => $groupClass
                    )
                );
            } else {
                get_template_part('template-parts/downloads/downloadGrid', null,
                    array(
                        'headline' =>  $downloadsHeadline,
						'downloadsId' => $downloadsId,
                        'downloadGrid' => $downloadGrid,
                        'class' => $groupClass
                    )
                );
            }

            $groupIndex++;
        }
    }



        include('template-parts/bellowPost.php');

	endwhile;
else:


	get_template_part('template-parts/noContent');
endif;
get_footer(); ?>
