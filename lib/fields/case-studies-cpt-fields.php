<?php

use Carbon_Fields\Container;
use Carbon_Fields\Field;

Container::make('post_meta', __('Case Study Settings'))
    ->where('post_type', '=', 'case_studies')
	->add_fields( array(
        Field::make( 'text', 'case_studies_heading', __( 'Heading',THEME_TEXTDOMAIN  ) ),
        Field::make( 'image', 'case_studies_image', __( 'Featured Image',THEME_TEXTDOMAIN  ) )
            ->set_type( array( 'image' )),
        Field::make( 'complex', 'case_studies_cards_content', __('Content',THEME_TEXTDOMAIN ) )
        ->set_layout( 'tabbed-horizontal' )
        ->add_fields( array(
            
            Field::make( 'text', 'case_studies_card_title', __( 'Card Title',THEME_TEXTDOMAIN  ) )
                ->set_width( 40 ),
            Field::make( 'rich_text', 'case_studies_card_content', __( 'Card Content',THEME_TEXTDOMAIN  ) )
                ->set_width( 60 )
                ->set_rows( 8 )
            ) ),
	));