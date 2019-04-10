<?php get_header(); ?>
	<div id="content" role="main">

		<?php if ( have_posts() ) : ?>

			<?php while ( have_posts() ) : the_post(); ?>

				<article class="post row">
					<div class="col-8">

						<h1 class="title"><?php the_title(); ?></h1>
						<div class="post-meta">
							<?php the_time('m.d.Y'); ?>
							<?php the_author(); ?>
						</div>

						<div class="the-content">
							<?php the_content(); ?>

							<?php wp_link_pages(); ?>
						</div>

						<div class="meta clearfix">
							<div class="tags"><?php echo get_the_tag_list( ' &nbsp;', '&nbsp;' ); ?></div>
						</div>
					</div>
					<div class="col-4">
						Related content:
					</div>

				</article>

			<?php endwhile; ?>

			<?php if ( comments_open() || '0' != get_comments_number() )
						comments_template( '', true ); ?>

		<?php else : ?>

			<article class="post error">
				<h1 class="404"><?php echo __('Nothing has been posted like that yet', 'integromat'); ?></h1>
			</article>

		<?php endif; ?>

	</div>
<?php get_footer(); ?>
