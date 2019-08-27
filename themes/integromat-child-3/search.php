<?php get_header(); ?>

<?php get_template_part('parts/search-columns', 'header'); ?>

	<div class="pb-5">
		<div id="primary" class="container pb-3">

			<div id="content" role="main" class="row mt-5">

				<div class="col-12 mb-5">
					<div class="row post-wrapper">

						<?php 
						$paged = is_front_page() ? get_query_var( 'page' ) : get_query_var( 'paged' );

						switch_to_blog(2); 
						
						$loop = new WP_Query(
							array(
								's' => get_search_query(),
								'posts_per_page' => 9,
								'paged' => $paged,
							)
						);
						
						if( $loop->have_posts() ) : 
							while( $loop->have_posts() ) : $loop->the_post(); 
							?>

								<?php get_template_part('parts/archive', 'classic-3-columns'); ?>
								
							<?php
							endwhile; ?>

							<?php get_template_part('parts/module', 'pagination'); ?>

						<?php
						else : ?>

							<?php get_template_part('parts/content', 'none'); ?>
							
						<?php
						endif;
						wp_reset_postdata();
						restore_current_blog();     
						?>
				
					</div>
				</div>

				<div class="col-12 mb-5">
					<hr>
					<div class="row post-wrapper">
						<h2 class="col-12 mb-5 mt-5 display-3">
							<?php _e("Search results on Academy", "integromat"); ?>:
						</h2>

						<?php 
						switch_to_blog(1); 

						$help = new WP_Query(
							array(
								's' => get_search_query(),
								'posts_per_page' => 3,
								'paged' => $paged,
							)
						);
						
						if( $help->have_posts() ) : 
							while( $help->have_posts() ) : $help->the_post();
							?>

								<?php get_template_part('parts/archive', 'classic-3-columns'); ?>
								
							<?php
							endwhile; ?>
	
							<?php get_template_part('parts/module', 'pagination'); ?>
	
						<?php
						else : ?>
	
							<?php get_template_part('parts/content', 'none'); ?>
								
						<?php
						endif;
						wp_reset_postdata();
						restore_current_blog();     
						?>
				
					</div>
				</div>

				<div class="col-12 mb-5">
					<hr>
					<div class="row post-wrapper">
						<h2 class="col-12 mb-5 mt-5 display-3">
							<?php _e("Search results on Blog", "integromat"); ?>:
						</h2>

						<?php 
						switch_to_blog(5); 

						$help = new WP_Query(
							array(
								's' => get_search_query(),
								'posts_per_page' => 3,
								'paged' => $paged,
							)
						);
						
						if( $help->have_posts() ) : 
							while( $help->have_posts() ) : $help->the_post(); ?>

								<?php get_template_part('parts/archive', 'classic-3-columns'); ?>
								
							<?php
							endwhile; ?>
		
							<?php get_template_part('parts/module', 'pagination'); ?>
		
						<?php
						else : ?>
		
							<?php get_template_part('parts/content', 'none'); ?>
									
						<?php
						endif;
						wp_reset_postdata();
						restore_current_blog();     
						?>
				
				</div>
			</div>

		</div>
	</div>
</div>

<?php get_template_part('parts/footer', 'contact'); ?>
<?php get_template_part('parts/footer', 'app'); ?>

<?php get_footer(); ?>