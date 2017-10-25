<?php
	if ( ! defined( 'ABSPATH' ) ) { exit; }
	get_header( 'shop' );
?>

	<?php while ( have_posts() ) : the_post(); ?>
		<?php wc_get_template_part( 'content', 'single-product' ); ?>
	<?php endwhile; // end of the loop. ?>

<?php
	get_footer( 'shop' );
	/* Omit closing PHP tag at the end of PHP files to avoid "headers already sent" issues. */
