
<?php 
$tags = wp_get_post_tags($post->ID);
if ($tags) {
	$tag_ids = array();
	foreach($tags as $individual_tag) {
		$tag_ids[] = $individual_tag->slug;
	}

	switch_to_blog(2);
	$args = array(
		'posts_per_page' => 6,
		'orderby' => 'name',
		'order' => 'ASC',
		'tax_query' => array( 
			array(
				'taxonomy' => 'post_tag',
				'field' => 'slug',
				'terms' => $tag_ids,
			) 
		),
	);
	
	$network_q = new WP_Query( $args );
	
	if( $network_q->have_posts() ) : ?>
		<div class="panel panel-rows top-blue mb-5 box-shadow">
			<h3 class="mb-4"><?php _e("Related docs", "integromat"); ?></h3>
			<?php
			while( $network_q->have_posts() ) : $network_q->the_post();
			switch_to_blog( $network_q->post->BLOG_ID ); ?>
				<span class="mb-2 d-block">
					<?php 
					$terms = get_the_terms($network_q->post->ID, "doc");
					foreach ($terms as $term) {
						echo "<strong>" . $term->name . ":</strong>";
					} ?>
				</span>
				<a href="<?php echo get_permalink($network_q->post->ID); ?>" class="no-decoration d-block w-100">
					<h4 class="mt-2 font-weight-normal">
						<?php echo $network_q->post->post_title; ?>
					</h4>
				</a>
			<?php
		endwhile;
	
		echo '</div>';
	endif;
	wp_reset_postdata();
	restore_current_blog(); 
}
?> 