<?php
    $canvas = get_field('canvas', 'options');
    $imgTextImg = $args['img'];
    $imgTextContent = $args['content'];
    $class = $args['class'];
    $bottle = $args['bottle'];

?>
<div class="imgText <?php echo $class; ?>">
    <div class="container">
        <div class="row">
            <?php if (isset($imgTextImg) && is_array($imgTextImg) && count($imgTextImg) > 0) { ?>
                <div class="col-md-6">
                    <?php if ($bottle === true) { ?>

                    <div class="bottleContainer">
                        <div class="bottleImg">
                            <?php echo getPicture($imgTextImg['ID'], 'mediumHeight', 'lazy bottle', array('mediumHeight', 'mediumHeight', 'smallHeight')); ?>
                        </div>
                    </div>

                    <?php } else { ?>

                        <div class="imgTextImgContainer">
                            <?php echo getPicture($canvas['ID'], 'medium', 'imgTextImgContainerBg lazy', array('medium')); ?>
                            <div class="imgTextImgWrap">
                                <div class="imgTextImg lazy" data-parallaxwrap data-direction="up" data-speed="75" data-bg="<?php echo $imgTextImg['sizes']['large-medium']; ?>" style="background-image: url(<?php echo $imgTextImg['sizes']['placeholder']; ?>);"></div>
                            </div>
                        </div>

                    <?php } ?>
                </div>
            <?php }
            if (isset($imgTextContent) && $imgTextContent !== '') { ?>
                <div class="col-md-6">
                    <div class="imgTextContent py-md-2 pt-2 py-lg-3 fadeIn">
                        <?php echo $imgTextContent; ?>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</div>

