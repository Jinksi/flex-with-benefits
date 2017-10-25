<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
if ( post_password_required() ) { echo get_the_password_form(); return; }
global $product;
?>

<section class="section">
	<div class="container">
		<?php do_action('woo_custom_breadcrumb'); ?>
		<br>
		<div <?php post_class('flex'); ?>>
			<div class="woo-gallery">
				<?php
				/**
				* woocommerce_before_single_product_summary hook.
				*
				* @hooked woocommerce_show_product_sale_flash - 10
				* @hooked woocommerce_show_product_images - 20
				*/
				do_action( 'woocommerce_before_single_product_summary' );
				?>
			</div>
			<div class="woo-details">
				<?php
				/**
				* woocommerce_single_product_summary hook.
				*
				* @hooked woocommerce_template_single_title - 5
				* @hooked woocommerce_template_single_rating - 10
				* @hooked woocommerce_template_single_price - 10
				* @hooked woocommerce_template_single_excerpt - 20
				* @hooked woocommerce_template_single_add_to_cart - 30
				* @hooked woocommerce_template_single_meta - 40
				* @hooked woocommerce_template_single_sharing - 50
				* @hooked WC_Structured_Data::generate_product_data() - 60
				*/
				do_action( 'woocommerce_single_product_summary' );
				?>

			</div>
		</div>
	</div>
</section>

<?php wc_get_template_part( 'woo-related-products' ); ?>
