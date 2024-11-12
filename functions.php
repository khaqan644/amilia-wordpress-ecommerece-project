<?php
/**
 * Theme Framework functions and definitions
 *
 * Sets up the theme and provides some helper functions, which are used
 * in the theme as custom template tags. Others are attached to action and
 * filter hooks in WordPress to change core functionality.
 *
 * When using a child theme (see http://codex.wordpress.org/Theme_Development and
 * http://codex.wordpress.org/Child_Themes), you can override certain functions
 * (those wrapped in a function_exists() call) by defining them first in your child theme's
 * functions.php file. The child theme's functions.php file is included before the parent
 * theme's file, so the child theme functions would be used.
 *
 * Functions that are not pluggable (not wrapped in function_exists()) are instead attached
 * to a filter or action hook.
 *
 * For more information on hooks, actions, and filters, @link http://codex.wordpress.org/Plugin_API
 *
 * @package CMSSuperHeroes
 * @subpackage CMS Theme
 * @since 1.0.0
 */

/* Add base functions */
require( get_template_directory() . '/inc/base.class.php' );

if(class_exists("AmiliaBase")){
    $amilia_base = new AmiliaBase;
}

/* Add ReduxFramework. */


/* Add theme options. */
require( get_template_directory() . '/inc/options/functions.php' );

/**
 * Add Custom Params
 */
function amilia_after_vc_params() {
	require( get_template_directory() . '/vc_params/vc_rows.php' );
    require( get_template_directory() . '/vc_params/vc_separator.php' );
    require( get_template_directory() . '/vc_params/vc_custom_heading.php' );
    require( get_template_directory() . '/vc_params/vc_tta_accordion.php' );
    require( get_template_directory() . '/vc_params/vc_tta_tabs.php' );
    require( get_template_directory() . '/vc_params/vc_toggle.php' );
    require( get_template_directory() . '/vc_params/vc_btn.php' );
    require( get_template_directory() . '/vc_params/vc_message.php' );
    require( get_template_directory() . '/vc_params/vc_images_carousel.php' );
    require( get_template_directory() . '/vc_params/vc_single_image.php' );
    require( get_template_directory() . '/vc_params/vc_video.php' );
    require( get_template_directory() . '/vc_params/vc_gallery.php' );
    require( get_template_directory() . '/vc_params/vc_pie.php' );
    require( get_template_directory() . '/vc_params/vc_column.php' );
    require( get_template_directory() . '/vc_params/vc_column_inner.php' );
    require( get_template_directory() . '/vc_params/cms_progressbar.php' );

    /*  Require font icon */
	require( get_template_directory() . '/inc/libs/font-icon/elegant.php' );
}
add_action('vc_after_init', 'amilia_after_vc_params');

/* Include CMS shortcode */

function amilia_shortcodes_list() {
	$amilia_shortcodes_list = array(
		'cms_carousel',
		'cms_grid',
		'cms_fancybox_single',
		'cms_counter_single',
		'cms_progressbar'
	);
	return $amilia_shortcodes_list;
}
/**
 * Add theme elements
 */
function amilia_vc_elements() {
	if(class_exists('CmsShortCode')){
		add_filter('cms-shorcode-list', 'amilia_shortcodes_list');
		//new elements
	    require( get_template_directory() . '/inc/elements/dropcaps/cms_dropcaps.php' );
        require( get_template_directory() . '/inc/elements/lightboxmap/cms_lightboxmap.php' );
        require( get_template_directory() . '/inc/elements/countdown/cms_countdown.php' );
        require( get_template_directory() . '/inc/elements/callout/callout.php' );
        require( get_template_directory() . '/inc/elements/steps/steps.php' );
        require( get_template_directory() . '/inc/elements/progress/progress.php' );
        require( get_template_directory() . '/inc/elements/newsletter/newsletter.php' );
        require( get_template_directory() . '/inc/elements/promo.php' );
        require( get_template_directory() . '/inc/elements/landing_item/cms_landing_item.php' );
    }

}
add_action('vc_before_init', 'amilia_vc_elements');



/* Add Quote Editer */
require( get_template_directory() . '/inc/tinymce/button.php' );

/* Add SCSS */

/* Woo commerce function */
if(class_exists('Woocommerce')){
    require get_template_directory() . '/woocommerce/wc-template-hooks.php';
    require get_template_directory() . '/woocommerce/wc-function-hooks.php';
}

