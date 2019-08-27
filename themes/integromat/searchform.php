<form id="searchform" class="position-relative
    <?php if (is_front_page()) : ?> mt-4
    <?php elseif (is_page("documentation")) : ?> mt-4 float-left float-md-right mt-md-0
    <?php else : ?> mt-2
    <?php endif; ?>"
    action="/" method="get">

    <input class="
        <?php if (is_front_page()) : ?>mt-3
        <?php elseif (is_page("documentation")) : ?> mt-0
        <?php else : ?>mb-4
        <?php endif; ?>"
        type="text" name="s" id="search" value="<?php the_search_query(); ?>"
        placeholder="<?php echo __('Search the', 'integromat'); ?> <?php bloginfo( 'name' ); ?>"/>
    <i class="far fa-search"></i>
</form>