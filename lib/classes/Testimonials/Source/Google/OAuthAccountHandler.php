<?php

namespace Harbinger_Marketing\Testimonials\Source\Google;

class OAuthAccountHandler
{
    private $namespace = 'google/oauth';
    private $routeLogout = '/logout';

    public function __construct()
    {
        add_action('rest_api_init', [$this, 'init'] );
    }

    public function init()
    {
        register_rest_route( $this->namespace, $this->routeLogout, [
            'methods'  => 'GET',
            'callback' => [$this, 'logoutRequestHandler'],
        ]);
    }

    public function logoutRequestHandler( \WP_REST_Request $request )
    {
        if ( !current_user_can('manage_options') ) {
            wp_safe_redirect(home_url());
        }

        $source = new Source();
        $source->clearCache();

        Client::logout();

        wp_safe_redirect(Client::optionsPageUri());
        exit;
    }

    public function routeLogout() : string
    {
        return rest_url($this->namespace . $this->routeLogout);
    }
}