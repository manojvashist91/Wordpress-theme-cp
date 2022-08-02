<!-- Custom Cards Section -->
<?php
global $post;
$post_slug = $post->post_name;
$services_category_posts = get_posts(array(
    'post_type' => 'services',
    'numberposts' => -1,
    'tax_query' => array(
        array(
            'taxonomy' => 'service-category',
            'field' => 'slug',
            'orderby'=>'id',
            'order'=>'ASC',
            'terms' => array($post_slug),
        )
    )
));
$working_capital_heading = carbon_get_post_meta( get_the_ID(),'working_capital_heading');
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

                $service_category_image = get_the_post_thumbnail_url($post,  'full' );
                $attached_image_d = get_media_url($service_category_image,'service-d');
                $attached_image_t = get_media_url($service_category_image,'service-t');
                $attached_image_m = get_media_url($service_category_image,'service-m');

                $services_video_options = carbon_get_post_meta( get_the_ID(), 'services_video_options');
                $services_video_link = carbon_get_post_meta(get_the_ID(), 'services_video_link');
                $services_video_link_file = carbon_get_post_meta( get_the_ID(), 'services_video_link_file');
                $service_page_content = carbon_get_post_meta( get_the_ID(), 'service_page_content');


                ?>
                <div class="swiper-slide h-auto">
                    <div class="card custom-cards h-100 bg-transparent">
                        <div class="card-inner d-flex flex-column align-items-start bg-white h-100">
                            <div class="card-media w-100">
                                <div class="ratio ratio-16x9 play-btn-wrap">
                                    <?php
                                    if(!empty($service_category_image)):
                                        ?>
                                        <picture>
                                            <!-- Desktop -->
                                            <source class="o-cover w-100 h-100" media="(min-width: 1200px)" srcset="<?php echo $attached_image_d; ?>">
                                            <!-- Tab -->
                                            <source class="o-cover w-100 h-100" media="(min-width: 575px)" srcset="<?php echo $attached_image_t; ?>">
                                            <!-- Mobile -->
                                            <img class="o-cover w-100 h-100" src="<?php echo $attached_image_m; ?>" alt="">
                                        </picture>
                                    <?php endif ?>
                                    <?php
                                    if($services_video_options == 'youtube'){
                                    ?>
                                    <!-- Button trigger modal -->
                                    <div class="cmn-play-wrap size-sm f-center">
                                        <div class="btn cmn-play" type_video="youtube" video_link="<?php
                                        echo $services_video_link; ?>" data-bs-toggle="modal"
                                                data-bs-target="#Modal">
                                            <div class="cmn-play-btn">
                                                <i class="fa-solid fa-play"></i>
                                            </div>
                                        </div>
                                        <?php
                                        }
                                        else {
                                        ?><!-- Button trigger modal -->
                                        <div class="cmn-play-wrap size-sm f-center">
                                            <div class="btn cmn-play" type_video="uploaded" video_link="<?php
                                            echo $services_video_link_file; ?>" data-bs-toggle="modal"
                                                    data-bs-target="#Modalupload">
                                                <div class="cmn-play-btn">
                                                    <i class="fa-solid fa-play"></i>
                                                </div>
                                            </div>
                                            <?php
                                            }
                                            ?>
                                            <span class="ripple"></span>
                                            <span class="ripple"></span>
                                            <span class="ripple"></span>
                                            <span class="ripple"></span>
                                            <span class="ripple"></span>
                                            <span class="ripple"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body d-flex flex-column align-items-start">
                                    <a class="mb-3 h2" href="<?php echo esc_url( get_term_link($post)) ; ?>"  >
                                        <?php
                                        echo esc_attr( $service_page_title);
                                        ?>
                                    </a>
                                    <p>
                                        <?php
                                        echo esc_attr($service_page_content );

                                        ?>
                                    </p>
                                    <a class="btn bg-green cmn-btn mt-auto" href="<?php echo esc_url( get_permalink(),THEME_TEXTDOMAIN ) ; ?>">
                                        <?php esc_html_e( 'Learn More', THEME_TEXTDOMAIN) ?>
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
<!-- /Custom Cards Section -->