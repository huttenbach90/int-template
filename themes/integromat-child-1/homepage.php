<?php
/* Template Name: Homepage */
?>
<?php get_header(); ?>

<div class="container">

    <?php // Popular courses ?>
    <div class="row">
        <h2 class="col-12"><?php _e('Popular courses', 'oneindustry'); ?></h2>

        <?php
            global $post;

            $loop = new WP_Query(
                array(
                    'post_type' => 'course',
                    'posts_per_page' => 3,
                    'order' => 'desc',
                    'orderby' => 'menu_order',
                    'post_parent' => 0,
                )
            );

            $i = 0;

            while ($loop->have_posts()) : $loop->the_post(); ?>

                <?php if ($i == 0) : ?>

                    <div class="col-5">
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

                <?php elseif ($i == 1 ) : ?>

                    <div class="col-7">
                        <div class="row">
                            <div class="col-12 mb-2">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-6">
                                                <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
                                                    <?php
                                                        if ( has_post_thumbnail() ) {
                                                            the_post_thumbnail( 'thumbnail', array('class' => 'w-100 h-auto') );
                                                        };
                                                    ?>
                                                </a>
                                            </div>
                                            <div class="col-6">
                                                <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
                                                    <?php the_title(); ?>
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
                                    </div>

                <?php elseif ($i == 2) : ?>

                            <div class="col-12 mt-4">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-6">
                                                <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
                                                    <?php
                                                        if ( has_post_thumbnail() ) {
                                                            the_post_thumbnail( 'thumbnail', array('class' => 'w-100 h-auto') );
                                                        };
                                                    ?>
                                                </a>
                                            </div>
                                            <div class="col-6">
                                                <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
                                                    <?php the_title(); ?>
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
                                    </div>
                                </div>
                            </div>

                <?php endif; ?>

                    </div>
                </div>

            <?php
                $i++;
                endwhile;
                wp_reset_postdata(); ?>

        <div class="col-12">
            <a class="btn btn-link" href="/course/">
                <?php _e("All courses", "integromat"); ?>
                <i class="fal fa-angle-right"></i>
            </a>
        </div>

    </div>
</div>

<?php // Popular tutorials ?>
<div class="bg-white">
    <div class="container">
        <div class="row">
            <h2 class="col-12"><?php _e('Popular tutorials', 'oneindustry'); ?></h2>

            <?php
                global $post;

                $loop = new WP_Query(
                    array(
                        'post_type' => 'post',
                        'posts_per_page' => 3,
                        'order' => 'desc',
                        'orderby' => 'date',
                        'post_parent' => 0,
                    )
                );

                while ($loop->have_posts()) : $loop->the_post(); ?>

                    <div class="col-4">
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
                                </div>
                            </div>
                        </div>
                    </div>

                <?php
                    $i++;
                    endwhile;
                    wp_reset_postdata(); ?>

            <div class="col-12">
                <a class="btn btn-link" href="/tutorial/">
                    <?php _e("All tutorials", "integromat"); ?>
                    <i class="fal fa-angle-right"></i>
                </a>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <div class="row">
        <h2 class="col-12"><?php _e('Popular topics', 'oneindustry'); ?></h2>



        <div class="col-12">
            <a class="btn btn-link" href="/tutorial/">
                <?php _e("All topics", "integromat"); ?>
                <i class="fal fa-angle-right"></i>
            </a>
        </div>
    </div>
</div>
