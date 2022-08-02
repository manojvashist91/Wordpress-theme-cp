<?php

add_filter('upload_mimes', 'testimonials_add_mimi_types');
function testimonials_add_mimi_types( $mimes ) {
    $mimes['json'] = 'text/plain';
    return $mimes;
}