/* Add Meta Core Options */
if(is_admin()){

    if(!class_exists('CsCoreControl')){
        /* add mete core */
        require( get_template_directory() . '/inc/metacore/core.options.php' );
        /* add meta options */

    }

    /* tmp plugins. */
    require( get_template_directory() . '/inc/options/require.plugins.php' );

    /* add presets */
    require( get_template_directory() . '/inc/options/presets.php' );
}

/* Add Template functions */
require( get_template_directory() . '/inc/template.functions.php' );

/* Static css. */
require( get_template_directory() . '/inc/dynamic/static.css.php' );

/* Dynamic css*/
require( get_template_directory() . '/inc/dynamic/dynamic.css.php' );

/* Add mega menu */
if(!class_exists('HeroMenuWalker') && (isset($smof_data['menu_mega']) && $smof_data['menu_mega'] == 1)) {
    require( get_template_directory() . '/inc/megamenu/mega-menu.php' );
}
//Trequire( get_template_directory() . '/inc/megamenu/mega-menu.php' );

/* Add widgets */
require( get_template_directory() . '/inc/widgets/cart_search.php' );
require( get_template_directory() . '/inc/widgets/news_tabs.php' );
require( get_template_directory() . '/inc/widgets/cms-recentposts.php' );
require( get_template_directory() . '/inc/widgets/cms-social.php' );
require( get_template_directory() . '/inc/widgets/flickrphotos.php' );
// Set up the content width value based on the theme's design and stylesheet.
if ( ! isset( $content_width ) )
	$content_width = 625;

/**
 * CMS Theme setup.
 *
 * Sets up theme defaults and registers the various WordPress features that
 * CMS Theme supports.
 *
 * @uses load_theme_textdomain() For translation/localization support.
 * @uses add_editor_style() To add a Visual Editor stylesheet.
 * @uses add_theme_support() To add support for post thumbnails, automatic feed links,
 * 	custom background, and post formats.
 * @uses register_nav_menu() To add support for navigation menus.
 * @uses set_post_thumbnail_size() To set a custom post thumbnail size.
 *
 * @since 1.0.0
 */
function amilia_setup() {
	/*
	 * Makes Twenty Twelve available for translation.
	 *
	 * Translations can be added to the /languages/ directory.
	 * If you're building a theme based on Twenty Twelve, use a find and replace
	 * to change 'wp-amilia' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'wp-amilia' , get_template_directory() . '/languages' );

	// Adds title tag
	add_theme_support( "title-tag" );

	// Add woocommerce
	add_theme_support("woocommerce");

	// Adds custom header
	add_theme_support( 'custom-header' );

	// Adds RSS feed links to <head> for posts and comments.
	add_theme_support( 'automatic-feed-links' );

	// This theme supports a variety of post formats.
	add_theme_support( 'post-formats', array( 'video', 'audio' , 'gallery', 'quote', 'link') );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menu( 'primary', esc_html__( 'Primary Menu', 'wp-amilia' ) );
	register_nav_menu( 'footer-menu', esc_html__( 'Footer Menu', 'wp-amilia' ) );

	/*
	 * This theme supports custom background color and image,
	 * and here we also set up the default background color.
	 */
	add_theme_support( 'custom-background', array(
		'default-color' => 'e6e6e6',
	) );

	// This theme uses a custom image size for featured images, displayed on "standard" posts.
	add_theme_support( 'post-thumbnails' );
	add_image_size('amilia-thumbnail-masonry', 500);
	add_image_size('amilia-blog-large', 870, 430, true);
	add_image_size('amilia-blog-full', 1200, 440, true);
	add_image_size('amilia-portfolio-wide', 570, 420, true);
	add_image_size('amilia-portfolio-square', 500, 500, true);
	add_image_size('amilia-team', 600, 350, true);
	set_post_thumbnail_size( 624, 9999 ); // Unlimited height, soft crop

	/*
	 * This theme styles the visual editor to resemble the theme style,
	 * specifically font, colors, icons, and column width.
	 */
	add_editor_style( array( 'assets/css/editor-style.css' ) );

}

add_action( 'after_setup_theme', 'amilia_setup' );
/**
 * Get meta data.
 * @author Fox
 * @return mixed|NULL
 */
function amilia_meta_data(){
    global $post, $amilia_meta;

    if(!isset($post->ID)) return ;

    $amilia_meta = json_decode(get_post_meta($post->ID, '_cms_meta_data', true));

    if(empty($amilia_meta)) return ;

    foreach ($amilia_meta as $key => $meta){
        $amilia_meta->$key = rawurldecode($meta);
    }
}
add_action('wp', 'amilia_meta_data');

