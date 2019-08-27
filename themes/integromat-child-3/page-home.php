<?php
/*
Template Name: Homepage
*/
?>

<?php get_header(); ?>

<?php get_template_part('parts/page-home', 'header' ); ?>

<div class="container pb-5">
	<div id="primary" class="row mt-3 mt-md-4 mt-lg-5">

		<div id="content" role="main" class="col-12 col-lg-7 pr-3 pr-lg-5">

			<div class="row">

				<?php if (have_posts()) : ?>
					<?php while (have_posts()) : the_post(); ?>
						<div class="col-12">
							<?php the_content(); ?>
						</div>
					<?php endwhile; ?>
				<?php endif; ?>

				<?php dynamic_sidebar( 'homepage-content' ); ?>

			</div>

		</div>

		<?php get_template_part('parts/aside', 'resources'); ?>

	</div>
</div>

<?php get_template_part('parts/footer', 'contact'); ?>
<?php get_template_part('parts/footer', 'app'); ?>

<?php get_footer(); ?>