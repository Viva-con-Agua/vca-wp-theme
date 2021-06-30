<?php
$footerOurFamliy = get_field('footerOurFamliy', 'options');


if (isset($footerOurFamliy) && $footerOurFamliy !== '') { ?>

<section id="footerFamily" class="py-3 py-lg-4 blue">
    <div class="container">
        <div class="row">
            <div class="col">
                <h3 class="mb-2 fadeIn text-center text-sm-left"><?php _e('Unsere Family', 'vca'); ?></h3>
            </div>
        </div>
        <div class="row">
            <div class="col ourFamily d-flex flex-wrap flex-md-nowrap justify-content-center justify-content-md-between align-items-center familyImgContainer fadeInRow">
                <?php foreach ($footerOurFamliy as $familyMember) {
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
</section>

<?php } ?>
