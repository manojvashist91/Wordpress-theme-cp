<footer class="main-footer bg-dark-blue">
    <div class="container-xxl container">
        <div class="row text-center text-sm-start">
            <div class="col-xl-3 order-4 order-xl-1 pe-xl-5">
                <?php  dynamic_sidebar('footer-section-1'); ?>
                <ul class="list-inline socials-icons d-none d-sm-block">
                    <?php
                        $social_links = array('facebook' => 'fa-facebook-f', 'twitter' => 'fa-twitter', 'linkedin' => 'fa-linkedin-in');
                        foreach ( $social_links as $type => $label ) {
                            // Get the url from the database
                            $url = carbon_get_theme_option( 'social_url_' . $type );
                            // Skip this service if no url has been entered for it
                            if ( empty( $url ) ) {
                                continue;
                            }
                            // Output the social link
                            echo '<li><a href="' . esc_url( $url ) . '" target="_blank"><i class="fa-brands ' . esc_html( $label ) . ' cmn-icon fa-2x"></i></a></li>';
                        }
                     ?>
                </ul>
            </div>
            <div class="col-xl-2 col-sm-6 order-2 ">
                <?php  dynamic_sidebar('footer-section-2'); ?>
            </div>
            <div class="col-xl-3 col-sm-6 order-3 ps-xl-4 ">
                <?php  dynamic_sidebar('footer-section-3'); ?>
            </div>
            <div class="col-xl-4 order-1 order-xl-4 ps-xl-5 ">
                <?php  dynamic_sidebar('footer-section-4'); ?>
            </div>
        </div>

        <div class="row gx-0 footer-bottom pt-sm-4 py-xl-2">
            <div class="col-xl-4 mb-3 mb-xl-0 d-flex align-items-center justify-content-center justify-content-xl-start order-2 order-xl-1">
                <?php


                $menuLocations = get_nav_menu_locations();
                $menuID = $menuLocations['copyright_menu'];
                $get_copyright_main_items = wp_get_nav_menu_items($menuID);
                
                foreach ($get_copyright_main_items as $get_copyright_main_item):
                    $menu_url = $get_copyright_main_item->url;
                    $title = $get_copyright_main_item->title;
                    ?>
                    <a href="<?php echo $menu_url ?>"><?php echo $title; ?></a>
                <?php endforeach; ?>
            </div>
            <div class="col-xl-4 mb-3 mb-xl-0 d-flex align-items-center justify-content-center order-3 order-xl-2">
                <p> <?php echo date("Y"); ?> &copy;
                    <?php echo get_bloginfo( 'name' ); ?>
                </p>
            </div>
            <div
                class="col-xl-4 mb-3 mb-xl-0 d-flex align-items-center justify-content-center justify-content-xl-end order-1 order-xl-3">
                <p><?php esc_html_e( ' Design & Marketed by ', THEME_TEXTDOMAIN) ?><a href="https://harbingermarketing.com/" target="_blank">
                        <img class="ms-1"
                            src="<?php echo get_template_directory_uri(); ?>/assets/branding/img/harbinger-logo-1.svg"
                            alt="Site Logo"></a>
                </p>
            </div>
        </div>
    </div>
</footer>
<!-- Common Modal -->
<!-- Modal -->
<div class="modal fade" id="Modal" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-container">
        <div class="modal-content">
            <div class="modal-header py-3 px-4">
                <button type="button" class="btn-close btn bg-green cmn-btn min-width-initial" data-bs-dismiss="modal"
                    aria-label="Close"><i class="fa-solid fa-xmark"></i></button>
            </div>
            <div class="modal-body p-0">
                <div class="ratio ratio-16x9 play-btn-wrap">
                    <div id=yt-player>
                        <div>
                            <div class="yt-loader"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="Modalupload" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-container">
        <div class="modal-content">
            <div class="modal-header py-3 px-4">
                <button type="button" class="btn-close btn bg-green cmn-btn min-width-initial"
                        data-bs-dismiss="modal" aria-label="Close"><i class="fa-solid fa-xmark"></i></button>
            </div>
            <div class="modal-body p-0">
                <div class="ratio ratio-16x9 play-btn-wrap">
                    <div id="video_tag_add">
                        <video loop  id="video_poster" poster="" controls autoplay>
                        </video>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php wp_footer() ?>
</body>
</html>