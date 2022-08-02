					<?php if ( $is_notification ) : ?>
						<!-- User Information -->
						<table role="presentation" style="width: 100%; border: none; border-spacing: 0; border-collapse: collapse;">
							<tr>
								<td align="center" style="padding: 0 20px 40px;">
									<table role="presentation" style="width: 100%; border: none; border-spacing: 0; border-collapse: collapse;;">
										<tr>
											<td style="width: 50%; padding: 0; vertical-align: middle;">
												<span style="display: block; background: #000000; height: 1px;"></span>
											</td>

											<td style="padding: 10px 0; white-space: nowrap;">
												<p style="font-size: 16px; font-weight: bold; letter-spacing: 3px; color: #000000; text-transform: uppercase; padding: 0 15px; margin: 0; white-space: nowrap;">
													<?php _e('Other Information', THEME_TEXTDOMAIN) ?>
												</p>
											</td>
											
											<td style="width: 50%; padding: 0; vertical-align: middle;">
												<span style="display: block; background: #000000; height: 1px;"></span>
											</td>
										</tr>
									</table>

									<table role="presentation" style="width: 100%; max-width: 900px; background-color: #ffffff; table-layout: fixed; border: none; border-spacing: 0; border-collapse: collapse; margin: 0 auto;">
										<tr>
											<td style="font-size: 0; padding: 0 10px;">
												<!--[if mso]>
												<table role="presentation" style="width: 100%; border: none; border-spacing: 0; border-collapse: collapse;">
													<tr>
														<td style="width: 33.33%; padding: 10px 0;" valign="top">
														<![endif]-->
															<div style="display: inline-block; width: 100%; width: 33.33%; float: left; padding: 15px 0; vertical-align: top;">
																<?php $pin_icon_url = get_svg_as_colorized_png( THEME_ASSETS_PATH  . '/branding/img/icons/pin-icon.svg', '#000000' ) ?>

																<!--[if mso]>
																<table role="presentation" style="width: 100%; border: none; border-spacing: 0; border-collapse: collapse;">
																	<tr>
																		<td style="padding: 0 0 15px;">
																		<![endif]-->
																			<img src="<?php echo $pin_icon_url ?>" style="margin-bottom: 15px;" width="25" height="<?php echo 25 / get_image_aspect_ratio( $pin_icon_url ) ?>">
																		<!--[if mso]>
																		</td>
																	</tr>
																</table>

																<table role="presentation" style="width: 100%; border: none; border-spacing: 0; border-collapse: collapse;">
																	<tr>
																		<td style="padding: 0 0 15px;">
																		<![endif]-->
																			<p style="font-size: 16px; padding-bottom: 15px; margin: 0; color: #000000;">
																				<strong>
																					<?php _e('City:', THEME_TEXTDOMAIN) ?>
																				</strong>
																				
																				<?php echo $geo_data['geoplugin_city'] ?>
																			</p>
																		<!--[if mso]>
																		</td>
																	</tr>
																</table>

																<table role="presentation" style="width: 100%; border: none; border-spacing: 0; border-collapse: collapse;">
																	<tr>
																		<td style="padding: 0 0 15px;">
																		<![endif]-->
																			<p style="font-size: 16px; padding-bottom: 15px; margin: 0; color: #000000;">
																				<strong>
																					<?php _e('State:', THEME_TEXTDOMAIN) ?>
																				</strong>
																				
																				<?php echo $geo_data['geoplugin_regionName'] ?>
																			</p>
																		<!--[if mso]>
																		</td>
																	</tr>
																</table>

																<table role="presentation" style="width: 100%; border: none; border-spacing: 0; border-collapse: collapse;">
																	<tr>
																		<td style="padding: 0 0 15px;">
																		<![endif]-->
																			<p style="font-size: 16px; padding-bottom: 15px; margin: 0; color: #000000;">
																				<strong>
																					<?php _e('Country:', THEME_TEXTDOMAIN) ?>
																				</strong>
																				
																				<?php echo $geo_data['geoplugin_countryName'] ?>
																			</p>
																		<!--[if mso]>
																		</td>
																	</tr>
																</table>
																<![endif]-->
															</div>
														<!--[if mso]>
														</td>

														<td style="width: 33.33%; padding: 10px 0;" valign="top">
														<![endif]-->
															<div style="display: inline-block; width: 100%; width: 33.33%; float: left; padding: 15px 0; vertical-align: top;">
																<?php $computer_icon_url = get_svg_as_colorized_png( THEME_ASSETS_PATH  . '/branding/img/icons/computer-icon.svg', '#000000' ) ?>

																<!--[if mso]>
																<table role="presentation" style="width: 100%; border: none; border-spacing: 0; border-collapse: collapse;">
																	<tr>
																		<td style="padding: 0 0 15px;">
																		<![endif]-->
																			<img src="<?php echo $computer_icon_url ?>" style="margin-bottom: 15px;" width="30" height="<?php echo 30 / get_image_aspect_ratio( $computer_icon_url ) ?>">
																		<!--[if mso]>
																		</td>
																	</tr>
																</table>

																<table role="presentation" style="width: 100%; border: none; border-spacing: 0; border-collapse: collapse;">
																	<tr>
																		<td style="padding: 0 0 15px;">
																		<![endif]-->
																			<p style="font-size: 16px; padding-bottom: 15px; margin: 0; color: #000000;">
																				<strong>
																					<?php _e('Browser:', THEME_TEXTDOMAIN) ?>
																				</strong>
																				
																				<?php echo $browser->getBrowser() ?>
																			</p>
																		<!--[if mso]>
																		</td>
																	</tr>
																</table>

																<table role="presentation" style="width: 100%; border: none; border-spacing: 0; border-collapse: collapse;">
																	<tr>
																		<td style="padding: 0 0 15px;">
																		<![endif]-->
																			<p style="font-size: 16px; padding-bottom: 15px; margin: 0; color: #000000;">
																				<strong>
																					<?php _e('Operating System:', THEME_TEXTDOMAIN) ?>
																				</strong>
																				
																				<?php echo $browser->getPlatform() ?>
																			</p>
																		<!--[if mso]>
																		</td>
																	</tr>
																</table>

																<table role="presentation" style="width: 100%; border: none; border-spacing: 0; border-collapse: collapse;">
																	<tr>
																		<td style="padding: 0 0 15px;">
																		<![endif]-->
																			<p style="font-size: 16px; padding-bottom: 15px; margin: 0; color: #000000;">
																				<strong>
																					<?php _e('IP Address:', THEME_TEXTDOMAIN) ?>
																				</strong>
																				
																				<?php echo $_SERVER['REMOTE_ADDR'] ?>
																			</p>
																		<!--[if mso]>
																		</td>
																	</tr>
																</table>
																<![endif]-->
															</div>
														<!--[if mso]>
														</td>

														<td style="width: 33.33%; padding: 10px 0;" valign="top">
														<![endif]-->
															<div style="display: inline-block; width: 100%; width: 33.33%; float: left; padding: 15px 0; vertical-align: top;">
																<?php $clock_icon_url = get_svg_as_colorized_png( THEME_ASSETS_PATH  . '/branding/img/icons/clock-icon.svg', '#000000' ) ?>

																<!--[if mso]>
																<table role="presentation" style="width: 100%; border: none; border-spacing: 0; border-collapse: collapse;">
																	<tr>
																		<td style="padding: 0 0 15px;">
																		<![endif]-->
																			<img src="<?php echo $clock_icon_url ?>" style="margin-bottom: 15px;" width="30" height="<?php echo 30 / get_image_aspect_ratio( $clock_icon_url ) ?>">
																		<!--[if mso]>
																		</td>
																	</tr>
																</table>

																<table role="presentation" style="width: 100%; border: none; border-spacing: 0; border-collapse: collapse;">
																	<tr>
																		<td style="padding: 0 0 15px;">
																		<![endif]-->
																			<p style="font-size: 16px; padding-bottom: 15px; margin: 0; color: #000000;">
																				<strong>
																					<?php _e('Time Zone:', THEME_TEXTDOMAIN) ?>
																				</strong>
																				
																				<?php echo $geo_data['geoplugin_timezone'] ?>
																			</p>
																		<!--[if mso]>
																		</td>
																	</tr>
																</table>
																<![endif]-->
															</div>
														<!--[if mso]>
														</td>
													</tr>
												</table>
												<![endif]-->
											</td>
										</tr>
									</table>
								</td>
							</tr>
						</table>
					<?php endif ?>
					
					<!-- Footer -->
					<table role="presentation" style="width: 100%; border: none; border-spacing: 0; border-collapse: collapse; background: #F8F8F8;">
						<tr>
							<td style="text-align: center; padding: 20px 0;">
								<a href="<?php echo $is_notification ? HARBINGER_MARKETING_WEBSITE_URL : get_bloginfo('url') ?>" target="_blank" style="display: block; width: 100%; max-width: 150px; margin: 0 auto;">
									<?php if ( $is_notification ) : ?>
										<?php $harbinger_logo_url = get_svg_as_colorized_png( HARBINGER_MARKETING_LOGO_PATH, '#11285B' ) ?>

										<img src="<?php echo $harbinger_logo_url ?>" alt="" style="display: block;" width="150">
									<?php else : ?>
                                        <?php $site_logo_url = get_svg_as_colorized_png( THEME_LOGO_RASTER_COLORFUL_URL) ?>
										<img src="<?php echo $site_logo_url ?>" alt="" style="display: block;" width="150">
									<?php endif ?>
								</a>
							</td>
						</tr>
					</table>
				</td>
			</tr>
		</table>
	</body>
</html>