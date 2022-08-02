<?php
/**
 * @package WordPress
 * @subpackage Starter theme
 * @since Starter theme
 */
get_header();
get_template_part('page-templates/global-sections/hero-slider');
?>

<!-- Content Section -->
<?php
$how_it_works_options =  carbon_get_post_meta( get_the_ID(),'how_it_works_options');
if ($how_it_works_options == 'yes'){
?>

<?php
    $cards_with_left_right_content = carbon_get_post_meta(get_the_ID(), 'cards_with_left_right_content');
    ?>
    <section class="custom-rows container-xxl container mt-8">
            <?php
            $cards_with_left_right_contents = carbon_get_post_meta( get_the_ID(),'cards_with_left_right_content');
            ?>
            <?php
            $count_cards = 0;
            foreach($cards_with_left_right_contents as $cards_with_left_right_content):
                if($count_cards % 2 == 0){
                    ?>
                    <div class="row-wrap bg-white">
                        <div class="row">
                            <div class="col-xl-8">
                                <h2 class="cmn-heading border-below"><?php echo $cards_with_left_right_content['card_title'];?></h2>
                                <p><?php echo apply_filters( 'the_content', $cards_with_left_right_content['card_content']); ?></p>
                            </div>
                            <div class="col-xl-4">
                                <div class="cmn-radius-box-sm">
                                    <?php
                                    if(!empty($cards_with_left_right_content['card_image'])):

                                        $cart_attachment_image_d = get_media_url($cards_with_left_right_content['card_image'],'service-card-d');
                                        $cart_attachment_image_t = get_media_url($cards_with_left_right_content['card_image'],'service-card-t');
                                        $cart_attachment_image_m = get_media_url($cards_with_left_right_content['card_image'],'service-card-m');
                                        ?>
                                        <picture>
                                            <!-- Desktop -->
                                            <source class="o-cover w-100 h-100" media="(min-width: 1200px)" srcset="<?php echo $cart_attachment_image_d; ?>">
                                            <!-- Tab -->
                                            <source class="o-cover w-100 h-100" media="(min-width: 575px)" srcset="<?php echo $cart_attachment_image_t; ?>">
                                            <!-- Mobile -->
                                            <img class="o-cover w-100 h-100" src="<?php echo $cart_attachment_image_m; ?>" alt="Block Image">
                                        </picture>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                }
                else{
                    ?>
                    <div class="row-wrap bg-white row-reverce">
                        <div class="row">
                            <div class="col-xl-8 order-1 order-xl-2">
                                <h2 class="cmn-heading border-below"><?php echo $cards_with_left_right_content['card_title'];?></h2>
                                <p><?php echo apply_filters( 'the_content', $cards_with_left_right_content['card_content']); ?></p>
                            </div>
                            <div class="col-xl-4 order-2 order-xl-1">
                                <div class="cmn-radius-box-sm">
                                    <?php
                                    if(!empty($cards_with_left_right_content['card_image'])):
                                        $cart_attachment_image_d = get_media_url($cards_with_left_right_content['card_image'],'service-card-d');
                                        $cart_attachment_image_t = get_media_url($cards_with_left_right_content['card_image'],'service-card-t');
                                        $cart_attachment_image_m = get_media_url($cards_with_left_right_content['card_image'],'service-card-m');
                                        ?>
                                        <picture>
                                            <!-- Desktop -->
                                            <source class="o-cover w-100 h-100" media="(min-width: 1200px)" srcset="<?php echo $cart_attachment_image_d; ?>">
                                            <!-- Tab -->
                                            <source class="o-cover w-100 h-100" media="(min-width: 575px)" srcset="<?php echo $cart_attachment_image_t; ?>">
                                            <!-- Mobile -->
                                            <img class="o-cover w-100 h-100" src="<?php echo $cart_attachment_image_m; ?>" alt="Block Image">
                                        </picture>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                }
                ?>
                <?php
                $count_cards++;
            endforeach;
            ?>
        </section>
    <?php
    }
?>

