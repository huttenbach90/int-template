<?php
/* Template Name: Tutorials */
?>

<?php get_header(); ?>

<?php get_template_part('/parts/page-columns', 'header'); ?>

	<div class="pb-5">
		<div id="primary" class="container pb-3">

			<div id="content" role="main" class="row mt-5">

				<div class="col-12">
					<div class="row post-wrapper">

						<?php
						global $post;

						$loop = new WP_Query(
							array(
								'post_type' => 'tutorial',
								'posts_per_page' => 12,
								'order' => 'desc',
								'orderby' => 'date'
							)
						); ?>

						<?php if ( $loop->have_posts() ) : ?>

							<?php while ( $loop->have_posts() ) : $loop->the_post(); ?>

								<?php get_template_part('/parts/archive', 'classic-3-columns'); ?>
							
							<?php
							endwhile;
							?>

							<?php get_template_part('/parts/module', 'pagination'); ?>

							<?php
							else : ?>

								<?php get_template_part('/parts/content', 'none'); ?>
								<?php get_template_part('/parts/aside', 'resources'); ?>
								
							<?php
							endif;
							?>
						</div>
					</div>
	
				</div>
			</div>
		</div>
	</div>
<?php get_footer(); ?>