<?php
/*
 *  Author: Todd Motto | @toddmotto
 *  URL: html5blank.com | @html5blank
 *  Custom functions, support, custom post types and more.
 */

/*------------------------------------*\
	External Modules/Files
\*------------------------------------*/

// Load any external files you have here

/*------------------------------------*\
	Theme Support
\*------------------------------------*/

if (!isset($content_width))
{
    $content_width = 900;
}

if (function_exists('add_theme_support'))
{
    // Add Menu Support
    add_theme_support('menus');

    // Add Thumbnail Theme Support
    add_theme_support('post-thumbnails');
    add_image_size('large', 700, '', true); // Large Thumbnail
    add_image_size('medium', 250, '', true); // Medium Thumbnail
    add_image_size('small', 120, '', true); // Small Thumbnail
    add_image_size('custom-size', 700, 200, true); // Custom Thumbnail Size call using the_post_thumbnail('custom-size');
    add_image_size('post_banner', 960, 350, true ); // banners on posts (unlimited height)
    add_image_size('menu_thmb', 77, 77, true); // thumbnail used on menu page
    add_image_size('menu_slide', 940, 351, true); // slides used on menu page

    // Enables post and comment RSS feed links to head
    add_theme_support('automatic-feed-links');

    // Localisation Support
    load_theme_textdomain('html5blank', get_template_directory() . '/languages');
}

/*------------------------------------*\
	Functions
\*------------------------------------*/

// Navigation
function add_navigation( $loc ) {
	if ( $loc == "header" ) :
	    // primary navigation menu
	    wp_nav_menu(
		    array(
			    'theme_location'  => 'header-menu',
			    'container'       => 'div',
			    'container_class' => 'menu-{menu slug}-container',
			    'menu_class'      => 'menu-primary',
			    'echo'	    => true,
			    'fallback_cb'     => 'wp_page_menu',
			    'items_wrap'      => '<ul class="menu-primary">%3$s</ul>'
		    )
	    );
	    // header utility menu
	    wp_nav_menu(
		    array(
			    'theme_location'  => 'utility-header',
			    'container'       => 'div',
			    'container_class' => 'menu-{menu slug}-container',
			    'menu_class'      => 'menu-utility',
			    'echo'	    => true,
			    'fallback_cb'     => 'wp_page_menu',
			    'items_wrap'      => '<ul class="menu-utility">%3$s</ul>'
		    )
	    );
	elseif ( $loc == "footer" ) :
	    // footer utility menu
	    wp_nav_menu(
	    array(
		    'theme_location'  => 'utility-footer',
		    'container'       => 'div',
		    'container_class' => 'menu-{menu slug}-container',
		    'menu_class'      => 'menu-utility-footer',
		    'echo'	    => true,
		    'fallback_cb'     => 'wp_page_menu',
		    'items_wrap'      => '<ul class="menu-utility-footer">%3$s</ul>'
		    )
	    );
	elseif ( $loc == "home" ) :
	    // home buttons menu
	    wp_nav_menu(
	    array(
		    'theme_location'  => 'home-buttons',
		    'container'       => 'div',
		    'container_class' => 'menu-{menu slug}-container',
		    'menu_class'      => 'menu-home-buttons',
		    'echo'	    => true,
		    'fallback_cb'     => 'wp_page_menu',
		    'items_wrap'      => '<ul class="menu-home-buttons">%3$s</ul>'
		    )
	    );
	else :
	    return false;
	endif;
}

// Load scripts (header.php)
function eggnjoe_scripts() {
   if ($GLOBALS['pagenow'] != 'wp-login.php' && !is_admin()) {

      wp_register_script('conditionizr', get_template_directory_uri() . '/js/lib/conditionizr-4.3.0.min.js', array(), '4.3.0'); // Conditionizr
      wp_enqueue_script('conditionizr');
      
      wp_register_script('modernizr', get_template_directory_uri() . '/js/lib/modernizr-2.7.1.min.js', array(), '2.7.1'); // Modernizr
      wp_enqueue_script('modernizr');
      
      wp_register_script('doubletaptogo', get_template_directory_uri() . '/js/doubletaptogo.min.js', array('jquery'), '1.0.0'); // allow double-tap for nav drop-downs on touchscreens
      wp_enqueue_script('doubletaptogo');
      
      // general site scripts
      wp_register_script('eggnjoe-scripts', get_template_directory_uri() . '/js/scripts.js', array('jquery'), '1.0.0'); // Custom scripts
      wp_enqueue_script('eggnjoe-scripts');
      
      // home slideshow (slidesjs)
      wp_enqueue_script( 'jquery-slidesjs', get_template_directory_uri() . '/js/jquery.slides.min.js', array(), '1.0.0', true );
      wp_enqueue_script( 'slides-scripts', get_template_directory_uri() . '/js/slides.js', array(), '1.0.0', true );
      
      // menu (masonry plugin & menu scripts)
      //if( is_page_template( "page-menu.php" ) ) {
	 wp_enqueue_script( 'jquery-masonry', get_template_directory_uri() . '/js/jquery.masonry.min.js', array(), '3.3.0', true );
	 wp_enqueue_script( 'menu-scripts', get_template_directory_uri() . '/js/eggnjoe-menu.js', array(), '1.0.0', true );
      //}

	 wp_enqueue_script( 'jquery-careers', get_template_directory_uri() . '/js/employment-app.js', array('jquery'), '1.0', true );

    }
}

