<?php

function get_user_geo_data($ip = '') {
	if ( !$ip ) {
		$ip = $_SERVER['REMOTE_ADDR'];
	}

	$ch = curl_init();
	
	curl_setopt_array($ch, array(
		CURLOPT_URL => 'http://www.geoplugin.net/json.gp?ip=' . $ip,
		CURLOPT_RETURNTRANSFER => 1
	));

	$geo_data = json_decode( curl_exec($ch), 1 );

	return $geo_data;
}