<?php
      $our_word_heading = carbon_get_theme_option('our_word_heading');
      $our_word_heading_separated = explode(" | ", $our_word_heading);
      $our_word_content = carbon_get_theme_option('our_word_content');

      $carousel_main_image = carbon_get_theme_option('carousel_main_image');
      $attached_carousel_main_image_d = get_media_url($carousel_main_image,'testimonial-main-d');
      $attached_carousel_main_image_t = get_media_url($carousel_main_image,'testimonial-main-t');
      $attached_carousel_main_image_m = get_media_url($carousel_main_image,'testimonial-main-m');

      $carousel_main_video_options = carbon_get_theme_option('carousel_main_video_options');
      $carousel_main_video_link = carbon_get_theme_option('carousel_main_video_link'); //youtube
      $carousel_main_video_link_file = carbon_get_theme_option('carousel_main_video_link_file');
      $carousel_main_video_link_file_attachment_url =wp_get_attachment_url($carousel_main_video_link_file);
      $carousel_main_video_link_file_banner = carbon_get_theme_option('carousel_main_video_link_file_banner');
      $carousel_main_video_link_file_banner_attached =get_media_url($carousel_main_video_link_file_banner,'full');//self hosted
      $slug = get_post_field( 'post_name', get_post() );
      $our_word_carousel_image = carbon_get_theme_option('our_word_carousel_image'); // complex

      ?>
        <section class="custom-lightbox-sec">
          <div class="container-xxl container">
              <div class="row pb-xl-5">
                  <div class="col-xl-7 custom-lightbox-wrap order-2 order-xl-1">
                      <div class="play-btn-wrap">
                                    <div class="cmn-radius-img-wrap shadow-none">
                                        <?php
                                        if(!empty($carousel_main_image)):
                                        ?>
                                        <picture>
                                            <!-- Desktop -->
                                            <source media="(min-width: 1200px)" srcset="<?php echo $attached_carousel_main_image_d; ?>">
                                            <!-- Tab -->
                                            <source media="(min-width: 575px)" srcset="<?php echo $attached_carousel_main_image_t; ?>">
                                            <!-- Mobile -->
                                            <img src="<?php echo $attached_carousel_main_image_m; ?>" alt="Block Image">
                                        </picture>
                                        <?php endif; ?>
                                    </div>
                            <?php
                            if($carousel_main_video_options == 'youtube'){
                            ?>
                            <!-- Button trigger modal -->
                                <?php if(!empty($carousel_main_video_link)): ?>
                                <div class="cmn-play-wrap f-center">
                                <button type="button" class="btn cmn-play" type_video="youtube"  video_link="<?php
                                    echo $carousel_main_video_link; ?>" data-bs-toggle="modal"
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
                                <?php endif; ?>

                            <?php
                                    }
                            else {
                                ?>
                                <!-- Button trigger modal -->
                                <?php if(!empty($carousel_main_video_link_file_attachment_url)): ?>
                                <div class="cmn-play-wrap f-center">
                                <button type="button" class="btn cmn-play" video_poster="<?php echo $carousel_main_video_link_file_banner_attached; ?>" type_video="uploaded" video_link="<?php
                                    echo $carousel_main_video_link_file_attachment_url; ?>" data-bs-toggle="modal"
                                    data-bs-target="#Modalupload">
                                    <div class="cmn-play-btn">
                                        <i class="fa-solid fa-play"></i>
                                    </div>
                                </button>
                                    <div class="video-tag-uploaded">
                                        <source class="upload_video_src" src="<?php echo $carousel_main_video_link_file_attachment_url; ?>" type="video/mp4">
                                        <source class="upload_video_src" src="<?php echo $carousel_main_video_link_file_attachment_url; ?>" type="video/ogg">
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
                      <div class="cmn-radius-box overflow-visible lightbox-gallery bg-white">
                          <div class="cmn-navigation-wrap">
                              <div thumbsSlider="" class="lightbox-slides swiper mySwiper h-100">
                                  <div class="swiper-wrapper">
                                      <?php
                                      foreach ( $our_word_carousel_image as $secondary_carousel_swiper ) {
                                          $carousel_image_attached_images_d = get_media_url( $secondary_carousel_swiper['carousel_image'],'testimonial-thumb-d');
                                          $carousel_image_attached_images_t = get_media_url( $secondary_carousel_swiper['carousel_image'],'testimonial-thumb-t');
                                          $carousel_image_attached_images_m = get_media_url( $secondary_carousel_swiper['carousel_image'],'testimonial-thumb-m');
                                          $carousel_video_options = $secondary_carousel_swiper['carousel_video_options'];
                                          $carousel_video_link = $secondary_carousel_swiper['carousel_video_link'];
                                          $carousel_video_link_file_attached =wp_get_attachment_url($secondary_carousel_swiper['carousel_video_link_file']);
                                          $carousel_video_link_file_banner_attached =get_media_url($secondary_carousel_swiper['carousel_video_link_file_banner'],'full');

                                          ?>
                                          <div class="swiper-slide f-center">
                                              <div class="swiper-box shadow-none play-icon-wrap">
                                                <?php
                                                if(!empty($carousel_image_attached_images_d)){
                                                ?>
                                                <picture>
                                                        <!-- Desktop -->
                                                        <source class="o-cover w-100 h-100" media="(min-width: 1200px)" srcset="<?php echo $carousel_image_attached_images_d; ?>">
                                                        <!-- Tab -->
                                                        <source class="o-cover w-100 h-100" media="(min-width: 575px)" srcset="<?php echo $carousel_image_attached_images_t; ?>">
                                                        <!-- Mobile -->
                                                        <img class="o-cover w-100 h-100" src="<?php echo $carousel_image_attached_images_m; ?>" alt="Slide Image">
                                                    </picture>

                                                <?php
                                                }
                                                  if ($carousel_video_options == 'youtube'){
                                                  ?>
                                                      <?php if(!empty($carousel_video_link)): ?>
                                                  <div  class="btn cmn-play" video_poster="" type_video="youtube" video_link="<?php
                                                  echo $carousel_video_link; ?>" data-bs-toggle="modal"
                                                          data-bs-target="#Modal">
                                                       <span class="play-icon" >
                                                    <i class="fa-solid fa-play fa-3x"></i>
                                                  </span>
                                                  </div>
                                                      <?php endif; ?>
                                                  <?php
                                                     }
                                                    else
                                                    {
                                                      ?>
                                                        <?php if(!empty($carousel_video_link_file_attached)): ?>
                                                      <div   class="btn cmn-play" video_poster="<?php echo $carousel_video_link_file_banner_attached; ?>" type_video="uploaded" video_link="<?php
                                                      echo $carousel_video_link_file_attached; ?>" data-bs-toggle="modal"
                                                              data-bs-target="#Modalupload">
                                                       <span class="play-icon">
                                                    <i class="fa-solid fa-play fa-3x"></i>
                                                  </span>
                                                      </div>
                                                        <div class="video-tag-uploaded">
                                                            <source class="upload_video_src" src="<?php echo $carousel_video_link_file_attached; ?>" type="video/mp4">
                                                            <source class="upload_video_src" src="<?php echo $carousel_video_link_file_attached; ?>" type="video/ogg">
                                                        </div>
                                                    <?php endif; ?>
                                                  <?php } ?>


                                              </div>
                                          </div>
                                      <?php
                                      }
                                      ?>
                                  </div>
                              </div>
                              <div class="lightbox-slide-prev d-none d-md-flex circle-btn bg-green">
                                  <i class="fa-solid fa-angle-left"></i>
                              </div>
                              <div class="lightbox-slide-next d-none d-md-flex circle-btn bg-green">
                                  <i class="fa-solid fa-angle-right"></i>
                              </div>
                          </div>
                      </div>
                  </div>
                  <div class="col-xl-5 lightbox-content mb-4 mb-xl-0 order-1 order-xl-2 text-center text-xl-start">
                      <h2 class="cmn-heading border-left h1">
                          <?php echo esc_html( $our_word_heading_separated[0] ); ?> <strong><?php echo esc_html( $our_word_heading_separated[1] ); ?></strong>
                      </h2>
                      <p>
                          <?php echo esc_html( $our_word_content ); ?>
                      </p>
                  </div>
              </div>
          </div>
      </section>