<?php
/**
 * Template Name: Case Studies Template
 *
 * @package WordPress
 * @subpackage Starter theme
 * @since Starter theme
 */
get_header();
//Hero Heading
$hero_heading = carbon_get_post_meta( get_the_ID(),'hero_heading');
$hero_heading_separated = explode(" | ", $hero_heading);
$hero_heading_separated_for_strong = explode(" || ", $hero_heading);
$hero_content = carbon_get_post_meta( get_the_ID(),'hero_content');

$result_hero_content = explode("<!--more-->",$hero_content);

//Hero Banner Image
$hero_banner_image = carbon_get_post_meta( get_the_ID(),'hero_banner_image');
$attached_hero_banner_image_d = get_media_url($hero_banner_image,'page-banner-d');
$attached_hero_banner_image_t = get_media_url($hero_banner_image,'page-banner-t');
$attached_hero_banner_image_m = get_media_url($hero_banner_image,'page-banner-m');

// Background Video
$hero_bg_options = carbon_get_post_meta( get_the_ID(),'hero_bg_options');
$hero_bg_video_link_file = carbon_get_post_meta( get_the_ID(),'hero_bg_video_link_file'); // SelfHosted
$attached_hero_bg_video_link_file = wp_get_attachment_url($hero_bg_video_link_file);
$hero_bg_video_banner = carbon_get_post_meta(get_the_ID(),'hero_bg_video_banner');
$attached_hero_bg_video_banner = get_media_url($hero_bg_video_banner,'full');

// pop-Up Video
$hero_pop_video_options = carbon_get_post_meta( get_the_ID(),'hero_pop_video_options');
$hero_pop_video_link = carbon_get_post_meta( get_the_ID(),'hero_pop_video_link'); // Youtube
$hero_pop_video_link_file = carbon_get_post_meta( get_the_ID(),'hero_pop_video_link_file'); // SelfHosted
$attached_hero_pop_video_link_file = wp_get_attachment_url($hero_pop_video_link_file);
$hero_popup_bg_video_banner = carbon_get_post_meta(get_the_ID(),'hero_popup_bg_video_banner');
$attached_hero_popup_bg_video_banner = get_media_url($hero_popup_bg_video_banner,'full');

// Hero slider Button New
$banner_button_complex = carbon_get_post_meta(get_the_id(),'banner_button_complex');

