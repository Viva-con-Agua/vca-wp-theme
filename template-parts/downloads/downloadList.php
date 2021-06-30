<?php
    $headline = $args['headline'];
    $downloadsGroups = $args['downloadsGroups'];
    $class = $args['class'];
?>
<section class="downloadList <?php echo $class; ?>">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <?php if (isset($headline) && $headline !== '') { ?>
                    <h3 class="mb-md-3 mb-2"><?php echo $headline; ?></h3>
                <?php } ?>
            </div>
            <div class="col-12">
                <div class="downloadsGroups">
                    <div class="row">
                        <?php foreach ($downloadsGroups as $downloadsGroup) {
                            $downloadGroupHeadline = $downloadsGroup['downloadGroupHeadline'];
                            $downloads = $downloadsGroup['downloads'];

                            echo '<div class="col-12 col-md-4">';
                                if (isset($downloadGroupHeadline) && $downloadGroupHeadline !== '') {
                                    echo '<h4>'. $downloadGroupHeadline .'</h4>';
                                }

                                echo '<ul>';
                                    foreach ($downloads as $download) {
                                        $file = $download['download'];
                                        $url = $file['url'];
                                        $title = $file['title'];
                                        echo '<li><a target="_blank" href="'. $url .'">'. $title .'</a></li>';
                                    }
                                echo '</ul>';

                            echo '</div>';
                        } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

