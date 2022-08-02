<?php

use Carbon_Fields\Container;
use Carbon_Fields\Field;

Container::make('post_meta', __('Service Settings'))
    ->where('post_type', '=', 'services')

    // Card View Fields
    ->add_tab( __('Card Section',THEME_TEXTDOMAIN ), array(
        //Field::make('text', 'service_page_title', __('Title',THEME_TEXTDOMAIN)),
        Field::make( 'separator', 'hero_bg_video_separator', __( 'Video Options',THEME_TEXTDOMAIN ) ),

        Field::make( 'radio', 'services_video_options', 'Select Type of Video',THEME_TEXTDOMAIN )
        ->set_width( 40 )
            ->add_options( array(
                'youtube' => 'Youtube',
                'uploaded' => 'Self-Hosted Video',
            ) ),
        Field::make( 'text', 'services_video_link', __( 'YouTube Video URL',THEME_TEXTDOMAIN ) )
        ->set_width( 60 )
        ->set_conditional_logic( array(
            array(
                'field' => 'services_video_options',
                'value' => 'youtube', // Optional, defaults to "". Should be an array if "IN" or "NOT IN" operators are used.
                'compare' => '=', // Optional, defaults to "=". Available operators: =, <, >, <=, >=, IN, NOT IN
            )
        ) ),
        Field::make( 'file', 'services_video_link_file', __( 'Self-Hosted Video',THEME_TEXTDOMAIN  ) )
            ->set_width( 30 )
            ->set_conditional_logic( array(
                array(
                    'field' => 'services_video_options',
                    'value' => 'uploaded', // Optional, defaults to "". Should be an array if "IN" or "NOT IN" operators are used.
                    'compare' => '=', // Optional, defaults to "=". Available operators: =, <, >, <=, >=, IN, NOT IN
                )
            ) ),
        Field::make( 'image', 'services_video_banner_link_file', __( 'Self-Hosted Video Banner',THEME_TEXTDOMAIN ) )
        ->set_width( 30 )
        ->set_conditional_logic( array(
            array(
                'field' => 'services_video_options',
                'value' => 'uploaded', // Optional, defaults to "". Should be an array if "IN" or "NOT IN" operators are used.
                'compare' => '=', // Optional, defaults to "=". Available operators: =, <, >, <=, >=, IN, NOT IN
            )
        ) ),
    ))
    
    // Header Section

    // ->add_tab(__('Hero Section', THEME_TEXTDOMAIN), array(
    //     Field::make('text', 'hero_banner_heading', __('Heading', THEME_TEXTDOMAIN)),
    //     Field::make('image', 'hero_banner_image', __('Banner Image', THEME_TEXTDOMAIN))
    //     ->set_width( 20 ),
    //     Field::make('textarea', 'hero_banner_content', __('Content', THEME_TEXTDOMAIN))
    //     ->set_width( 80 )
    //     ->set_rows(5)
    // ))

    ->add_tab( __('Hero Section',THEME_TEXTDOMAIN ), array(
        
        //Hero Heading
        Field::make( 'text', 'hero_heading', __( 'Heading',THEME_TEXTDOMAIN ) )
            ->set_help_text( __( 'Use "|" to insert line break. (Use Once)' ) ),
        Field::make( 'rich_text', 'hero_content', __( 'Content' ,THEME_TEXTDOMAIN ) )
            ->set_rows( 3 ),
        
            // Background Options
        Field::make( 'separator', 'hero_bg_separator', __( 'Background Options' ,THEME_TEXTDOMAIN ) ),
        Field::make( 'radio', 'hero_bg_options', 'Select Type Of Background',THEME_TEXTDOMAIN  )
            ->set_width( 40 )
            ->add_options( array(
                'image' => 'Static Image',
                'uploaded' => 'Self Hosted Video',
            ) ),
        
        //Hero Banner Image
        Field::make( 'image', 'hero_banner_image', __( 'Banner Image' ,THEME_TEXTDOMAIN ) )
        ->set_width( 60 )
        ->set_conditional_logic( array(
            array(
                'field' => 'hero_bg_options',
                'value' => 'image', // Optional, defaults to "". Should be an array if "IN" or "NOT IN" operators are used.
                'compare' => '=', // Optional, defaults to "=". Available operators: =, <, >, <=, >=, IN, NOT IN
            )
        ) ),
        // Background Video
        Field::make( 'file', 'hero_bg_video_link_file', __( 'Background Self-Hosted Video',THEME_TEXTDOMAIN  ) )
        ->set_width( 30 )
        ->set_conditional_logic( array(
            array(
                'field' => 'hero_bg_options',
                'value' => 'uploaded', // Optional, defaults to "". Should be an array if "IN" or "NOT IN" operators are used.
                'compare' => '=', // Optional, defaults to "=". Available operators: =, <, >, <=, >=, IN, NOT IN
            )
        ) ),
        Field::make( 'image', 'hero_bg_video_banner', __( 'Background Video Banner' ,THEME_TEXTDOMAIN ) )
        ->set_width( 30 )
        ->set_conditional_logic( array(
            array(
                'field' => 'hero_bg_options',
                'value' => 'uploaded', // Optional, defaults to "". Should be an array if "IN" or "NOT IN" operators are used.
                'compare' => '=', // Optional, defaults to "=". Available operators: =, <, >, <=, >=, IN, NOT IN
            )
        ) ),
        
        // pop-Up Video
        Field::make( 'separator', 'hero_pop_separator', __( 'Pop-up Video Options' ,THEME_TEXTDOMAIN ) ),
        Field::make( 'radio', 'hero_pop_video_options', 'Select Type of Pop-up Video',THEME_TEXTDOMAIN  )
        ->set_width( 40 )
            ->add_options( array(
                'youtube' => 'Youtube Video',
                'uploaded' => 'Self Hosted Video',
            ) ),
        Field::make( 'text', 'hero_pop_video_link', __( 'Pop-up YouTube Embed Video' ,THEME_TEXTDOMAIN ) )
        ->set_width( 60 )
        ->set_conditional_logic( array(
            array(
                'field' => 'hero_pop_video_options',
                'value' => 'youtube', // Optional, defaults to "". Should be an array if "IN" or "NOT IN" operators are used.
                'compare' => '=', // Optional, defaults to "=". Available operators: =, <, >, <=, >=, IN, NOT IN
            )
        ) ),
        Field::make( 'file', 'hero_pop_video_link_file', __( 'Pop-up Self-Hosted Video' ,THEME_TEXTDOMAIN ) )
        ->set_width( 30 )
        ->set_conditional_logic( array(
            array(
                'field' => 'hero_pop_video_options',
                'value' => 'uploaded', // Optional, defaults to "". Should be an array if "IN" or "NOT IN" operators are used.
                'compare' => '=', // Optional, defaults to "=". Available operators: =, <, >, <=, >=, IN, NOT IN
            )
        ) ),
        Field::make( 'image', 'hero_popup_bg_video_banner', __( 'Pop-up Video Banner' ,THEME_TEXTDOMAIN ) )
        ->set_width( 30 )
        ->set_conditional_logic( array(
            array(
                'field' => 'hero_pop_video_options',
                'value' => 'uploaded', // Optional, defaults to "". Should be an array if "IN" or "NOT IN" operators are used.
                'compare' => '=', // Optional, defaults to "=". Available operators: =, <, >, <=, >=, IN, NOT IN
            )
        ) ),

        // Button Complex section: start -------------------------------------------------------------------------------------------------------

        Field::make('complex', 'banner_button_complex', __('Banner Buttons', THEME_TEXTDOMAIN))
        ->set_layout('tabbed-horizontal')
        ->add_fields(array(
            Field::make( 'select', 'banner_button_type', __( 'Button Type' ,THEME_TEXTDOMAIN ) )
                ->set_width( 40 )
                ->set_options( array(
                    'link' => 'Link Button',
                    'popup' => 'Pop-Up Button',
                )),
            //Conditional Logic
            Field::make( 'urlpicker', 'hero_button_type_link', __( 'Link',THEME_TEXTDOMAIN  ) )
                ->set_width( 60 )
                ->set_conditional_logic( array(
                    array(
                        'field' => 'banner_button_type',
                        'value' => 'link', // Optional, defaults to “”. Should be an array if “IN” or “NOT IN” operators are used.
                        'compare' => '=', // Optional, defaults to “=”. Available operators: =, <, >, <=, >=, IN, NOT IN
                    )
                ) ),
            Field::make( 'select', 'hero_popup_button_select', __( 'Pop-Up Option' ,THEME_TEXTDOMAIN ) )
                ->set_width( 30 )
                ->set_options( array(
                    ' ' => '-- select --',
                    'fa' => 'Financing Application',
                ) )
                ->set_conditional_logic( array(
                    array(
                        'field' => 'banner_button_type',
                        'value' => 'popup', // Optional, defaults to “”. Should be an array if “IN” or “NOT IN” operators are used.
                        'compare' => '=', // Optional, defaults to “=”. Available operators: =, <, >, <=, >=, IN, NOT IN
                    )
                )),
            Field::make( 'text', 'hero_popup_button_text', __( 'Button Label' ,THEME_TEXTDOMAIN ) )
                ->set_width( 30 )
                ->set_conditional_logic( array(
                    array(
                        'field' => 'banner_button_type',
                        'value' => 'popup', // Optional, defaults to "". Should be an array if "IN" or "NOT IN" operators are used.
                        'compare' => '=', // Optional, defaults to "=". Available operators: =, <, >, <=, >=, IN, NOT IN
                    )
            ) ),
        )),
        
        // Button Cpmlex section: end -------------------------------------------------------------------------------------------------------
    ) )

    // How it Works
    // ->add_tab( __('"How It Works" Section',THEME_TEXTDOMAIN ), array(
    //     Field::make( 'radio', 'how_it_works_dials_options', 'Display:',THEME_TEXTDOMAIN  )
    //         ->add_options( array(
    //             'yes' => 'Yes',
    //             'no' => 'No',
    //         ) )
    // ) )
    
    // Content Section
    ->add_tab( __('Content Section',THEME_TEXTDOMAIN ), array(
        Field::make( 'radio', 'how_it_works_options', 'Display:',THEME_TEXTDOMAIN  )
                    ->add_options( array(
                        'yes' => 'Yes',
                        'no' => 'No',
                    ) ),
        Field::make( 'complex', 'cards_with_left_right_content', __( 'Card Content',THEME_TEXTDOMAIN  ))
            ->set_layout( 'tabbed-horizontal' )
            ->set_conditional_logic( array(
                array(
                    'field' => 'how_it_works_options',
                    'value' => 'yes', // Optional, defaults to "". Should be an array if "IN" or "NOT IN" operators are used.
                    'compare' => '=', // Optional, defaults to "=". Available operators: =, <, >, <=, >=, IN, NOT IN
                )
            ) )
            ->add_fields( array(
                Field::make( 'text', 'card_title', __('Title',THEME_TEXTDOMAIN ) ),
                Field::make( 'rich_text', 'card_content', __('Content',THEME_TEXTDOMAIN ) )
                ->set_width( 80 ),
                Field::make( 'image', 'card_image', __('Image',THEME_TEXTDOMAIN ) )
                ->set_width( 20 ),
            ) ),
    ))

    // How it works section ----- start

    ->add_tab( __('How It Works',THEME_TEXTDOMAIN ), array(

        Field::make( 'radio', 'how_it_works_dials_options', 'Display:',THEME_TEXTDOMAIN  )
            ->add_options( array(
                'yes' => 'Yes',
                'no' => 'No',
            ) ),

        Field::make( 'text', 'how_it_work_heading', __( 'Heading',THEME_TEXTDOMAIN  ) )
            ->set_help_text( __( 'Use "|" to Strong lin. (Use Once)' ) )
            ->set_conditional_logic( array(
                array(
                    'field' => 'how_it_works_dials_options',
                    'value' => 'yes', // Optional, defaults to "". Should be an array if "IN" or "NOT IN" operators are used.
                    'compare' => '=', // Optional, defaults to "=". Available operators: =, <, >, <=, >=, IN, NOT IN
                )
            ) ),

        Field::make( 'select', 'how_it_works_dials_count', 'Steps:',THEME_TEXTDOMAIN  )
            ->set_conditional_logic( array(
                array(
                    'field' => 'how_it_works_dials_options',
                    'value' => 'yes', // Optional, defaults to "". Should be an array if "IN" or "NOT IN" operators are used.
                    'compare' => '=', // Optional, defaults to "=". Available operators: =, <, >, <=, >=, IN, NOT IN
                )
            ) )
            ->set_options( array(
                '1' => 1,
                '2' => 2,
                '3' => 3,
                '4' => 4,
                '5' => 5,
                '6' => 6,
            ) ),

            Field::make( 'text', 'how_it_work_image_title_one', __( 'Title' ))
            ->set_width( 60 )
            ->set_conditional_logic( array(
                array(
                    'field' => 'how_it_works_dials_options',
                    'value' => 'yes', // Optional, defaults to "". Should be an array if "IN" or "NOT IN" operators are used.
                    'compare' => '=', // Optional, defaults to "=". Available operators: =, <, >, <=, >=, IN, NOT IN
                ),
                array(
                    'field' => 'how_it_works_dials_count',
                    'value' => '1', // Optional, defaults to "". Should be an array if "IN" or "NOT IN" operators are used.
                    'compare' => '=', // Optional, defaults to "=". Available operators: =, <, >, <=, >=, IN, NOT IN
                )
            ) ),

            Field::make( 'image', 'how_it_work_image_one', __( 'Image' ))
            ->set_width( 40 )
            ->set_conditional_logic( array(
                array(
                    'field' => 'how_it_works_dials_options',
                    'value' => 'yes', // Optional, defaults to "". Should be an array if "IN" or "NOT IN" operators are used.
                    'compare' => '=', // Optional, defaults to "=". Available operators: =, <, >, <=, >=, IN, NOT IN
                ),
                array(
                    'field' => 'how_it_works_dials_count',
                    'value' => '1', // Optional, defaults to "". Should be an array if "IN" or "NOT IN" operators are used.
                    'compare' => '=', // Optional, defaults to "=". Available operators: =, <, >, <=, >=, IN, NOT IN
                )
            ) ),
            
        Field::make( 'complex', 'how_it_work_image_with_title_two', __( 'Content' ))
            ->set_conditional_logic( array(
                array(
                    'field' => 'how_it_works_dials_options',
                    'value' => 'yes', // Optional, defaults to "". Should be an array if "IN" or "NOT IN" operators are used.
                    'compare' => '=', // Optional, defaults to "=". Available operators: =, <, >, <=, >=, IN, NOT IN
                ),
                array(
                    'field' => 'how_it_works_dials_count',
                    'value' => '2', // Optional, defaults to "". Should be an array if "IN" or "NOT IN" operators are used.
                    'compare' => '=', // Optional, defaults to "=". Available operators: =, <, >, <=, >=, IN, NOT IN
                )
            ) )
            ->set_layout( 'tabbed-horizontal' )
            ->add_fields( array(
                Field::make( 'text', 'how_it_work_image_title', __('Title',THEME_TEXTDOMAIN ) )
                ->set_width( 60 ),
                Field::make( 'image', 'how_it_work_image', __('Image',THEME_TEXTDOMAIN ) )
                ->set_width( 40 ),
            ))
            ->set_max( 2 ),

            Field::make( 'complex', 'how_it_work_image_with_title_three', __( 'Content' ))
            ->set_conditional_logic( array(
                array(
                    'field' => 'how_it_works_dials_options',
                    'value' => 'yes', // Optional, defaults to "". Should be an array if "IN" or "NOT IN" operators are used.
                    'compare' => '=', // Optional, defaults to "=". Available operators: =, <, >, <=, >=, IN, NOT IN
                ),
                array(
                    'field' => 'how_it_works_dials_count',
                    'value' => '3', // Optional, defaults to "". Should be an array if "IN" or "NOT IN" operators are used.
                    'compare' => '=', // Optional, defaults to "=". Available operators: =, <, >, <=, >=, IN, NOT IN
                )
            ) )
            ->set_layout( 'tabbed-horizontal' )
            ->add_fields( array(
                Field::make( 'text', 'how_it_work_image_title', __('Title',THEME_TEXTDOMAIN ) )
                ->set_width( 60 ),
                Field::make( 'image', 'how_it_work_image', __('Image',THEME_TEXTDOMAIN ) )
                ->set_width( 40 ),
            ))
            ->set_max( 3 ),

            Field::make( 'complex', 'how_it_work_image_with_title_four', __( 'Content' ))
            ->set_conditional_logic( array(
                array(
                    'field' => 'how_it_works_dials_options',
                    'value' => 'yes', // Optional, defaults to "". Should be an array if "IN" or "NOT IN" operators are used.
                    'compare' => '=', // Optional, defaults to "=". Available operators: =, <, >, <=, >=, IN, NOT IN
                ),
                array(
                    'field' => 'how_it_works_dials_count',
                    'value' => '4', // Optional, defaults to "". Should be an array if "IN" or "NOT IN" operators are used.
                    'compare' => '=', // Optional, defaults to "=". Available operators: =, <, >, <=, >=, IN, NOT IN
                )
            ) )
            ->set_layout( 'tabbed-horizontal' )
            ->add_fields( array(
                Field::make( 'text', 'how_it_work_image_title', __('Title',THEME_TEXTDOMAIN ) )
                ->set_width( 60 ),
                Field::make( 'image', 'how_it_work_image', __('Image',THEME_TEXTDOMAIN ) )
                ->set_width( 40 ),
            ))
            ->set_max( 4 ),

            Field::make( 'complex', 'how_it_work_image_with_title_five', __( 'Content' ))
            ->set_conditional_logic( array(
                array(
                    'field' => 'how_it_works_dials_options',
                    'value' => 'yes', // Optional, defaults to "". Should be an array if "IN" or "NOT IN" operators are used.
                    'compare' => '=', // Optional, defaults to "=". Available operators: =, <, >, <=, >=, IN, NOT IN
                ),
                array(
                    'field' => 'how_it_works_dials_count',
                    'value' => '5', // Optional, defaults to "". Should be an array if "IN" or "NOT IN" operators are used.
                    'compare' => '=', // Optional, defaults to "=". Available operators: =, <, >, <=, >=, IN, NOT IN
                )
            ) )
            ->set_layout( 'tabbed-horizontal' )
            ->add_fields( array(
                Field::make( 'text', 'how_it_work_image_title', __('Title',THEME_TEXTDOMAIN ) )
                ->set_width( 60 ),
                Field::make( 'image', 'how_it_work_image', __('Image',THEME_TEXTDOMAIN ) )
                ->set_width( 40 ),
            ))
            ->set_max( 5 ),

            Field::make( 'complex', 'how_it_work_image_with_title_six', __( 'Content' ))
            ->set_conditional_logic( array(
                array(
                    'field' => 'how_it_works_dials_options',
                    'value' => 'yes', // Optional, defaults to "". Should be an array if "IN" or "NOT IN" operators are used.
                    'compare' => '=', // Optional, defaults to "=". Available operators: =, <, >, <=, >=, IN, NOT IN
                ),
                array(
                    'field' => 'how_it_works_dials_count',
                    'value' => '6', // Optional, defaults to "". Should be an array if "IN" or "NOT IN" operators are used.
                    'compare' => '=', // Optional, defaults to "=". Available operators: =, <, >, <=, >=, IN, NOT IN
                )
            ) )
            ->set_layout( 'tabbed-horizontal' )
            ->add_fields( array(
                Field::make( 'text', 'how_it_work_image_title', __('Title',THEME_TEXTDOMAIN ) )
                ->set_width( 60 ),
                Field::make( 'image', 'how_it_work_image', __('Image',THEME_TEXTDOMAIN ) )
                ->set_width( 40 ),
            ))
            ->set_max( 6 )
    ) )
    // How it works section ----- end

    // Whom we work with section
    ->add_tab(__('Content List Section', THEME_TEXTDOMAIN), array(
        Field::make( 'radio', 'www_section_options', 'Display:',THEME_TEXTDOMAIN  )
                ->add_options( array(
                    'yes' => 'Yes',
                    'no' => 'No',
                ) ),
        Field::make('text', 'www_section_heading', __('Heading', THEME_TEXTDOMAIN))
        ->set_width( 50 )
        ->set_help_text( __( 'Use "|" to insert line break. (Use Once)' ) )
        ->set_conditional_logic( array(
            array(
                'field' => 'www_section_options',
                'value' => 'yes', // Optional, defaults to "". Should be an array if "IN" or "NOT IN" operators are used.
                'compare' => '=', // Optional, defaults to "=". Available operators: =, <, >, <=, >=, IN, NOT IN
            )
        ) ),
        Field::make('textarea', 'www_section_content', __('Content', THEME_TEXTDOMAIN))
        ->set_width( 50 )
        ->set_rows(8)
            ->set_conditional_logic( array(
                array(
                    'field' => 'www_section_options',
                    'value' => 'yes', // Optional, defaults to "". Should be an array if "IN" or "NOT IN" operators are used.
                    'compare' => '=', // Optional, defaults to "=". Available operators: =, <, >, <=, >=, IN, NOT IN
                )
            ) ),
        Field::make('complex', 'www_section_items', __('List', THEME_TEXTDOMAIN))
        ->set_layout('tabbed-horizontal')
        ->set_conditional_logic( array(
            array(
                'field' => 'www_section_options',
                'value' => 'yes', // Optional, defaults to "". Should be an array if "IN" or "NOT IN" operators are used.
                'compare' => '=', // Optional, defaults to "=". Available operators: =, <, >, <=, >=, IN, NOT IN
            )
        ) )
        ->add_fields(array(
            Field::make('text', 'www_section_accordion_items', __('List Item', THEME_TEXTDOMAIN)),
        )),
    ))
     
    // Benefits V1
    ->add_tab( __('Benefits V1',THEME_TEXTDOMAIN ), array(
        Field::make( 'radio', 'benefits_of_working_section_options', 'Display:',THEME_TEXTDOMAIN  )
        ->set_width( 100 )
                    ->add_options( array(
                        'yes' => 'Yes',
                        'no' => 'No',
                    ) ),
        Field::make( 'text', 'benefits_of_working_heading', __( 'Heading' ,THEME_TEXTDOMAIN ) )
        ->set_width( 50 )
            ->set_help_text( __( 'Use "|" to insert line break. (Use Once)' ) )
            ->set_conditional_logic( array(
                array(
                    'field' => 'benefits_of_working_section_options',
                    'value' => 'yes', // Optional, defaults to "". Should be an array if "IN" or "NOT IN" operators are used.
                    'compare' => '=', // Optional, defaults to "=". Available operators: =, <, >, <=, >=, IN, NOT IN
                )
            ) ),
        Field::make('rich_text', 'benefits_of_working_sub_heading', __('Sub Heading', THEME_TEXTDOMAIN))
        ->set_width( 50 )
        ->set_conditional_logic( array(
            array(
                'field' => 'benefits_of_working_section_options',
                'value' => 'yes', // Optional, defaults to "". Should be an array if "IN" or "NOT IN" operators are used.
                'compare' => '=', // Optional, defaults to "=". Available operators: =, <, >, <=, >=, IN, NOT IN
            )
        ) ),
        Field::make( 'image', 'benefits_of_working_bg_image', __('Background Image',THEME_TEXTDOMAIN ) )
        ->set_width( 50 )
            ->set_conditional_logic( array(
                array(
                    'field' => 'benefits_of_working_section_options',
                    'value' => 'yes', // Optional, defaults to "". Should be an array if "IN" or "NOT IN" operators are used.
                    'compare' => '=', // Optional, defaults to "=". Available operators: =, <, >, <=, >=, IN, NOT IN
                )
            ) ),
        Field::make( 'image', 'benefits_of_working_fg_image', __('Foreground Image',THEME_TEXTDOMAIN ) )
        ->set_width( 50 )
            ->set_conditional_logic( array(
                array(
                    'field' => 'benefits_of_working_section_options',
                    'value' => 'yes', // Optional, defaults to "". Should be an array if "IN" or "NOT IN" operators are used.
                    'compare' => '=', // Optional, defaults to "=". Available operators: =, <, >, <=, >=, IN, NOT IN
                )
            ) ),
        Field::make( 'complex', 'benefits_of_working_with_capitalplus_supply_cards', __( 'Benefit Cards',THEME_TEXTDOMAIN  ))
        ->set_width( 80 )
            ->set_layout( 'tabbed-horizontal' )
            ->set_conditional_logic( array(
                array(
                    'field' => 'benefits_of_working_section_options',
                    'value' => 'yes', // Optional, defaults to "". Should be an array if "IN" or "NOT IN" operators are used.
                    'compare' => '=', // Optional, defaults to "=". Available operators: =, <, >, <=, >=, IN, NOT IN
                )
            ) )
            ->add_fields( array(
                Field::make( 'textarea', 'benefits_of_working_content', __('Content',THEME_TEXTDOMAIN ) )
                    ->set_rows( 2 ),
            )),
    ))

    // Benefits V2
    ->add_tab(__('Benefits V2', THEME_TEXTDOMAIN), array(
        Field::make( 'radio', 'benefits_cards_section_options', 'Display:',THEME_TEXTDOMAIN  )
                    ->add_options( array(
                        'yes' => 'Yes',
                        'no' => 'No',
                    ) ),
        Field::make( 'text', 'benefits_of_working_card_heading', __( 'Heading' ,THEME_TEXTDOMAIN ) )
        ->set_width( 50 )
        ->set_help_text( __( 'Use "|" to insert line break. (Use Once)' ) )
        ->set_conditional_logic( array(
            array(
                'field' => 'benefits_cards_section_options',
                'value' => 'yes', // Optional, defaults to "". Should be an array if "IN" or "NOT IN" operators are used.
                'compare' => '=', // Optional, defaults to "=". Available operators: =, <, >, <=, >=, IN, NOT IN
            )
        ) ),
        Field::make('rich_text', 'benefits_of_working_card_heading_content', __('Content', THEME_TEXTDOMAIN))
        ->set_width( 50 )
        ->set_conditional_logic( array(
            array(
                'field' => 'benefits_cards_section_options',
                'value' => 'yes', // Optional, defaults to "". Should be an array if "IN" or "NOT IN" operators are used.
                'compare' => '=', // Optional, defaults to "=". Available operators: =, <, >, <=, >=, IN, NOT IN
            )
        ) ),
        Field::make('complex', 'benefits_of_working_with_capitalplus_cards', __('Benefit Cards', THEME_TEXTDOMAIN))
            ->set_layout('tabbed-horizontal')
            ->set_conditional_logic( array(
                array(
                    'field' => 'benefits_cards_section_options',
                    'value' => 'yes', // Optional, defaults to "". Should be an array if "IN" or "NOT IN" operators are used.
                    'compare' => '=', // Optional, defaults to "=". Available operators: =, <, >, <=, >=, IN, NOT IN
                )
            ) )
            ->add_fields(array(
                Field::make('text', 'benefits_of_working_title', __('Title', THEME_TEXTDOMAIN)),
                Field::make('image', 'benefits_of_working_card_image', __('Image', THEME_TEXTDOMAIN))
                ->set_width( 20 ),
                Field::make('rich_text', 'benefits_of_working_card_list', __('Card List', THEME_TEXTDOMAIN))
                ->set_width( 80 )
            )),
        Field::make('rich_text', 'benefits_of_working_main_list', __('Benefit List and Content', THEME_TEXTDOMAIN))
            ->set_conditional_logic( array(
                array(
                    'field' => 'benefits_cards_section_options',
                    'value' => 'yes', // Optional, defaults to "". Should be an array if "IN" or "NOT IN" operators are used.
                    'compare' => '=', // Optional, defaults to "=". Available operators: =, <, >, <=, >=, IN, NOT IN
                )
            ) ),
    ))

    // C2A
    ->add_tab(__('C2A', THEME_TEXTDOMAIN), array(
        Field::make( 'radio', 'cta_section_options', 'Display:',THEME_TEXTDOMAIN  )
        ->set_width( 50 )
                    ->add_options( array(
                        'yes' => 'Yes',
                        'no' => 'No',
                    ) ),
        Field::make('text', 'cta_heading', __('Heading', THEME_TEXTDOMAIN))
        ->set_width( 50 )
        ->set_conditional_logic( array(
            array(
                'field' => 'cta_section_options',
                'value' => 'yes', // Optional, defaults to "". Should be an array if "IN" or "NOT IN" operators are used.
                'compare' => '=', // Optional, defaults to "=". Available operators: =, <, >, <=, >=, IN, NOT IN
            )
        ) ),
        Field::make('textarea', 'cta_content', __('Content', THEME_TEXTDOMAIN))
        ->set_width( 50 )
            ->set_rows(2)
            ->set_conditional_logic( array(
                array(
                    'field' => 'cta_section_options',
                    'value' => 'yes', // Optional, defaults to "". Should be an array if "IN" or "NOT IN" operators are used.
                    'compare' => '=', // Optional, defaults to "=". Available operators: =, <, >, <=, >=, IN, NOT IN
                )
            ) ),
        Field::make('urlpicker', 'cta_link', __('Link', THEME_TEXTDOMAIN))
        ->set_width( 50 )
            ->set_conditional_logic( array(
                array(
                    'field' => 'cta_section_options',
                    'value' => 'yes', // Optional, defaults to "". Should be an array if "IN" or "NOT IN" operators are used.
                    'compare' => '=', // Optional, defaults to "=". Available operators: =, <, >, <=, >=, IN, NOT IN
                )
            ) ),
    ))

    // Video Section 

    ->add_tab( __('Video Section',THEME_TEXTDOMAIN ), array(

        Field::make( 'radio', 'service_video_section_options', 'Display:',THEME_TEXTDOMAIN  )
                    ->add_options( array(
                        'yes' => 'Yes',
                        'no' => 'No',
                    ) ),
        Field::make( 'text', 'cash_flow_side_content_heading', __('Heading',THEME_TEXTDOMAIN ) )
        ->set_width( 50 )
        ->set_conditional_logic( array(
            array(
                'field' => 'service_video_section_options',
                'value' => 'yes', // Optional, defaults to "". Should be an array if "IN" or "NOT IN" operators are used.
                'compare' => '=', // Optional, defaults to "=". Available operators: =, <, >, <=, >=, IN, NOT IN
            )
        ) ),
        Field::make( 'textarea', 'cash_flow_side_video_content', __('Content',THEME_TEXTDOMAIN ) )
        ->set_width( 50 )
        ->set_conditional_logic( array(
            array(
                'field' => 'service_video_section_options',
                'value' => 'yes', // Optional, defaults to "". Should be an array if "IN" or "NOT IN" operators are used.
                'compare' => '=', // Optional, defaults to "=". Available operators: =, <, >, <=, >=, IN, NOT IN
            )
        ) ),
        Field::make( 'text', 'cash_flow_video_banner_heading', __('Video Heading',THEME_TEXTDOMAIN ) )
        ->set_width( 50 )
        ->set_help_text( __( 'Use "|" to insert line break. (Use Once)' ) )
        ->set_conditional_logic( array(
            array(
                'field' => 'service_video_section_options',
                'value' => 'yes', // Optional, defaults to "". Should be an array if "IN" or "NOT IN" operators are used.
                'compare' => '=', // Optional, defaults to "=". Available operators: =, <, >, <=, >=, IN, NOT IN
            )
        ) ),
        Field::make( 'image', 'cash_flow_feature_image', __('Video Placeholder Image',THEME_TEXTDOMAIN ) )
        ->set_width( 50 )
            ->set_conditional_logic( array(
                array(
                    'field' => 'service_video_section_options',
                    'value' => 'yes', // Optional, defaults to "". Should be an array if "IN" or "NOT IN" operators are used.
                    'compare' => '=', // Optional, defaults to "=". Available operators: =, <, >, <=, >=, IN, NOT IN
                )
            ) ),
        Field::make( 'separator', 'popup_video_separator', __( 'Pop-up Video Options',THEME_TEXTDOMAIN ) )
            ->set_conditional_logic( array(
                array(
                    'field' => 'service_video_section_options',
                    'value' => 'yes', // Optional, defaults to "". Should be an array if "IN" or "NOT IN" operators are used.
                    'compare' => '=', // Optional, defaults to "=". Available operators: =, <, >, <=, >=, IN, NOT IN
                )
            ) ),

        Field::make( 'radio', 'cash_flow_video_options', __('Select Video Type',THEME_TEXTDOMAIN ) )
        ->set_width( 20 )
            ->add_options( array(
                'youtube' => 'Youtube',
                'uploaded' => 'Self-Hosted File',
            ) )
            ->set_conditional_logic( array(
                array(
                    'field' => 'service_video_section_options',
                    'value' => 'yes', // Optional, defaults to "". Should be an array if "IN" or "NOT IN" operators are used.
                    'compare' => '=', // Optional, defaults to "=". Available operators: =, <, >, <=, >=, IN, NOT IN
                )
            ) ),
        Field::make( 'text', 'cashflow_youtube_video_link', __( 'YouTube Video',THEME_TEXTDOMAIN  ) )
        ->set_width( 80 )
            ->set_conditional_logic( array(
                array(
                    'field' => 'service_video_section_options',
                    'value' => 'yes', // Optional, defaults to "". Should be an array if "IN" or "NOT IN" operators are used.
                    'compare' => '=', // Optional, defaults to "=". Available operators: =, <, >, <=, >=, IN, NOT IN
                ),
                array(
                    'field' => 'cash_flow_video_options',
                    'value' => 'youtube', // Optional, defaults to "". Should be an array if "IN" or "NOT IN" operators are used.
                    'compare' => '=', // Optional, defaults to "=". Available operators: =, <, >, <=, >=, IN, NOT IN
                )
            ) ),
        Field::make( 'file', 'cashflow_upload_video_link_file', __( 'Self-Hosted Video',THEME_TEXTDOMAIN  ) )
        ->set_width( 40 )
        ->set_conditional_logic( array(
            array(
                'field' => 'service_video_section_options',
                'value' => 'yes', // Optional, defaults to "". Should be an array if "IN" or "NOT IN" operators are used.
                'compare' => '=', // Optional, defaults to "=". Available operators: =, <, >, <=, >=, IN, NOT IN
            ),
            array(
                'field' => 'cash_flow_video_options',
                'value' => 'uploaded', // Optional, defaults to "". Should be an array if "IN" or "NOT IN" operators are used.
                'compare' => '=', // Optional, defaults to "=". Available operators: =, <, >, <=, >=, IN, NOT IN
            )
        ) ),
        Field::make( 'image', 'cash_flow_uploaded_video_banner_image', __('Self-Hosted Video Banner Image',THEME_TEXTDOMAIN ) )
        ->set_width( 40 )
            ->set_conditional_logic( array(
                array(
                    'field' => 'service_video_section_options',
                    'value' => 'yes', // Optional, defaults to "". Should be an array if "IN" or "NOT IN" operators are used.
                    'compare' => '=', // Optional, defaults to "=". Available operators: =, <, >, <=, >=, IN, NOT IN
                ),
                array(
                    'field' => 'cash_flow_video_options',
                    'value' => 'uploaded', // Optional, defaults to "". Should be an array if "IN" or "NOT IN" operators are used.
                    'compare' => '=', // Optional, defaults to "=". Available operators: =, <, >, <=, >=, IN, NOT IN
                )
            ) ),
    ) );


        





    
    
    
    
        
    