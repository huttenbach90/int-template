<?php
/*
Template Name: Docs
*/
?>

<?php get_header(); ?>

<?php get_template_part('parts/page-columns', 'header' ); ?>
<?php get_template_part('parts/module', 'breadcrumb'); ?>

<div class="pb-5">
	<div id="primary" class="container pb-3">

		<div id="content" role="main" class="card-columns mt-5">

				<?php
				$cats = get_terms("doc", array("hide_empty" => true));

				foreach ($cats as $cat) {
					$cat_id = $cat->term_id;
					$term_link = get_term_link( $cat );
					echo "<div class='card card-shadow my-2'><h2 class='card-title display-6 p-4 font-weight-semibold' icon='" . $cat->slug . "'><a href='" . $term_link . "' class='no-decoration' title='" . $cat->name . "'>".$cat->name."</a></h2>";
						$query = new WP_Query( array(
							'post_type' => 'post',
							'posts_per_page' => 6,
							'tax_query' => array(
								array(
									'taxonomy' => 'doc',
									'field' => 'id',
									'terms' => $cat_id
								)
							)
						));
						$all = new WP_Query( array(
							'post_type' => 'post',
							'posts_per_page' => -1,
							'tax_query' => array(
								array(
									'taxonomy' => 'doc',
									'field' => 'id',
									'terms' => $cat_id
								)
							)
						));
						$num = $all->post_count;
						if ($query->have_posts()) : ?>
							<div class="px-4 pb-4 pt-0">
								<?php while ($query->have_posts()) : $query->the_post(); ?>
									<a href="<?php the_permalink();?>" class="doc-link d-block" title="<?php the_title(); ?>"><?php the_title(); ?></a>
								<?php endwhile; ?>
								<?php if ($num > 6) : ?>
									<a class="doc-link d-block font-weight-semibold no-before" title="<?php _e('Show all', 'integromat'); ?> <?php echo $num . ' posts';?>" href="<?php echo $term_link; ?>">
										<?php _e("Show all", "integromat"); ?> <?php echo $num . ' posts'; ?> <i class="fal fa-angle-double-right"> </i>
									</a>
								<?php endif; ?>
							</div>
						<?php endif; ?>
					</div>
					<?php } ?>
					<?php wp_reset_postdata();?>
				</div>


			</div>

		</div>

	</div>
</div>

<?php get_template_part('parts/footer', 'contact'); ?>
<?php get_template_part('parts/footer', 'app'); ?>

<?php get_footer(); ?>