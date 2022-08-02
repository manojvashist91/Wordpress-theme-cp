<?php require( THEME_EMAIL_TEMPLATES_PATH . '/parts/header.php' ) ?>

<!-- Body Content -->
<table role="presentation" style="width: 100%; border: none; border-spacing: 0; border-collapse: collapse;">
	<tr>
		<td align="center" style="padding: 0 20px 50px;">
			<table role="presentation" style="width: 100%; border: none; border-spacing: 0; border-collapse: collapse;">
				<tr>
					<td style="width: 50%; padding: 0; vertical-align: middle;">
						<span style="display: block; background: <?php echo THEME_BRAND_COLOR_MAIN ?>; height: 1px;"></span>
					</td>

					<td style="padding: 10px 0; white-space: nowrap;">
						<p style="font-size: 16px; font-weight: bold; letter-spacing: 3px; color: <?php echo THEME_BRAND_COLOR_MAIN ?>; text-transform: uppercase; padding: 0 15px; margin: 0; white-space: nowrap;">
							<?php _e('Form information', THEME_TEXTDOMAIN) ?>
						</p>
					</td>
					
					<td style="width: 50%; padding: 0 0 10px; vertical-align: middle;">
						<span style="display: block; background: <?php echo THEME_BRAND_COLOR_MAIN ?>; height: 1px;"></span>
					</td>
				</tr>
			</table>

			<table role="presentation" style="width: 900px; border: none; border-spacing: 0; border-collapse: collapse; margin: 0 auto;">
				<tr>
					<td style="width: 100%; padding: 10px 0 5px; text-align: center;">
						<p style="font-size: 16px; padding: 0; margin: 0;">
							<?php _e('Please find the application form details in the attached PDF file.', THEME_TEXTDOMAIN) ?>
						</p>
					</td>
				</tr>
			</table>
		</td>
	</tr>
</table>

<?php require( THEME_EMAIL_TEMPLATES_PATH . '/parts/footer.php' ) ?>