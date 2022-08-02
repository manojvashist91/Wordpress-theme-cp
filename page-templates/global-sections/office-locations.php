<?php
$office_locations =  carbon_get_theme_option( 'office_locations');

?>

<section class="location-sec container-fluid px-0 cmn-icon-sec bg-white mt-8">
    <div class="row gx-0 cmn-border-bottom">
        <div class="col-xl-7 order-2 order-xl-1 pb-6 pt-xl-6">
            <div class="map-sec h-100 mh-100">
                <!-- Map Code Here-->
                <div id="map" style="width:100%; height:100%"></div>
            </div>
        </div>
        <div class="col-xl-5 order-1 order-xl-2 location-content">
            <div class="grid-item pt-8 pb-5 text-center text-xl-start">
                <h2 class="cmn-heading border-left h1 mb-0">
                   <?php  echo __( 'Office',THEME_TEXTDOMAIN  ); ?> <br /><strong><?php   echo __( 'Locations',THEME_TEXTDOMAIN  ); ?></strong>
                </h2>
            </div>
            <div class="grid-item text-center text-md-start">
                <?php
            foreach ($office_locations as $office_location):
            ?>
                <div class="address-wrap">
                    <h3 class="h4 text-blue"><?php echo esc_html($office_location['address_heading_theme_options'] ); ?>
                    </h3>
                    <ul class="list-unstyled">
                        <?php if(!empty($office_location['contact_us_address_theme_options'])): ?>
                            <li><a class="h5" target="_blank"
                                href="https://www.google.com/maps/place/<?php echo esc_html( $office_location['google_map_locations_theme_options']['address'] ); ?>/@'<?php echo esc_html( $office_location['google_map_locations_theme_options']['value'] ); ?>,<?php echo esc_html( $office_location['google_map_locations_theme_options']['zoom'] ); ?>z"><i
                                    class="fa-solid fa-location-dot cmn-icon"></i><span class="d-inline-block"><?php echo esc_html( $office_location['contact_us_address_theme_options'] ); ?></span>
                            </a></li>
                        <?php endif;
                        if(!empty($office_location['contact_us_contact_number_theme_options'])):
                        ?>
                            <li><a class="h5"
                                    href="tel:<?php echo esc_html( $office_location['contact_us_contact_number_theme_options'] ); ?>"><i
                                        class="fa-solid fa-phone cmn-icon"></i><span class="d-inline-block"><?php echo esc_html( $office_location['contact_us_contact_number_theme_options'] ); ?></span>
                                </a>
                            </li>
                        <?php endif;
                        if(!empty($office_location['contact_us_fax_number_theme_options'])):
                            ?>
                            <li><a class="h5"
                                    href="fax:<?php echo esc_html( $office_location['contact_us_fax_number_theme_options'] ); ?>"><i
                                        class="fa-solid fa-fax cmn-icon"></i><span class="d-inline-block"><?php echo esc_html( $office_location['contact_us_fax_number_theme_options'] ); ?></span>
                                </a>
                            </li>
                        <?php endif;
                        if(!empty($office_location['contact_us_email_theme_options'])):
                            ?>
                            <li><a class="h5"
                                    href="mailto:<?php echo esc_html( $office_location['contact_us_email_theme_options'] ); ?>"><i
                                        class="bi bi-envelope-fill cmn-icon"></i><span class="d-inline-block"><?php echo esc_html( $office_location['contact_us_email_theme_options'] ); ?></span>
                                </a>
                            </li>
                        <?php endif; ?>
                    </ul>
                </div>
                <?php endforeach; ?>
            </div>
            <div class="grid-item place-items-center d-sm-grid text-center text-lg-start">
                <ul class="py-4 py-xl-0 mb-0 list-unstyled socials-icons">
                    <?php
                    $social_links = array('facebook' => 'fa-facebook-f', 'twitter' => 'fa-twitter','linkedin' => 'fa-linkedin-in');
                    foreach ( $social_links as $type => $label ) {
                        // Get the url from the database
                        $url = carbon_get_theme_option( 'social_url_' . $type );
                        // Skip this service if no url has been entered for it
                        if ( empty( $url ) ) {
                            continue;
                        }
                        ?>
                        <li>
                            <a href="<?php echo esc_url($url); ?>" target="_blank">
                                <i  class="fa-brands <?php echo esc_html( $label ); ?> cmn-icon fa-2x me-0">
                                </i>
                            </a>
                        </li>
                        <?php
                    }
                    ?>
                </ul>
            </div>
        </div>
    </div>
</section>