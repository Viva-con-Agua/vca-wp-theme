<?php
    $projectsTitle = get_field('projectsTitle');
    $projectsImg = get_field('projectsImg');
    $projectsContent = get_field('projectsContent');

    if (isset($projectsImg) && $projectsImg !== '') {
?>
    <section id="projects" class="mb-3 mb-md-0">
        <?php if (isset($projectsTitle) && $projectsTitle !== '') { ?>
            <div class="projectsTitle pb-md-3 pb-1">
                 <div class="container">
                    <div class="row">
                        <div class="col">
                            <h2><?php echo $projectsTitle; ?></h2>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
        <div class="row">
            <div class="col">
                <?php echo getPicture($projectsImg['ID'], 'biggest', 'lazy', array('biggest', 'large-medium', 'medium', 'small', 'small')); ?>
            </div>
        </div>
        <?php if (isset($projectsContent) && $projectsContent !== '') { ?>
            <div class="projectsContentContainer pt-3 pt-md-0">
                <div class="container">
                    <div class="row">
                        <div class="col col-md-6 offset-md-1 col-lg-7 offset-lg-0">
                            <div class="projectsContent blue">
                                <div class="fadeIn">
                                    <?php echo $projectsContent; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
    </section>
<?php } ?>
