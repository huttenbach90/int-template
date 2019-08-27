<?php get_header(); ?>

	<?php get_template_part('/parts/page-no', 'header'); ?>

	<div id="content" role="main" class="container">

		<?php if ( have_posts() ) : ?>

			<?php while ( have_posts() ) : the_post(); ?>
				<?php setPostViews(get_the_ID()); ?>

				<article class="post row">
					<div class="col-12 col-lg-8 paper box-shadow">

						<h1 class="title display-3 mb-4"><?php the_title(); ?></h1>

						<div class="the-content">
							<?php the_content(); ?>
							<?php wp_link_pages(); ?>
						</div>

						<div class="meta mt-5 clearfix">
							<div class="tags font-weight-bold text-uppercase"><?php echo get_the_tag_list( ' &nbsp;', '&nbsp;' ); ?></div>
						</div>

					</div>
					<aside class="col-12 col-lg-4 mb-5 mb-lg-0 mt-lg-5">
						<div class="display-6 mb-4 mt-2">
							<?php _e("Top resources", "integromat"); ?>
						</div>
						<div class="row resources">
							<?php dynamic_sidebar( 'homepage-aside' ); ?>
						</div>
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
