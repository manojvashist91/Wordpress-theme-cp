<?php

register_nav_menus(
    array(
        'primary' => esc_html__( 'Primary menu', THEME_TEXTDOMAIN ),
        //'footer'  => esc_html__( 'Secondary menu', THEME_TEXTDOMAIN ),
        'copyright_menu'  => esc_html__( 'Copyright Menu', THEME_TEXTDOMAIN ),
    )
);