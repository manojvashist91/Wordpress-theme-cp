<?php get_header('404') ?>
<main class="main-container">
    <div class="no-page-found-header d-flex justify-content-center py-5">
    <a href="<?php echo get_site_url(); ?>">
        <img src="<?php echo get_bloginfo('stylesheet_directory') ?>/assets/theme/img/CapitalplusLogo.svg" alt="404 Logo">
    </a>
    </div>
    <div class="no-page-found-section" >
        <div class="info-not-found">
            <div class="img-404">
                <img src="<?php echo get_bloginfo('stylesheet_directory') ?>/assets/theme/img/404-background.svg" alt="404">
            </div>
            <div class="conetnt-box">
               <h2 class="cmn-heading border-left"><?php esc_html_e( 'Page not found', THEME_TEXTDOMAIN) ?></h2>
                <p><?php esc_html_e( 'It seems that this page does not exist! Please go back to the main page.', THEME_TEXTDOMAIN) ?></p>
                <a class="btn bg-green cmn-btn" href="<?php echo get_bloginfo('url') ?>"><?php esc_html_e( 'Go Home', THEME_TEXTDOMAIN) ?></a>
            </div>
        </div>
    </div>
</main>
<?php get_footer('404') ?>

