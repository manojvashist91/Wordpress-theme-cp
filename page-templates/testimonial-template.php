<?php
/**
 * Template Name: Testimonial Page Template
 *
 * @package WordPress
 * @subpackage Starter theme
 * @since Starter theme
 */
get_header();
?>
<main class="main-container">
<?php
$testimonials_display_options = carbon_get_post_meta(get_the_ID(), 'testimonials_display_options');
if($testimonials_display_options == 'yes'){

    get_template_part('page-templates/global-sections/testimonial-section');
}

    get_template_part('page-templates/reviews')
?>
  </main>
<?php
get_footer();
?>