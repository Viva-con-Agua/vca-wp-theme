<?php
    $instagramFollow = get_field('instagramFollow');
    $instagramTitle = get_field('instagramTitle');
?>


<section id="insta" class="pb-3 pb-md-5">
    <div class="container">
        <div class="row">
            <div class="col">
                <?php if (isset($instagramTitle) && $instagramTitle !== '') {
                    echo '<h2 class="pb-2 pb-md-2 fadeIn">'. $instagramTitle .'</h2>';
                } ?>

                <div class="instaFeed fadeInRow">
                    <?php   // #### Auskommentiert da Borlabs Entfernt wird
                            // echo do_shortcode('[borlabs-cookie id="instagram" type="content-blocker"][/borlabs-cookie]');

                        echo do_shortcode('[instagram-feed]');
                    ?>
                </div>

                <?php if (isset($instagramFollow) && $instagramFollow !== '') {
                    echo '<a class="btn mt-2" target="_blank" href="'. $instagramFollow .'">'. __('Jetzt Folgen', 'vca') .'</a>';
                } ?>
            </div>
        </div>
    </div>
</section>

