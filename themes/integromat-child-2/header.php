<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width" />
<title>
	<?php bloginfo('name'); ?> | 
	<?php is_front_page() ? bloginfo('description') : wp_title(''); ?>
</title>

<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

<!--[if lt IE 9]>
<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js" type="text/javascript"></script>
<![endif]-->

<?php wp_head(); ?>

</head>

<body <?php body_class(); ?>>

	<header>
		<div class="container">
			<nav class="navbar navbar-expand-lg navbar-light bg-light">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home" class="navbar-brand">
					<?php bloginfo( 'name' ); ?>
				</a>
				<?php get_search_form(); ?>
				<button class="navbar-toggler x collapsed" type="button" data-toggle="collapse" data-target="#navigation" aria-controls="navigation" aria-expanded="false" aria-label="Toggle navigation">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<?php
				wp_nav_menu([
					'menu'            => 'primary',
					'theme_location'  => 'primary',
					'container'       => 'div',
					'container_id'    => 'navigation',
					'container_class' => 'collapse navbar-collapse justify-content-right',
					'menu_id'         => false,
					'menu_class'      => 'navbar-nav ml-auto',
					'depth'           => 2,
					'fallback_cb'     => 'bs4navwalker::fallback',
					'walker'          => new bs4navwalker()
				]);
				?>
				</div>
			</nav>
		</div>

	</header>

	<main class="container">