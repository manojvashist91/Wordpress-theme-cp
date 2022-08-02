<?php


namespace Harbinger_Marketing\Testimonials\Source\SelfHosted;


class Testimonial implements \Harbinger_Marketing\Testimonials\Testimonial
{
    private $_category;

    private $_type = 'embed';

    private $_source = '';

    private $_rating = 5;

    private $_createTime = 0;

    /**
     * Testimonial constructor.
     *
     * @param array|\WP_Post|null $data
     */
    public function __construct( $data = null )
    {
        if ( !$data ) {
            return;
        }

        if ( is_array($data) ) {
            $this->fromArray($data);
        }

        if ( $data instanceof \WP_Post ) {
            $this->fromPost($data);
        }
    }


    public function sourceString() : string
    {
        return $this->_source;
    }

    public function type() : string
    {
        return $this->_type;
    }

    public function category() : string
    {
        return $this->_category;
    }


    public function source() : string
    {
        return 'self-hosted';
    }

    public function rating() : int
    {
        return $this->_rating;
    }

    public function timestamp() : int
    {
        return $this->_createTime;
    }

    public function toArray() : array
    {
        return [
            'category' => $this->_category,
            'type' => $this->_type,
            'source' => $this->_source,
            'rating' => $this->_rating,
            'create_time' => $this->_createTime,
        ];
    }

    public function fromArray( array $data )
    {
        $this->_category = $data['category'];
        $this->_type = $data['type'];
        $this->_source = $data['source'];
        $this->_rating = $data['rating'];
        $this->_createTime = $data['create_time'];
    }

    /**
     * Set data from WP_Post
     * @param \WP_Post $post
     * @param \WP_Term|null $term
     */
    public function fromPost( \WP_Post $post, ?\WP_Term $term = null ) : self
    {
        if ( 'testimonials' !== $post->post_type ) {
            return $this;
        }

        if ( $term && 'testimonial-category' !== $term->taxonomy ) {
            return $this;
        }


        $this->_createTime = (new \DateTime($post->post_date))->setTime(0,0,0,0)->getTimestamp();
        $this->_category = $term ? $term->slug : wp_get_post_terms($post->ID, 'testimonial-category')[0] ?? '';

        $this->_rating = carbon_get_post_meta($post->ID, 'testimonial_score');
        $this->_type = carbon_get_post_meta($post->ID, 'testimonial_content_type');

        switch ( $this->_type ) {
            case 'image':
                $imageId = carbon_get_post_meta($post->ID, 'testimonial_screenshot');
                $this->_source = wp_get_attachment_image_url($imageId, 'full');
                break;

            case 'embed':
                $this->_source = carbon_get_post_meta($post->ID, 'testimonial_embed');
                break;
        }

        return $this;
    }
}