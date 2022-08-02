<?php

use Carbon_Fields\Carbon_Fields;
use Harbinger_Marketing\Assets_Cache;
use Harbinger_Marketing\PDF_Generator;
use Harbinger_Marketing\Instagram_Media;
use Harbinger_Marketing\BirdEye_Reviews;

add_action('after_setup_theme', 'load_theme_dependencies');
function load_theme_dependencies() {
	require_once('vendor/autoload.php');
	require_once('config/constants.php');
	require_once('lib/checks.php');
	require_once('lib/helpers/generic.php');
	require_once('lib/helpers/geolocation.php');
	require_once('lib/helpers/media.php');
	require_once('lib/helpers/svg.php');
	require_once('lib/helpers/image.php');
	require_once('lib/helpers/video.php');
	require_once('lib/helpers/ninja-forms.php');
	require_once('lib/helpers/wp.php');
    require_once('lib/helpers/load-more.php');
    require_once('lib/testimonials/include.php');
    require_once('lib/sidebars.php');
    require_once('lib/widgets/capitalplus-widget-recent-posts.php');
    require_once('lib/widgets/capitalplus-widget-categories.php');
}

add_action('after_setup_theme', 'init_carbon_fields');
function init_carbon_fields() {
	Carbon_Fields::boot();

	add_action('carbon_fields_register_fields', function() {
		require_once('lib/fields/post-metas.php');
		require_once('lib/fields/term-metas.php');
		require_once('lib/fields/nav-metas.php');
		require_once('lib/fields/widgets.php');
		require_once('lib/fields/global-sections.php');
        require_once('lib/fields/theme-options.php');
        require_once('lib/fields/testimonials-cpt-fields.php');

        // template fields
        require_once('lib/fields/home-page-fields.php');
        require_once('lib/fields/services-cpt-fields.php');
        require_once('lib/fields/case-studies-cpt-fields.php');
        require_once('lib/fields/who-we-are-page-fields.php');
        require_once('lib/fields/our-team-cpt-fields.php');
        require_once ('lib/fields/case-studies-page-fields.php');
        require_once ('lib/fields/services-cpt-term-meta-fields.php');
        require_once ('lib/fields/referral-partners-page-fields.php');
        require_once ('lib/fields/contact-us-page-fields.php');
        require_once ('lib/fields/testimonial-page-fields.php');
        require_once ('lib/fields/resources-fields.php');
        require_once('lib/fields/privacy-policy-fields.php');
        require_once ('lib/fields/terms-and-conditions-fields.php');
        require_once('lib/fields/post-term-meta-fields.php');
	});
}

add_action('init', 'init_classes');
function init_classes() {
    \Harbinger_Marketing\Testimonials\Source\Google\Client::init();

	//PDF_Generator::init();
	
	//Instagram_Media::init( carbon_get_theme_option('instagram_app_id'), carbon_get_theme_option('instagram_app_secret'), carbon_get_theme_option('instagram_access_token') );
}

add_action('init', 'init_theme');
function init_theme() {
	require_once('config/constants-dependent.php');

	require_once('lib/branding.php');
	require_once('lib/post-types.php');
	require_once('lib/menus/menus.php');
	require_once('lib/shortcodes.php');
	require_once('lib/emails/emails.php');

	load_theme_textdomain( THEME_TEXTDOMAIN, get_stylesheet_directory() . '/languages' );

	add_theme_support('post-thumbnails');
	add_theme_support('title-tag');
    add_theme_support('widgets');
    add_theme_support('widgets-block-editor');

	add_image_size('full-hd', 1920, 0, 1);
}



add_action('wp_enqueue_scripts', 'enqueue_scripts');
function enqueue_scripts() {
    $is_mobile = wp_is_mobile();

    if ( !is_admin() ) {
        wp_deregister_script('jquery');
    }

    wp_enqueue_script( 'jquery', THEME_ASSETS_URL . '/theme/js/main-jquery.js', array(), false, false );
    wp_enqueue_script( THEME_TEXTDOMAIN . '-preloader-js', THEME_ASSETS_URL . '/theme/js/pre-loader.js', array('jquery'), false, true);
    wp_localize_script( THEME_TEXTDOMAIN . '-preloader-js', 'DIFFERED_SCRIPT_LOADING', array(
        'youtube_api' => array(
            'src' => THEME_ASSETS_URL . '/theme/js/youtube.js',
            'delay' => $is_mobile ? 7000 : 3000,
            'https://www.youtube.com/embed/N3epEVMNJdY'
        ),

        'google_maps' => array(
            'src' => 'https://maps.googleapis.com/maps/api/js?key='.GOOGLE_MAP_API_KEY.'&callback=InitMap',
            'delay' => $is_mobile ? 7000 : 3000,
        ),
    ));

    wp_enqueue_script( THEME_TEXTDOMAIN . '-vendor', THEME_ASSETS_URL . '/theme/js/vendors.js', array('jquery'), false, true );
    wp_enqueue_script( THEME_TEXTDOMAIN . '-custom-theme-js', THEME_ASSETS_URL . '/theme/js/custom.js', array('jquery'), false, true );
    wp_enqueue_script( THEME_TEXTDOMAIN . '-custom-app-js', THEME_ASSETS_URL . '/theme/js/app.js', array('jquery'), false, true );
    
    wp_enqueue_script(THEME_TEXTDOMAIN . 'google-map-js', THEME_ASSETS_URL . '/theme/js/google-map.js', array('jquery'), 'false', true);

    wp_localize_script(THEME_TEXTDOMAIN . 'google-map-js', 'GOOGLE_LOCATIONS_OBJ', GOOGLE_LOCATIONS);
    wp_localize_script(THEME_TEXTDOMAIN . 'google-map-js', 'BLOG_LOCATIONS_OBJ', array(get_bloginfo('stylesheet_directory')));
}

