<?php add_action( 'init', 'create_product_post_type' );
//Registers the Product's post type
function create_product_post_type() {
    register_post_type( 'product',
        array(
            'labels' => array(
                'name' => __( 'Products' ),
                'singular_name' => __( 'Product' )
            ),
        'public' => true,
        'has_archive' => false,
        'menu_icon' => 'dashicons-list-view',
        )
    );
}
?>
