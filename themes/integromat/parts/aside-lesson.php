<aside class="col-12 col-lg-4">
	<div class="panels">
		<div class="scroll-it">
			<div class="panel panel-course top-blue mb-5 box-shadow">
				<?php 
				echo get_the_post_thumbnail($yay, "thumbnail"); 
				?>
				<div class="course-name">
					<a href="<?php echo get_the_permalink($yay); ?>" class="no-decoration text-dark font-weight-bold">
						<h4 class="mt-2">
							<?php echo get_the_title($yay); ?>
						</h4>
					</a>
				</div>
				<?php 
				echo do_shortcode("[ld_user_course_points]"); 
				?>					
				<?php 
				if ( is_active_sidebar( 'lessons' ) ) { 
					dynamic_sidebar( 'lessons' ); 
				}
				?>
			</div>
			<!-- needs restrictions -->
			<?php get_template_part('/parts/tutorial', 'related'); ?>
			<?php get_template_part('/parts/doc', 'related'); ?>
			<?php get_template_part('/parts/webinar', 'related'); ?>
			<?php get_template_part('/parts/blog', 'related'); ?>
			<?php get_template_part('/parts/cgsolution', 'related'); ?>
		</div>
	</div>
</aside>