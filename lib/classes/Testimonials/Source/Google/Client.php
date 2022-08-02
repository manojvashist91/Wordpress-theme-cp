<?php


namespace Harbinger_Marketing\Testimonials\Source\Google;


use Google\Exception;

class Client extends \Google\Client
{
    private const OPTION_NAME__TOKEN = 'google_application_access_token';

    private static $instance;

    private $_invalid = false;
    private $_errors = [];

    private $_authHandler = null;
    private $_accountHandler = null;
    private $_clearCacheHandler = null;

    private function __construct()
    {
        parent::__construct();

        $fileId = carbon_get_theme_option('google_business_api_credentials_json');
        $fileSrc = get_attached_file($fileId);

        if ( false === $fileSrc ) {
            $this->setInvalid('Google Application Credentials Not Found!');
            return;
        }

        try {
            $this->setAuthConfig($fileSrc);
        }
        catch ( Exception $e ) {
            $this->setInvalid($e->getMessage());
            return;
        }

        if ( !$this->restoreAccessToken() ) {
            $this->_authHandler = new OAuthRedirectHandler();
            $this->setRedirectUri($this->_authHandler->route());
        }
        else {
            $this->_accountHandler = new OAuthAccountHandler();
        }

        $this->_clearCacheHandler = new TestimonialsClearCacheHandler();

        $this->addScope('https://www.googleapis.com/auth/plus.business.manage');
        $this->addScope('https://www.googleapis.com/auth/business.manage');
        $this->addScope('https://www.googleapis.com/auth/userinfo.profile');

        // For get refresh_token
        $this->setAccessType('offline');
        $this->setPrompt('consent');
    }


    /**
     * @return bool
     */
    public static function authorized() : bool
    {
        return !self::hasErrors() && !empty(self::instance()->getAccessToken());
    }

    /**
     * @return string
     */
    public static function optionsPageUri() : string
    {
        return get_admin_url(null,'admin.php?page=crb_carbon_fields_container_google_api_options.php');
    }

    /**
     * Drop access data
     */
    public static function logout()
    {
        self::instance()->forgetAccessToken();
    }

    /**
     * Uri for logout
     * @return string
     */
    public static function logoutUri() : string
    {
        return self::instance()->_accountHandler->routeLogout();
    }

    public static function clearTestimonialsCacheUri() : string
    {
        return self::instance()->_clearCacheHandler->route();
    }

    /**
     * @param string $code OAuth2 code
     */
    public static function authorizeByCode( $code )
    {
        self::instance()->fetchAccessTokenWithAuthCode($code);
        self::instance()->storeAccessToken();
    }

    /**
     * Set invalid state with error message
     * @param string $message
     */
    private function setInvalid( string $message )
    {
        $this->_invalid = true;
        $this->_errors[] = $message;
    }

    /**
     * Push the access token to the DB
     */
    private function storeAccessToken()
    {
        $token = $this->getAccessToken();
        update_option(self::OPTION_NAME__TOKEN, $token);
    }

    /**
     * Pull the access token from the DB. Refresh the access token if it's expired
     * @return bool true if access token was pulled (and refreshed). false if access token not found or is invalid
     */
    private function restoreAccessToken() : bool
    {
        $token = get_option(self::OPTION_NAME__TOKEN, null);
        if ( !$token ) {
            return false;
        }

        $this->setAccessToken($token);
        if ( $this->isAccessTokenExpired() ) {
            try {
                $response = $this->fetchAccessTokenWithRefreshToken();
                if ( isset($response['error']) ) {
                    throw new \Exception($response['error_description']);
                }
            }
            catch ( \Exception $ex ) {
                $this->setInvalid($ex->getMessage());
                return false;
            }

            $this->storeAccessToken();
        }

        return true;
    }

    /**
     * Delete access token from the DB
     */
    private function forgetAccessToken()
    {
        delete_option(self::OPTION_NAME__TOKEN);
    }

    public static function instance() : self
    {
        if ( !self::$instance ) {
            self::$instance = new self;
        }

        return self::$instance;
    }

    /**
     * Initial build Client Object
     */
    public static function init()
    {
        self::instance();
    }

    /**
     * @return bool
     */
    public static function hasErrors() : bool
    {
        return self::instance()->_invalid;
    }

    /**
     * @return array list of error messages
     */
    public static function errors() : array
    {
        return self::instance()->_errors;
    }

}