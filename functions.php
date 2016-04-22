<?php

// based on https://gist.github.com/cosmocatalano/4544576
function scrape_insta($username) {
	$insta_source = file_get_contents('http://instagram.com/'.$username);
	$shards = explode('window._sharedData = ', $insta_source);
	$insta_json = explode(';</script>', $shards[1]);
	$insta_array = json_decode($insta_json[0], TRUE);
	$latest_array = $insta_array['entry_data']['ProfilePage'][0]['user']['media']['nodes'];
	return $latest_array;
}

// Move Yoast to bottom
add_filter( 'wpseo_metabox_prio', function() { return 'low';});

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
////////////////////////////// Scale Up Small Images
function image_crop_dimensions($default, $orig_w, $orig_h, $new_w, $new_h, $crop){
    if ( !$crop ) return null; // let the wordpress default function handle this
    $aspect_ratio = $orig_w / $orig_h;
    $size_ratio = max($new_w / $orig_w, $new_h / $orig_h);
    $crop_w = round($new_w / $size_ratio);
    $crop_h = round($new_h / $size_ratio);
    $s_x = floor( ($orig_w - $crop_w) / 2 );
    $s_y = floor( ($orig_h - $crop_h) / 2 );
    return array( 0, 0, (int) $s_x, (int) $s_y, (int) $new_w, (int) $new_h, (int) $crop_w, (int) $crop_h );
}
//Now hook this function like so:
add_filter('image_resize_dimensions', 'image_crop_dimensions', 10, 6);

/////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////// Woo specific Functions

if ( class_exists( 'WooCommerce' ) ){
  require_once('woo-functions.php');
}
/////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////// CSS FUNCTIONS

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
	// wp_enqueue_script( 'underscore', get_bloginfo('template_directory') . '/js/underscore-min.js');
	// wp_enqueue_script( 'underscore-string', get_bloginfo('template_directory') . '/js/underscore.string-min.js');

	// Imagesloaded
	// wp_enqueue_script( 'imagesloaded', get_bloginfo('template_directory') . '/js/imagesloaded.pkgd.min.js');

	// Flickity
	// wp_enqueue_script( 'flickity', get_bloginfo('template_directory') . '/js/flickity.pkgd.min.js');

	// Fastclick
	wp_enqueue_script('fastclick', get_bloginfo('template_directory') . '/js/fastclick.js');

	// Font Awesome
	wp_enqueue_style( 'font-awesome', get_bloginfo('template_directory') . '/font-awesome/css/font-awesome.min.css'  );

  wp_enqueue_script(
    'mainjs',
    get_template_directory_uri().'/js/main.js',
    array(),
    filemtime( get_stylesheet_directory().'/js/main.js' )
  );
}

/////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////// Title Tag Support
function theme_slug_setup() {
   add_theme_support( 'title-tag' );
}
add_action( 'after_setup_theme', 'theme_slug_setup' );

/////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////// CUSTOM POSTS

//////*custom post current page
function dtbaker_wp_nav_menu_objects($sorted_menu_items, $args){
    // this is the code from nav-menu-template.php that we want to stop running
    // so we try our best to "reverse" this code wp code in this filter.
    /* if ( ! empty( $home_page_id ) && 'post_type' == $menu_item->type && empty( $wp_query->is_page ) && $home_page_id == $menu_item->object_id )
            $classes[] = 'current_page_parent'; */

    // check if the current page is really a blog post.
    //print_r($wp_query);exit;
    global $wp_query;
    if(!empty($wp_query->queried_object_id)){
        $current_page = get_post($wp_query->queried_object_id);
        if($current_page && $current_page->post_type=='post'){
            //yes!
        }else{
            $current_page = false;
        }
    }else{
        $current_page = false;
    }

    $home_page_id = (int) get_option( 'page_for_posts' );
    foreach($sorted_menu_items as $id => $menu_item){
        if ( ! empty( $home_page_id ) && 'post_type' == $menu_item->type && empty( $wp_query->is_page ) && $home_page_id == $menu_item->object_id ){
            if(!$current_page){
                foreach($sorted_menu_items[$id]->classes as $classid=>$classname){
                    if($classname=='current_page_parent'){
                        unset($sorted_menu_items[$id]->classes[$classid]);
                    }
                }
            }
        }
    }
    return $sorted_menu_items;
}
add_filter('wp_nav_menu_objects','dtbaker_wp_nav_menu_objects',10,2);

//add_action( 'init', 'create_post_type' );
function create_post_type() {

	register_post_type( 'ourpeople',
		array(
			'labels' => array(
				'name' => __( 'Our People' ),
				'singular_name' => __( 'Our People' )
			),
		'capability_type' =>  'page',
		'taxonomies' => array('category'),
		'public' => true,
		'has_archive' => true,
		'hierarchical' => true,
		'supports' => array('title', 'excerpt', 'editor', 'thumbnail', 'page-attributes', 'custom-fields'),
		'rewrite' => array('slug' => 'ourpeople')
		)
	);

}

// WP custom Categories

