<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS" href="<?php bloginfo('rss2_url'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1.0, maximum-scale=1.0" />
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

	<header class="header">
		<div class="header__wrap container flex">
			<a class="logo" href="<?php echo esc_url( home_url() ); ?>">
				<img src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/logo.svg" alt="<?php bloginfo('name'); ?> "/>
			</a>
			<nav class="header__nav">
				<?php wp_nav_menu(array('theme_location' => 'main', 'container' => false )); ?>
			</nav>
		</div>
	</header>

	<?php get_template_part( 'components/page-header' ); ?>
