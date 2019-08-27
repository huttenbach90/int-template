<article class="post row">

	<div class="col-12 col-lg-8 paper box-shadow">
		<h1 class="title display-3">
			<?php the_title(); ?>
		</h1>
		<div class="the-content pt-2">
			<?php the_content(); ?>
		</div>
		<div class="meta mt-5 clearfix">
			<div class="tags">
				<?php echo get_the_tag_list( ' &nbsp;', '&nbsp;' ); ?>
			</div>
		</div>
		<?php get_template_part('parts/module', 'responses'); ?>	
		
		<?php
		if ( get_post_type() == "external" ) :
			$url = get_post_meta( get_the_ID(), "l_url", true );
			if ($url != "") { ?>
				<div class="box origin mt-5">
					<?php 
					$author == get_the_author();
					if (get_the_author() == "community") { ?>
						<?php _e('This content was originally posted on a third-party site.', 'integromat'); ?>
						<a href="<?php echo $url; ?>" title="<?php _e("See the original", "integromat"); ?>" class="btn btn-primary float-right">
							<?php _e('See the original', 'integromat'); ?>
						</a>
					<?php } else { ?> 
						<?php _e("This problem was solved on our FB Community page. Read the solution in the comments of the original post.", "integromat"); ?>
						<a href="<?php echo $url; ?>" title="<?php _e("Get the solution", "integromat"); ?>" class="btn btn-primary float-right">
							<?php _e("Get the solution", "integromat"); ?>
						</a>
					<?php } ?>
				</div>
			<?php 
			} ?>
		<?php
		endif; ?>

	</div>

	<?php get_template_part('parts/aside', 'related'); ?>

</article>