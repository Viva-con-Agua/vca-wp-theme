<?php
$footerOurFamliySmall = get_field('footerOurFamliySmall', 'options');
$familyHeadline = get_field('familyHeadline', 'options');
$socialHeadline = get_field('socialHeadline', 'options');
$cat1Headline = get_field('cat1Headline', 'options');
$cat2Headline = get_field('cat2Headline', 'options');
$contactHeadline = get_field('contactHeadline', 'options');

?>
<footer class="footer">

    <div class="blue subFooter pt-4 pb-md-3 pb-2">
        <div class="container">
            <div class="row fadeInRow">
                <div class="col-sm-6 col-md-4 col-lg-3 mb-1 mb-md-0">
                    <?php if (isset($cat1Headline) && $cat1Headline !== '') {
                        echo '<h4 class="headlineLine">'. $cat1Headline .'</h4>';
                    }
                    html5blank_nav('cat1-menu'); ?>
                </div>
                <div class="col-sm-6 col-md-4 col-lg-3 mb-1 mb-md-0">
                    <?php if (isset($cat2Headline) && $cat2Headline !== '') {
                        echo '<h4 class="headlineLine">'. $cat2Headline .'</h4>';
                    }
                    html5blank_nav('cat2-menu'); ?>
                </div>
                <div class="col-sm-6 col-md-4 col-lg-3 mb-2 mb-md-0">
                    <?php if (isset($contactHeadline) && $contactHeadline !== '') {
                        echo '<h4 class="headlineLine">'. $contactHeadline .'</h4>';
                    }
                    html5blank_nav('contact-menu'); ?>
                </div>
                <div class="col-sm-12 col-lg-3 mt-md-1 mt-lg-0">
                    <div class="row">
                        <div class="social col-sm-6 col-lg-12">
                            <?php if (isset($socialHeadline) && $socialHeadline !== '') {
                                echo '<h4>'. $socialHeadline .'</h4>';
                            }
                                get_template_part('template-parts/social');
                            ?>
                        </div>
                        <div class="family col-sm-6 col-lg-12">
                            <?php if (isset($familyHeadline) && $familyHeadline !== '') {
                                echo '<h4>'. $familyHeadline .'</h4>';
                            } ?>
                            <div class="footerOurFamliySmall ourFamily d-flex flex-row justify-content-between align-items-center">
                                <?php foreach ($footerOurFamliySmall as $familyMember) {
                                    $familyImg = $familyMember['familyImg'];
                                    $familyUrl = $familyMember['familyUrl'];
                                    ?>
                                    <div class="familyImg">
                                        <a target="_blank" href="<?php echo $familyUrl; ?>">
                                            <?php echo getPicture($familyImg['ID'], 'tiny', 'lazy', array('tiny')); ?>
                                        </a>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="footerEnd darkBlue py-1">
        <div class="container">
            <div class="row">
                <div class="col d-md-flex justify-content-between fadeInRow">
                    <p class="copyright">
                        &copy; <?php echo date('Y'); ?> <?php echo get_bloginfo(); ?>
                    </p>
                    <div class="footerMenu">
                        <?php html5blank_nav('footer-menu'); ?>
                        <a class="herrlich" target="_blank" href="http://herrlich.media" title="herrlich media">
                            <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="207.8 46.8 71 19.4" enable-background="new 207.8 46.8 71 19.4" xml:space="preserve">
                                <path d="M243.2,49.4c-14.5-6.7-19.4,14.7-35-2.1c0,18,23.9,23.8,35,13.4c11.1,10.3,35,4.5,35-13.4
                                C262.7,64,257.7,42.7,243.2,49.4z"></path>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

</footer>
