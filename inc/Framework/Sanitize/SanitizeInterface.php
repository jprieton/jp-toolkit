<?php

/**
 * Sanitize Interface
 *
 * @author 		Javier Prieto
 * @package 	JPToolkit
 * @subpackage 	Framework\Sanitize
 * @since 		2.0.1
 */

namespace JPToolkit\Framework\Sanitize;

// If this file is called directly, abort.
defined('ABSPATH') || exit;

/**
 * Sanitize Interface
 *
 * @author 		Javier Prieto
 * @package 	JPToolkit
 * @subpackage 	Framework\Sanitize
 * @since 		2.0.1
 */
interface SanitizeInterface
{
	/**
	 * Sanitize handler
	 *
	 * @since 	2.0.1
	 * @param 	mixed			$field
	 * @param 	array|string 	$args
	 * @return 	mixed
	 */
	public static function sanitize($var, $args = null);
}
