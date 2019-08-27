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

						<div class="col-12 col-md-4 mb-4">
							<div class="card archive-post border-0 mb-5 h-100">
								<div class="card-body">
									<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" class="d-block">
										<?php
										if ( has_post_thumbnail() ) {
											the_post_thumbnail( 'thumbnail', array('class' => 'w-100 h-auto') );
										} ?>
									</a>
									<?php 
										$posttags = get_the_tags($help_query->post->ID);
										if ($posttags) {
											foreach($posttags as $tag) {
												echo "<a href='" . get_tag_link($tag->term_id) . "' rel='tag' class='tag d-block font-weight-bold text-uppercase no-decoration'>";
												echo $tag->name . "</a>";
											}
										} 
									?>
									<div class="mt-2">
										<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" class="no-decoration">
											<h2><?php the_title(); ?></h2>
										</a>
										<div class="excerpt-post d-block">
											<?php the_excerpt(); ?>
										</div>
									</div>
									<div class="card-footer w-100 p-3">
										<i class="fal fa-eye text-muted"></i> <?php echo getPostViews(get_the_ID()); ?>
										<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" class="no-decoration float-right text-uppercase font-weight-bold text-muted">
											<?php _e("Read more", "integromat"); ?> <i class="far fa-angle-right"></i>
										</a>
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