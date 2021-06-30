<?php

    $golesSlider = get_field('golesSlider');

?>
<section id="goles">
    <div class="row">
        <div class="col">
            <?php if (isset($golesSlider) && is_array($golesSlider) && count($golesSlider) > 0) { ?>
                <div id="golesImgSlider" class="swiper-container">
                    <div class="swiper-wrapper">
                        <?php foreach ($golesSlider as $slide) {
                            $slideGallyer = $slide['slideGallyer'];
                            echo '<div class="swiper-slide golesImgSlide">';
                                foreach ($slideGallyer as $GalleryImg) {
                                    echo '<div class="golesImg">';
                                        echo getPicture($GalleryImg['ID'], 'biggest', 'lazy', array('biggest', 'large-medium', 'medium', 'small', 'small'));
                                    echo '</div>';
                                }
                            echo '</div>';
                        } ?>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col col-md-10 offset-md-1">
                <?php if (isset($golesSlider) && is_array($golesSlider) && count($golesSlider) > 0) { ?>
                    <div class="golesContentSliderContainer blue">
                        <div class="golesSliderNav">
                            <div class="swiper-button-next"></div>
                            <div class="swiper-button-prev"></div>
                            <div class="swiper-pagination"></div>
                        </div>
                        <div id="golesContentSlider" class="swiper-container pb-3 pb-md-0 mb-3 mb-md-5">
                            <div class="swiper-wrapper">
                                <?php foreach ($golesSlider as $slide) {
                                    $slideContent = $slide['slideContent'];
                                    echo '<div class="swiper-slide">';
                                        echo '<div class="slideContent">';
                                            echo $slideContent;
                                        echo '</div>';
                                    echo '</div>';
                                } ?>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</section>