/**
 * Get post meta data.
 * @author Fox
 * @return mixed|NULL
 */
function amilia_post_meta_data(){
    global $post;

    if(!isset($post->ID)) return null;

    $post_meta = json_decode(get_post_meta($post->ID, '_cms_meta_data', true));

    if(empty($post_meta)) return null;

    foreach ($post_meta as $key => $meta){
        $post_meta->$key = rawurldecode($meta);
    }

    return $post_meta;
}

/**
 * Enqueue scripts and styles for front-end.
 * @author Fox
 * @since CMS SuperHeroes 1.0
 */
function amilia_scripts_styles() {

	global $smof_data, $wp_styles, $amilia_meta;

	/** theme options. */
	$script_options = array(
	    'menu_sticky'=> $smof_data['menu_sticky'],
	    'paralax' => 1,
	    'back_to_top'=> $smof_data['footer_botton_back_to_top']
	);

	/*------------------------------------- JavaScript ---------------------------------------*/
	/* Adds JavaScript Bootstrap. */
	wp_enqueue_script( 'waypoints' );
	wp_enqueue_script('plugins.min', get_template_directory_uri() . '/assets/js/plugins.min.js', array( 'jquery' ), '1.0.0');
	
	if ( !wp_script_is('', 'owl-carousel')) {
		wp_enqueue_script('owl-carousel', get_template_directory_uri() . '/assets/js/owl.carousel.min.js', array(), '2.0.0', true);
	}
	/* Add One Page plugin. */
	if(is_page() && isset($amilia_meta->_cms_one_page) && $amilia_meta->_cms_one_page) {
	    wp_enqueue_script('jquery.singlePageNav', get_template_directory_uri() . '/assets/js/jquery.singlePageNav.js', array( 'jquery' ), '1.0.0', true);

	    if(!empty($amilia_meta->_cms_one_page_easing)){
	        wp_enqueue_script('jquery-effects-core');
	        $script_options['one_page_easing'] = !empty($amilia_meta->_cms_one_page_easing) ? $amilia_meta->_cms_one_page_easing : 'swing';
	    }

	    $script_options['one_page'] = true;
	    $script_options['one_page_speed'] = !empty($amilia_meta->_cms_one_page_speed) ? $amilia_meta->_cms_one_page_speed : 1000;
	}

	/* Add smoothscroll plugin */
	if($smof_data['smoothscroll']){
	   wp_enqueue_script('amilia-enque-smoothscroll', get_template_directory_uri() . '/assets/js/smoothscroll.min.js', array( 'jquery' ), '1.0.0', true);
	}

	/** --------------------------custom------------------------------- */
	/* Add menu.js */
    wp_enqueue_script('amilia-enque-menu', get_template_directory_uri() . '/assets/js/menu.js', array( 'jquery' ), '1.0.0', true);
	/* Add main.js */
	wp_register_script('amilia-enque-main', get_template_directory_uri() . '/assets/js/main.js', array( 'jquery' ), '1.0.0', true);
	wp_localize_script('amilia-enque-main', 'CMSOptions', $script_options);
	wp_enqueue_script('amilia-enque-main');

	/*
	 * Adds JavaScript to pages with the comment form to support
	 * sites with threaded comments (when in use).
	 */
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) )
		wp_enqueue_script( 'comment-reply' );

    /*------------------------------------- Stylesheet ---------------------------------------*/

	/** --------------------------libs--------------------------------- */

	/* Loads Bootstrap stylesheet. */
	wp_enqueue_style('bootstrap', get_template_directory_uri() . '/assets/css/bootstrap.min.css', array(), '3.3.2');

	/* Loads Bootstrap stylesheet. */
	wp_enqueue_style('amilia-enque-font-awesome', get_template_directory_uri() . '/assets/css/font-awesome.min.css', array(), '4.3.0');

	/* Loads ElegantIcons. */
	wp_enqueue_style('amilia-enque-elegantIcons', get_template_directory_uri() . '/assets/css/icons-fonts.css', array(), '1.0.1');
	wp_enqueue_style('amilia-enque-animate', get_template_directory_uri() . '/assets/css/animate.min.css', array(), '1.0.1');

	/** --------------------------custom------------------------------- */

	/* Loads our main stylesheet. */
	wp_enqueue_style( 'amilia-enque-style', get_stylesheet_uri(), array( 'amilia-enque-bootstrap' ));

	/* Loads the Internet Explorer specific stylesheet. */
	wp_enqueue_style( 'amilia-enque-ie', get_template_directory_uri() . '/assets/css/ie.css', array( 'amilia-enque-style' ), '20121010' );
	$wp_styles->add_data( 'amilia-enque-ie', 'conditional', 'lt IE 9' );

	/* WooCommerce */
	if(class_exists('WooCommerce')){
	    wp_enqueue_style( 'woocommerce', get_template_directory_uri() . "/assets/css/woocommerce.css", array(), '1.0.0');
	}

	/* Load static css*/
    $static_css = (isset($smof_data['presets_color']) && $smof_data['presets_color'] > 0) ? "presets-".$smof_data['presets_color'].".css" : "static.css" ;
    wp_enqueue_style('amilia-enque-static', get_template_directory_uri() . '/assets/css/'.$static_css, array(), '1.0.0','all');

 amilia_fonts_url();
}

