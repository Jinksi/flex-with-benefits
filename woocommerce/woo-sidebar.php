<div class="woo-sidebar">
  <div class="sidebar-close button">Close X</div>

  <?php $form = '<form class="flex-row" role="search" method="get" id="searchform" action="' . esc_url( home_url( '/'  ) ) . '">
      <input type="text" value="' . get_search_query() . '" name="s" id="s" placeholder="' . __( 'Search Products', 'woocommerce' ) . '" />
      <input type="hidden" name="post_type" value="product" />
    </form>';
    echo $form;
  ?>
  <h3>Filter by category</h3>
  <?php wp_nav_menu(array('theme_location' => 'sidebar', 'container' => false )); ?>
</div>
