<?php
use Carbon_Fields\Container;
use Carbon_Fields\Field;

Container::make( 'post_meta', __('Page Banner Image',THEME_TEXTDOMAIN) )
    ->where( 'post_type', '=', 'page' )
    ->where( 'post_template', '=', 'page-templates/terms-and-conditions-page.php' )
    ->add_fields( array(
                Field::make( 'image', 'terms_and_conditions_banner_image', __('Banner Image',THEME_TEXTDOMAIN ) ),
    ) );