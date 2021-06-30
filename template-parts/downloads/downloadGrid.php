<?php
    $headline = $args['headline'];
    $downloadGrid = $args['downloadGrid'];
    $class = $args['class'];
	$id = $args['downloadsId'];
	$downloadsId = (isset($id) && $id !== '') ? ' id="' . $id . '"' : '';
?>
<section class="downloadGrid <?php echo $class; ?>" <?php echo $downloadsId; ?>>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <?php if (isset($headline) && $headline !== '') { ?>
                    <h3 class="mb-3"><?php echo $headline; ?></h3>
                <?php } ?>
            </div>
            <div class="col-12">
                <div class="downloadsGroups">
                    <div class="row">
                        <?php foreach ($downloadGrid as $download) {
                            $downloadImg = $download['downloadImg'];
                            $downloadFile = $download['downloadFile'];
                            ?>
                            <div class="col-12 col-md-4 pb-2">
                                <a target="_blank" href="<?php echo $downloadFile['url'] ?>">
                                    <div class="downloadGridContent">
                                        <?php if (isset($downloadImg) && is_array($downloadImg) && count($downloadImg) > 0) {
                                            echo getPicture($downloadImg['ID'], 'small', 'lazy', array('small', 'small', 'medium', 'medium', 'small'));
                                        } ?>
                                        <div class="downloadFileContent">
                                            <h4><?php echo $downloadFile['title']; ?></h4>
                                            <div class="btnContainer">
                                                <p class="btn secondary"><?php _e('Zum Download', 'vca'); ?></p>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <?php
                        } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

