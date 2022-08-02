<?php

use Harbinger_Marketing\Assets_Cache;
use SVG\SVG;
use SVG\Rasterization\SVGRasterizer;

function get_svg_inline($svg_path_or_url) {
	$path = convert_url_to_path($svg_path_or_url);

	$svg = file_get_contents($path);

	return $svg;
}

function svg_inline($svg_path_or_url) {
	echo get_svg_inline($svg_path_or_url);
}

function get_svg_as_colorized_png($svg_path_or_url, $color = '') {
	// Look for the file in the theme cache
	$file_hash = hash_file( 'md5', convert_url_to_path($svg_path_or_url) );
	$color_hash = hash( 'md5', $color );
	$cache_file_name = basename( $svg_path_or_url, '.svg' ) . '-' . hash( 'md5', $file_hash . $color ) . '.png';

	if ( Assets_Cache::exists( 'img', $cache_file_name ) ) {
		return Assets_Cache::get_url( 'img', $cache_file_name );
	}

	// Generate the file
	$svg = get_svg_inline( $svg_path_or_url );
	$svg_obj = SVG::fromString( $svg );

	if ( $color ) {
		$svg_doc = $svg_obj->getDocument();
		$traverse_svg_child_items = function(&$parent) use (&$traverse_svg_child_items, $color) {
			for ( $i = 0; $i < $parent->countChildren(); $i++ ) {
				$child = $parent->getChild($i);

				if ( $child->getName() != 'g' ) {
					$child->setStyle('color', $color);
					$child->setStyle('fill', $color);
					
					if ( $child->getStyle('stroke') ) {
						$child->setStyle('stroke', $color);
					}
				}

				$traverse_svg_child_items( $child );
			}
		};

		$traverse_svg_child_items( $svg_doc );
	}
	
	$image = new Imagick();

	$image->setBackgroundColor( new ImagickPixel('transparent') );
    $image->readImageBlob( $svg_obj );
	$image->setImageFormat( 'png32' );

	// Cache the file
	Assets_Cache::set( 'img', $cache_file_name, $image );

	$image->clear();
    $image->destroy();

	return Assets_Cache::get_url( 'img', $cache_file_name, $image );
}