<?php

namespace Harbinger_Marketing\Testimonials\Source\Google;

class TestimonialsClearCacheHandler
{
    private $namespace = 'google/testimonials';
    private $route = '/cache/clear';

    public function __construct()
    {
        add_action('rest_api_init', [$this, 'init'] );
    }

    public function init()
    {
        register_rest_route( $this->namespace, $this->route, [
            'methods'  => 'GET',
            'callback' => [$this, 'clearCacheHandler'],
        ]);
    }

    public function clearCacheHandler( \WP_REST_Request $request )
    {
        if ( !current_user_can('manage_options') ) {
            wp_safe_redirect(home_url());
        }

        $source = new Source();
        $source->clearCache();

        wp_safe_redirect(Client::optionsPageUri());
        exit;
    }

    public function route() : string
    {
        return rest_url($this->namespace . $this->route);
    }
}