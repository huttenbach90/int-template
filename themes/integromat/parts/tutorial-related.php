
<?php 
$tags = wp_get_post_tags($post->ID);
if ($tags) {
	$tag_ids = array();
	foreach($tags as $individual_tag) {
		$tag_ids[] = $individual_tag->slug;
	}

	$args = array(
		'blog_id' => array(1),
		'posts_per_page' => 5,
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
	
	$network_q = new Network_Query( $args );
	
	if( $network_q->have_posts() ) : ?>
		<div class="panel top-blue mb-4">
			<h3 class="mb-4"><?php _e("Related tutorials", "integromat"); ?></h3>
			<?php
			while( $network_q->have_posts() ) : $network_q->the_post();
			switch_to_blog( $network_q->post->BLOG_ID ); ?>

				<h5 class="mt-2 font-weight-light">
					<a href="<?php echo get_permalink($network_q->post->ID); ?>">
						<?php echo $network_q->post->post_title; ?>
					</a>
				</h5>
			<?php
			restore_current_blog();
		endwhile;
	
		echo '</div>';
	endif;
	network_reset_postdata(); 
}
?> 