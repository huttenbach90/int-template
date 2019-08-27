<?php get_header(); ?>

	<?php get_template_part('/parts/page-no', 'header'); ?>

	<div id="content" role="main" class="container">

		<?php if ( have_posts() ) : ?>

			<?php while ( have_posts() ) : the_post(); ?>
				<?php setPostViews(get_the_ID()); ?>

				<article class="post row">
					<div class="col-8">
						<div class="paper">

							<h1 class="title display-3 mb-4"><?php the_title(); ?></h1>

							<div class="the-content">
								<?php
								if ( has_post_thumbnail() ) {
									the_post_thumbnail('large', array('class'=>'w-100 mb-4 h-auto'));
								} ?>
								<?php the_content(); ?>

								<?php wp_link_pages(); ?>
							</div>

							<div class="meta mt-5 clearfix">
								<div class="tags"><?php echo get_the_tag_list( ' &nbsp;', '&nbsp;' ); ?></div>
							</div>

							<?php 
							$url = get_post_meta( get_the_ID(), "l_url", true );
							if ($url != "") { ?>
								<div class="box origin mt-5">
									<?php _e("This solution was originally posted by our customer on other site.", "integromat"); ?>
									<a href="<?php echo $url; ?>" title="<?php _e("View the original post", "integromat"); ?>" class="btn btn-primary float-right">
										<?php _e("View the original post", "integromat"); ?>
									</a>
								</div>
							<?php } ?>
						</div>

					</div>
					<aside class="col-4 mt-5">
						<?php get_template_part('/parts/tutorial', 'related'); ?>
						<?php get_template_part('/parts/doc', 'related'); ?>
						<?php get_template_part('/parts/webinar', 'related'); ?>
						<?php get_template_part('/parts/blog', 'related'); ?>
					</aside>

				</article>

			<?php endwhile; ?>

		<?php else : ?>

			<article class="post error">
				<h1 class="404"><?php echo __('Nothing has been posted like that yet', 'integromat'); ?></h1>
			</article>

		<?php endif; ?>

	</div>
<?php get_footer(); ?>