add_action( 'wp_enqueue_scripts', 'amilia_scripts_styles' );
function amilia_fonts_url()
{
 $fonts_url = '';
 $fonts = array();
 $subsets = 'latin,latin-ext';

 if ('off' !== _x('on', 'Open+Sans font: on or off', 'wp-amilia')) {
  $fonts[] = 'Open+Sans:400,600,700,300';
 }

 if ($fonts) {
  $fonts_url = add_query_arg(array(
   'family' => urlencode(implode('|', $fonts)),
   'subset' => urlencode($subsets),
  ), 'https://fonts.googleapis.com/css');
 }

 return $fonts_url;
}

/**
 * Include icon-font to CMS shortcode
 */
function amilia_admin_scripts() {
	global $pagenow;
	if($pagenow == 'post.php' || $pagenow == 'post-new.php'){
		wp_enqueue_style('amilia-enque-admin-elegantIcons', get_template_directory_uri() . '/assets/css/icons-fonts.css', array(), '1.0.1');
  wp_enqueue_style('metabox', get_template_directory_uri() . '/inc/options/css/metabox.css');
  wp_enqueue_script('easytabs', get_template_directory_uri() . '/inc/options/js/jquery.easytabs.min.js');
  wp_enqueue_script('metabox', get_template_directory_uri() . '/inc/options/js/metabox.js');
	}

	wp_enqueue_style('amilia-admin-css', get_template_directory_uri() . '/assets/css/cms_admin_css.css', array(), '1.0.0');	
}
add_action('admin_enqueue_scripts', 'amilia_admin_scripts');

/**
 * Register sidebars.
 *
 * Registers our main widget area and the front page widget areas.
 *
 * @since Fox
 */
