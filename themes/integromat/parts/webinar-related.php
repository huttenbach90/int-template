
<?php 
$tags = wp_get_post_tags($post->ID);
if ($tags) {
	$tag_ids = array();
	foreach($tags as $individual_tag) {
		$tag_ids[] = $individual_tag->slug;
	}

	switch_to_blog(1);
	$args = array(
		'post_type' => 'sfwd-courses',
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
	
	$network_q = new WP_Query( $args );
	
	if( $network_q->have_posts() ) : ?>
		<div class="panel top-blue mb-5 box-shadow">
			<h3 class="mb-4"><?php _e("Related webinars", "integromat"); ?></h3>
			<?php
			while( $network_q->have_posts() ) : $network_q->the_post();
			switch_to_blog( $network_q->post->BLOG_ID ); ?>
				<a href="<?php echo get_permalink($network_q->post->ID); ?>" class="no-decoration">
					<?php 
					if ( has_post_thumbnail($network_q->post->ID) ) {
						echo get_the_post_thumbnail($network_q->post->ID, "thumbnail", array("class"=>"h-auto w-100"));
					} else {
						echo '<img class="h-auto w-100 no-decoration" src="' . get_bloginfo( 'template_directory' ) . '/assets/img/no-pic.jpg" />';
					} ?>
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