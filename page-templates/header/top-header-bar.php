<?php
?>
<div class="nav-top d-flex align-items-center space-between">

         <?php
             $site_logo =  carbon_get_theme_option( 'site_logo');
             $site_logo_mobile =  carbon_get_theme_option( 'site_logo_mobile');

         $site_logo_attached = get_media_url($site_logo,'full');
         $site_logo_mobile_attached = get_media_url($site_logo_mobile,'full');

                    if(!empty($site_logo)):
                        ?>
                        <a class="navbar-brand" href="<?php echo get_site_url(); ?>">
                            <picture>
                                <source media="(min-width:768px)" srcset="<?php echo $site_logo_attached; ?>" alt="Mobile Logo">
                                <img class="img-fluid" src="<?php echo $site_logo_mobile_attached; ?>" alt="Desktop Logo">
                            </picture>
                        </a>
                       <?php
                       endif;
                    ?>
    <ul class="list-unstyled list-inline d-flex align-items-center ms-auto custom-devider">
        <li>
            <div class="ms-auto socials-icons d-flex align-items-center">
                <?php
                    $social_links = array('facebook' => 'fa-facebook-f', 'twitter' => 'fa-twitter','linkedin' => 'fa-linkedin-in');
                        foreach ( $social_links as $type => $label ) {
                                // Get the url from the database
                                $url = carbon_get_theme_option( 'social_url_' . $type );
                                // Skip this service if no url has been entered for it
                                if ( empty( $url ) ) {
                                    continue;
                                }
                                // Output the social link
                                echo '<a href="' . esc_url( $url ) . '" target="_blank"><i class="fa-brands ' . esc_html( $label ) . ' cmn-icon fa-2x text-blue"></i></a>';
                            }
                            ?>
                        </div>
        </li>
        <?php  $email_address = carbon_get_theme_option( 'email');
        if(!empty($email_address)){
        ?>
        <li class="mail-wrapper">
            <a href="mailto:<?php echo $email_address; ?>"><i class="bi bi-envelope-fill cmn-icon"></i>
                <span class="d-none d-xl-inline-block">
                    <?php
                    echo $email_address;
                    ?>
                </span>
            </a>
        </li>
        <?php
        }
        $phone_number = carbon_get_theme_option( 'phone');
        if(!empty($phone_number)){
        ?>
        <li class="d-none d-xl-block">
            <a href="tel:<?php echo $phone_number ; ?>">
                <i class="fa-solid fa-phone cmn-icon"></i><span class="d-none d-xl-inline-block">
                    <?php
                    echo $phone_number;
                    ?>
                </span>
            </a>
        </li>
        <?php }
        $spanish_speaking_phone_number = carbon_get_theme_option( 'spanish-speaking-phone-number');
        if(!empty($spanish_speaking_phone_number)){
        ?>
        <li class="d-none d-xl-block">
            <a class="small-text-wrap" href="tel:<?php echo $spanish_speaking_phone_number ; ?>">
                <span class="d-none d-xl-inline-block">
                <?php
                    echo $spanish_speaking_phone_number;
                    ?>
                </span>
                <span class="small-text">
                     <?php
                     echo $spanish_text = carbon_get_theme_option( 'spanish-text');
                     ?>
                </span>
            </a>
        </li>
        <?php } ?>
    </ul>
    <button id="hamburger" class="navbar-toggler" type="button" data-bs-toggle="collapse"
                        data-bs-target="#mainNavbarContent" aria-controls="mainNavbarContent" aria-expanded="false"
                        aria-label="Toggle navigation">
        <div class="bars-wrap">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </div>
        <div class="ms-3"><?php echo __( 'Menu',THEME_TEXTDOMAIN  ); ?></div>
    </button>
</div>