function amilia_widgets_init() {
	register_sidebar( array(
		'name' => esc_html__( 'Main Sidebar', 'wp-amilia' ),
		'id' => 'sidebar-1',
		'description' => esc_html__( 'Appears on posts and pages except the optional Front Page template, which has its own widgets', 'wp-amilia' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="wg-title">',
		'after_title' => '</h3>',
	) );

	register_sidebar( array(
		'name' => esc_html__( 'Top Cart Search', 'wp-amilia' ),
		'id' => 'cart-search-top',
		'description' => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="wg-title">',
		'after_title' => '</h3>',
	) );

	register_sidebar( array(
		'name' => esc_html__( 'Shortcodes Sidebar', 'wp-amilia' ),
		'id' => 'shortcodes-sidebar',
		'description' => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h4>',
		'after_title' => '</h4>',
	) );

	register_sidebar( array(
		'name' => esc_html__( 'Typography Sidebar', 'wp-amilia' ),
		'id' => 'typography-sidebar',
		'description' => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h4>',
		'after_title' => '</h4>',
	) );

	register_sidebar( array(
    	'name' => esc_html__( 'Bottom Area: Newsletter', 'wp-amilia' ),
    	'id' => 'bottom-area',
    	'description' => esc_html__( 'Appears when using the optional Footer with a page set as Bottom Area', 'wp-amilia' ),
    	'before_widget' => '<aside id="%1$s" class="widget %2$s">',
    	'after_widget' => '</aside>',
    	'before_title' => '<h3 class="wg-title">',
    	'after_title' => '</h3>',
	) );

	register_sidebar( array(
    	'name' => esc_html__( 'Bottom Area: Map', 'wp-amilia' ),
    	'id' => 'bottom-area-map',
    	'description' => esc_html__( 'Appears when using the optional Footer with a page set as Bottom Area', 'wp-amilia' ),
    	'before_widget' => '<aside id="%1$s" class="widget %2$s">',
    	'after_widget' => '</aside>',
    	'before_title' => '<h3 class="wg-title">',
    	'after_title' => '</h3>',
	) );

	register_sidebar( array(
    	'name' => esc_html__( 'Portfolio Single Area', 'wp-amilia' ),
    	'id' => 'port-single-area',
    	'description' => esc_html__( 'Appears to Portfoli single area', 'wp-amilia' ),
    	'before_widget' => '<aside id="%1$s" class="widget %2$s">',
    	'after_widget' => '</aside>',
    	'before_title' => '<h3 class="wg-title">',
    	'after_title' => '</h3>',
	) );

	register_sidebar( array(
    	'name' => esc_html__( 'Footer 1: Column 1', 'wp-amilia' ),
    	'id' => 'footer-11',
    	'description' => esc_html__( 'Appears when using the optional Footer with a page set as Footer 1', 'wp-amilia' ),
    	'before_widget' => '<aside id="%1$s" class="widget %2$s">',
    	'after_widget' => '</aside>',
    	'before_title' => '<h3 class="wg-title">',
    	'after_title' => '</h3>',
	) );

	register_sidebar( array(
    	'name' => esc_html__( 'Footer 1: Column 2', 'wp-amilia' ),
    	'id' => 'footer-12',
    	'description' => esc_html__( 'Appears when using the optional Footer with a page set as Footer 2', 'wp-amilia' ),
    	'before_widget' => '<aside id="%1$s" class="widget %2$s">',
    	'after_widget' => '</aside>',
    	'before_title' => '<h3 class="wg-title">',
    	'after_title' => '</h3>',
	) );

	register_sidebar( array(
    	'name' => esc_html__( 'Footer 1: Column 3', 'wp-amilia' ),
    	'id' => 'footer-13',
    	'description' => esc_html__( 'Appears when using the optional Footer with a page set as Footer 3', 'wp-amilia' ),
    	'before_widget' => '<aside class="widget %2$s">',
    	'after_widget' => '</aside>',
    	'before_title' => '<h3 class="wg-title">',
    	'after_title' => '</h3>',
	) );

	register_sidebar( array(
    	'name' => esc_html__( 'Footer 2: Column 1', 'wp-amilia' ),
    	'id' => 'footer-21',
    	'description' => esc_html__( 'Appears when using the optional Footer with a page set as Footer 1', 'wp-amilia' ),
    	'before_widget' => '<aside id="%1$s" class="widget %2$s">',
    	'after_widget' => '</aside>',
    	'before_title' => '<h3 class="wg-title">',
    	'after_title' => '</h3>',
	) );

	register_sidebar( array(
    	'name' => esc_html__( 'Footer 2: Column 2', 'wp-amilia' ),
    	'id' => 'footer-22',
    	'description' => esc_html__( 'Appears when using the optional Footer with a page set as Footer 2', 'wp-amilia' ),
    	'before_widget' => '<aside id="%1$s" class="widget %2$s">',
    	'after_widget' => '</aside>',
    	'before_title' => '<h3 class="wg-title">',
    	'after_title' => '</h3>',
	) );

	register_sidebar( array(
    	'name' => esc_html__( 'Footer 2: Column 3', 'wp-amilia' ),
    	'id' => 'footer-23',
    	'description' => esc_html__( 'Appears when using the optional Footer with a page set as Footer 3', 'wp-amilia' ),
    	'before_widget' => '<aside class="widget %2$s">',
    	'after_widget' => '</aside>',
    	'before_title' => '<h3 class="wg-title">',
    	'after_title' => '</h3>',
	) );

	register_sidebar( array(
    	'name' => esc_html__( 'Footer 3: Column 1', 'wp-amilia' ),
    	'id' => 'footer-31',
    	'description' => esc_html__( 'Appears when using the optional Footer with a page set as Footer 1', 'wp-amilia' ),
    	'before_widget' => '<aside id="%1$s" class="widget %2$s">',
    	'after_widget' => '</aside>',
    	'before_title' => '<h3 class="wg-title">',
    	'after_title' => '</h3>',
	) );

	register_sidebar( array(
    	'name' => esc_html__( 'Footer 3: Column 2', 'wp-amilia' ),
    	'id' => 'footer-32',
    	'description' => esc_html__( 'Appears when using the optional Footer with a page set as Footer 2', 'wp-amilia' ),
    	'before_widget' => '<aside id="%1$s" class="widget %2$s">',
    	'after_widget' => '</aside>',
    	'before_title' => '<h3 class="wg-title">',
    	'after_title' => '</h3>',
	) );

	register_sidebar( array(
    	'name' => esc_html__( 'Footer 3: Column 3', 'wp-amilia' ),
    	'id' => 'footer-33',
    	'description' => esc_html__( 'Appears when using the optional Footer with a page set as Footer 3', 'wp-amilia' ),
    	'before_widget' => '<aside class="widget %2$s">',
    	'after_widget' => '</aside>',
    	'before_title' => '<h3 class="wg-title">',
    	'after_title' => '</h3>',
	) );

	register_sidebar( array(
    	'name' => esc_html__( 'Footer 4: Column 1', 'wp-amilia' ),
    	'id' => 'footer-41',
    	'description' => esc_html__( 'Appears when using the optional Footer with a page set as Footer 1', 'wp-amilia' ),
    	'before_widget' => '<aside id="%1$s" class="widget %2$s">',
    	'after_widget' => '</aside>',
    	'before_title' => '<h3 class="wg-title">',
    	'after_title' => '</h3>',
	) );

	register_sidebar( array(
    	'name' => esc_html__( 'Footer 4: Column 2', 'wp-amilia' ),
    	'id' => 'footer-42',
    	'description' => esc_html__( 'Appears when using the optional Footer with a page set as Footer 2', 'wp-amilia' ),
    	'before_widget' => '<aside id="%1$s" class="widget %2$s">',
    	'after_widget' => '</aside>',
    	'before_title' => '<h3 class="wg-title">',
    	'after_title' => '</h3>',
	) );

	register_sidebar( array(
    	'name' => esc_html__( 'Footer 4: Column 3', 'wp-amilia' ),
    	'id' => 'footer-43',
    	'description' => esc_html__( 'Appears when using the optional Footer with a page set as Footer 3', 'wp-amilia' ),
    	'before_widget' => '<aside class="widget %2$s">',
    	'after_widget' => '</aside>',
    	'before_title' => '<h3 class="wg-title">',
    	'after_title' => '</h3>',
	) );

	register_sidebar( array(
    	'name' => esc_html__( 'Menu Widget Area', 'wp-amilia' ),
    	'id' => 'menu-widget-area',
    	'description' => esc_html__( 'Suitable with text widget', 'wp-amilia' ),
    	'before_widget' => '<aside class="widget %2$s">',
    	'after_widget' => '</aside>',
    	'before_title' => '<h3 class="wg-title">',
    	'after_title' => '</h3>',
	) );

	if(class_exists('WooCommerce')) {
		register_sidebar( array(
			'name' => esc_html__( 'Woocommerce Sidebar', 'wp-amilia' ),
			'id' => 'woocommerce_sidebar',
			'description' => '',
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget' => '</aside>',
			'before_title' => '<h3 class="wg-title">',
			'after_title' => '</h3>',
		) );
	}
}
add_action( 'widgets_init', 'amilia_widgets_init' );

/**
 * Filter the page menu arguments.
 *
 * Makes our wp_nav_menu() fallback -- wp_page_menu() -- show a home link.
 *
 * @since 1.0.0
 */
function amilia_page_menu_args( $args ) {
    if ( ! isset( $args['show_home'] ) )
        $args['show_home'] = true;
    return $args;
}
add_filter( 'wp_page_menu_args', 'amilia_page_menu_args' );

/**
 * Display navigation to next/previous comments when applicable.
 *
 * @since 1.0.0
 */
function amilia_comment_nav() {
    // Are there comments to navigate through?
    if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) :
    ?>
	<nav class="navigation comment-navigation" role="navigation">
		<h2 class="screen-reader-text"><?php esc_html_e( 'Comment navigation', 'wp-amilia' ); ?></h2>
		<div class="nav-links">
			<?php
				if ( $prev_link = get_previous_comments_link( esc_html__( 'Older Comments', 'wp-amilia' ) ) ) :
					printf( '<div class="nav-previous">%s</div>', $prev_link );
				endif;

				if ( $next_link = get_next_comments_link( esc_html__( 'Newer Comments', 'wp-amilia' ) ) ) :
					printf( '<div class="nav-next">%s</div>', $next_link );
				endif;
			?>
		</div><!-- .nav-links -->
	</nav><!-- .comment-navigation -->
	<?php
	endif;
}

