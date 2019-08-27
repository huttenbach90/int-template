<?php get_header(); ?>
	<?php get_template_part('parts/page-home', 'header' ); ?>
	<div id="primary" class="row-fluid">
		<div id="content" role="main" class="span8 offset2">

			<?php if ( have_posts() ) : ?>

				<?php while ( have_posts() ) : the_post(); ?>

					<article class="post">

						<?php the_post_thumbnail('large'); ?>

						<h1 class="title">
							<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
								<?php the_title(); ?>
							</a>
						</h1>

						<div class="post-meta">
							<?php the_time('m/d/Y'); ?> | 
							<?php if( comments_open() ) : ?>
								<span class="comments-link">
									<?php comments_popup_link( __( 'Comment', 'integromat' ), __( '1 Comment', 'integromat' ), __( '% Comments', 'integromat' ) ); ?>
								</span>
							<?php endif; ?>
						</div>

						<div class="the-content">
							<?php the_content( 'Continue...', 'integromat' );	?>

							<?php wp_link_pages(); ?>
						</div>

						<div class="meta clearfix">
							<div class="category"><?php echo get_the_category_list(); ?></div>
							<div class="tags"><?php echo get_the_tag_list( '| &nbsp;', '&nbsp;' ); ?></div>
						</div>

					</article>

				<?php endwhile; ?>

				<div id="pagination" class="clearfix">
					<div class="past-page"><?php previous_posts_link( 'newer', 'integromat' ); ?></div>
					<div class="next-page"><?php next_posts_link( 'older', 'integromat' ); ?></div>
				</div>


			<?php else : ?>

				<article class="post error">
					<h1 class="404"><?php echo __('Nothing has been posted like that yet', 'integromat'); ?></h1>
				</article>

			<?php endif; ?>
		</div>
	</div>
<?php get_footer(); ?>