<?php

function convert_path_to_url($path) {
	if ( stripos( $path, '://' ) === false ) {
		$url = str_replace(
			array(
				ABSPATH,
				DIRECTORY_SEPARATOR
			),
			array(
				trailingslashit( get_bloginfo('url') ),
				'/'
			),
			$path
		);

		return $url;
	}

	return $path;
}

function convert_url_to_path($url) {
	if ( stripos( $url, '://' ) !== false ) {
		$path = str_replace( get_bloginfo('url'), ABSPATH, $url );

		return $path;
	}

	return $url;
}

function sanitize_phone_number_for_href($phone) {
	return preg_replace('~[^0-9]~', '', $phone);
}

function maybe_add_target_attr_to_link($link) {
	$link_parts = parse_url( $link );
	$site_link_parts = parse_url( get_bloginfo('url') );

	if ( $link_parts['host'] != $site_link_parts['host'] ) {
		return 'target="_blank"';
	}
}