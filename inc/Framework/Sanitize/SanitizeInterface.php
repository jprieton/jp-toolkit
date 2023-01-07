<?php

/**
 * Sanitize Interface
 *
 * @author 		Javier Prieto
 * @package 	JPToolkit
 * @subpackage 	Framework\Sanitize
 * @since 		{VERSION}
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
 * @since 		{VERSION}
 */
interface SanitizeInterface
{
	/**
	 * Sanitize handler
	 *
	 * @since 	{VERSION}
	 * @param 	mixed			$field
	 * @param 	array|string 	$args
	 * @return 	mixed
	 */
	public static function sanitize($var, $args = null);
}
