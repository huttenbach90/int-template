<?php
$tags = wp_get_post_terms( get_queried_object_id(), 'post_tag', ['fields' => 'ids'] );
$args = [
	'post__not_in'        => array( get_queried_object_id() ),
	'post_type'			  => 'external',
	'posts_per_page'      => 1,
    'tax_query' => [
        [
            'taxonomy' => 'post_tag',
            'terms'    => $tags
        ]
    ]
];
$my_query = new wp_query( $args );
if( $my_query->have_posts() ) {
    while( $my_query->have_posts() ) {
        $my_query->the_post(); ?>
        <?php
		if (has_post_thumbnail()) { ?>
			<div class="the-image">
				<?php the_post_thumbnail("thumbnail"); ?>
			</div>
		<?php
		}; ?>
        <h5>
            <a href="<?php the_permalink()?>" rel="bookmark" title="<?php the_title(); ?>" rel="nofollow">
                <?php the_title(); ?>
            </a>
        </h5>
    <?php }
    wp_reset_postdata();
}
?> 