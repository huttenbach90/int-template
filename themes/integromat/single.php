<?php get_header(); ?>

<?php get_template_part('/parts/page-no', 'header'); ?>

	<div id="content" role="main" class="container">

		<?php if ( have_posts() ) : ?>

			<?php while ( have_posts() ) : the_post(); ?>

				<article class="post row">
					<div class="col-8 paper box-shadow">
						<h1 class="title display-3"><?php the_title(); ?></h1>
						<div class="post-meta pt-4 pb-4">
							<i class="fas fa-user mr-1 text-gray"></i> <?php the_author(); ?>
							<i class="ml-4 fal fa-calendar-alt mr-1 text-gray"></i> <?php the_time('m.d.Y'); ?>
							<i class="ml-4 fas fa-folder mr-1 text-gray"></i> <?php echo get_the_term_list( $post->ID, 'doc', '', ', ', '' ); ?> 
						</div>

						<?php
							if (has_post_thumbnail()) { ?>
								<div class="the-image">
									<?php the_post_thumbnail("medium"); ?>
								</div>
						<?php
							}; ?>
						<div class="the-content pt-2">
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
					<div class="col-3 pt-5">
						<span class="d-block display-6"><?php _e("Related content:", "integromat"); ?></span>
					</div>

				</article>

			<?php endwhile; ?>

		<?php else : ?>

			<article class="post error">
				<h1 class="404"><?php echo __('Nothing has been posted like that yet', 'integromat'); ?></h1>
			</article>

		<?php endif; ?>

	</div>
<?php get_footer(); ?>
