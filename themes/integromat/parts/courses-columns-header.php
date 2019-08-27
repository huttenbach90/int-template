<?php $term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) ); ?>

		<div class="jumbotron px-0 clearfix">
			<div class="row align-items-center">
				<div class="col-12 col-md-7">
					<div class="lead">
						<?php dynamic_sidebar( 'archive-courses' ); ?>
					</div>
				</div>
				<div class="col-12 col-md-5">
					<?php get_search_form(); ?>
				</div>
			</div>
		</div>
	</div>
</header>