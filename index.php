<?php get_header(); ?>

	<section role="main">

		<h1><?php _e( 'Latest Posts', 'html5blank' ); ?></h1>

		<?php get_template_part('loop'); ?>

		<?php get_template_part('pagination'); ?>

	</section>

<?php //get_sidebar(); ?>

<?php get_footer(); ?>
