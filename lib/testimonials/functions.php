<?php

function google_api_render_admin_options()
{
    if ( $_REQUEST['page'] !== 'crb_carbon_fields_container_google_api_options.php' ) {
        return '';
    }

    ob_start();
    get_template_part('lib/testimonials/view/google-api');
    return ob_get_clean();
}

function google_reviews_link() : string {
    static $link = null;

    if ( empty($link) ) {
        $placeId = carbon_get_theme_option('google_business_api_place_id');
        $link = "https://search.google.com/local/reviews?placeid=$placeId";
    }

    return $link;
}

/**
 * @param \Harbinger_Marketing\Testimonials\Testimonial[] $testimonials
 */
function render_testimonials( array $testimonials )
{
    foreach ( $testimonials as $testimonial ) {

        $templatePath = 'page-templates/sections-parts/testimonials/';
        $templateName = '';

        switch ( $testimonial->source() ) {
            case 'google':
                $templateName = 'google';
                break;

            case 'self-hosted':
                if ( $testimonial instanceof \Harbinger_Marketing\Testimonials\Source\SelfHosted\Testimonial ) {
                    $templateName = $testimonial->type();
                }
                break;
        }

        get_template_part("{$templatePath}{$templateName}", null, array('testimonial' => $testimonial));
    }
}