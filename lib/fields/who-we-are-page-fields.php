<?php
use Carbon_Fields\Container;
use Carbon_Fields\Field;

Container::make( 'post_meta', __('Who We Are Page Settings ',THEME_TEXTDOMAIN) )
    ->where( 'post_type', '=', 'page' )
    ->where( 'post_template', '=', 'page-templates/who-we-are-template.php' )
    ->add_tab( __('Hero Slider',THEME_TEXTDOMAIN ), array(

        //Hero Heading
        Field::make( 'text', 'hero_heading', __( 'Heading',THEME_TEXTDOMAIN ) )
            ->set_help_text( __( 'Use "|" to insert line break. (Use Once)' ) ),
        Field::make( 'rich_text', 'hero_content', __( 'Content' ,THEME_TEXTDOMAIN ) )
            ->set_rows( 3 ),

        // Background Options
        Field::make( 'separator', 'hero_bg_separator', __( 'Background Options' ,THEME_TEXTDOMAIN ) ),
        Field::make( 'radio', 'hero_bg_options', 'Select Type of Background',THEME_TEXTDOMAIN  )
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
        Field::make( 'file', 'hero_bg_video_link_file', __( 'Self-Hosted Video',THEME_TEXTDOMAIN  ) )
        ->set_width( 30 )
            ->set_conditional_logic( array(
                array(
                    'field' => 'hero_bg_options',
                    'value' => 'uploaded', // Optional, defaults to "". Should be an array if "IN" or "NOT IN" operators are used.
                    'compare' => '=', // Optional, defaults to "=". Available operators: =, <, >, <=, >=, IN, NOT IN
                )
            ) ),
        Field::make( 'image', 'hero_bg_video_banner', __( 'Self-Hosted Video Banner' ,THEME_TEXTDOMAIN ) )
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
                'uploaded' => 'Self-Hosted Video',
            ) ),
        Field::make( 'text', 'hero_pop_video_link', __( 'YouTube Embed Video' ,THEME_TEXTDOMAIN ) )
        ->set_width( 60 )
            ->set_conditional_logic( array(
                array(
                    'field' => 'hero_pop_video_options',
                    'value' => 'youtube', // Optional, defaults to "". Should be an array if "IN" or "NOT IN" operators are used.
                    'compare' => '=', // Optional, defaults to "=". Available operators: =, <, >, <=, >=, IN, NOT IN
                )
            ) ),
        Field::make( 'file', 'hero_pop_video_link_file', __( 'Self-Hosted Video' ,THEME_TEXTDOMAIN ) )
        ->set_width( 30 )
            ->set_conditional_logic( array(
                array(
                    'field' => 'hero_pop_video_options',
                    'value' => 'uploaded', // Optional, defaults to "". Should be an array if "IN" or "NOT IN" operators are used.
                    'compare' => '=', // Optional, defaults to "=". Available operators: =, <, >, <=, >=, IN, NOT IN
                )
            ) ),
        Field::make( 'image', 'hero_popup_bg_video_banner', __( 'Self-Hosted Video Banner' ,THEME_TEXTDOMAIN ) )
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
    ->add_tab( __('We Help Construction Businesses',THEME_TEXTDOMAIN), array(
        Field::make( 'text', 'we_help_construction_businesses_heading_line_1', __( 'Heading',THEME_TEXTDOMAIN  ) )
            ->set_help_text( __( 'Use "|" to Strong line. (Use Once)' ) ),
        Field::make( 'rich_text', 'we_help_construction_businesses_content', __( 'Content',THEME_TEXTDOMAIN ) )
    ))

    ->add_tab( __('What Sets Us Apart',THEME_TEXTDOMAIN), array(
        Field::make( 'text', 'what_sets_us_apart_heading_1', __( 'Heading',THEME_TEXTDOMAIN  ) )
            ->set_help_text( __( 'Use "|" to Strong line. (Use Once)' ) ),
        Field::make( 'complex', 'what_sets_us_apart_cards', __('Features',THEME_TEXTDOMAIN) )
            ->set_layout( 'tabbed-horizontal' )
            ->add_fields( array(
                Field::make( 'text', 'what_sets_us_apart_cards_title', __('Title',THEME_TEXTDOMAIN) ),
                Field::make( 'image', 'what_sets_us_apart_cards_image', __('Image',THEME_TEXTDOMAIN) )
                ->set_width( 20 ),
                Field::make( 'complex', 'what_sets_us_apart_cards', __('Cards List',THEME_TEXTDOMAIN) )
                ->set_width( 80 )
                    ->set_layout( 'tabbed-horizontal' )
                    ->add_fields( array(
                        Field::make( 'rich_text', 'what_sets_us_apart_cards_list', __('Add List',THEME_TEXTDOMAIN) )
                    ))
            ) ),
    ) )
    ->add_tab( __('Our Story',THEME_TEXTDOMAIN), array(
        Field::make( 'text', 'our_story_heading', __( 'Heading',THEME_TEXTDOMAIN ) )
            ->set_help_text( __( 'Use "|" to Strong line. (Use Once)' ) ),
        Field::make( 'image', 'our_story_background_image', __('Background Image',THEME_TEXTDOMAIN) )
        ->set_width( 50 ),
        Field::make( 'image', 'our_story_right_side_image', __('Foreground Image',THEME_TEXTDOMAIN) )
        ->set_width( 50 ),
        Field::make( 'rich_text', 'our_story_heading_content', __('Content',THEME_TEXTDOMAIN) ),
    ));

