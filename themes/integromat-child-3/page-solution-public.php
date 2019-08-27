<?php
/*
Template Name: Submit solution Public
*/
?>

<?php get_header(); ?>

<?php get_template_part('parts/page-no', 'header'); ?>

<div id="content" class="container">

	<div class="row">
        <div class="col-12 col-lg-8 paper box-shadow mb-4">
            <h1 class="display-3 mb-5"><?php the_title(); ?></h1>
                <?php if (have_posts()) : ?>
					<?php while (have_posts()) : the_post(); ?>
                        <div class="mb-5"><?php echo the_content(); ?></div>
                    <?php 
                    endwhile; 
                endif; ?>
            <?php echo do_shortcode('[cg-salution]'); ?>
        </div>
        <?php get_template_part('parts/aside', 'resources'); ?>
    </div>

    <?php get_template_part('parts/module', 'tokenfield'); ?>
    <?php get_template_part('parts/module', 'tinymce'); ?>

</div>

<?php get_template_part('parts/footer', 'contact'); ?>
<?php get_template_part('parts/footer', 'app'); ?>

<?php get_footer(); ?>