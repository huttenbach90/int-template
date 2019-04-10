<?php
/*
Template Name: Homepage
*/
?>

<?php get_header(); ?>

<?php get_template_part('parts/page-home', 'header' ); ?>

<div class="container pb-5">
	<div id="primary" class="row mt-5">

		<div id="content" role="main" class="col-7 pr-5">

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

		<aside class="col-5 pl-5">
			<div class="display-6 mb-4 mt-2">
				<?php _e("Top resources", "integromat"); ?>
			</div>
			<div class="row resources">
				<?php dynamic_sidebar( 'homepage-aside' ); ?>
			</div>
		</aside>

	</div>
</div>

<div class="container-fluid theme-a1d36e text-center contact-stripe">
	<?php dynamic_sidebar( 'contact-stripe' ); ?>
</div>

<div class="gradient integromat-app">
	<div class="container">
		<div class="row align-items-center">
			<?php dynamic_sidebar( 'bottom' ); ?>
		</div>
	</div>
</div>
<?php get_footer(); ?>