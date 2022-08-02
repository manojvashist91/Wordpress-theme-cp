<?php
/**
 * Template Name: Referral Partners Template
 *
 * @package WordPress
 * @subpackage Starter theme
 * @since Starter theme
 */
get_header();
?>
    <main class="main-container">

        <?php

        //$hero_banner_heading = carbon_get_post_meta(get_the_ID(), 'hero_banner_heading');
        $hero_banner_image = carbon_get_post_meta(get_the_ID(), 'hero_banner_image');
        $hero_banner_content = carbon_get_post_meta(get_the_ID(), 'hero_banner_content');

        ?>
        <section class="hero-banner banner-sm f-center flex-column flex-md-row overlay-white pt-xl-5">
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
                <?php endif; ?>
                <!-- <video autoplay loop>
                    <sources type="video/mp4" src="images/Screen Recording 2022-03-08 at 8.17.19 PM.mov">
                </video> -->
            </div>
            <div class="container-xl container h-100">
                <div class="content-wrap text-center text-xl-start">
                <h1 class="cmn-heading border-left">
                    <?php echo single_post_title(); ?>
                </h1>
                <p><?php echo $hero_banner_content; ?></p>
                </div>
            </div>
        </section>

        <?php
        $referral_partners_sections = carbon_get_post_meta(get_the_ID(), 'referral_partners_section');
        ?>

        <section class="container-xl mt-8 pb-8">
            <?php
            $card_count = 0;
            foreach ($referral_partners_sections as $referral_partners_section):
                $referral_partners_title   = $referral_partners_section['referral_partners_title'];
                $title = str_replace(' ', '',$referral_partners_title);
            ?>
            <div class="block-collapse" id="<?php echo $title; ?>">
                <div class="bg-white cmn-radius-box">
                    <div class="row">
                        <div class="col-xl-6 pe-xl-5">

                            <div class="cmn-radius-box">
                                <?php
                                $referral_partners_image = $referral_partners_section['referral_partners_image'];
                                if(!empty($referral_partners_image)):
                                   $referral_partners_image_attached_d = get_media_url($referral_partners_image,'refferral-content-d');
                                   $referral_partners_image_attached_t = get_media_url($referral_partners_image,'refferral-content-t');
                                   $referral_partners_image_attached_m = get_media_url($referral_partners_image,'refferral-content-m');
                                ?>
                                <picture>
                                    <!-- Desktop -->
                                    <source class="w-100 0-cover" media="(min-width: 1200px)" srcset="<?php echo $referral_partners_image_attached_d; ?>">
                                    <!-- Tab -->
                                    <source class="w-100 0-cover" media="(min-width: 575px)" srcset="<?php echo $referral_partners_image_attached_t; ?>">
                                    <!-- Mobile -->
                                    <img class="w-100 0-cover" src="<?php echo $referral_partners_image_attached_m; ?>" alt="">
                                </picture>
                                <?php
                                endif;
                                ?>
                            </div>

                        </div>
                        <div class="col-xl-6 f-center">
                            <div>
                                <h2 class="text-blue"><?php echo $referral_partners_section['referral_partners_title']; ?></h2>
                                <p><?php echo $referral_partners_section['referral_partners_content']; ?></p>
                            </div>
                        </div>
                    </div>
                    <div class="collapse" id="collapseExample-<?php echo $card_count; ?>">
                        <div class="card card-body">

                                <?php 
                                $rps_content = $referral_partners_section['referral_partners_collapsible_content'];
                                echo apply_filters('the_content',wpautop($rps_content));
                                ?>
                            
                        </div>
                    </div>
                    <button class="btn d-flex justify-content-center align-items-center cmn-btn w-100 shadow-none text-green mt-4" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapseExample-<?php echo $card_count; ?>" aria-expanded="false" aria-controls="collapseExample-<?php echo $card_count; ?>">
                        <i class="fa-solid fa-chevron-down"></i><span class="mx-3 d-inline-block"><span class="text-show"><?php esc_html_e( 'Show', THEME_TEXTDOMAIN) ?></span><span class="text-hide"><?php esc_html_e( 'Hide', THEME_TEXTDOMAIN) ?></span><?php esc_html_e( ' Details', THEME_TEXTDOMAIN) ?></span><i class="fa-solid fa-chevron-down"></i>
                    </button>
                </div>
            </div>
            <?php
                $card_count++;
            endforeach;
            ?>

        </section>

        <!-- Box wrapper -->
        <?php

        $cta_heading = carbon_get_post_meta(get_the_ID(), 'cta_heading');
        $cta_content = carbon_get_post_meta(get_the_ID(), 'cta_content');
        $cta_link = carbon_get_post_meta(get_the_ID(), 'cta_link');

        ?>
        <section class="contact-us-block bg-gradient-green py-6 mb-8">
            <div class="container-xxl container text-center text-white">
                <h2 class="h1"><strong><?php echo $cta_heading; ?></strong></h2>
                <p><?php echo $cta_content; ?></p>
                <a href="<?php echo $cta_link['url']; ?>" class="btn bg-blue cmn-btn curve-left mt-5" target="<?php if($cta_link['blank'] != 0): echo "_blank"; endif; ?>"><?php echo $cta_link['anchor'] ; ?></a>
            </div>
        </section>
        <!-- Box wrapper -->

        <!-- Location Section -->
        <?php
        get_template_part('page-templates/global-sections/office-locations');
        ?>
        <!-- /Location Section -->
        <!-- Our Partner Section -->
        <?php
        get_template_part('page-templates/global-sections/our-partner-logo');
        ?>
        <!-- /Our Partner Section -->
    </main>
<?php
get_footer();

