<?php


namespace Harbinger_Marketing\Testimonials\Source\Google;


class Testimonial implements \Harbinger_Marketing\Testimonials\Testimonial
{
    /**
     * The resource name. For Review it is of the form accounts/{accountId}/locations/{locationId}/reviews/{reviewId}
     * @var null|string
     */
    private $_name = null;

    /**
     * The encrypted unique identifier.
     * @var null|string
     */
    private $_reviewId = null;

    /**
     * The author of the review.
     * @var null|Reviewer
     */
    private $_reviewer = null;

    /**
     * The star rating of the review.
     * @var int
     */
    private $_rating = 0;

    /**
     * The star rating of the review. ENUM
     * @var string
     */
    private $_ratingEnumValue = '';

    /**
     * The body of the review as plain text with markups.
     * @var string
     */
    private $_comment = '';

    /**
     * The timestamp for when the review was written.
     *
     * A timestamp in RFC3339 UTC "Zulu" format, with nanosecond resolution and up to nine fractional digits.
     *
     * Examples: "2014-10-02T15:01:23Z" and "2014-10-02T15:01:23.045123456Z".
     *
     * @var string
     */
    private $_createTime = '';

    /**
     * The timestamp for when the review was last modified.
     *
     * A timestamp in RFC3339 UTC "Zulu" format, with nanosecond resolution and up to nine fractional digits.
     *
     * Examples: "2014-10-02T15:01:23Z" and "2014-10-02T15:01:23.045123456Z".
     *
     * @var string
     */
    private $_updateTime = '';

    private $_timestamp = 0;


    public function __construct( ?array $data = null )
    {
        if ( !$data ) {
            return;
        }

        $this->fromArray($data);
    }


    public function reviewer() : Reviewer
    {
        return $this->_reviewer;
    }

    public function comment() : string
    {
        return $this->_comment;
    }



    public function source() : string
    {
        return 'google';
    }

    public function toArray() : array
    {
        return [
            'source' => $this->source(),
            'name' => $this->_name,
            'reviewId' => $this->_reviewId,
            'starRating' => $this->_ratingEnumValue,
            'reviewer' => $this->_reviewer->toArray(),
            'comment' => $this->_comment,
            'createTime' => $this->_createTime,
            'updateTime' => $this->_updateTime,
            'timestamp' => $this->_timestamp,
        ];
    }

    public function fromArray( array $data )
    {
        $this->_name = $data['name'];
        $this->_reviewId = $data['reviewId'];
        $this->_ratingEnumValue = $data['starRating'];
        $this->_reviewer = new Reviewer($data['reviewer']);
        $this->_comment = $data['comment'] ?? '';
        $this->_createTime = $data['createTime'];
        $this->_updateTime = $data['updateTime'];
        $this->_timestamp = $data['timestamp'] ?? $this->buildTimestamp($this->_updateTime);

        switch ( $this->_ratingEnumValue ) {
            case 'STAR_RATING_UNSPECIFIED': $this->_rating = 0; break;
            case 'ONE': $this->_rating = 1; break;
            case 'TWO': $this->_rating = 2; break;
            case 'THREE': $this->_rating = 3; break;
            case 'FOUR': $this->_rating = 4; break;
            case 'FIVE': $this->_rating = 5; break;
        }
    }

    public function rating() : int
    {
        return $this->_rating;
    }

    public function timestamp() : int
    {
        return $this->_timestamp;
    }

    private function buildTimestamp( $timeStr ) : int
    {
        $matches = [];
        preg_match('~(\d{4}-\d{2}-\d{2}T\d{2}:\d{2}:\d{2})~', $timeStr, $matches);
        $date = \DateTime::createFromFormat('Y-m-d\TH:i:s', $matches[0]);
        $date->setTime(0,0, 0, 0);
        return $date->getTimestamp();
    }
}