/**
 * Display navigation to next/previous set of posts when applicable.
 *
 * @since 1.0.0
 */
function amilia_paging_nav() {
    // Don't print empty markup if there's only one page.
	if ( $GLOBALS['wp_query']->max_num_pages < 2 ) {
		return;
	}

	$paged        = get_query_var( 'paged' ) ? intval( get_query_var( 'paged' ) ) : 1;
	$pagenum_link = html_entity_decode( get_pagenum_link() );
	$query_args   = array();
	$url_parts    = explode( '?', $pagenum_link );

	if ( isset( $url_parts[1] ) ) {
		wp_parse_str( $url_parts[1], $query_args );
	}

	$pagenum_link = remove_query_arg( array_keys( $query_args ), $pagenum_link );
	$pagenum_link = trailingslashit( $pagenum_link ) . '%_%';

	// Set up paginated links.
	$links = paginate_links( array(
			'base'     => $pagenum_link,
			'total'    => $GLOBALS['wp_query']->max_num_pages,
			'current'  => $paged,
			'mid_size' => 1,
			'add_args' => array_map( 'urlencode', $query_args ),
			'prev_text' => '<i class="fa fa-angle-left"></i>',
			'next_text' => '<i class="fa fa-angle-right"></i>',
	) );

	if ( $links ) :

	?>
	<nav class="navigation paging-navigation clearfix" role="navigation">
			<div class="pagination loop-pagination">
				<?php echo ''.$links; ?>
			</div><!-- .pagination -->
	</nav><!-- .navigation -->
	<?php
	endif;
}

