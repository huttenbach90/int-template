<?php
/* Template Name: Homepage */
?>
<?php get_header(); ?>

<?php get_template_part('parts/page-home', 'header' ); ?>

<div class="container">

    <?php // Popular courses ?>
    <div id="courses" class="row mt-5">
        <h2 class="col-12 text-uppercase mb-4"><?php _e('Popular courses', 'oneindustry'); ?></h2>

        <?php
        global $post;

        $loop = new WP_Query(
            array(
                'post_type' => 'sfwd-courses',
                'posts_per_page' => 3,
                'order' => 'desc',
                'orderby' => 'menu_order',
            )
        );

        $i = 0;

        while ($loop->have_posts()) : $loop->the_post(); ?>

            <?php if ($i == 0) : ?>

                <div class="col-12 col-lg-5 mb-4 mb-lg-0">
                    <div class="card card-shadow h-100">
                        <div class="card-body p-1">
                            <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
                                <?php
                                    if ( has_post_thumbnail() ) {
                                        the_post_thumbnail( 'thumbnail', array('class' => 'w-100 h-auto') );
                                    } else {
                                        echo '<img class="h-auto w-100 no-decoration" src="' . get_bloginfo( 'template_directory' ) . '/assets/img/no-pic.jpg" />';
                                    } 
                                ?>
                            </a>
                            <div class="mt-3">
                                <a class="text-dark no-decoration" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
                                    <h3 class="font-weight-normal"><?php the_title(); ?></h3>
                                </a>
                                <span class="info-course d-block">
                                    <?php 

                                    $page_id = get_the_ID();
                                    $time = get_post_meta($post->ID, "time", true);
                                    
                                    $lessons_query = new WP_Query(array(
                                        'post_type' => 'sfwd-lessons',
                                        'meta_query' => array(
                                            array(
                                                'key' => 'course_id',
                                                'value' => $page_id,
                                            )
                                        )
                                    ));
                                    if ($lessons_query->have_posts()) : $lessons_query->the_post(); ?>
                                        <?php
                                        $count_lessons = $lessons_query->post_count;
                                        echo $count_lessons . " ";
                                        if ($count_lessons > 1) {
                                            echo __("Lessons", "integromat");
                                        } else {
                                            echo __("Lesson", "integromat");
                                        } ?>
                                    <?php
                                    wp_reset_postdata();
                                    endif;
                                   
                                   
                                    ?>
                                </span>
                                <div class="meta clearfix">
                                    <div class="com-number">
                                        <small><i class="far fa-clock text-muted"></i></small> 
                                        <span class="text-muted">
                                            <?php if ($time != "") : ?>
                                                <?php echo $time ?>
                                            <?php else : ?>
                                                <?php echo _e("Unknown", "integromat"); ?>
                                            <?php endif; ?>
                                        </span>
                                    </div>
                                    <?php $term_list = wp_get_post_terms($page_id, 'ld_course_category', array("fields" => "all")); ?>
                                    <strong>
                                        <a href="<?php bloginfo("url"); echo "/course-category/" . $term_list[0]->slug; ?>" class="no-decoration">
                                            <?php echo $term_list[0]->name ; ?>
                                        </a>
                                    </strong>
								</div>
                            </div>
                        </div>

                <?php elseif ($i == 1 ) : ?>

                    <div class="col-12 col-lg-7">
                        <div class="row">
                            <div class="col-12 mb-4 mb-lg-0">
                                <div class="card card-shadow">
                                    <div class="card-body p-1">
                                        <div class="row">
                                            <div class="col-12 col-md-6 mb-4 mb-md-0 d-lg-none d-xl-block">
                                                <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
                                                    <?php
                                                        if ( has_post_thumbnail() ) {
                                                            the_post_thumbnail( 'thumbnail', array('class' => 'w-100 h-auto') );
                                                        } else {
                                                            echo '<img class="h-auto w-100 no-decoration" src="' . get_bloginfo( 'template_directory' ) . '/assets/img/no-pic.jpg" />';
                                                        }
                                                    ?>
                                                </a>
                                            </div>
                                            <div class="col-12 col-md-6 col-lg-12 col-xl-6">
                                                <a class="text-dark font-weight-normal no-decoration" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
                                                    <h3 class="font-weight-normal"><?php the_title(); ?></h3>
                                                </a>
                                                <span class="info-course d-block">
                                                    <?php 
                                                    $page_id = get_the_ID();
                                                    $time = get_post_meta($post->ID, "time", true);

                                                    $lessons_query = new WP_Query(array(
                                                        'post_type' => 'sfwd-lessons',
                                                        'meta_query' => array(
                                                            array(
                                                                'key' => 'course_id',
                                                                'value' => $page_id,
                                                            )
                                                        )
                                                    ));
                                                    if ($lessons_query->have_posts()) : $lessons_query->the_post(); ?>
                                                        <?php
                                                        $count_lessons = $lessons_query->post_count;
                                                        echo $count_lessons . " ";
                                                        if ($count_lessons > 1) {
                                                            echo __("Lessons", "integromat");
                                                        } else {
                                                            echo __("Lesson", "integromat");
                                                        } ?>
                                                    <?php
                                                    wp_reset_postdata();
                                                    endif;
                                                    ?>
                                                </span>
                                                <div class="meta clearfix">
                                                    <div class="com-number">
                                                        <small><i class="far fa-clock text-muted"></i></small> 
                                                        <span class="text-muted">
                                                            <?php if ($time != "") : ?>
                                                                <?php echo $time ?>
                                                            <?php else : ?>
                                                                <?php echo _e("Unknown", "integromat"); ?>
                                                            <?php endif; ?>
                                                        </span>
                                                    </div>
                                                    <?php $term_list = wp_get_post_terms($page_id, 'ld_course_category', array("fields" => "all")); ?>
                                                    <strong>
                                                        <a href="<?php bloginfo("url"); echo "/course-category/" . $term_list[0]->slug; ?>" class="no-decoration">
                                                            <?php echo $term_list[0]->name ; ?>
                                                        </a>
                                                    </strong>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                <?php elseif ($i == 2) : ?>

                            <div class="col-12 mt-lg-4">
                                <div class="card card-shadow">
                                    <div class="card-body p-1">
                                        <div class="row">
                                            <div class="col-12 col-md-6 mb-4 mb-md-0 d-lg-none d-xl-block">
                                                <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
                                                    <?php
                                                        if ( has_post_thumbnail() ) {
                                                            the_post_thumbnail( 'thumbnail', array('class' => 'w-100 h-auto') );
                                                        } else {
                                                            echo '<img class="h-auto w-100 no-decoration" src="' . get_bloginfo( 'template_directory' ) . '/assets/img/no-pic.jpg" />';
                                                        } 
                                                    ?>
                                                </a>
                                            </div>
                                            <div class="col-12 col-md-6 col-lg-12 col-xl-6">
                                                <a class="text-dark font-weight-normal no-decoration" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
                                                    <h3 class="font-weight-normal"><?php the_title(); ?></h3>
                                                </a>
                                                <span class="info-course d-block">
                                                <?php 
                                                    $page_id = get_the_ID();
                                                    $time = get_post_meta($post->ID, "time", true);

                                                    $lessons_query = new WP_Query(array(
                                                        'post_type' => 'sfwd-lessons',
                                                        'meta_query' => array(
                                                            array(
                                                                'key' => 'course_id',
                                                                'value' => $page_id,
                                                            )
                                                        )
                                                    ));
                                                    if ($lessons_query->have_posts()) : $lessons_query->the_post(); ?>
                                                        <?php
                                                        $count_lessons = $lessons_query->post_count;
                                                        echo $count_lessons . " ";
                                                        if ($count_lessons > 1) {
                                                            echo __("Lessons", "integromat");
                                                        } else {
                                                            echo __("Lesson", "integromat");
                                                        } ?>
                                                    <?php
                                                    wp_reset_postdata();
                                                    endif;
                                                    ?>
                                                </span>
                                                <div class="meta clearfix">
                                                    <div class="com-number">
                                                        <small><i class="far fa-clock text-muted"></i></small> 
                                                        <span class="text-muted">
                                                            <?php if ($time != "") : ?>
                                                                <?php echo $time ?>
                                                            <?php else : ?>
                                                                <?php echo _e("Unknown", "integromat"); ?>
                                                            <?php endif; ?>
                                                        </span>
                                                    </div>
                                                    <?php $term_list = wp_get_post_terms($page_id, 'ld_course_category', array("fields" => "all")); ?>
                                                    <strong>
                                                        <a href="<?php bloginfo("url"); echo "/course-category/" . $term_list[0]->slug; ?>" class="no-decoration">
                                                            <?php echo $term_list[0]->name ; ?>
                                                        </a>
                                                    </strong>
                                                </div>
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

        <div class="col-12 mt-5 mb-5 text-right">
            <a class="no-decoration" href="<?php echo get_post_type_archive_link( 'sfwd-courses' ); ?>">
                <?php _e("All courses", "integromat"); ?>
                <i class="fal fa-angle-right"></i>
            </a>
        </div>

    </div>