<!-- How It Works -->
<?php
$how_it_works_dials_options =  carbon_get_post_meta( get_the_ID(),'how_it_works_dials_options');
if($how_it_works_dials_options == 'yes'){
    //get_template_part('page-templates/global-sections/how-it-works');

        $how_it_work_heading = carbon_get_post_meta(get_the_ID(),'how_it_work_heading');
        $how_it_work_heading_separated = explode(" | ", $how_it_work_heading);

        $how_it_work_image_title_one = carbon_get_post_meta(get_the_ID(),'how_it_work_image_title_one');
        $how_it_work_image_one = carbon_get_post_meta(get_the_ID(),'how_it_work_image_one');
        $how_it_work_image_one_attachment = get_media_url($how_it_work_image_one,'full');

        $how_it_work_image_with_title_two = carbon_get_post_meta( get_the_ID(),'how_it_work_image_with_title_two'); // complex
        $how_it_work_image_with_title_three = carbon_get_post_meta( get_the_ID(),'how_it_work_image_with_title_three'); // complex
        $how_it_work_image_with_title_four = carbon_get_post_meta( get_the_ID(),'how_it_work_image_with_title_four'); // complex
        $how_it_work_image_with_title_five = carbon_get_post_meta( get_the_ID(),'how_it_work_image_with_title_five'); // complex
        $how_it_work_image_with_title_six = carbon_get_post_meta( get_the_ID(),'how_it_work_image_with_title_six'); // complex

        // Dials switch case
        $how_it_works_dials_count = carbon_get_post_meta(get_the_ID(),'how_it_works_dials_count');

        switch ($how_it_works_dials_count) {

            case "1": 
                ?>
                    <section class="steps-main-wrapper steps-one container-xxl container pt-8 pb-8 text-center">
                        <h2 class="h1 cmn-heading"><?php  echo $how_it_work_heading_separated[0]; ?><strong> <?php echo $how_it_work_heading_separated[1]; ?></strong></h2>
                        <!-- Desktop -->
                        <div class="circle-sec-wrap desktop-dials text-start mt-5 d-none d-xl-grid">
                            <div class="steps-content-odd">
                                <div class="content-box">
                                    <div class="d-flex align-items-initial h-100">
                                        <div class="icon-wrap f-center">
                                            <img class="o-contain" src="<?php echo $how_it_work_image_one_attachment; ?>" alt="Step Image">
                                        </div>
                                        <div class="d-flex align-items-center"><p><?php echo $how_it_work_image_title_one; ?></p></div>
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
                                        <img class="o-contain" src="<?php echo $how_it_work_image_one_attachment; ?>" alt="Step One Image">
                                    </div>
                                    <p><?php echo $how_it_work_image_title_one; ?></p>
                                </div>
                            </div>
                        </div>
                    </section>
                <?php
                break;

            case "2": 
                ?>
                    <section class="steps-main-wrapper steps-two container-xxl container pt-8 pb-8 text-center">
                        <h2 class="h1 cmn-heading"><?php  echo $how_it_work_heading_separated[0]; ?><strong> <?php echo $how_it_work_heading_separated[1]; ?></strong></h2>
                        <!-- Desktop -->
                        <div class="circle-sec-wrap desktop-dials text-start mt-5 d-none d-xl-grid">
                            <div class="steps-content-odd">
                                <?php
                                $count_loop = 0;
                                foreach($how_it_work_image_with_title_two as $how_it_work_image_with_title ):
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
                            </div>
                            <div class="steps-content-even">
                                <?php
                                $count_loop = 1;
                                foreach($how_it_work_image_with_title_two as $how_it_work_image_with_title ):
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
                                    if(!empty($how_it_work_image_with_title_two[0]['how_it_work_image'])):

                                    $how_it_work_image_attachment = get_media_url($how_it_work_image_with_title_two[0]['how_it_work_image'],'full');
                                    ?>
                                    <div class="icon-wrap f-center">
                                        <img class="o-contain" src="<?php echo $how_it_work_image_attachment; ?>" alt="Step One Image">
                                    </div>
                                    <?php endif; ?>
                                    <p><?php echo $how_it_work_image_with_title_two[0]['how_it_work_image_title']; ?></p>
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
                                    if(!empty($how_it_work_image_with_title_two[1]['how_it_work_image'])):
                                        $how_it_work_image_attachment = get_media_url($how_it_work_image_with_title_two[1]['how_it_work_image'],'full');
                                        ?>
                                        <div class="icon-wrap f-center">
                                            <img class="o-contain" src="<?php echo $how_it_work_image_attachment; ?>" alt="Step Two Image">
                                        </div>
                                    <?php endif; ?>
                                    <p><?php echo $how_it_work_image_with_title_two[1]['how_it_work_image_title']; ?></p>
                                </div>
                            </div>
                        </div>
                    </section>
                <?php
                break;

            case "3": 
                ?>
                    <section class="steps-main-wrapper steps-three container-xxl container pt-8 pb-8 text-center">
                        <h2 class="h1 cmn-heading"><?php  echo $how_it_work_heading_separated[0]; ?><strong> <?php echo $how_it_work_heading_separated[1]; ?></strong></h2>
                        <!-- Desktop -->
                        <div class="circle-sec-wrap desktop-dials text-start mt-5 d-none d-xl-grid">
                            <div class="steps-content-odd">
                                <?php
                                $count_loop = 0;
                                foreach($how_it_work_image_with_title_three as $how_it_work_image_with_title ):
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
                                foreach($how_it_work_image_with_title_three as $how_it_work_image_with_title ):
                                    if($count_loop < 2 & $count_loop != 0 ):
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
                                                <div class="d-flex align-items-center"><p><?php echo $how_it_work_image_with_title['how_it_work_image_title']; ?></p>
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
                                    if(!empty($how_it_work_image_with_title_three[0]['how_it_work_image'])):

                                    $how_it_work_image_attachment = get_media_url($how_it_work_image_with_title_three[0]['how_it_work_image'],'full');
                                    ?>
                                    <div class="icon-wrap f-center">
                                        <img class="o-contain" src="<?php echo $how_it_work_image_attachment; ?>" alt="Step One Image">
                                    </div>
                                    <?php endif; ?>
                                    <p><?php echo $how_it_work_image_with_title_three[0]['how_it_work_image_title']; ?></p>
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
                                    if(!empty($how_it_work_image_with_title_three[1]['how_it_work_image'])):
                                        $how_it_work_image_attachment = get_media_url($how_it_work_image_with_title_three[1]['how_it_work_image'],'full');
                                        ?>
                                        <div class="icon-wrap f-center">
                                            <img class="o-contain" src="<?php echo $how_it_work_image_attachment; ?>" alt="Step Two Image">
                                        </div>
                                    <?php endif; ?>
                                    <p><?php echo $how_it_work_image_with_title_three[1]['how_it_work_image_title']; ?></p>
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
                                    if(!empty($how_it_work_image_with_title_three[2]['how_it_work_image'])):
                                        $how_it_work_image_attachment = get_media_url($how_it_work_image_with_title_three[2]['how_it_work_image'],'full');
                                        ?>
                                        <div class="icon-wrap f-center">
                                            <img class="o-contain" src="<?php echo $how_it_work_image_attachment; ?>" alt="Step Three Image">
                                        </div>
                                    <?php endif; ?>
                                    <p><?php echo $how_it_work_image_with_title_three[2]['how_it_work_image_title']; ?></p>
                                </div>
                            </div>
                        </div>
                    </section>
                <?php
                break;

            case "4": 
                ?>
                    <section class="steps-main-wrapper steps-four container-xxl container pt-8 pb-8 text-center">
                        <h2 class="h1 cmn-heading"><?php echo $how_it_work_heading_separated[0]; ?><strong> <?php echo $how_it_work_heading_separated[1]; ?></strong></h2>
                        <!-- Desktop -->
                        <div class="circle-sec-wrap desktop-dials text-start mt-5 d-none d-xl-grid">
                            <div class="steps-content-odd">
                                <?php
                                $count_loop = 0;
                                foreach($how_it_work_image_with_title_four as $how_it_work_image_with_title ):
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
                                foreach($how_it_work_image_with_title_four as $how_it_work_image_with_title ):
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
                                    if(!empty($how_it_work_image_with_title_four[0]['how_it_work_image'])):

                                    $how_it_work_image_attachment = get_media_url($how_it_work_image_with_title_four[0]['how_it_work_image'],'full');
                                    ?>
                                    <div class="icon-wrap f-center">
                                        <img class="o-contain" src="<?php echo $how_it_work_image_attachment; ?>" alt="Step One Image">
                                    </div>
                                    <?php endif; ?>
                                    <p><?php echo $how_it_work_image_with_title_four[0]['how_it_work_image_title']; ?></p>
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
                                    if(!empty($how_it_work_image_with_title_four[1]['how_it_work_image'])):
                                        $how_it_work_image_attachment = get_media_url($how_it_work_image_with_title_four[1]['how_it_work_image'],'full');
                                        ?>
                                        <div class="icon-wrap f-center">
                                            <img class="o-contain" src="<?php echo $how_it_work_image_attachment; ?>" alt="Step Two Image">
                                        </div>
                                    <?php endif; ?>
                                    <p><?php echo $how_it_work_image_with_title_four[1]['how_it_work_image_title']; ?></p>
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
                                    if(!empty($how_it_work_image_with_title_four[2]['how_it_work_image'])):
                                        $how_it_work_image_attachment = get_media_url($how_it_work_image_with_title_four[2]['how_it_work_image'],'full');
                                        ?>
                                        <div class="icon-wrap f-center">
                                            <img class="o-contain" src="<?php echo $how_it_work_image_attachment; ?>" alt="Step Three Image">
                                        </div>
                                    <?php endif; ?>
                                    <p><?php echo $how_it_work_image_with_title_four[2]['how_it_work_image_title']; ?></p>
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
                                    if(!empty($how_it_work_image_with_title_four[3]['how_it_work_image'])):
                                        $how_it_work_image_attachment = get_media_url($how_it_work_image_with_title_four[3]['how_it_work_image'],'full');
                                        ?>
                                        <div class="icon-wrap f-center">
                                            <img class="o-contain" src="<?php echo $how_it_work_image_attachment; ?>" alt="Step Four Image">
                                        </div>
                                    <?php endif; ?>
                                    <p><?php echo $how_it_work_image_with_title_four[3]['how_it_work_image_title']; ?></p>
                                </div>
                            </div>
                        </div>
                    </section>
                <?php
                break;

            case "5": 
                ?>
                    <section class="steps-main-wrapper steps-five container-xxl container pt-8 pb-8 text-center">
                        <h2 class="h1 cmn-heading"><?php echo $how_it_work_heading_separated[0]; ?><strong> <?php echo $how_it_work_heading_separated[1]; ?></strong></h2>
                        <!-- Desktop -->
                        <div class="circle-sec-wrap desktop-dials text-start mt-5 d-none d-xl-grid">
                            <div class="steps-content-odd">
                                <?php
                                $count_loop = 0;
                                foreach($how_it_work_image_with_title_five as $how_it_work_image_with_title ):
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
                                foreach($how_it_work_image_with_title_five as $how_it_work_image_with_title ):
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
                                    if(!empty($how_it_work_image_with_title_five[0]['how_it_work_image'])):

                                    $how_it_work_image_attachment = get_media_url($how_it_work_image_with_title_five[0]['how_it_work_image'],'full');
                                    ?>
                                    <div class="icon-wrap f-center">
                                        <img class="o-contain" src="<?php echo $how_it_work_image_attachment; ?>" alt="Step One Image">
                                    </div>
                                    <?php endif; ?>
                                    <p><?php echo $how_it_work_image_with_title_five[0]['how_it_work_image_title']; ?></p>
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
                                    if(!empty($how_it_work_image_with_title_five[1]['how_it_work_image'])):
                                        $how_it_work_image_attachment = get_media_url($how_it_work_image_with_title_five[1]['how_it_work_image'],'full');
                                        ?>
                                        <div class="icon-wrap f-center">
                                            <img class="o-contain" src="<?php echo $how_it_work_image_attachment; ?>" alt="Step Two Image">
                                        </div>
                                    <?php endif; ?>
                                    <p><?php echo $how_it_work_image_with_title_five[1]['how_it_work_image_title']; ?></p>
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
                                    if(!empty($how_it_work_image_with_title_five[2]['how_it_work_image'])):
                                        $how_it_work_image_attachment = get_media_url($how_it_work_image_with_title_five[2]['how_it_work_image'],'full');
                                        ?>
                                        <div class="icon-wrap f-center">
                                            <img class="o-contain" src="<?php echo $how_it_work_image_attachment; ?>" alt="Step Three Image">
                                        </div>
                                    <?php endif; ?>
                                    <p><?php echo $how_it_work_image_with_title_five[2]['how_it_work_image_title']; ?></p>
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
                                    if(!empty($how_it_work_image_with_title_five[3]['how_it_work_image'])):
                                        $how_it_work_image_attachment = get_media_url($how_it_work_image_with_title_five[3]['how_it_work_image'],'full');
                                        ?>
                                        <div class="icon-wrap f-center">
                                            <img class="o-contain" src="<?php echo $how_it_work_image_attachment; ?>" alt="Step Four Image">
                                        </div>
                                    <?php endif; ?>
                                    <p><?php echo $how_it_work_image_with_title_five[3]['how_it_work_image_title']; ?></p>
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
                                    if(!empty($how_it_work_image_with_title_five[4]['how_it_work_image'])):
                                        $how_it_work_image_attachment = get_media_url($how_it_work_image_with_title_five[4]['how_it_work_image'],'full');
                                        ?>
                                        <div class="icon-wrap f-center">
                                            <img class="o-contain" src="<?php echo $how_it_work_image_attachment; ?>" alt="Step Five Image">
                                        </div>
                                    <?php endif; ?>
                                    <p><?php echo $how_it_work_image_with_title_five[4]['how_it_work_image_title']; ?></p>
                                </div>
                            </div>
                        </div>
                    </section>
                <?php
                break;

            case "6": 
                ?>
                    <section class="steps-main-wrapper steps-six container-xxl container pt-8 pb-8 text-center">
                        <h2 class="h1 cmn-heading"><?php echo $how_it_work_heading_separated[0]; ?><strong> <?php echo $how_it_work_heading_separated[1]; ?></strong></h2>
                        <!-- Desktop -->
                        <div class="circle-sec-wrap desktop-dials text-start mt-5 d-none d-xl-grid">
                            <div class="steps-content-odd">
                                <?php
                                $count_loop = 0;
                                foreach($how_it_work_image_with_title_six as $how_it_work_image_with_title ):
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
                                foreach($how_it_work_image_with_title_six as $how_it_work_image_with_title ):
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
                                    if(!empty($how_it_work_image_with_title_six[0]['how_it_work_image'])):

                                    $how_it_work_image_attachment = get_media_url($how_it_work_image_with_title_six[0]['how_it_work_image'],'full');
                                    ?>
                                    <div class="icon-wrap f-center">
                                        <img class="o-contain" src="<?php echo $how_it_work_image_attachment; ?>" alt="Step One Image">
                                    </div>
                                    <?php endif; ?>
                                    <p><?php echo $how_it_work_image_with_title_six[0]['how_it_work_image_title']; ?></p>
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
                                    if(!empty($how_it_work_image_with_title_six[1]['how_it_work_image'])):
                                        $how_it_work_image_attachment = get_media_url($how_it_work_image_with_title_six[1]['how_it_work_image'],'full');
                                        ?>
                                        <div class="icon-wrap f-center">
                                            <img class="o-contain" src="<?php echo $how_it_work_image_attachment; ?>" alt="Step Two Image">
                                        </div>
                                    <?php endif; ?>
                                    <p><?php echo $how_it_work_image_with_title_six[1]['how_it_work_image_title']; ?></p>
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
                                    if(!empty($how_it_work_image_with_title_six[2]['how_it_work_image'])):
                                        $how_it_work_image_attachment = get_media_url($how_it_work_image_with_title_six[2]['how_it_work_image'],'full');
                                        ?>
                                        <div class="icon-wrap f-center">
                                            <img class="o-contain" src="<?php echo $how_it_work_image_attachment; ?>" alt="Step Three Image">
                                        </div>
                                    <?php endif; ?>
                                    <p><?php echo $how_it_work_image_with_title_six[2]['how_it_work_image_title']; ?></p>
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
                                    if(!empty($how_it_work_image_with_title_six[3]['how_it_work_image'])):
                                        $how_it_work_image_attachment = get_media_url($how_it_work_image_with_title_six[3]['how_it_work_image'],'full');
                                        ?>
                                        <div class="icon-wrap f-center">
                                            <img class="o-contain" src="<?php echo $how_it_work_image_attachment; ?>" alt="Step Four Image">
                                        </div>
                                    <?php endif; ?>
                                    <p><?php echo $how_it_work_image_with_title_six[3]['how_it_work_image_title']; ?></p>
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
                                    if(!empty($how_it_work_image_with_title_six[4]['how_it_work_image'])):
                                        $how_it_work_image_attachment = get_media_url($how_it_work_image_with_title_six[4]['how_it_work_image'],'full');
                                        ?>
                                        <div class="icon-wrap f-center">
                                            <img class="o-contain" src="<?php echo $how_it_work_image_attachment; ?>" alt="Step Five Image">
                                        </div>
                                    <?php endif; ?>
                                    <p><?php echo $how_it_work_image_with_title_six[4]['how_it_work_image_title']; ?></p>
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
                                    if(!empty($how_it_work_image_with_title_six[5]['how_it_work_image'])):
                                        $how_it_work_image_attachment = get_media_url($how_it_work_image_with_title_six[5]['how_it_work_image'],'full');
                                        ?>
                                        <div class="icon-wrap f-center">
                                            <img class="o-contain" src="<?php echo $how_it_work_image_attachment; ?>" alt="Step Six Image">
                                        </div>
                                    <?php endif; ?>
                                    <p><?php echo $how_it_work_image_with_title_six[5]['how_it_work_image_title']; ?></p>
                                </div>
                            </div>
                        </div>
                    </section>
                <?php
                break;
        }
}
?>

