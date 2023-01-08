<?php

/**
 * Abstract class to handle Sanitizer.
 *
 * @author      Javier Prieto
 * @since       2.0.1
 * @package     JPToolkit
 * @subpackage  Framework\Sanitize
 */

namespace JPToolkit\Framework\Sanitize;

// If this file is called directly, abort.
defined('ABSPATH') || exit;

/**
 * Abstract class to handle Sanitizer.
 *
 * @author      Javier Prieto
 * @since       2.0.1
 * @package     JPToolkit
 * @subpackage  Framework\Sanitize
 */
abstract class AbstractSanitize
{

	/**
	 * Sanitizes a value.
	 *
	 * @since 	2.0.1
	 * @param 	mixed	$value
	 * @param 	array 	$args
	 * @return 	mixed
	 */
	protected static function sanitize_value($value, array $args = null)
	{
		// Default args
		$defaults = [
			'default'  => null,
			'callback' => [],
			'filter'   => [],
			'preset'   => null,
		];

		// If preset is set, override defaults
		if (!empty($args['preset'])) {
			$defaults = wp_parse_args(self::get_preset($args['preset']), $defaults);
		}

		$args = wp_parse_args($args, $defaults);

		// If empty return default
		if (empty($value)) {
			return $args['default'];
		}

		// If callback is set, call it
		if (!empty($args['callback'])) {
			$value = self::callback($value, (array) $args['callback']);
		}

		// If filter is set, apply it
		if (!empty($args['filter'])) {
			$value = self::filter($value, (array) $args['filter']);
		}

		return $value;
	}

	/**
	 * Executes the callbacks
	 *
	 * @since     2.0.1
	 * @param     mixed $value
	 * @param     array $callable
	 * @return    mixed
	 */
	protected static function callback($value, array $callable = [])
	{
		foreach ($callable as $callback) {
			if (is_callable($callback)) {
				$value = call_user_func($callback, $value);
			}
		}
		return $value;
	}
	/**
	 * Executes the filters
	 *
	 * @since     2.0.1
	 * @param     mixed $value
	 * @param     array $filter
	 * @return    mixed
	 */
	protected static function filter($value, array $filters = [])
	{
		foreach ($filters as $filter) {
			if (has_filter($filter)) {
				$value = apply_filters($filter, $value);
			}
		}
		return $value;
	}

	/**
	 * Return preset value for sanitizations
	 *
	 * @since   2.0.1
	 * @param 	string $preset
	 * @return 	array
	 */
	protected static function get_preset(string $preset): array
	{
		if (has_filter($preset)) {
			$preset = apply_filters($preset, []);
		} else {
			$preset = apply_filters("jp_toolkit_sanitize_{$preset}_preset", []);
		}

		return $preset;
	}
}
