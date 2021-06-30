<?php get_header(); ?>

	<section role="main">

		<h1><?php the_title(); ?></h1>

	<?php if (have_posts()): while (have_posts()) : the_post(); ?>

		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

			<?php the_content(); ?>

			<?php comments_template( '', true ); ?>

			<br class="clear">

			<?php edit_post_link(); ?>

		</article>

	<?php endwhile; ?>

	<?php else: ?>

		<?php get_template_part('template-parts/noContent'); ?>

	<?php endif; ?>

	</section>

<?php get_sidebar(); ?>

<?php get_footer(); ?>
