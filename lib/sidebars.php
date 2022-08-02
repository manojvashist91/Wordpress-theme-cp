<?php
add_action('widgets_init', function() {
    register_sidebar(
        array(
            'name' => __('Footer Section 1', THEME_TEXTDOMAIN),
            'id' => 'footer-section-1',
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<h2 class="text-green h3">',
            'after_title'   => '</h2>',
        )
    );
});
add_action('widgets_init', function() {
    register_sidebar(
        array(
            'name' => __('Footer Section 2', THEME_TEXTDOMAIN),
            'id' => 'footer-section-2',
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<h2  class="text-green h3">',
            'after_title'   => '</h2>',
        )
    );
});
add_action('widgets_init', function() {
    register_sidebar(
        array(
            'name' => __('Footer Section 3', THEME_TEXTDOMAIN),
            'id' => 'footer-section-3',
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<h2 class="text-green h3">',
            'after_title'   => '</h2>',
        )
    );
});
add_action('widgets_init', function() {
    register_sidebar(
        array(
            'name' => __('Footer Section 4', THEME_TEXTDOMAIN),
            'id' => 'footer-section-4',
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<h2 class="text-green h3">',
            'after_title'   => '</h2>',
        )
    );
});

add_action('widgets_init', function() {
    register_sidebar(
        array(
            'name' => __('Blog Sidebar', THEME_TEXTDOMAIN),
            'id' => 'blog-sidebar',
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<h2>',
            'after_title'   => '</h2>',
        )
    );
});
