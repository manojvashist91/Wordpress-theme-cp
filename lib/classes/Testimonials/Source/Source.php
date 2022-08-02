<?php


namespace Harbinger_Marketing\Testimonials\Source;


use Harbinger_Marketing\Testimonials\Testimonial;

interface Source
{
    /**
     * Source Code (for caching)
     * @return string
     */
    function code() : string;

    /**
     * Ready to use
     * If true - source content content is available
     * @return bool
     */
    function ready() : bool;

    /**
     * This source was updated
     * @return bool
     */
    function updated() : bool;

    /**
     * Clear source cache
     */
    function clearCache() : void;

    /**
     * Return list of testimonials
     *
     * @return Testimonial[]
     */
    function all() : array;
}