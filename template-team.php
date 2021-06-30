<?php

 /* Template Name: Team Seite */

get_header();
if (have_posts()) : while (have_posts()) : the_post();
	$theContent = get_the_content();
    $teamGroups = get_field('teamGroups');


	if(isset($theContent) && $theContent != ''){ ?>
        <section id="theContent" class="mt-5">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <?php the_content(); ?>
                    </div>
                </div>
            </div>
        </section>
    <?php }

    if (isset($teamGroups) && $teamGroups !== '' && is_array($teamGroups) && count($teamGroups) > 0) { ?>
        <section id="teamGroups">
            <div class="container">

                <?php foreach ($teamGroups as $teamGroup) {
                        $type = $teamGroup['anzeigeart'];
                ?>
                    <div class="teamGroup mb-3 my-md-3 my-lg-4">
                        <?php if ($type === 'list') {
                            $teamMember = $teamGroup['teamMember'];
                            $teamTitle = $teamGroup['teamTitle'];

                            if (isset($teamTitle) && $teamTitle !== '') { ?>
                            <div class="row">
                                <div class="col-12">
                                    <h3 class="teamTitle mb-2"><?php echo $teamTitle; ?></h3>
                                </div>
                            </div>
                            <?php }
                            if (isset($teamMember) && is_array($teamMember) && count($teamMember) > 0) {
                                echo '<div class="row teamGroupRow">';
                                    foreach ($teamMember as $member) {
                                        get_template_part('template-parts/team/member', null,
                                            array(
                                                'id' => $member->ID,
                                                'size' => 'small',
                                                'index' => false
                                            )
                                        );
                                    }
                                    echo '<a class="btn more" style="display: block;" href="javascript:;">'. __('Mehr anzeigen', 'vca') .'</a>';
                                echo '</div>';
                            } ?>
                        <?php } else {
                            $teamImg = $teamGroup['teamImg'];
                            $namePositions = $teamGroup['namePositions'];
                            $teamContent = $teamGroup['TeamContent'];

                            ?>
                            <div class="row">
                                <?php if (isset($teamContent) && $teamContent !== '') { ?>
                                    <div class="col-md-6 d-flex align-items-center">
                                        <div class="teamContent">
                                            <?php echo $teamContent; ?>
                                        </div>
                                    </div>
                                <?php } ?>
                                <?php if (isset($teamImg) && $teamImg !== '') { ?>
                                    <div class="col-md-6 my-2 my-md-0 d-flex align-items-center">
                                        <div class="teamImg">
                                            <?php if (isset($namePositions) && is_array($namePositions) && count($namePositions) > 0) {
                                                $nameIndex = 0;
                                                foreach ($namePositions as $namePosition) {
                                                    $name = $namePosition['name'];
                                                    $namePosTop = $namePosition['namePosTop'];
                                                    $namePosLeft = $namePosition['namePosLeft'];
                                                    $nameClass = '';
                                                    $turn = rand (0,1);

                                                    if ($namePosTop > 49) {
                                                        $nameClass .= 'bottom';
                                                    }
                                                    if ($nameIndex % 2 == 0) {
                                                        $nameClass .= ' odd';
                                                    }
                                                    if ($turn === 1) {
                                                        $nameClass .= ' turn';
                                                    }
                                                ?>
                                                <div class="name <?php echo $nameClass; ?>" style="left: <?php echo $namePosLeft; ?>%; top: <?php echo $namePosTop; ?>%;">
                                                    <p><strong><?php echo $name; ?></strong></p>
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="44.5" height="44.438" viewBox="0 0 44.5 44.438">
                                                        <path d="M23.462,16.829c1.152-.972,2.254-1.936,3.4-2.85a11.22,
                                                        11.22,0,0,1,1.72-1.113.771.771,0,0,1,1.191.467,3.56,3.56,0,0,1,
                                                        .286,1.709,22.52,22.52,0,0,0,.049,6.721c.2,2.531.611,5.045.924,
                                                        7.567a2.612,2.612,0,0,1,.024.736,2.207,2.207,0,0,1-.857,1.762,
                                                        2.146,2.146,0,0,1-2.111-.737c-1.133-2.193-3.347-3.276-5-4.925a37.567,
                                                        37.567,0,0,0-4.779-3.42A15.835,15.835,0,0,1,16.863,21.4l2.174-2.484a18.08,
                                                        18.08,0,0,0-3.977-3.155A100.076,100.076,0,0,0,2.585,8.552a14.081,14.081,
                                                        0,0,1-1.8-1.006,1.311,1.311,0,0,1-.6-1.875A1.546,1.546,0,0,1,2.1,
                                                        4.756a6.3,6.3,0,0,1,1.657.6c2,1.24,3.96,2.547,5.941,3.817q3.16,
                                                        2.025,6.337,4.024c.106.067.273.039.607.079A63.512,63.512,0,0,0,
                                                        .353,1.79L1.251,0C2.829.806,4.308,1.455,5.68,2.28a77.4,77.4,0,0,
                                                        1,13.333,10.2C20.5,13.9,21.955,15.354,23.462,16.829Z"
                                                        transform="translate(20.79 44.438) rotate(-132)" fill="#fff"/>
                                                    </svg>
                                                </div>
                                                <?php $nameIndex++;
                                                }
                                            } ?>

                                            <?php echo getPicture($teamImg['ID'], 'medium', 'lazy', array('medium', 'medium', 'medium', 'small', 'small')); ?>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>

                        <?php } ?>
                    </div>
                <?php } ?>
            </div>
        </section>
    <?php }

        include('template-parts/bellowPost.php');

	endwhile;
else:


	get_template_part('template-parts/noContent');
endif;
get_footer(); ?>
