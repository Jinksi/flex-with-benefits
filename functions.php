<?php

////////////////////////////////////////////////////////
/// Login Logo
function my_login_logo() { ?>
  <style type="text/css">
    .login h1 a {
      background-image: url(<?php echo get_stylesheet_directory_uri(); ?>/images/logo.svg);
      margin: 0 auto;
      height: 150px;
      width: 80%;
      background-size: contain;
    }
  </style>
<?php }
add_action( 'login_enqueue_scripts', 'my_login_logo' );
function my_login_logo_url() {
  return home_url();
}
add_filter( 'login_headerurl', 'my_login_logo_url' );

function my_login_logo_url_title() {
  return get_bloginfo( 'title' );
}
add_filter( 'login_headertitle', 'my_login_logo_url_title' );

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

	// Underscores
	// wp_enqueue_script( 'underscore', get_template_directory_uri() . '/js/underscore-min.js', null, null, true);
	// wp_enqueue_script( 'underscore-string', get_template_directory_uri() . '/js/underscore.string-min.js', null, null, true);

	// Imagesloaded
	// wp_enqueue_script( 'imagesloaded', get_template_directory_uri() . '/js/imagesloaded.pkgd.min.js', null, null, true);

	// Flickity
	// wp_enqueue_script( 'flickity', get_template_directory_uri() . '/js/flickity.pkgd.min.js', null, null, true);

	// Plyr
	wp_enqueue_script( 'plyr', get_template_directory_uri() . '/js/plyr.js', null, null, true);

	// Picturefill
	// wp_enqueue_script('picturefill', 'https://cdn.rawgit.com/scottjehl/picturefill/3.0.2/dist/picturefill.min.js', null, null, true);

	// Magnific
	wp_enqueue_script( 'magnific', get_template_directory_uri() . '/js/magnific.min.js', null, null, true);

	// Fastclick
	wp_enqueue_script('fastclick', get_template_directory_uri() . '/js/fastclick.js', null, null, true);

	// Font Awesome
	wp_enqueue_style( 'fontawesome', 'https://use.fontawesome.com/c81fe3ea32.css');

  wp_enqueue_script(
    'mainjs',
    get_template_directory_uri().'/js/main.js',
    array(),
    filemtime( get_stylesheet_directory().'/js/main.js' ),
		true
  );
}

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
//////////////////////////////Default Functions

/////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////// Title Tag Support
function theme_slug_setup() {
   add_theme_support( 'title-tag' );
}
add_action( 'after_setup_theme', 'theme_slug_setup' );

///////////////////////////////////////////////////////
// No pingbacks for security
// http://blog.sucuri.net/2014/03/more-than-162000-wordpress-sites-used-for-distributed-denial-of-service-attack.html
add_filter( 'xmlrpc_methods', function( $methods ) {
  unset( $methods['pingback.ping'] );
  return $methods;
} );

//// Nice url
function niceurl($url) {
	$url = str_replace('http://', '', $url);
	$url = str_replace('https://', '', $url);
	$url = str_replace('www.', '', $url);
	$url = rtrim($url, "/");
    return $url;
}
// Usage
// niceurl('http://google.com.au/');
/// outputs -> google.com.au

///////////////////////////////////////////////////////

// add_image_size( '100x100', 100, 100, true );
add_image_size( '100w', 100, 0, false );
// add_image_size( '200x200', 200, 200, true );
add_image_size( '200w', 200, 0, false );
// add_image_size( '400x400', 400, 400, true );
add_image_size( '400w', 400, 0, false );
// add_image_size( '600x600', 600, 600, true );
add_image_size( '600w', 600, 0, false );
// add_image_size( '800x800', 800, 800, true );
add_image_size( '800w', 800, 0, false );
// add_image_size( '1000x1000', 1000, 1000, true );
// add_image_size( '1000w', 1000, 0, false );
// add_image_size( '1200x1200', 1200, 1200, true );
add_image_size( '1200w', 1200, 0, false );
// add_image_size( '1500x1500', 1500, 1500, true );
// add_image_size( '1500w', 1500, 0, false );
// add_image_size( '1800x1800', 1800, 1800, true );
add_image_size( '1800w', 1800, 0, false );

//////////////////////////////////////////////////////
// IMAGE QUALITY
function gpp_jpeg_quality_callback($arg) {

    return (int)75; // change 100 to whatever you prefer, but don't go below 60

}
add_filter('jpeg_quality', 'gpp_jpeg_quality_callback');

///////////////////////////////////////////////////////
//Add an excerpt box for pages
if ( function_exists('add_post_type_support') ){
  add_action('init', 'add_page_excerpts');
  function add_page_excerpts(){
    add_post_type_support( 'page', 'excerpt' );
  }
}

///////////////////////////////////////////////////////
//Remove admin tool bar
function my_function_admin_bar(){
  return 0;
}
add_filter( 'show_admin_bar' , 'my_function_admin_bar');

///////////////////////////////////////////////////////
// Check for no robots
add_action( 'admin_notices', 'my_admin_notice' );
function my_admin_notice(){
     if ( !get_option('blog_public') ){
          //echo '<div class="updated" ><p>Warning</p></div>';
          echo '<div class="error"><p>Search engines are blocked</p></div>';
     }
}

///////////////////////////////////////////////////////
// Custom menu
add_action('init', 'register_custom_menu');
function register_custom_menu() {
	register_nav_menu('main', 'Main Menu');
	register_nav_menu('foot', 'Footer Menu');
}

/////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////// Woo specific Functions

if ( class_exists( 'WooCommerce' ) ){
  require_once('woo-functions.php');
}

?>
