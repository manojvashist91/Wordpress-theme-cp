<?php

add_action('post_updated', 'testimonial_post_updated_handler', 10, 2);
function testimonial_post_updated_handler( int $post_id, WP_Post $post_after )
{
    if ( 'testimonials' !== $post_after->post_type ) {
        return;
    }

    $source = new \Harbinger_Marketing\Testimonials\Source\SelfHosted\Source();
    $source->updateCache();
}



add_action('wp_ajax_more_testimonials','more_testimonials_ajax_handler');
add_action('wp_ajax_nopriv_more_testimonials','more_testimonials_ajax_handler');
function more_testimonials_ajax_handler()
{
    $testimonials = new \Harbinger_Marketing\Testimonials\Testimonials();

    $testimonialPagedList = $testimonials->mix()->paged(1, 999999, 5 /* First Page Number */);

    $content = '';
    if ( !empty($testimonialPagedList) ) {
        ob_start();

        render_testimonials($testimonialPagedList);

        $content = ob_get_clean();
    }

    $testimonialsCount = $testimonials->count();

    echo json_encode(array(
        'count' => count($testimonialPagedList),
        'total' => $testimonialsCount,
        'content' => $content
    ));

    die;
}