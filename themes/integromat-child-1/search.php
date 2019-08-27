<?php get_header(); ?>

<?php get_template_part('/parts/search-columns', 'header'); ?>

	<div class="pb-5">
		<div id="primary" class="container pb-3">

			<div id="content" role="main" class="row mt-5">

				<div class="col-12 mb-5">
					<div class="row post-wrapper">

						<?php 
						switch_to_blog(1); 
						$paged = is_front_page() ? get_query_var( 'page' ) : get_query_var( 'paged' );

						$loop = new WP_Query(
							array(
								's' => get_search_query(),
								'posts_per_page' => 9,
								'paged' => $paged,
							)
						);
						
						if( $loop->have_posts() ) : ?>
							<?php
							while( $loop->have_posts() ) : $loop->the_post();
							switch_to_blog( $loop->post->BLOG_ID ); ?>

								<?php get_template_part('/parts/archive', 'classic-3-columns'); ?>
								
								
							<?php
							restore_current_blog();
							endwhile;
							?>

							<?php 
							if (  $loop->max_num_pages > 1 ) {

								echo "<div class='page-links col-12 mt-4 load-more'>";
								$big = 999999999; // need an unlikely integer

								echo paginate_links( array(
									'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
									'format' => '?paged=%#%',
									'current' => max( 1, get_query_var('paged') ),
									'total' => $loop->max_num_pages
								) );
								echo "</div>";
							} 
							?>

						<?php
						else : ?>

							<div class="col-12 mt-5">
								<?php _e("Sorry,", "integromat"); ?>
							</div>
							<div class="col-12 pb-5 mb-5">
								<?php _e("there is nothing like that on ", "integromat"); ?> <?php bloginfo( 'name' ); ?>.
							</div>
							
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
						<h2 class="col-12 mb-5 mt-5">
							<?php _e("Search results on Help Center", "integromat"); ?>:
						</h2>

						<?php 
						switch_to_blog(2); 

						$help = new WP_Query(
							array(
								's' => get_search_query(),
								'posts_per_page' => 3,
								'paged' => $paged,
							)
						);
						
						if( $help->have_posts() ) : ?>
							<?php
							while( $help->have_posts() ) : $help->the_post();
							switch_to_blog( $help->post->BLOG_ID ); ?>

								<?php get_template_part('/parts/archive', 'classic-3-columns'); ?>
								
								
							<?php
							restore_current_blog();
							endwhile;
							?>

							<?php 
							if (  $loop->max_num_pages > 1 ) {

								echo "<div class='page-links col-12 mt-4 load-more'>";
								$big = 999999999; // need an unlikely integer

								echo paginate_links( array(
									'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
									'format' => '?paged=%#%',
									'current' => max( 1, get_query_var('paged') ),
									'total' => $loop->max_num_pages
								) );
								echo "</div>";
							} 
							?>

						<?php
						else : ?>

							<div class="col-12 mt-5">
								<?php _e("Sorry,", "integromat"); ?>
							</div>
							<div class="col-12 pb-5 mb-5">
								<?php _e("there is nothing like that on ", "integromat"); ?> <?php bloginfo( 'name' ); ?>.
							</div>
							
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
						<h2 class="col-12 mb-5 mt-5">
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
						
						if( $help->have_posts() ) : ?>
							<?php
							while( $help->have_posts() ) : $help->the_post();
							switch_to_blog( $help->post->BLOG_ID ); ?>

								<?php get_template_part('/parts/archive', 'classic-3-columns'); ?>
								
								
							<?php
							restore_current_blog();
							endwhile;
							?>

							<?php 
							if (  $loop->max_num_pages > 1 ) {

								echo "<div class='page-links col-12 mt-4 load-more'>";
								$big = 999999999; // need an unlikely integer

								echo paginate_links( array(
									'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
									'format' => '?paged=%#%',
									'current' => max( 1, get_query_var('paged') ),
									'total' => $loop->max_num_pages
								) );
								echo "</div>";
							} 
							?>

						<?php
						else : ?>

							<div class="col-12 mt-5">
								<?php _e("Sorry,", "integromat"); ?>
							</div>
							<div class="col-12 pb-5 mb-5">
								<?php _e("there is nothing like that on ", "integromat"); ?> <?php bloginfo( 'name' ); ?>.
							</div>
							
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
<div class="container-fluid theme-a1d36e text-center contact-stripe">
	<?php dynamic_sidebar( 'contact-stripe' ); ?>
</div>
<div class="gradient integromat-app">
	<div class="container">
		<div class="row align-items-center">
			<?php dynamic_sidebar( 'bottom' ); ?>
		</div>
	</div>
</div>
<?php get_footer(); ?>