/**
* Display navigation to next/previous post when applicable.
*
* @since 1.0.0
*/
function amilia_post_nav() {
    global $post;

    // Don't print empty markup if there's nowhere to navigate.
    $previous = ( is_attachment() ) ? get_post( $post->post_parent ) : get_adjacent_post( false, '', true );
    $next     = get_adjacent_post( false, '', false );

    if ( ! $next && ! $previous )
        return;
    ?>
	<nav class="navigation post-navigation" role="navigation">
		<div class="nav-links clearfix">
			<?php
			$prev_post = get_previous_post();
			if (!empty( $prev_post )): ?>
			  <a class="btn btn-default post-prev left" href="<?php echo get_permalink( $prev_post->ID ); ?>"><i class="fa fa-angle-left"></i><?php echo esc_attr($prev_post->post_title); ?></a>
			<?php endif; ?>
			<?php
			$next_post = get_next_post();
			if ( is_a( $next_post , 'WP_Post' ) ) { ?>
			  <a class="btn btn-default post-next right" href="<?php echo get_permalink( $next_post->ID ); ?>"><?php echo get_the_title( $next_post->ID ); ?><i class="fa fa-angle-right"></i></a>
			<?php } ?>

			</div><!-- .nav-links -->
	</nav><!-- .navigation -->
	<?php
}

