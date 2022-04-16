<?php
/**
 * Sanitize class for sanitizing $_GET values
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
 * Sanitize class for sanitizing $_GET values
 *
 * @package 	JPToolkit
 * @subpackage 	Framework\Sanitize
 * @since 		{VERSION}
 * @author 		Javier Prieto
 */
class Sanitize extends AbstractSanitize implements SanitizeInterface
{
	/**
	 * Sanitizes a value.
	 *
	 * @since 	{VERSION}
	 * @param 	mixed	$field
	 * @param 	mixed 	$args
	 * @return 	mixed
	 */
	public static function sanitize(mixed $var, mixed $args = null): mixed
	{
		// If $args is string check if exists a preset shorthand
		if (is_string($args) ) {
			$args = self::get_preset($args);
		}

		return self::sanitize_value($var, (array) $args);
	}
}
