<?php

$authUrl = \Harbinger_Marketing\Testimonials\Source\Google\Client::instance()->createAuthUrl();

?>


<div id="google-api-authorization">
    <h3>
        <?= __('Google Account not Authorized!', THEME_TEXTDOMAIN) ?>
    </h3>

    <p>
        <?= __('To work with the GOOGLE API, you need to authorize an account.', THEME_TEXTDOMAIN) ?>
    </p>

    <a href="<?= $authUrl ?>" class="button button-primary button-large" id="google-api-authorize-action">
        <?= __('Authorize Google Account', THEME_TEXTDOMAIN) ?>
    </a>
</div>