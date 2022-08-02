<?php

use Carbon_Fields\Container;
use Carbon_Fields\Field;

Container::make('post_meta', __('Contact Us Page Settings', THEME_TEXTDOMAIN))
    ->where('post_type', '=', 'page')
    ->where('post_template', '=', 'page-templates/contact-us-template.php')
    ->add_tab(__('Hero Section', THEME_TEXTDOMAIN), array(
        Field::make('image', 'hero_banner_image', __('Banner Image', THEME_TEXTDOMAIN)),
    ))
    ->add_tab(__('Ninja Form Section', THEME_TEXTDOMAIN), array(
        Field::make('text', 'shortcode_code', __('Add Shortcode of Form', THEME_TEXTDOMAIN))
            ->set_width( 50 ),
        Field::make('text', 'form_heading', __('Heading', THEME_TEXTDOMAIN))
            ->set_width( 50 ),
        Field::make('textarea', 'form_content', __('Content', THEME_TEXTDOMAIN))
            ->set_rows( 2),
    ))
    ->add_tab(__('C2A Section', THEME_TEXTDOMAIN), array(
        Field::make('text', 'cta_heading', __('Heading', THEME_TEXTDOMAIN)),
    ));