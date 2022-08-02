<?php


namespace Harbinger_Marketing\Testimonials\Source\Google;


class Reviewer
{
    private $_name = '';

    private $_photo = '';

    private $_isAnonymous = false;

    public function __construct( ?array $data )
    {
        if ( !$data ) {
            return;
        }

        $this->fromArray($data);
    }


    /**
     * Reviewer name
     * @return string
     */
    public function name() : string
    {
        return $this->_name;
    }

    /**
     * Reviewer photo url
     * @return string
     */
    public function photo() : string
    {
        return $this->_name;
    }

    /**
     * @return bool
     */
    public function isAnonymous() : bool
    {
        return $this->_isAnonymous;
    }


    public function toArray() : array
    {
        return [
            'displayName' => $this->_name,
            'profilePhotoUrl' => $this->_photo,
            'isAnonymous' => $this->_isAnonymous,
        ];
    }

    public function fromArray( array $data )
    {
        $this->_name = $data['displayName'] ?: '';
        $this->_photo= $data['profilePhotoUrl'] ?: '';
        $this->_isAnonymous = $data['isAnonymous'];
    }
}