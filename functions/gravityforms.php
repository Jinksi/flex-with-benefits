<?php
add_filter( 'gform_enable_field_label_visibility_settings', '__return_true' );
add_filter( 'gform_confirmation_anchor', '__return_true' );

add_filter( 'gform_ajax_spinner_url', 'spinner_url', 10, 2 );
function spinner_url( $image_src, $form ) {
  return get_template_directory_uri() . '/images/spinner-transparent.gif';
}
?>
