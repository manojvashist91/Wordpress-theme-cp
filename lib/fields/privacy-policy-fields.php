<?php
use Carbon_Fields\Container;
use Carbon_Fields\Field;

Container::make( 'post_meta', __('Page Banner Image',THEME_TEXTDOMAIN) )
    ->where( 'post_type', '=', 'page' )
    ->where( 'post_template', '=', 'page-templates/privacy-policy-page.php' )
    ->add_fields( array(
                Field::make( 'image', 'privacy_policy_banner_image', __('Banner Image',THEME_TEXTDOMAIN ) ),
    ) );