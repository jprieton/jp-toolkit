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
	 * @return 	void
	 */
	public static function sanitize(mixed $var, mixed $args = null): mixed;
}
