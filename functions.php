<?php

function turtleone_theme_support()
{
  add_theme_support('automatic-feed-links');

  global $content_width;
  if (!isset($content_width)) {
    $content_width = 980;
  }

  add_theme_support('post-thumbnails');

  set_post_thumbnail_size(800, 600);

  add_theme_support('title-tag');

  add_theme_support('html5', array(
    'search-form',
    'comment-form',
    'comment-list',
    'gallery',
    'caption',
    'script',
    'style'
  ));

  /*
   * Make theme available for translation.
   * Translations can be filed in the /languages/ directory.
   * If you're building a theme based on Twenty Twenty, use a find and replace
   * to change 'turtleone' to the name of your theme in all the template files.
   */
  load_theme_textdomain('turtleone');

  // Add support for full and wide align images.
  add_theme_support('align-wide');
}

add_action('after_setup_theme', 'turtleone_theme_support');

function turtleone_register_styles()
{
  $theme_version = wp_get_theme()->get('Version');

  wp_enqueue_style(
    'turtleone-style',
    get_template_directory_uri() . '/assets/css/style.css',
    array(),
    $theme_version
  );
}

add_action('wp_enqueue_scripts', 'turtleone_register_styles');

function turtleone_register_scripts()
{
  $theme_version = wp_get_theme()->get('Version');

  if (
    !is_admin() &&
    is_singular() &&
    comments_open() &&
    get_option('thread_comments')
  ) {
    wp_enqueue_script('comment-reply');
  }

  wp_enqueue_script(
    'turtleone-js',
    get_template_directory_uri() . '/assets/js/navigation.js',
    array(),
    $theme_version,
    true
  );
  wp_script_add_data('turtleone-js', 'async', true);
}

add_action('wp_enqueue_scripts', 'turtleone_register_scripts');

function turtleone_menus()
{
  $locations = array(
    'primary' => __('Menu principal', 'turtleone')
  );

  register_nav_menus($locations);
}

add_action('init', 'turtleone_menus');

function wpc_dashicons() { 
	wp_enqueue_style('dashicons');
}
add_action('wp_enqueue_scripts', 'wpc_dashicons');

/**
 * Add a Sub Nav Toggle to the Expanded Menu and Mobile Menu.
 *
 * @param stdClass $args An array of arguments.
 * @param string   $item Menu item.
 * @param int      $depth Depth of the current menu item.
 *
 * @return stdClass $args An object of wp_nav_menu() arguments.
 */
function turtleone_add_sub_toggles_to_main_menu( $args, $item, $depth ) {

	// Add sub menu toggles to the Expanded Menu with toggles.
	/*if ( isset( $args->show_toggles ) && $args->show_toggles ) {

		//Wrap the menu item link contents in a div, used for positioning.*/
		//$args->before = '<div class="ancestor-wrapper">';
		//$args->after  = '';

		// Add a toggle to items with children.
		/*if ( in_array( 'menu-item-has-children', $item->classes, true ) ) {

			$toggle_target_string = '.menu-modal .menu-item-' . $item->ID . ' > .sub-menu';
			$toggle_duration      = turtleone_toggle_duration();

			// Add the sub menu toggle.
			$args->after .= '<button class="toggle sub-menu-toggle fill-children-current-color" data-toggle-target="' . $toggle_target_string . '" data-toggle-type="slidetoggle" data-toggle-duration="' . absint( $toggle_duration ) . '" aria-expanded="false"><span class="screen-reader-text">' . __( 'Show sub menu', 'turtleone' ) . '</span>' . turtleone_get_theme_svg( 'chevron-down' ) . '</button>';

		}*/

		// Close the wrapper.
		//$args->after .= '</div><!-- .ancestor-wrapper -->';

		// Add sub menu icons to the primary menu without toggles.
  //} elseif ( 'primary' === $args->theme_location ) {*/
    
		if ( in_array( 'menu-item-has-children', $item->classes, true ) ) {
      $args->before = '<div class="ancestor-wrapper">';
			$args->after = '<div class="sub-menu-toggle"><span class="dashicons dashicons-arrow-down-alt2"></span></div></div>';
		} else {
      $args->before = '';
			$args->after = '';
		}
	//}

	return $args;
}

add_filter( 'nav_menu_item_args', 'turtleone_add_sub_toggles_to_main_menu', 10, 3 );

function add_search_form($items, $args)
{
  if ($args->theme_location == 'primary') {
    $items .=
      '<li id="menu-item-search" class="menu-item-search">
        <form role="search" method="get" class="search-form" action="/">
          <input type="search" class="search-text" value="' .
          get_search_query() .
      '" name="s" placeholder="Recherche" autocomplete="off" /><button type="submit"><span class="dashicons dashicons-search"></span></button>
        </form>
      </li>';
  }
  return $items;
}

add_filter('wp_nav_menu_items', 'add_search_form', 10, 2);

/**
 * Disable the emoji's
 */
function disable_emojis() {
  remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
  remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
  remove_action( 'wp_print_styles', 'print_emoji_styles' );
  remove_action( 'admin_print_styles', 'print_emoji_styles' ); 
  remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
  remove_filter( 'comment_text_rss', 'wp_staticize_emoji' ); 
  remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
  add_filter( 'tiny_mce_plugins', 'disable_emojis_tinymce' );
  add_filter( 'wp_resource_hints', 'disable_emojis_remove_dns_prefetch', 10, 2 );
 }
 add_action( 'init', 'disable_emojis' );

 /**
 * Filter function used to remove the tinymce emoji plugin.
 * 
 * @param array $plugins 
 * @return array Difference betwen the two arrays
 */
function disable_emojis_tinymce( $plugins ) {
  if ( is_array( $plugins ) ) {
  return array_diff( $plugins, array( 'wpemoji' ) );
  } else {
  return array();
  }
 }
 
 /**
  * Remove emoji CDN hostname from DNS prefetching hints.
  *
  * @param array $urls URLs to print for resource hints.
  * @param string $relation_type The relation type the URLs are printed for.
  * @return array Difference betwen the two arrays.
  */
 function disable_emojis_remove_dns_prefetch( $urls, $relation_type ) {
  if ( 'dns-prefetch' == $relation_type ) {
  /** This filter is documented in wp-includes/formatting.php */
  $emoji_svg_url = apply_filters( 'emoji_svg_url', 'https://s.w.org/images/core/emoji/2/svg/' );
 
 $urls = array_diff( $urls, array( $emoji_svg_url ) );
  }
 
 return $urls;
 }
