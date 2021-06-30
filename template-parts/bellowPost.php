    <?php
    $theID = hmGetId();
    $similarPostsHeadline = get_field('similarPostsHeadline', $theID);
    $similarPosts = get_field('similarPosts');
    $contactPersonHeadline = get_field('contactPersonHeadline', $theID);
    $contactPerson = get_field('contactPerson', $theID);
    $downloadsHeadline = get_field('downloadsHeadline', $theID);
    $downloadsGroups = get_field('downloadsGroups', $theID);

    if (isset($similarPosts) && is_array($similarPosts) && count($similarPosts) > 0) { ?>
        <section id="similarPosts" class="my-md-4 my-3">
            <div class="container">
                <div class="row">
                    <div class="col">
                        <?php if (isset($similarPostsHeadline) && $similarPostsHeadline !== '') { ?>
                            <h2 class="mb-md-3 mb-2"><?php echo $similarPostsHeadline; ?></h2>
                        <?php } ?>
                        <div class="row">
                            <?php foreach ($similarPosts as $post) {
                                setup_postdata($post);
                                get_template_part('template-parts/news/postContent');
                            }
                            wp_reset_postdata(); ?>
                        </div>

                    </div>
                </div>
            </div>
        </section>
    <?php }

    if (isset($contactPerson) && is_array($contactPerson) && count($contactPerson) > 0) { ?>
        <section id="contactPerson" class="my-md-4 my-3">
            <div class="container">
                <div class="row">
                    <div class="col">
                        <?php if (isset($contactPersonHeadline) && $contactPersonHeadline !== '') { ?>
                            <h2 class="mb-md-3 mb-2"><?php echo $contactPersonHeadline; ?></h2>
                        <?php } ?>
                        <div class="row">
                            <?php
                            $memberIndex = 1;
                            foreach ($contactPerson as $member) {
                                get_template_part('template-parts/team/member', null,
                                    array(
                                        'id' => $member->ID,
                                        'size' => 'big',
                                        'index' => $memberIndex
                                    )
                                );
                                $memberIndex++;
                            } ?>
                        </div>

                    </div>
                </div>
            </div>
        </section>
    <?php }

    if (isset($downloadsGroups) && is_array($downloadsGroups) && count($downloadsGroups) > 0) {
        get_template_part('template-parts/downloads/downloadList', null,
            array(
                'headline' =>  $downloadsHeadline,
                'downloadsGroups' => $downloadsGroups,
                'class' => 'bellowPost py-2 py-lg-4'
            )
        );
    }
