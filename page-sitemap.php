<?php
get_header();
$sitemap_banner_image =  carbon_get_post_meta( get_the_ID(),'privacy_policy_banner_image');
$attached_sitemap_banner_image_d = get_media_url($sitemap_banner_image,'page-banner-d');
$attached_sitemap_banner_image_t = get_media_url($sitemap_banner_image,'page-banner-t');
$attached_sitemap_banner_image_m = get_media_url($sitemap_banner_image,'page-banner-m');
?>
<main class="main-container">
    <section class="hero-banner banner-sm f-center flex-column flex-md-row overlay-white pt-xl-5">
    <div class="zoom-out-effect">
        <picture>
            <!-- Desktop -->
            <source media="(min-width: 1200px)" srcset="<?php echo $attached_sitemap_banner_image_d; ?>">
            <!-- Tab -->
            <source media="(min-width: 575px)" srcset="<?php echo $attached_sitemap_banner_image_t; ?>">
            <!-- Mobile -->
            <img src="<?php echo $attached_sitemap_banner_image_m; ?>" alt="Hero Banner Image">
        </picture>
    </div>
        <?php
        while(have_posts(  )): the_post(); ?>
            <section class="container-xl container h-100">
                <div class="content-wrap text-center text-xl-start">
                    <h1 class="cmn-heading border-left">
                        <?php the_title(); ?>
                    </h1>
                </div>
            </section>
        <?php endwhile;
        wp_reset_postdata( );
        ?>
    </section>
        <div class="container-xl container h-100">
    <?php
    $args = array(
        'container'            => 'div',
        'container_class'      => '',
        'container_id'         => '',
        'container_aria_label' => '',
        'menu_class'           => 'menu',
        'menu_id'              => '3',
        'echo'                 => true,
        'fallback_cb'          => 'wp_page_menu',
        'before'               => '',
        'after'                => '',
        'link_before'          => '',
        'link_after'           => '',
        'items_wrap'           => '<ul id="%1$s" class="%2$s">%3$s</ul>',
        'item_spacing'         => 'preserve',
        'depth'                => 5,
        'walker'               => '',
        'theme_location'       => 'primary',
    );
    wp_nav_menu( $args );

?>
    </div>
</main>
<?php
get_footer();