/* Add Custom Comment */
function amilia_comment($comment, $args, $depth) {
	$GLOBALS['comment'] = $comment;
	global $post;
	extract($args, EXTR_SKIP);

	if ( 'div' == $args['style'] ) {
		$tag = 'div';
		$add_below = 'comment';
	} else {
		$tag = 'li';
		$add_below = 'div-comment';
	}
    ?>
    <<?php echo esc_attr($tag) ?> <?php comment_class( empty( $args['has_children'] ) ? '' : 'parent' ) ?> id="comment-<?php comment_ID() ?>">
    <?php if ( 'div' != $args['style'] ) : ?>
    <div id="div-comment-<?php comment_ID() ?>" class="comment-body clearfix">
    <?php endif; ?>

	    <div class="comment-author-image vcard ">
	    	<?php echo get_avatar( $comment, 86 ); ?>
	    </div>
	    <?php if ( $comment->comment_approved == '0' ) : ?>
	    	<em class="comment-awaiting-moderation"><?php esc_html_e( 'Your comment is awaiting moderation.' , 'wp-amilia'); ?></em>
	    <?php endif; ?>
	    <div class="comment-main">
	    	<div class="comment-author-wrap commentmetadata">
	    		<span class="comment-author"><?php //the_author_posts_link(); ?><?php echo get_comment_author_link(); ?></span>
	    		<span class="comment-date">
	    		<?php
	    			echo get_the_date('F j, Y \a\t g:ia');
	    		?>
	    		</span>
	    	</div>
	    	<div class="comment-content">
	    		<?php comment_text(); ?>
	    		<div class="reply">
	    			<?php comment_reply_link( array_merge( $args, array('reply_text' => '<i class="arrow_back"></i>', 'add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
	    		</div>
	    	</div>
	    </div>
    <?php if ( 'div' != $args['style'] ) : ?>
    </div>
    <?php endif; ?>
    <?php
}

/**
 * limit words
 *
 * @since 1.0.0
 */
if (!function_exists('amilia_limit_words')) {
    function amilia_limit_words($string, $word_limit) {
        $words = explode(' ', $string, ($word_limit + 1));
        if (count($words) > $word_limit) {
            array_pop($words);
        }
        return implode(' ', $words)."";
    }
}

/**
 * Set home page.
 *
 * get home title and update options.
 *
 * @return Home page title.
 * @author FOX
 */
function amilia_set_home_page(){

    $home_page = 'Home'; /* Page name, which you want set is home page default */

    $page = get_page_by_title($home_page);

    if(!isset($page->ID))
        return ;

    update_option('show_on_front', 'page');
    update_option('page_on_front', $page->ID);
}

add_action('cms_import_finish', 'amilia_set_home_page');

/**
 * Set menu locations.
 *
 * get locations and menu name and update options.
 *
 * @return string[]
 * @author FOX
 */
function amilia_set_menu_location(){

    $setting = array(
        'Menu Footer' => 'footer-menu',
        'Main menu' => 'primary'
    );

    $navs = wp_get_nav_menus();

    $new_setting = array();

    foreach ($navs as $nav){

        if(!isset($setting[$nav->name]))
            continue;

        $id = $nav->term_id;
        $location = $setting[$nav->name];

        $new_setting[$location] = $id;
    }

    set_theme_mod('nav_menu_locations', $new_setting);
}

add_action('cms_import_finish', 'amilia_set_menu_location');

/* Import map */
function amilia_add_map_js(){
    wp_enqueue_script('max-import-map', get_template_directory_uri() . '/assets/js/import-map.js', array( 'jquery' ), '1.0.0', true);
}
add_action( 'admin_enqueue_scripts', 'amilia_add_map_js' );
/* AJAX HANDLER */
add_action('wp_ajax_max_import_map', 'amilia_import_map_callback');
add_action('wp_ajax_nopriv_max_import_map', 'amilia_import_map_callback');

function amilia_import_map_callback(){
    $request = wp_remote_get(get_template_directory_uri() . '/inc/dummy/amilia/maps_backup.json');
    $file = wp_remote_retrieve_body( $request );

	$options = get_option('mymaps_options');
	if( $file_content =  json_decode($file, true ) ) {

		/* Decode and redefine */
		try {
			$_HOST_             = $file_content['_host_'];
			$_MY_STYLES_        = (isset($file_content['_mystyles_']) && $file_content['_mystyles_'] != '' ) ? json_decode(rawurldecode($file_content['_mystyles_']), true) : '';
			$_MAP_POST_         = (isset($file_content['_map_posts_']) && $file_content['_map_posts_'] != '' ) ? json_decode(rawurldecode($file_content['_map_posts_']), true) : '';
			$_ICONS_            = (isset($file_content['_icons_']) && $file_content['_icons_'] != '' ) ? json_decode(rawurldecode($file_content['_icons_']), true) : '';
		} catch(Exception $e ) {
			echo 'content_incorrect'; exit();
		}

		/* check style */
		if( is_array($_MY_STYLES_) && count($_MY_STYLES_) > 0 )
		{
			foreach( $_MY_STYLES_  as $name => $value ) {
				if( !array_key_exists( $name, $options['_mystyles_'] ) )
				{
					$options['_mystyles_'][$name] = $value;
				}
			}
		}

		/* check icon */
		if( is_array($_ICONS_) && count($_ICONS_) > 0 )
		{
			foreach( $_ICONS_ as $value ) {
				if( !in_array( $value, $options['_icons_'] ) )
				{
					$options['_icons_'][] = $value;
				}
			}
		}
		/* check post */
		$options['_map_posts_'] = array();

		$cur_content_dir = (function_exists('content_url')) ? content_url() : plugins_url('.../.../',__FILE__);
		if( is_array($_MAP_POST_) && count($_MAP_POST_) > 0 )
		{
			foreach( $_MAP_POST_ as $value ) {
				try{
					$value['markers'] = str_replace($_HOST_, $cur_content_dir, $value['markers']);
				} catch( Exception $e ){
					echo 'fail';
					exit();
				}
				$options['_map_posts_'][] = $value;
			}
		}
		/* update */
		if( update_option( 'mymaps_options', $options ) ) {
			echo 'success';
		} else {
			echo 'nothing_change';
		}
	} else {
		echo 'content_incorrect';
	}
}