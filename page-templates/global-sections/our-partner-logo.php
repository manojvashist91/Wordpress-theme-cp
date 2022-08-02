<?php
        $our_partner_logos = carbon_get_theme_option( 'our_partner_logos');
        $our_partner_global_heading = carbon_get_theme_option( 'our_partner_global_heading');
        ?>
        <section class="our-partners-sec bg-white text-center pt-5">
            <h2 class="cmn-heading h1 mb-0"><?php echo $our_partner_global_heading; ?></h2>
            <!-- Swiper -->
            <div class="swiper swiper-gradient our-partners">
                <div class="swiper-wrapper">
                <?php
                foreach ( $our_partner_logos as $partner_logo ) :
                    $our_partner_logos_attached_images = get_media_url( $partner_logo['partner_logo_image'],'footer-logo');
                    ?>
                    <div class="swiper-slide h-auto py-6">
                        <div class="swiper-box f-center h-100 bg-white">
                            <?php
                            if(!empty($our_partner_logos_attached_images)):
                                ?>
                                <img class="o-contain mw-100" src="<?php echo $our_partner_logos_attached_images; ?>" alt="Certificate Logo">
                            <?php endif; ?>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>