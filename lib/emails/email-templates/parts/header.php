<?php
	$geo_data = get_user_geo_data();
	$browser = new Browser();

	$is_notification = $action_settings['label'] == 'Email Notification';
	$is_confirmation = $action_settings['label'] == 'Email Confirmation';
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="en" xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="x-apple-disable-message-reformatting">

		<!--[if gte mso 9]>
			<xml>
				<o:OfficeDocumentSettings>
					<o:AllowPNG/>
					<o:PixelsPerInch>96</o:PixelsPerInch>
				</o:OfficeDocumentSettings>
			</xml>
		<![endif]-->

		<style>
			table, td, h1, p {
				font-family: Arial, sans-serif;
			}
		</style>
	</head>

	<body style="margin: 0; padding: 0; word-spacing: normal; text-size-adjust: 100%; -webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%;">
		<table role="presentation" style="width: 100%; border: none; border-spacing: 0; border-collapse: collapse; text-align: left; font-family: Arial, sans-serif; font-size: 16px; line-height: 22px;">
			<tr>
				<td style="padding: 0;">
					<!-- Header Logos -->
					<table role="presentation" style="width: 100%; border: none; border-spacing: 0; border-collapse: collapse;">
						<tr>
							<td style="font-size: 0; background: #F8F8F8; padding: 15px 0; text-align: center">
								<!--[if mso]>
								<table role="presentation" style="border: none; border-spacing: 0; border-collapse: collapse;">
									<tr>
										<td style="padding: 15px 25px;" valign="middle">
										<![endif]-->
											<?php if ( $is_notification ) : ?>
												<a href="<?php echo HARBINGER_MARKETING_WEBSITE_URL ?>" target="_blank" style="display: inline-block; width: 100%; max-width: 150px; margin-top: 15px; margin-bottom: 15px; margin-left: 25px; margin-right: 25px; vertical-align: middle;">
													<?php $harbinger_marketing_logo_url = get_svg_as_colorized_png( HARBINGER_MARKETING_LOGO_PATH, '#11285B' ) ?>
													<img src="<?php echo $harbinger_marketing_logo_url ?>" alt="" style="display: block;" width="150">
												</a>
											<?php endif ?>
										<!--[if mso]>
										</td>

										<td style="padding: 15px 25px;" valign="middle">
										<![endif]-->
                                <?php $site_logo_url = get_svg_as_colorized_png( THEME_LOGO_RASTER_WHITE_URL) ?>
											<a href="<?php bloginfo('url') ?>" target="_blank" style="display: inline-block; width: 100%; max-width: 150px; margin-top: 15px; margin-bottom: 15px; margin-left: 25px; margin-right: 25px; vertical-align: middle;">
												<img src="<?php echo $site_logo_url ?>" alt="" style="display: block;" width="150">
											</a>
										<!--[if mso]>
										</td>
									</tr>
								</table>
								<![endif]-->
							</td>
						</tr>
					</table>

					<!-- Subheader Content -->
					<table role="presentation" style="width: 100%; border: none; border-spacing: 0; border-collapse: collapse;">
						<tr>
							<td style="background: #50A146; padding: 20px; text-align: center;">
								<p style="font-size: 16px; letter-spacing: 3px; color: #FFF; text-transform: uppercase; padding: 0; margin: 0;">
									<?php if ( $is_notification ) : ?>
										<?php _e('You received another lead from Harbinger Marketing', THEME_TEXTDOMAIN) ?>
									<?php else : ?>
										<?php _e('We have received your submission', THEME_TEXTDOMAIN) ?>
									<?php endif ?>
								</p>
							</td>
						</tr>

						<tr>
							<td style="font-size: 0; padding: 0 0 15px; text-align: center;">
								<span style="display: inline-block; width: 0; height: 0; border-left: 15px solid transparent; border-right: 15px solid transparent; border-top: 15px solid #50A146;"></span>
							</td>
						</tr>
					</table>