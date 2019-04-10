<?php get_header(); ?>

<?php get_template_part('/parts/page-columns', 'header'); ?>

	<div id="content" role="main" class="container">

		<?php if ( have_posts() ) : ?>

			<?php while ( have_posts() ) : the_post(); ?>
				<div class="card">
                            <div class="card-body">
                                <span class="d-block post-type-name">
                                    <?php echo get_post_type(get_the_ID()); ?>
                                </span>
                                <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
                                    <?php
                                        if ( has_post_thumbnail() ) {
                                            the_post_thumbnail( 'thumbnail', array('class' => 'w-100 h-auto') );
                                        };
                                    ?>
                                </a>
                                <div class="mt-3">
                                    <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
                                        <h3><?php the_title(); ?></h3>
                                    </a>
                                    <span class="info-course d-block">
                                        <?php
                                            $tags = get_tags();
                                            $count_tags = count($tags);
                                            echo $count_tags . " " . __("Modules", "integromat") . " | " . get_post_meta($post->ID, "videos", true) . " " . __("Videos", "integromat"); ?>
                                    </span>
                                    <span class="time-course d-block">
                                        <i class="far fa-clock"></i> <?php echo get_post_meta($post->ID, "time", true); ?>
                                    </span>
                                    <strong class="level-course d-block">
                                        <?php echo get_the_term_list($post->ID, "level", "", ", ", ""); ?>
                                    </strong>
                                </div>
							</div>
									<?php endwhile; ?>
									<?php endif; ?>