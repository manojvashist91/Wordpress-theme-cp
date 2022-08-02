<?php

use Carbon_Fields\Container;
use Carbon_Fields\Field;

Container::make('term_meta', __('Services Category Setting'))
    ->show_on_taxonomy('service-category')
    ->add_fields( array(
        Field::make( 'text', 'card_sub_heading', __( 'Sub-heading',THEME_TEXTDOMAIN ) ),
        Field::make( 'image', 'service_category_image', __( 'Service Category Image' )),
        Field::make( 'radio', 'services_video_options', 'Select Type of Video' )
            ->add_options( array(
                'youtube' => 'Youtube',
                'uploaded' => 'Uploaded File',
            ) ),
        Field::make( 'text', 'services_video_link', __( 'YouTube Video URL' ) )
            ->set_conditional_logic( array(
                array(
                    'field' => 'services_video_options',
                    'value' => 'youtube', // Optional, defaults to “”. Should be an array if “IN” or “NOT IN” operators are used.
                    'compare' => '=', // Optional, defaults to “=”. Available operators: =, <, >, <=, >=, IN, NOT IN
                )
            ) ),
        Field::make( 'file', 'services_video_link_file', __( 'Upload Video' ) )
            ->set_conditional_logic( array(
                array(
                    'field' => 'services_video_options',
                    'value' => 'uploaded', // Optional, defaults to “”. Should be an array if “IN” or “NOT IN” operators are used.
                    'compare' => '=', // Optional, defaults to “=”. Available operators: =, <, >, <=, >=, IN, NOT IN
                )
            ) ),
    ))
    ->add_tab( __('Hero Section',THEME_TEXTDOMAIN ), array(

    //Hero Heading
    Field::make( 'text', 'hero_heading', __( 'Heading',THEME_TEXTDOMAIN ) )
        ->set_help_text( __( 'Use "|" to insert line break. (Use Once)' ) ),
    Field::make( 'rich_text', 'hero_content', __( 'Content' ,THEME_TEXTDOMAIN ) )
        ->set_rows( 3 ),

    // Background Options

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
    ->add_tab(__('Child Services Section', THEME_TEXTDOMAIN), array(
        Field::make( 'radio', 'working_capital_options', 'Display:',THEME_TEXTDOMAIN  )
            ->set_width( 50 )
            ->add_options( array(
                'yes' => 'Yes',
                'no' => 'No',
            ) ),
        Field::make('text', 'working_capital_heading', __('Heading', THEME_TEXTDOMAIN))
            ->set_width( 50 )
            ->set_conditional_logic( array(
                array(
                    'field' => 'working_capital_options',
                    'value' => 'yes', // Optional, defaults to "". Should be an array if "IN" or "NOT IN" operators are used.
                    'compare' => '=', // Optional, defaults to "=". Available operators: =, <, >, <=, >=, IN, NOT IN
                )
            ) )
            ->set_help_text(__('Use "|" to insert line break. (Use Once)')),
    ))
    // ->add_tab( __('"How It Works" Section',THEME_TEXTDOMAIN ), array(
    //     Field::make( 'radio', 'how_it_works_dials_options', 'Display:',THEME_TEXTDOMAIN  )
    //         ->add_options( array(
    //             'yes' => 'Yes',
    //             'no' => 'No',
    //         ) )
    // ) )

    // How it works section ----- start

    ->add_tab( __('How It Works',THEME_TEXTDOMAIN ), array(

        Field::make( 'radio', 'cat_how_it_works_dials_options', 'Display:',THEME_TEXTDOMAIN  )
            ->add_options( array(
                'yes' => 'Yes',
                'no' => 'No',
            ) ),

        Field::make( 'text', 'cat_how_it_work_heading', __( 'Heading',THEME_TEXTDOMAIN  ) )
            ->set_help_text( __( 'Use "|" to Strong lin. (Use Once)' ) )
            ->set_conditional_logic( array(
                array(
                    'field' => 'cat_how_it_works_dials_options',
                    'value' => 'yes', // Optional, defaults to "". Should be an array if "IN" or "NOT IN" operators are used.
                    'compare' => '=', // Optional, defaults to "=". Available operators: =, <, >, <=, >=, IN, NOT IN
                )
            ) ),

        Field::make( 'select', 'cat_how_it_works_dials_count', 'Steps:',THEME_TEXTDOMAIN  )
            ->set_conditional_logic( array(
                array(
                    'field' => 'cat_how_it_works_dials_options',
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

            Field::make( 'text', 'cat_how_it_work_image_title_one', __( 'Title' ))
            ->set_width( 60 )
            ->set_conditional_logic( array(
                array(
                    'field' => 'cat_how_it_works_dials_options',
                    'value' => 'yes', // Optional, defaults to "". Should be an array if "IN" or "NOT IN" operators are used.
                    'compare' => '=', // Optional, defaults to "=". Available operators: =, <, >, <=, >=, IN, NOT IN
                ),
                array(
                    'field' => 'cat_how_it_works_dials_count',
                    'value' => '1', // Optional, defaults to "". Should be an array if "IN" or "NOT IN" operators are used.
                    'compare' => '=', // Optional, defaults to "=". Available operators: =, <, >, <=, >=, IN, NOT IN
                )
            ) ),

            Field::make( 'image', 'cat_how_it_work_image_one', __( 'Image' ))
            ->set_width( 40 )
            ->set_conditional_logic( array(
                array(
                    'field' => 'cat_how_it_works_dials_options',
                    'value' => 'yes', // Optional, defaults to "". Should be an array if "IN" or "NOT IN" operators are used.
                    'compare' => '=', // Optional, defaults to "=". Available operators: =, <, >, <=, >=, IN, NOT IN
                ),
                array(
                    'field' => 'cat_how_it_works_dials_count',
                    'value' => '1', // Optional, defaults to "". Should be an array if "IN" or "NOT IN" operators are used.
                    'compare' => '=', // Optional, defaults to "=". Available operators: =, <, >, <=, >=, IN, NOT IN
                )
            ) ),
            
        Field::make( 'complex', 'cat_how_it_work_image_with_title_two', __( 'Content' ))
            ->set_conditional_logic( array(
                array(
                    'field' => 'cat_how_it_works_dials_options',
                    'value' => 'yes', // Optional, defaults to "". Should be an array if "IN" or "NOT IN" operators are used.
                    'compare' => '=', // Optional, defaults to "=". Available operators: =, <, >, <=, >=, IN, NOT IN
                ),
                array(
                    'field' => 'cat_how_it_works_dials_count',
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

            Field::make( 'complex', 'cat_how_it_work_image_with_title_three', __( 'Content' ))
            ->set_conditional_logic( array(
                array(
                    'field' => 'cat_how_it_works_dials_options',
                    'value' => 'yes', // Optional, defaults to "". Should be an array if "IN" or "NOT IN" operators are used.
                    'compare' => '=', // Optional, defaults to "=". Available operators: =, <, >, <=, >=, IN, NOT IN
                ),
                array(
                    'field' => 'cat_how_it_works_dials_count',
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

            Field::make( 'complex', 'cat_how_it_work_image_with_title_four', __( 'Content' ))
            ->set_conditional_logic( array(
                array(
                    'field' => 'cat_how_it_works_dials_options',
                    'value' => 'yes', // Optional, defaults to "". Should be an array if "IN" or "NOT IN" operators are used.
                    'compare' => '=', // Optional, defaults to "=". Available operators: =, <, >, <=, >=, IN, NOT IN
                ),
                array(
                    'field' => 'cat_how_it_works_dials_count',
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

            Field::make( 'complex', 'cat_how_it_work_image_with_title_five', __( 'Content' ))
            ->set_conditional_logic( array(
                array(
                    'field' => 'cat_how_it_works_dials_options',
                    'value' => 'yes', // Optional, defaults to "". Should be an array if "IN" or "NOT IN" operators are used.
                    'compare' => '=', // Optional, defaults to "=". Available operators: =, <, >, <=, >=, IN, NOT IN
                ),
                array(
                    'field' => 'cat_how_it_works_dials_count',
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

            Field::make( 'complex', 'cat_how_it_work_image_with_title_six', __( 'Content' ))
            ->set_conditional_logic( array(
                array(
                    'field' => 'cat_how_it_works_dials_options',
                    'value' => 'yes', // Optional, defaults to "". Should be an array if "IN" or "NOT IN" operators are used.
                    'compare' => '=', // Optional, defaults to "=". Available operators: =, <, >, <=, >=, IN, NOT IN
                ),
                array(
                    'field' => 'cat_how_it_works_dials_count',
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

    ->add_tab(__('Video and Content Section', THEME_TEXTDOMAIN), array(
        Field::make( 'radio', 'cash_flow_options', 'Display:',THEME_TEXTDOMAIN  )
            ->add_options( array(
                'yes' => 'Yes',
                'no' => 'No',
            ) ),
        Field::make('text', 'cash_flow_heading', __('Heading', THEME_TEXTDOMAIN))
            ->set_width( 100 )
            ->set_conditional_logic( array(
                array(
                    'field' => 'cash_flow_options',
                    'value' => 'yes', // Optional, defaults to "". Should be an array if "IN" or "NOT IN" operators are used.
                    'compare' => '=', // Optional, defaults to "=". Available operators: =, <, >, <=, >=, IN, NOT IN
                )
            ) ),
        Field::make('textarea', 'cash_flow_content', __('Content', THEME_TEXTDOMAIN))
        ->set_width( 100 )
        ->set_conditional_logic( array(
            array(
                'field' => 'cash_flow_options',
                'value' => 'yes', // Optional, defaults to "". Should be an array if "IN" or "NOT IN" operators are used.
                'compare' => '=', // Optional, defaults to "=". Available operators: =, <, >, <=, >=, IN, NOT IN
            )
        ) )
        ->set_rows(8),
        Field::make( 'text', 'cat_cash_flow_video_banner_heading', __('Video Heading',THEME_TEXTDOMAIN ) )
        ->set_width( 100 )
        ->set_help_text( __( 'Use "|" to insert line break. (Use Once)' ) )
        ->set_conditional_logic( array(
            array(
                'field' => 'cash_flow_options',
                'value' => 'yes', // Optional, defaults to "". Should be an array if "IN" or "NOT IN" operators are used.
                'compare' => '=', // Optional, defaults to "=". Available operators: =, <, >, <=, >=, IN, NOT IN
            )
        ) ),
        Field::make('image', 'cash_flow_feature_image', __('Featured Image', THEME_TEXTDOMAIN))
            ->set_conditional_logic( array(
                array(
                    'field' => 'cash_flow_options',
                    'value' => 'yes', // Optional, defaults to "". Should be an array if "IN" or "NOT IN" operators are used.
                    'compare' => '=', // Optional, defaults to "=". Available operators: =, <, >, <=, >=, IN, NOT IN
                )
            ) ),
        Field::make('radio', 'cash_flow_video_options', __('Select Type of Video', THEME_TEXTDOMAIN))
            ->set_width( 40 )
            ->set_conditional_logic( array(
                array(
                    'field' => 'cash_flow_options',
                    'value' => 'yes', // Optional, defaults to "". Should be an array if "IN" or "NOT IN" operators are used.
                    'compare' => '=', // Optional, defaults to "=". Available operators: =, <, >, <=, >=, IN, NOT IN
                )
            ) )
            ->add_options(array(
                'youtube' => 'Youtube',
                'uploaded' => 'Uploaded File',
            )),

        Field::make( 'text', 'cashflow_youtube_video_link', __( 'YouTube Embed Video',THEME_TEXTDOMAIN  ) )
            ->set_width( 60 )
            ->set_conditional_logic( array(
                'relation' => 'AND',
                array(
                    'field' => 'cash_flow_video_options',
                    'value' => 'youtube', // Optional, defaults to "". Should be an array if "IN" or "NOT IN" operators are used.
                    'compare' => '=', // Optional, defaults to "=". Available operators: =, <, >, <=, >=, IN, NOT IN
                ),
                array(
                    'field' => 'cash_flow_options',
                    'value' => 'yes', // Optional, defaults to "". Should be an array if "IN" or "NOT IN" operators are used.
                    'compare' => '=', // Optional, defaults to "=". Available operators: =, <, >, <=, >=, IN, NOT IN
                )
            ) ),
        Field::make( 'file', 'cashflow_upload_video_link_file', __( 'Self-Hosted Video',THEME_TEXTDOMAIN  ) )
            ->set_width( 30 )
            ->set_conditional_logic( array(
                'relation' => 'AND',
                array(
                    'field' => 'cash_flow_video_options',
                    'value' => 'uploaded', // Optional, defaults to "". Should be an array if "IN" or "NOT IN" operators are used.
                    'compare' => '=', // Optional, defaults to "=". Available operators: =, <, >, <=, >=, IN, NOT IN
                ),
                array(
                    'field' => 'cash_flow_options',
                    'value' => 'yes', // Optional, defaults to "". Should be an array if "IN" or "NOT IN" operators are used.
                    'compare' => '=', // Optional, defaults to "=". Available operators: =, <, >, <=, >=, IN, NOT IN
                )
            ) ),

        Field::make( 'file', 'cashflow_upload_video_file_banner', __( 'Self-Hosted Video Banner',THEME_TEXTDOMAIN  ) )
            ->set_width( 30 )
            ->set_conditional_logic( array(
                'relation' => 'AND',
                array(
                    'field' => 'cash_flow_video_options',
                    'value' => 'uploaded', // Optional, defaults to "". Should be an array if "IN" or "NOT IN" operators are used.
                    'compare' => '=', // Optional, defaults to "=". Available operators: =, <, >, <=, >=, IN, NOT IN
                ),
                array(
                    'field' => 'cash_flow_options',
                    'value' => 'yes', // Optional, defaults to "". Should be an array if "IN" or "NOT IN" operators are used.
                    'compare' => '=', // Optional, defaults to "=". Available operators: =, <, >, <=, >=, IN, NOT IN
                )
            ) )
    ))
    ->add_tab( __('Case Studies Section',THEME_TEXTDOMAIN ), array(
        Field::make( 'radio', 'case_studies_options', 'Display:',THEME_TEXTDOMAIN  )
            ->add_options( array(
                'yes' => 'Yes',
                'no' => 'No',
            ) )
    ) )
    ->add_tab(__('C2A Section', THEME_TEXTDOMAIN), array(
        Field::make( 'radio', 'cta_options', 'Display:',THEME_TEXTDOMAIN  )
            ->add_options( array(
                'yes' => 'Yes',
                'no' => 'No',
            ) ),
        Field::make('text', 'cta_heading', __('Heading', THEME_TEXTDOMAIN))
            ->set_width( 40 )
            ->set_conditional_logic( array(
                array(
                    'field' => 'cta_options',
                    'value' => 'yes', // Optional, defaults to "". Should be an array if "IN" or "NOT IN" operators are used.
                    'compare' => '=', // Optional, defaults to "=". Available operators: =, <, >, <=, >=, IN, NOT IN
                )
            ) ),
        Field::make('textarea', 'cta_content', __('Content', THEME_TEXTDOMAIN))
            ->set_width( 100 )
            ->set_conditional_logic( array(
                array(
                    'field' => 'cta_options',
                    'value' => 'yes', // Optional, defaults to "". Should be an array if "IN" or "NOT IN" operators are used.
                    'compare' => '=', // Optional, defaults to "=". Available operators: =, <, >, <=, >=, IN, NOT IN
                )
            ) )
            ->set_rows(8),
        Field::make('urlpicker', 'cta_link', __('Link', THEME_TEXTDOMAIN))
            ->set_conditional_logic( array(
                array(
                    'field' => 'cta_options',
                    'value' => 'yes', // Optional, defaults to "". Should be an array if "IN" or "NOT IN" operators are used.
                    'compare' => '=', // Optional, defaults to "=". Available operators: =, <, >, <=, >=, IN, NOT IN
                )
            ) ),
    ));