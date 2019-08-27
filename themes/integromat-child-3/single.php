<?php get_header(); ?>

<?php get_template_part('parts/page-no', 'header'); ?>

	<div id="content" role="main" class="container">

		<?php 
		if ( have_posts() ) : 
			while ( have_posts() ) : the_post(); 
				setPostViews(get_the_ID()); ?>

				<?php get_template_part('parts/content', 'classic'); ?>

			<?php 
			endwhile; 
		else : ?>

			<?php get_template_part('parts/content', 'none'); ?>

		<?php 
		endif; ?>

	</div>

<?php get_footer(); ?>