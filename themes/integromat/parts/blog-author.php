
<div class="panel top-blue mb-5 box-shadow">
	<div class="author-image">
		<?php
		echo get_avatar( get_the_author_email(), '60' ); 
		?>
	</div>
	<h3 class="mb-4 text-dark">
		<?php 
		echo get_author_name(); 
		?>
	</h3>
	<p class="author-desc">
		<?php
		echo nl2br(get_the_author_meta('description'));
		?>
	</p>
</div>