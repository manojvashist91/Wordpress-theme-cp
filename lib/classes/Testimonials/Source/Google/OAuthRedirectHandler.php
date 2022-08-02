<?php

namespace Harbinger_Marketing\Testimonials\Source\Google;

class OAuthRedirectHandler
{
    private $namespace = 'google/oauth';
    private $route = '/auth';

    public function __construct()
    {
        add_action('rest_api_init', [$this, 'init'] );
    }

    public function init()
    {
        register_rest_route( $this->namespace, $this->route, [
            'methods'  => 'GET',
            'callback' => [$this, 'authRequestHandler'],
        ]);
    }

    public function authRequestHandler( \WP_REST_Request $request )
    {
        if ( !$request['code'] ) {
            global $wp_query;
            $wp_query->set_404();
            status_header( 404 );
            nocache_headers();
        }

        Client::authorizeByCode($request['code']);

        wp_safe_redirect(Client::optionsPageUri());
        exit;
    }

    public function route() : string
    {
        return rest_url($this->namespace . $this->route);
    }
}