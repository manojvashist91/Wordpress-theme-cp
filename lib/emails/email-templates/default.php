<?php require( THEME_EMAIL_TEMPLATES_PATH . '/parts/header.php' ) ?>

<!-- Body Content -->
<table role="presentation" style="width: 100%; border: none; border-spacing: 0; border-collapse: collapse;">
	<tr>
		<td align="center" style="padding: 0 20px 50px;">
			<table role="presentation" style="width: 100%; border: none; border-spacing: 0; border-collapse: collapse;">
				<tr>
					<td style="width: 50%; padding: 0; vertical-align: middle;">
						<span style="display: block; background: #000000; height: 1px;"></span>
					</td>

					<td style="padding: 10px 0; white-space: nowrap;">
						<p style="font-size: 16px; font-weight: bold; letter-spacing: 3px; color: #000000; text-transform: uppercase; padding: 0 15px; margin: 0; white-space: nowrap;">
							<?php _e('Form information', THEME_TEXTDOMAIN) ?>
						</p>
					</td>
					
					<td style="width: 50%; padding: 0 0 10px; vertical-align: middle;">
						<span style="display: block; background:  #000000; height: 1px;"></span>
					</td>
				</tr>
			</table>

			<table role="presentation" style="width: 900px; border: none; border-spacing: 0; border-collapse: collapse; margin: 0 auto;">
				<tr>
					<td style="width: 100%; padding: 0;">
						<?php foreach ( $fields as $i => $field ) : ?>
							<div style="font-size: 0; padding: 10px 0 5px; display: flex; <?php echo $i ? 'border-top: 1px solid ' . THEME_BRAND_COLOR_TERTIARY . ';' : '' ?>">
								<!--[if mso]>
								<table role="presentation" style="border: none; border-spacing: 0; border-collapse: collapse; <?php echo $i ? 'border-top: 1px solid ' . THEME_BRAND_COLOR_TERTIARY . ';' : '' ?>">
									<tr>
										<td style="width: 300px; padding: 10px 25px 5px 0;">
										<![endif]-->
											<div style="display: inline-block; width:50%; vertical-align: top; color:#000000;">
												<p style="font-size: 16px; padding: 0 20px 5px 0; margin: 0; text-align: right;">
													<strong style="display: block; font-weight: bold;">
														<?php echo rtrim( $field['label'], '?:' ) ?>:
													</strong>
												</p>
											</div>
										<!--[if mso]>
										</td>

										<td style="width: 600px; padding: 0 0 10px;">
										<![endif]-->
											<div style="display: inline-block; width: 50%; vertical-align: top; color: #000000;">
												<?php switch ( $field['settings']['type'] ) :
														case 'checkbox': ?>
															<p style="font-size: 16px; padding: 0 0 5px; margin: 0;">
																<?php echo $field['value'] ? $field['checked_value'] : $field['unchecked_value'] ?>
															</p>
													<?php break ?>

													<?php case 'listmultiselect':
														case 'listcheckbox': ?>
															<ul style="list-style-position: inside; padding: 0 0 5px; margin: 0;">
																<?php foreach ( $field['value'] as $value ) : ?>
																	<li style="font-size: 16px; padding: 0; margin: 0;">
																		<?php echo $value ?>
																	</li>
																<?php endforeach ?>
															</ul>
													<?php break ?>

													<?php case 'starrating': ?>
														<?php if ( $field['value'] ) : ?>
															<p style="font-size: 16px; padding: 0 0 5px; margin: 0;">
																<?php echo $field['value'] . '/' . $field['number_of_stars'] ?>
															</p>
														<?php endif ?>
													<?php break ?>

													<?php case 'repeater': ?>
															<?php
																$values_count = count( $field['value'] ) / count( $field['fields'] );
																
																for ( $i = 0; $i < $values_count; $i++ ) : ?>
																	<!--[if mso]>
																	<table role="presentation" style="border: none; border-spacing: 0; border-collapse: collapse;">
																		<tr>
																			<td style="padding: 0 0 <?php echo $i != ( $values_count - 1 ) ? '5px' : '0' ?>;">
																			<![endif]-->
																				<ul style="list-style-position: inside; padding: 0 0 <?php echo $i != ( $values_count - 1 ) ? '5px' : '0' ?>; margin: 0;">
																					<?php foreach ( $field['fields'] as $sub_field_key => $sub_field_settings ) : ?>
																						<li style="font-size: 16px; padding: 0 20px 5px 0; margin: 0; text-align: right;">
																							<strong style="font-weight: bold;">
																								<?php echo $sub_field_settings['label'] ?>:
																							</strong>

																							<?php echo nl2br( $field['value'][ $sub_field_key . '_' . $i ] ) ?>
																						</li>
																					<?php endforeach ?>
																				</ul>
																			<!--[if mso]>
																			</td>
																		</tr>
																	</table>
																	<![endif]-->
															<?php endfor ?>
													<?php break ?>
														
													<?php default: ?>
															<p style="font-size: 16px; padding: 0 0 5px; margin: 0;">
																<?php echo nl2br( $field['value'] ) ?>
															</p>
													<?php break ?>
												<?php endswitch ?>
											</div>
										<!--[if mso]>
										</td>
									</tr>
								</table>
								<![endif]-->
							</div>
						<?php endforeach ?>
					</td>
				</tr>
			</table>
		</td>
	</tr>
</table>

<?php require( THEME_EMAIL_TEMPLATES_PATH . '/parts/footer.php' ) ?>