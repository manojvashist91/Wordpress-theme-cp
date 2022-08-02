<?php
get_header();
?>
<main class="main-conainer">
    <section class="container-xl custom-tabs resources-tabs pt-8 pb-8" id="myTab" role="tablist">
        <div class="text-center">
            <h2 class="h1 cmn-heading mb-0"><strong><?php echo single_post_title( ); ?></strong></h2>
        </div>
                <div class="cmn-navigation-wrap mt-6">
                    <div class="swiper resources-nav-tabs pt-2">
                        <div class="swiper-wrapper flex-nowrap nav align-items-center" id="nav-tab" role="tablist">
                                    <?php
                                    $categories = get_categories( array(
                                        'orderby' => 'id',
                                        'order'   => 'DESC'
                                    ) );
                                    $i= 0;
                                    $numberOfCategories =  count($categories);
                                    foreach( $categories as $category ) { ?>
                            <div class="swiper-slide">
                                <div class="btn cmn-btn bg-grey space-normal h-auto shadow-none nav-link min-width-initial"
                                        id="nav-profile-tab-<?php echo $category->slug; ?>" data-bs-toggle="tab" data-bs-target="#nav-profile-<?php echo $category->slug; ?>"
                                        role="tab" aria-controls="nav-profile-<?php echo $category->slug; ?>" aria-selected="false"><?php echo $category->name; ?></div>
                            </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
                <div class="tab-content-wrap border-0 mt-0">
                    <div class="tab-content position-relative" class="tab-content" id="nav-tabContent">

                    <div class="tab-pane fade show active " id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                    <div class="row wrappingall">

            <?php 

            // query_posts( array ( 'posts_per_page' => -1 ));
            // $my_post_count = $wp_query->post_count;
            $my_post_count = get_category($category->term_id)->category_count;
            // wp_reset_query();

            $args = array(
                'posts_per_page' => 8,
                'paged' => $paged,
                'order' => 'DESC',
            );
            $allpost = new WP_Query($args);

            while($allpost->have_posts(  )): $allpost->the_post(  ); 

                $cat = get_the_category( $post->id );
                foreach($cat as $category){
                    $category_name = $category->slug;
                };
                // General Blog
                if($category_name == 'blog'){
                    if ( has_post_thumbnail() ) {
                        $featured_image = get_the_post_thumbnail_url(get_the_ID(),'full'); 
                    }	
                    $post_date = get_the_date('M j, Y' );
                    $resource_card_design = carbon_get_post_meta( get_the_ID(),'resource_card_design');
                    $resources_post_title = isset( $post->post_title ) ? $post->post_title : '';
                    $resources_post_author = get_the_author();
                    $resources_page_exerpt = ( $post->post_excerpt ) ? $post->post_excerpt : wp_trim_excerpt();
                    $post_id = get_post( $id );
                ?>
                <?php
                    if($resource_card_design == 'bg-yes'){
                    ?>
                    <div class="col-lg-6">
                    <div class="radius-20-box h-100 overlay-blue overflow-hidden">
                        <img class="position-absolute" src="<?php echo $featured_image ?>" alt="">
                        <div
                            class="h-100 d-flex content-wrap text-white flex-column align-items-initial position-relative">
                            <h3><?php esc_html_e( 'General ', THEME_TEXTDOMAIN) ?><?php echo $category->name; ?></h3>
                            <a class="h2 mb-4" href="<?php the_permalink($post_id, THEME_TEXTDOMAIN); ?>"><?php echo $resources_post_title; ?></a>
                            <p><?php echo $resources_page_exerpt; ?></p>
                            <div class="mt-auto d-flex  flex-sm-row flex-column align-items-sm-center align-items-start justify-content-between">
                                <div class="text-small"><?php esc_html_e( 'by ', THEME_TEXTDOMAIN) ?><?php echo $resources_post_author; ?> | <?php echo $post_date; ?></div>
                                <a class="btn bg-green cmn-btn" href="<?php the_permalink($post_id, THEME_TEXTDOMAIN); ?>"><?php esc_html_e( 'Read More', THEME_TEXTDOMAIN) ?></a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php }
                    else{
                    ?>
                    <div class="col-lg-6">
                    <div class="radius-20-box h-100 bg-white overflow-hidden">
                        <div
                            class="h-100 d-flex content-wrap flex-column align-items-initial position-relative">
                            <h3><?php esc_html_e( 'General ', THEME_TEXTDOMAIN) ?><?php echo $category->name; ?></h3>
                            <a class="h2 mb-4" href="<?php the_permalink($post_id, THEME_TEXTDOMAIN); ?>"><?php echo $resources_post_title; ?></a>
                            <p><?php echo $resources_page_exerpt; ?></p>
                            <div class="mt-auto d-flex  flex-sm-row flex-column align-items-sm-center align-items-start justify-content-between">
                                <div class="text-small"><?php esc_html_e( 'by ', THEME_TEXTDOMAIN) ?><?php echo $resources_post_author; ?> | <?php echo $post_date; ?></div>
                                <a class="btn bg-green cmn-btn" href="<?php the_permalink($post_id, THEME_TEXTDOMAIN); ?>"><?php esc_html_e( 'Read More', THEME_TEXTDOMAIN) ?></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                    }
                    //$post_number++;
                }
                else if($category_name == 'news' || $category_name == 'press-releases'){
                    if ( has_post_thumbnail() ) {
                        $featured_image = get_the_post_thumbnail_url(get_the_ID(),'full');
                    }
                    $post_date = get_the_date('M j, Y' );
                    $resource_card_design = carbon_get_post_meta( get_the_ID(),'resource_card_design');
                    $resources_post_title = isset( $post->post_title ) ? $post->post_title : '';
                    $resources_post_author = get_the_author();
                    $resources_page_exerpt = ( $post->post_excerpt ) ? $post->post_excerpt : wp_trim_excerpt();
                    $post_id = get_post( $id );
                    ?>
                    <?php
                    if($resource_card_design == 'bg-yes'){
                    ?>
                    <div class="col-lg-6">
                    <div class="radius-20-box h-100 overlay-blue overflow-hidden">
                        <img class="position-absolute" src="<?php echo $featured_image ?>" alt="">
                        <div
                            class="h-100 d-flex content-wrap text-white flex-column align-items-initial position-relative">
                            <h3><?php echo $category->name; ?></h3>
                            <a class="h2 mb-4" href="<?php the_permalink($post_id, THEME_TEXTDOMAIN); ?>"><?php echo $resources_post_title; ?></a>
                            <p><?php echo $resources_page_exerpt; ?></p>
                            <div class="mt-auto d-flex  flex-sm-row flex-column align-items-sm-center align-items-start justify-content-between">
                                <div class="text-small"><?php esc_html_e( 'by ', THEME_TEXTDOMAIN) ?><?php echo $resources_post_author; ?> | <?php echo $post_date; ?></div>
                                <a class="btn bg-green cmn-btn" href="<?php the_permalink($post_id, THEME_TEXTDOMAIN); ?>"><?php esc_html_e( 'Read More', THEME_TEXTDOMAIN) ?></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php }
                    else{
                    ?>
                    <div class="col-lg-6">
                        <div class="radius-20-box h-100 bg-white overflow-hidden">
                            <div
                                class="h-100 d-flex content-wrap flex-column align-items-initial position-relative">
                                <h3><?php echo $category->name; ?></h3>
                                <a class="h2 mb-4" href="<?php the_permalink($post_id, THEME_TEXTDOMAIN); ?>"><?php echo $resources_post_title; ?></a>
                                <p><?php echo $resources_page_exerpt; ?></p>
                                <div class="mt-auto d-flex  flex-sm-row flex-column align-items-sm-center align-items-start justify-content-between">
                                    <div class="text-small"><?php esc_html_e( 'by ', THEME_TEXTDOMAIN) ?><?php echo $resources_post_author; ?> | <?php echo $post_date; ?></div>
                                    <a class="btn bg-green cmn-btn" href="<?php the_permalink($post_id, THEME_TEXTDOMAIN); ?>"><?php esc_html_e( 'Read More', THEME_TEXTDOMAIN) ?></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                    }
                    //$post_number++;
                }
                else if($category_name == 'podcasts'){
                    if ( has_post_thumbnail() ) {
                        $featured_image = get_the_post_thumbnail_url(get_the_ID(),'full'); 
                    }
                    $resources_post_title = isset( $post->post_title ) ? $post->post_title : '';
                    $post_id = get_post( $id );
                ?>
                <div class="col-xxl-3 col-xl-4 col-sm-6 column-small">
                    <div class="radius-20-box h-100 bg-white">
                        <div class="align-items-initial content-wrap d-flex flex-column h-100">
                            <div class="img-wrap-sm">
                                <img class="o-cover h-100 w-100" src="<?php echo $featured_image; ?>" alt="">
                            </div>
                            <div class="text-small"><?php echo $category->name; ?></div>
                            <a class="h3" href="<?php the_permalink($post_id, THEME_TEXTDOMAIN); ?>">
                            <?php echo $resources_post_title; ?></a>
                            <div class="mt-auto text-center text-xl-start">
                                <a class="btn bg-green cmn-btn mx-auto" href="<?php the_permalink($post_id, THEME_TEXTDOMAIN); ?>"><?php esc_html_e( 'Listen Podcast', THEME_TEXTDOMAIN) ?></a>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                };
            ?>  
            <?php 
            endwhile;
            $max_pages = ceil($my_post_count / 8);
            if($max_page == '1'){
                $max_page ++; 
            }
            ?>
            </div>
            <?php 
            if($my_post_count > 8){
            ?>
            <button limit="8" page="1" category="all" maxpages="<?php echo $max_pages; ?>" class="btn bg-blue cmn-btn curve-left load-more mt-5 load_all_posts"><?php esc_html_e( 'Load More', THEME_TEXTDOMAIN) ?></button>
            <?php
            }
            ?>
        </div>


                <?php
                $categories = get_categories( array(
                    'orderby' => 'name',
                    'order'   => 'ASC'
                ) );
                $i= 0;
                $numberOfCategories =  count($categories);
                foreach( $categories as $category ) {
                   

                    $paged = ( get_query_var('page') ) ? get_query_var('page') : 1;
                            
                    // query_posts( array ( 'category_name' => $category->slug , 'posts_per_page' => -1 ));
                    // $my_post_count = $wp_query->post_count;
                    $my_post_count = get_category($category->term_id)->category_count;
                    // wp_reset_query();

                    $args = array(
                        'posts_per_page' => 8,
                        'category_name' => $category->slug,
                        'paged' => $paged,
                        'order' => 'DESC',
                 );
                        ?>
                <div class="tab-pane fade  " id="nav-profile-<?php echo $category->slug; ?>" role="tabpanel" aria-labelledby="nav-profile-tab-<?php echo $category->slug; ?>">
                    <div class="row wrapping">
                        <?php

                        $posts = get_posts( $args );

                        if($category->slug == 'news' || $category->slug == 'press-releases'):
                        foreach( $posts as $post ): setup_postdata($post);
                        if ( has_post_thumbnail() ) {
                            $featured_image = get_the_post_thumbnail_url(get_the_ID(),'full'); 
                        }	
                        $post_date = get_the_date('M j, Y' );
                        $resource_card_design = carbon_get_post_meta( get_the_ID(),'resource_card_design');
                        $resources_post_title = isset( $post->post_title ) ? $post->post_title : '';
                        $resources_post_author = get_the_author();
                        $resources_page_exerpt = ( $post->post_excerpt ) ? $post->post_excerpt : wp_trim_excerpt();
                        $post_id = get_post( $id );
                        ?>
                        <?php
                        if($resource_card_design == 'bg-yes'){
                        ?>
                        <div class="col-lg-6">
                        <div class="radius-20-box h-100 overlay-blue overflow-hidden">
                            <img class="position-absolute" src="<?php echo $featured_image ?>" alt="">
                            <div
                                class="h-100 d-flex content-wrap text-white flex-column align-items-initial position-relative">
                                <h3><?php echo $category->name; ?></h3>
                                <a class="h2 mb-4" href="<?php the_permalink($post_id, THEME_TEXTDOMAIN); ?>"><?php echo $resources_post_title; ?></a>
                                <p><?php echo $resources_page_exerpt; ?></p>
                                <div class="mt-auto d-flex  flex-sm-row flex-column align-items-sm-center align-items-start justify-content-between">
                                    <div class="text-small"><?php esc_html_e( 'by ', THEME_TEXTDOMAIN) ?><?php echo $resources_post_author; ?> | <?php echo $post_date; ?></div>
                                    <a class="btn bg-green cmn-btn" href="<?php the_permalink($post_id, THEME_TEXTDOMAIN); ?>"><?php esc_html_e( 'Read More', THEME_TEXTDOMAIN) ?></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php }
                        else{
                        ?>
                        <div class="col-lg-6">
                            <div class="radius-20-box h-100 bg-white overflow-hidden">
                                <div
                                    class="h-100 d-flex content-wrap flex-column align-items-initial position-relative">
                                    <h3><?php echo $category->name; ?></h3>
                                    <a class="h2 mb-4" href="<?php the_permalink($post_id, THEME_TEXTDOMAIN); ?>"><?php echo $resources_post_title; ?></a>
                                    <p><?php echo $resources_page_exerpt; ?></p>
                                    <div class="mt-auto d-flex  flex-sm-row flex-column align-items-sm-center align-items-start justify-content-between">
                                        <div class="text-small"><?php esc_html_e( 'by ', THEME_TEXTDOMAIN) ?><?php echo $resources_post_author; ?> | <?php echo $post_date; ?></div>
                                        <a class="btn bg-green cmn-btn" href="<?php the_permalink($post_id, THEME_TEXTDOMAIN); ?>"><?php esc_html_e( 'Read More', THEME_TEXTDOMAIN) ?></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                        }
                        //$post_number++; 
                        endforeach;
                        endif;
                        
                        if($category->slug == 'blog'):
                        foreach( $posts as $post ): setup_postdata($post);
                        if ( has_post_thumbnail() ) {
                            $featured_image = get_the_post_thumbnail_url(get_the_ID(),'full'); 
                        }	
                        $post_date = get_the_date('M j, Y' );
                        $resource_card_design = carbon_get_post_meta( get_the_ID(),'resource_card_design');
                        $resources_post_title = isset( $post->post_title ) ? $post->post_title : '';
                        $resources_post_author = get_the_author();
                        $resources_page_exerpt = ( $post->post_excerpt ) ? $post->post_excerpt : wp_trim_excerpt();
                        $post_id = get_post( $id );
                        ?>
                        <?php
                        if($resource_card_design == 'bg-yes'){
                        ?>
                        <div class="col-lg-6">
                        <div class="radius-20-box h-100 overlay-blue overflow-hidden">
                            <img class="position-absolute" src="<?php echo $featured_image ?>" alt="">
                            <div
                                class="h-100 d-flex content-wrap text-white flex-column align-items-initial position-relative">
                                <h3><?php esc_html_e( 'General ', THEME_TEXTDOMAIN) ?><?php echo $category->name; ?></h3>
                                <a class="h2 mb-4" href="<?php the_permalink($post_id, THEME_TEXTDOMAIN); ?>"><?php echo $resources_post_title; ?></a>
                                <p><?php echo $resources_page_exerpt; ?></p>
                                <div class="mt-auto d-flex  flex-sm-row flex-column align-items-sm-center align-items-start justify-content-between">
                                    <div class="text-small"><?php esc_html_e( 'by ', THEME_TEXTDOMAIN) ?><?php echo $resources_post_author; ?> | <?php echo $post_date; ?></div>
                                    <a class="btn bg-green cmn-btn" href="<?php the_permalink($post_id, THEME_TEXTDOMAIN); ?>"><?php esc_html_e( 'Read More', THEME_TEXTDOMAIN) ?></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php }
                        else{
                        ?>
                        <div class="col-lg-6">
                        <div class="radius-20-box h-100 bg-white overflow-hidden">
                            <div
                                class="h-100 d-flex content-wrap flex-column align-items-initial position-relative">
                                <h3><?php esc_html_e( 'General ', THEME_TEXTDOMAIN) ?><?php echo $category->name; ?></h3>
                                <a class="h2 mb-4" href="<?php the_permalink($post_id, THEME_TEXTDOMAIN); ?>"><?php echo $resources_post_title; ?></a>
                                <p><?php echo $resources_page_exerpt; ?></p>
                                <div class="mt-auto d-flex  flex-sm-row flex-column align-items-sm-center align-items-start justify-content-between">
                                    <div class="text-small"><?php esc_html_e( 'by ', THEME_TEXTDOMAIN) ?><?php echo $resources_post_author; ?> | <?php echo $post_date; ?></div>
                                    <a class="btn bg-green cmn-btn" href="<?php the_permalink($post_id, THEME_TEXTDOMAIN); ?>"><?php esc_html_e( 'Read More', THEME_TEXTDOMAIN) ?></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                        }
                        //$post_number++;
                        endforeach;
                        endif;
                        ?>

                        <?php if($category->slug == 'podcasts'):
                            $posts = get_posts( $args );
                            foreach( $posts as $post ): setup_postdata($post);
                            if ( has_post_thumbnail() ) {
                                $featured_image = get_the_post_thumbnail_url(get_the_ID(),'full'); 
                            }
                            $resources_post_title = isset( $post->post_title ) ? $post->post_title : '';
                            $post_id = get_post( $id );
                            ?>
                        <div class="col-xxl-3 col-xl-4 col-sm-6 column-small">
                            <div class="radius-20-box h-100 bg-white">
                                <div class="align-items-initial content-wrap d-flex flex-column h-100">
                                    <div class="img-wrap-sm">
                                        <img class="o-cover h-100 w-100" src="<?php echo $featured_image; ?>" alt="">
                                    </div>
                                    <div class="text-small"><?php echo $category->name; ?></div>
                                    <a class="h3" href="<?php the_permalink($post_id, THEME_TEXTDOMAIN); ?>">
                                            <?php echo $resources_post_title; ?>
                                        </a>
                                    <div class="mt-auto text-center text-xl-start">
                                        <a class="btn bg-green cmn-btn mx-auto" href="<?php the_permalink($post_id, THEME_TEXTDOMAIN); ?>"><?php esc_html_e( 'Listen Podcast', THEME_TEXTDOMAIN) ?></a>
                                    </div>
                                </div>
                            </div>    
                        </div>
                        <?php
                         endforeach;
                         endif ;
                        $max_page = ceil($my_post_count / 8);
                        if($max_page == '1'){
                            $max_page ++;
                        }
                        ?>
                    </div>
                    <?php 
                    if($my_post_count > 8){
                    ?>
                    <button limit="8" page="1" category="<?php echo $category->slug ?>" maxpage="<?php echo $max_page; ?>" class="btn bg-blue cmn-btn curve-left load-more mt-5 load_more_posts"><?php esc_html_e( 'Load More', THEME_TEXTDOMAIN) ?></button>
                    <?php
                    }
                    ?>
                </div>
                <?php
                }
                ?>

            </div>
        </div>
    </section>
</main>
<?php get_footer(); ?>