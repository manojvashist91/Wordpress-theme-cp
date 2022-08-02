<?php

function get_media_url($attachment_id, $image_size = 'full-hd') {
	if ( wp_attachment_is_image($attachment_id) ) {
		$attachment = wp_get_attachment_image_src($attachment_id, $image_size);
		
		return $attachment[0];
	}

	return wp_get_attachment_url($attachment_id);
}