</div>

<?php // Popular tutorials ?>
<div id="tutorials" class="bg-white pt-5 pb-5">
    <div class="container">
        <div class="row">
            <h2 class="col-12 text-uppercase mb-4"><?php _e('Popular tutorials', 'oneindustry'); ?></h2>

            <?php
                global $post;

                $loop = new WP_Query(
                    array(
                        'post_type' => 'tutorial',
                        'posts_per_page' => 3,
                        'order' => 'desc',
                        'orderby' => 'date'
                    )
                );

                while ($loop->have_posts()) : $loop->the_post(); ?>

                    <div class="col-12 col-md-6 col-lg-4 mb-4 mb-lg-0">
                        <div class="card card-shadow">
                            <div class="card-body p-1">    
                                <?php $term_list = wp_get_post_terms($post->ID, 'format', array("fields" => "all")); ?>
                                <?php if ($term_list[0]->slug == "video") : ?>
                                    <div class="text-uppercase mb-3 pb-1 cat-name">
                                        <a href="<?php bloginfo("url"); echo "/format/" . $term_list[0]->slug; ?>" class="text-grey no-decoration">
                                            <?php echo $term_list[0]->name ; ?>
                                        </a>
                                        <i class='fas fa-video float-right text-grey'></i>
                                    </div>
                                <?php 
                                endif; ?>
                                <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
                                    <?php
                                        if ( has_post_thumbnail() ) {
                                            the_post_thumbnail( 'thumbnail', array('class' => 'w-100 h-auto') );
                                        } else {
                                            echo '<img class="h-auto w-100 no-decoration" src="' . get_bloginfo( 'template_directory' ) . '/assets/img/no-pic.jpg" />';
                                        }
                                    ?>
                                </a>
                                <div class="mt-3">
                                    <a class="text-dark no-decoration" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
                                        <h3 class="font-weight-normal"><?php the_title(); ?></h3>
                                    </a>
                                    <?php the_excerpt(); ?>
                                </div>
                            </div>
                        </div>
                    </div>

                <?php
                    $i++;
                    endwhile;
                    wp_reset_postdata(); ?>

            <div class="col-12 mt-5 text-right">
                <a class="no-decoration" href="<?php bloginfo("url"); echo "/tutorials/"; ?>">
                    <?php _e("All tutorials", "integromat"); ?>
                    <i class="fal fa-angle-right"></i>
                </a>
            </div>
        </div>
    </div>
</div>