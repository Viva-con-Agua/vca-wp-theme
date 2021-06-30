<?php
    $thumb = get_post_thumbnail_id();
    $theContent = get_the_content();
?>

<div class="col col-md-6">
    <div class="postContent">
        <a href="<?php the_permalink(); ?>">
            <?php if (isset($thumb) && $thumb !== '') { ?>
                <div class="thumb">
                    <?php echo getPicture($thumb, 'postThumb', 'lazy', array('postThumb')); ?>
                </div>
            <?php } ?>
            <div class="contentContainer">
                <div class="content">
                    <h4><?php echo the_title(); ?></h4>
                    <?php if (isset($theContent) && $theContent !== '') {
                        echo getExcerptDynLength($theContent, 25);
                    } ?>
                </div>
                <div class="btnContainer">
                    <span class="btn"><?php _e('Zur Aktion', 'vca'); ?></span>
                </div>
            </div>
        </a>
    </div>
</div>
