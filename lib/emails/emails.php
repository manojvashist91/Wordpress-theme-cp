<?php

use \Harbinger_Marketing\PDF_Generator;

add_filter('ninja_forms_action_email_message', 'ninja_forms_alter_email_template', 10, 9);
function ninja_forms_alter_email_template($message, $data, $action_settings) {
	ob_start();

	$fields = organize_ninja_forms_fields_array( $data['fields_by_key'] );

	switch ( $data['settings']['key'] ) {
		case 'application-form':
			require( THEME_EMAIL_TEMPLATES_PATH . '/application-form.php' );
			break;
			
		default:
			require( THEME_EMAIL_TEMPLATES_PATH . '/default.php' );
			break;
	}
	
	return ob_get_clean();
}

add_filter('ninja_forms_action_email_attachments', 'ninja_forms_application_form_email_add_pdf_attachment', 10, 3);
function ninja_forms_application_form_email_add_pdf_attachment($attachments, $data, $settings) {
	if ( $data['settings']['key'] != 'application-form' ) {
		return $attachments;
	}
	
	$pdf_template = THEME_PDF_TEMPLATES_PATH . '/application-form.php';
	$pdf_data = array(
		'form_title' => $data['settings']['title'],
		'fields' => organize_ninja_forms_fields_array( $data['fields_by_key'] )
	);
	$pdf_file_name = 'application-' . hash( 'md5', $pdf_template . serialize( $pdf_data ) ) . '.pdf';

	$attachments[] = PDF_Generator::generate( $pdf_template, $pdf_data, $pdf_file_name );

	return $attachments;
}