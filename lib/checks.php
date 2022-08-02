<?php

if ( !extension_loaded('imagick') ) {
	wp_die( __('<strong>Imagick</strong> needs to be installed for this theme to function properly.', THEME_TEXTDOMAIN) );
}