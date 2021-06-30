<?php get_header(); ?>


	<section role="main">

		<?php get_template_part('loop'); ?>

		<?php get_template_part('pagination'); ?>

    </section>

<?php

    include('template-parts/bellowPost.php');

    get_footer();

?>
