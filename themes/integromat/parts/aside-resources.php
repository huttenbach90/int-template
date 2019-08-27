<aside class="col-12 <?php if (is_page_template('page-home.php')) : ?>col-lg-5 pl-5 pl-lg-5<?php else : ?>col-lg-4 mt-5<?php endif; ?> mb-5">
	<div class="display-6 mb-4">
		<?php _e("Top resources", "integromat"); ?>
	</div>
	<div class="row resources">
		<?php dynamic_sidebar( 'homepage-aside' ); ?>
	</div>
</aside>