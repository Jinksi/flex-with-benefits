<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
get_header( 'shop' ); ?>

	<?php wc_get_template_part( 'woo', 'banner' ); ?>

	<section class="section">
		<div class="container">
			<div class="flex woo-archive">
				<?php wc_get_template_part( 'woo', 'sidebar' ); ?>
				<?php wc_get_template_part( 'woo', 'grid' ); ?>
			</div>
		</div>
	</section>

<?php get_footer( 'shop' ); ?>
