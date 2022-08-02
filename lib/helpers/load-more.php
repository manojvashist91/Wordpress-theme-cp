<?php
function load_more_scripts() {
    wp_enqueue_script('jquery');
    wp_register_script( 'loadmore_script', get_theme_file_uri().'/assets/theme/js/load-more.js', array('jquery') );
    wp_localize_script( 'loadmore_script', 'loadmore_params', array(
        'ajaxurl' => admin_url('admin-ajax.php'),
        'loading_text' => __( 'Loading...', THEME_TEXTDOMAIN ),
        'load_more_text' => __( 'Load More', THEME_TEXTDOMAIN )
    ) );
     wp_enqueue_script( 'loadmore_script' );
}

add_action( 'wp_enqueue_scripts','load_more_scripts' );

function loadmore_ajax_handler(){
    $category = isset($_POST['category']) ? $_POST['category']: '';
    $args['paged'] = $_POST['page'] + 1;
    $args['post_status'] = 'publish';
    $args['posts_per_page'] =  $_POST['limit'];
    $args['order'] = 'DESC';
    $args['category_name'] = $category;
    //$post_number = 0;
   ?>
    <!-- <div class="row appended"> -->
        <?php

        $posts = get_posts( $args );
        if($category == 'news' || $category == 'press-releases'):
            foreach( $posts as $post ): setup_postdata($post);
                $post_id = $post->ID;
                if ( has_post_thumbnail($post->ID) ) {
                    $featured_image = get_the_post_thumbnail_url($post_id,'full'); 
                }	
                $post_date = get_the_date('M j, Y' , $post_id);
                $resource_card_design = carbon_get_post_meta( $post_id,'resource_card_design');
                $resources_post_title = isset( $post->post_title ) ? $post->post_title : '';
                $resources_post_author = get_the_author();
                $resources_page_exerpt = ( $post->post_excerpt ) ? $post->post_excerpt : get_the_excerpt($post_id);
                if($resource_card_design == 'bg-yes'){
                    ?>
                    <div class="col-lg-6 appended">
                    <div class="radius-20-box h-100 overlay-blue overflow-hidden">
                        <img class="position-absolute" src="<?php echo $featured_image ?>" alt="">
                        <div
                            class="h-100 d-flex content-wrap text-white flex-column align-items-initial position-relative">
                            <h3><?php echo ucwords($category); ?></h3>
                            <a class="h2 mb-4" href="<?php the_permalink($post_id, THEME_TEXTDOMAIN); ?>"> <?php echo $resources_post_title; ?></a>
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
                    <div class="col-lg-6 appended">
                        <div class="radius-20-box h-100 bg-white overflow-hidden">
                            <div
                                class="h-100 d-flex content-wrap flex-column align-items-initial position-relative">
                                <h3><?php echo ucwords($category); ?></h3>
                                <a class="h2 mb-4" href="<?php the_permalink($post_id, THEME_TEXTDOMAIN); ?>"> <?php echo $resources_post_title; ?></a>
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
                ?>
            <?php endforeach;
        endif;

        if($category == 'blog'):
            foreach( $posts as $post ): setup_postdata($post);
                $post_id = $post->ID;
                if ( has_post_thumbnail($post->ID) ) {
                    $featured_image = get_the_post_thumbnail_url($post_id,'full'); 
                }	
                $post_date = get_the_date('M j, Y' , $post_id );
                $resource_card_design = carbon_get_post_meta( $post_id,'resource_card_design');
                $resources_post_title = isset( $post->post_title ) ? $post->post_title : '';
                $resources_post_author = get_the_author();
                $resources_page_exerpt = ( $post->post_excerpt ) ? $post->post_excerpt : get_the_excerpt($post_id);
                if($resource_card_design == 'bg-yes'){
                    ?>
                    <div class="col-lg-6 appended">
                    <div class="radius-20-box h-100 overlay-blue overflow-hidden">
                        <img class="position-absolute" src="<?php echo $featured_image ?>" alt="">
                        <div
                            class="h-100 d-flex content-wrap text-white flex-column align-items-initial position-relative">
                            <h3><?php esc_html_e( 'General  ', THEME_TEXTDOMAIN) ?><?php echo ucwords($category); ?></h3>
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
                    <div class="col-lg-6 appended">
                    <div class="radius-20-box h-100 bg-white overflow-hidden">
                        <div
                            class="h-100 d-flex content-wrap flex-column align-items-initial position-relative">
                            <h3><?php esc_html_e( 'General  ', THEME_TEXTDOMAIN) ?><?php echo ucwords($category); ?></h3>
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
                ?>
            <?php endforeach;
        endif;
        ?>

<?php if($category == 'podcasts'):
            $posts = get_posts( $args );
            foreach( $posts as $post ): setup_postdata($post);
            $post_id = $post->ID;
            if ( has_post_thumbnail($post->ID) ) {
                $featured_image = get_the_post_thumbnail_url( $post_id ,'full'); 
            }
            $resources_post_title = isset( $post->post_title ) ? $post->post_title : '';
                ?>
                <div class="col-xxl-3 col-xl-4 col-sm-6 column-small appended">
                            <div class="radius-20-box h-100 bg-white">
                                <div class="align-items-initial content-wrap d-flex flex-column h-100">
                                <div class="img-wrap-sm">
                                    <img class="o-cover h-100 w-100" src="<?php echo $featured_image ?>" alt="">
                                </div>
                                <div class="text-small"><?php echo ucwords($category); ?></div>
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
        ?>
    <!-- </div> -->
            <?php
    die();
        } ?>
<?php
add_action('wp_ajax_loadmore','loadmore_ajax_handler');
add_action('wp_ajax_nopriv_loadmore','loadmore_ajax_handler');

function loadall_ajax_handler(){
    $category = isset($_POST['category']) ? $_POST['category']: '';
    $args['paged'] = $_POST['page'] + 1;
    $args['post_status'] = 'publish';
    $args['posts_per_page'] =  $_POST['limit'];
    $args['order'] = 'DESC';
    $post = new WP_Query( $args );
    //$post_number = 0 ;
   ?>
    <!-- <div class="row appendedall"> -->
        <?php while($post->have_posts(  )): $post->the_post(  ); 
            
            $cat = get_the_category( $post->id );
            foreach($cat as $category){
                $category_name = $category->name;
            };
            // General Blog
            if($category_name == 'Blog'){

                if ( has_post_thumbnail() ) {
                    $featured_image = get_the_post_thumbnail_url(get_the_ID(),'full'); 
                }
                $resource_card_design = carbon_get_post_meta( get_the_ID(),'resource_card_design');
                $post_date = get_the_date('M j, Y' );
                $post_id = get_post( $id );
                if($resource_card_design == 'bg-yes'){
                ?>
                <div class="col-lg-6 appendedall">
                <div class="radius-20-box h-100 overlay-blue overflow-hidden">
                    <img class="position-absolute" src="<?php echo $featured_image ?>" alt="">
                    <div
                        class="h-100 d-flex content-wrap text-white flex-column align-items-initial position-relative">
                        <h3><?php esc_html_e( 'General ', THEME_TEXTDOMAIN) ?><?php echo $category->name; ?></h3>
                        <a class="h2 mb-4" href="<?php the_permalink($post_id, THEME_TEXTDOMAIN); ?>"> <?php the_title(); ?></a>
                        <p><?php !empty( the_excerpt() ) ? the_excerpt() : wp_trim_excerpt(); ?></p>
                        <div class="mt-auto d-flex  flex-sm-row flex-column align-items-sm-center align-items-start justify-content-between">
                        <div class="text-small"><?php esc_html_e( 'by ', THEME_TEXTDOMAIN) ?><?php echo get_the_author(); ?> | <?php echo $post_date; ?></div>
                        <a href="<?php the_permalink($post_id, THEME_TEXTDOMAIN); ?>"><button class="btn bg-green cmn-btn"><?php esc_html_e( 'Read More', THEME_TEXTDOMAIN) ?></button></a>
                            </div>
                        </div>
                    </div>
                </div>
                <?php }
                else{
                ?>
                <div class="col-lg-6 appendedall">
                    <div class="radius-20-box h-100 bg-white overflow-hidden">
                        <div
                            class="h-100 d-flex content-wrap flex-column align-items-initial position-relative">
                            <h3><?php esc_html_e( 'General ', THEME_TEXTDOMAIN) ?><?php echo $category->name; ?></h3>
                            <a class="h2 mb-4" href="<?php the_permalink($post_id, THEME_TEXTDOMAIN); ?>"> <?php the_title(); ?></a>
                            <p><?php !empty( the_excerpt() ) ? the_excerpt() : wp_trim_excerpt(); ?></p>
                            <div class="mt-auto d-flex  flex-sm-row flex-column align-items-sm-center align-items-start justify-content-between">
                            <div class="text-small"><?php esc_html_e( 'by ', THEME_TEXTDOMAIN) ?><?php echo get_the_author(); ?> | <?php echo $post_date; ?></div>
                            <a href="<?php the_permalink($post_id, THEME_TEXTDOMAIN); ?>"><button class="btn bg-green cmn-btn"><?php esc_html_e( 'Read More', THEME_TEXTDOMAIN) ?></button></a>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                }
                //$post_number++;
            }
            else if($category_name == 'News' || $category_name == 'Press Releases'){
                if ( has_post_thumbnail() ) {
                    $featured_image = get_the_post_thumbnail_url(get_the_ID(),'full');
                }
                $resource_card_design = carbon_get_post_meta( get_the_ID(),'resource_card_design');
                $post_date = get_the_date('M j, Y' );
                $post_id = get_post( $id );
                if($resource_card_design == 'bg-yes'){
                    ?>
                    <div class="col-lg-6 appendedall">
                    <div class="radius-20-box h-100 overlay-blue overflow-hidden">
                        <img class="position-absolute" src="<?php echo $featured_image ?>" alt="">
                        <div
                            class="h-100 d-flex content-wrap text-white flex-column align-items-initial position-relative">
                            <h3><?php echo $category->name; ?></h3>
                            <a class="h2 mb-4" href="<?php the_permalink($post_id, THEME_TEXTDOMAIN); ?>"> <?php the_title(); ?></a>
                            <p><?php !empty( the_excerpt() ) ? the_excerpt() : wp_trim_excerpt(); ?></p>
                            <div class="mt-auto d-flex  flex-sm-row flex-column align-items-sm-center align-items-start justify-content-between">
                                <div class="text-small"><?php esc_html_e( 'by ', THEME_TEXTDOMAIN) ?><?php echo get_the_author(); ?> | <?php echo $post_date; ?></div>
                                <a href="<?php the_permalink($post_id, THEME_TEXTDOMAIN); ?>"><button class="btn bg-green cmn-btn"><?php esc_html_e( 'Read More', THEME_TEXTDOMAIN) ?></button></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php }
                    else{
                    ?>
                    <div class="col-lg-6 appendedall">
                        <div class="radius-20-box h-100 bg-white overflow-hidden">
                            <div
                                class="h-100 d-flex content-wrap flex-column align-items-initial position-relative">
                                <h3><?php echo $category->name; ?></h3>
                            <a class="h2 mb-4" href="<?php the_permalink($post_id, THEME_TEXTDOMAIN); ?>"> <?php the_title(); ?></a>
                            <p><?php !empty( the_excerpt() ) ? the_excerpt() : wp_trim_excerpt(); ?></p>
                            <div class="mt-auto d-flex  flex-sm-row flex-column align-items-sm-center align-items-start justify-content-between">
                                <div class="text-small"><?php esc_html_e( 'by ', THEME_TEXTDOMAIN) ?><?php echo get_the_author(); ?> | <?php echo $post_date; ?></div>
                                <a href="<?php the_permalink($post_id, THEME_TEXTDOMAIN); ?>"><button class="btn bg-green cmn-btn"><?php esc_html_e( 'Read More', THEME_TEXTDOMAIN) ?></button></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                    }
                    //$post_number++; 

            }
            else if($category_name == 'Podcasts'){
                if ( has_post_thumbnail() ) {
                    $featured_image = get_the_post_thumbnail_url(get_the_ID(),'full'); 
                }
                $resources_post_title = isset( $post->post_title ) ? $post->post_title : '';
                $post_id = get_post( $id );
            ?>
            <div class="col-xxl-3 col-xl-4 col-sm-6 column-small appendedall">
                <div class="radius-20-box h-100 bg-white">
                    <div class="align-items-initial content-wrap d-flex flex-column h-100">
                        <div class="img-wrap-sm">
                            <img class="o-cover h-100 w-100" src="<?php echo $featured_image ?>" alt="">
                        </div>
                        <div class="text-small"><?php echo $category->name; ?></div>
                        <a class="h3" href="<?php the_permalink($post_id, THEME_TEXTDOMAIN); ?>">
                                <?php the_title(); ?>
                            </a>
                        <div class="mt-auto text-center text-xl-start">    
                            <a class="btn bg-green cmn-btn mx-auto" href="<?php the_permalink($post_id, THEME_TEXTDOMAIN); ?>"><?php esc_html_e( 'Listen Podcast', THEME_TEXTDOMAIN) ?></a>
                        </div>    
                    </div>
                </div>           
            </div>
        <?php
        };
        ?>  
        <?php endwhile; ?>
    <!-- </div> -->
            <?php
    die();
        } ?>
<?php
add_action('wp_ajax_loadall','loadall_ajax_handler');
add_action('wp_ajax_nopriv_loadall','loadall_ajax_handler');

// load more for search
add_action('wp_ajax_loadall_search','loadall_ajax_handler_search');
add_action('wp_ajax_nopriv_loadall_search','loadall_ajax_handler_search');

function loadall_ajax_handler_search(){
    $args['paged'] = $_POST['page'] + 1;
    $args['post_status'] = 'publish';
    $args['posts_per_page'] =  $_POST['limit'];
    $args['s'] =  $_POST['s'];
    $args['order'] = 'DESC';
    $args['post_type'] = array( 'post' );
    query_posts($args);
    // Start the Loop.
    // Start the Loop.
    while ( have_posts() ): the_post( );
        $post->ID = get_the_ID();
        $cat = get_the_category( $post->ID );
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
            $resources_post_title = get_the_title();
            //print_r($post);
            $resources_post_author = get_the_author();
            $resources_page_exerpt = ( $post->post_excerpt ) ? $post->post_excerpt : wp_trim_excerpt();
            $post_id = get_post( get_the_ID() );
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
            $resources_post_title = get_the_title();;
            $resources_post_author = get_the_author();
            $resources_page_exerpt = ( $post->post_excerpt ) ? $post->post_excerpt : wp_trim_excerpt();
            $post_id = get_post( get_the_ID() );
            ?>
            <?php
            if($resource_card_design == 'bg-yes'){
                ?>
                <div class="col-lg-6">
                    <div class="radius-20-box h-100 overlay-blue overflow-hidden">
                        <img class="position-absolute" src="<?php echo $featured_image ?>" alt="">
                        <div class="h-100 d-flex content-wrap text-white flex-column align-items-initial position-relative">
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
            $resources_post_title = get_the_title();
            $post_id = get_post( get_the_ID() );
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
    // End the loop.

    wp_reset_query();
    die();
}
