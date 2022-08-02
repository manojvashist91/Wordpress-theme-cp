<?php
$reviws_heading = carbon_get_post_meta( get_the_ID(),'reviws_heading');
$reviws_heading_separated = explode(" | ", $reviws_heading);


// Testimonials paging options
$pagingQueryArgs = [];

$testimonialsPage = 1;
if ( isset($_REQUEST['page']) && is_numeric($_REQUEST['page']) && 1 < (int)$_REQUEST['page'] ) {
    $testimonialsPage = (int)$_REQUEST['page'];
}
$pagingQueryArgs['page'] = $testimonialsPage + 1;

$testimonialsPerPage = 5;
if ( isset($_REQUEST['perpage']) && is_numeric($_REQUEST['perpage']) && 0 < (int)$_REQUEST['perpage'] && $testimonialsPerPage !== (int)$_REQUEST['perpage'] ) {
    $testimonialsPerPage = (int)$_REQUEST['perpage'];
    $pagingQueryArgs['perpage'] = $testimonialsPerPage;
}

$pagingQuery = http_build_query($pagingQueryArgs);
$pagingLink = $pagingQuery ? get_permalink(get_the_ID()) . "?{$pagingQuery}" : '#';


// Testimonials
$testimonials = new \Harbinger_Marketing\Testimonials\Testimonials();
if ( isset($_REQUEST['clear-cache']) ) {
    $testimonials->noCache();
}


// Include Scripts
wp_enqueue_script( THEME_TEXTDOMAIN . 'reviews-js', THEME_ASSETS_URL . '/theme/js/reviews.js', array('jquery'), false, true );
wp_localize_script(THEME_TEXTDOMAIN . 'reviews-js', 'TESTIMONIALS_DATA', array(
    'total' => $testimonials->count(),
    'page_count' => $testimonials->pageCount($testimonialsPerPage),
    'page' => $testimonialsPage,
    'perpage' => $testimonialsPerPage,
    'action' => 'more_testimonials',
    'requestUri' => '/wp-admin/admin-ajax.php'
));

?>

<section class="container testimonials-wrapper text-center  py-7">
    <h1 class="cmn-heading h1 mb-5">
        <?php echo $reviws_heading_separated[0]; ?> <strong><?php echo $reviws_heading_separated[1]; ?></strong>
    </h1>

    <div class="testmonials-cards">
        <?php // The testimonials templates are located in /page-templates/sections-parts/testimonials/...  ?>
        <?php render_testimonials($testimonials->mix()->paged($testimonialsPage, $testimonialsPerPage)) ?>
    </div>

    <?php if ( $testimonials->count() > $testimonialsPage * $testimonialsPerPage ) : ?>
        <a href="<?= $pagingLink ?>" class="btn bg-blue cmn-btn curve-left js-testimonials-more">
            <?php esc_html_e( 'Click Here To Be Overwhelmed', THEME_TEXTDOMAIN) ?>
        </a>
    <?php endif ?>
</section>
