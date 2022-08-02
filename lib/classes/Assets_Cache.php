<?php

namespace Harbinger_Marketing;

class Assets_Cache {

	const CACHE_PATH = THEME_CACHE_PATH;
	const CACHE_URL = THEME_CACHE_URL;

	public static function get_file_path( $relative_path, $file_name ) {
		return self::CACHE_PATH . DIRECTORY_SEPARATOR . $relative_path . DIRECTORY_SEPARATOR . $file_name;
	}
	
	public static function get_file_url( $relative_path, $file_name ) {
		return self::CACHE_URL . '/' . $relative_path . '/' . $file_name;
	}
	
	public static function exists( $relative_path, $file_name ) {
		return file_exists( self::get_file_path( $relative_path, $file_name ) );
	}
	
	public static function set( $relative_path, $file_name, $content ) {
		$file_path = self::get_file_path( $relative_path, $file_name );
		$file_dir_path = dirname( $file_path );
	
		if ( !is_dir( $file_dir_path ) ) {
			mkdir( $file_dir_path, 0755, true );
		}
	
		return file_put_contents( $file_path, $content );
	}
	
	public static function get( $relative_path, $file_name ) {
		if ( self::exists( $relative_path, $file_name ) ) {
			return file_get_contents( self::get_file_path( $relative_path, $file_name ) );
		}
	}
	
	public static function get_url( $relative_path, $file_name ) {
		if ( self::exists( $relative_path, $file_name ) ) {
			return self::get_file_url( $relative_path, $file_name );
		}
	}

}