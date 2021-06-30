<?php

 /* Template Name: Ehrenamt Seite */

get_header();
if (have_posts()) : while (have_posts()) : the_post();
	$bigHeaderHeadline = get_field('bigHeaderHeadline');
    $galleryImgs = get_field('bigHeaderSlider');
    $theContent = get_the_content();
    $theContentClass = 'my-2 my-md-3 my-lg-4';

    $h1 = get_the_title();

    if(isset($bigHeaderHeadline) && $bigHeaderHeadline != '') {
        $h1 = $bigHeaderHeadline;
    } else if(is_404()){
        $h1 = _x( 'Die Seite wurde leider nicht gefunden', 'vca' );
    }

    if (isset($galleryImgs) && is_array($galleryImgs) && count($galleryImgs) > 0) {
        $theContentClass = 'my-2 my-md-3 my-lg-4 hasHeaderImg';
    }

    if (get_field('volunteerCTAContent')) {
        $ctaContent = get_field('volunteerCTAContent');
    };


	if(isset($theContent) && $theContent != ''){ ?>
        <section id="theContent" class="<?php echo $theContentClass; ?>">
            <div class="container">
                <div class="row">
                    <div class="col col-md-10 offset-md-1">
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

	endwhile;

else:

    get_template_part('template-parts/noContent');

endif;

echo '<div id="volunteerMap" class="mb-2 mb-md-3 mb-lg-4"></div>';

if (isset($ctaContent) && !empty($ctaContent)) :
    echo '<div class="container mb-4">';
        echo '<div class="row">';
            echo '<div class="col col-lg-6 offset-lg-6">';
                echo '<div class="volunteerCTAContent">';
                    echo $ctaContent;
                echo '</div>';
            echo '</div>';
        echo '</div>';
    echo '</div>';
endif;

include('template-parts/bellowPost.php');

get_footer(); ?>
