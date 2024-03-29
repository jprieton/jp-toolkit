<?php
/**
 * Data class for sanitizing values
 *
 * @package 	JPToolkit
 * @subpackage 	Framework\Sanitize
 * @since 		2.0.1
 * @author 		Javier Prieto
 */

namespace JPToolkit\Framework\Sanitize;

// If this file is called directly, abort.
defined('ABSPATH') || exit;

/**
 * Data class for sanitizing values
 *
 * @package 	JPToolkit
 * @subpackage 	Framework\Sanitize
 * @since 		2.0.1
 * @author 		Javier Prieto
 */
class Data extends AbstractSanitize implements SanitizeInterface
{
	/**
	 * Sanitizes a value.
	 *
	 * @since 	2.0.1
	 * @param 	mixed			$field
	 * @param 	array|string 	$args
	 * @return 	mixed
	 */
	public static function sanitize($var, $args = null)
	{
		// No args, no rules to apply
		if (empty($args)) {
			return $var;
		}

		// If $args is string check if exists a preset shorthand
		if (is_string($args) ) {
			$args = self::get_preset($args);
		}

		return self::sanitize_value($var, (array) $args);
	}
}
