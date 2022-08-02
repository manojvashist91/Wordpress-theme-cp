<?php

namespace Harbinger_Marketing;

use Mpdf\Mpdf;
use Mpdf\Output\Destination;

class PDF_Generator {

	const CACHE_PATH = THEME_PDFS_CACHE_PATH;
	const CACHE_EXPIRATION = DAY_IN_SECONDS;

	protected static $instance = null;

	protected function __construct() {
		if ( !is_dir( self::CACHE_PATH ) ) {
			mkdir( self::CACHE_PATH, 0755, true );
		} else {
			$this->clear_cache();
		}
	}

	public static function init() {
		if ( !self::$instance ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	public static function get_instance() {
		return self::$instance;
	}

	public function generate( $html_path, $data, $file_name, $save_dir = '' ) {
		return self::get_instance()->generate_pdf( $html_path, $data, $file_name, $save_dir );
	}

	public function generate_pdf( $html_path, $data, $file_name, $save_dir = '' ) {
		if ( !$save_dir ) {
			$save_dir = self::CACHE_PATH;
		}

		$file_path = $save_dir . DIRECTORY_SEPARATOR . $file_name;

		if ( file_exists( $file_path ) ) {
			return $file_path;
		}

		ob_start();

		require( $html_path );

		$html = ob_get_clean();

		$mpdf = new Mpdf();

		$mpdf->DefHTMLHeaderByName('header', '<img src="' . get_svg_as_colorized_png( THEME_ASSETS_PATH . '/pdfs/img/header.svg', THEME_BRAND_COLOR_MAIN ) . '" />');
		$mpdf->DefHTMLFooterByName('footer', '<img src="' . get_svg_as_colorized_png( THEME_ASSETS_PATH . '/pdfs/img/footer.svg', THEME_BRAND_COLOR_MAIN ) . '" />');

		$mpdf->WriteHTML( $html );

		if ( !is_dir( $save_dir ) ) {
			mkdir( $save_dir, 0755, true );
		}

		$mpdf->Output( $file_path, Destination::FILE );

		return $file_path;
	}

	public function clear_cache( $force_empty = false ) {
		$files = array_slice( scandir( self::CACHE_PATH ), 2 );

		foreach ( $files as $file ) {
			$file_path = self::CACHE_PATH . DIRECTORY_SEPARATOR . $file;

			if ( !$force_empty && ( filectime( $file_path ) > ( time() - self::CACHE_EXPIRATION ) ) ) {
				continue;
			}

			unlink( $file_path );
		}
	}

}