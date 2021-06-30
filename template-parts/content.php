<?php
if(isset($bigHeaderHeadline) && $bigHeaderHeadline != '') {
    $h1 = $bigHeaderHeadline;
} else if(is_404()){
    $h1 = _x( 'Die Seite wurde leider nicht gefunden', 'vca' );
}

if (isset($galleryImgs) && is_array($galleryImgs) && count($galleryImgs) > 0) {
    $theContentClass .= ' hasHeaderImg';
}

if(isset($theContent) && $theContent != '' || isset($h1) && $h1 !== ''){ ?>
    <section id="theContent" class="<?php echo $theContentClass; ?>">
        <div class="container">
            <div class="row">
                <div class="col col-md-8 offset-md-2">
                    <div class="contentContainer">
                        <h1><?php echo $h1 ?></h1>
                        <?php the_content(); ?>
                        <div class="clear"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php } ?>
