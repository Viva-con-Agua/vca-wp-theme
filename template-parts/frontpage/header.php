<?php
    $theID = hmGetId();
    $title = hmGetTitle();
    $frontpageHeaderSlider = get_field('frontpageHeaderSlider');


    if (isset($frontpageHeaderSlider) && is_array($frontpageHeaderSlider) && count($frontpageHeaderSlider) > 0) {
?>
<section id="frontPageHeader"  class="mb-2 mb-md-0">
    <div class="container">
        <div class="row">

            <div class="col col-md-6 colSliderContent mb-2 mb-md-0">
                <div id="frontpageSliderContent" class="fadeIn swiper-container">
                    <div class="swiper-wrapper">
                        <?php foreach ($frontpageHeaderSlider as $slide) {
                            $slideContent = $slide['slideContent'];
                        ?>
                            <div class="swiper-slide">
                                <div class="slideContent">
                                   <?php echo $slideContent; ?>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>

            <div class="col col-md-6">
                <div id="frontpageSliderImg" class="swiper-container">
                    <div class="swiper-wrapper">
                        <?php foreach ($frontpageHeaderSlider as $slide) {
                            $slideImg = $slide['slideImg'];
                            $slideStyle = '';
                            if (isset($slideImg) && is_array($slideImg) && count($slideImg) > 0) {
                                $slideStyle = 'data-bg="'. $slideImg['sizes']['large-medium'] .'" style="background-image: url(&apos;'. $slideImg['sizes']['placeholder'] .'&apos;);"';
                            }
                        ?>
                            <div class="swiper-slide lazy" <?php echo $slideStyle; ?>></div>
                        <?php } ?>
                    </div>
                </div>

                <div class="frontpageSliderImgNavigation">
                    <div class="swiper-button-next"></div>
                    <div class="swiper-button-prev"></div>
                    <div class="swiper-pagination"></div>
                </div>

            </div>

        </div>
    </div>




</section>
<?php } ?>
