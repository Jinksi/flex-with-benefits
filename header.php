<!doctype html>
<html>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS" href="<?php bloginfo('rss2_url'); ?>">
	<link href='https://fonts.googleapis.com/css?family=Roboto:400,700,400italic' rel='stylesheet' type='text/css'>
	<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1.0, maximum-scale=1.0, minimal-ui" />
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

	<header class="header">
		<div class="header-wrap container flex">
			<a id="logo" href="<?php bloginfo('url'); ?>">
				<img src="<?php bloginfo('template_directory'); ?>/images/logo.svg" alt="<?php bloginfo('name'); ?> "/>
			</a>
			<nav class="header-nav">
				<?php wp_nav_menu(array('theme_location' => 'main', 'container' => false )); ?>
			</nav>
			<?php if ( class_exists( 'WooCommerce' ) ) {?>
				<div id="side_cart">
					<?php global $woocommerce; ?>
					<a class="cart-contents" href="<?php echo $woocommerce->cart->get_cart_url(); ?>" title="<?php _e('View your shopping cart', 'woothemes'); ?>">
						<i class="fa fa-shopping-cart"></i><?php echo sprintf(_n('Cart [%d]', 'Cart [%d]', $woocommerce->cart->cart_contents_count, 'woothemes'), $woocommerce->cart->cart_contents_count);?>
					</a>
				</div>
			<?php } ?>
		</div>
	</header>
	<div class="header-padding"></div>
