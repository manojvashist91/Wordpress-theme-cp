<!DOCTYPE html>
<html <?php language_attributes() ?>>
<head>
    <?php get_template_part( '/page-templates/header/header-meta-tag' ); ?>
	<?php wp_head() ?>
</head>

<body class="preloader-show">
    <?php wp_body_open() ?>

    <div class="pre-loader">
        <video muted playsinline autoplay style="background-image: url(<?= get_bloginfo('stylesheet_directory'); ?>/preloader.jpg);" loop="loop" preload="auto" class="pre-loader-video">
            <img src="<?= get_bloginfo('stylesheet_directory'); ?>/preloader.jpg" importance="high" loading="eager" alt="">
            <source src="<?= get_bloginfo('stylesheet_directory'); ?>/Preloader_Capital_Plus.mp4" type="video/mp4">
        </video>
    </div>

    <?php get_template_part( '/page-templates/header/mega-menu' ); ?>
