<?php
get_header();

    $publish_date = get_the_date( 'M j, Y' );
    $categories = get_the_category();
    $separator = ', ';
    $output = '';

    $resources_page_banner_image = carbon_get_post_meta( get_the_ID(),'resources_page_banner_image');

    $resources_page_banner_image_attached_d = get_media_url($resources_page_banner_image,'page-banner-d');
    $resources_page_banner_image_attached_t = get_media_url($resources_page_banner_image,'page-banner-t');
    $resources_page_banner_image_attached_m = get_media_url($resources_page_banner_image,'page-banner-m');

    $cats = wp_get_post_categories( get_the_ID(), array( 'fields' => 'ids' ) );
    $category_id = $cats[0];
    $blog_default_hero_banner = carbon_get_term_meta($category_id,'post_category_default_hero_banner');
    $blog_default_hero_banner_attached_d = get_media_url($blog_default_hero_banner,'page-banner-d');
    $blog_default_hero_banner_attached_t = get_media_url($blog_default_hero_banner,'page-banner-t');
    $blog_default_hero_banner_attached_m = get_media_url($blog_default_hero_banner,'page-banner-m');

    $resources_page_video_placeholder = carbon_get_post_meta( get_the_ID(),'resources_page_video_placeholder');

    $attached_resources_page_video_placeholder_d = get_media_url($resources_page_video_placeholder,'page-banner-d');
    $attached_resources_page_video_placeholder_t = get_media_url($resources_page_video_placeholder,'page-banner-t');
    $attached_resources_page_video_placeholder_m = get_media_url($resources_page_video_placeholder,'page-banner-m');

    $resources_page_video_link = carbon_get_post_meta( get_the_ID(),'resources_video_link');
    $resources_page_video_link_file = carbon_get_post_meta( get_the_ID(),'resources_video_link_file');
    $resources_page_video_link_file = wp_get_attachment_url($resources_page_video_link_file);
    $resources_page_video_options = carbon_get_post_meta( get_the_ID(),'resources_video_options');
    $resources_page_uploaded_video_banner = carbon_get_post_meta( get_the_ID(),'resources_page_uploaded_video_banner');

    $type_of_resource = carbon_get_post_meta( get_the_ID(),'type_of_resource');

    $resources_podcast_audio_title = carbon_get_post_meta( get_the_ID(),'resources_podcast_audio_title');
    $resources_podcast_audio = carbon_get_post_meta( get_the_ID(),'resources_podcast_audio');
    $resources_podcast_audio_link_file = wp_get_attachment_url($resources_podcast_audio);

    $type_of_podcast = carbon_get_post_meta( get_the_ID(),'type_of_podcast');
    $resources_podcast_audio_url = carbon_get_post_meta( get_the_ID(),'resources_podcast_audio_url');

    ?>

    <main class="main-container">
        <!-- Banner Section -->
        <section class="hero-banner banner-sm f-center flex-column flex-md-row overlay-white pt-xl-5">
            <div class="zoom-out-effect">
                <?php
                    if ( ! empty( $categories ) ) {
                        foreach( $categories as $category ) {

                            if(!empty($resources_page_banner_image)){
                                ?>
                                <picture>
                                    <!-- Desktop -->
                                    <source media="(min-width: 1200px)" srcset="<?php echo $resources_page_banner_image_attached_d; ?>">
                                    <!-- Tab -->
                                    <source media="(min-width: 575px)" srcset="<?php echo $resources_page_banner_image_attached_t; ?>">
                                    <!-- Mobile -->
                                    <img src="<?php echo $resources_page_banner_image_attached_m; ?>" alt="Hero Banner Image">
                                </picture>
                                <?php
                            }
                            else{
                                ?>
                                <picture>
                                    <!-- Desktop -->
                                    <source media="(min-width: 1200px)" srcset="<?php echo $blog_default_hero_banner_attached_d; ?>">
                                    <!-- Tab -->
                                    <source media="(min-width: 575px)" srcset="<?php echo $blog_default_hero_banner_attached_t; ?>">
                                    <!-- Mobile -->
                                    <img src="<?php echo $blog_default_hero_banner_attached_m; ?>" alt="Default Banner Image">
                                </picture>
                                <?php
                            }
                        }
                        
                    }
                ?>
                
                <!-- <video autoplay loop>
                    <sources type="video/mp4" src="images/Screen Recording 2022-03-08 at 8.17.19 PM.mov">
                </video> -->
            </div>
            <div class="container-xl container h-100">
                <div class="content-wrap text-center text-xl-start">
                <h1 class="cmn-heading border-left">
                    <?php echo single_post_title(); ?>
                </h1>
                <p>by <?php echo get_the_author();?> | <?php echo $publish_date ?> | <?php

                    if ( ! empty( $categories ) ) {
                        foreach( $categories as $category ) {
                            $output .= '<a href="' . esc_url( get_category_link( $category->term_id ) ) . '" alt="' . esc_attr( sprintf( __( 'View all posts in %s', 'textdomain' ), $category->name ) ) . '">' . esc_html( $category->name ) . '</a>' . $separator;
                        }
                        echo trim( $output, $separator );
                    }

                    ?></p>
                </div>
        </div>
        </section>
    
    <?php
            if( $type_of_resource == 'podcast' ){
            ?>
                <section class="single-blog-wrap bg-white">
                    <div class="container-xl pt-8 pb-8">
                        <div class="single-blog-content">
                            <?php
                            if($type_of_podcast == 'embed'){
                                if(!empty($resources_podcast_audio_url)){
                                    ?>
                                        <iframe style="border-radius:12px" src="<?php echo $resources_podcast_audio_url; ?>" width="100%" height="232" frameBorder="0" allowfullscreen="" allow="autoplay; clipboard-write; encrypted-media; fullscreen; picture-in-picture"></iframe>
                                        <br><br>
                                    <?php
                                }
                            }
                            else{
                                if(!empty($resources_podcast_audio_link_file)){
                                    ?>
                                    <div class="">
                                        <figure>
                                        <figcaption><?php echo $resources_podcast_audio_title; ?></figcaption>
                                        <audio controls src="<?php echo $resources_podcast_audio_link_file; ?>"><?php esc_html_e( ' Your browser does not support the', THEME_TEXTDOMAIN) ?><code><?php esc_html_e( 'audio', THEME_TEXTDOMAIN) ?></code><?php esc_html_e( ' element.', THEME_TEXTDOMAIN) ?></audio>
                                        </figure>
                                    </div>
                                    <br><br>
                                    <?php 
                                    }
                            }
                            the_content();
                            ?>
            <?php    
            }
            else{
            ?>

            <section class="single-blog-wrap bg-white">
                <div class="container-xl pt-8 pb-8">
                    <div class="single-blog-content">
                    <?php 
                    if(!empty($resources_page_video_placeholder)){
                        ?>
                            <div class="cmn-radius-box play-btn-box play-btn-wrap mb-5 no-shadow">
                                <picture>
                                    <!-- Desktop -->
                                    <source class="w-100 h-100 o-cover" media="(min-width: 1200px)" srcset="<?php echo $$attached_resources_page_video_placeholder_d; ?>">
                                    <!-- Tab -->
                                    <source class="w-100 h-100 o-cover" media="(min-width: 575px)" srcset="<?php echo $$attached_resources_page_video_placeholder_t; ?>">
                                    <!-- Mobile -->
                                    <img class="w-100 h-100 o-cover" src="<?php echo $$attached_resources_page_video_placeholder_m; ?>" alt="">
                                </picture>
                                <!-- Button trigger modal -->

                            <?php
                            if($resources_page_video_options == 'youtube'){
                                if (! empty($resources_page_video_link)){
                                ?>
                        <div class="cmn-play-wrap f-center">
                                <button type="button" class="btn cmn-play" type_video="youtube" video_link="<?php echo $resources_page_video_link; ?>" data-bs-toggle="modal"
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
                            }
                            else {
                                if (! empty($resources_page_video_link_file)){
                                ?>
                            <div class="cmn-play-wrap f-center">
                                <button type="button" class="btn cmn-play" type_video="uploaded" video_poster="<?php echo $attached_resources_page_uploaded_video_banner; ?>" video_link="<?php echo $resources_page_video_link_file; ?>" data-bs-toggle="modal"
                                        data-bs-target="#Modalupload">
                                    <div class="cmn-play-btn">
                                        <i class="fa-solid fa-play"></i>
                                    </div>
                                </button>
                                <div class="video-tag-uploaded">
                                    <source class="upload_video_src" src="<?php echo $resources_page_video_link_file; ?>" type="video/mp4">
                                    <source class="upload_video_src" src="<?php echo $resources_page_video_link_file; ?>" type="video/ogg">
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
                        <?php
                    }
                    ?>
                    
            <?php
            the_content();
            }
            $category_detail = get_the_category(get_the_ID());
            foreach(array_reverse($category_detail) as $category){
                $tab_id = $category->slug;
                $tab_name = $category->name;
            }
    ?>

    <a class="mt-4 cmn-link blog-back-btn d-inline-flex" href="<?php echo get_permalink( get_option( 'page_for_posts' ) ); ?><?php esc_html_e( '#', THEME_TEXTDOMAIN) ?><?php echo $tab_id ?>"><i class="fa-solid fa-angle-left"></i><?php esc_html_e( 'Back to ', THEME_TEXTDOMAIN) ?><?php echo strtolower($tab_name); ?></a>
    </div>
    </div>
    <div class="main-aside"> 
        <aside>
            <!-- Categories Goes Here -->
            <?php
            if( is_active_sidebar( 'blog-sidebar' )):
                dynamic_sidebar('blog-sidebar');
            endif;
            ?>
        </aside>
    </div>
        </section>
</main>
<?php get_footer() ?>