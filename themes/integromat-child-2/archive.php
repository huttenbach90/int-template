<?php get_header(); ?>

<?php get_template_part('/parts/archive-columns', 'header'); ?>

	<div class="pb-5">
		<div id="primary" class="container pb-3">

			<div id="content" role="main" class="row mt-5">

				<div class="col-12">
					<div class="row post-wrapper">

						<?php if ( have_posts() ) : ?>

							<?php while ( have_posts() ) : the_post(); ?>

								<div class="col-12 col-md-6 col-lg-4 mb-4 post-item">
									<div class="card card-shadow archive-post border-0 mb-5 h-100">
										<div class="card-body p-1">
											<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" class="d-block">
												<?php
												if ( has_post_thumbnail() ) {
													the_post_thumbnail( 'thumbnail', array('class' => 'w-100 h-auto') );
												} else {
													echo '<img class="h-auto w-100 no-decoration" src="' . get_bloginfo( 'template_directory' ) . '/assets/img/no-pic.jpg" />';
												} ?>
											</a>
											<h2 class="card-title mt-3 mb-3">
												<a class="no-decoration text-dark font-weight-normal" href="<?php echo get_permalink($wp_query->post->ID); ?>">
													<?php echo $wp_query->post->post_title; ?>
												</a>
											</h2>
											<div class="meta clearfix">
												<?php _e("By", "integromat"); ?> <?php the_author_posts_link(); ?>
												<div class="com-number">
													<i class="fal fa-comment text-muted"></i>
													<?php echo get_comments_number(); ?>
												</div>
											</div>
										</div>
									</div>
								</div>
							
							<?php
							endwhile;
							?>

							<?php
							if ($wp_query->max_num_pages > 1) {
								echo "<div class='page-links col-12 mt-4'>";
								$big = 9999999999; // need an unlikely integer

								echo paginate_links( array(
									'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
									'format' => '?paged=%#%',
									'current' => max( 1, get_query_var('paged') ),
									'total' => $wp_query->max_num_pages
								) );
								echo "</div>";
							}
							?>

							<?php
							else : ?>

								<div class="col-12 mt-5">
									<?php _e("Sorry,", "integromat"); ?>
								</div>
								<div class="col-12 pb-5 mb-5">
									<?php _e("there is nothing like that on ", "integromat"); ?> <?php bloginfo( 'name' ); ?>.
								</div>
								
							<?php
							endif;
							?>
						</div>
					</div>
	
				</div>
			</div>
		</div>
	</div>
<?php get_footer(); ?>