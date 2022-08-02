<?php

services_custom_post_type();
meet_our_teams_custom_post_type();
case_studies_custom_post_type();
testimonials_custom_post_type();

function services_custom_post_type()
{

// Set UI labels for Custom Post Type
    $labels = array(
        'name' => _x('Services', __('Post Type General Name'), THEME_TEXTDOMAIN),
        'singular_name' => _x('Service', __('Post Type Singular Name'), THEME_TEXTDOMAIN),
        'menu_name' => __('Services', THEME_TEXTDOMAIN),
        'parent_item_colon' => __('Parent Service', THEME_TEXTDOMAIN),
        'all_items' => __('All Services', THEME_TEXTDOMAIN),
        'view_item' => __('View Service', THEME_TEXTDOMAIN),
        'add_new_item' => __('Add New Service', THEME_TEXTDOMAIN),
        'add_new' => __('Add New', THEME_TEXTDOMAIN),
        'edit_item' => __('Edit Service', THEME_TEXTDOMAIN),
        'update_item' => __('Update Service', THEME_TEXTDOMAIN),
        'search_items' => __('Search Service', THEME_TEXTDOMAIN),
        'not_found' => __('Not Found', THEME_TEXTDOMAIN),
        'not_found_in_trash' => __('Not found in Trash', THEME_TEXTDOMAIN),
    );

// Set other options for Custom Post Type
    $args = array(
        'label' => __('Services', THEME_TEXTDOMAIN),
        'description' => __('Service news and reviews', THEME_TEXTDOMAIN),
        'labels' => $labels,
        // Features this CPT supports in Post Editor
        'supports' => array('title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'revisions', 'custom-fields',),
        // You can associate this CPT with a taxonomy or custom taxonomy.
        'taxonomies' => array('genres'),
        /* A hierarchical CPT is like Pages and can have
        * Parent and child items. A non-hierarchical CPT
        * is like Posts.
        */
        'hierarchical' => false,
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'show_in_nav_menus' => true,
        'show_in_admin_bar' => true,
        'menu_position' => 5,
        'can_export' => true,
        'has_archive' => false,
        'exclude_from_search' => false,
        'publicly_queryable' => true,
        'capability_type' => 'post',
        'show_in_rest' => true,

    );

    // Registering your Custom Post Type
    register_post_type('services', $args);

     	register_taxonomy(
 		'service-category',
 		'services',
 		array(
 			'hierarchical'      => true,
 			'labels'            => array(
 				'name'              => _x( 'Categories', 'taxonomy general name', THEME_TEXTDOMAIN ),
 				'singular_name'     => _x( 'Category', 'taxonomy singular name', THEME_TEXTDOMAIN ),
 				'search_items'      => __( 'Search Categories', THEME_TEXTDOMAIN ),
 				'all_items'         => __( 'All Categories', THEME_TEXTDOMAIN ),
 				'parent_item'       => __( 'Parent Category', THEME_TEXTDOMAIN ),
 				'parent_item_colon' => __( 'Parent Category:', THEME_TEXTDOMAIN ),
 				'edit_item'         => __( 'Edit Category', THEME_TEXTDOMAIN ),
 				'update_item'       => __( 'Update Category', THEME_TEXTDOMAIN ),
 				'add_new_item'      => __( 'Add New Category', THEME_TEXTDOMAIN ),
 				'new_item_name'     => __( 'New Category', THEME_TEXTDOMAIN ),
 				'menu_name'         => __( 'Categories', THEME_TEXTDOMAIN )
 			),
 			'public'            => false,
 			'publicly_queryable' => true,
 			'show_in_nav_menus' => true,
 			'show_ui'           => true,
 			'show_admin_column' => true,
 			'query_var'         => true,
 			'rewrite'           => array(
 				'slug' => 'service-categories'
 			)
 		)
 	);

}
function meet_our_teams_custom_post_type() {

// Set UI labels for Custom Post Type
    $labels = array(
        'name'                => _x( 'Teams', __( 'Post Type General Name'),THEME_TEXTDOMAIN ),
        'singular_name'       => _x( 'Team', __( 'Post Type Singular Name'),THEME_TEXTDOMAIN ),
        'menu_name'           => __( 'Our Team',THEME_TEXTDOMAIN ),
        'parent_item_colon'   => __( 'Parent Service',THEME_TEXTDOMAIN ),
        'all_items'           => __( 'All Team',THEME_TEXTDOMAIN ),
        'view_item'           => __( 'View Service',THEME_TEXTDOMAIN ),
        'add_new_item'        => __( 'Add New Team',THEME_TEXTDOMAIN ),
        'add_new'             => __( 'Add New',THEME_TEXTDOMAIN ),
        'edit_item'           => __( 'Edit Team',THEME_TEXTDOMAIN ),
        'update_item'         => __( 'Update Team',THEME_TEXTDOMAIN ),
        'search_items'        => __( 'Search Team',THEME_TEXTDOMAIN ),
        'not_found'           => __( 'Not Found',THEME_TEXTDOMAIN ),
        'not_found_in_trash'  => __( 'Not found in Trash',THEME_TEXTDOMAIN ),
    );

// Set other options for Custom Post Type

    $args = array(
        'label'               => __( 'Meet Our Team',THEME_TEXTDOMAIN ),
        'description'         => __( 'team news and reviews',THEME_TEXTDOMAIN ),
        'labels'              => $labels,
        // Features this CPT supports in Post Editor
        'supports'            => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'revisions', 'custom-fields', ),
        // You can associate this CPT with a taxonomy or custom taxonomy.
        'taxonomies'          => array( 'genres' ),
        /* A hierarchical CPT is like Pages and can have
        * Parent and child items. A non-hierarchical CPT
        * is like Posts.
        */
        'hierarchical'        => false,
        'public'              => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'show_in_nav_menus'   => true,
        'show_in_admin_bar'   => true,
        'menu_position'       => 5,
        'can_export'          => true,
        'has_archive'         => true,
        'exclude_from_search' => false,
        'publicly_queryable'  => false,
        'capability_type'     => 'post',
        'show_in_rest' => true,

    );

    // Registering your Custom Post Type
    register_post_type( 'our_team', $args );

    // register_taxonomy(
    //     'team-category',
    //     'our_team',
    //     array(
    //         'hierarchical'      => true,
    //         'labels'            => array(
    //             'name'              => _x( 'Categories', 'taxonomy general name', THEME_TEXTDOMAIN ),
    //             'singular_name'     => _x( 'Category', 'taxonomy singular name', THEME_TEXTDOMAIN ),
    //             'search_items'      => __( 'Search Categories', THEME_TEXTDOMAIN ),
    //             'all_items'         => __( 'All Categories', THEME_TEXTDOMAIN ),
    //             'parent_item'       => __( 'Parent Category', THEME_TEXTDOMAIN ),
    //             'parent_item_colon' => __( 'Parent Category:', THEME_TEXTDOMAIN ),
    //             'edit_item'         => __( 'Edit Category', THEME_TEXTDOMAIN ),
    //             'update_item'       => __( 'Update Category', THEME_TEXTDOMAIN ),
    //             'add_new_item'      => __( 'Add New Category', THEME_TEXTDOMAIN ),
    //             'new_item_name'     => __( 'New Category', THEME_TEXTDOMAIN ),
    //             'menu_name'         => __( 'Categories', THEME_TEXTDOMAIN )
    //         ),
    //         'public'            => false,
    //         'publicly_queryable' => true,
    //         'show_in_nav_menus' => true,
    //         'show_ui'           => true,
    //         'show_admin_column' => true,
    //         'query_var'         => true,
    //         'rewrite'           => array(
    //             'slug' => 'team-categories'
    //         )
    //     )
    // );

}
function case_studies_custom_post_type() {

    // Set UI labels for Custom Post Type
        $labels = array(
            'name'                => _x( 'Case Studies', __( 'Post Type General Name'),THEME_TEXTDOMAIN ),
            'singular_name'       => _x( 'Case Study', __( 'Post Type Singular Name'),THEME_TEXTDOMAIN ),
            'menu_name'           => __( 'Case Studies',THEME_TEXTDOMAIN ),
            'parent_item_colon'   => __( 'Parent Service',THEME_TEXTDOMAIN ),
            'all_items'           => __( 'All Case Studies',THEME_TEXTDOMAIN ),
            'view_item'           => __( 'View Case Studies',THEME_TEXTDOMAIN ),
            'add_new_item'        => __( 'Add New Case Study',THEME_TEXTDOMAIN ),
            'add_new'             => __( 'Add New',THEME_TEXTDOMAIN ),
            'edit_item'           => __( 'Edit Case Study',THEME_TEXTDOMAIN ),
            'update_item'         => __( 'Update Case Study',THEME_TEXTDOMAIN ),
            'search_items'        => __( 'Search Case Study',THEME_TEXTDOMAIN ),
            'not_found'           => __( 'Not Found',THEME_TEXTDOMAIN ),
            'not_found_in_trash'  => __( 'Not found in Trash',THEME_TEXTDOMAIN ),
        );
    
    // Set other options for Custom Post Type
    
        $args = array(
            'label'               => __( 'Case Studies',THEME_TEXTDOMAIN ),
            'description'         => __( 'Capital Plus Case Studies',THEME_TEXTDOMAIN ),
            'labels'              => $labels,
            // Features this CPT supports in Post Editor
            'supports'            => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'revisions', 'custom-fields', ),
            // You can associate this CPT with a taxonomy or custom taxonomy.
            'taxonomies'          => array( 'genres' ),
            /* A hierarchical CPT is like Pages and can have
            * Parent and child items. A non-hierarchical CPT
            * is like Posts.
            */
            'hierarchical'        => false,
            'public'              => true,
            'show_ui'             => true,
            'show_in_menu'        => true,
            'show_in_nav_menus'   => true,
            'show_in_admin_bar'   => true,
            'menu_position'       => 5,
            'can_export'          => true,
            'has_archive'         => true,
            'exclude_from_search' => false,
            'publicly_queryable'  => false,
            'capability_type'     => 'post',
            'show_in_rest' => true,
    
        );
    
        // Registering your Custom Post Type
        register_post_type( 'case_studies', $args );
    
        
    
    }


