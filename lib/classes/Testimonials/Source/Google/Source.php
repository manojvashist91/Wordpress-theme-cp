<?php


namespace Harbinger_Marketing\Testimonials\Source\Google;




class Source implements \Harbinger_Marketing\Testimonials\Source\Source
{
    private const CACHE_LIFETIME = 86400; // 60(s) * 60(m) * 24(h) => 24h

    private const OPTION_NAME__TESTIMONIALS_COUNT = 'source_google_total_testimonials';
    private const OPTION_NAME__LOADING_STATE = 'source_google_loading_state';
    private const OPTION_NAME__DATA_CACHE = 'source_google_testimonials_cache';

    private const LOADING_STATUS__START = 'start';
    private const LOADING_STATUS__LOADING = 'loading';
    private const LOADING_STATUS__READY = 'ready';


    // Location list (LL) indices
    private const LL_ACCOUNT = 0; // Account Name: accounts/123456789
    private const LL_LOCATION = 1; // Location Name: locations/123456789
    private const LL_COUNT = 2; // Number of Loaded Reviews
    private const LL_TOTAL = 3; // Number of Reviews
    private const LL_LOADED = 4; // true|false Loading ended
    private const LL_NEXT = 5; // Next reviews page token

    /**
     * @var bool
     */
    private $_updated = null;

    private $_totalTestimonialsCount = 0;

    /**
     * @var null|Testimonial[]
     */
    private $_testimonials = null;

    private $_loadingState = null;

    /**
     * @var null|\GuzzleHttp\Client
     */
    private $_authorizedHttpClient = null;

    /**
     * [ [accountName, locationName, loadedTestimonials, totalTestimonials, loaded, nextPageToken], ... ]
     * @var null|array
     */
    private $_locationList = null;


    public function __construct()
    {
        $this->_loadingState = $this->restoreLoadingState();
        $this->_totalTestimonialsCount = get_option(self::OPTION_NAME__TESTIMONIALS_COUNT, 0);

        // Try to restore testimonials if state is READY
        if ( self::LOADING_STATUS__READY === $this->_loadingState['state'] && !$this->restoreTestimonials() ) {
            $this->clearCache();
            $this->_loadingState = ['state' => self::LOADING_STATUS__START];
        }

        if ( Client::authorized() ) {
            switch ( $this->_loadingState['state'] ) {
                // If Start - build location list
                case self::LOADING_STATUS__START:
                    $this->buildLocationList();
                    $this->_testimonials = [];
                // No Break, start loading

                case self::LOADING_STATUS__LOADING:
                    $this->loadTestimonials();
                    break;
            }
        }
    }

    /**
     * Return value can be changed when testimonials are loading
     * @return int
     */
    public function totalCount() : int
    {
        return $this->_totalTestimonialsCount;
    }

    public function loadedCount() : int
    {
        switch ( $this->_loadingState['state'] ) {
            case self::LOADING_STATUS__READY:
                return $this->_totalTestimonialsCount;

            case self::LOADING_STATUS__START:
                return 0;

            case self::LOADING_STATUS__LOADING:
                return array_reduce($this->_loadingState['location_list'], function ( $sum,  $locationData ) {
                    return $sum + $locationData[self::LL_LOADED];
                }, 0);
        }

        return 0;
    }

    /**
     * @return string 'start' = loading started, 'loading' - loading in progress, 'ready' - all testimonials loaded!
     */
    public function status() : string
    {
        return $this->_loadingState['state'] ?? self::LOADING_STATUS__START;
    }


    function code() : string
    {
        return 'google';
    }

    function ready() : bool
    {
        if ( Client::hasErrors() ) {
            foreach ( Client::errors() as $error ) {
                error_log($error);
            }
            return false;
        }

        if ( !Client::authorized() ) {
            return false;
        }

        if ( self::LOADING_STATUS__READY !== $this->_loadingState['state'] ) {
            return false;
        }

        return true;
    }

    function updated() : bool
    {
        if ( self::LOADING_STATUS__READY === $this->_loadingState['state'] && $this->_loadingState['updated'] ?? false ) {
            $this->_loadingState['updated'] = false;
            $this->storeLoadingState($this->_loadingState);
            return true;
        }

        return false;
    }

    function clearCache() : void
    {
        $this->storeLoadingState(['state' => self::LOADING_STATUS__START]);
        delete_transient(self::OPTION_NAME__DATA_CACHE);
        delete_option(self::OPTION_NAME__TESTIMONIALS_COUNT);
    }

    function all() : array
    {
        return $this->_testimonials;
    }

    private function storeTestimonials()
    {
        if ( !$this->_testimonials ) {
            return;
        }

        $rawTestimonials = array_map( function ( Testimonial $testimonial ) {
            return $testimonial->toArray();
        }, $this->_testimonials );

        set_transient(self::OPTION_NAME__DATA_CACHE, $rawTestimonials, self::CACHE_LIFETIME);

        unset($rawTestimonials);
    }

    private function restoreTestimonials() : bool
    {
        $rawTestimonials = get_transient(self::OPTION_NAME__DATA_CACHE);
        if ( false === $rawTestimonials ) {
            $this->_testimonials = null;
            return false;
        }

        $this->_testimonials = $this->buildTestimonials($rawTestimonials);

        unset($rawTestimonials);

        return true;
    }

