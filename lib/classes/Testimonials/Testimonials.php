<?php


namespace Harbinger_Marketing\Testimonials;


use Harbinger_Marketing\Testimonials\Source\SelfHosted\Source as SelfHostedSource;
use Harbinger_Marketing\Testimonials\Source\Google\Source as GoogleSource;
use Harbinger_Marketing\Testimonials\Source\Source;

class Testimonials
{
    private const CACHE_LIVE_TIME = 43200; // 60 * 60 * 12 = 43200 -> 12h


    /**
     * @var bool
     */
    private $_mix = false;

    /**
     * @var bool
     */
    private $_cache = true;

    /**
     * @var Source[]
     */
    private $_sourceList;

    /**
     * @var array
     */
    private $_testimonialsBySourceCodeMap;

    /**
     * @var array
     */
    private $_indexList = null;

    public function __construct()
    {
        $this->_sourceList = [
            new SelfHostedSource(),
            new GoogleSource(),
        ];

        $this->_sourceList = array_filter($this->_sourceList, function( Source $source ) {
            return $source->ready();
        });

        $this->_testimonialsBySourceCodeMap = [];
        foreach ( $this->_sourceList as $source ) {
            $this->_testimonialsBySourceCodeMap[$source->code()] = $source->all();
        }
    }

    /**
     * @return Testimonial[]
     */
    public function all() : array
    {
        $this->makeIndexList();

        $testimonialList = [];

        foreach ( $this->_indexList as [ $sourceName, $index ] ) {
            $testimonialList[] = $this->_testimonialsBySourceCodeMap[$sourceName][$index];
        }

        return $testimonialList;
    }

    /**
     * @param int $page [1 .. n]
     * @param int $number [1 .. n]
     * @param int $offset [0 .. n] paging offset (if first page size less(more) than next page sizes
     *
     * @return Testimonial[]
     */
    public function paged( int $page, int $number = 8, int $offset = 0 ) : array
    {
        if ( $page < 1 || $number < 1 ) {
            return [];
        }

        $offset = $offset >= 0 ? $offset : 0;

        $this->makeIndexList();

        $offset = $offset + ($page - 1) * $number;
        $indexList = array_slice($this->_indexList, $offset, $number);

        return array_map( function( $index ) {
            return $this->_testimonialsBySourceCodeMap[$index[0]][$index[1]];
        }, $indexList );
    }

    /**
     * Return count of testimonials.
     *
     * @return int Count of testimonials
     */
    public function count() : int
    {
        $this->makeIndexList();

        return count($this->_indexList);
    }

    /**
     * How many pages with a given perPage
     * @param int $perPage 1 .. n
     *
     * @return int
     */
    public function pageCount( int $perPage ) : int
    {
        if ( $perPage < 1 ) {
            return 0;
        }

        $count = $this->count();

        return ceil($count / $perPage);
    }

    /**
     * Testimonials will be mixed
     * @return $this
     */
    public function mix() : self
    {
        if ( $this->_mix ) {
            $this->_indexList = null;
        }

        $this->_mix = true;
        return $this;
    }

    /**
     * Testimonials will be not mixed
     * @return $this
     */
    public function noMix() : self
    {
        if ( !$this->_mix ) {
            $this->_indexList = null;
        }

        $this->_mix = false;
        return $this;
    }


    /**
     * Use cache if exists
     * @return $this
     */
    public function cache() : self
    {
        if ( !$this->_cache ) {
            $this->_indexList = null;
        }

        $this->_cache = true;
        return $this;
    }

    /**
     * Ignore cache. New cache well be created!
     * @return $this
     */
    public function noCache() : self
    {
        if ( $this->_cache ) {
            $this->_indexList = null;
        }

        $this->_cache = false;
        return $this;
    }


    /**
     * Load from cache or create new index list if index list is not defined
     */
    private function makeIndexList()
    {
        if ( $this->_indexList ) {
            return;
        }

        $testimonialsCacheName = 'testimonials_cache';
        if ( $this->_mix ) {
            $testimonialsCacheName .= '_mixed';
        }

        $testimonialsCacheName .= '_' . $this->getSourceListHashedName();

        if ( !$this->_cache || !$this->restoreFromCache($testimonialsCacheName) ) {
            $this->makeNewIndexList();
            $this->storeToCache($testimonialsCacheName);
        }
    }


    /**
     * @return string md5 hash of all source names
     */
    private function getSourceListHashedName() : string
    {
        $name = implode(
            '_',
            array_map( function( Source $source ) {
                return $source->code();
            }, $this->_sourceList )
        );

        return md5($name);
    }

    /**
     * @param string $cacheName
     *
     * @return bool true if index list was restored from cache
     */
    private function restoreFromCache( string $cacheName ) : bool
    {
        foreach ( $this->_sourceList as $source ) {
            if ( $source->updated() ) {
                return false;
            }
        }

        $this->_indexList = get_transient($cacheName) ?: null;

        return !is_null($this->_indexList);
    }

    private function storeToCache( string $cacheName )
    {
        set_transient($cacheName, $this->_indexList, self::CACHE_LIVE_TIME);
    }

    private function makeNewIndexList()
    {
        $this->_indexList = [];

        foreach ( $this->_sourceList as $source ) {
            $testimonials = $source->all();
            $sourceCode = $source->code();

            foreach ( $testimonials as $index => $testimonial ) {
                $this->_indexList[] = [ $sourceCode, $index ];
            }
        }

        if ( $this->_mix ) {
            shuffle($this->_indexList);
            shuffle($this->_indexList);
            shuffle($this->_indexList);
        }
        usort( $this->_indexList, function( $leftIndexData, $rightIndexData ) {
            $leftTestimonial = $this->_testimonialsBySourceCodeMap[$leftIndexData[0]][$leftIndexData[1]];
            $rightTestimonial = $this->_testimonialsBySourceCodeMap[$rightIndexData[0]][$rightIndexData[1]];

            // Swap the left and right testimonials to change the sort order
            return $rightTestimonial->timestamp() <=> $leftTestimonial->timestamp();
        });
    }
}