//add_action( 'init', 'build_taxonomies', 0 );
function build_taxonomies() {
    register_taxonomy( 'categories', 'menu', array( 'hierarchical' => true, 'label' => 'Categories', 'query_var' => true, 'rewrite' => true ) );
}


/////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////Default Functions

///////////////////////////////////////////////////////
// No pingsbacks for security
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


/////////////////////////////////////////////////////////////////////////////////////////////
// remove woo lightbox
add_action( 'wp_print_scripts', 'my_deregister_javascript', 100 );
function my_deregister_javascript() {
	wp_deregister_script( 'prettyPhoto' );
	wp_deregister_script( 'prettyPhoto-init' );
}
add_action( 'wp_print_styles', 'my_deregister_styles', 100 );
function my_deregister_styles() {
	wp_deregister_style( 'woocommerce_prettyPhoto_css' );
}

///////////////////////////////////////////////////////
//  Re-direct not-logged-in users to holding page
//add_action( 'wp', 'holdingpage_redirect' );
function holdingpage_redirect() {

	$surl = get_site_url();
	$surl = $surl . '/'; //add trailing /

	//Redirect to holding page
	if(!is_user_logged_in() && curPageURL() != $surl && curPageURL() != $surl . 'wp-login.php' && curPageURL() != $surl . 'wp-register.php' ) {
	    wp_redirect( $surl , 302 );
	    exit;
	}

	/*
	//Redirect to login page
	if(!is_user_logged_in() && curPageURL() != $surl . 'wp-login.php' && curPageURL() != $surl . 'wp-register.php' ) {
	    wp_redirect( $surl . 'wp-login.php', 302 );
	    exit;
	}
	*/

}

//  Get current page URL
function curPageURL() {
    $pageURL = 'http';
    if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}

    $pageURL .= "://";
    if ($_SERVER["SERVER_PORT"] != "80") {
        $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
    } else {
        $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
    }

    return $pageURL;
}

///////////////////////////////////////////////////////
// Search only posts
function SearchFilter($query) {
	if ($query->is_search) {
		$query->set('post_type', 'post');
	}
	return $query;
}
// Can break search in admin
// add_filter('pre_get_posts','SearchFilter');

///////////////////////////////////////////////////////
function pinzolo_search_form( $form ) {

	if(!empty($s)) $svalue =  esc_attr_e($s, 1);
	else $svalue = 'search';

	$home = esc_url( home_url( '/' ) );

    $form = '<form action="'. $home .'" method="get">
				<input id="Searchform" type="text" class="textfield wpcf7-text" name="s" size="24" value="' . $svalue . '" />
			</form>';

    return $form;
}
add_filter( 'get_search_form', 'pinzolo_search_form' );

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

///////////////////////////////////////////////////////
// add ie conditional html5 shim to header
function add_ie_html5_shim () {
	global $is_IE;
	if ($is_IE){
   		echo '<!--[if lt IE 9]>';
    	echo '<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>';
    	echo '<![endif]-->';
    }

}
add_action('wp_head', 'add_ie_html5_shim');

///////////////////////////////////////////////////////
// add post-formats to post_type 'page'
add_theme_support( 'post-formats', array( 'aside', 'image', 'gallery' ) );

function rename_post_formats( $safe_text ) {

    if ( $safe_text == 'Image' )
        return 'Large Feature';

    if ( $safe_text == 'Aside' )
        return 'Single Image + Content';

    if ( $safe_text == 'Gallery' )
        return 'Image List';

    return $safe_text;
}
add_filter( 'esc_html', 'rename_post_formats' );

//rename Aside in posts list table
function live_rename_formats() {
    global $current_screen;

    if ( $current_screen->id == 'edit-post' ) { ?>
        <script type="text/javascript">
        jQuery('document').ready(function() {

            jQuery("span.post-state-format").each(function() {
                if ( jQuery(this).text() == "Image" )
                    jQuery(this).text("Large Feature");
            });

            jQuery("span.post-state-format").each(function() {
                if ( jQuery(this).text() == "Aside" )
                    jQuery(this).text("Single Image + Content");
            });

            jQuery("span.post-state-format").each(function() {
                if ( jQuery(this).text() == "Gallery" )
                    jQuery(this).text("Image List");
            });

        });
        </script>
<?php }
}
add_action('admin_head', 'live_rename_formats');


///////////////////////////////////////////////////////
// Registers a dynamic sidebar.
if (function_exists('register_sidebar')){

    register_sidebar(array(
    	'name'=>'Page Sidebar',
    	'id'=>'pagesidebar',
	 	'before_widget' => '<div class="sidebar_widget">',
		'after_widget' => '</div>',
		'before_title' => '<h3>',
		'after_title' => '</h3>',
	));

	register_sidebar(array(
		'name'=>'Contact Sidebar',
		'id'=>'contactsidebar',
	 	'before_widget' => '<div class="sidebar_widget">',
		'after_widget' => '</div>',
		'before_title' => '<h3>',
		'after_title' => '</h3>',
	));

	register_sidebar(array(
		'name'=>'Blog Sidebar',
		'id'=>'blogsidebar',
	 	'before_widget' => '<div class="sidebar_widget">',
		'after_widget' => '</div>',
		'before_title' => '<h3>',
		'after_title' => '</h3>',
	));

}

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
// Returns the parent of a page. If the page does not have a parent, returns 0.
function get_parentId() {
    global $post;
    echo($post->post_parent->title);
    return $post->post_parent;
};