// Load stylesheets
function eggnjoe_styles() {
    // Normalize
    wp_register_style('normalize', get_template_directory_uri() . '/normalize.css', array(), '1.0', 'all');
    wp_enqueue_style('normalize');
    
    // Font Awesome
    wp_register_style('fontawesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css', array(), '4.3.0', 'all');
    wp_enqueue_style('fontawesome');

    // Theme styles
    wp_register_style('eggnjoe-styles', get_template_directory_uri() . '/style.css', array(), '1.0.1', 'all');
    wp_enqueue_style('eggnjoe-styles');

    

    //maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css
}

// Register Menus
function register_menus()
{
    register_nav_menus(array( // Using array to specify more menus if needed
	'header-menu' => __('Header Menu', 'html5blank'), // Main Navigation
	'sidebar-menu' => __('Sidebar Menu', 'html5blank'), // Sidebar Navigation
	'utility-header' => __('Utility - Header', 'html5blank'), // Utilty Menu in header
	'utility-footer' => __('Utility - Footer', 'html5blank'), // Utilty Menu in footer
	'home-buttons' => __('Home Buttons', 'html5blank') // Button Menu on home page
    ));
}

// Remove the <div> surrounding the dynamic navigation to cleanup markup
function my_wp_nav_menu_args($args = '')
{
    $args['container'] = false;
    return $args;
}

// Remove Injected classes, ID's and Page ID's from Navigation <li> items
function my_css_attributes_filter($var)
{
    return is_array($var) ? array() : '';
}

// Remove invalid rel attribute values in the categorylist
function remove_category_rel_from_category_list($thelist)
{
    return str_replace('rel="category tag"', 'rel="tag"', $thelist);
}

// Add page slug to body class, love this - Credit: Starkers Wordpress Theme
function add_slug_to_body_class($classes)
{
    global $post;
    if (is_home()) {
	$key = array_search('blog', $classes);
	if ($key > -1) {
	    unset($classes[$key]);
	}
    } elseif (is_page()) {
	$classes[] = sanitize_html_class($post->post_name);
    } elseif (is_singular()) {
	$classes[] = sanitize_html_class($post->post_name);
    }

    return $classes;
}

// If Dynamic Sidebar Exists
if (function_exists('register_sidebar'))
{
    // Define Main Sidebar Widget Area
    register_sidebar(array(
	'name' => __('Main Sidebar', 'html5blank'),
	'description' => __('', 'html5blank'),
	'id' => 'widget-main-sidebar',
	'before_widget' => '<div id="%1$s" class="%2$s">',
	'after_widget' => '</div>',
	'before_title' => '<h3 class="sidebar-widgit-header">',
	'after_title' => '</h3>'
    ));
    
    // Define Contact Sidebar Widget Area
    register_sidebar(array(
	'name' => __('Contact Sidebar', 'html5blank'),
	'description' => __('', 'html5blank'),
	'id' => 'widget-contact-sidebar',
	'before_widget' => '<div id="%1$s" class="%2$s">',
	'after_widget' => '</div>',
	'before_title' => '<h3 class="sidebar-widgit-header">',
	'after_title' => '</h3>'
    ));
}

// Remove 'text/css' from our enqueued stylesheet
function html5_style_remove($tag)
{
    return preg_replace('~\s+type=["\'][^"\']++["\']~', '', $tag);
}

// Remove thumbnail width and height dimensions that prevent fluid images in the_thumbnail
function remove_thumbnail_dimensions( $html )
{
    $html = preg_replace('/(width|height)=\"\d*\"\s/', "", $html);
    return $html;
}

/*------------------------------------*\
	Actions + Filters + ShortCodes
\*------------------------------------*/

