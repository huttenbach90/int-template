<article class="post row">

	<div class="col-12 col-lg-8 paper box-shadow">
		<h1 class="title display-3">
			<?php the_title(); ?>
		</h1>
		<div class="the-content pt-2">
			<?php the_content(); ?>
		</div>
		<?php get_template_part('/parts/module', 'responses'); ?>		
	</div>

	<?php get_template_part('/parts/aside', 'related'); ?>

</article>