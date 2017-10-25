<?php
/**
 * The template to display the reviewers meta data (name, verified owner, review date)
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.7.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

global $comment;
$verified = wc_review_is_from_verified_owner( $comment->comment_ID );

if ( '0' === $comment->comment_approved ) { ?>

	<p class="meta"><em class="woocommerce-review__awaiting-approval"><?php esc_attr_e( 'Your review is awaiting approval', 'woocommerce' ); ?></em></p>

<?php } else { ?>
	<div class="reviews">
		<?php
			$rating = intval( get_comment_meta( $comment->comment_ID, 'rating', true ) );
			$date = $comment->comment_date."";
			$date = DateTime::createFromFormat('Y-m-d H:i:s', $date);
		?>
		<div class="info">
			<div class="flex title-bar">
				<div class="author">
					<?php echo $comment->comment_author; ?>
				</div>
				<div class="flex star-rating number-<?php echo $rating; ?>">
					<div class="star"></div>
					<div class="star"></div>
					<div class="star"></div>
					<div class="star"></div>
					<div class="star"></div>
				</div>
			</div>
			<div class="date"><?php echo $date->format('d F Y'); ?></div>
			<p>
				<?php echo $comment->comment_content; ?>
			</p>
		</div>
	</div>
<hr>

<?php }
