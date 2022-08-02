<!DOCTYPE html>
<html <?php language_attributes() ?>>
<head>
    <?php  get_template_part( '/page-templates/header/header-meta-tag' ); ?>
    <?php wp_head() ?>
</head>

<body class="preloader-show">
<?php wp_body_open() ?>
<div class="pre-loader">
    <lottie-player src="<?php echo get_bloginfo('stylesheet_directory'); ?>/capital-plus-preloader.json" background="transparent" speed="1" style="width: 300px; height: 300px;" loop autoplay></lottie-player>
</div>
