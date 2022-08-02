<?php

use Carbon_Fields\Container;
use Carbon_Fields\Field;

$basic_options_container = Container::make( 'theme_options', __('Theme Options', THEME_TEXTDOMAIN) )
	->add_tab(
        __('General', THEME_TEXTDOMAIN),
        array(
			Field::make( 'image', 'site_logo', __('Desktop Logo', THEME_TEXTDOMAIN))
                ->set_width(20),
            Field::make( 'image', 'site_logo_mobile', __('Mobile Logo', THEME_TEXTDOMAIN))
                ->set_width(20),
            Field::make( 'image', 'logo_icon', __('Logo Icon', THEME_TEXTDOMAIN) )
                ->set_width(20),
            Field::make( 'image', 'logo_raster_colorful', __('Logo Raster (Colorful)', THEME_TEXTDOMAIN) )
                ->set_width(20),
            Field::make( 'image', 'logo_raster_white', __('Logo Raster (White)', THEME_TEXTDOMAIN) )
                ->set_width(20),
        )
	)
    ->add_tab(
        __('Socials', THEME_TEXTDOMAIN),
        array(

            Field::make( 'text', 'social_url_linkedin', __('LinkedIn URL', THEME_TEXTDOMAIN))
                ->set_help_text( __('Enter your LinkedIn page url', THEME_TEXTDOMAIN) ),
             Field::make( 'text', 'social_url_facebook', __('Facebook URL', THEME_TEXTDOMAIN) )
                 ->set_help_text( __('Enter your Facebook page url', THEME_TEXTDOMAIN) ),
             Field::make( 'text', 'social_url_twitter', __('Twitter URL', THEME_TEXTDOMAIN) )
                ->set_help_text( __('Enter your Twitter profile url', THEME_TEXTDOMAIN) ),
        )
	)
    ->add_tab( __('Office Locations'), array(

        Field::make( 'text', 'email', __('Email', THEME_TEXTDOMAIN) )
            ->set_help_text( __('Enter Your Email Address Show On Top Header Bar' , THEME_TEXTDOMAIN)),
        Field::make( 'text', 'phone', __('Phone Number' , THEME_TEXTDOMAIN))
            ->set_help_text( __('Enter Your Phone Number Show On Top Header Bar.', THEME_TEXTDOMAIN) ),
        Field::make( 'text', 'spanish-speaking-phone-number', __('Phone Number for Spanish-speaking Customers' , THEME_TEXTDOMAIN))
            ->set_help_text( __('Enter Your  Phone Number for Spanish-speaking Customers Show On Top Header Bar.', THEME_TEXTDOMAIN) ),
        Field::make( 'text', 'spanish-text', __('Spanish Text' , THEME_TEXTDOMAIN))
            ->set_help_text( __('Enter Your Text Show below The Phone Number of Spanish-speaking Customers Show On Top Header Bar.', THEME_TEXTDOMAIN) ),
        Field::make( 'complex', 'office_locations', __( 'Office Locations' ) )
            ->set_layout('tabbed-horizontal')
            ->add_fields( array(
                Field::make( 'text', 'address_heading_theme_options', __( 'Address Heading' ) ),
                Field::make( 'textarea', 'contact_us_address_theme_options', __( 'Address' ) ),
                Field::make( 'text', 'contact_us_contact_number_theme_options', __( 'Contact Number' ) ),
                Field::make( 'text', 'contact_us_fax_number_theme_options', __( 'Fax' ) ),
                Field::make( 'text', 'contact_us_email_theme_options', __( 'Email Address' ) ),
                Field::make( 'image', 'map_image', __( 'Location Image' ))
                    ->set_value_type( 'url' )  // Set url type due to used inside the js file.
                    ->set_help_text( __( 'Image showing inside the map popup' ) ),
                Field::make( 'map', 'google_map_locations_theme_options', __( 'Location' ) )
                    ->set_help_text( __( 'drag and drop the pin on the map to select location' ) ),

            ) ),
    ) )
    ->add_tab(
        __('Default Post Thumb', THEME_TEXTDOMAIN),
        array(
            Field::make( 'image', 'default_post_thumb_image', __( 'Image' )),
        )
    )
    ->add_tab(
        __('Google Maps Key', THEME_TEXTDOMAIN),
        array(
            Field::make( 'text', 'google_map_api_key_theme_options', __( 'Google Map API Key' ) )
                ->set_help_text( __('Enter Google Maps Key', THEME_TEXTDOMAIN) ),
        )
    )
    ->add_tab(
        __('Google Business API', THEME_TEXTDOMAIN),
        array(
            Field::make( 'text', 'google_business_api_project_id', __('Project ID', THEME_TEXTDOMAIN) )
                ->set_width(50),
            Field::make( 'text', 'google_business_api_place_id', __('Reviews Place ID', THEME_TEXTDOMAIN) )
                ->set_help_text( __('Used in the link to the reviews page', THEME_TEXTDOMAIN) )
                ->set_width(50),

            Field::make( 'file', 'google_business_api_credentials_json', __('Google Application Credentials JSON', THEME_TEXTDOMAIN) )
                ->set_type('json'),

            Field::make( 'html', 'google_business_api_interactive', __('Google Business Account', THEME_TEXTDOMAIN) )
                ->set_html( google_api_render_admin_options() )
        )
    );

Container::make( 'theme_options', __('Google API Options', THEME_TEXTDOMAIN) )
    ->set_page_parent($basic_options_container)
    ->add_fields(array(
        Field::make( 'html', 'google_business_api_options_interactive', __('Google Business Account', THEME_TEXTDOMAIN) )
            ->set_html( google_api_render_admin_options() )
    ));