// Add Actions
add_action('init', 'eggnjoe_scripts'); // Add Custom Scripts to wp_head
//add_action('wp_print_scripts', 'html5blank_conditional_scripts'); // Add Conditional Page Scripts
add_action('wp_enqueue_scripts', 'eggnjoe_styles'); // Add Theme Stylesheet
add_action('init', 'register_menus'); // Add Menus
add_action('init', 'create_post_types'); // Add Custom Post Type
add_action('init', 'create_taxonomies'); // Add Custom Taxonomies

// Remove Actions
remove_action('wp_head', 'feed_links_extra', 3); // Display the links to the extra feeds such as category feeds
remove_action('wp_head', 'feed_links', 2); // Display the links to the general feeds: Post and Comment Feed
remove_action('wp_head', 'rsd_link'); // Display the link to the Really Simple Discovery service endpoint, EditURI link
remove_action('wp_head', 'wlwmanifest_link'); // Display the link to the Windows Live Writer manifest file.
remove_action('wp_head', 'index_rel_link'); // Index link
remove_action('wp_head', 'parent_post_rel_link', 10, 0); // Prev link
remove_action('wp_head', 'start_post_rel_link', 10, 0); // Start link
remove_action('wp_head', 'adjacent_posts_rel_link', 10, 0); // Display relational links for the posts adjacent to the current post.
remove_action('wp_head', 'wp_generator'); // Display the XHTML generator that is generated on the wp_head hook, WP version
remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);
remove_action('wp_head', 'rel_canonical');
remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0);

// Add Filters
add_filter('avatar_defaults', 'html5blankgravatar'); // Custom Gravatar in Settings > Discussion
add_filter('body_class', 'add_slug_to_body_class'); // Add slug to body class (Starkers build)
add_filter('widget_text', 'do_shortcode'); // Allow shortcodes in Dynamic Sidebar
add_filter('widget_text', 'shortcode_unautop'); // Remove <p> tags in Dynamic Sidebars (better!)
add_filter('wp_nav_menu_args', 'my_wp_nav_menu_args'); // Remove surrounding <div> from WP Navigation
// add_filter('nav_menu_css_class', 'my_css_attributes_filter', 100, 1); // Remove Navigation <li> injected classes (Commented out by default)
// add_filter('nav_menu_item_id', 'my_css_attributes_filter', 100, 1); // Remove Navigation <li> injected ID (Commented out by default)
// add_filter('page_css_class', 'my_css_attributes_filter', 100, 1); // Remove Navigation <li> Page ID's (Commented out by default)
add_filter('the_category', 'remove_category_rel_from_category_list'); // Remove invalid rel attribute
add_filter('the_excerpt', 'shortcode_unautop'); // Remove auto <p> tags in Excerpt (Manual Excerpts only)
add_filter('the_excerpt', 'do_shortcode'); // Allows Shortcodes to be executed in Excerpt (Manual Excerpts only)
add_filter('excerpt_more', 'html5_blank_view_article'); // Add 'View Article' button instead of [...] for Excerpts
//add_filter('show_admin_bar', 'remove_admin_bar'); // Remove Admin bar
add_filter('style_loader_tag', 'html5_style_remove'); // Remove 'text/css' from enqueued stylesheet
add_filter('post_thumbnail_html', 'remove_thumbnail_dimensions', 10); // Remove width and height dynamic attributes to thumbnails
add_filter('image_send_to_editor', 'remove_thumbnail_dimensions', 10); // Remove width and height dynamic attributes to post images

// Remove Filters
remove_filter('the_excerpt', 'wpautop'); // Remove <p> tags from Excerpt altogether

/*------------------------------------*\
	Custom Post Types
\*------------------------------------*/