    private function storeLoadingState( $state )
    {
        update_option(self::OPTION_NAME__LOADING_STATE, $state);
    }

    private function restoreLoadingState()
    {
        return get_option(self::OPTION_NAME__LOADING_STATE, ['state' => self::LOADING_STATUS__START]);
    }

    private function buildLocationList()
    {
        $this->_locationList = [];

        $client = Client::instance();
        $businessAccountService = new \Google_Service_MyBusinessAccountManagement($client);
        $businessInformationService = new \Google_Service_MyBusinessBusinessInformation($client);

        $accounts = $businessAccountService->accounts->listAccounts()->getAccounts();

        $locationListOptions = ['readMask' => 'name'];
        foreach ( $accounts as $account ) {
            $accountName = $account->getName();

            try {
                $locations = $businessInformationService->accounts_locations->listAccountsLocations($accountName, $locationListOptions)->getLocations();

                foreach ( $locations as $location ) {
                    $this->_locationList[] = [$accountName, $location->getName(), 0, 0, false, null];
                }
            }
            catch ( \Exception $ex ) {
                error_log($ex->getMessage(), 4);
            }
        }
    }

    private function loadTestimonials()
    {
        if ( is_null($this->_locationList) ) {
            $this->_locationList = $this->_loadingState['location_list'];
        }

        $loadedCount = $this->_loadingState['loaded_count'] ?? 0;
        $locationCount = $this->_loadingState['location_count'] ?? count($this->_locationList);
        $index = $this->_loadingState['first_index'] ?? 0;

        $this->_authorizedHttpClient = Client::instance()->authorize();

        for ( $requestCount = 0; $requestCount < 40 && $loadedCount < $locationCount; $index = ($index + 1) % $locationCount ) {
            if ( $this->_locationList[$index][self::LL_LOADED] ) {
                continue;
            }

            $accountName = $this->_locationList[$index][self::LL_ACCOUNT];
            $locationName = $this->_locationList[$index][self::LL_LOCATION];
            $pageToken = $this->_locationList[$index][self::LL_NEXT] ?: null;

            $responseData = $this->requestTestimonials($accountName, $locationName, $pageToken);
            $requestCount++;

            if ( empty($responseData) || empty($responseData['reviews']) ) {
                $this->_locationList[$index][self::LL_LOADED] = true;
                $loadedCount++;
                continue;
            }

            $this->_testimonials = array_merge($this->_testimonials, $this->buildTestimonials($responseData['reviews']));


            if ( 0 === $this->_locationList[$index][self::LL_TOTAL] ) {
                $this->_totalTestimonialsCount += $responseData['totalReviewCount'] ?? 0;
            }

            $this->_locationList[$index][self::LL_LOADED] += count($responseData['reviews']);
            $this->_locationList[$index][self::LL_TOTAL] = $responseData['totalReviewCount'] ?? 0;
            $this->_locationList[$index][self::LL_NEXT] = $responseData['nextPageToken'] ?? null;

            if ( !$this->_locationList[$index][self::LL_NEXT] ) {
                $this->_locationList[$index][self::LL_LOADED] = true;
                $loadedCount++;
            }
        }

        $this->storeTestimonials();

        update_option(self::OPTION_NAME__TESTIMONIALS_COUNT, $this->_totalTestimonialsCount);

        if ( $loadedCount === $locationCount ) {
            $this->_loadingState = ['state' => self::LOADING_STATUS__READY];
            $this->storeLoadingState(['state' => self::LOADING_STATUS__READY, 'updated' => true]);
            return;
        }

        $this->_loadingState['state'] = self::LOADING_STATUS__LOADING;
        $this->_loadingState['loaded_count'] = $loadedCount;
        $this->_loadingState['location_count'] = $locationCount;
        $this->_loadingState['first_index'] = $index;
        $this->_loadingState['location_list'] = $this->_locationList;
        $this->storeLoadingState($this->_loadingState);
    }

    /**
     * Load testimonials
     *
     * https://developers.google.com/my-business/reference/rest/v4/accounts.locations.reviews/list
     *
     * @param string $accountName accounts/1234567890
     * @param string $locationName locations/1234567890
     * @param string|null $pageToken
     *
     * @return array|null
     */
    private function requestTestimonials( string $accountName, string $locationName, ?string $pageToken = null ) : ?array
    {
        $requestQueryArgs = [
            'pageSize' => 50,
        ];
        if ( !empty($pageToken) ) {
            $requestQueryArgs['pageToken'] = $pageToken;
        }
        $requestQueryStr = http_build_query($requestQueryArgs);

        $requestUri = "https://mybusiness.googleapis.com/v4/{$accountName}/{$locationName}/reviews?{$requestQueryStr}";

        try {
            $response = $this->_authorizedHttpClient->get($requestUri);

            if ( $response->getStatusCode() >= 400 ) {
                error_log('Reviews Loading Error Code: ' . $response->getStatusCode());
                return null;
            }

            return json_decode((string)$response->getBody(), true);
        }
        catch ( \GuzzleHttp\Exception\GuzzleException $ex ) {
            return null;
        }
    }

    /**
     * @param array $rawTestimonialsList
     *
     * @return Testimonial[]
     */
    private function buildTestimonials( array $rawTestimonialsList ) : array
    {
        return array_map( function ( $rawTestimonial ) {
            return new Testimonial($rawTestimonial);
        }, $rawTestimonialsList);
    }
}