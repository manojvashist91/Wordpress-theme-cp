<?php

use Carbon_Fields\Container;
use Carbon_Fields\Field;

Container::make('post_meta', __('Team Member Settings'))
    ->where('post_type', '=', 'our_team')
    ->add_fields( array(
        Field::make('text', 'our_team_linkedin_url', __('LinkedIn URL',THEME_TEXTDOMAIN))
        ->set_width( 50 )
            ->set_help_text(  __('Enter LinkedIn URL', THEME_TEXTDOMAIN) ),
        Field::make( 'text', 'our_team_position', __( 'Position' ,THEME_TEXTDOMAIN) )
        ->set_width( 50 )
            ->set_help_text(  __('Enter Position', THEME_TEXTDOMAIN) ),
        Field::make('text', 'our_team_phone_number', __('Phone Number',THEME_TEXTDOMAIN))
        ->set_width( 50 )
            ->set_help_text(  __('Enter Phone Number ', THEME_TEXTDOMAIN) ),
        Field::make('text', 'our_team_email_address', __('Email',THEME_TEXTDOMAIN))
        ->set_width( 50 )
            ->set_help_text(  __('Enter Email Address ', THEME_TEXTDOMAIN) ),
        Field::make( 'image', 'our_team_image', __( 'Image',THEME_TEXTDOMAIN ))
        ->set_width( 50 ),
        Field::make( 'image', 'our_team_hover_image', __( 'Hover Image',THEME_TEXTDOMAIN ))
        ->set_width( 50 ),
        Field::make('file', 'download_vcard', __('VCard File',THEME_TEXTDOMAIN))
        ->set_type( 'vcf' )
        ->set_help_text( 'Example: vcf type only' ),
    ));
