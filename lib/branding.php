<?php

// Change the WP login page logo link
add_filter( 'login_headerurl', 'custom_wp_login_logo_link' );
function custom_wp_login_logo_link() {
	return get_bloginfo('url');
}

// Create CSS variable with the theme logo on the WP login page
add_action('login_head', 'custom_login_screen_logo');
function custom_login_screen_logo() {
	?>

	<style type="text/css">
		:root {
			--theme-logo-raster-colorful-url: url('<?php echo THEME_LOGO_RASTER_COLORFUL_URL ?>');
		}
	</style>

	<?php
}

// Enqueue the branding styles
add_action('admin_enqueue_scripts', 'enqueue_branding_styles');
add_action('wp_enqueue_scripts', 'enqueue_branding_styles');
add_action('login_head', 'enqueue_branding_styles');
function enqueue_branding_styles() {
	wp_enqueue_style( THEME_TEXTDOMAIN . '-branding-styles', get_bloginfo('stylesheet_directory') . '/assets/branding/css/styles.css' );
}

// Admin bar logo
add_action('add_admin_bar_menus', 'replace_admin_bar_logo');
function replace_admin_bar_logo() {
	remove_action( 'admin_bar_menu', 'wp_admin_bar_wp_menu' );
	add_action( 'admin_bar_menu', 'custom_admin_bar_logo' );
}

function custom_admin_bar_logo( $wp_admin_bar ) {
	$wp_admin_bar->add_menu( array(
		'id'    => 'theme-logo',
		'title' => '<img src="' . THEME_LOGO_ICON_URL . '" alt="" >',
		'href'  => home_url('/'),
		'meta'  => array(
			'title' => get_bloginfo('name')
		),
	) );
}

// Admin footer Harbinger Marketing logo
add_filter('admin_footer_text', 'custom_admin_footer_text');
function custom_admin_footer_text() {
	?>

	<span id="footer-thankyou">
		<?php _e('Developed by', THEME_TEXTDOMAIN) ?>

		<a href="<?php echo HARBINGER_MARKETING_WEBSITE_URL ?>" title="<?php _e('Harbinger Marketing', THEME_TEXTDOMAIN) ?>" target="_blank">
			<?php svg_inline( HARBINGER_MARKETING_LOGO_PATH ) ?>
		</a>
	</span>

	<?php
}