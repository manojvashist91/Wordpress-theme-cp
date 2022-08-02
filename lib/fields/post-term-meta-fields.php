<?php

use Carbon_Fields\Container;
use Carbon_Fields\Field;

Container::make('term_meta', __('Default Banner Setting'))
    ->show_on_taxonomy('category')
    ->add_fields( array(
        Field::make( 'image', 'post_category_default_hero_banner', __('Default Banner Image', THEME_TEXTDOMAIN))
    ));