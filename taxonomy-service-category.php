<?php

get_header();
$queried_object = get_queried_object();
$term_id = $queried_object->term_id;


$hero_heading = carbon_get_term_meta( $term_id,'hero_heading');
$hero_heading_separated = explode(" | ", $hero_heading);
$hero_heading_separated_for_strong = explode(" || ", $hero_heading);
$hero_content = carbon_get_term_meta( $term_id,'hero_content');
$result_hero_content = explode("<!--more-->",$hero_content);

//Hero Banner Image
$hero_banner_image = carbon_get_term_meta( $term_id,'hero_banner_image');
$attached_hero_banner_image_d = get_media_url($hero_banner_image,'page-banner-d');
$attached_hero_banner_image_t = get_media_url($hero_banner_image,'page-banner-t');
$attached_hero_banner_image_m = get_media_url($hero_banner_image,'page-banner-m');

// Background Video
$hero_bg_options = carbon_get_term_meta( $term_id,'hero_bg_options');
$hero_bg_video_link_file = carbon_get_term_meta( $term_id,'hero_bg_video_link_file'); // SelfHosted
$attached_hero_bg_video_link_file = wp_get_attachment_url($hero_bg_video_link_file);
$hero_bg_video_banner = carbon_get_term_meta($term_id,'hero_bg_video_banner');
$attached_hero_bg_video_banner = get_media_url($hero_bg_video_banner,'full');

// pop-Up Video
$hero_pop_video_options = carbon_get_term_meta( $term_id,'hero_pop_video_options');
$hero_pop_video_link = carbon_get_term_meta( $term_id,'hero_pop_video_link'); // Youtube
$hero_pop_video_link_file = carbon_get_term_meta( $term_id,'hero_pop_video_link_file'); // SelfHosted
$attached_hero_pop_video_link_file = get_media_url($hero_pop_video_link_file);
$hero_popup_bg_video_banner = carbon_get_term_meta($term_id,'hero_popup_bg_video_banner');
$attached_hero_popup_bg_video_banner = get_media_url($hero_popup_bg_video_banner,'full');

// Hero Banner logo section (Global)
$hero_banner_logos = carbon_get_theme_option('hero_banner_logos');

// Hero slider Button New
$banner_button_complex = carbon_get_term_meta($term_id,'banner_button_complex');

