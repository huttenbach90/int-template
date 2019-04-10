<?php get_header(); ?>

<div class="container">
	<div id="content" role="main">

		<?php if ( have_posts() ) : ?>

			<?php while ( have_posts() ) : the_post(); ?>

			<?php
				$args = array( 'post_parent' => get_the_ID(), 'posts_per_page' => -1, 'post_type' => 'course', 'orderby' => 'menu_order', 'order' => 'asc');
				$children = get_children( $args );
				$loop = new WP_Query($args); ?>

				<article class="post row">

					<h1 class="title col-12"><?php the_title(); ?></h1>

					<?php
						if (!empty($children)) : ?>

						<p class="large col-12">
							<?php echo get_post_meta($post->ID, "introduction", true); ?>
						</p>

						<div class="col-8">
							<h2><?php _e('About', 'integromat'); ?></h2>
							<?php the_content(); ?>

							<h2><?php _e('Cirriculum', 'integromat'); ?></h2>
							<table class="cirriculum">
								<?php
									while ($loop->have_posts()) : $loop->the_post(); ?>
									<tr>
										<td>
											<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
												<i class="fas fa-play"></i>
												<?php the_title(); ?>
											</a>
										</td>
										<td>
											<?php echo get_post_meta($post->ID, "time", true); ?>
										</td>
									</tr>
								<?php
									endwhile;
									wp_reset_postdata(); ?>
							</table>
						</div>
						<div class="col-4">
							<div class="row">
								<div class="col-12">
									<i class="far fa-check-circle"></i>
									<?php
										$tags = get_tags();
										$count_tags = count($tags);
									?>
									<?php echo $count_tags . __("Modules", "integromat"); ?>
								</div>
								<div class="col-12">
									<i class="fas fa-video"></i>
									<?php echo get_post_meta($post->ID, "videos", true) . __("Videos", "integromat"); ?>
								</div>
								<div class="col-12">
									<i class="far fa-clock"></i>
									<?php echo get_post_meta($post->ID, "time", true); ?>
								</div>
								<div class="col-12">
									<i class="far fa-level-up"></i>
									<?php echo get_the_term_list( $post->ID, 'level', '', ', ', '' ) ?>
								</div>
							</div>
						</div>
					<?php
						endif; ?>

					<div class="col-12">
						<div class="tags"><?php echo get_the_tag_list( ' &nbsp;', '&nbsp;' ); ?></div>
					</div>

				</article>

			<?php endwhile; ?>

		<?php else : ?>

			<article class="post error">
				<h1 class="404"><?php echo __('Nothing has been posted like that yet', 'integromat'); ?></h1>
			</article>

		<?php endif; ?>

	</div>
</div>

<?php get_footer(); ?>