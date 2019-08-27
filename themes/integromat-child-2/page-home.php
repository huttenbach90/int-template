<?php
/*
Template Name: Homepage
*/
?>

<?php get_header(); ?>

<?php get_template_part('parts/page-home-nosearch', 'header' ); ?>

<div class="container pb-5">
	<div id="primary" class="row mt-4 pt-3">

		<div id="content" role="main" class="col-12 col-lg-8 pr-lg-5">

			<div class="row">

				<?php if (have_posts()) : ?>
					<?php while (have_posts()) : the_post(); ?>
						<div class="col-12">
							<?php the_content(); ?>
						</div>
					<?php endwhile; ?>
				<?php endif; ?>

				<div class="col-12 mb-3 pb-1">
					<?php
					wp_nav_menu( array(
						'menu'           => 'catnav',
						'theme_location' => 'catnav',
						'fallback_cb'    => false
					) );
					?>
				</div>

				<?php
					$paged = is_front_page() ? get_query_var( 'page' ) : get_query_var( 'paged' );
					$args = array(
						'posts_per_page' => 5,
						'paged' => $paged,
						'post_type' => 'post',
					);
					$i = 0;
					
					$wp_query = new WP_Query( $args );
					
					if( $wp_query->have_posts() ) : ?>
						<div class="col-12">
							<div class="posts-wrapper row">
								<?php
								while( $wp_query->have_posts() ) : $wp_query->the_post(); ?>
									<div class="post-item col-12 <?php if ($i != 0) { ?>col-md-6 <?php } ?>mb-4 mt-2 px-lg-3">
										<div class="card card-shadow h-100 mb-4">
											<div class="card-body m-0">
												<div class="text-uppercase mb-3 pb-1 cat-name">
													<?php echo get_the_category($wp_query->post->ID)[0]->name; ?>
												</div>
												<a href="<?php echo get_permalink($wp_query->post->ID); ?>">
													<?php 
													if ( has_post_thumbnail($wp_query->post->ID) ) {
														echo get_the_post_thumbnail($wp_query->post->ID, "large", array("class"=>"h-auto w-100"));
													} else {
														echo '<img class="h-auto w-100 no-decoration" src="' . get_bloginfo( 'template_directory' ) . '/assets/img/no-pic.jpg" />';
													} ?>
												</a>
												<h2 class="card-title mt-3 mb-3">
													<a class="no-decoration text-dark font-weight-normal" href="<?php echo get_permalink($wp_query->post->ID); ?>">
														<?php echo $wp_query->post->post_title; ?>
													</a>
												</h2>
												<?php if ($i == 0) { the_excerpt(); } ?>
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
								$i++;
								endwhile;	

								if (  $wp_query->max_num_pages > 1 ) {

									echo "<div class='page-links load-more col-12 mt-4'>";
									$big = 999999999; // need an unlikely integer

									echo paginate_links( array(
										'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
										'format' => '?paged=%#%',
										'current' => max( 1, get_query_var('paged') ),
										'total' => $wp_query->max_num_pages
									) );
									echo "</div>";
								}

								wp_reset_query(); 

								endif;
								?>

							</div>
						</div>
					</div>
				</div>

				<aside class="col-12 col-lg-4 pl-lg-5 mt-5 mt-lg-0">
					<div class="display-6 mb-4">
						<?php get_search_form(); ?>
					</div>
					<div id="subscribe" class="panel panel-columns top-blue mb-5 box-shadow">
						<?php dynamic_sidebar( 'sidebar-primary' ); ?>
						<form class="mt-4 pt-2">
							<input class="form-control font-italic" id="subscribe-email" placeholder="<?php _e("Enter your email", "integromat"); ?>">
							<button type="submit" class="btn btn-success w-100 mt-3 text-center text-italic"><?php _e("Subscribe", "integromat"); ?></button>
						</form>
					</div>
				</aside>

			</div>
		</div>

	</div>
</div>

<?php get_footer(); ?>