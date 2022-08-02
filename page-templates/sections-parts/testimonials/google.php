<?php

$testimonial = $args['testimonial'] ?? null;
$reviews_link = google_reviews_link();

?>

<?php if ( $testimonial && $testimonial instanceof \Harbinger_Marketing\Testimonials\Source\Google\Testimonial ) : ?>

    <div class="text-start">
        <div class="custom-cards bg-white testimonial-card">
            <div class="testimonial-card__body">
                <h3 class="text-blue testimonial-card__title">
                    <?= $testimonial->reviewer()->name() ?>
                </h3>

                <div class="testimonial-card__description">
                    <p>
                        <?= $testimonial->comment() ?>
                    </p>
                </div>
            </div>

            <div class="custom-cards-footer testimonial-card__footer">
                <div class="testimonial-card__rating">
                    <a class="testimonial-card__rating-google" href="<?= google_reviews_link() ?>" target="_blank">
                        <svg width="36" height="36" viewBox="0 0 36 36" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M17.9341 15.5341V20.7106H25.1221C24.4531 24.0001 21.6526 25.8901 17.9341 25.8901C13.6029 25.8305 10.1231 22.3024 10.1231 17.9708C10.1231 13.6393 13.6029 10.1112 17.9341 10.0516C19.7344 10.0494 21.4793 10.6742 22.8691 11.8186L26.7691 7.91859C22.2955 3.98569 15.7621 3.47984 10.7364 6.67726C5.71073 9.87467 3.4006 16.0069 5.06744 21.7255C6.73427 27.4441 11.9775 31.3747 17.9341 31.3711C24.6346 31.3711 30.7276 26.4976 30.7276 17.9701C30.7172 17.1491 30.6166 16.3316 30.4276 15.5326L17.9341 15.5341Z" fill="white"/>
                        </svg>
                    </a>

                    <span class="testimonial-card__rating-num">
                         <?= $testimonial->rating() ?>
                    </span>

                    <span class="testimonial-card__rating-star">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M11.2527 1.51416C11.5584 0.894784 12.4416 0.894783 12.7473 1.51415L15.3328 6.75303C15.4542 6.99898 15.6888 7.16946 15.9603 7.2089L21.7417 8.04899C22.4252 8.14831 22.6982 8.98829 22.2036 9.4704L18.0201 13.5483C17.8237 13.7397 17.734 14.0156 17.7804 14.2859L18.768 20.044C18.8847 20.7247 18.1702 21.2439 17.5589 20.9225L12.3878 18.2039C12.145 18.0762 11.855 18.0762 11.6122 18.2039L6.44114 20.9225C5.82978 21.2439 5.11525 20.7247 5.23201 20.044L6.2196 14.2859C6.26597 14.0156 6.17634 13.7397 5.97994 13.5483L1.79645 9.4704C1.30185 8.98829 1.57477 8.14831 2.25829 8.04899L8.03973 7.2089C8.31116 7.16946 8.5458 6.99898 8.66718 6.75303L11.2527 1.51416Z" fill="#FCCF07"/>
                        </svg>
                    </span>
                </div>

                <span class="testimonial-card__date">
                    <?= (new DateTime())->setTimestamp($testimonial->timestamp())->format('F d, Y') ?>
                </span>
            </div>
        </div>
    </div>

<?php endif ?>
