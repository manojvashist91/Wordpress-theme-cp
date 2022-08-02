<?php
/**
 * Template Name: Terms And Conditions Template
 *
 * @package WordPress
 * @subpackage Starter theme
 * @since Starter theme
 */
get_header();
$terms_and_conditions_banner_image =  carbon_get_post_meta( get_the_ID(),'terms_and_conditions_banner_image');
$attached_tc_banner_image_d = get_media_url($terms_and_conditions_banner_image,'page-banner-d');
$attached_tc_banner_image_t = get_media_url($terms_and_conditions_banner_image,'page-banner-t');
$attached_tc_banner_image_m = get_media_url($terms_and_conditions_banner_image,'page-banner-m');
?>
<main class="main-container terms-and-conditions-main">
        <!-- Banner Section -->
        <section class="hero-banner banner-sm f-center flex-column flex-md-row overlay-white pt-xl-5 terms-and-conditions-section">
            <div class="zoom-out-effect">
                <picture>
                    <!-- Desktop -->
                    <source media="(min-width: 1200px)" srcset="<?php echo $attached_tc_banner_image_d; ?>">
                    <!-- Tab -->
                    <source media="(min-width: 575px)" srcset="<?php echo $attached_tc_banner_image_t; ?>">
                    <!-- Mobile -->
                    <img src="<?php echo $attached_tc_banner_image_m; ?>" alt="Hero Banner Image">
                </picture>
            </div>
            <?php
            while(have_posts(  )): the_post(  ); ?>
            <?php the_title(); ?>
            <div class="container-xl container h-100 terms-and-conditions-title">
                <div class="content-wrap text-center text-xl-start">
                    <h1 class="cmn-heading border-left">
                        <?php the_title(); ?>
                    </h1>
                </div>
            </div>
        </section>
        <section class="bg-white terms-and-conditions-content">
            <div class="container-xl pt-8 pb-6">
                <p><?php the_content();?></p>
            </div>
        </section>
        <?php endwhile; 
        wp_reset_postdata( );
        ?>
    </main>
<?php get_footer() ?>