<?php

/**
 * Abstract class to handle Sanitizer.
 *
 * @author      Javier Prieto
 * @since       {VERSION}
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
 * @since       {VERSION}
 * @package     JPToolkit
 * @subpackage  Framework\Sanitize
 */
abstract class AbstractSanitize
{

	/**
	 * Sanitizes a value.
	 *
	 * @since 	{VERSION}
	 * @param 	mixed	$value
	 * @param 	mixed 	$args
	 * @return 	mixed
	 */
	protected static function sanitize_value(mixed $value, mixed $args = null): mixed
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
			$defaults = wp_parse_args($defaults, self::get_preset($args['preset']));
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
	 * @since     {VERSION}
	 * @param     mixed $value
	 * @param     array $callable
	 * @return    mixed
	 */
	protected static function callback(mixed $value, array $callable = []): mixed
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
	 * @since     {VERSION}
	 * @param     mixed $value
	 * @param     array $filter
	 * @return    mixed
	 */
	protected static function filter(mixed $value, array $filters = []): mixed
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
	 * @since   {VERSION}
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
