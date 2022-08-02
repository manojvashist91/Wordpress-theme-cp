<?php

$logoutUri = \Harbinger_Marketing\Testimonials\Source\Google\Client::logoutUri();
$clearTestimonialsCacheUri = \Harbinger_Marketing\Testimonials\Source\Google\Client::clearTestimonialsCacheUri();

$client = \Harbinger_Marketing\Testimonials\Source\Google\Client::instance();

$oauthService = new Google_Service_Oauth2($client);
$userinfo = $oauthService->userinfo_v2_me->get();

$businessAccountService = new Google_Service_MyBusinessAccountManagement($client);
$accounts = $businessAccountService->accounts->listAccounts()->getAccounts();

$businessInformationService = new Google_Service_MyBusinessBusinessInformation($client);
$locations = $businessInformationService->accounts_locations->listAccountsLocations($accounts[0]->getName(), ['readMask' => 'name'])->getLocations();

$testimonialsSource = new \Harbinger_Marketing\Testimonials\Source\Google\Source();
$totalTestimonialsCount = $testimonialsSource->totalCount();
$loadedTestimonialsCount = $testimonialsSource->loadedCount();
$testimonialsLoadingStatus = $testimonialsSource->status();
?>

<div id="google-api-account">
    <div>

        <h3>
            <?= __('Account Information', THEME_TEXTDOMAIN) ?>
        </h3>

        <table class="form-table" role="presentation">
            <tr class="user-description-wrap">
                <th>
                    <label for="description">
                        <?= __('Profile Name', THEME_TEXTDOMAIN) ?>
                    </label>
                </th>

                <td>
                    <h3>
                        <?= $userinfo->name ?>
                    </h3>
                </td>
            </tr>

            <tr class="user-profile-picture">
                <th>
                    <?= __('Profile Picture', THEME_TEXTDOMAIN) ?>
                </th>

                <td>
                    <img alt="" src="<?= $userinfo->picture ?>" class="avatar avatar-96 photo" height="96" width="96" loading="lazy">
                </td>
            </tr>

            <tr class="user-profile-picture">
                <th>
                    <h3>
                        <?= __('Accounts', THEME_TEXTDOMAIN) ?>
                    </h3>
                </th>

                <td>
                    <?php foreach ( $accounts as $account ) : ?>
                        <div style="border-left:2px solid #cbcbcb;padding:8px;margin:8px 0">
                            <p class="description">
                                <b>
                                    <?= __('Account User Name', THEME_TEXTDOMAIN) ?>: <?= $account->getAccountName() ?>
                                </b>
                            </p>

                            <p class="description">
                                <?= __('Account Name', THEME_TEXTDOMAIN) ?>: <?= $account->getName() ?>
                            </p>

                            <?php if ( $organizationInfo = $account->getOrganizationInfo() ) : ?>
                                <p class="description">
                                    <?= __('Phone Number', THEME_TEXTDOMAIN) ?>: <?= $organizationInfo->getPhoneNumber() ?>
                                </p>

                                <p class="description">
                                    <?= __('Registered Domain', THEME_TEXTDOMAIN) ?>: <?= $organizationInfo->getRegisteredDomain() ?>
                                </p>

                                <p class="description">
                                    <?= __('Address', THEME_TEXTDOMAIN) ?>: <?= $organizationInfo->getAddress()->getAddressLines() ?>
                                </p>
                            <?php endif ?>


                        </div>
                    <?php endforeach; ?>
                </td>
            </tr>

            <tr class="user-profile-picture">
                <th>
                    <h3>
                        <?= __('Locations', THEME_TEXTDOMAIN) ?>
                    </h3>
                </th>

                <td>
                    <?php if ( !empty($locations) ) : ?>
                        <?php foreach ( $locations as $location ) : ?>
                            <div style="border-left:2px solid #cbcbcb;padding:8px;margin:8px 0">
                                <p class="description">
                                    <?= __('Location Name', THEME_TEXTDOMAIN) ?>: <?= $location->getName() ?>
                                </p>

                                <?php $meta = $location->getMetadata() ?>
                                <?php if ( $meta ) : ?>
                                    <p class="description">
                                        <?= __('Location Place ID', THEME_TEXTDOMAIN) ?>: <?= $meta->getPlaceId() ?>
                                    </p>
                                <?php endif ?>
                            </div>
                        <?php endforeach; ?>

                    <?php else : ?>
                        <p class="description">
                            <?= __('Locations Not Found!', THEME_TEXTDOMAIN) ?>
                        </p>
                    <?php endif ?>
                </td>
            </tr>
        </table>

        <h3>
            <?= __('Reviews', THEME_TEXTDOMAIN) ?>
        </h3>

        <table class="form-table" role="presentation">
            <tr class="user-description-wrap">
                <th>
                    <label for="description">
                        <?= __('Number of Reviews', THEME_TEXTDOMAIN) ?>
                    </label>
                </th>

                <td>
                    <b style="color: green">
                        <?= $totalTestimonialsCount ?>
                    </b>
                </td>
            </tr>

            <tr class="user-description-wrap">
                <th>
                    <label for="description">
                        <?= __('Testimonials Status', THEME_TEXTDOMAIN) ?>
                    </label>
                </th>

                <td>
                    <?php if ( 'start' === $testimonialsLoadingStatus ) : ?>
                        <b style="color: darkorange">
                            <?= __('Testimonials Loading Started.', THEME_TEXTDOMAIN) ?>
                        </b>
                    <?php elseif ( 'loading' === $testimonialsLoadingStatus ) : ?>
                        <b style="color: darkorange">
                            <?= __('Testimonials Loading In Progress.', THEME_TEXTDOMAIN) ?>
                        </b>
                    <?php elseif ( 'ready' === $testimonialsLoadingStatus ) : ?>
                        <b style="color: green">
                            <?= __('All Testimonials Loaded.', THEME_TEXTDOMAIN) ?>
                        </b>
                    <?php endif ?>

                </td>
            </tr>

            <tr class="user-description-wrap">
                <th>
                    <label for="description">
                        <?= __('Number of Cached Reviews', THEME_TEXTDOMAIN) ?>
                    </label>
                </th>

                <td>
                    <b>
                        <?= "{$loadedTestimonialsCount} / {$totalTestimonialsCount}" ?>
                    </b>

                    <p class="description">
                        <?= __('Google Reviews cannot be downloaded all at once. There is a limit: 50 records per request, maximum 50 requests per second.', THEME_TEXTDOMAIN) ?>
                    </p>
                </td>
            </tr>
        </table>

        <div>
            <a href="<?= $clearTestimonialsCacheUri ?>" class="button button-primary button-large" id="google-api-logout-action">
                <?= __('Update Reviews Cache', THEME_TEXTDOMAIN) ?>
            </a>

            <p class="description " style="color: red">
                <span class="dashicons dashicons-warning"></span>

                <b>
                    <?= __('Google Reviews will disappear from the list of reviews until they are fully loaded.', THEME_TEXTDOMAIN) ?>
                </b>
            </p>

            <p class="description">
                <?= __('Reviews are updated every 24 hours.', THEME_TEXTDOMAIN) ?>
            </p>
        </div>

        <div style="padding-top: 48px">
            <a href="<?= $logoutUri ?>" class="button button-secondary button-large" id="google-api-logout-action">
                <?= __('Logout', THEME_TEXTDOMAIN) ?>
            </a>

            <p class="description" style="color: orange">
                <span class="dashicons dashicons-warning"></span>

                <b>
                    <?= __('Google Reviews will disappear from the list of reviews.', THEME_TEXTDOMAIN) ?>
                </b>
            </p>
        </div>
    </div>
</div>