///////////////////////////////////////////////////////
//Add an excerpt box for pages
if ( function_exists('add_post_type_support') )
{
    add_action('init', 'add_page_excerpts');
    function add_page_excerpts()
    {
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
// Custom comments
function my_comment($comment, $args, $depth) {

	$GLOBALS['comment'] = $comment; ?>

	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">

	<div id="comment-<?php comment_ID(); ?>">

		<p class="author">
			<?php echo get_avatar($comment,$size='30'); ?>
			<?php printf(__('%s'), get_comment_author_link()) ?>
		</p>

		<p class="time"><?php printf(__('%1$s at %2$s'), get_comment_date(),  get_comment_time()) ?></p>

		<div class="clear"></div>

		<?php comment_text() ?>

		<?php if ($comment->comment_approved == '0') : ?>
			<em><?php _e('Your comment is awaiting moderation.') ?></em>
		<?php endif; ?>

		</div>
	<?php
}
//Note the lack of a trailing </li>. WordPress will add it itself once it's done listing any children and whatnot.

///////////////////////////////////////////////////////
// Add featured image to feed
function featuredtoRSS($content) {

	global $post;

	if ( has_post_thumbnail( $post->ID ) ){
		$content = '<div>' . get_the_post_thumbnail( $post->ID, 'large', array( 'style' => 'margin-bottom: 15px;' ) ) . '</div>' . $content;
	}

	return $content;
}

add_filter('the_excerpt_rss', 'featuredtoRSS');
add_filter('the_content_feed', 'featuredtoRSS');


/**
* A pagination function
* @param integer $range: The range of the slider, works best with even numbers
* Used WP functions:
* get_pagenum_link($i) - creates the link, e.g. http://site.com/page/4
* previous_posts_link(' � '); - returns the Previous page link
* next_posts_link(' � '); - returns the Next page link
*/
function get_pagination($range = 4){
  // $paged - number of the current page
  global $paged, $wp_query;
  // How much pages do we have?
  if ( !$max_page ) {
    $max_page = $wp_query->max_num_pages;
  }
  // We need the pagination only if there are more than 1 page
  if($max_page > 1){
    if(!$paged){
      $paged = 1;
    }
    // On the first page, don't put the First page link
    if($paged != 1){
      echo "<a href=" . get_pagenum_link(1) . "> First </a>";
    }
    // To the previous page
    previous_posts_link(' &laquo; ');
    // We need the sliding effect only if there are more pages than is the sliding range
    if($max_page > $range){
      // When closer to the beginning
      if($paged < $range){
        for($i = 1; $i <= ($range + 1); $i++){
          echo "<a href='" . get_pagenum_link($i) ."'";
          if($i==$paged) echo "class='current'";
          echo ">$i</a>";
        }
      }
      // When closer to the end
      elseif($paged >= ($max_page - ceil(($range/2)))){
        for($i = $max_page - $range; $i <= $max_page; $i++){
          echo "<a href='" . get_pagenum_link($i) ."'";
          if($i==$paged) echo "class='current'";
          echo ">$i</a>";
        }
      }
      // Somewhere in the middle
      elseif($paged >= $range && $paged < ($max_page - ceil(($range/2)))){
        for($i = ($paged - ceil($range/2)); $i <= ($paged + ceil(($range/2))); $i++){
          echo "<a href='" . get_pagenum_link($i) ."'";
          if($i==$paged) echo "class='current'";
          echo ">$i</a>";
        }
      }
    }
    // Less pages than the range, no sliding effect needed
    else{
      for($i = 1; $i <= $max_page; $i++){
        echo "<a href='" . get_pagenum_link($i) ."'";
        if($i==$paged) echo "class='current'";
        echo ">$i</a>";
      }
    }
    // Next page
    next_posts_link(' &raquo; ');
    // On the last page, don't put the Last page link
    if($paged != $max_page){
      echo " <a href=" . get_pagenum_link($max_page) . "> Last </a>";
    }
  }
}

///////////////////////////////////////////////////////
// Remove Blog from admin
function remove_menus () {
global $menu;
        $restricted = array(  __('Posts'), __('Comments'));
        end ($menu);
        while (prev($menu)){
            $value = explode(' ',$menu[key($menu)][0]);
            if(in_array($value[0] != NULL?$value[0]:"" , $restricted)){unset($menu[key($menu)]);}
        }
}
//add_action('admin_menu', 'remove_menus');

function my_remove_menu_elements(){
	//remove_submenu_page('themes.php', 'widgets.php' );
	//remove_submenu_page('themes.php', 'theme-editor.php' );
}
add_action('admin_init', 'my_remove_menu_elements', 102);

?>
