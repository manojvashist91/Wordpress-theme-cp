<?php


namespace Harbinger_Marketing\Testimonials;


interface Testimonial
{
    /**
     * Source name
     * @return string
     */
    public function source() : string;

    /**
     * @return int
     */
    public function rating() : int;

    /**
     * Create time
     * @return int
     */
    public function timestamp() : int;

    /**
     * Return raw data
     * @return array
     */
    public function toArray() : array;

    /**
     * Build from raw
     * @param array $data
     *
     * @return mixed
     */
    public function fromArray( array $data );
}