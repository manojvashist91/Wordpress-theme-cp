<?php
/**
 * Template Name: Privacy Policy and Sitemap
 *
 * @package WordPress
 * @subpackage Starter theme
 * @since Starter theme
 */
get_header();
$privacy_policy_banner_image =  carbon_get_post_meta( get_the_ID(),'privacy_policy_banner_image');
$attached_privacy_policy_banner_image_d = get_media_url($privacy_policy_banner_image,'page-banner-d');
$attached_privacy_policy_banner_image_t = get_media_url($privacy_policy_banner_image,'page-banner-t');
$attached_privacy_policy_banner_image_m = get_media_url($privacy_policy_banner_image,'page-banner-m');
?>
<main class="main-container">
        <!-- Banner Section -->
        <section class="hero-banner banner-sm f-center flex-column flex-md-row overlay-white pt-xl-5">
            <div class="zoom-out-effect">
                <picture>
                    <!-- Desktop -->
                    <source media="(min-width: 1200px)" srcset="<?php echo $attached_privacy_policy_banner_image_d; ?>">
                    <!-- Tab -->
                    <source media="(min-width: 575px)" srcset="<?php echo $attached_privacy_policy_banner_image_t; ?>">
                    <!-- Mobile -->
                    <img src="<?php echo $attached_privacy_policy_banner_image_m; ?>" alt="Hero Banner Image">
                </picture>
            </div>
            <?php
            while(have_posts(  )): the_post(  ); ?>
            <div class="container-xl container h-100">
                <div class="content-wrap text-center text-xl-start">
                    <h1 class="cmn-heading border-left">
                        <?php the_title(); ?>
                    </h1>
                </div>
            </div>
        </section>
        <section class="single-blog-wrap bg-white">
            <div class="container-xl pt-8 pb-8">
                <p><?php the_content();?></p>
            </div>
        </section>
        <?php endwhile; 
        wp_reset_postdata( );
        ?>
    </main>
<?php get_footer() ?>