<!-- Whom we Work With Section -->
<?php
$www_section_options =  carbon_get_post_meta( get_the_ID(),'www_section_options');
if($www_section_options == 'yes'){

    $www_section_heading =  carbon_get_post_meta( get_the_ID(),'www_section_heading');
    $www_section_heading_separated = explode(" | ", $www_section_heading);
    $www_section_content =  carbon_get_post_meta( get_the_ID(),'www_section_content');

    $site_logo =  carbon_get_theme_option('site_logo');
    $site_logo_attached = get_media_url($site_logo,'full');

    $www_section_items =  carbon_get_post_meta( get_the_ID(),'www_section_items'); //complex
?>
<section class="our-work-sec container text-center mt-8">
    <div class="header-wrap">
      <h2 class="cmn-heading h1"><?php echo $www_section_heading_separated[0]; ?><strong> <?php echo $www_section_heading_separated[1]; ?></strong>
      </h2>
      <p><?php echo $www_section_content; ?></p>
    </div>
    <div class="content-wrap cmn-radius-box border-transform bg-white mt-5">
      <ul>
          <?php 
          foreach($www_section_items as $items){
            ?>
                <li><?php echo $items['www_section_accordion_items']; ?></li>
            <?php 
          }
          ?>
      </ul>
      <img src="<?php echo $site_logo_attached; ?>" alt="Our Work Image">
    </div>
  </section>
<?php
}
?>

