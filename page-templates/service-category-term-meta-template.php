<?php

$taxonomies_services = get_terms( array(
    'taxonomy' => 'service-category',
    'hide_empty' => false,
    'orderby'=>'id',
    'order'=>'ASC'
) );

$working_capital_heading = carbon_get_post_meta( get_the_ID(),'working_capital_heading');
$working_capital_heading_separated = explode(" | ", $working_capital_heading);

?>
<section class="position-relative cards-slider-wrap card-container text-center mt-8 pb-8">
    <h2 class="cmn-heading h1"><?php echo esc_html( $working_capital_heading_separated[0] ); ?>  <br /> <strong><?php echo esc_html( $working_capital_heading_separated[1] ); ?></strong></h2>
    <div class="cmn-navigation-wrap">
        <div class="swiper cards-slider text-start">
            <div class="swiper-wrapper">
                <?php
                foreach ( $taxonomies_services as $category ) :
                $card_sub_heading = carbon_get_term_meta($category->term_id, 'card_sub_heading');

                $service_category_image = carbon_get_term_meta($category->term_id, 'service_category_image');
                $attached_image_d = get_media_url($service_category_image,'service-d');
                $attached_image_t = get_media_url($service_category_image,'service-t');
                $attached_image_m = get_media_url($service_category_image,'service-m');
        
                $services_video_options = carbon_get_term_meta($category->term_id, 'services_video_options');
                $services_video_link = carbon_get_term_meta($category->term_id, 'services_video_link');
                $services_video_link_file = carbon_get_term_meta($category->term_id, 'services_video_link_file');
                $services_video_link_file = wp_get_attachment_url($services_video_link_file);

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
                                            <img class="o-cover w-100 h-100" src="<?php echo $attached_image_m; ?>" alt="<?php echo esc_attr( $category->name ); ?>">
                                        </picture>
                                    <?php endif ?>
                                    <?php
                                    if($services_video_options == 'youtube'){
                                    ?>
                                    <!-- Button trigger modal -->
                                        <?php if(!empty($services_video_link)): ?>
                                    <div class="cmn-play-wrap size-sm f-center">
                                        <div  class="btn cmn-play" type_video="youtube" video_link="<?php
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
                                            <div  class="btn cmn-play" type_video="uploaded" video_link="<?php
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
                                    <a class="mb-3 h2" href="<?php echo esc_url( get_term_link($category)) ; ?>"  >
                                        <?php
                                        echo esc_attr( $category->name );
                                        ?>
                                    </a>
                                    <?php
                                        if(!empty($card_sub_heading)){
                                            ?> <h3 class="text-black h4 mb-3"><?php echo $card_sub_heading; ?></h3>
                                        <?php
                                        }
                                    ?>
                                    <p>
                                        <?php
                                        echo esc_attr( $category->description );

                                        ?>
                                    </p>
                                    <a  class="btn bg-green cmn-btn mt-auto" href="<?php echo esc_url( get_term_link($category)) ; ?>">
                                        <?php  echo __( 'Learn More',THEME_TEXTDOMAIN  ); ?>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <?php
            $count_arrow = 0;
            foreach ( $taxonomies_services as $posts_service ) :
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
            ?>
        </div>
</section>