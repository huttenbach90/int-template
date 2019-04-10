<?php get_header(); ?>

<?php get_template_part('parts/tax-columns', 'header' ); ?>

<div class="bg-white">
	<div class="container">
		<div class="row">
			<div class="col-12 py-3">
				<?php custom_breadcrumbs(); ?>
			</div>
		</div>
	</div>
</div>
<div class="pb-5">
	<div id="primary" class="container pb-3">

		<div id="content" role="main" class="row mt-5">

				<?php
				if (have_posts()) : ?>
					<?php
					while (have_posts()) : the_post(); ?>

						<div class="col-12 col-md-6">
							<div class="card card-shadow mb-5">
								<div class="card-body">
									<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
										<?php
											if ( has_post_thumbnail() ) {
												the_post_thumbnail( 'thumbnail', array('class' => 'w-100 h-auto') );
											};
										?>
									</a>
									<div class="mt-3">
										<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" class="no-decoration">
											<h3><?php the_title(); ?></h3>
										</a>
										<span class="info-course d-block">
											<?php the_excerpt(); ?>
										</span>
										
									</div>
								</div>
							</div>
						</div>
					<?php
					endwhile; ?>
				<?php
				endif; ?>

			</div>

		</div>

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