add_action('wp_enqueue_scripts', 'enqueue_styles');
function enqueue_styles() {
    wp_enqueue_style( THEME_TEXTDOMAIN . '-style', THEME_ASSETS_URL . '/theme/css/styles.css' );
}

// Create menu object with children element.
function wp_get_mega_menu_tree( $elements, $parentId = 0 ,$depth = 4) {
    $branch = [];
    foreach ( $elements as $element ) {
        if ( $element->menu_item_parent == $parentId  ) {
            $children = wp_get_mega_menu_tree( $elements, $element->ID ,$depth = 4);
            if ( $children ) {
                $element->children = $children;
            }
            $branch[ $element->ID ] = $element;
        }
    }
    return array_values( $branch );
}

// Enable vcard upload
function enable_vcard_upload( $mime_types=array() ){
    $mime_types['vcf'] = 'text/vcard';
    $mime_types['vcard'] = 'text/vcard';
    $mime_types['svg'] = 'image/svg+xml';
    return $mime_types;
}
add_filter('upload_mimes', 'enable_vcard_upload' );


// Set map key inside Carbon fields
add_filter( 'carbon_fields_map_field_api_key', 'get_google_maps_api_key' );
function get_google_maps_api_key( $gkey ) {
    return GOOGLE_MAP_API_KEY;
}
/* Disable Widgets Block Editor */
add_filter( 'use_widgets_block_editor', '__return_false' );


// function that runs when shortcode is called
function column_count_2_shortcode() {
// Things that you want to do.
    $class_attribute= 'class="column-count-2"';
// Output needs to be return
    return $class_attribute;
}
// register shortcode
add_shortcode('column-count-2', 'column_count_2_shortcode');

// Function to include "Posts" only in search results
function SearchFilter($query) {
    if ($query->is_search) {
        $query->set('post_type', 'post');
    }
    return $query;
}
add_filter('pre_get_posts','SearchFilter');

//Image optimisation Task
add_action( 'after_setup_theme', 'capital_plus_theme_setup' );
function capital_plus_theme_setup() {
    // Image sizes Desktop
    add_image_size( 'service-d', 452 );
    add_image_size( 'case-studies-d', 777 );
    add_image_size( 'testimonial-main-d', 1920 );
    add_image_size( 'testimonial-thumb-d', 545 );    
    add_image_size( 'who-we-are-main-d', 888 );
    add_image_size( 'who-we-are-main-bg-d', 1920 );
    add_image_size( 'headshot-d', 545 );
    add_image_size( 'service-video-d', 712 );
    add_image_size( 'service-card-d', 440 );
    add_image_size( 'butterfly-d', 505 );
    add_image_size( 'butterfly-bg-d', 771 );
    add_image_size( 'post-card-d', 657 );
    add_image_size( 'podcast-card-d', 617 );
    add_image_size( 'refferral-content-d', 551 );
    add_image_size( 'hero-logo-d', 184 );
    add_image_size( 'footer-logo', 142 );
    add_image_size( 'page-banner-d', 1920 );

    // Image sizes Tablet
    add_image_size( 'service-t', 380 );
    add_image_size( 'case-studies-t', 799 );
    add_image_size( 'testimonial-main-t', 1024 );
    add_image_size( 'testimonial-thumb-t', 545 );    
    add_image_size( 'who-we-are-main-t', 984 );
    add_image_size( 'who-we-are-main-bg-t', 1024 );
    add_image_size( 'headshot-t', 545 );
    add_image_size( 'service-video-t', 541 );
    add_image_size( 'service-card-t', 914 );
    add_image_size( 'butterfly-t', 356 );
    add_image_size( 'butterfly-bg-t', 545 );
    add_image_size( 'post-card-t', 482);
    add_image_size( 'podcast-card-t', 442 );
    add_image_size( 'refferral-content-t', 934 );
    add_image_size( 'hero-logo-t', 285 );
    add_image_size( 'page-banner-t', 1024 );

    // Image sizes Mobile
    add_image_size( 'service-m', 412 );
    add_image_size( 'case-studies-m', 545 );
    add_image_size( 'testimonial-main-m', 914 );
    add_image_size( 'testimonial-thumb-m', 545 );    
    add_image_size( 'who-we-are-main-m', 545 );
    add_image_size( 'who-we-are-main-bg-m', 575 );
    add_image_size( 'headshot-m', 545 );
    add_image_size( 'service-video-m', 527 );
    add_image_size( 'service-card-m', 473 );
    add_image_size( 'butterfly-m', 262 );
    add_image_size( 'butterfly-bg-m', 400 );
    add_image_size( 'post-card-m', 545 );
    add_image_size( 'podcast-card-m', 505 );
    add_image_size( 'refferral-content-m', 515 );
    add_image_size( 'hero-logo-m', 228 );
    add_image_size( 'page-banner-m', 575 );
}

function capital_plus_excerpt_more( $more ) {
    return '...';
}
add_filter( 'excerpt_more', 'capital_plus_excerpt_more' );

// Map defer and async code
function capitalPlus_script_loader_tag($tag, $handle, $src) {
	
	if ($handle === THEME_TEXTDOMAIN . 'google-map-async') {
		
		if (false === stripos($tag, 'defer')) {
			
			$tag = str_replace('<script ', '<script defer ', $tag);
			
		}
		
	}
	return $tag;
}
add_filter('script_loader_tag', 'capitalPlus_script_loader_tag', 10, 3);