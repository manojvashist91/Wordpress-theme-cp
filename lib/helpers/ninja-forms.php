<?php

function organize_ninja_forms_fields_array($fields) {
	foreach ( $fields as $key => &$field ) {
		if ( in_array( $field['type'], array('html', 'hr', 'confirm', 'spam', 'recaptcha', 'submit') ) ) {
			unset( $fields[ $key ] );
		}

		if ( $field['type'] == 'repeater' ) {
			$repeater_id_key_mapping = array();

			foreach ( $field['fields'] as $bad_key => $sub_field ) {
				$field['fields'][ $sub_field['key'] ] = $sub_field;

				unset( $field['fields'][ $bad_key ] );

				$repeater_id_key_mapping[ $sub_field['id'] ] = $sub_field['key'];
			}

			foreach ( $field['value'] as $bad_key => $value_array ) {
				$new_key = str_replace(
					array_keys( $repeater_id_key_mapping ),
					array_values( $repeater_id_key_mapping ),
					$bad_key
				);
				
				if ( stripos( $bad_key, '_' ) === false ) {
					$new_key .= '_0';
				}

				$field['value'][ $new_key ] = $value_array['value'];

				unset( $field['value'][ $bad_key ] );
			}

			for ( $i = 0; $i < ( count( $field['value'] ) / count( $repeater_id_key_mapping ) ); $i++ ) {
				$values_are_empty = true;

				foreach ( $repeater_id_key_mapping as $mapping_key ) {
					if ( strlen( $field['value'][ $mapping_key . '_' . $i ] ) ) {
						$values_are_empty = false;

						break;
					}
				}

				if ( $values_are_empty ) {
					foreach ( $repeater_id_key_mapping as $mapping_key ) {
						unset( $field['value'][ $mapping_key . '_' . $i ] );
					}
				}
			}
		}
	}

	return array_values( $fields );
}