<!-- Benefits Section (V1) -->

<?php
$benefits_of_working_section_options =  carbon_get_post_meta( get_the_ID(),'benefits_of_working_section_options');
if($benefits_of_working_section_options == 'yes'){

    $benefits_of_working_heading = carbon_get_post_meta(get_the_ID(), 'benefits_of_working_heading');
    $benefits_of_working_heading_separated = explode(" | ", $benefits_of_working_heading);

    $benefits_of_working_sub_heading = carbon_get_post_meta(get_the_ID(), 'benefits_of_working_sub_heading');
    
    $benefits_of_working_bg_image = carbon_get_post_meta(get_the_ID(), 'benefits_of_working_bg_image');
    $benefits_of_working_bg_image_attached_d = get_media_url($benefits_of_working_bg_image,'butterfly-bg-d');
    $benefits_of_working_bg_image_attached_t = get_media_url($benefits_of_working_bg_image,'butterfly-bg-t');
    $benefits_of_working_bg_image_attached_m = get_media_url($benefits_of_working_bg_image,'butterfly-bg-m');

    $benefits_of_working_fg_image = carbon_get_post_meta(get_the_ID(), 'benefits_of_working_fg_image');
    $benefits_of_working_fg_image_attached_d = get_media_url($benefits_of_working_fg_image,'butterfly-d');
    $benefits_of_working_fg_image_attached_t = get_media_url($benefits_of_working_fg_image,'butterfly-t');
    $benefits_of_working_fg_image_attached_m = get_media_url($benefits_of_working_fg_image,'butterfly-m');

    $benefits_of_working_with_capitalplus_supply_cards = carbon_get_post_meta(get_the_ID(), 'benefits_of_working_with_capitalplus_supply_cards');

    ?>
    <section class="sm-card-wrap text-center pt-8">
        <div class="container-xs">
            <h2 class="cmn-heading h1"><?php echo $benefits_of_working_heading_separated[0]; ?> <br /> <strong><?php echo $benefits_of_working_heading_separated[1]; ?></strong></h2>
            <h3>
                <?php
                echo apply_filters( 'the_content', $benefits_of_working_sub_heading );
                ?>
            </h3>
        </div>
        <div class="position-relative image-wrapper">
            <div class="image-group">
                <!-- Background Mask Image -->
                <picture>
                    <!-- Desktop -->
                    <source media="(min-width: 1200px)" srcset="<?php echo $benefits_of_working_bg_image_attached_d; ?>">
                    <!-- Tab -->
                    <source media="(min-width: 575px)" srcset="<?php echo $benefits_of_working_bg_image_attached_t; ?>">
                    <!-- Mobile -->
                    <img src="<?php echo $benefits_of_working_bg_image_attached_m; ?>" alt="">
                </picture>
                <div class="image-group-inner">
                <!-- Main Dynamic Image -->
                <picture>
                    <!-- Desktop -->
                    <source media="(min-width: 1200px)" srcset="<?php echo $benefits_of_working_fg_image_attached_d; ?>">
                    <!-- Tab -->
                    <source media="(min-width: 575px)" srcset="<?php echo $benefits_of_working_fg_image_attached_t; ?>">
                    <!-- Mobile -->
                    <img src="<?php echo $benefits_of_working_fg_image_attached_m; ?>" alt="">
                </picture>
                </div>
            </div>
            <div class="container-xxl container">
                <div class="row">
                    <div class="col-xl-10">
                        <div class="d-flex flex-wrap">
                            <div class="row">
                                <?php foreach($benefits_of_working_with_capitalplus_supply_cards as $benefits_of_working_with_capitalplus_supply_card): ?>
                                <div class="col-sm-6 col-xl-4">
                                    <div class="bg-white text-start card-small">
                                        <div class="line-top">
                                            <p>
                                                <?php echo $benefits_of_working_with_capitalplus_supply_card['benefits_of_working_content'];?>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

<?php
}
?>

