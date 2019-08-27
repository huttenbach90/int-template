<?php get_header(); ?>

<?php get_template_part('/parts/search-columns', 'header'); ?>

	<div id="content" role="main" class="container">

		<?php 
		if ( have_posts() ) :
			while ( have_posts() ) : the_post(); 
				setPostViews(get_the_ID()); ?>

				<?php get_template_part('parts/content', 'classic'); ?>

			<?php 
			endwhile; ?>

		<?php 
		else : ?>

			<?php get_template_part('parts/content', 'none'); ?>

		<?php 
		endif; ?>

	</div>

<?php get_template_part('parts/footer', 'contact'); ?>
<?php get_template_part('parts/footer', 'app'); ?>

<?php get_footer(); ?>