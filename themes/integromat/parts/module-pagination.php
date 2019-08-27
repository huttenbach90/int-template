<?php
if ($wp_query->max_num_pages > 1) {
	echo "<div class='page-links col-12 mt-4'>";
	$big = 9999999999; // need an unlikely integer

	echo paginate_links( array(
		'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
		'format' => '?paged=%#%',
		'current' => max( 1, get_query_var('paged') ),
		'total' => $wp_query->max_num_pages
	) );
								
	echo "</div>";
}
?>