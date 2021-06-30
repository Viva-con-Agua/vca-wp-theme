<?php
    $theID = hmGetId();
    $title = hmGetTitle();
    $termId = hmGetTermId();

    //vars & acf
    $imgCounter = 0;
    $hasImg = 'hasNoImg';
    $bigHeaderHeadline = get_field('bigHeaderHeadline', $theID);
    $galleryImgs = get_field('bigHeaderSlider', $theID);

    if(isset($bigHeaderHeadline) && $bigHeaderHeadline != '') {
        $h1 = $bigHeaderHeadline;
    } else if(is_404()){
        $h1 = _x( 'Die Seite wurde leider nicht gefunden', 'vca' );
    } else {
        $h1 = $title;
    }

    if(is_array($galleryImgs) && count($galleryImgs) > 0){
        $imgCounter = count($galleryImgs);
    }

    if ($imgCounter > 0) {
        $hasImg = 'hasImg';
        $firstImg = $galleryImgs[0]['sizes']['biggest'];
        $bigHeaderStyles = 'style="background-image: url(&apos;' . $firstImg . '&apos;)"';
    }


    if (!is_single() && !is_page() || is_single() && $imgCounter > 0 || is_page_template('template-team.php') || is_page() && $imgCounter > 0) {
?>

    <section id="bigHeaderWrapper" class="<?php echo $hasImg; ?>">
        <div class="bigHeader">
            <?php if ($imgCounter == 1) {?>
                <div class="headerBg" <?php echo $bigHeaderStyles; ?>></div>
            <?php } else if($imgCounter > 1){ ?>
                    <div id="ownHeaderSlider" class="swiper-container">
                        <div class="swiper-wrapper">
                            <?php foreach ($galleryImgs as $galleryImg) {
                                $bigHeaderImgSize = $galleryImg['sizes']['biggest'];
                                $bigHeaderStyles = 'style="background-image: url(' . $bigHeaderImgSize . ')"';
                            ?>
                                <div class="swiper-slide" <?php echo $bigHeaderStyles; ?>></div>
                            <?php } ?>
                        </div>
                        <div class="swiper-button-next"></div>
                        <div class="swiper-button-prev"></div>
                    </div>
            <?php }

            if (!is_single() && !is_page() || is_page_template('template-team.php')) { ?>
                <div class="container">
                    <div class="row">
                        <div class="col">
                            <div class="bigHeaderContent fadeIn">
                                <div class="inner follower">
                                    <h1><?php echo $h1 ?></h1>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </section>

<?php } ?>
