<?php

namespace Harbinger_Marketing;

class BirdEye_Reviews {

	const REVIEWS_TRANSIENT_NAME_PREFIX = 'birdeye_reviews_';

	protected $business_id;
	protected $api_key;

	public function __construct( $business_id, $api_key ) {
		$this->business_id = $business_id;
		$this->api_key = $api_key;
    }

	public function get_reviews( $count = 25, $only_5_star = false, $allow_empty = false ) {
		$reviews = get_transient( $this->get_reviews_transient_name() ) ?? $this->refresh_reviews();
		
		if ( !$reviews ) {
			return array();
		}

		$reviews_filtered = $reviews;

		if ( $only_5_star ) {
			$reviews_filtered = array_filter(
				$reviews_filtered,
				function( $review ) {
					return $review->rating == 5;
				}
			);
		}

		if ( !$allow_empty ) {
			$reviews_filtered = array_filter(
				$reviews_filtered,
				function( $review ) {
					return trim( $review->comments );
				}
			);
		}

		return array_slice( $reviews_filtered, 0, $count );
	}

	protected function refresh_reviews() {
		$ch = curl_init();
	
		curl_setopt_array(
			$ch,
			array(
				CURLOPT_HTTPHEADER => array(
					'content-type: application/json',
					'accept:application/json'
				),
				CURLOPT_URL => 'https://api.birdeye.com/resources/v1/review/businessid/' . urlencode( $this->business_id ) . '?sindex=0&count=50&api_key=' . urlencode( $this->api_key ),
				CURLOPT_RETURNTRANSFER => 1
			)
		);
		
		$reviews = curl_exec( $ch );

		curl_close( $ch );

		if ( !$reviews ) {
			return array();
		}

		$reviews = json_decode( $reviews );

		set_transient( $this->get_reviews_transient_name(), $reviews, DAY_IN_SECONDS );

		return $reviews;
	}

	protected function get_reviews_transient_name() {
		return self::REVIEWS_TRANSIENT_NAME_PREFIX . $this->business_id;
	}

}