?>

    <!-- Banner Section -->
    <section class="hero-banner f-center flex-column flex-md-row overlay-white pt-xl-5">
        <div class="zoom-out-effect" id="uploaded_file_1">
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

        <div class="container-xxl container h-100">
            <div class="content-wrap">
                <div class="row w-100">
                    <div class="col-xl-5 col-lg-7 px-xl-0 order-2 order-sm-1 text-lg-start text-center">

                        <h1 class="text-green"><?php echo esc_html($hero_heading_separated[0]); ?><span class="text-blue"><strong><?php echo esc_html( $hero_heading_separated[1]); ?></strong></span></h1>

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
                                <a href="<?php echo $hero_button_type_link['url'] ; ?>" class="btn bg-green cmn-btn" target="<?php if($hero_button_type_link['blank'] != 0): echo "_blank"; endif; ?>"><?php echo $hero_button_type_link['anchor'] ; ?></a>
                                <?php
                            }
                            else{
                                if($hero_popup_button_select == 'fa'){
                                    ?>
                                        <a data-bs-toggle="modal" data-bs-target="#Modal-rfa" href="#" target="_blank" class="btn bg-blue cmn-btn curve-left"><?php echo $hero_popup_button_text; ?></a>
                                    <?php
                                }
                            }
                        }
                    ?>
                    <!-- New Button Logic -->

                        </div>

                    </div>
                    <div class="col-xl-4 col-lg-5 offset-xl-2 pe-xl-5 order-1 order-sm-2 f-center play-btn-box">
                        <!-- Button trigger modal -->

                            <?php
                            if($hero_pop_video_options == 'youtube'){
                                if(!empty($hero_pop_video_link)){
                                ?>
                        <div class="cmn-play-wrap f-center">
                                <div class="btn cmn-play" type_video="youtube" video_link="<?php echo $hero_pop_video_link ?>" data-bs-toggle="modal"
                                        data-bs-target="#Modal">
                                    <div class="cmn-play-btn">
                                        <i class="fa-solid fa-play"></i>
                                    </div>
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
                            else {
                                if(!empty($attached_hero_pop_video_link_file)){
                                ?>
                        <div class="cmn-play-wrap f-center">
                                <div class="btn cmn-play" type_video="uploaded" video_poster="<?php echo $attached_hero_popup_bg_video_banner; ?>"  video_link="<?php echo $attached_hero_pop_video_link_file; ?>" data-bs-toggle="modal"
                                        data-bs-target="#Modalupload">
                                    <div class="cmn-play-btn">
                                        <i class="fa-solid fa-play"></i>
                                    </div>
                                </div>
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
    <!-- /Banner Section -->
    <!-- Custom Cards Section -->
<?php
    $working_capital_options =  carbon_get_term_meta($term_id,'working_capital_options');
    if($working_capital_options == 'yes') {
        ?>
        <?php
        global $post;
        $services_category_posts = get_posts(array(
            'post_type' => 'services',
            'numberposts' => -1,
            'tax_query' => array(
                array(
                    'taxonomy' => 'service-category',
                    'field' => 'id',
                    'terms' => array($term_id),
                )
            )
        ));
        $working_capital_heading = carbon_get_term_meta( $term_id,'working_capital_heading');
        $working_capital_heading_separated = explode(" | ", $working_capital_heading);
        ?>
        <section class="position-relative cards-slider-wrap card-container text-center mt-8 pb-8">
            <h2 class="cmn-heading h1"><?php echo esc_html( $working_capital_heading_separated[0] ); ?>  <br /> <strong><?php echo esc_html( $working_capital_heading_separated[1] ); ?></strong></h2>
            <div class="cmn-navigation-wrap">
                <div class="swiper cards-slider text-start">
                    <div class="swiper-wrapper">
                        <?php
                        foreach ($services_category_posts as $post) : setup_postdata($post);
                        $service_page_title = carbon_get_post_meta( get_the_ID(), 'service_page_title');

                        $service_category_image_d = get_the_post_thumbnail_url(get_the_ID(), 'service-d' );
                        $service_category_image_t = get_the_post_thumbnail_url(get_the_ID(), 'service-t' );
                        $service_category_image_m = get_the_post_thumbnail_url(get_the_ID(), 'service-m' );

                        $services_video_options = carbon_get_post_meta( get_the_ID(), 'services_video_options');
                        $services_video_link = carbon_get_post_meta(get_the_ID(), 'services_video_link');
                        $services_video_link_file = carbon_get_post_meta( get_the_ID(), 'services_video_link_file');
                        $services_video_link_file = wp_get_attachment_url($services_video_link_file);

                        $services_video_banner_link_file = carbon_get_post_meta(get_the_ID(),'services_video_banner_link_file');
                        $services_video_baner_attached = get_media_url($services_video_banner_link_file,'full');

                        $service_page_content = carbon_get_post_meta( get_the_ID(), 'service_page_content');


                        ?>
                        <div class="swiper-slide h-auto">
                            <div class="card custom-cards h-100 bg-transparent">
                                <div class="card-inner d-flex flex-column align-items-start bg-white h-100">
                                    <div class="card-media w-100">
                                        <div class="ratio ratio-16x9 play-btn-wrap">
                                            <?php
                                            if(!empty($service_category_image_d)):
                                                ?>
                                                <picture>
                                                    <!-- Desktop -->
                                                    <source class="o-cover w-100 h-100" media="(min-width: 1200px)" srcset="<?php echo $service_category_image_d; ?>">
                                                    <!-- Tab -->
                                                    <source class="o-cover w-100 h-100" media="(min-width: 575px)" srcset="<?php echo $service_category_image_t; ?>">
                                                    <!-- Mobile -->
                                                    <img class="o-cover w-100 h-100" src="<?php echo $service_category_image_m; ?>" alt=" <?php echo esc_attr( $service_page_title); ?>">
                                                </picture>
                                            <?php endif ?>
                                            <?php
                                            if($services_video_options == 'youtube'){
                                            ?>
                                            <!-- Button trigger modal -->
                                                <?php if(!empty($services_video_link)): ?>
                                            <div class="cmn-play-wrap size-sm f-center">
                                                <div class="btn cmn-play" type_video="youtube" video_link="<?php
                                                echo $services_video_link; ?>" data-bs-toggle="modal"
                                                        data-bs-target="#Modal">
                                                    <div class="cmn-play-btn">
                                                        <i class="fa-solid fa-play"></i>
                                                    </div>
                                                </div>
                                                <span class="ripple"></span>
                                                <span class="ripple"></span>
                                                <span class="ripple"></span>
                                                <span class="ripple"></span>
                                                <span class="ripple"></span>
                                                <span class="ripple"></span>
                                            </div>
                                                <?php endif; ?>
                                                <?php
                                                }
                                                else {
                                                ?><!-- Button trigger modal -->
                                                    <?php if(!empty($services_video_link_file)): ?>
                                                <div class="cmn-play-wrap size-sm f-center">
                                                    <div class="btn cmn-play" video_poster="<?php echo $services_video_baner_attached; ?>" type_video="uploaded" video_link="<?php
                                                    echo $services_video_link_file; ?>" data-bs-toggle="modal"
                                                            data-bs-target="#Modalupload">
                                                        <div class="cmn-play-btn">
                                                            <i class="fa-solid fa-play"></i>
                                                        </div>
                                                    </div>
                                                    <div class="video-tag-uploaded">
                                                        <source class="upload_video_src" src="<?php echo $services_video_link_file; ?>" type="video/mp4">
                                                        <source class="upload_video_src" src="<?php echo $services_video_link_file; ?>" type="video/ogg">
                                                    </div>
                                                    <span class="ripple"></span>
                                                    <span class="ripple"></span>
                                                    <span class="ripple"></span>
                                                    <span class="ripple"></span>
                                                    <span class="ripple"></span>
                                                    <span class="ripple"></span>
                                                </div>
                                                    <?php endif; ?>
                                                    <?php
                                                    }
                                                    ?>
                                            </div>
                                        </div>
                                        <div class="card-body d-flex flex-column align-items-start">
                                            <a class="mb-3 h2" href="<?php echo esc_url( get_permalink(), THEME_TEXTDOMAIN ) ; ?>">
                                                <?php
                                                //echo esc_attr( $service_page_title);
                                                echo $post->post_title;
                                                ?>
                                            </a>
                                            <p>
                                                <?php
                                                //echo esc_attr($service_page_content );
                                                echo get_the_excerpt();
                                                ?>
                                            </p>
                                            <a class="btn bg-green cmn-btn mt-auto" href="<?php echo esc_url( get_permalink() , THEME_TEXTDOMAIN ) ; ?>">
                                                <?php  echo __( 'Learn More',THEME_TEXTDOMAIN  ); ?>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php endforeach;
                            wp_reset_postdata();
                            ?>
                        </div>
                    </div>
                    <?php
                    $count_arrow = 0;
                    foreach ( $services_category_posts as $posts_service ) :
                        if($count_arrow > 2):
                            ?>
                            <div class="card-slide-prev d-none d-xl-flex">
                                <i class="fa-solid fa-angle-left fa-2x"></i>
                            </div>
                            <div class="card-slide-next d-none d-xl-flex">
                                <i class="fa-solid fa-angle-right fa-2x"></i>
                            </div>
                        <?php
                        endif;
                        $count_arrow++;
                    endforeach;
                    wp_reset_postdata();
                    ?>
                </div>
        </section>
        <?php
    }
    ?>
    <?php
    $cat_how_it_works_dials_options =  carbon_get_term_meta( $term_id,'cat_how_it_works_dials_options');
    if($cat_how_it_works_dials_options == 'yes') {
        //get_template_part('page-templates/global-sections/how-it-works-cat');
        $cat_how_it_work_heading = carbon_get_term_meta($term_id,'cat_how_it_work_heading');
        $cat_how_it_work_heading_separated = explode(" | ", $cat_how_it_work_heading);

        $cat_how_it_work_image_title_one = carbon_get_term_meta($term_id,'cat_how_it_work_image_title_one');
        $cat_how_it_work_image_one = carbon_get_term_meta($term_id,'cat_how_it_work_image_one');
        $cat_how_it_work_image_one_attachment = get_media_url($cat_how_it_work_image_one,'full');

        $cat_how_it_work_image_with_title_two = carbon_get_term_meta( $term_id,'cat_how_it_work_image_with_title_two'); // complex
        $cat_how_it_work_image_with_title_three = carbon_get_term_meta( $term_id,'cat_how_it_work_image_with_title_three'); // complex
        $cat_how_it_work_image_with_title_four = carbon_get_term_meta( $term_id,'cat_how_it_work_image_with_title_four'); // complex
        $cat_how_it_work_image_with_title_five = carbon_get_term_meta( $term_id,'cat_how_it_work_image_with_title_five'); // complex
        $cat_how_it_work_image_with_title_six = carbon_get_term_meta( $term_id,'cat_how_it_work_image_with_title_six'); // complex

        // Dials switch case
        $cat_how_it_works_dials_count = carbon_get_term_meta($term_id,'cat_how_it_works_dials_count');

        switch ($cat_how_it_works_dials_count) {

            case "1": 
                ?>
                    <section class="steps-main-wrapper steps-one container-xxl container pt-8 pb-8 text-center">
                        <h2 class="h1 cmn-heading"><?php  echo $cat_how_it_work_heading_separated[0]; ?><strong> <?php echo $cat_how_it_work_heading_separated[1]; ?></strong></h2>
                        <!-- Desktop -->
                        <div class="circle-sec-wrap desktop-dials text-start mt-5 d-none d-xl-grid">
                            <div class="steps-content-odd">
                                <div class="content-box">
                                    <div class="d-flex align-items-initial h-100">
                                        <div class="icon-wrap f-center">
                                            <img class="o-contain" src="<?php echo $cat_how_it_work_image_one_attachment; ?>" alt="Step Image">
                                        </div>
                                        <div class="d-flex align-items-center">
                                        <p><?php echo $cat_how_it_work_image_title_one; ?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="circle-sec">
                                <div class="steps-circle f-center bg-white text-black">
                                        <div class="steps-border">
                                            <h3 class="h4 text-uppercase mb-0"><?php esc_html_e( 'STEP', THEME_TEXTDOMAIN) ?></h3>
                                            <h4 class="h1 mb-0"><?php esc_html_e( '01', THEME_TEXTDOMAIN) ?></h4>
                                        </div>
                                    </div>
                            </div>
                        </div>
                        <!-- Ipad -->
                        <div class="circle-sec-wrap-verticle tablet-dials text-start d-flex flex-column d-xl-none mt-5">
                            <div class="steps-wrap d-flex">
                                <div class="steps-circle f-center bg-white text-black">
                                    <div class="steps-border">
                                        <h3 class="h4 text-uppercase mb-0"><?php esc_html_e( 'Step', THEME_TEXTDOMAIN) ?></h3>
                                        <h4 class="h1 mb-0"><?php esc_html_e( '01', THEME_TEXTDOMAIN) ?></h4>
                                    </div>
                                </div>
                                <div class="content-box d-flex flex-column align-items-start">
                                    <div class="icon-wrap f-center">
                                        <img class="o-contain" src="<?php echo $cat_how_it_work_image_one_attachment; ?>" alt="Step One Image">
                                    </div>
                                    <p><?php echo $cat_how_it_work_image_title_one; ?></p>
                                </div>
                            </div>
                        </div>
                    </section>
                <?php
                break;

            case "2": 
                ?>
                    <section class="steps-main-wrapper steps-two container-xxl container pt-8 pb-8 text-center">
                        <h2 class="h1 cmn-heading"><?php  echo $cat_how_it_work_heading_separated[0]; ?><strong> <?php echo $cat_how_it_work_heading_separated[1]; ?></strong></h2>
                        <!-- Desktop -->
                        <div class="circle-sec-wrap desktop-dials text-start mt-5 d-none d-xl-grid">
                            <div class="steps-content-odd">
                                <?php
                                $count_loop = 0;
                                foreach($cat_how_it_work_image_with_title_two as $how_it_work_image_with_title ):
                                    if($count_loop < 1):
                                        ?>
                                        <div class="content-box">
                                            <div class="d-flex align-items-initial h-100">
                                                <div class="icon-wrap f-center">
                                                    <?php
                                                    if(!empty($how_it_work_image_with_title['how_it_work_image'])):
                                                        $how_it_work_image_attachment = get_media_url($how_it_work_image_with_title['how_it_work_image'],'full');
                                                        ?>
                                                        <img class="o-contain" src="<?php echo $how_it_work_image_attachment; ?>" alt="Step Image">
                                                    <?php endif; ?>
                                                </div>
                                                <div class="d-flex align-items-center">
                                                <p><?php echo $how_it_work_image_with_title['how_it_work_image_title']; ?></p></div>
                                            </div>
                                        </div>
                                    <?php
                                    endif;
                                    $count_loop++;
                                endforeach;
                                ?>
                            </div>
                            <div class="circle-sec">
                                <div class="steps-circle f-center bg-white text-black">
                                        <div class="steps-border">
                                            <h3 class="h4 text-uppercase mb-0"><?php esc_html_e( 'STEP', THEME_TEXTDOMAIN) ?></h3>
                                            <h4 class="h1 mb-0"><?php esc_html_e( '01', THEME_TEXTDOMAIN) ?></h4>
                                        </div>
                                    </div>
                                <div class="steps-circle f-center bg-white text-black">
                                    <div class="steps-border">
                                        <h3 class="h4 text-uppercase mb-0"><?php esc_html_e( 'STEP', THEME_TEXTDOMAIN) ?></h3>
                                        <h4 class="h1 mb-0"><?php esc_html_e( '02', THEME_TEXTDOMAIN) ?></h4>
                                    </div>
                                </div>
                            </div>
                            <div class="steps-content-even">
                                <?php
                                $count_loop = 1;
                                foreach($cat_how_it_work_image_with_title_two as $how_it_work_image_with_title ):
                                    if($count_loop > 1 ):
                                        ?>
                                        <div class="content-box">
                                            <div class="d-flex align-items-initial h-100">
                                                <div class="icon-wrap f-center">
                                                    <?php
                                                    if(!empty($how_it_work_image_with_title['how_it_work_image'])):
                                                        $how_it_work_image_attachment = get_media_url($how_it_work_image_with_title['how_it_work_image'],'full');
                                                        ?>
                                                        <img class="o-contain" src="<?php echo $how_it_work_image_attachment; ?>" alt="Step Image">
                                                    <?php endif; ?>
                                                </div>
                                                <div class="d-flex align-items-center">
                                                <p><?php echo $how_it_work_image_with_title['how_it_work_image_title']; ?></p>
                                                    </div>
                                            </div>
                                        </div>
                                    <?php
                                    endif;
                                    $count_loop++;
                                endforeach;
                                ?>
                            </div>
                        </div>
                        <!-- Ipad -->
                        <div class="circle-sec-wrap-verticle tablet-dials text-start d-flex flex-column d-xl-none mt-5">
                            <div class="steps-wrap d-flex">
                                <div class="steps-circle f-center bg-white text-black">
                                    <div class="steps-border">
                                        <h3 class="h4 text-uppercase mb-0"><?php esc_html_e( 'Step', THEME_TEXTDOMAIN) ?></h3>
                                        <h4 class="h1 mb-0"><?php esc_html_e( '01', THEME_TEXTDOMAIN) ?></h4>
                                    </div>
                                </div>
                                <div class="content-box d-flex flex-column align-items-start">
                                    <?php
                                    if(!empty($cat_how_it_work_image_with_title_two[0]['how_it_work_image'])):

                                    $how_it_work_image_attachment = get_media_url($cat_how_it_work_image_with_title_two[0]['how_it_work_image'],'full');
                                    ?>
                                    <div class="icon-wrap f-center">
                                        <img class="o-contain" src="<?php echo $how_it_work_image_attachment; ?>" alt="Step One Image">
                                    </div>
                                    <?php endif; ?>
                                    <p><?php echo $cat_how_it_work_image_with_title_two[0]['how_it_work_image_title']; ?></p>
                                </div>
                            </div>
                            <div class="steps-wrap d-flex">
                                <div class="steps-circle f-center bg-white text-black">
                                    <div class="steps-border">
                                        <h3 class="h4 text-uppercase mb-0"><?php esc_html_e( 'Step', THEME_TEXTDOMAIN) ?></h3>
                                        <h4 class="h1 mb-0"><?php esc_html_e( '02', THEME_TEXTDOMAIN) ?></h4>
                                    </div>
                                </div>
                                <div class="content-box d-flex flex-column align-items-start">
                                    <?php
                                    if(!empty($cat_how_it_work_image_with_title_two[1]['how_it_work_image'])):
                                        $how_it_work_image_attachment = get_media_url($cat_how_it_work_image_with_title_two[1]['how_it_work_image'],'full');
                                        ?>
                                        <div class="icon-wrap f-center">
                                            <img class="o-contain" src="<?php echo $how_it_work_image_attachment; ?>" alt="Step Two Image">
                                        </div>
                                    <?php endif; ?>
                                    <p><?php echo $cat_how_it_work_image_with_title_two[1]['how_it_work_image_title']; ?></p>
                                </div>
                            </div>
                        </div>
                    </section>
                <?php
                break;

            case "3": 
                ?>
                    <section class="steps-main-wrapper steps-three container-xxl container pt-8 pb-8 text-center">
                        <h2 class="h1 cmn-heading"><?php  echo $cat_how_it_work_heading_separated[0]; ?><strong> <?php echo $cat_how_it_work_heading_separated[1]; ?></strong></h2>
                        <!-- Desktop -->
                        <div class="circle-sec-wrap desktop-dials text-start mt-5 d-none d-xl-grid">
                            <div class="steps-content-odd">
                                <?php
                                $count_loop = 0;
                                foreach($cat_how_it_work_image_with_title_three as $how_it_work_image_with_title ):
                                    if($count_loop < 3 & $count_loop != 1):
                                        ?>
                                        <div class="content-box">
                                            <div class="d-flex align-items-initial h-100">
                                                <div class="icon-wrap f-center">
                                                    <?php
                                                    if(!empty($how_it_work_image_with_title['how_it_work_image'])):
                                                        $how_it_work_image_attachment = get_media_url($how_it_work_image_with_title['how_it_work_image'],'full');
                                                        ?>
                                                        <img class="o-contain" src="<?php echo $how_it_work_image_attachment; ?>" alt="Step Image">
                                                    <?php endif; ?>
                                                </div>
                                                <div class="d-flex align-items-center">
                                                <p><?php echo $how_it_work_image_with_title['how_it_work_image_title']; ?></p>
                                                    </div>
                                            </div>
                                        </div>
                                    <?php
                                    endif;
                                    $count_loop++;
                                endforeach;
                                ?>
                            </div>
                            <div class="circle-sec">
                                <div class="steps-circle f-center bg-white text-black">
                                        <div class="steps-border">
                                            <h3 class="h4 text-uppercase mb-0"><?php esc_html_e( 'STEP', THEME_TEXTDOMAIN) ?></h3>
                                            <h4 class="h1 mb-0"><?php esc_html_e( '01', THEME_TEXTDOMAIN) ?></h4>
                                        </div>
                                    </div>
                                <div class="steps-circle f-center bg-white text-black">
                                    <div class="steps-border">
                                        <h3 class="h4 text-uppercase mb-0"><?php esc_html_e( 'STEP', THEME_TEXTDOMAIN) ?></h3>
                                        <h4 class="h1 mb-0"><?php esc_html_e( '02', THEME_TEXTDOMAIN) ?></h4>
                                    </div>
                                </div>
                                <div class="steps-circle f-center bg-white text-black">
                                    <div class="steps-border">
                                        <h3 class="h4 text-uppercase mb-0"><?php esc_html_e( 'STEP', THEME_TEXTDOMAIN) ?></h3>
                                        <h4 class="h1 mb-0"><?php esc_html_e( '03', THEME_TEXTDOMAIN) ?></h4>
                                    </div>
                                </div>
                            </div>
                            <div class="steps-content-even">
                                <?php
                                $count_loop = 0;
                                foreach($cat_how_it_work_image_with_title_three as $how_it_work_image_with_title ):
                                    if($count_loop < 2 & $count_loop != 0):
                                        ?>
                                        <div class="content-box">
                                            <div class="d-flex align-items-initial h-100">
                                                <div class="icon-wrap f-center">
                                                    <?php
                                                    if(!empty($how_it_work_image_with_title['how_it_work_image'])):
                                                        $how_it_work_image_attachment = get_media_url($how_it_work_image_with_title['how_it_work_image'],'full');
                                                        ?>
                                                        <img class="o-contain" src="<?php echo $how_it_work_image_attachment; ?>" alt="Step Image">
                                                    <?php endif; ?>
                                                </div>
                                                <div class="d-flex align-items-center">
                                                <p><?php echo $how_it_work_image_with_title['how_it_work_image_title']; ?></p>
                                                    </div>
                                            </div>
                                        </div>
                                    <?php
                                    endif;
                                    $count_loop++;
                                endforeach;
                                ?>
                            </div>
                        </div>
                        <!-- Ipad -->
                        <div class="circle-sec-wrap-verticle tablet-dials text-start d-flex flex-column d-xl-none mt-5">
                            <div class="steps-wrap d-flex">
                                <div class="steps-circle f-center bg-white text-black">
                                    <div class="steps-border">
                                        <h3 class="h4 text-uppercase mb-0"><?php esc_html_e( 'Step', THEME_TEXTDOMAIN) ?></h3>
                                        <h4 class="h1 mb-0"><?php esc_html_e( '01', THEME_TEXTDOMAIN) ?></h4>
                                    </div>
                                </div>
                                <div class="content-box d-flex flex-column align-items-start">
                                    <?php
                                    if(!empty($cat_how_it_work_image_with_title_three[0]['how_it_work_image'])):

                                    $how_it_work_image_attachment = get_media_url($cat_how_it_work_image_with_title_three[0]['how_it_work_image'],'full');
                                    ?>
                                    <div class="icon-wrap f-center">
                                        <img class="o-contain" src="<?php echo $how_it_work_image_attachment; ?>" alt="Step One Image">
                                    </div>
                                    <?php endif; ?>
                                    <p><?php echo $cat_how_it_work_image_with_title_three[0]['how_it_work_image_title']; ?></p>
                                </div>
                            </div>
                            <div class="steps-wrap d-flex">
                                <div class="steps-circle f-center bg-white text-black">
                                    <div class="steps-border">
                                        <h3 class="h4 text-uppercase mb-0"><?php esc_html_e( 'Step', THEME_TEXTDOMAIN) ?></h3>
                                        <h4 class="h1 mb-0"><?php esc_html_e( '02', THEME_TEXTDOMAIN) ?></h4>
                                    </div>
                                </div>
                                <div class="content-box d-flex flex-column align-items-start">
                                    <?php
                                    if(!empty($cat_how_it_work_image_with_title_three[1]['how_it_work_image'])):
                                        $how_it_work_image_attachment = get_media_url($cat_how_it_work_image_with_title_three[1]['how_it_work_image'],'full');
                                        ?>
                                        <div class="icon-wrap f-center">
                                            <img class="o-contain" src="<?php echo $how_it_work_image_attachment; ?>" alt="Step Two Image">
                                        </div>
                                    <?php endif; ?>
                                    <p><?php echo $cat_how_it_work_image_with_title_three[1]['how_it_work_image_title']; ?></p>
                                </div>
                            </div>
                            <div class="steps-wrap d-flex">
                                <div class="steps-circle f-center bg-white text-black">
                                    <div class="steps-border">
                                        <h3 class="h4 text-uppercase mb-0"><?php esc_html_e( 'Step', THEME_TEXTDOMAIN) ?></h3>
                                        <h4 class="h1 mb-0"><?php esc_html_e( '03', THEME_TEXTDOMAIN) ?></h4>
                                    </div>
                                </div>
                                <div class="content-box d-flex flex-column align-items-start">
                                    <?php
                                    if(!empty($cat_how_it_work_image_with_title_three[2]['how_it_work_image'])):
                                        $how_it_work_image_attachment = get_media_url($cat_how_it_work_image_with_title_three[2]['how_it_work_image'],'full');
                                        ?>
                                        <div class="icon-wrap f-center">
                                            <img class="o-contain" src="<?php echo $how_it_work_image_attachment; ?>" alt="Step Three Image">
                                        </div>
                                    <?php endif; ?>
                                    <p><?php echo $cat_how_it_work_image_with_title_three[2]['how_it_work_image_title']; ?></p>
                                </div>
                            </div>
                        </div>
                    </section>
                <?php
                break;

            case "4": 
                ?>
                    <section class="steps-main-wrapper steps-four container-xxl container pt-8 pb-8 text-center">
                        <h2 class="h1 cmn-heading"><?php echo $cat_how_it_work_heading_separated[0]; ?><strong> <?php echo $cat_how_it_work_heading_separated[1]; ?></strong></h2>
                        <!-- Desktop -->
                        <div class="circle-sec-wrap desktop-dials text-start mt-5 d-none d-xl-grid">
                            <div class="steps-content-odd">
                                <?php
                                $count_loop = 0;
                                foreach($cat_how_it_work_image_with_title_four as $how_it_work_image_with_title ):
                                    if($count_loop < 3 & $count_loop != 1 ):
                                        ?>
                                        <div class="content-box">
                                            <div class="d-flex align-items-initial h-100">
                                                <div class="icon-wrap f-center">
                                                    <?php
                                                    if(!empty($how_it_work_image_with_title['how_it_work_image'])):
                                                        $how_it_work_image_attachment = get_media_url($how_it_work_image_with_title['how_it_work_image'],'full');
                                                        ?>
                                                        <img class="o-contain" src="<?php echo $how_it_work_image_attachment; ?>" alt="Step Image">
                                                    <?php endif; ?>
                                                </div>
                                                <div class="d-flex align-items-center">
                                                <p><?php echo $how_it_work_image_with_title['how_it_work_image_title']; ?></p>
                                                    </div>
                                            </div>
                                        </div>
                                    <?php
                                    endif;
                                    $count_loop++;
                                endforeach;
                                ?>
                            </div>
                            <div class="circle-sec">
                                <div class="steps-circle f-center bg-white text-black">
                                        <div class="steps-border">
                                            <h3 class="h4 text-uppercase mb-0"><?php esc_html_e( 'STEP', THEME_TEXTDOMAIN) ?></h3>
                                            <h4 class="h1 mb-0"><?php esc_html_e( '01', THEME_TEXTDOMAIN) ?></h4>
                                        </div>
                                    </div>
                                <div class="steps-circle f-center bg-white text-black">
                                    <div class="steps-border">
                                        <h3 class="h4 text-uppercase mb-0"><?php esc_html_e( 'STEP', THEME_TEXTDOMAIN) ?></h3>
                                        <h4 class="h1 mb-0"><?php esc_html_e( '02', THEME_TEXTDOMAIN) ?></h4>
                                    </div>
                                </div>
                                <div class="steps-circle f-center bg-white text-black">
                                    <div class="steps-border">
                                        <h3 class="h4 text-uppercase mb-0"><?php esc_html_e( 'STEP', THEME_TEXTDOMAIN) ?></h3>
                                        <h4 class="h1 mb-0"><?php esc_html_e( '03', THEME_TEXTDOMAIN) ?></h4>
                                    </div>
                                </div>
                                <div class="steps-circle f-center bg-white text-black">
                                    <div class="steps-border">
                                        <h3 class="h4 text-uppercase mb-0"><?php esc_html_e( 'STEP', THEME_TEXTDOMAIN) ?></h3>
                                        <h4 class="h1 mb-0"><?php esc_html_e( '04', THEME_TEXTDOMAIN) ?></h4>
                                    </div>
                                </div>
                            </div>
                            <div class="steps-content-even">
                                <?php
                                $count_loop = 0;
                                foreach($cat_how_it_work_image_with_title_four as $how_it_work_image_with_title ):
                                    if($count_loop < 5 & $count_loop != 0 & $count_loop != 2 ):
                                        ?>
                                        <div class="content-box">
                                            <div class="d-flex align-items-initial h-100">
                                                <div class="icon-wrap f-center">
                                                    <?php
                                                    if(!empty($how_it_work_image_with_title['how_it_work_image'])):
                                                        $how_it_work_image_attachment = get_media_url($how_it_work_image_with_title['how_it_work_image'],'full');
                                                        ?>
                                                        <img class="o-contain" src="<?php echo $how_it_work_image_attachment; ?>" alt="Step Image">
                                                    <?php endif; ?>
                                                </div>
                                                <div class="d-flex align-items-center">
                                                <p><?php echo $how_it_work_image_with_title['how_it_work_image_title']; ?></p>
                                                    </div>
                                            </div>
                                        </div>
                                    <?php
                                    endif;
                                    $count_loop++;
                                endforeach;
                                ?>
                            </div>
                        </div>
                        <!-- Ipad -->
                        <div class="circle-sec-wrap-verticle tablet-dials text-start d-flex flex-column d-xl-none mt-5">
                            <div class="steps-wrap d-flex">
                                <div class="steps-circle f-center bg-white text-black">
                                    <div class="steps-border">
                                        <h3 class="h4 text-uppercase mb-0"><?php esc_html_e( 'Step', THEME_TEXTDOMAIN) ?></h3>
                                        <h4 class="h1 mb-0"><?php esc_html_e( '01', THEME_TEXTDOMAIN) ?></h4>
                                    </div>
                                </div>
                                <div class="content-box d-flex flex-column align-items-start">
                                    <?php
                                    if(!empty($cat_how_it_work_image_with_title_four[0]['how_it_work_image'])):

                                    $how_it_work_image_attachment = get_media_url($cat_how_it_work_image_with_title_four[0]['how_it_work_image'],'full');
                                    ?>
                                    <div class="icon-wrap f-center">
                                        <img class="o-contain" src="<?php echo $how_it_work_image_attachment; ?>" alt="Step One Image">
                                    </div>
                                    <?php endif; ?>
                                    <p><?php echo $cat_how_it_work_image_with_title_four[0]['how_it_work_image_title']; ?></p>
                                </div>
                            </div>
                            <div class="steps-wrap d-flex">
                                <div class="steps-circle f-center bg-white text-black">
                                    <div class="steps-border">
                                        <h3 class="h4 text-uppercase mb-0"><?php esc_html_e( 'Step', THEME_TEXTDOMAIN) ?></h3>
                                        <h4 class="h1 mb-0"><?php esc_html_e( '02', THEME_TEXTDOMAIN) ?></h4>
                                    </div>
                                </div>
                                <div class="content-box d-flex flex-column align-items-start">
                                    <?php
                                    if(!empty($cat_how_it_work_image_with_title_four[1]['how_it_work_image'])):
                                        $how_it_work_image_attachment = get_media_url($cat_how_it_work_image_with_title_four[1]['how_it_work_image'],'full');
                                        ?>
                                        <div class="icon-wrap f-center">
                                            <img class="o-contain" src="<?php echo $how_it_work_image_attachment; ?>" alt="Step Two Image">
                                        </div>
                                    <?php endif; ?>
                                    <p><?php echo $cat_how_it_work_image_with_title_four[1]['how_it_work_image_title']; ?></p>
                                </div>
                            </div>
                            <div class="steps-wrap d-flex">
                                <div class="steps-circle f-center bg-white text-black">
                                    <div class="steps-border">
                                        <h3 class="h4 text-uppercase mb-0"><?php esc_html_e( 'Step', THEME_TEXTDOMAIN) ?></h3>
                                        <h4 class="h1 mb-0"><?php esc_html_e( '03', THEME_TEXTDOMAIN) ?></h4>
                                    </div>
                                </div>
                                <div class="content-box d-flex flex-column align-items-start">
                                    <?php
                                    if(!empty($cat_how_it_work_image_with_title_four[2]['how_it_work_image'])):
                                        $how_it_work_image_attachment = get_media_url($cat_how_it_work_image_with_title_four[2]['how_it_work_image'],'full');
                                        ?>
                                        <div class="icon-wrap f-center">
                                            <img class="o-contain" src="<?php echo $how_it_work_image_attachment; ?>" alt="Step Three Image">
                                        </div>
                                    <?php endif; ?>
                                    <p><?php echo $cat_how_it_work_image_with_title_four[2]['how_it_work_image_title']; ?></p>
                                </div>
                            </div>
                            <div class="steps-wrap d-flex">
                                <div class="steps-circle f-center bg-white text-black">
                                    <div class="steps-border">
                                        <h3 class="h4 text-uppercase mb-0"><?php esc_html_e( 'Step', THEME_TEXTDOMAIN) ?></h3>
                                        <h4 class="h1 mb-0"><?php esc_html_e( '04', THEME_TEXTDOMAIN) ?></h4>
                                    </div>
                                </div>
                                <div class="content-box d-flex flex-column align-items-start">
                                    <?php
                                    if(!empty($cat_how_it_work_image_with_title_four[3]['how_it_work_image'])):
                                        $how_it_work_image_attachment = get_media_url($cat_how_it_work_image_with_title_four[3]['how_it_work_image'],'full');
                                        ?>
                                        <div class="icon-wrap f-center">
                                            <img class="o-contain" src="<?php echo $how_it_work_image_attachment; ?>" alt="Step Four Image">
                                        </div>
                                    <?php endif; ?>
                                    <p><?php echo $cat_how_it_work_image_with_title_four[3]['how_it_work_image_title']; ?></p>
                                </div>
                            </div>
                        </div>
                    </section>
                <?php
                break;

            case "5": 
                ?>
                    <section class="steps-main-wrapper steps-five container-xxl container pt-8 pb-8 text-center">
                        <h2 class="h1 cmn-heading"><?php echo $cat_how_it_work_heading_separated[0]; ?><strong> <?php echo $cat_how_it_work_heading_separated[1]; ?></strong></h2>
                        <!-- Desktop -->
                        <div class="circle-sec-wrap desktop-dials text-start mt-5 d-none d-xl-grid">
                            <div class="steps-content-odd">
                                <?php
                                $count_loop = 0;
                                foreach($cat_how_it_work_image_with_title_five as $how_it_work_image_with_title ):
                                    if($count_loop < 5 & $count_loop != 1 & $count_loop != 3):
                                        ?>
                                        <div class="content-box">
                                            <div class="d-flex align-items-initial h-100">
                                                <div class="icon-wrap f-center">
                                                    <?php
                                                    if(!empty($how_it_work_image_with_title['how_it_work_image'])):
                                                        $how_it_work_image_attachment = get_media_url($how_it_work_image_with_title['how_it_work_image'],'full');
                                                        ?>
                                                        <img class="o-contain" src="<?php echo $how_it_work_image_attachment; ?>" alt="Step Image">
                                                    <?php endif; ?>
                                                </div>
                                                <div class="d-flex align-items-center">
                                                <p><?php echo $how_it_work_image_with_title['how_it_work_image_title']; ?></p>
                                                    </div>
                                            </div>
                                        </div>
                                    <?php
                                    endif;
                                    $count_loop++;
                                endforeach;
                                ?>
                            </div>
                            <div class="circle-sec">
                                <div class="steps-circle f-center bg-white text-black">
                                        <div class="steps-border">
                                            <h3 class="h4 text-uppercase mb-0"><?php esc_html_e( 'STEP', THEME_TEXTDOMAIN) ?></h3>
                                            <h4 class="h1 mb-0"><?php esc_html_e( '01', THEME_TEXTDOMAIN) ?></h4>
                                        </div>
                                    </div>
                                <div class="steps-circle f-center bg-white text-black">
                                    <div class="steps-border">
                                        <h3 class="h4 text-uppercase mb-0"><?php esc_html_e( 'STEP', THEME_TEXTDOMAIN) ?></h3>
                                        <h4 class="h1 mb-0"><?php esc_html_e( '02', THEME_TEXTDOMAIN) ?></h4>
                                    </div>
                                </div>
                                <div class="steps-circle f-center bg-white text-black">
                                    <div class="steps-border">
                                        <h3 class="h4 text-uppercase mb-0"><?php esc_html_e( 'STEP', THEME_TEXTDOMAIN) ?></h3>
                                        <h4 class="h1 mb-0"><?php esc_html_e( '03', THEME_TEXTDOMAIN) ?></h4>
                                    </div>
                                </div>
                                <div class="steps-circle f-center bg-white text-black">
                                    <div class="steps-border">
                                        <h3 class="h4 text-uppercase mb-0"><?php esc_html_e( 'STEP', THEME_TEXTDOMAIN) ?></h3>
                                        <h4 class="h1 mb-0"><?php esc_html_e( '04', THEME_TEXTDOMAIN) ?></h4>
                                    </div>
                                </div>
                                <div class="steps-circle f-center bg-white text-black">
                                    <div class="steps-border">
                                        <h3 class="h4 text-uppercase mb-0"><?php esc_html_e( 'STEP', THEME_TEXTDOMAIN) ?></h3>
                                        <h4 class="h1 mb-0"><?php esc_html_e( '05', THEME_TEXTDOMAIN) ?></h4>
                                    </div>
                                </div>
                            </div>
                            <div class="steps-content-even">
                                <?php
                                $count_loop = 0;
                                foreach($cat_how_it_work_image_with_title_five as $how_it_work_image_with_title ):
                                    if($count_loop < 5 & $count_loop != 0 & $count_loop != 2 & $count_loop != 4):
                                        ?>
                                        <div class="content-box">
                                            <div class="d-flex align-items-initial h-100">
                                                <div class="icon-wrap f-center">
                                                    <?php
                                                    if(!empty($how_it_work_image_with_title['how_it_work_image'])):
                                                        $how_it_work_image_attachment = get_media_url($how_it_work_image_with_title['how_it_work_image'],'full');
                                                        ?>
                                                        <img class="o-contain" src="<?php echo $how_it_work_image_attachment; ?>" alt="Step Image">
                                                    <?php endif; ?>
                                                </div>
                                                <div class="d-flex align-items-center">
                                                <p><?php echo $how_it_work_image_with_title['how_it_work_image_title']; ?></p>
                                                    </div>
                                            </div>
                                        </div>
                                    <?php
                                    endif;
                                    $count_loop++;
                                endforeach;
                                ?>
                            </div>
                        </div>
                        <!-- Ipad -->
                        <div class="circle-sec-wrap-verticle tablet-dials text-start d-flex flex-column d-xl-none mt-5">
                            <div class="steps-wrap d-flex">
                                <div class="steps-circle f-center bg-white text-black">
                                    <div class="steps-border">
                                        <h3 class="h4 text-uppercase mb-0"><?php esc_html_e( 'Step', THEME_TEXTDOMAIN) ?></h3>
                                        <h4 class="h1 mb-0"><?php esc_html_e( '01', THEME_TEXTDOMAIN) ?></h4>
                                    </div>
                                </div>
                                <div class="content-box d-flex flex-column align-items-start">
                                    <?php
                                    if(!empty($cat_how_it_work_image_with_title_five[0]['how_it_work_image'])):

                                    $how_it_work_image_attachment = get_media_url($cat_how_it_work_image_with_title_five[0]['how_it_work_image'],'full');
                                    ?>
                                    <div class="icon-wrap f-center">
                                        <img class="o-contain" src="<?php echo $how_it_work_image_attachment; ?>" alt="Step One Image">
                                    </div>
                                    <?php endif; ?>
                                    <p><?php echo $cat_how_it_work_image_with_title_five[0]['how_it_work_image_title']; ?></p>
                                </div>
                            </div>
                            <div class="steps-wrap d-flex">
                                <div class="steps-circle f-center bg-white text-black">
                                    <div class="steps-border">
                                        <h3 class="h4 text-uppercase mb-0"><?php esc_html_e( 'Step', THEME_TEXTDOMAIN) ?></h3>
                                        <h4 class="h1 mb-0"><?php esc_html_e( '02', THEME_TEXTDOMAIN) ?></h4>
                                    </div>
                                </div>
                                <div class="content-box d-flex flex-column align-items-start">
                                    <?php
                                    if(!empty($cat_how_it_work_image_with_title_five[1]['how_it_work_image'])):
                                        $how_it_work_image_attachment = get_media_url($cat_how_it_work_image_with_title_five[1]['how_it_work_image'],'full');
                                        ?>
                                        <div class="icon-wrap f-center">
                                            <img class="o-contain" src="<?php echo $how_it_work_image_attachment; ?>" alt="Step Two Image">
                                        </div>
                                    <?php endif; ?>
                                    <p><?php echo $cat_how_it_work_image_with_title_five[1]['how_it_work_image_title']; ?></p>
                                </div>
                            </div>
                            <div class="steps-wrap d-flex">
                                <div class="steps-circle f-center bg-white text-black">
                                    <div class="steps-border">
                                        <h3 class="h4 text-uppercase mb-0"><?php esc_html_e( 'Step', THEME_TEXTDOMAIN) ?></h3>
                                        <h4 class="h1 mb-0"><?php esc_html_e( '03', THEME_TEXTDOMAIN) ?></h4>
                                    </div>
                                </div>
                                <div class="content-box d-flex flex-column align-items-start">
                                    <?php
                                    if(!empty($cat_how_it_work_image_with_title_five[2]['how_it_work_image'])):
                                        $how_it_work_image_attachment = get_media_url($cat_how_it_work_image_with_title_five[2]['how_it_work_image'],'full');
                                        ?>
                                        <div class="icon-wrap f-center">
                                            <img class="o-contain" src="<?php echo $how_it_work_image_attachment; ?>" alt="Step Three Image">
                                        </div>
                                    <?php endif; ?>
                                    <p><?php echo $cat_how_it_work_image_with_title_five[2]['how_it_work_image_title']; ?></p>
                                </div>
                            </div>
                            <div class="steps-wrap d-flex">
                                <div class="steps-circle f-center bg-white text-black">
                                    <div class="steps-border">
                                        <h3 class="h4 text-uppercase mb-0"><?php esc_html_e( 'Step', THEME_TEXTDOMAIN) ?></h3>
                                        <h4 class="h1 mb-0"><?php esc_html_e( '04', THEME_TEXTDOMAIN) ?></h4>
                                    </div>
                                </div>
                                <div class="content-box d-flex flex-column align-items-start">
                                    <?php
                                    if(!empty($cat_how_it_work_image_with_title_five[3]['how_it_work_image'])):
                                        $how_it_work_image_attachment = get_media_url($cat_how_it_work_image_with_title_five[3]['how_it_work_image'],'full');
                                        ?>
                                        <div class="icon-wrap f-center">
                                            <img class="o-contain" src="<?php echo $how_it_work_image_attachment; ?>" alt="Step Four Image">
                                        </div>
                                    <?php endif; ?>
                                    <p><?php echo $cat_how_it_work_image_with_title_five[3]['how_it_work_image_title']; ?></p>
                                </div>
                            </div>
                            <div class="steps-wrap d-flex">
                                <div class="steps-circle f-center bg-white text-black">
                                    <div class="steps-border">
                                        <h3 class="h4 text-uppercase mb-0"><?php esc_html_e( 'Step', THEME_TEXTDOMAIN) ?></h3>
                                        <h4 class="h1 mb-0"><?php esc_html_e( '05', THEME_TEXTDOMAIN) ?></h4>
                                    </div>
                                </div>
                                <div class="content-box d-flex flex-column align-items-start">
                                    <?php
                                    if(!empty($cat_how_it_work_image_with_title_five[4]['how_it_work_image'])):
                                        $how_it_work_image_attachment = get_media_url($cat_how_it_work_image_with_title_five[4]['how_it_work_image'],'full');
                                        ?>
                                        <div class="icon-wrap f-center">
                                            <img class="o-contain" src="<?php echo $how_it_work_image_attachment; ?>" alt="Step Five Image">
                                        </div>
                                    <?php endif; ?>
                                    <p><?php echo $cat_how_it_work_image_with_title_five[4]['how_it_work_image_title']; ?></p>
                                </div>
                            </div>
                        </div>
                    </section>
                <?php
                break;

            case "6": 
                ?>
                    <section class="steps-main-wrapper steps-six container-xxl container pt-8 pb-8 text-center">
                        <h2 class="h1 cmn-heading"><?php echo $cat_how_it_work_heading_separated[0]; ?><strong> <?php echo $cat_how_it_work_heading_separated[1]; ?></strong></h2>
                        <!-- Desktop -->
                        <div class="circle-sec-wrap desktop-dials text-start mt-5 d-none d-xl-grid">
                            <div class="steps-content-odd">
                                <?php
                                $count_loop = 0;
                                foreach($cat_how_it_work_image_with_title_six as $how_it_work_image_with_title ):
                                    if($count_loop < 5 & $count_loop != 1 & $count_loop != 3):
                                        ?>
                                        <div class="content-box">
                                            <div class="d-flex align-items-initial h-100">
                                                <div class="icon-wrap f-center">
                                                    <?php
                                                    if(!empty($how_it_work_image_with_title['how_it_work_image'])):
                                                        $how_it_work_image_attachment = get_media_url($how_it_work_image_with_title['how_it_work_image'],'full');
                                                        ?>
                                                        <img class="o-contain" src="<?php echo $how_it_work_image_attachment; ?>" alt="Step Image">
                                                    <?php endif; ?>
                                                </div>
                                                <div class="d-flex align-items-center">
                                                <p><?php echo $how_it_work_image_with_title['how_it_work_image_title']; ?></p>
                                                    </div>
                                            </div>
                                        </div>
                                    <?php
                                    endif;
                                    $count_loop++;
                                endforeach;
                                ?>
                            </div>
                            <div class="circle-sec">
                                <div class="steps-circle f-center bg-white text-black">
                                        <div class="steps-border">
                                            <h3 class="h4 text-uppercase mb-0"><?php esc_html_e( 'STEP', THEME_TEXTDOMAIN) ?></h3>
                                            <h4 class="h1 mb-0"><?php esc_html_e( '01', THEME_TEXTDOMAIN) ?></h4>
                                        </div>
                                    </div>
                                <div class="steps-circle f-center bg-white text-black">
                                    <div class="steps-border">
                                        <h3 class="h4 text-uppercase mb-0"><?php esc_html_e( 'STEP', THEME_TEXTDOMAIN) ?></h3>
                                        <h4 class="h1 mb-0"><?php esc_html_e( '02', THEME_TEXTDOMAIN) ?></h4>
                                    </div>
                                </div>
                                <div class="steps-circle f-center bg-white text-black">
                                    <div class="steps-border">
                                        <h3 class="h4 text-uppercase mb-0"><?php esc_html_e( 'STEP', THEME_TEXTDOMAIN) ?></h3>
                                        <h4 class="h1 mb-0"><?php esc_html_e( '03', THEME_TEXTDOMAIN) ?></h4>
                                    </div>
                                </div>
                                <div class="steps-circle f-center bg-white text-black">
                                    <div class="steps-border">
                                        <h3 class="h4 text-uppercase mb-0"><?php esc_html_e( 'STEP', THEME_TEXTDOMAIN) ?></h3>
                                        <h4 class="h1 mb-0"><?php esc_html_e( '04', THEME_TEXTDOMAIN) ?></h4>
                                    </div>
                                </div>
                                <div class="steps-circle f-center bg-white text-black">
                                    <div class="steps-border">
                                        <h3 class="h4 text-uppercase mb-0"><?php esc_html_e( 'STEP', THEME_TEXTDOMAIN) ?></h3>
                                        <h4 class="h1 mb-0"><?php esc_html_e( '05', THEME_TEXTDOMAIN) ?></h4>
                                    </div>
                                </div>
                                <div class="steps-circle f-center bg-white text-black">
                                    <div class="steps-border">
                                        <h3 class="h4 text-uppercase mb-0"><?php esc_html_e( 'STEP', THEME_TEXTDOMAIN) ?></h3>
                                        <h4 class="h1 mb-0"><?php esc_html_e( '06', THEME_TEXTDOMAIN) ?></h4>
                                    </div>
                                </div>
                            </div>
                            <div class="steps-content-even">
                                <?php
                                $count_loop = 0;
                                foreach($cat_how_it_work_image_with_title_six as $how_it_work_image_with_title ):
                                    if($count_loop < 6 & $count_loop != 0 & $count_loop != 2 & $count_loop != 4):
                                        ?>
                                        <div class="content-box">
                                            <div class="d-flex align-items-initial h-100">
                                                <div class="icon-wrap f-center">
                                                    <?php
                                                    if(!empty($how_it_work_image_with_title['how_it_work_image'])):
                                                        $how_it_work_image_attachment = get_media_url($how_it_work_image_with_title['how_it_work_image'],'full');
                                                        ?>
                                                        <img class="o-contain" src="<?php echo $how_it_work_image_attachment; ?>" alt="Step Image">
                                                    <?php endif; ?>
                                                </div>
                                                <div class="d-flex align-items-center">
                                                <p><?php echo $how_it_work_image_with_title['how_it_work_image_title']; ?></p>
                                                    </div>
                                            </div>
                                        </div>
                                    <?php
                                    endif;
                                    $count_loop++;
                                endforeach;
                                ?>
                            </div>
                        </div>
                        <!-- Ipad -->
                        <div class="circle-sec-wrap-verticle tablet-dials text-start d-flex flex-column d-xl-none mt-5">
                            <div class="steps-wrap d-flex">
                                <div class="steps-circle f-center bg-white text-black">
                                    <div class="steps-border">
                                        <h3 class="h4 text-uppercase mb-0"><?php esc_html_e( 'Step', THEME_TEXTDOMAIN) ?></h3>
                                        <h4 class="h1 mb-0"><?php esc_html_e( '01', THEME_TEXTDOMAIN) ?></h4>
                                    </div>
                                </div>
                                <div class="content-box d-flex flex-column align-items-start">
                                    <?php
                                    if(!empty($cat_how_it_work_image_with_title_six[0]['how_it_work_image'])):

                                    $how_it_work_image_attachment = get_media_url($cat_how_it_work_image_with_title_six[0]['how_it_work_image'],'full');
                                    ?>
                                    <div class="icon-wrap f-center">
                                        <img class="o-contain" src="<?php echo $how_it_work_image_attachment; ?>" alt="Step One Image">
                                    </div>
                                    <?php endif; ?>
                                    <p><?php echo $cat_how_it_work_image_with_title_six[0]['how_it_work_image_title']; ?></p>
                                </div>
                            </div>
                            <div class="steps-wrap d-flex">
                                <div class="steps-circle f-center bg-white text-black">
                                    <div class="steps-border">
                                        <h3 class="h4 text-uppercase mb-0"><?php esc_html_e( 'Step', THEME_TEXTDOMAIN) ?></h3>
                                        <h4 class="h1 mb-0"><?php esc_html_e( '02', THEME_TEXTDOMAIN) ?></h4>
                                    </div>
                                </div>
                                <div class="content-box d-flex flex-column align-items-start">
                                    <?php
                                    if(!empty($cat_how_it_work_image_with_title_six[1]['how_it_work_image'])):
                                        $how_it_work_image_attachment = get_media_url($cat_how_it_work_image_with_title_six[1]['how_it_work_image'],'full');
                                        ?>
                                        <div class="icon-wrap f-center">
                                            <img class="o-contain" src="<?php echo $how_it_work_image_attachment; ?>" alt="Step Two Image">
                                        </div>
                                    <?php endif; ?>
                                    <p><?php echo $cat_how_it_work_image_with_title_six[1]['how_it_work_image_title']; ?></p>
                                </div>
                            </div>
                            <div class="steps-wrap d-flex">
                                <div class="steps-circle f-center bg-white text-black">
                                    <div class="steps-border">
                                        <h3 class="h4 text-uppercase mb-0"><?php esc_html_e( 'Step', THEME_TEXTDOMAIN) ?></h3>
                                        <h4 class="h1 mb-0"><?php esc_html_e( '03', THEME_TEXTDOMAIN) ?></h4>
                                    </div>
                                </div>
                                <div class="content-box d-flex flex-column align-items-start">
                                    <?php
                                    if(!empty($cat_how_it_work_image_with_title_six[2]['how_it_work_image'])):
                                        $how_it_work_image_attachment = get_media_url($cat_how_it_work_image_with_title_six[2]['how_it_work_image'],'full');
                                        ?>
                                        <div class="icon-wrap f-center">
                                            <img class="o-contain" src="<?php echo $how_it_work_image_attachment; ?>" alt="Step Three Image">
                                        </div>
                                    <?php endif; ?>
                                    <p><?php echo $cat_how_it_work_image_with_title_six[2]['how_it_work_image_title']; ?></p>
                                </div>
                            </div>
                            <div class="steps-wrap d-flex">
                                <div class="steps-circle f-center bg-white text-black">
                                    <div class="steps-border">
                                        <h3 class="h4 text-uppercase mb-0"><?php esc_html_e( 'Step', THEME_TEXTDOMAIN) ?></h3>
                                        <h4 class="h1 mb-0"><?php esc_html_e( '04', THEME_TEXTDOMAIN) ?></h4>
                                    </div>
                                </div>
                                <div class="content-box d-flex flex-column align-items-start">
                                    <?php
                                    if(!empty($cat_how_it_work_image_with_title_six[3]['how_it_work_image'])):
                                        $how_it_work_image_attachment = get_media_url($cat_how_it_work_image_with_title_six[3]['how_it_work_image'],'full');
                                        ?>
                                        <div class="icon-wrap f-center">
                                            <img class="o-contain" src="<?php echo $how_it_work_image_attachment; ?>" alt="Step Four Image">
                                        </div>
                                    <?php endif; ?>
                                    <p><?php echo $cat_how_it_work_image_with_title_six[3]['how_it_work_image_title']; ?></p>
                                </div>
                            </div>
                            <div class="steps-wrap d-flex">
                                <div class="steps-circle f-center bg-white text-black">
                                    <div class="steps-border">
                                        <h3 class="h4 text-uppercase mb-0"><?php esc_html_e( 'Step', THEME_TEXTDOMAIN) ?></h3>
                                        <h4 class="h1 mb-0"><?php esc_html_e( '05', THEME_TEXTDOMAIN) ?></h4>
                                    </div>
                                </div>
                                <div class="content-box d-flex flex-column align-items-start">
                                    <?php
                                    if(!empty($cat_how_it_work_image_with_title_six[4]['how_it_work_image'])):
                                        $how_it_work_image_attachment = get_media_url($cat_how_it_work_image_with_title_six[4]['how_it_work_image'],'full');
                                        ?>
                                        <div class="icon-wrap f-center">
                                            <img class="o-contain" src="<?php echo $how_it_work_image_attachment; ?>" alt="Step Five Image">
                                        </div>
                                    <?php endif; ?>
                                    <p><?php echo $cat_how_it_work_image_with_title_six[4]['how_it_work_image_title']; ?></p>
                                </div>
                            </div>
                            <div class="steps-wrap d-flex">
                                <div class="steps-circle f-center bg-white text-black">
                                    <div class="steps-border">
                                        <h3 class="h4 text-uppercase mb-0"><?php esc_html_e( 'Step', THEME_TEXTDOMAIN) ?></h3>
                                        <h4 class="h1 mb-0"><?php esc_html_e( '06', THEME_TEXTDOMAIN) ?></h4>
                                    </div>
                                </div>
                                <div class="content-box d-flex flex-column align-items-start">
                                    <?php
                                    if(!empty($cat_how_it_work_image_with_title_six[5]['how_it_work_image'])):
                                        $how_it_work_image_attachment = get_media_url($cat_how_it_work_image_with_title_six[5]['how_it_work_image'],'full');
                                        ?>
                                        <div class="icon-wrap f-center">
                                            <img class="o-contain" src="<?php echo $how_it_work_image_attachment; ?>" alt="Step Six Image">
                                        </div>
                                    <?php endif; ?>
                                    <p><?php echo $cat_how_it_work_image_with_title_six[5]['how_it_work_image_title']; ?></p>
                                </div>
                            </div>
                        </div>
                    </section>
                <?php
                break;
        }
    }
    ?>

    <!-- Cash Flow Section -->
<?php
    $cash_flow_options =  carbon_get_term_meta( $term_id,'cash_flow_options');
    if($cash_flow_options == 'yes'){
        $cash_flow_heading = carbon_get_term_meta( $term_id,'cash_flow_heading');
        $cash_flow_content = carbon_get_term_meta( $term_id,'cash_flow_content');

        $cash_flow_feature_image = carbon_get_term_meta( $term_id,'cash_flow_feature_image');
        $cash_flow_attached_images_d = get_media_url($cash_flow_feature_image,'service-card-d');
        $cash_flow_attached_images_t = get_media_url($cash_flow_feature_image,'service-card-t');
        $cash_flow_attached_images_m = get_media_url($cash_flow_feature_image,'service-card-m');

        $cashflow_youtube_video_link = carbon_get_term_meta( $term_id,'cashflow_youtube_video_link');
        $cashflow_upload_video_link_file = carbon_get_term_meta( $term_id,'cashflow_upload_video_link_file');
        $cash_flow_upload_video = wp_get_attachment_url($cashflow_upload_video_link_file);
        $cash_flow_video_options = carbon_get_term_meta( $term_id,'cash_flow_video_options');
        $cashflow_upload_video_file_banner = carbon_get_term_meta($term_id,'cashflow_upload_video_file_banner');
        $attached_cashflow_upload_video_file_banner = get_media_url($cashflow_upload_video_file_banner,'full');

        $cat_cash_flow_video_banner_heading = carbon_get_term_meta( $term_id,'cat_cash_flow_video_banner_heading');
        $cat_cash_flow_video_banner_heading_separated = explode(" | ", $cat_cash_flow_video_banner_heading);

        ?>
        <section class="container-xl two-col-wrap mt-8 pb-8">
            <div class="row cmn-space-tabs">
                <div class="col-xl-7">
                    <div class="border-transform">
                        <div class="play-btn-wrap cmn-radius-box-sm">
                            <h2 class="text-blue"><?php echo $cat_cash_flow_video_banner_heading_separated[0]; ?><br><?php echo $cat_cash_flow_video_banner_heading_separated[1]; ?></h2>
                            <?php
                            if(!empty($cash_flow_feature_image)):
                                ?>
                                <picture>
                                    <!-- Desktop -->
                                    <source class="o-cover h-100 w-100" media="(min-width: 1200px)" srcset="<?php echo $cash_flow_attached_images_d; ?>">
                                    <!-- Tab -->
                                    <source class="o-cover h-100 w-100" media="(min-width: 575px)" srcset="<?php echo $cash_flow_attached_images_t; ?>">
                                    <!-- Mobile -->
                                    <img class="o-cover h-100 w-100" src="<?php echo $cash_flow_attached_images_m; ?>" alt="<?php echo $cash_flow_heading; ?>">
                                </picture>
                            <?php
                            endif;
                            ?>
                            <!-- Button trigger modal -->


                                <?php
                                if($cash_flow_video_options == 'youtube'){
                                    if(!empty($cashflow_youtube_video_link)){
                                    ?>
                            <div class="cmn-play-wrap f-center">
                                    <button type="button" video_link="<?php echo $cashflow_youtube_video_link ?>" class="btn cmn-play" type_video="youtube" data-bs-toggle="modal"
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
                                else
                                {
                                    if(!empty($cash_flow_upload_video)){
                                    ?>
                                <div class="cmn-play-wrap f-center">
                                    <button type="button" video_poster="<?php echo $attached_cashflow_upload_video_file_banner; ?>" type_video="uploaded"  video_link="<?php echo $cash_flow_upload_video ?>" class="btn cmn-play" data-bs-toggle="modal"
                                            data-bs-target="#Modalupload">
                                        <div class="cmn-play-btn">
                                            <i class="fa-solid fa-play"></i>
                                        </div>
                                    </button>
                                    <div class="video-tag-uploaded">
                                        <source class="upload_video_src" src="<?php echo $cash_flow_upload_video; ?>" type="video/mp4">
                                        <source class="upload_video_src" src="<?php echo $cash_flow_upload_video; ?>" type="video/ogg">
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
                <div class="col-xl-5 px-xl-0 f-center text-center text-xl-start mt-4 mt-xl-0">
                    <div class="content">
                        <h2 class="text-blue"><?php echo $cash_flow_heading; ?>
                        </h2>
                        <p><?php echo $cash_flow_content; ?>.</p>
                    </div>
                </div>
            </div>
        </section>
        <!-- /Cash Flow Section -->
        <?php
    }

    $case_studies_options =  carbon_get_term_meta( $term_id,'case_studies_options');
    if($case_studies_options == 'yes'){
        get_template_part('page-templates/global-sections/case-studies-section-template');
        ?>
        <!-- Box wrapper -->
        <?php
    }

    $cta_options =  carbon_get_term_meta( $term_id,'cta_options');
    if($cta_options == 'yes'){
        $cta_heading = carbon_get_term_meta($term_id, 'cta_heading');
        $cta_content = carbon_get_term_meta($term_id, 'cta_content');
        $cta_link = carbon_get_term_meta($term_id, 'cta_link');

        ?>
        <section class="contact-us-block bg-gradient-green py-6 mb-8">
            <div class="container-xxl container text-center text-white">
                <h2 class="h1"><strong><?php echo $cta_heading; ?></strong></h2>
                <p><?php echo $cta_content; ?></p>
                <a href="<?php echo $cta_link['url']; ?>"  class="btn bg-blue cmn-btn curve-left mt-5" ><?php echo $cta_link['anchor']; ?></a>


            </div>
        </section>
        <!-- Box wrapper -->

        <?php
    }
    get_template_part('page-templates/global-sections/office-locations');
    ?>
    <!-- /Location Section -->
    <!-- Our Partner Section -->
<?php
    get_template_part('page-templates/global-sections/our-partner-logo');
    ?>
<?php
get_footer();