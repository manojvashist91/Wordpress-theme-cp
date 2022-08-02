<?php

use \Harbinger_Marketing\Testimonials\Source\Google\Client;

?>

<section id="google-api-options">

<?php
try {
    if ( !function_exists('get_view_name') ) {
        function get_view_name() : string
        {
            if ( isset($_GET['page']) && 'crb_carbon_fields_container_theme_options.php' === $_GET['page'] ) {
                return 'welcome-to-options';
            }

            $projectId = carbon_get_theme_option('google_business_api_project_id');
            $applicationCredentials = carbon_get_theme_option('google_business_api_credentials_json');
            if ( !$projectId || !$applicationCredentials ) {
                return 'no-credentials';
            }

            if ( Client::hasErrors() || empty(Client::instance()->getAccessToken()) ) {
                return 'authorize';
            }

            return 'account';
        }
    }

    $view = get_view_name();
?>

<?php

    switch ( $view ) {
        case 'welcome-to-options':
            get_template_part('lib/testimonials/view/welcome-to-options');
            break;

        case 'no-credentials':
            get_template_part('lib/testimonials/view/credentials');
            break;

        case 'authorize':
            get_template_part('lib/testimonials/view/authorize');
            break;

        case 'account':
            get_template_part('lib/testimonials/view/account');
            break;
    }

}
catch( \Exception $ex ) {
    Client::logout();
    var_dump($ex);
}

?>

</section>