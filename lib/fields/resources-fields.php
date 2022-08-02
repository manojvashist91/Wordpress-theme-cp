<?php

use Carbon_Fields\Container;
use Carbon_Fields\Field;

Container::make('post_meta', __('Resource Settings'))
    ->where('post_type', '=', 'post')

    // Header Section
    ->add_tab(__('General', THEME_TEXTDOMAIN), array(
        Field::make( 'radio', 'resource_card_design', 'Card Layout',THEME_TEXTDOMAIN)
            ->add_options( array(
                'bg-no' => 'White Background',
                'bg-yes' => 'Image Background',
            ) ),
        Field::make('image', 'resources_page_banner_image', __('Banner Image',THEME_TEXTDOMAIN))
        ->set_width( 100 ),
    ))

    // Content Section
    ->add_tab( __('Resource Content',THEME_TEXTDOMAIN ), array(

        Field::make( 'radio', 'type_of_resource', 'Type Of Resource:',THEME_TEXTDOMAIN)
            ->add_options( array(
                'blog-news' => 'General Blog or News',
                'podcast' => 'Podcast',
            ) ),

        Field::make( 'radio', 'type_of_podcast', 'Podcast Source:',THEME_TEXTDOMAIN)
            ->set_conditional_logic( array(
                array(
                    'field' => 'type_of_resource',
                    'value' => 'podcast', // Optional, defaults to "". Should be an array if "IN" or "NOT IN" operators are used.
                    'compare' => '=', // Optional, defaults to "=". Available operators: =, <, >, <=, >=, IN, NOT IN
                )
            ) )
            ->add_options( array(
                'self-hosted' => 'Self-Hosted',
                'embed' => 'Embed',
            ) ),
        Field::make( 'text', 'resources_podcast_audio_url', __('URL',THEME_TEXTDOMAIN ))
            ->set_conditional_logic( array(
                array(
                    'field' => 'type_of_podcast',
                    'value' => 'embed', // Optional, defaults to "". Should be an array if "IN" or "NOT IN" operators are used.
                    'compare' => '=', // Optional, defaults to "=". Available operators: =, <, >, <=, >=, IN, NOT IN
                )
            ) ),
        Field::make( 'text', 'resources_podcast_audio_title', __('Podcast Title',THEME_TEXTDOMAIN ))
        ->set_conditional_logic( array(
            array(
                'field' => 'type_of_podcast',
                'value' => 'self-hosted', // Optional, defaults to "". Should be an array if "IN" or "NOT IN" operators are used.
                'compare' => '=', // Optional, defaults to "=". Available operators: =, <, >, <=, >=, IN, NOT IN
            )
        ) ),
        Field::make( 'file', 'resources_podcast_audio', __('Podcast Audio',THEME_TEXTDOMAIN ))
        ->set_conditional_logic( array(
            array(
                'field' => 'type_of_podcast',
                'value' => 'self-hosted', // Optional, defaults to "". Should be an array if "IN" or "NOT IN" operators are used.
                'compare' => '=', // Optional, defaults to "=". Available operators: =, <, >, <=, >=, IN, NOT IN
            )
        ) ),
        Field::make('image', 'resources_page_video_placeholder', __('Video Placeholder',THEME_TEXTDOMAIN))
        ->set_width( 20 )
            ->set_value_type( 'url' )
            ->set_conditional_logic( array(
                array(
                    'field' => 'type_of_resource',
                    'value' => 'blog-news', // Optional, defaults to "". Should be an array if "IN" or "NOT IN" operators are used.
                    'compare' => '=', // Optional, defaults to "=". Available operators: =, <, >, <=, >=, IN, NOT IN
                )
            ) ),
        Field::make( 'radio', 'resources_video_options', __('Select Type of Video',THEME_TEXTDOMAIN ))
        ->set_width( 20 )
        ->set_conditional_logic( array(
            array(
                'field' => 'type_of_resource',
                'value' => 'blog-news', // Optional, defaults to "". Should be an array if "IN" or "NOT IN" operators are used.
                'compare' => '=', // Optional, defaults to "=". Available operators: =, <, >, <=, >=, IN, NOT IN
            )
        ) )
        ->add_options( array(
            'youtube' => 'YouTube',
            'uploaded' => 'Self-Hosted Video',
        ) ),
        Field::make( 'text', 'resources_video_link', __( 'YouTube Video URL',THEME_TEXTDOMAIN ) )
        ->set_width( 60 )
        ->set_conditional_logic( array(
            array(
                'field' => 'type_of_resource',
                'value' => 'blog-news', // Optional, defaults to "". Should be an array if "IN" or "NOT IN" operators are used.
                'compare' => '=', // Optional, defaults to "=". Available operators: =, <, >, <=, >=, IN, NOT IN
            ),
            array(
                'field' => 'resources_video_options',
                'value' => 'youtube', // Optional, defaults to "". Should be an array if "IN" or "NOT IN" operators are used.
                'compare' => '=', // Optional, defaults to "=". Available operators: =, <, >, <=, >=, IN, NOT IN
            )
        ) ),
        Field::make( 'file', 'resources_video_link_file', __( 'Self-Hosted Video',THEME_TEXTDOMAIN ))
        ->set_width( 30 )
        ->set_conditional_logic( array(
            array(
                'field' => 'type_of_resource',
                'value' => 'blog-news', // Optional, defaults to "". Should be an array if "IN" or "NOT IN" operators are used.
                'compare' => '=', // Optional, defaults to "=". Available operators: =, <, >, <=, >=, IN, NOT IN
            ),
            array(
                'field' => 'resources_video_options',
                'value' => 'uploaded', // Optional, defaults to "". Should be an array if "IN" or "NOT IN" operators are used.
                'compare' => '=', // Optional, defaults to "=". Available operators: =, <, >, <=, >=, IN, NOT IN
            )
        ) ),
        Field::make('image', 'resources_page_uploaded_video_banner', __('Self-Hosted Video Banner',THEME_TEXTDOMAIN))
        ->set_width( 30 )
            ->set_value_type( 'url' )
            ->set_conditional_logic( array(
                array(
                    'field' => 'type_of_resource',
                    'value' => 'blog-news', // Optional, defaults to "". Should be an array if "IN" or "NOT IN" operators are used.
                    'compare' => '=', // Optional, defaults to "=". Available operators: =, <, >, <=, >=, IN, NOT IN
                ),
                array(
                    'field' => 'resources_video_options',
                    'value' => 'uploaded', // Optional, defaults to "". Should be an array if "IN" or "NOT IN" operators are used.
                    'compare' => '=', // Optional, defaults to "=". Available operators: =, <, >, <=, >=, IN, NOT IN
                )
        ) ),
) );
