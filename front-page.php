<?php get_header();

if (have_posts()) : while (have_posts()) : the_post();
    $theContent = get_the_content();

    get_template_part('template-parts/frontpage/about');
    get_template_part('template-parts/frontpage/goles');
    get_template_part('template-parts/frontpage/projects');
    get_template_part('template-parts/frontpage/insta');
    get_template_part('template-parts/frontpage/member');
    get_template_part('template-parts/frontpage/news');
    get_template_part('template-parts/frontpage/bottle');
   
    if(isset($theContent) && $theContent != ''){ ?>
        <section id="theContent" class="mt-5">
            <div class="container">
                <div class="row">
                    <div class="col">
                        <?php the_content(); ?>
                    </div>
                </div>
            </div>
        </section>
    <?php }

    endwhile;
else:
    get_template_part('template-parts/noContent');
endif;

get_footer(); ?>
