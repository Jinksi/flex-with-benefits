<div class="woo-grid">
  <div class="sidebar-open button">Filter by ></div>
  <div class="flex woo-tools">
    <?php do_action('woo_custom_breadcrumb'); ?>
    <?php do_action('woo_custom_catalog_ordering'); ?>
  </div>
  <?php if ( have_posts() ) : ?>
    <div class="flex woo-products">
      <?php while ( have_posts() ) : the_post(); ?>
        <?php wc_get_template_part( 'woo', 'product-card' ); ?>
      <?php endwhile; ?>
    </div>
    <?php do_action( 'woo_custom_pagination' ); ?>
  <?php elseif ( ! woocommerce_product_subcategories( array( 'before' => woocommerce_product_loop_start( false ), 'after' => woocommerce_product_loop_end( false ) ) ) ) : ?>

    <div class="woocommerce-message">
      <p>No products found</p>
    </div>
  <?php endif; ?>
</div>
