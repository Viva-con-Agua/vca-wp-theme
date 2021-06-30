<?php
    if (have_posts()):?>

        <section id="events" class="mt-md-4 mt-0 mb-md-4 mb-2">
            <div class="container">
                <div class="row">
                    <?php
                    while (have_posts()) : the_post();
                        get_template_part('template-parts/events/postContent');
                    endwhile;
                    get_template_part('pagination');
                    ?>
                </div>
            </div>
        </section>
    <?php else:
        get_template_part('template-parts/noContent');
    endif;
?>
