<?php


/**
 * Sanitizes a string from user input or from the database.
 *
 * @since {VERSION}
 *
 * @param   bool|string|int $value The value being evaluated.
 * @return  string          Sanitized string (yes|no).
 */
function jp_toolkit_sanitize_yes_no_field($value): string
{
	// Check if value is empty, or not a string.
	if (empty($value) || is_object($value) || is_array($value)) {
		$filtered = 'no';
	}

	// Check if value is a boolean
	if (is_bool($value)) {
		$filtered = $value ? 'yes' : 'no';
	}

	// Check if value is a numeric
	if (is_numeric($value)) {
		$filtered = $value ? 'yes' : 'no';
	}

	$value = trim($value);

	// Check if value is a string
	switch ($value) {
			// Check if value is 'yes' or similar
		case 'yes':
		case 'y':
		case 'true':
			$filtered = 'yes';
			break;
			// Check if value is 'no' or similar
		case 'no':
		case 'n':
		case 'false':
			$filtered = 'no';
			break;

			// Any other value is set to 'no'
		default:
			$filtered = 'no';
			break;
	}


	return apply_filters('jp_toolkit_sanitize_yes_no_field', $filtered, $value);
}