function create_post_types() {

	// home sliders
	register_post_type( 'slide',
		array(
		'labels' => array(
			'name'			=> _x( 'Slides', 'slide' ),
			'singular_name'		=> _x( 'Slide', 'slide' ),
			'add_new'		=> _x( 'Add New Slide', 'slide' ),
			'add_new_item'		=> _x( 'Add New Slide', 'slide' ),
			'edit_item'		=> _x( 'Edit Slide', 'slide' ),
			'new_item'		=> _x( 'New Slide', 'slide' ),
			'view_item'		=> _x( 'View Slide', 'slide' ),
			'search_items'		=> _x( 'Search Slides', 'slide' ),
			'not_found'		=> _x( 'No slides found', 'slide' ),
			'not_found_in_trash'	=> _x( 'No slides found in Trash', 'slide' ),
			'parent_item_colon'	=> _x( 'Parent Slide:', 'slide' ),
			'menu_name'		=> _x( 'Slides', 'slide' ),
		),
		'hierarchical'		=> false,
		'supports'		=> array(
			'title',
			'editor',
			'thumbnail',
			'custom-fields'
		),
		'taxonomies'		=> array( 'Slide Order' ),
		'public'		=> true,
		'show_ui'		=> true,
		'menu_position'		=> 20,
		'menu_icon'		=> 'dashicons-images-alt',
		'show_in_nav_menus'	=> false,
		'publicly_queryable'	=> false,
		'exclude_from_search'	=> true,
		'has_archive'		=> false,
		'query_var'		=> true,
		'can_export'		=> true,
		'rewrite'		=> true,
		'capability_type'	=> 'post'
	));

	// menu items
	register_post_type( 'menu_item',
		array(
		'label'			=> 'menu_item',
		'description'		=> 'Menu Item Description',
		'labels'		=> array(
			'name'			=> _x( 'Menu Items', 'home_slider' ),
			'singular_name'		=> _x( 'Menu Item', 'home_slider' ),
			'menu_name'		=> _x( 'Menu Items', 'home_slider' ),
			'name_admin_bar'	=> _x( 'Menu Item', 'home_slider' ),
			'parent_item_colon'	=> _x( 'Parent Menu Item:', 'home_slider' ),
			'all_items'		=> _x( 'All Menu Items', 'home_slider' ),
			'add_new_item'		=> _x( 'Add Menu Item', 'home_slider' ),
			'add_new'		=> _x( 'Add Menu Item', 'home_slider' ),
			'new_item'		=> _x( 'New Menu Item', 'home_slider' ),
			'edit_item'		=> _x( 'Edit Menu Item', 'home_slider' ),
			'update_item'		=> _x( 'Update Menu Item', 'home_slider' ),
			'view_item'		=> _x( 'View Menu Item', 'home_slider' ),
			'search_items'		=> _x( 'Search Menu Item', 'home_slider' ),
			'not_found'		=> _x( 'Menu Item not found', 'home_slider' ),
			'not_found_in_trash'	=> _x( 'Not found in Trash', 'home_slider' )
		),
		'supports'		=> array( 'title', 'editor', 'thumbnail' ),
		'taxonomies'		=> array( 'menu_category', ' menu_item_order' ),
		'public'		=> true,
		'show_ui'		=> true,
		'show_in_menu'		=> true,
		'menu_position'		=> 20,
		'menu_icon'		=> 'dashicons-carrot',
		'show_in_admin_bar'	=> true,
		'show_in_nav_menus'	=> false,
		'can_export'		=> true,
		'has_archive'		=> false,
		'exclude_from_search'	=> true,
		'publicly_queryable'	=> true,
		'capability_type'	=> 'page',
	));
}

/*------------------------------------*\
	Custom Taxonomies
\*------------------------------------*/

function create_taxonomies() {

	// slide categories
	register_taxonomy( 'slide_category', array( 'slide' ),
		array(
		'labels'		=> array(
			'name'				=> _x( 'Slide Categories', 'Taxonomy General Name', 'text_domain' ),
			'singular_name'			=> _x( 'Slide Category', 'Taxonomy Singular Name', 'text_domain' ),
			'menu_name'			=> __( 'Slide Categories', 'text_domain' ),
			'all_items'			=> __( 'All Slide Items', 'text_domain' ),
			'parent_item'			=> __( 'Parent Slide Category', 'text_domain' ),
			'parent_item_colon'		=> __( 'Parent Slide Category:', 'text_domain' ),
			'new_item_name'			=> __( 'New Slide Category', 'text_domain' ),
			'add_new_item'			=> __( 'Add New Slide Category', 'text_domain' ),
			'edit_item'			=> __( 'Edit Slide Category', 'text_domain' ),
			'update_item'			=> __( 'Update Slide Category', 'text_domain' ),
			'view_item'			=> __( 'View Slide Category', 'text_domain' ),
			'separate_items_with_commas'	=> __( 'Separate items with commas', 'text_domain' ),
			'add_or_remove_items'		=> __( 'Add or remove items', 'text_domain' ),
			'choose_from_most_used'		=> __( 'Choose from the most used', 'text_domain' ),
			'popular_items'			=> __( 'Popular Items', 'text_domain' ),
			'search_items'			=> __( 'Search Items', 'text_domain' ),
			'not_found'			=> __( 'Not Found', 'text_domain' )
		),
		'hierarchical'		=> true,
		'public'		=> true,
		'show_ui'		=> true,
		'show_admin_column'	=> true,
		'show_in_nav_menus'	=> true,
		'show_tagcloud'		=> true,
	));

	// menu categories
	register_taxonomy( 'menu_category', array( 'menu_item' ),
		array(
		'labels'		=> array(
			'name'				=> _x( 'Menu Categories', 'Taxonomy General Name', 'text_domain' ),
			'singular_name'			=> _x( 'Menu Category', 'Taxonomy Singular Name', 'text_domain' ),
			'menu_name'			=> __( 'Menu Categories', 'text_domain' ),
			'all_items'			=> __( 'All Menu Items', 'text_domain' ),
			'parent_item'			=> __( 'Parent Menu Category', 'text_domain' ),
			'parent_item_colon'		=> __( 'Parent Menu Category:', 'text_domain' ),
			'new_item_name'			=> __( 'New Menu Category', 'text_domain' ),
			'add_new_item'			=> __( 'Add New Menu Category', 'text_domain' ),
			'edit_item'			=> __( 'Edit Menu Category', 'text_domain' ),
			'update_item'			=> __( 'Update Menu Category', 'text_domain' ),
			'view_item'			=> __( 'View Menu Category', 'text_domain' ),
			'separate_items_with_commas'	=> __( 'Separate items with commas', 'text_domain' ),
			'add_or_remove_items'		=> __( 'Add or remove items', 'text_domain' ),
			'choose_from_most_used'		=> __( 'Choose from the most used', 'text_domain' ),
			'popular_items'			=> __( 'Popular Items', 'text_domain' ),
			'search_items'			=> __( 'Search Items', 'text_domain' ),
			'not_found'			=> __( 'Not Found', 'text_domain' )
		),
		'hierarchical'		=> true,
		'public'		=> true,
		'show_ui'		=> true,
		'show_admin_column'	=> true,
		'show_in_nav_menus'	=> true,
		'show_tagcloud'		=> true,
	));

}

