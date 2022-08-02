<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package WordPress
 * @subpackage
 * @since capital plus 1.0
 */

get_header();
?>
<main class="main-conainer">
	<section class="custom-tabs resources-tabs pt-8" id="myTab" role="tablist">
		<div class="container-xxl container text-center">
			<?php
            $args = array(
                'post_type' => array( 'post' ),
                's' => $_GET['s'],
                'posts_per_page' => 8
            );

            query_posts( $args );

			if ( have_posts() ) {
				?>
					<h2 class="h1 cmn-heading">
						<?php
						printf(
							/* translators: %s: Search term. */
							esc_html__( 'Results for "%s"', THEME_TEXTDOMAIN ),
							'<span class="page-description search-term">' . esc_html( get_search_query() ) . '</span>'
						);
						?>
					</h2>
				<!-- .page-header -->

				<h2 class="search-result-count default-max-width text-blue">
					<?php
					printf(
						esc_html(
							/* translators: %d: The number of search results. */
							_n(
								'We found %d result for your search.',
								'We found %d results for your search.',
								(int) $wp_query->found_posts,
								THEME_TEXTDOMAIN
							)
						),
						(int) $wp_query->found_posts
					);
					?>
				</h2><!-- .search-result-count -->

				<div class="tab-content-wrap border-0 text-start">
                    <div class="tab-content position-relative container-xxl container" class="tab-content" id="nav-tabContent">
                        <div class="tab-pane fade show active " id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                             <div class="row wrapping">
								<?php
								// Start the Loop.
								while ( have_posts() ): the_post( ); 

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
                                        $resources_post_title = get_the_title();
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
			// If no content, include the "No posts found" template.
			} else {
                ?>
                <h2 class="text-center">
                    <?php esc_html_e( 'No data Found !', THEME_TEXTDOMAIN) ?>
                </h2>
                <?php
			}
                                $max_pages = ceil ((int) $wp_query->found_posts / 8);
                                if($max_pages == '1'){
                                    $max_pages ++;
                                }
			?>
							</div>
						</div>
					</div>
				</div>
			</div>
<?php
if((int) $wp_query->found_posts > 8){
    ?>
        <button keyword="<?php echo $_GET['s']; ?>" limit="8" page="1" category="all" maxpages="<?php echo $max_pages; ?>" class="load_all_posts_search btn bg-blue cmn-btn curve-left load-more mt-5 "><?php esc_html_e( 'Load More', THEME_TEXTDOMAIN) ?></button>
   <?php
    }
   ?>
    </section>
</main>
<?php
wp_reset_query();
get_footer();