<?php require( THEME_PDF_TEMPLATES_PATH . '/parts/header.php' ) ?>

<h1>
	<?php echo $data['form_title'] ?>
</h1>

<?php foreach ( $data['fields'] as $field ) : ?>
	<div class="section">
		<div class="row row-last">
			<div class="field">
				<div class="label">
					<?php echo rtrim( $field['label'], '?:' ) ?>:
				</div>

				<div class="value">
					<?php switch ( $field['settings']['type'] ) :
							case 'checkbox': ?>
							<p>
								<?php echo $field['value'] ? $field['checked_value'] : $field['unchecked_value'] ?>
							</p>
						<?php break ?>

						<?php case 'listmultiselect':
							case 'listcheckbox': ?>
								<ul>
									<?php foreach ( $field['value'] as $value ) : ?>
										<li>
											<?php echo $value ?>
										</li>
									<?php endforeach ?>
								</ul>
						<?php break ?>

						<?php case 'starrating': ?>
							<?php if ( $field['value'] ) : ?>
								<p>
									<?php echo $field['value'] . '/' . $field['number_of_stars'] ?>
								</p>
							<?php endif ?>
						<?php break ?>

						<?php case 'repeater': ?>
							<?php
								$values_count = count( $field['value'] ) / count( $field['fields'] );

								for ( $i = 0; $i < $values_count; $i++ ) : ?>
									<ul>
										<?php foreach ( $field['fields'] as $sub_field_key => $sub_field_settings ) : ?>
											<li>
												<strong>
													<?php echo $sub_field_settings['label'] ?>:
												</strong>

												<?php echo nl2br( $field['value'][ $sub_field_key . '_' . $i ] ) ?>
											</li>
										<?php endforeach ?>
									</ul>
							<?php endfor ?>
						<?php break ?>

						<?php default: ?>
							<p>
								<?php echo nl2br( $field['value'] ) ?>
							</p>
						<?php break ?>
					<?php endswitch ?>
				</div>
			</div>
		</div>
	</div>
<?php endforeach ?>

<?php require( THEME_PDF_TEMPLATES_PATH . '/parts/footer.php' ) ?>