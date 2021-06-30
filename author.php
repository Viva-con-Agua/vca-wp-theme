<?php get_header(); ?>


	<section role="main">

	<?php if (have_posts()): the_post(); ?>

		<h1><?php _e( 'Author Archives for ', 'html5blank' ); echo get_the_author(); ?></h1>

	<?php if ( get_the_author_meta('description')) : ?>

	<?php echo get_avatar(get_the_author_meta('user_email')); ?>

		<h2><?php e_( 'About', 'html5blank' ); echo get_the_author() ; ?></h2>

	<?php the_author_meta('description'); ?>

	<?php endif; ?>

	<?php rewind_posts(); while (have_posts()) : the_post(); ?>


		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

			<!-- post thumbnail -->
			<?php if ( has_post_thumbnail()) : ?>
				<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
					<?php the_post_thumbnail(array(120,120)); ?>
				</a>
			<?php endif; ?>
			<!-- /post thumbnail -->

			<!-- post title -->
			<h2>
				<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a>
			</h2>
			<!-- /Post title -->

			<!-- post details -->
			<span class="date"><?php the_time('F j, Y'); ?> <?php the_time('g:i a'); ?></span>
			<span class="author"><?php _e( 'Published by', 'html5blank' ); ?> <?php the_author_posts_link(); ?></span>
			<span class="comments"><?php comments_popup_link( __( 'Leave your thoughts', 'html5blank' ), __( '1 Comment', 'html5blank' ), __( '% Comments', 'html5blank' )); ?></span>
			<!-- /post details -->

			<br class="clear">

			<?php edit_post_link(); ?>

		</article>


	<?php endwhile; ?>

	<?php else: ?>

		<?php get_template_part('template-parts/noContent'); ?>

	<?php endif; ?>

		<?php get_template_part('pagination'); ?>

	</section>


<?php get_sidebar(); ?>

<?php get_footer(); ?>
