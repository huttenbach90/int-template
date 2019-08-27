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
									<div class="card archive-post border-0 mb-5 h-100">
										<div class="card-body">
											<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" class="d-block">
												<?php
												if ( has_post_thumbnail() ) {
													the_post_thumbnail( 'thumbnail', array('class' => 'w-100 h-auto') );
												} else {
													echo '<img class="h-auto w-100 no-decoration" src="' . get_bloginfo( 'template_directory' ) . '/assets/img/no-pic.jpg" />';
												} ?>
											</a>
											<?php 
											$posttags = get_the_tags($wp_query->post->ID);
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