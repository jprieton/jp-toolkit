<?php

/**
 * Class to manage default sanitizations presets
 *
 * @package 	JPToolkit
 * @subpackage 	Framework\Sanitize
 * @since 		{VERSION}
 * @author 		Javier Prieto
 */

namespace JPToolkit\Framework\Sanitize;

// If this file is called directly, abort.
defined('ABSPATH') || exit;

/**
 * Class to manage default sanitizations presets
 *
 * @package 	JPToolkit
 * @subpackage 	Framework\Sanitize
 * @since 		{VERSION}
 * @author 		Javier Prieto
 */
class SanitizePresets
{
	/**
	 * Class constructor
	 */
	public function __construct()
	{
		$presets = [
			'email',
			'text',
			'textarea',
			'integer',
			'boolean',
			'yes_no',
		];

		foreach ($presets as $preset) {
			add_filter("jp_toolkit_sanitize_{$preset}_preset", [$this, "sanitize_{$preset}"]);
		}
	}

	/**
	 * Strips out all characters that are not allowable in an email.
	 *
	 * @since {VERSION}
	 * @param array $preset
	 * @return array
	 */
	public function sanitize_email($preset = []): array
	{
		$preset['default']  = '';
		$preset['callback'] = ['sanitize_email', 'strtolower', 'trim'];

		return $preset;
	}

	/**
	 * Sanitizes a string from user input or from the database.
	 *
	 * @since {VERSION}
	 * @param array $preset
	 * @return void
	 */
	public function sanitize_text($preset = []): array
	{
		$preset['default']  = '';
		$preset['callback'] = ['sanitize_text_field'];

		return $preset;
	}

	/**
	 * Sanitizes a string from user input or from the database.
	 *
	 * @since {VERSION}
	 * @param array $preset
	 * @return void
	 */
	public function sanitize_textarea($preset = []): array
	{
		$preset['default']  = '';
		$preset['callback'] = ['sanitize_textarea_field'];

		return $preset;
	}

	/**
	 * Sanitizes a integer from user input or from the database.
	 *
	 * @since {VERSION}
	 * @param array $preset
	 * @return void
	 */
	public function sanitize_integer($preset = []): array
	{
		$preset['default']  = 0;
		$preset['callback'] = ['inval'];

		return $preset;
	}

	/**
	 * Sanitizes a boolean from user input or from the database.
	 *
	 * @since {VERSION}
	 * @param array $preset
	 * @return array
	 */
	public function sanitize_boolean($preset = []): array
	{
		$preset['default']  = false;
		$preset['callback'] = ['boolval'];

		return $preset;
	}

	/**
	 * Sanitizes a value from user input or from the database.
	 *
	 * @since {VERSION}
	 * @param array $preset
	 * @return array
	 */
	public function sanitize_yes_no($preset = []): array
	{
		$preset['default']  = 'no';
		$preset['callback'] = ['jp_toolkit_sanitize_yes_no_field'];

		return $preset;
	}
}
