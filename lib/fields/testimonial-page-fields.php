<?php

use Carbon_Fields\Container;
use Carbon_Fields\Field;

Container::make('post_meta', __('Testimonials Page Settings', THEME_TEXTDOMAIN))
    ->where('post_type', '=', 'page')
    ->where('post_template', '=', 'page-templates/testimonial-template.php')
    ->add_tab(__('Testimonials Section', THEME_TEXTDOMAIN), array(
        Field::make( 'radio', 'testimonials_display_options', 'Display:',THEME_TEXTDOMAIN  )
                    ->set_width( 40 )
                    ->add_options( array(
                        'yes' => 'Yes',
                        'no' => 'No',
                    ) ),
    ))
    ->add_tab(__('Reviews Section', THEME_TEXTDOMAIN), array(
        Field::make( 'text', 'reviws_heading', __( 'Heading',THEME_TEXTDOMAIN ) )
            ->set_help_text( __( 'Use "|" to initiate bold text. (Use Once)' ) ),
    ));


