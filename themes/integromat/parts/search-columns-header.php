        <div class="jumbotron px-0 clearfix">
			<div class="row align-items-center">
				<div class="col-12 col-md-7">
					<h1 class="display-6">
						<?php printf( __( 'Search Results for: %s', 'integromat' ), '<span class="display-3 d-block">' . get_search_query() . '</span>' ); ?>
					</h1>
				</div>
				<div class="col-12 col-md-5">
					<?php get_search_form(); ?>
				</div>
			</div>
		</div>
	</div>
</header>