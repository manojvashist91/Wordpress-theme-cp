<?php
/**
 * Template Name: Who We Are Template
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
                        <source src="<?php echo $attached_hero_bg_video_link_file; ?>"
                                type="video/webm">
                        <source src="<?php echo $attached_hero_bg_video_link_file; ?>"
                                type="video/mp4">
                                <?php esc_html_e( 'Sorry, your browser does not support embedded videos.', THEME_TEXTDOMAIN) ?>
                    </video>
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
                            <button type="button" class="btn cmn-play" type_video="youtube" video_link="<?php echo $hero_pop_video_link ?>" data-bs-toggle="modal"
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
                                <button type="button" class="btn cmn-play" type_video="uploaded" video_poster="<?php echo $attached_hero_popup_bg_video_banner; ?>" video_link="<?php echo $attached_hero_pop_video_link_file; ?>" data-bs-toggle="modal"
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
            <div class="banner-slide-prev d-none d-md-flex circle-btn bg-green d-none">
                <i class="fa-solid fa-angle-left"></i>
            </div>
            <div class="banner-slide-next d-none d-md-flex circle-btn bg-green d-none">
                <i class="fa-solid fa-angle-right"></i>
            </div>
        </div>
    </section>

<?php
$we_help_construction_businesses_heading_line_1 = carbon_get_post_meta( get_the_ID(),'we_help_construction_businesses_heading_line_1');
$we_help_construction_businesses_heading= explode(" | ", $we_help_construction_businesses_heading_line_1);
$we_help_construction_businesses_heading_line_2 = carbon_get_post_meta( get_the_ID(),'we_help_construction_businesses_heading_line_2');
$we_help_construction_businesses_content = carbon_get_post_meta( get_the_ID(),'we_help_construction_businesses_content');

?>
    <section class="container-sm info-sec text-center">
        <h2 class="text-blue mb-3"><?php echo $we_help_construction_businesses_heading[0]; ?><br> <?php echo $we_help_construction_businesses_heading[1]; ?></h2>
        <p><?php echo apply_filters( 'the_content', $we_help_construction_businesses_content ); ?></p>
    </section>
        <!-- What sets up apart -->
        <?php
        $what_sets_us_apart_heading_1 = carbon_get_post_meta( get_the_ID(),'what_sets_us_apart_heading_1');
        $what_sets_us_apart_heading= explode(" | ", $what_sets_us_apart_heading_1);
        $what_sets_us_apart_heading_2 = carbon_get_post_meta( get_the_ID(),'what_sets_us_apart_heading_2');
        $what_sets_us_apart_cards = carbon_get_post_meta( get_the_ID(),'what_sets_us_apart_cards');

?>
        <section class="container-xxl container text-center radius-cards pt-8">
            <div class="container-xs">
            <h2 class="cmn-heading h1">
                <?php echo esc_html( $what_sets_us_apart_heading[0] ); ?> <strong> <?php echo esc_html( $what_sets_us_apart_heading[1] ); ?> </strong>
            </h2>
            </div>
            <div class="row text-start mt-6">

                <?php
                    foreach ( $what_sets_us_apart_cards as $what_sets_us_apart_card ) {
                ?>
                <div class="col-xxxl-3 col-xxl-4 col-md-6">
                    <div class="cmn-radius-box bg-white card overflow-visible">
                        <div class="card-icon f-center">
                            <?php
                                $what_sets_us_apart_card_image = $what_sets_us_apart_card['what_sets_us_apart_cards_image'];
                                $what_sets_us_apart_attached_images = get_media_url( $what_sets_us_apart_card_image,'full');
                                $what_sets_us_apart_cards_title = $what_sets_us_apart_card['what_sets_us_apart_cards_title'];
                                if(!empty($what_sets_us_apart_attached_images))
                                {
                            ?>
                            <img src="<?php echo $what_sets_us_apart_attached_images; ?>" alt="stopwatch-png">
                            <?php
                                }
                            ?>

                        </div>
                        <h3 class="h2 text-blue mb-2 text-center"><?php echo $what_sets_us_apart_cards_title; ?></h3>
                        <ul class="cmn-list">
                            <?php
                            $card_lists = $what_sets_us_apart_card['what_sets_us_apart_cards'];
                            foreach($card_lists as $card_list):
                            ?>
                            <li><?php echo apply_filters( 'the_content', $card_list['what_sets_us_apart_cards_list']); ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
                <?php
                   }
                ?>
            </div>
        </section>
        <!--End What sets up apart -->
        <!-- Our stories -->
        <?php
        $our_story_heading = carbon_get_post_meta( get_the_ID(),'our_story_heading');
        $our_story_heading_content = carbon_get_post_meta( get_the_ID(),'our_story_heading_content');

        $our_story_background_image = carbon_get_post_meta( get_the_ID(),'our_story_background_image');
        $story_background_image_attached_images_d = get_media_url( $our_story_background_image,'who-we-are-main-bg-d');
        $story_background_image_attached_images_t = get_media_url( $our_story_background_image,'who-we-are-main-bg-t');
        $story_background_image_attached_images_m = get_media_url( $our_story_background_image,'who-we-are-main-bg-m');

        $our_story_right_side_image = carbon_get_post_meta( get_the_ID(),'our_story_right_side_image');
        $our_story_right_side_image_attached_images_d = get_media_url( $our_story_right_side_image,'who-we-are-main-d');
        $our_story_right_side_image_attached_images_t = get_media_url( $our_story_right_side_image,'who-we-are-main-t');
        $our_story_right_side_image_attached_images_m = get_media_url( $our_story_right_side_image,'who-we-are-main-m');
        //our_story_list_content
        $our_story_heading_break= explode(" | ", $our_story_heading);
        ?>
        <section class="our-stories-sec overlay-blue py-5">
            <picture>
                <!-- Desktop -->
                <source media="(min-width: 1200px)" srcset="<?php echo $story_background_image_attached_images_d; ?>">
                <!-- Tab -->
                <source media="(min-width: 575px)" srcset="<?php echo $story_background_image_attached_images_t; ?>">
                <!-- Mobile -->
                <img src="<?php echo $story_background_image_attached_images_m; ?>" alt="">
            </picture>

            <div class="container-xxl container text-white position-relative">
                <div class="row pt-5">
                    <div class="col-xl-5">
                        <h2 class="h1 cmn-heading border-left text-white"><?php echo $our_story_heading_break[0]; ?>
                            <strong><?php echo $our_story_heading_break[1]; ?></strong>
                        </h2>
                        <p><?php echo apply_filters( 'the_content', $our_story_heading_content ); ?></p>
                    </div>
                    <div class="col-xl-7 f-center">
                        <div class="cmn-radius-img-wrap">
                                <?php
                        if(!empty($our_story_right_side_image_attached_images_d)):
                        ?>
                        <picture>
                            <!-- Desktop -->
                            <source class="img-fluid" media="(min-width: 1200px)" srcset="<?php echo $our_story_right_side_image_attached_images_d; ?>">
                            <!-- Tab -->
                            <source class="img-fluid" media="(min-width: 575px)" srcset="<?php echo $our_story_right_side_image_attached_images_t; ?>">
                            <!-- Mobile -->
                            <img class="img-fluid" src="<?php echo $our_story_right_side_image_attached_images_m; ?>" alt="">
                        </picture>
                        <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Our stories -->
        <!-- Meet our team -->

        <?php
         get_template_part( '/page-templates/our-team-template' );

        ?>
        <!-- End Meet our team -->
        
        <!-- Location Section -->
        <?php
        get_template_part('page-templates/global-sections/office-locations');
        ?>
        <!-- /Location Section -->
        <?php
        get_template_part('page-templates/global-sections/our-partner-logo');
        ?>
    </main>
<?php
get_footer();
?>