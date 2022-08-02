<?php
/**
 * Template Name: Home Page Template
 *
 * @package WordPress
 * @subpackage Starter theme
 * @since Starter theme
 */
get_header();
get_template_part('page-templates/global-sections/hero-slider');
get_template_part('page-templates/service-category-term-meta-template');
get_template_part('page-templates/global-sections/case-studies-section-template');
get_template_part('page-templates/global-sections/testimonial-section');
get_template_part('page-templates/global-sections/office-locations');
get_template_part('page-templates/global-sections/our-partner-logo');
?>
</main>
<?php
get_footer();
?>