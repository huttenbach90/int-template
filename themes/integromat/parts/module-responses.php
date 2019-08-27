<?php
/*
<div id="responses" class="text-center">

	<span>
		<?php _e("Was this post helpful?", "integromat"); ?>
	</span>

	<div class="response-icons">
		<?php echo do_shortcode("[idev_liker]"); ?>
		<?php echo do_shortcode("[idev_disliker]"); ?>
	</div>

	<small>
		<?php 
		$post_like_count = get_post_meta( get_the_ID(), "_post_like_count", true ); 
		$post_unlike_count = get_post_meta( get_the_ID(), "_post_unlike_count", true );
		$total = $post_like_count + $post_unlike_count;

		echo $post_like_count . " out of <span id='total'>" . $total . "</span> found this helpful." ?>
	</small>
</div> 
*/
?>