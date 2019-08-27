<?php get_header(); ?>

	<?php get_template_part('/parts/page-no', 'header'); ?>

	<div id="content" role="main" class="container">

		<?php if ( have_posts() ) : ?>

			<?php while ( have_posts() ) : the_post(); ?>

				<article class="post row">
					<div class="col-12 col-lg-8 paper box-shadow">
						<h1 class="title display-3 mb-0"><?php the_title(); ?></h1>

						<div class="the-content">
							<?php the_content(); ?>
							<?php wp_link_pages(); ?>
						</div>

						<div class="meta clearfix">
							<div class="tags"><?php echo get_the_tag_list( ' &nbsp;', '&nbsp;' ); ?></div>
						</div>

						<?php /*
						<div id="responses" class="text-center">
							<span><?php _e("Was this post helpful?", "integromat"); ?></span>
							<div class="response-icons">
								<?php echo do_shortcode("[idev_liker]"); ?>
								<?php echo do_shortcode("[idev_disliker]"); ?>
							</div>
							<small>
								<?php 
								$post_like_count = get_post_meta( get_the_ID(), "_post_like_count", true ); 
								$post_unlike_count = get_post_meta( get_the_ID(), "_post_unlike_count", true );
								$total = $post_like_count + $post_unlike_count;
								echo $post_like_count . " out of <span id='total'>" . $total . "</span> found this helpful." ?>
							</small>
						</div> 
						*/ ?>

					</div>
					<aside class="col-12 col-lg-4">
						<div class="panels">
							<div class="scroll-it">
								<?php get_template_part('/parts/tutorial', 'related'); ?>
								<?php get_template_part('/parts/doc', 'related'); ?>
								<?php get_template_part('/parts/webinar', 'related'); ?>
								<?php get_template_part('/parts/blog', 'related'); ?>
							</div>
						</div>
					</aside>

				</article>

			<?php endwhile; ?>

		<?php else : ?>

			<article class="post row error">
				<div class="col-12 col-lg-8 paper box-shadow">

					<h1 class="title display-3 mb-4"><?php _e("Not found", "integromat") ?></h1>

					<div class="the-content">
						<?php echo __('Nothing has been posted like that yet', 'integromat'); ?>
					</div>

				</div>
				<aside class="col-12 col-lg-4">
					<div class="panels">
						<div class="scroll-it">
							<?php get_template_part('/parts/tutorial', 'related'); ?>
							<?php get_template_part('/parts/doc', 'related'); ?>
							<?php get_template_part('/parts/webinar', 'related'); ?>
							<?php get_template_part('/parts/blog', 'related'); ?>
						</div>
					</div>
				</aside>

			</article>

		<?php endif; ?>

	</div>
<?php get_footer(); ?>
