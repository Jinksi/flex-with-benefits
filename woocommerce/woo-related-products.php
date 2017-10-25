<?php
  global $product;
  $id = get_the_id();
  $related = wc_get_related_products($id);
  if ($related): ?>
  <section class="section thick woo-related-products">
    <div class="container">
      <?php do_action('custom_related_products'); ?>
    </div>
  </section>
<?php endif; ?>
