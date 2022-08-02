<?php

/**
 * Template Name: Contact Us Template
 *
 * @package WordPress
 * @subpackage Starter theme
 * @since Starter theme
 */
get_header();
?>
 <?php

        $hero_banner_image = carbon_get_post_meta( get_the_ID(),'hero_banner_image');
        ?>
    <!-- Banner Section -->
    <section class="hero-banner banner-sm contract-banner f-center flex-column flex-md-row overlay-white pt-xl-5">
        <div class="zoom-out-effect">
            <?php
            if(!empty($hero_banner_image)):
                $hero_banner_image_attached_images_d = get_media_url($hero_banner_image,'page-banner-d');
                $hero_banner_image_attached_images_t = get_media_url($hero_banner_image,'page-banner-t');
                $hero_banner_image_attached_images_m = get_media_url($hero_banner_image,'page-banner-m');
                ?>
                <picture>
                    <!-- Desktop -->
                    <source class="o-cover" media="(min-width: 1200px)" srcset="<?php echo $hero_banner_image_attached_images_d; ?>">
                    <!-- Tab -->
                    <source class="o-cover" media="(min-width: 575px)" srcset="<?php echo $hero_banner_image_attached_images_t; ?>">
                    <!-- Mobile -->
                    <img class="o-cover" src="<?php echo $hero_banner_image_attached_images_m; ?>" alt="Hero Banner Image">
                </picture>
                <!-- <video autoplay loop>
                    <sources type="video/mp4" src="images/Screen Recording 2022-03-08 at 8.17.19 PM.mov">
                </video> -->
            <?php endif; ?>
        </div>
        <div class="container-xl container h-100">
            <div class="content-wrap text-center text-xl-start">
            <h1 class="cmn-heading border-left">
                <?php echo single_post_title(); ?>
            </h1>
            </div>
        </div>

    </section>
    <!-- /Banner Section -->
    <!-- Box wrapper -->
    <!-- Contact From Section -->

<?php
$shortcode_code = carbon_get_post_meta(get_the_ID(), 'shortcode_code');
$form_heading = carbon_get_post_meta(get_the_ID(), 'form_heading');
$form_content = carbon_get_post_meta(get_the_ID(), 'form_content');
?>

    <section class="contract-form-wrap container-xl container pb-8">
            <div class="bg-white pt-6 pb-6" style="background-image: url('<?php echo get_bloginfo('stylesheet_directory') ?>/assets/theme/img/bg-img.png');">
                <div class="row mx-0">
                    <div class="col-xl-5 px-6 f-center">
                        <div>
                            <h2 class="cmn-heading border-below text-blue"><?php echo $form_heading; ?></h2>
                            <p><?php echo $form_content; ?></p>
                        </div>
                    </div>
                    <div class="col-xl-7 px-6 f-center">
                        <div class="nf-custom-style">
                        <?php echo do_shortcode($shortcode_code); ?>
                        </div>
                    </div>
                </div>
            </div>
    </section>
    <!-- /Contact From Section -->

<?php
$cta_heading = carbon_get_post_meta(get_the_ID(), 'cta_heading');

$fa_heading = carbon_get_theme_option('fa_heading');
$fa_content = carbon_get_theme_option('fa_content');
$fa_shortcode = carbon_get_theme_option('fa-shortcode');


?>
    <!-- Modal -->
    <div class="modal fade" id="Modal-fa" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-container contact-modal">
            <div class="modal-content">
                <div class="modal-header bg-grey">
                    <button type="button" class="btn-close btn bg-green cmn-btn min-width-initial"
                            data-bs-dismiss="modal" aria-label="Close"><i class="fa-solid fa-xmark"></i></button>
                </div>
                <div class="modal-body px-6 py-6">
                    <h2 class="text-blue mb-30"><?php echo $fa_heading; ?></h2>
                    <p><?php echo $fa_content; ?></p>
                    <div class="nf-custom-style">
                        <?php echo do_shortcode($fa_shortcode); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <section class="contact-us-block bg-gradient-green py-6 mb-8">
        <div class="container-xxl container text-center text-white">
            <h2 class="h1"><strong><?php echo $cta_heading; ?></strong></h2>
            <div class="cmn-btn-group d-flex flex-column align-items-center">
                <a data-bs-toggle="modal" data-bs-target="#Modal-fa"  target="_blank" href="#" class="btn bg-blue cmn-btn curve-left mt-4 selected-mfa"><?php  echo __( 'Click here to apply',THEME_TEXTDOMAIN  ); ?></a>
            </div>
        </div>
    </section>
    <!-- Location Section -->
<?php
    get_template_part('page-templates/global-sections/office-locations');
    get_template_part('page-templates/global-sections/our-partner-logo');
?>
<?php
get_footer();
