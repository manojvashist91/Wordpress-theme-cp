<?php

function get_template_part_with_params($path, array $params = array()) {
	extract( $params );

	require( locate_template( $path . '.php' ) );
}

function get_page_by_template($template) {
	$page = get_posts(
		array(
			'post_type' => 'any',
			'numberposts' => 1,
			'meta_key' => '_wp_page_template',
			'meta_value' => $template
		)
	);

	if ( $page ) {
		return $page[0];
	}
}

function get_page_link_by_template($template) {
	$page = get_page_by_template($template);
	
	if ( $page ) {
		return get_permalink( $page->ID, THEME_TEXTDOMAIN );
	}
}

function get_page_link_by_slug($slug) {
	$page = get_page_by_path($slug);
	
	if ( $page ) {
		return get_permalink( $page->ID, THEME_TEXTDOMAIN );
	}
}