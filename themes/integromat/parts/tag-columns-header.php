<?php $term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) ); ?>

		<div class="jumbotron px-0 clearfix">
			<div class="row align-items-center">
				<div class="col-12 col-md-7">
					<h1 class="display-6">
						<?php _e("Tag:", "integromat"); ?>
						<span class="display-3 d-block">
							<?php printf( single_tag_title( '', false ) ); ?>
						</span>
					</h1>
					<div class="lead">
						<?php echo category_description(); ?>
					</div>
				</div>
				<div class="col-12 col-md-5">
					<?php get_search_form(); ?>
				</div>
			</div>
		</div>
	</div>
</header>