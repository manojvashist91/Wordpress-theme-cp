<?php


namespace Harbinger_Marketing\Testimonials\Source\SelfHosted;


class Source implements \Harbinger_Marketing\Testimonials\Source\Source
{
    private const OPTION_NAME__UPDATE_CACHE = 'source_selfhosted_updated';
    private const OPTION_NAME__DATA_CACHE = 'source_selfhosted_cache';


    /**
     * @var bool|null
     */
    private $_updated = null;

    /**
     * @var null|Testimonial[]
     */
    private $_testimonials = null;


    function code() : string
    {
        return 'sh';
    }

    function ready() : bool
    {
        return true;
    }

    function updated() : bool
    {
        if ( is_null($this->_updated) ) {
            $this->_updated = get_option(self::OPTION_NAME__UPDATE_CACHE, false);
        }

        return $this->_updated;
    }

    function clearCache() : void
    {
        delete_option(self::OPTION_NAME__DATA_CACHE);
        delete_option(self::OPTION_NAME__UPDATE_CACHE);
    }

    function all() : array
    {
        if ( $this->_testimonials ) {
            return $this->_testimonials;
        }

        if ( !$this->updated() ) {
            if ( $this->restoreCache() ) {
                return $this->_testimonials;
            }
        }

        delete_option(self::OPTION_NAME__UPDATE_CACHE);

        $testimonialsList = get_posts([
            'post_type' => 'testimonials',
            'posts_per_page' => -1,
        ]);

        $this->_testimonials = array_map( function ( \WP_Post $testimonial ) {
            return new Testimonial($testimonial);
        }, $testimonialsList );

        $this->storeCache();

        unset($termList);
        unset($testimonialsList);
        unset($testimonialsLists);

        return $this->_testimonials;
    }

    /**
     * Prepares the cache for updating. The cache will be updated when data is requested
     */
    public function updateCache()
    {
        update_option(self::OPTION_NAME__UPDATE_CACHE, true);
    }

    /**
     * Store cache
     */
    private function storeCache()
    {
        $rawTestimonialsForCache = array_map( function ( Testimonial $testimonial) {
            return $testimonial->toArray();
        }, $this->_testimonials );

        update_option(self::OPTION_NAME__DATA_CACHE, $rawTestimonialsForCache);

        unset($rawTestimonialsForCache);
    }

    /**
     * Try restore cache
     * @return bool True, if cache was restored
     */
    private function restoreCache() : bool
    {
        $cachedTestimonials = get_option(self::OPTION_NAME__DATA_CACHE, null);
        if ( !$cachedTestimonials ) {
            return false;
        }

        $this->_testimonials = array_map( function ( array $testimonial ) {
            return new Testimonial($testimonial);
        }, $cachedTestimonials );

        unset($cachedTestimonials);

        return true;
    }
}