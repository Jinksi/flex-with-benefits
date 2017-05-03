<?php
/////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////// ENQUEUE

//CSS auto version
add_action( 'wp_enqueue_scripts', 'flex_non_cached_stylesheet' );
function flex_non_cached_stylesheet(){
  wp_enqueue_style(
    'style-main',
    get_stylesheet_directory_uri().'/style.css',
    array(),
    filemtime( get_stylesheet_directory().'/style.css' )
  );

  wp_enqueue_script('jquery');

  wp_enqueue_script(
    'mainjs',
    get_template_directory_uri().'/js/main.min.js',
    null,
    null,
		true
  );

  // Font Awesome
  wp_enqueue_style( 'fontawesome', 'https://use.fontawesome.com/c81fe3ea32.css');

}
?>