// Hero Banner logo section (Global)
$hero_banner_logos = carbon_get_theme_option('hero_banner_logos');




        ?>
    <section class="hero-banner f-center flex-column flex-md-row pt-xl-5">
        <div class="zoom-out-effect overlay-white" id="uploaded_file_1">
            <?php
            if($hero_bg_options == 'uploaded'){
                ?>
            <div id="uploaded_file">
                <video loop autoplay muted poster="<?php echo $attached_hero_bg_video_banner; ?> " >
                    <source src="<?php echo $attached_hero_bg_video_link_file; ?>" type="video/mp4">
                    <source src="<?php echo $attached_hero_bg_video_link_file; ?>" type="video/ogg">
                    <?php esc_html_e( 'Your browser does not support the video tag.', THEME_TEXTDOMAIN) ?>
                </video>
            </div>
                </div>
                <?php
            }
            elseif($hero_bg_options == 'image'){
                ?>
                <picture>
                    <!-- Desktop -->
                    <source media="(min-width: 1200px)" srcset="<?php echo $attached_hero_banner_image_d; ?>">
                    <!-- Tab -->
                    <source media="(min-width: 575px)" srcset="<?php echo $attached_hero_banner_image_t; ?>">
                    <!-- Mobile -->
                    <img src="<?php echo $attached_hero_banner_image_m; ?>" alt="Hero Banner Image">
                </picture>
                <?php
            }
            ?>
        </div>

        <div class="container-xl container h-100">
            <div class="content-wrap">
                <div class="row w-100">
                    <div class="col-xxl-6 col-lg-7 order-2 order-sm-1 text-lg-start text-center">

                        <h1 class="text-green"><?php echo esc_html( $hero_heading_separated[0] ); ?>
                            <span class="text-blue"><strong><?php echo esc_html( $hero_heading_separated[1] ); ?></strong></span></h1>

                        <p>
                            <!-- Load More Logic -->
                            <?php echo apply_filters( 'the_content', $result_hero_content[0] ); ?>
                            <div class="collapse" id="banner-content"><?php echo apply_filters( 'the_content', $result_hero_content[1] ); ?></div>
                            <!-- Load More Logic -->

                        </p>

                        <div class="cmn-btn-group d-flex flex-wrap flex-column flex-sm-row justify-content-center justify-content-lg-start align-items-center">
                        <!-- Load More Button -->
                        <?php
                            if(!empty($result_hero_content[1])){
                                ?>
                                <a href="#banner-content" aria-controls="banner-content" aria-expanded="false" data-bs-toggle="collapse" class="btn bg-blue cmn-btn curve-left" target="_blank">
                                    <span class="show"><?php echo __( 'Hide',THEME_TEXTDOMAIN  ); ?></span>
                                    <span class="hide"><?php echo __( 'Read More',THEME_TEXTDOMAIN  ); ?></span>
                                </a>
                                <?php
                            }
                        ?>
                        <!-- Load More Button -->
                        <!-- New Button Logic -->
                        <?php  
                            foreach($banner_button_complex as $button){
                                
                                $banner_button_type = $button['banner_button_type'];
                                $hero_button_type_link = $button['hero_button_type_link'];
                                $hero_popup_button_select = $button['hero_popup_button_select'];
                                $hero_popup_button_text = $button['hero_popup_button_text'];

                                if($banner_button_type == 'link'){
                                    ?>
                                    <a href="<?php echo $hero_button_type_link['url'] ; ?>" class="btn bg-blue cmn-btn curve-left" target="<?php if($hero_button_type_link['blank'] != 0): echo "_blank"; endif; ?>"><?php echo $hero_button_type_link['anchor'] ; ?></a>
                                    <?php
                                }
                                else{
                                    if($hero_popup_button_select == 'fa'){
                                        ?>
                                            <a data-bs-toggle="modal" data-bs-target="#Modal-rfa" href="#" target="_blank" class="btn bg-green cmn-btn"><?php echo $hero_popup_button_text; ?></a>
                                        <?php
                                    }
                                }
                            }
                        ?>
                        <!-- New Button Logic -->

                        </div>

                    </div>
                    <div class="col-xxl-4 col-lg-5 offset-xxl-2 pe-xl-5 order-1 order-sm-2 f-center play-btn-box">
                        <!-- Button trigger modal -->

                            <?php
                            if($hero_pop_video_options == 'youtube'){
                                if(!empty($hero_pop_video_link)){
                                ?>
                        <div class="cmn-play-wrap f-center">
                                <button type="button" class="btn cmn-play"  type_video="youtube" video_link="<?php echo $hero_pop_video_link ?>" data-bs-toggle="modal"
                                        data-bs-target="#Modal">
                                    <div class="cmn-play-btn">
                                        <i class="fa-solid fa-play"></i>
                                    </div>
                                </button>
                            <span class="ripple"></span>
                            <span class="ripple"></span>
                            <span class="ripple"></span>
                            <span class="ripple"></span>
                            <span class="ripple"></span>
                            <span class="ripple"></span>
                        </div>
                                <?php
                                }
                            }
                            else {
                                if(!empty($attached_hero_pop_video_link_file)){
                                ?>
                            <div class="cmn-play-wrap f-center">
                                <button type="button" class="btn cmn-play"  type_video="uploaded" video_poster="<?php echo $attached_hero_popup_bg_video_banner; ?>"  video_link="<?php echo $attached_hero_pop_video_link_file; ?>" data-bs-toggle="modal"
                                        data-bs-target="#Modalupload">
                                    <div class="cmn-play-btn">
                                        <i class="fa-solid fa-play"></i>
                                    </div>
                                </button>
                                <div class="video-tag-uploaded">
                                    <source class="upload_video_src" src="<?php echo $attached_hero_pop_video_link_file; ?>" type="video/mp4">
                                    <source class="upload_video_src" src="<?php echo $attached_hero_pop_video_link_file; ?>" type="video/ogg">
                                </div>
                                <span class="ripple"></span>
                                <span class="ripple"></span>
                                <span class="ripple"></span>
                                <span class="ripple"></span>
                                <span class="ripple"></span>
                                <span class="ripple"></span>
                            </div>
                                <?php
                                }
                            }
                            ?>

                    </div>
                </div>
            </div>
        </div>
        <div class="cmn-navigation-wrap cmn-radius-box bg-white">
            <div class="swiper banner-slider h-100">
                <div class="swiper-wrapper">
                    <?php
                    foreach ( $hero_banner_logos as $hero_logo ) {
                        $banner_logo_image_attached_images_d = get_media_url($hero_logo['banner_logo_image'],'hero-logo-d');
                        ?>
                        <div class="swiper-slide h-auto f-center">
                            <img class="o-contain" src="<?php echo $banner_logo_image_attached_images_d; ?>" alt="Partner Logos">
                        </div>
                        <?php
                    }
                    ?>
                </div>
            </div>
            <div class="banner-slide-prev d-none d-xl-flex circle-btn bg-green d-none">
                <i class="fa-solid fa-angle-left"></i>
            </div>
            <div class="banner-slide-next d-none d-xl-flex circle-btn bg-green d-none">
                <i class="fa-solid fa-angle-right"></i>
            </div>
        </div>
    </section>
        <?php
        get_template_part('page-templates/global-sections/case-studies-section-template');
        ?>
       
        <?php
        get_template_part('page-templates/service-category-term-meta-template');
        ?>
        <!-- /Custom Cards Section -->

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

