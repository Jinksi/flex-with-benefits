<?php
/////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////// Yoast
// Move metabox to bottom
add_filter( 'wpseo_metabox_prio', function() { return 'low';});

// Removes the Yoast columns from pages & posts
function prefix_remove_yoast_columns( $columns ) {
  unset( $columns['wpseo-score'] );
  unset( $columns['wpseo-title'] );
  unset( $columns['wpseo-metadesc'] );
  unset( $columns['wpseo-focuskw'] );
  return $columns;
}
add_filter ( 'manage_edit-post_columns',    'prefix_remove_yoast_columns' );
add_filter ( 'manage_edit-page_columns',    'prefix_remove_yoast_columns' );
// add_filter ( 'manage_edit-{post_type}_columns',    'prefix_remove_yoast_columns' );

/////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////// WP-LOGIN Autofocus Fix
add_action("login_form", "kill_wp_attempt_focus");
function kill_wp_attempt_focus() {
    global $error;
    $error = TRUE;
}
?>
