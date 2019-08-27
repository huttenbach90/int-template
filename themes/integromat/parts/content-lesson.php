<article class="post row">
	<div class="col-12 col-lg-8 paper box-shadow mb-5">

		<?php 
		$yay = get_post_meta($post->ID, "course_id", true); 
		?>
		
		<a href="<?php echo get_the_permalink($yay); ?>" class="no-decoration text-dark font-weight-bold">
			<h4 class="mt-2">
				<?php echo get_the_title($yay); ?>
			</h4>
		</a>

		<h1 class="title display-3">
			<?php the_title(); ?>
		</h1>

		<div class="the-content pt-2">
			<?php the_content(); ?>
			<?php wp_link_pages(); ?>
		</div>

	</div>
</article>