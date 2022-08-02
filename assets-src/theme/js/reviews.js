/**
 *
 * @typedef {object} TestimonialsData
 * @property {int} total Testimonials count
 * @property {int} page_count Page count
 * @property {int} page Current page
 * @property {int} perpage Testimonials per page
 * @property {string} action Request action name
 * @property {string} requestUri Request URI
 *
 * @var {TestimonialsData} TESTIMONIALS_DATA
 */

$(window).on('load', () => {
    const $testimonials = $('.testimonials-wrapper');
    const $loadMoreBtn = $testimonials.find('.js-testimonials-more');
    if ( !$loadMoreBtn.length ) {
        return;
    }

    const $cardsContainer = $testimonials.find('.testmonials-cards');

    const requestUri = TESTIMONIALS_DATA.requestUri;
    const baseRequestObject = {
        action: TESTIMONIALS_DATA.action,
    };

    $loadMoreBtn.attr('href', 'javascript:void()');

    $loadMoreBtn.one('click', async e => {
        e.preventDefault();

        $loadMoreBtn.text('Loading...')

        const response = await fetch(requestUri, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: $.param(baseRequestObject),
        });

        if ( !response.ok ) {
            return;
        }

        const json = await response.json();

        $loadMoreBtn.remove();

        $cardsContainer.append(json.content);
    });
});