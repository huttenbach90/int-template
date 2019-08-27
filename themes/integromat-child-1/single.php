<?php get_header(); ?>

	<?php get_template_part('/parts/page-no', 'header'); ?>

	<div id="content" role="main" class="container">

		<?php if ( have_posts() ) : ?>

			<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part('/parts/content', 'classic'); ?>
				<?php get_template_part('/parts/aside', 'related'); ?>

			<?php endwhile; ?>

		<?php else : ?>

			<?php get_template_part('/parts/content', 'none'); ?>
			<?php get_template_part('/parts/aside', 'resources'); ?>

		<?php endif; ?>

	</div>

<?php get_footer(); ?>