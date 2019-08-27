<?php get_header(); ?>

<?php get_template_part('parts/external-columns', 'header'); ?>

	<div class="pb-5">
		<div id="primary" class="container pb-3">

			<div id="content" role="main" class="row mt-5">

				<div class="col-12">
					<div class="row post-wrapper">

						<?php 
						if ( have_posts() ) : 
							while ( have_posts() ) : the_post(); ?>

								<?php get_template_part('parts/archive', 'classic-3-columns'); ?>
							
							<?php
							endwhile; ?>

							<?php get_template_part('parts/module', 'pagination'); ?>

							<?php
							else : ?>

								<?php get_template_part('parts/content', 'none'); ?>
								
							<?php
							endif; ?>

						</div>
					</div>
					
				</div>
			</div>
		</div>
	</div>

<?php get_template_part('parts/footer', 'contact'); ?>
<?php get_template_part('parts/footer', 'app'); ?>

<?php get_footer(); ?>