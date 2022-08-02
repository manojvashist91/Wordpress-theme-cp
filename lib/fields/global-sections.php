<?php

use Carbon_Fields\Container;
use Carbon_Fields\Field;

Container::make( 'theme_options', __('Global Sections', THEME_TEXTDOMAIN) )

	->add_tab(__('Partner Logos', THEME_TEXTDOMAIN), array(
		Field::make( 'complex', 'hero_banner_logos', __('Logo' ,THEME_TEXTDOMAIN ) )
			->set_layout( 'tabbed-horizontal' )
			->add_fields( array(
				Field::make( 'image', 'banner_logo_image', __('Logo Image',THEME_TEXTDOMAIN ) )
			) ),
	))

    //Case Studies Header
    ->add_tab( __('Case Studies',THEME_TEXTDOMAIN  ), array(
		Field::make( 'text', 'case_studies_heading', __( 'Heading',THEME_TEXTDOMAIN  ) )
        ->set_width( 50 )
			->set_help_text( __( 'Use "|" to initiate bold text. (Use Once)' ) ),
		Field::make( 'textarea', 'case_studies_main_content', __( 'Content',THEME_TEXTDOMAIN  ) )
        ->set_width( 50 )
			->set_rows( 8 ),
	))

	->add_tab( __('Testimonials',THEME_TEXTDOMAIN  ), array(
        //Testimonial body
        Field::make( 'text', 'our_word_heading', __( 'Heading',THEME_TEXTDOMAIN  ) )
            ->set_help_text( __( 'Use "|" to initiate bold text. (Use Once)' ) ),
        Field::make( 'textarea', 'our_word_content', __( 'Content',THEME_TEXTDOMAIN  ) )
        ->set_width( 80 )
            ->set_rows( 8 ),
        Field::make( 'image', 'carousel_main_image', __('Main Image',THEME_TEXTDOMAIN ) )
        ->set_width( 20 )
            ->set_type( array('image') ),
        Field::make( 'separator', 'main_video-section', __( 'Video Settings',THEME_TEXTDOMAIN  ) ),
        Field::make( 'radio', 'carousel_main_video_options', __('Select Type of Video',THEME_TEXTDOMAIN ) )
        ->set_width( 40 )
        ->add_options( array(
            'youtube' => 'Youtube',
            'uploaded' => 'Uploaded File',
        ) ),
        Field::make( 'text', 'carousel_main_video_link', __( 'YouTube Video Link',THEME_TEXTDOMAIN  ) )
        ->set_width( 60 )
        ->set_conditional_logic( array(
            array(
                'field' => 'carousel_main_video_options',
                'value' => 'youtube', // Optional, defaults to "". Should be an array if "IN" or "NOT IN" operators are used.
                'compare' => '=', // Optional, defaults to "=". Available operators: =, <, >, <=, >=, IN, NOT IN
            )
        ) ),
        Field::make( 'file', 'carousel_main_video_link_file', __( 'Self-Hosted Video',THEME_TEXTDOMAIN  ) )
        ->set_width( 30 )
        ->set_conditional_logic( array(
            array(
                'field' => 'carousel_main_video_options',
                'value' => 'uploaded', // Optional, defaults to "". Should be an array if "IN" or "NOT IN" operators are used.
                'compare' => '=', // Optional, defaults to "=". Available operators: =, <, >, <=, >=, IN, NOT IN
            )
        ) ),
        Field::make( 'image', 'carousel_main_video_link_file_banner', __( 'Self-Hosted Video Banner',THEME_TEXTDOMAIN  ) )
        ->set_width( 30 )
            ->set_conditional_logic( array(
                array(
                    'field' => 'carousel_main_video_options',
                    'value' => 'uploaded', // Optional, defaults to "". Should be an array if "IN" or "NOT IN" operators are used.
                    'compare' => '=', // Optional, defaults to "=". Available operators: =, <, >, <=, >=, IN, NOT IN
                )
            ) ),

        //Testimonial Carousel Section
        Field::make( 'complex', 'our_word_carousel_image', __('Carousel Images',THEME_TEXTDOMAIN ) )
            ->set_layout( 'tabbed-horizontal' )
            ->add_fields( array(
                Field::make( 'image', 'carousel_image', __('Image',THEME_TEXTDOMAIN ) )
                    ->set_type( array('image') ),
                Field::make( 'radio', 'carousel_video_options', __('Select Type of Video',THEME_TEXTDOMAIN ) )
                ->set_width( 40 )
                    ->add_options( array(
                        'youtube' => 'Youtube',
                        'uploaded' => 'Uploaded File',
                    ) ),
                Field::make( 'text', 'carousel_video_link', __( 'Carousel YouTube Video Link',THEME_TEXTDOMAIN  ) )
                ->set_width( 60 )
                ->set_conditional_logic( array(
                    array(
                        'field' => 'carousel_video_options',
                        'value' => 'youtube', // Optional, defaults to "". Should be an array if "IN" or "NOT IN" operators are used.
                        'compare' => '=', // Optional, defaults to "=". Available operators: =, <, >, <=, >=, IN, NOT IN
                    )
                ) ),
                Field::make( 'file', 'carousel_video_link_file', __( 'Carousel Self-Hosted Video',THEME_TEXTDOMAIN  ) )
                ->set_width( 30 )
                ->set_conditional_logic( array(
                    array(
                        'field' => 'carousel_video_options',
                        'value' => 'uploaded', // Optional, defaults to "". Should be an array if "IN" or "NOT IN" operators are used.
                        'compare' => '=', // Optional, defaults to "=". Available operators: =, <, >, <=, >=, IN, NOT IN
                    )
                ) ),

                Field::make( 'image', 'carousel_video_link_file_banner', __( 'Carousel Self-Hosted Video Banner',THEME_TEXTDOMAIN  ) )
                ->set_width( 30 )
                    ->set_conditional_logic( array(
                        array(
                            'field' => 'carousel_video_options',
                            'value' => 'uploaded', // Optional, defaults to "". Should be an array if "IN" or "NOT IN" operators are used.
                            'compare' => '=', // Optional, defaults to "=". Available operators: =, <, >, <=, >=, IN, NOT IN
                        )
                    ) ),

            ) ),
    ) )
    ->add_tab(__('Certificate Logos', THEME_TEXTDOMAIN), array(
        Field::make( 'text', 'our_partner_global_heading', __( 'Heading',THEME_TEXTDOMAIN  ) ),
        Field::make('complex', 'our_partner_logos', __('Certificate Logos', THEME_TEXTDOMAIN))
            ->set_layout('tabbed-horizontal')
            ->add_fields(array(
                Field::make('image', 'partner_logo_image', __('Logo', THEME_TEXTDOMAIN))
            )),
    ))
    
    ->add_tab( __('Meet Our Team',THEME_TEXTDOMAIN), array(
        Field::make( 'text', 'meet_our_team_heading', __( 'Heading',THEME_TEXTDOMAIN  ) )
            ->set_help_text( __( 'Use "|" to Strong lin. (Use Once)' ) ),
        Field::make( 'textarea', 'meet_our_team_content', __('Content',THEME_TEXTDOMAIN) )
            ->set_rows( 8 ),
    ))
    ->add_tab( __('Financing Application',THEME_TEXTDOMAIN), array(
        Field::make('text', 'fa-shortcode', __('Form Shortcode', THEME_TEXTDOMAIN))
        ->set_width( 50 ),
        Field::make('text', 'fa_heading', __('Heading', THEME_TEXTDOMAIN))
        ->set_width( 50 ),
        Field::make('textarea', 'fa_content', __('Content', THEME_TEXTDOMAIN)),
        
    ))

    // FAQs Section
    ->add_tab(__('FAQ', THEME_TEXTDOMAIN), array(
        Field::make( 'radio', 'faqs_section_options', 'Display:',THEME_TEXTDOMAIN  )
        ->set_width( 20 )
                    ->add_options( array(
                        'yes' => 'Yes',
                        'no' => 'No',
                    ) ),
        Field::make('text', 'frequently_asked_questions_heading', __('Heading', THEME_TEXTDOMAIN))
        ->set_width( 80 )
            ->set_help_text( __( 'Use "|" to insert line break. (Use Once)' ) )
            ->set_conditional_logic( array(
                array(
                    'field' => 'faqs_section_options',
                    'value' => 'yes', // Optional, defaults to "". Should be an array if "IN" or "NOT IN" operators are used.
                    'compare' => '=', // Optional, defaults to "=". Available operators: =, <, >, <=, >=, IN, NOT IN
                )
            ) ),
        Field::make('textarea', 'frequently_asked_questions_content', __('Content', THEME_TEXTDOMAIN))
        ->set_rows( 3 )
            ->set_conditional_logic( array(
                array(
                    'field' => 'faqs_section_options',
                    'value' => 'yes', // Optional, defaults to "". Should be an array if "IN" or "NOT IN" operators are used.
                    'compare' => '=', // Optional, defaults to "=". Available operators: =, <, >, <=, >=, IN, NOT IN
                )
            ) ),
        Field::make('complex', 'frequently_asked_questions', __('FAQ Sections', THEME_TEXTDOMAIN))
            ->set_layout('tabbed-horizontal')
            ->set_conditional_logic( array(
                array(
                    'field' => 'faqs_section_options',
                    'value' => 'yes', // Optional, defaults to "". Should be an array if "IN" or "NOT IN" operators are used.
                    'compare' => '=', // Optional, defaults to "=". Available operators: =, <, >, <=, >=, IN, NOT IN
                )
            ) )
            ->add_fields(array(
                Field::make('text', 'frequently_asked_questions_section_heading', __('Section Heading', THEME_TEXTDOMAIN))
                    ->set_help_text( __( 'Use "|" to insert line break. (Use Once)' ) ),
                Field::make('complex', 'frequently_asked_questions_accordion', __('FAQ Entries', THEME_TEXTDOMAIN))
                    ->set_layout('tabbed-horizontal')
                    ->add_fields(array(
                        Field::make('text', 'frequently_asked_questions_accordion_title', __('Question', THEME_TEXTDOMAIN)),
                        Field::make( 'textarea', 'frequently_asked_questions_accordion_content', __( 'Answer',THEME_TEXTDOMAIN  ) )
                            ->set_rows( 3 )
                    ))
            )),
    ));