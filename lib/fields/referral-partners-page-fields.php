<?php
use Carbon_Fields\Container;
use Carbon_Fields\Field;

Container::make('post_meta', __('Referral Partners Page Settings', THEME_TEXTDOMAIN))
    ->where('post_type', '=', 'page')
    ->where('post_template', '=', 'page-templates/referral-partners-template.php')
    ->add_tab(__('Hero Banner', THEME_TEXTDOMAIN), array(
        Field::make('image', 'hero_banner_image', __('Hero Banner Image', THEME_TEXTDOMAIN))
        ->set_width( 30 ),
        Field::make('textarea', 'hero_banner_content', __('Hero Banner Content', THEME_TEXTDOMAIN))
        ->set_width( 70 )
        ->set_rows(6)
    ))

    ->add_tab( __('Content Section',THEME_TEXTDOMAIN ), array(
        Field::make( 'complex', 'referral_partners_section', __( 'Card Content',THEME_TEXTDOMAIN  ))
            ->set_layout( 'tabbed-horizontal' )
            ->add_fields( array(
                Field::make( 'text', 'referral_partners_title', __('Title',THEME_TEXTDOMAIN ) ),
                Field::make( 'image', 'referral_partners_image', __('Image',THEME_TEXTDOMAIN ) )
                ->set_width( 30 ),
                Field::make( 'rich_text', 'referral_partners_content', __('Content',THEME_TEXTDOMAIN ) )
                ->set_width( 70 )
                ->set_rows(6),
                Field::make( 'rich_text', 'referral_partners_collapsible_content', __('Collapsible Section',THEME_TEXTDOMAIN ) )
                ->set_rows(10)
                    ->set_help_text( __('Use Shortcode [column-count-2] inside "ul" tag for showing list in two column', THEME_TEXTDOMAIN) ),
            ) ),
    ))
    ->add_tab(__('Call To Action', THEME_TEXTDOMAIN), array(
        Field::make('text', 'cta_heading', __('Heading', THEME_TEXTDOMAIN)),
        Field::make('textarea', 'cta_content', __('Content', THEME_TEXTDOMAIN))
            ->set_rows(2),
        Field::make('urlpicker', 'cta_link', __('Link', THEME_TEXTDOMAIN)),
    ));
