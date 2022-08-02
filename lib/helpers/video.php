<?php

function get_youtube_video_id_from_url($url) {
	preg_match('~watch\?v=([a-zA-Z0-9_-]*)~', $url, $video_id);

	return $video_id[1];
}

function get_video_embed_code_by_url($url) {
	if ( preg_match('~youtube\.com~', $url) ) {
		return '<iframe width="100%" src="https://www.youtube.com/embed/' . get_youtube_video_id_from_url( $url ) . '" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>';
	} else {
		preg_match('~(\d+)~', $url, $video_id);

		return '<iframe src="https://player.vimeo.com/video/' . $video_id[1] . '" width="640" height="360" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>';
	}
}

function is_attachment_video($post_id) {
	return strpos( get_post_mime_type($post_id), 'video' ) !== FALSE;
}