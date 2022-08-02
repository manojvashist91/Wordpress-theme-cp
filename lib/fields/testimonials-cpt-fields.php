<?php

use Carbon_Fields\Container;
use Carbon_Fields\Field;

Container::make('post_meta', __('Testimonial Content'))
    ->where('post_type', '=', 'testimonials')
	->add_fields( array(
        Field::make( 'select', 'testimonial_content_type', __( 'Testimonial Content Type', THEME_TEXTDOMAIN ) )
            ->set_options(array(
                'image' => __( 'Image', THEME_TEXTDOMAIN ),
                'embed' => __( 'Embed Code', THEME_TEXTDOMAIN ),
            ))
            ->set_width(50),
        Field::make( 'select', 'testimonial_score', __( 'Score', THEME_TEXTDOMAIN ) )
            ->set_options(array(
                '5' => 5,
                '4' => 4,
                '3' => 3,
                '2' => 2,
                '1' => 1,
            ))
            ->set_width(50),

        Field::make( 'image', 'testimonial_screenshot', __( 'Testimonial Screenshot',THEME_TEXTDOMAIN  ) )
            ->set_conditional_logic(array(
                array(
                    'field' => 'testimonial_content_type',
                    'value' => 'image'
                )
            )),

        Field::make( 'textarea', 'testimonial_embed', __( 'Testimonial Embed Code',THEME_TEXTDOMAIN  ) )
            ->set_conditional_logic(array(
                array(
                    'field' => 'testimonial_content_type',
                    'value' => 'embed'
                )
            )),
	));