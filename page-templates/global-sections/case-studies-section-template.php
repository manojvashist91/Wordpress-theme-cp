<?php
      $case_studies_heading = carbon_get_theme_option('case_studies_heading');
      $case_studies_heading_separtated = explode(" | ", $case_studies_heading);
      $case_studies_main_content = carbon_get_theme_option('case_studies_main_content');
      
        ?>
        <section class="custom-tabs bg-white mb-8" id="myTab" role="tablist">
            <div class="container-xxl container">
                <div class="row header-sec text-center text-lg-start">
                    <div class="col-xl-7 text-xl-start text-center">
                        <h2 class="cmn-heading border-left h1">
                            <?php echo $case_studies_heading_separtated[0]; ?> <br /> <strong><?php echo $case_studies_heading_separtated[1]; ?></strong>
                        </h2>
                    </div>
                    <div class="col-xl-5 text-xl-end text-center content-wrap pt-xl-5">
                        <p><?php echo $case_studies_main_content; ?></p>
                    </div>
                </div>
            </div>
            <div class="container-xxl container cmn-navigation-wrap">
                <div class="swiper custom-nav-tabs pt-2">
                    <div class="swiper-wrapper flex-nowrap nav" id="nav-tab" role="tablist">
                        <?php
                        $count_index = 0;
                        $args = array( 
                            'post_type' => 'case_studies',
                            'post_status' => 'public',
                            'order'   => 'ASC',
                            'posts_per_page' => -1,
                        );
                        $loop = new WP_Query( $args );
                        while ( $loop->have_posts() ) : $loop->the_post();

                        $case_studies_heading = carbon_get_post_meta( get_the_ID( ),'case_studies_heading');
                        $case_studies_image = carbon_get_post_meta( get_the_ID(  ),'case_studies_image');
                        $case_studies_image_attached_images = get_media_url($case_studies_image,'full');
                        ?>
                        <a href="#" post-id="<?php echo get_the_ID(); ?>" class="btn f-center cmn-btn bg-grey space-normal h-auto shadow-none swiper-slide <?php if($count_index==0){ echo 'active'; }else{ echo ''; }?>"
                                    id="nav-tab-<?php echo $count_index; ?>" data-bs-toggle="tab" data-bs-target="#nav-<?php echo $count_index; ?>"  role="tab"
                                    aria-controls="nav-<?php echo $count_index; ?>" aria-selected="true">
                            <span><?php echo $case_studies_heading; ?></span>
                        </a>
                        <?php
                            $count_index++;
                        endwhile;
                        wp_reset_postdata();
                        ?>
                    </div>
                </div>
                <div class="tab-slide-prev d-flex circle-btn bg-blue">
                    <i class="fa-solid fa-angle-left"></i>
                </div>
                <div class="tab-slide-next d-flex circle-btn bg-blue">
                    <i class="fa-solid fa-angle-right"></i>
                </div>
            </div>
            <div class="tab-content-wrap quarter-circle-radius shape-bg-green">
                <div class="tab-content position-relative container-xxl container" class="tab-content" id="nav-tabContent">
                <?php
                $count_index = 0;
                $args = array( 
                    'post_type' => 'case_studies',
                    'post_status' => 'public',
                    'order'   => 'ASC',
                    'posts_per_page' => -1,
                );
                $loop = new WP_Query( $args );
                while ( $loop->have_posts() ) : $loop->the_post();
                    $case_studies_heading = carbon_get_post_meta( get_the_ID( ),'case_studies_heading');
                    $case_studies_image = carbon_get_post_meta( get_the_ID(),'case_studies_image');
                    $case_studies_cards_content = carbon_get_post_meta( get_the_ID(),'case_studies_cards_content'); //complex
                ?>
                    <div class="tab-pane fade show <?php if($count_index==0){ echo 'active'; }else{ echo ''; }?>" id="nav-<?php echo $count_index; ?>" role="tabpanel" post-id="<?php echo get_the_ID(); ?>" aria-labelledby="nav-home-tab">
                        <div class="row">
                            <div class="col-xl-6 pt-5 ps-xl-0">
                                <div class="contant-wrap two-col-devider">
                                    <h2 class="main-heading mb-4">
                                        <?php
                                        echo $case_studies_heading;
                                        ?>
                                        </h2>
                                        <?php
                                        foreach($case_studies_cards_content as $case_studies){
                                        ?>
                                        <div class="content-row d-block d-md-flex align-items-start">
                                        <h3 class="space-normal"><?php echo $case_studies['case_studies_card_title'];?></h3>
                                        <div>
                                            <?php
                                            $case_studies_collapsible_card_content = $case_studies['case_studies_card_content'];
                                            $result_content = explode("<!--more-->",$case_studies_collapsible_card_content);
                                            echo apply_filters( 'the_content', $result_content[0] );
                                            ?>
                                        </div>
                                        </div>
                                    <!-- Below Content will be shown when clicked on the Learn More Button -->
                                    <div class="collapse" id="collapseExample">
                                        <div class="content-row d-block d-md-flex align-items-start">
                                            <h3 class="space-normal">
                                            </h3>
                                            <div>
                                                <?php
                                                echo apply_filters( 'the_content', $result_content[1] );
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                    <?php if(!empty($result_content[1])){ ?>
                                    <button class="btn cmn-btn bg-green mt-4 collapse-btn" id="load_more_button" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#collapseExample"
                                            aria-expanded="false" aria-controls="collapseExample">
                                            <span class="show"><?php echo __( 'Hide',THEME_TEXTDOMAIN  ); ?></span>
                                            <span class="hide"><?php echo __( 'Learn More',THEME_TEXTDOMAIN  ); ?></span>
                                    </button>
                                    <?php } ?>
                                <?php } ?>
                                </div>
                            </div>
                            <div class="col-xl-6">
                                <div class="cmn-radius-img-wrap">
                                    <?php
                                    if(!empty($case_studies_image)):
                                      $case_studies_image_attached_images_d = get_media_url($case_studies_image,'case-studies-d');
                                      $case_studies_image_attached_images_t = get_media_url($case_studies_image,'case-studies-t'); 
                                      $case_studies_image_attached_images_m = get_media_url($case_studies_image,'case-studies-m'); 
                                    ?>
                                    <picture>
                                        <!-- Desktop -->
                                        <source class="o-cover" media="(min-width: 1200px)" srcset="<?php echo $case_studies_image_attached_images_d; ?>">
                                        <!-- Tab -->
                                        <source class="o-cover" media="(min-width: 575px)" srcset="<?php echo $case_studies_image_attached_images_t; ?>">
                                        <!-- Mobile -->
                                        <img class="o-cover" src="<?php echo $case_studies_image_attached_images_m; ?>" alt="Image Block">
                                    </picture>
                                    
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                        <?php
                        $count_index++;
                    endwhile;
                    wp_reset_postdata();
                    ?>
                </div>
            </div>
        </section>