// Taxonomy Meta Fields

// include class to add meta fields to taxonomies
require_once( 'inc/Tax-meta-class/Tax-meta-class.php' );

// Menu Categories meta fields
$menu_cat_meta_config = array(
      'id'		=> 'meta_box_menu_category',
      'title'		=> 'Menu Category Meta Box',
      'pages'		=> array( 'menu_category' ),
      'context'		=> 'normal',
      'fields'		=> array(),
      'local_images'	=> true,
      'use_with_theme'	=> true
      
);

$menu_cat_meta = new Tax_Meta_Class( $menu_cat_meta_config );

$menu_cat_prefix = "menu_cat_meta_";

$menu_cat_meta->addImage( $menu_cat_prefix . "image", array( "name" => __( "Menu Category Photo ", "tax-meta" ) ) );
$menu_cat_meta->addText( $menu_cat_prefix . "sort", array( "name" => __( "Menu Sort Order ", "tax-meta" ), "desc" => "Order to be displayed on Menu page (ascending)", "std" => 0 ) );

/*------------------------------------*\
	Employement Application
\*------------------------------------*/

// Custom Date Field Validation (exclude forcing yyyy-mm-dd format)

// replace CF7 default validation
remove_filter( 'wpcf7_validate_date', 'wpcf7_date_validation_filter', 10 );
remove_filter( 'wpcf7_validate_date*', 'wpcf7_date_validation_filter', 10 );

add_filter( 'wpcf7_validate_date', 'eggnjoe_wpcf7_date_validation_filter', 10, 2 );
add_filter( 'wpcf7_validate_date*', 'eggnjoe_wpcf7_date_validation_filter', 10, 2 );

// custom date validation (CF7 plugin -> modules -> date.php -> ln 79)
function eggnjoe_wpcf7_date_validation_filter( $result, $tag ) {
	$tag = new WPCF7_Shortcode( $tag );

	$name = $tag->name;

	$min = $tag->get_date_option( 'min' );
	$max = $tag->get_date_option( 'max' );

	$value = isset( $_POST[$name] )
		? trim( strtr( (string) $_POST[$name], "\n", " " ) )
		: '';

	if ( $tag->is_required() && '' == $value ) {
		$result->invalidate( $tag, wpcf7_get_message( 'invalid_required' ) );
	} elseif ( '' != $value && ! empty( $min ) && $value < $min ) {
		$result->invalidate( $tag, wpcf7_get_message( 'date_too_early' ) );
	} elseif ( '' != $value && ! empty( $max ) && $max < $value ) {
		$result->invalidate( $tag, wpcf7_get_message( 'date_too_late' ) );
	}

	return $result;
}


