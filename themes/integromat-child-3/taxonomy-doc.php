<?php get_header(); ?>

<?php get_template_part('parts/tax-columns', 'header' ); ?>
<?php get_template_part('parts/module', 'breadcrumb'); ?>

	<div class="pb-5">
		<div id="primary" class="container pb-3">

			<div id="content" role="main" class="row mt-5">

				<?php
				if (have_posts()) : 
					while (have_posts()) : the_post(); ?>

						<?php get_template_part('parts/archive', 'classic-3-columns'); ?>

					<?php
					endwhile; 
				endif; 
				?>

			</div>

		</div>

	</div>

	<?php get_template_part('parts/footer', 'contact'); ?>
	<?php get_template_part('parts/footer', 'app'); ?>

	<?php get_footer(); ?>