<!-- Benefits Section (V2) -->

<?php
$benefits_cards_section_options =  carbon_get_post_meta( get_the_ID(),'benefits_cards_section_options');
if($benefits_cards_section_options == 'yes'){
        $benefits_of_working_heading = carbon_get_post_meta(get_the_ID(), 'benefits_of_working_card_heading');
        $benefits_of_working_heading_separated = explode(" | ", $benefits_of_working_heading);

        $benefits_of_working_card_heading_content = carbon_get_post_meta(get_the_ID(), 'benefits_of_working_card_heading_content');
     
        $benefits_of_working_with_capitalplus_cards = carbon_get_post_meta(get_the_ID(), 'benefits_of_working_with_capitalplus_cards');

        ?>
        <section class="container-xxl container text-center radius-cards pt-8 pb-8">
            <div class="container-xs">
                <h2 class="cmn-heading h1">
                    <?php
                    echo $benefits_of_working_heading_separated[0];
                    ?>
                    <strong><?php echo $benefits_of_working_heading_separated[1] ?></strong>
                    <?php
                    echo $benefits_of_working_heading_separated[2];
                    ?>
                </h2>
                <h3>
                    <?php
                    echo apply_filters( 'the_content', $benefits_of_working_card_heading_content);
                    ?>
                </h3>
            </div>
            <div class="row text-start mt-6">
                <?php
                foreach($benefits_of_working_with_capitalplus_cards as $benefits_of_working_card):
                    $benefits_of_working_card_image = $benefits_of_working_card['benefits_of_working_card_image'];
                    $benefits_of_working_title = $benefits_of_working_card['benefits_of_working_title'];
                    $benefits_of_working_card_lists = $benefits_of_working_card['benefits_of_working_card_list'];
                    //card_list_title
                ?>
                <div class="col-xxxl-3 col-xxl-4 col-md-6">
                    <div class="cmn-radius-box bg-white card overflow-visible">
                        <div class="card-icon f-center">
                            <?php
                            if(!empty($benefits_of_working_card_image)):
                                $attached_image_card = get_media_url($benefits_of_working_card_image,'full');
                            ?>
                            <img src="<?php echo $attached_image_card; ?>" alt="stopwatch-png">
                            <?php
                            endif;
                            ?>
                        </div>
                        <h3 class="h2 text-blue mb-2 text-center">
                            <?php
                            echo $benefits_of_working_title;
                            ?>
                        </h3>
                        <p>
                        <?php
                            echo apply_filters( 'the_content', $benefits_of_working_card_lists );
                        ?>
                        </p>
                    </div>
                </div>
                <?php
                endforeach;
                ?>

            </div>
            <div class="container-xs text-center custom-wrap">
                <?php
                $benefits_of_working_main_lists = carbon_get_post_meta(get_the_ID(), 'benefits_of_working_main_list');
                ?>
                <?php echo wpautop($benefits_of_working_main_lists) ?>  
            </div>
             </section>
<?php
            } 
