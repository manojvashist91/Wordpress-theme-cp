<?php
$meet_our_team_heading = carbon_get_theme_option('meet_our_team_heading');
$our_word_heading = explode(" | ", $meet_our_team_heading);
$meet_our_team_content = carbon_get_theme_option('meet_our_team_content');
$meet_our_team_heading_strong = carbon_get_post_meta( get_the_ID(),'meet_our_team_heading_strong');
$posts_our_teams = get_posts(array(
        'post_type'   => 'our_team',
        'post_status' => 'public',
        'posts_per_page' => -1,
        'fields' => 'ids'
    )
);
?>
<section class="container-xxl container our-team-sec text-center mt-8 pb-8">
            <div class="container-sm">
                <h2 class="h1 cmn-heading mb-4"><?php echo $our_word_heading[0]; ?> <strong><?php echo $our_word_heading[1]; ?></strong></h2>
                <p><?php echo $meet_our_team_content; ?></p>
            </div>
            <div class="row mt-7">
                <?php

                foreach ( $posts_our_teams as $posts_our_team ) :
                    
                $our_team_image = carbon_get_post_meta($posts_our_team,"our_team_image");
                $attached_images_d = get_media_url( $our_team_image,'headshot-d');
                $attached_images_t = get_media_url( $our_team_image,'headshot-t');
                $attached_images_m = get_media_url( $our_team_image,'headshot-m');

                $our_team_hover_image = carbon_get_post_meta($posts_our_team,"our_team_hover_image");
                $attached_hover_images_d = get_media_url( $our_team_hover_image,'headshot-d');
                $attached_hover_images_t = get_media_url( $our_team_hover_image,'headshot-t');
                $attached_hover_images_m = get_media_url( $our_team_hover_image,'headshot-m');

                $our_team_linkedin_url = carbon_get_post_meta($posts_our_team,"our_team_linkedin_url");
                $our_team_position = carbon_get_post_meta($posts_our_team,"our_team_position");
                $our_team_phone_number = carbon_get_post_meta($posts_our_team,"our_team_phone_number");
                $our_team_email_address = carbon_get_post_meta($posts_our_team,"our_team_email_address");
                $our_team_download_vcard = carbon_get_post_meta($posts_our_team,"download_vcard");
                $attached_download_vcard = wp_get_attachment_url( $our_team_download_vcard );

                ?>
                <div class="col-xxxl-3 col-xxl-4 col-md-6 mb-4" id="<?php echo $posts_our_team; ?>" >
                    <div class="cmn-radius-box overflow-visible bg-white position-relative">
                        <div class="rounded-circle img-wrap">
                            <?php
                            if(!empty($attached_images_d)){
                            ?>
                            <picture>
                                <!-- Desktop -->
                                <source class="o-cover h-100 w-100 rounded-circle" media="(min-width: 1200px)" srcset="<?php echo $attached_images_d; ?>">
                                <!-- Tab -->
                                <source class="o-cover h-100 w-100 rounded-circle" media="(min-width: 575px)" srcset="<?php echo $attached_images_t; ?>">
                                <!-- Mobile -->
                                <img class="o-cover h-100 w-100 rounded-circle" src="<?php echo $attached_images_m; ?>" alt="Member Avatar">
                            </picture>
                            <?php
                            }
                            if(!empty($attached_hover_images_d)){
                            ?>
                            <div class="hover-image">
                            <picture>
                                <!-- Desktop -->
                                <source class="o-cover h-100 w-100 rounded-circle" media="(min-width: 1200px)" srcset="<?php echo $attached_hover_images_d; ?>">
                                <!-- Tab -->
                                <source class="o-cover h-100 w-100 rounded-circle" media="(min-width: 575px)" srcset="<?php echo $attached_hover_images_t; ?>">
                                <!-- Mobile -->
                                <img class="o-cover h-100 w-100 rounded-circle" src="<?php echo $attached_hover_images_m; ?>" alt="Member Avatar">
                            </picture>
                            </div>
                            <?php
                            }
                            if(!empty($our_team_linkedin_url)){
                            ?>
                            <a target="_blank" class="bg-green" href="<?php echo $our_team_linkedin_url; ?>"><i class="fa-brands fa-linkedin-in"></i></a>
                            <?php
                            }
                            ?>
                        </div>
                        <h3 class="text-blue text-uppercase mb-1"><?php echo get_the_title($posts_our_team); ?></h3>
                        <h4 class="h5"><?php echo $our_team_position; ?></h4>
                        <ul class="list-unstyled">
                            <li>
                                <?php if(!empty($our_team_phone_number)):?>
                                <a href="tel:<?php echo $our_team_phone_number; ?>" class="text-black"><i
                                        class="fa-solid fa-phone cmn-icon"></i><?php echo $our_team_phone_number; ?></a>
                               <?php endif ?>
                            </li>
                            <li>
                                <?php if(!empty($our_team_email_address)):?>
                                <a href="mailto:<?php echo $our_team_email_address; ?>" class="text-black"><i
                                        class="fa-solid fa-envelope cmn-icon"></i><?php echo $our_team_email_address; ?></a>
                                <?php endif ?>
                            </li>
                            <li>
                                <?php if(!empty($our_team_download_vcard)):?>
                                <a href="<?php echo $attached_download_vcard;  ?>" class="text-black"><i class="bi bi-download cmn-icon"></i><?php esc_html_e( 'Download vCard', THEME_TEXTDOMAIN) ?></a>
                                <?php endif ?>
                            </li>
                        </ul>
                    </div>
                </div>
                <?php
                endforeach;
                ?>
            </div>
        </section>