<?php

// Edit these variables' values, they're used for the WP admin panel, login page branding and for the email templates.
$theme_logo_raster_colorful_url = get_media_url( carbon_get_theme_option('logo_raster_colorful') );
$theme_logo_raster_white_url = get_media_url( carbon_get_theme_option('logo_raster_white') );
$theme_logo_icon_url = get_media_url( carbon_get_theme_option('logo_icon') );

if ( $theme_logo_raster_colorful_url ) {
	define( 'THEME_LOGO_RASTER_COLORFUL_URL', $theme_logo_raster_colorful_url );
} else {
	define( 'THEME_LOGO_RASTER_COLORFUL_URL', get_bloginfo('stylesheet_directory') . '/assets/branding/img/default-logo-colorful.png' );
}

if ( $theme_logo_raster_white_url ) {
	define( 'THEME_LOGO_RASTER_WHITE_URL', $theme_logo_raster_white_url );
} else {
	define( 'THEME_LOGO_RASTER_WHITE_URL', get_bloginfo('stylesheet_directory') . '/assets/branding/img/default-logo-white.png' );
}

if ( $theme_logo_icon_url ) {
	define( 'THEME_LOGO_ICON_URL', $theme_logo_icon_url );
} else {
	define( 'THEME_LOGO_ICON_URL', get_bloginfo('stylesheet_directory') . '/assets/branding/img/default-logo-icon.png' );
}

define( 'HARBINGER_MARKETING_LOGO_PATH', THEME_ASSETS_PATH . '/branding/img/harbinger-marketing-logo.svg' );
define( 'HARBINGER_MARKETING_WEBSITE_URL', 'https://harbingermarketing.com/' );


$google_map_api_key_theme_options = carbon_get_theme_option('google_map_api_key_theme_options');
$google_map_locations_theme_options = carbon_get_theme_option('google_map_locations_theme_options');
define('BLOG_INFO_URL',get_bloginfo('stylesheet_directory'));
define('GOOGLE_MAP_API_KEY', $google_map_api_key_theme_options);
define('GOOGLE_LOCATIONS',carbon_get_theme_option('office_locations'));