?>

<!-- C2A -->

<?php
$cta_section_options =  carbon_get_post_meta( get_the_ID(),'cta_section_options');
if($cta_section_options == 'yes'){

$cta_heading = carbon_get_post_meta(get_the_ID(), 'cta_heading');
$cta_content = carbon_get_post_meta(get_the_ID(), 'cta_content');
$cta_link = carbon_get_post_meta(get_the_ID(), 'cta_link');

?>
<section class="contact-us-block bg-gradient-green py-6 mb-8">
    <div class="container-xxl container text-center text-white">
        <h2 class="h1"><strong><?php echo $cta_heading; ?></strong></h2>
        <p><?php echo $cta_content; ?></p>
        <a href="<?php echo $cta_link['url']; ?>" target="<?php if($cta_link['blank'] != 0): echo "_blank"; endif; ?>" class="btn bg-blue cmn-btn curve-left mt-5"><?php echo $cta_link['anchor'] ; ?></a>
    </div>
</section>
<?php
}
?>

<!-- Video Section -->
<?php

$service_video_section_options =  carbon_get_post_meta( get_the_ID(),'service_video_section_options');
if($service_video_section_options == 'yes'){

    $cash_flow_side_content_heading = carbon_get_post_meta( get_the_ID(),'cash_flow_side_content_heading');
    $cash_flow_side_video_content = carbon_get_post_meta( get_the_ID(),'cash_flow_side_video_content');

    $cash_flow_feature_image = carbon_get_post_meta( get_the_ID(),'cash_flow_feature_image');

    $cash_flow_attached_images_d = get_media_url($cash_flow_feature_image,'service-video-d');
    $cash_flow_attached_images_t = get_media_url($cash_flow_feature_image,'service-video-t');
    $cash_flow_attached_images_m = get_media_url($cash_flow_feature_image,'service-video-m');

    $cashflow_youtube_video_link = carbon_get_post_meta( get_the_ID(),'cashflow_youtube_video_link');
    $cashflow_upload_video_link_file = carbon_get_post_meta( get_the_ID(),'cashflow_upload_video_link_file');
    $cash_flow_upload_video = wp_get_attachment_url($cashflow_upload_video_link_file);

    $cash_flow_uploaded_video_banner_image = carbon_get_post_meta( get_the_ID(),'cash_flow_uploaded_video_banner_image');
    $cash_flow_uploaded_video_banner_image_attached = get_media_url($cash_flow_uploaded_video_banner_image,'full');

    $cash_flow_video_banner_heading = carbon_get_post_meta( get_the_ID(),'cash_flow_video_banner_heading');
    $cash_flow_video_banner_heading_separated = explode(" | ", $cash_flow_video_banner_heading);

    $cash_flow_video_options = carbon_get_post_meta( get_the_ID(),'cash_flow_video_options');

    ?>
    <section class="container-xl two-col-wrap mt-8 pb-8">
        <div class="row cmn-space-tabs">
            <div class="col-xl-7">
                <div class="border-transform">
                    <div class="play-btn-wrap cmn-radius-box-sm">
                        <h2 class="text-blue"><?php echo $cash_flow_video_banner_heading_separated[0]; ?><br><?php echo $cash_flow_video_banner_heading_separated[1]; ?></h2>
                        <?php
                        if(!empty($cash_flow_feature_image)):
                            ?>
                            <picture>
                                <!-- Desktop -->
                                <source class="o-cover h-100 w-100" media="(min-width: 1200px)" srcset="<?php echo $cash_flow_attached_images_d; ?>">
                                <!-- Tab -->
                                <source class="o-cover h-100 w-100" media="(min-width: 575px)" srcset="<?php echo $cash_flow_attached_images_t; ?>">
                                <!-- Mobile -->
                                <img class="o-cover h-100 w-100" src="<?php echo $cash_flow_attached_images_m; ?>" alt="">
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
                                        <button type="button"  video_poster="" type_video="youtube" video_link="<?php echo $cashflow_youtube_video_link ?>" class="btn cmn-play" data-bs-toggle="modal"
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
                                
                            }else{
                                if(!empty($cash_flow_upload_video)){
                                ?>
                                <div class="cmn-play-wrap f-center">
                                    <button type="button" video_poster="<?php echo $cash_flow_uploaded_video_banner_image_attached; ?>" type_video="uploaded" video_link="<?php echo $cash_flow_upload_video ?>" class="btn cmn-play" data-bs-toggle="modal"
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
            <div class="col-xl-5 px-xl-0 f-center text-center text-xl-start">
                <div class="content">
                    <h2 class="text-blue"><?php echo $cash_flow_side_content_heading; ?>
                    </h2>
                    <p><?php echo $cash_flow_side_video_content; ?></p>
                </div>
            </div>
        </div>
    </section>
<?php
}
?>


<!-- FAQ -->

<?php
$faqs_section_options =  carbon_get_theme_option('faqs_section_options');
if($faqs_section_options == 'yes'){

    $frequently_asked_questions_heading = carbon_get_theme_option('frequently_asked_questions_heading');
    $frequently_asked_questions_heading_separated = explode(" | ",  $frequently_asked_questions_heading);
    $frequently_asked_questions_content = carbon_get_theme_option('frequently_asked_questions_content');
    $frequently_asked_questions = carbon_get_theme_option( 'frequently_asked_questions');

    ?>
    <section class="position-relative text-center mt-8 pb-8 cmn-accordion" id="faqAccordion">
        <div class="header-wrap">
            <h2 class="cmn-heading h1"><?php echo $frequently_asked_questions_heading_separated[0]; ?> <br><strong><?php echo $frequently_asked_questions_heading_separated[1]; ?></strong></h2>
            <p><?php echo $frequently_asked_questions_content; ?></p>
        </div>
        <?php
        $count_accordion_section = 0;
        foreach($frequently_asked_questions as $frequently_asked_question):
            $frequently_asked_questions_heading = $frequently_asked_question['frequently_asked_questions_section_heading'];
            $frequently_asked_questions_section_heading_separated = explode(" | ",  $frequently_asked_questions_heading );
        ?>
        <h2 class="text-blue accordion-title">
                    <?php
                    echo $frequently_asked_questions_section_heading_separated[0];
                    ?>
                    <?php
                    echo $frequently_asked_questions_section_heading_separated[1];
                    ?>
        </h2>
        <div class="accordion">
            <?php
            $count_accordion = 0;
            foreach ($frequently_asked_question['frequently_asked_questions_accordion'] as $frequently_asked_questions_accordion) :
                $class_active = $count_accordion.'-'.$count_accordion_section;
                ?>
            <div class="accordion-item <?php if($class_active == '0-0'){ echo "show"; }else{ echo ""; }?>">
                <button id="headingOne-<?php echo $count_accordion.'-'.$count_accordion_section; ?>"
                        class="accordion-button d-flex justify-content-between h4 text-blue collapsed mb-0"
                        type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne-<?php echo $count_accordion.'-'.$count_accordion_section; ?>"
                        aria-expanded="<?php if($class_active == '0-0'){ echo "true"; }else{ echo "false"; }?>"
                        aria-controls="collapseOne-<?php echo $count_accordion.'-'.$count_accordion_section; ?>">
                    <h4 class="h4  mb-0">
                        <?php
                       echo $frequently_asked_questions_accordion['frequently_asked_questions_accordion_title'];
                        ?>
                        </h4>
                    <div class="bg-green btn btn-close cmn-btn min-width-initial">
                        <i class="fa-solid fa-plus"></i>
                    </div>
                </button>
                <div id="collapseOne-<?php echo $count_accordion.'-'.$count_accordion_section; ?>" class="accordion-collapse <?php if($class_active == '0-0'){ echo "show"; }else{ echo ""; };?> collapse text-start"
                     aria-labelledby="headingOne" data-bs-parent="#faqAccordion">
                    <div class="accordion-body">
                        <div class="accordion-content">
                            <p>
                                <?php
                                echo $frequently_asked_questions_accordion['frequently_asked_questions_accordion_content'];
                                ?>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <?php
                $count_accordion++;
            endforeach;
            ?>
        </div>
        <?php
            $count_accordion_section++;
        endforeach; 
        ?>
  </section>
<?php
}
?> 

<!-- /Frequently asked question Section -->
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