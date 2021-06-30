<?php

$size = $args['size'];
$memberId = $args['id'];
$index = $args['index'];
$col = 'col-6 col-md-3';
$memberThumb = get_post_thumbnail_id($memberId);
$memberPosition = get_field('memberPosition', $memberId);
$memberEmail = get_field('memberEmail', $memberId);
$memberShortDesc = get_field('memberShortDesc', $memberId);

if ($size === 'big') {
    $col = 'col-12 col-lg-9 offset-lg-3 big odd';
    if ($index % 2 == 0) {
        $col = 'col-12 col-lg-9 big even';
    }
} ?>

<div class="<?php echo $col; ?>">
    <div class="memberContent">
        <div class="memberThumb">
            <?php echo getPicture($memberThumb, 'memberThumb', 'lazy', array('memberThumb')); ?>
            <div class="memberInfos">
                <?php if ($size === 'big') { ?>
                    <h3><?php echo get_the_title($memberId); ?></h3>
                    <?php if (isset($memberShortDesc) && $memberShortDesc !== '') { ?>
                        <?php echo $memberShortDesc; ?>
                    <?php } ?>
                    <a class="btn secondary" href="mailto:<?php echo $memberEmail; ?>"><?php _e('Kontaktieren', 'vca'); ?></a>
                <?php } else { ?>
                    <p><strong><?php echo get_the_title($memberId); ?></strong></p>
                    <?php if (isset($memberPosition) && $memberPosition !== '') {
                    echo '<p>'. $memberPosition .'</p>';
                    }
                    if (isset($memberEmail) && $memberEmail !== '') {
                        echo '<a href="mailto:'. $memberEmail .'">'. $memberEmail .'</a>';
                    }
                } ?>
            </div>
        </div>
    </div>
</div>
