<?php
    $cat = get_the_category();
    $thumb = get_post_thumbnail_id();
    $theContent = get_the_content();
    $postType = get_post_type();

?>

<div class="col-md-4 mb-2">
    <div class="postContent">
        <a href="<?php the_permalink(); ?>">
            <div class="contentContainer">
                <?php if (isset($cat) && is_array($cat) && count($cat) > 0) { ?>
                    <div class="postCat"><?php echo $cat[0]->name; ?></div>
                <?php }
                if (isset($thumb) && $thumb !== '' && $thumb !== 0) { ?>
                    <div class="thumb">
                        <?php echo getPicture($thumb, 'postThumb', 'lazy', array('postThumb', 'postThumbSmall', 'postThumb', 'postThumb', 'postThumbSmall')); ?>
                    </div>
                <?php } ?>

                <h4><?php echo the_title(); ?></h4>
                <?php if (isset($theContent) && $theContent !== '') {
                    echo getExcerptDynLength($theContent, 40);
                } ?>
            </div>
            <div class="btnContainer">
                <span class="btn secondary"><?php _e('Mehr lesen', 'vca'); ?></span>
            </div>
        </a>
    </div>
</div>
