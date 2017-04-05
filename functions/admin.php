<?php
////////////////////////////////////////////////////////
/// Login Logo
function my_login_logo() { ?>
  <style type="text/css">
    #login h1 a {
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
// Admin menu customisation

function custom_menu_page_removing() {
	global $current_user, $submenu, $menu;
	if($current_user->ID === 1) return; // ignore if user ID 1*

  remove_menu_page( 'themes.php' );
  remove_menu_page( 'options-general.php' );
  remove_menu_page( 'customize.php' );
  remove_menu_page( 'theme-editor.php' );
  remove_menu_page( 'tools.php' );
  remove_menu_page( 'plugins.php' );
  remove_menu_page( 'edit.php?post_type=acf-field-group' );
  remove_menu_page( 'edit.php?post_type=page' );
  remove_menu_page( 'edit-comments.php' );
  remove_menu_page( 'index.php' );

	// Move Menus
	if(isset($submenu['themes.php'])) {
		foreach($submenu['themes.php'] as $key => $item) {
			if($item[2] === 'nav-menus.php') {
				unset($submenu['themes.php'][$key]);
			}
		}
	}
	add_menu_page( __('Menus'), __('Menus'), 'delete_others_pages', 'nav-menus.php', '', 'dashicons-list-view', 61 );

	// Add Pages to top of menu
	add_menu_page( __('Pages'), __('Pages'), 'delete_others_pages', 'edit.php?post_type=page', '', 'dashicons-admin-page', 4 );

}
add_action( 'admin_menu', 'custom_menu_page_removing' );

function remove_admin_bar_links() {
  global $wp_admin_bar, $current_user;
	if($current_user->ID === 1) return; // ignore if user ID 1

  // $wp_admin_bar->remove_menu('wp-logo');          // Remove the WordPress logo
  // $wp_admin_bar->remove_menu('about');            // Remove the about WordPress link
  // $wp_admin_bar->remove_menu('wporg');            // Remove the WordPress.org link
  // $wp_admin_bar->remove_menu('documentation');    // Remove the WordPress documentation link
  $wp_admin_bar->remove_menu('support-forums');   // Remove the support forums link
  // $wp_admin_bar->remove_menu('feedback');         // Remove the feedback link
  // $wp_admin_bar->remove_menu('site-name');        // Remove the site name menu
  // $wp_admin_bar->remove_menu('view-site');        // Remove the view site link
  $wp_admin_bar->remove_menu('updates');          // Remove the updates link
  $wp_admin_bar->remove_menu('comments');         // Remove the comments link
  $wp_admin_bar->remove_menu('new-content');      // Remove the content link
  $wp_admin_bar->remove_menu('my-account');       // Remove the user details tab
  $wp_admin_bar->remove_menu('itsec_admin_bar_menu');       // iThemes
}
add_action( 'wp_before_admin_bar_render', 'remove_admin_bar_links' );

///////////////////////////////////////////////////////
//Remove admin tool bar
function my_function_admin_bar(){
  return 0;
}
add_filter( 'show_admin_bar' , 'my_function_admin_bar');

///////////////////////////////////////////////////////
//Remove links from images in WYSIWYG
function wpb_imagelink_setup() {
	$image_set = get_option( 'image_default_link_type' );

	if ($image_set !== 'none') {
		update_option('image_default_link_type', 'none');
	}
}
add_action('admin_init', 'wpb_imagelink_setup', 10);

?>