function testimonials_custom_post_type() {
    // Set UI labels for Custom Post Type
    $labels = array(
        'name'                => _x( 'Testimonials', __( 'Post Type General Name'),THEME_TEXTDOMAIN ),
        'singular_name'       => _x( 'Testimonial', __( 'Post Type Singular Name'),THEME_TEXTDOMAIN ),
        'menu_name'           => __( 'Testimonials',THEME_TEXTDOMAIN ),
        'all_items'           => __( 'All Testimonials',THEME_TEXTDOMAIN ),
        'view_item'           => __( 'View Testimonials',THEME_TEXTDOMAIN ),
        'add_new_item'        => __( 'Add New Testimonial',THEME_TEXTDOMAIN ),
        'add_new'             => __( 'Add New',THEME_TEXTDOMAIN ),
        'edit_item'           => __( 'Edit Testimonial',THEME_TEXTDOMAIN ),
        'update_item'         => __( 'Update Testimonial',THEME_TEXTDOMAIN ),
        'search_items'        => __( 'Search Testimonial',THEME_TEXTDOMAIN ),
        'not_found'           => __( 'Not Found',THEME_TEXTDOMAIN ),
        'not_found_in_trash'  => __( 'Not found in Trash',THEME_TEXTDOMAIN ),
    );

    // Set other options for Custom Post Type

    $args = array(
        'label'               => __( 'Case Studies',THEME_TEXTDOMAIN ),
        'description'         => __( 'Capital Plus Case Studies',THEME_TEXTDOMAIN ),
        'labels'              => $labels,
        'supports'            => array( 'title' ),
        'hierarchical'        => false,
        'public'              => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'show_in_nav_menus'   => true,
        'show_in_admin_bar'   => true,
        'menu_position'       => 6,
        'menu_icon'           => 'dashicons-format-status',
        'can_export'          => true,
        'has_archive'         => false,
        'exclude_from_search' => false,
        'publicly_queryable'  => false,
        'rewrite'             => array(
            'slug' => 'testimonials-list'
        ),
        'capability_type'     => 'post',
        'show_in_rest' => true,
    );

    // Registering your Custom Post Type
    register_post_type( 'testimonials', $args );
}