function wpcf7_add_references( $WPCF7_ContactForm ) {

	// get field values for each reference
	$submission = WPCF7_Submission::get_instance();
	
	$id = $WPCF7_ContactForm->id();
		$mail = $WPCF7_ContactForm->prop( 'mail' );
	
	if( $submission && $id == '252' ) :

		$data = $submission->get_posted_data();

		// loop through references until empty
		$i = 1;
		
		while( $i > 0 ) :

			if( !empty( $data[ 'neverEmployed' ][0] ) ) :

				$mail[ 'body' ] .= '<table class="app-2col col-container" width="100%" cellpadding="0" cellspacing="0" border="0">
				<tr>
					<td class="col-subsection" width="100%" align="center" colspan="2" valign="top" style="padding-top: 8px;padding-right: 15px;padding-left: 15px;">
						 <table width="100%" cellpadding="0" cellspacing="0" border="0">
							<tr>
								<td>
									<p class="value" style="margin-top: 0px;margin-right: 0px;margin-left: 0px;margin-bottom: 9px;padding-top: 10px;font-size: 14px;line-height: 1.28571429em;color: #777775 !important;">I have not worked in the past</p>
								</td>
							</tr>
						 </table>
					</td>
				</tr>';

				$i = 0; // end search if never worked in the past

				break;

			elseif( !empty( $data[ 'refEnabled' . $i ] ) ) :

				// contacting reference permission needs to be array for first, string for others
				$refPermission = ( $i > 1 ) ? $data[ "refPermission" . $i ] : $data[ "refPermission" . $i ][0];
			
				$mail[ 'body' ] .= '<table class="app-2col col-container" width="100%" cellpadding="0" cellspacing="0" border="0">
				<tr>
					<td class="col-subsection" width="100%" align="center" colspan="2" valign="top" style="padding-top: 8px;padding-right: 15px;padding-left: 15px;">
						 <table width="100%" cellpadding="0" cellspacing="0" border="0">
							<tr>
								<td>
									<span class="subsection-headline" style="font-size: 1.25em;font-weight: bold;">Reference # ' . $i . ' Info:</span>
								</td>
							</tr>
						 </table>
					</td>
				</tr>
				<tr>
					<td class="col-2col col-alpha col-content" width="50%" align="center" valign="top" style="padding-top: 15px;padding-right: 15px;padding-bottom: 15px;padding-left: 15px;">
						 <table width="100%" cellpadding="0" cellspacing="0" border="0">
							<tr>
								<td>
									<span class="label" style="font-weight: bold;">Company:</span>
									<p class="value" style="margin-top: 0px;margin-right: 0px;margin-left: 0px;margin-bottom: 9px;padding-top: 10px;font-size: 14px;line-height: 1.28571429em;color: #777775 !important;">' . $data[ "refCompany" . $i ] . '</p>
								</td>
							</tr>
						 </table>
					</td>
					<td class="col-2col col-alpha col-content" width="50%" align="center" valign="top" style="padding-top: 15px;padding-right: 15px;padding-bottom: 15px;padding-left: 15px;">
						 <table width="100%" cellpadding="0" cellspacing="0" border="0">
							<tr>
								<td>
									<span class="label" style="font-weight: bold;">Telephone:</span>
									<p class="value" style="margin-top: 0px;margin-right: 0px;margin-left: 0px;margin-bottom: 9px;padding-top: 10px;font-size: 14px;line-height: 1.28571429em;color: #777775 !important;">' . $data[ "refPhone" . $i ] . '</p>
								</td>
							</tr>
						 </table>
					</td>
				</tr>
			</table>';
			$mail[ 'body' ] .= '<table class="col-container" width="100%" cellpadding="0" cellspacing="0" border="0">
				<tr>
					<td class="col-content" width="100%" align="center" valign="top" style="padding-top: 15px;padding-right: 15px;padding-bottom: 15px;padding-left: 15px;">
						 <table width="100%" cellpadding="0" cellspacing="0" border="0">
							<tr>
								<td>
									<span class="label" style="font-weight: bold;">Address</span>
									<p class="value" style="margin-top: 0px;margin-right: 0px;margin-left: 0px;margin-bottom: 9px;padding-top: 10px;font-size: 14px;line-height: 1.28571429em;color: #777775 !important;">' . $data[ "refAddr" . $i ] . '</p>
								</td>
							</tr>
						 </table>
					</td>
				</tr>
			</table>';
			$mail[ 'body' ] .= '<table class="app-3col col-container" width="100%" cellpadding="0" cellspacing="0" border="0">
				<tr>
					<td class="col-3col col-alpha col-content" width="33%" align="center" valign="top" style="padding-top: 15px;padding-right: 15px;padding-bottom: 15px;padding-left: 15px;">
						 <table width="100%" cellpadding="0" cellspacing="0" border="0">
							<tr>
								<td class="col-3col-content">
									<span class="label" style="font-weight: bold;">City:</span>
									<p class="value" style="margin-top: 0px;margin-right: 0px;margin-left: 0px;margin-bottom: 9px;padding-top: 10px;font-size: 14px;line-height: 1.28571429em;color: #777775 !important;">' . $data[ "refCity" . $i ] . '</p>
								</td>
							</tr>
						 </table>
					</td>
					<td class="col-3col col-alpha col-content" width="33%" align="center" valign="top" style="padding-top: 15px;padding-right: 15px;padding-bottom: 15px;padding-left: 15px;">
						 <table width="100%" cellpadding="0" cellspacing="0" border="0">
							<tr>
								<td class="col-3col-content">
									<span class="label" style="font-weight: bold;">State:</span>
									<p class="value" style="margin-top: 0px;margin-right: 0px;margin-left: 0px;margin-bottom: 9px;padding-top: 10px;font-size: 14px;line-height: 1.28571429em;color: #777775 !important;">' . $data[ "refState" . $i ] . '</p>
								</td>
							</tr>
						 </table>
					</td>
					<td class="col-2col col-omega col-content" width="33%" align="center" valign="top" style="padding-top: 15px;padding-right: 15px;padding-bottom: 15px;padding-left: 15px;">
						 <table width="100%" cellpadding="0" cellspacing="0" border="0">
							<tr>
								<td class="col-3col-content">
									<span class="label" style="font-weight: bold;">Zip Code:</span>
									<p class="value" style="margin-top: 0px;margin-right: 0px;margin-left: 0px;margin-bottom: 9px;padding-top: 10px;font-size: 14px;line-height: 1.28571429em;color: #777775 !important;">' . $data[ "refZip" . $i ] . '</p>
								</td>
							</tr>
						 </table>
					</td>
				</tr>
			</table>';
			$mail[ 'body' ] .= '<table class="app-2col col-container" width="100%" cellpadding="0" cellspacing="0" border="0">
				<tr>
					<td class="col-2col col-alpha col-content" width="50%" align="center" valign="top" style="padding-top: 15px;padding-right: 15px;padding-bottom: 15px;padding-left: 15px;">
						 <table width="100%" cellpadding="0" cellspacing="0" border="0">
							<tr>
								<td>
									<span class="label" style="font-weight: bold;">Start Date:</span>
									<p class="value" style="margin-top: 0px;margin-right: 0px;margin-left: 0px;margin-bottom: 9px;padding-top: 10px;font-size: 14px;line-height: 1.28571429em;color: #777775 !important;">' . $data[ "refDateStart" . $i ] . '</p>
								</td>
							</tr>
						 </table>
					</td>
					<td class="col-2col col-alpha col-content" width="50%" align="center" valign="top" style="padding-top: 15px;padding-right: 15px;padding-bottom: 15px;padding-left: 15px;">
						 <table width="100%" cellpadding="0" cellspacing="0" border="0">
							<tr>
								<td>
									<span class="label" style="font-weight: bold;">End Date:</span>
									<p class="value" style="margin-top: 0px;margin-right: 0px;margin-left: 0px;margin-bottom: 9px;padding-top: 10px;font-size: 14px;line-height: 1.28571429em;color: #777775 !important;">' . $data[ "refDateEnd" . $i ] . '</p>
								</td>
							</tr>
						 </table>
					</td>
				</tr>
			</table>';
			$mail[ 'body' ] .= '<table class="app-2col col-container" width="100%" cellpadding="0" cellspacing="0" border="0">
				<tr>
					<td class="col-2col col-alpha col-content" width="50%" align="center" valign="top" style="padding-top: 15px;padding-right: 15px;padding-bottom: 15px;padding-left: 15px;">
						 <table width="100%" cellpadding="0" cellspacing="0" border="0">
							<tr>
								<td>
									<span class="label" style="font-weight: bold;">Starting Wage:</span>
									<p class="value" style="margin-top: 0px;margin-right: 0px;margin-left: 0px;margin-bottom: 9px;padding-top: 10px;font-size: 14px;line-height: 1.28571429em;color: #777775 !important;">' . $data[ "refWageStart" . $i ] . '</p>
								</td>
							</tr>
						 </table>
					</td>
					<td class="col-2col col-alpha col-content" width="50%" align="center" valign="top" style="padding-top: 15px;padding-right: 15px;padding-bottom: 15px;padding-left: 15px;">
						 <table width="100%" cellpadding="0" cellspacing="0" border="0">
							<tr>
								<td>
									<span class="label" style="font-weight: bold;">Ending Wage:</span>
									<p class="value" style="margin-top: 0px;margin-right: 0px;margin-left: 0px;margin-bottom: 9px;padding-top: 10px;font-size: 14px;line-height: 1.28571429em;color: #777775 !important;">' . $data[ "refWageEnd" . $i ] . '</p>
								</td>
							</tr>
						 </table>
					</td>
				</tr>
			</table>';
			$mail[ 'body' ] .= '<table class="col-container" width="100%" cellpadding="0" cellspacing="0" border="0">
				<tr>
					<td class="col-content" width="100%" align="center" valign="top" style="padding-top: 15px;padding-right: 15px;padding-bottom: 15px;padding-left: 15px;">
						 <table width="100%" cellpadding="0" cellspacing="0" border="0">
							<tr>
								<td>
									<span class="label" style="font-weight: bold;">Title/Responsibilities</span>
									<p class="value" style="margin-top: 0px;margin-right: 0px;margin-left: 0px;margin-bottom: 9px;padding-top: 10px;font-size: 14px;line-height: 1.28571429em;color: #777775 !important;">' . $data[ "refTitle" . $i ] . '</p>
								</td>
							</tr>
						 </table>
					</td>
				</tr>
			</table>';
			$mail[ 'body' ] .= '<table class="col-container" width="100%" cellpadding="0" cellspacing="0" border="0">
				<tr>
					<td class="col-content" width="100%" align="center" valign="top" style="padding-top: 15px;padding-right: 15px;padding-bottom: 15px;padding-left: 15px;">
						 <table width="100%" cellpadding="0" cellspacing="0" border="0">
							<tr>
								<td>
									<span class="label" style="font-weight: bold;">Reason for leaving</span>
									<p class="value" style="margin-top: 0px;margin-right: 0px;margin-left: 0px;margin-bottom: 9px;padding-top: 10px;font-size: 14px;line-height: 1.28571429em;color: #777775 !important;">' . $data[ "refReason" . $i ] . '</p>
								</td>
							</tr>
						 </table>
					</td>
				</tr>
			</table>';
			$mail[ 'body' ] .= '<table class="app-2col col-container" width="100%" cellpadding="0" cellspacing="0" border="0">
				<tr>
					<td class="col-2col col-alpha col-content" width="50%" align="center" valign="top" style="padding-top: 15px;padding-right: 15px;padding-bottom: 15px;padding-left: 15px;">
						 <table width="100%" cellpadding="0" cellspacing="0" border="0">
							<tr>
								<td>
									<span class="label" style="font-weight: bold;">Direct Supervisor\'s Name:</span>
									<p class="value" style="margin-top: 0px;margin-right: 0px;margin-left: 0px;margin-bottom: 9px;padding-top: 10px;font-size: 14px;line-height: 1.28571429em;color: #777775 !important;">' . $data[ "refSupervisorName" . $i ] . '</p>
								</td>
							</tr>
						 </table>
					</td>
					<td class="col-2col col-alpha col-content" width="50%" align="center" valign="top" style="padding-top: 15px;padding-right: 15px;padding-bottom: 15px;padding-left: 15px;">
						 <table width="100%" cellpadding="0" cellspacing="0" border="0">
							<tr>
								<td>
									<span class="label" style="font-weight: bold;">Direct Supervisor\'s Title:</span>
									<p class="value" style="margin-top: 0px;margin-right: 0px;margin-left: 0px;margin-bottom: 9px;padding-top: 10px;font-size: 14px;line-height: 1.28571429em;color: #777775 !important;">' . $data[ "refSupervisorTitle" . $i ] . '</p>
								</td>
							</tr>
						 </table>
					</td>
				</tr>
			</table>';
			$mail[ 'body' ] .= '<table class="col-container" width="100%" cellpadding="0" cellspacing="0" border="0">
				<tr>
					<td class="col-content" width="100%" align="center" valign="top" style="padding-top: 15px;padding-right: 15px;padding-bottom: 15px;padding-left: 15px;">
						 <table width="100%" cellpadding="0" cellspacing="0" border="0">
							<tr>
								<td>
									<span class="label" style="font-weight: bold;">May we contact this reference?</span>
									<p class="value" style="margin-top: 0px;margin-right: 0px;margin-left: 0px;margin-bottom: 9px;padding-top: 10px;font-size: 14px;line-height: 1.28571429em;color: #777775 !important;">' . $refPermission . '</p>
								</td>
							</tr>
						 </table>
					</td>
				</tr>
			</table>';

			$i++;
			
			else:

				$i = 0; // end search if title is empty

				break;
			
			endif;

		endwhile;

	endif;

	$mail[ 'body' ] .= '</td></tr></table></div>'; // final closing tags to be used after all, if any, references

	$WPCF7_ContactForm->set_properties( array( 'mail' => $mail) );

}
add_action( "wpcf7_before_send_mail", "wpcf7_add_references" );

?>
