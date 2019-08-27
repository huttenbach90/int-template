<?php get_header(); ?>

<?php get_template_part('/parts/search-columns', 'header'); ?>

	<div class="pb-5">
		<div id="primary" class="container pb-3">

			<div id="content" role="main" class="row mt-5">

				<div class="col-12 col-lg-7 mr-3">
					<div class="row post-wrapper">

						<?php 
						$paged = is_front_page() ? get_query_var( 'page' ) : get_query_var( 'paged' );
						$help_args = array(
							's' => get_search_query(),

							'posts_per_page' => 10,
							'paged' => $paged
						);
						
						$help_query = new Network_Query( $help_args );
						
						if( $help_query->have_posts() ) : ?>
							<?php
							while( $help_query->have_posts() ) : $help_query->the_post();
							switch_to_blog( $help_query->post->BLOG_ID ); ?>

								<div class="col-12 col-md-6 mb-4 post-item">
									<div class="card archive-post border-0 mb-5 h-100">
										<div class="card-body">
											<a href="<?php echo get_permalink($help_query->post->ID); ?>" title="<?php echo $help_query->post->post_title; ?>" class="d-block">
												<?php 
												if ( has_post_thumbnail($help_query->post->ID) ) {
													echo get_the_post_thumbnail($help_query->post->ID, "thumbnail", array("class"=>"h-auto w-100"));
												} else {
													echo '<img class="h-auto w-100 no-decoration" src="' . get_bloginfo( 'template_directory' ) . '/assets/img/no-pic.jpg" />';
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
												<a href="<?php echo get_permalink($help_query->post->ID); ?>" title="<?php echo $help_query->post->post_title; ?>" class="no-decoration">
													<h2><?php echo $help_query->post->post_title; ?></h2>
												</a>
												<div class="excerpt-post d-block">
													<?php the_excerpt(); ?>
												</div>
											</div>
											<div class="card-footer w-100 p-3">
												<i class="fal fa-eye text-muted"></i> <?php echo getPostViews(get_the_ID()); ?>
												<a href="<?php echo get_permalink($help_query->post->ID); ?>" title="<?php echo $help_query->post->post_title; ?>" class="no-decoration float-right text-uppercase font-weight-bold text-muted">
													<?php _e("Read more", "integromat"); ?> <i class="far fa-angle-right"></i>
												</a>
											</div>
										</div>
									</div>
								</div>
								
								
							<?php
							restore_current_blog();
							endwhile;
							?>

							<?php 
							if (  $help_query->max_num_pages > 1 ) {

								echo "<div class='page-links col-12 mt-4'>";
								$big = 999999999; // need an unlikely integer

								echo paginate_links( array(
									'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
									'format' => '?paged=%#%',
									'current' => max( 1, get_query_var('paged') ),
									'total' => $help_query->max_num_pages
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
						network_reset_postdata(); 
						?>
				
				</div>
			</div>

			<aside class="col-12 col-lg-5 pl-lg-5 pt-5 pt-lg-0">
		
				<?php 
				$academy_args = array(
					's' => get_search_query(),
					'blog_id' => array(1),
					'posts_per_page' => 10,
				);
					
				$academy_query = new Network_Query( $academy_args );
					
				if( $academy_query->have_posts() ) : ?>
						
					<div class="row academy-posts mb-4">
						<div class="col-12 position-relative">
							<i class="fas fa-graduation-cap text-primary"></i>
							<h3 class="d-block">"<?php echo get_search_query(); ?>" <?php _e('on Academy', 'integromat'); ?>:</h3>
							<?php
							while( $academy_query->have_posts() ) : $academy_query->the_post();
							switch_to_blog( $academy_query->post->BLOG_ID ); ?>
								<a class="no-decoration d-block" href="<?php echo get_permalink($academy_query->post->ID); ?>">
									<?php echo $academy_query->post->post_title; ?>
								</a>
							<?php
							restore_current_blog();
							endwhile;
					echo "<!--<a href='https://academy.integromat.com' class='btn btn-primary btn-sm mt-3'>Search on Academy</a>--></div></div>";

				endif;
				network_reset_postdata(); 
				?>

				<?php 
				$blog_args = array(
					's' => get_search_query(),
					'blog_id' => array(5),
					'posts_per_page' => 10,
				);
					
				$blog_query = new Network_Query( $blog_args );
					
				if( $blog_query->have_posts() ) : ?>
						
					<div class="row blog-posts mb-5">
						<div class="col-12 position-relative">
							<i class="fal fa-newspaper text-primary"></i>
							<h3 class="d-block">"<?php echo get_search_query(); ?>" <?php _e('on Blog', 'integromat'); ?></h3>
							<?php
							while( $blog_query->have_posts() ) : $blog_query->the_post();
							switch_to_blog( $blog_query->post->BLOG_ID ); ?>
								<a class="no-decoration d-block" href="<?php echo get_permalink($blog_query->post->ID); ?>">
									<?php echo $blog_query->post->post_title; ?>
								</a>
							<?php
							restore_current_blog();
							endwhile;
					echo "</div></div>";

				endif;
				network_reset_postdata(); 
				?>
			</aside>
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