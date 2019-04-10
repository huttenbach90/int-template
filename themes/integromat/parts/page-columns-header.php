        <div class="jumbotron px-0 clearfix">
			<div class="row align-items-center">
				<div class="col-12 col-md-7">
					<h1 class="display-3"><?php the_title(); ?></h1>
					<?php
					while (have_posts()) : the_post(); ?>
						<div class="lead">
							<?php the_content(); ?>
						</div>
					<?php
					endwhile; ?>
				</div>
				<div class="col-12 col-md-5">
					<?php get_search_form(); ?>
				</div>
			</div>
		</div>
	</div>
</header>