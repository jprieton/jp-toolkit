<?php

/**
 * AJAX Interface
 *
 * @since {VERSION}
 * @author Javier Prieto
 */

namespace JPToolkit\Framework\Ajax;

// If this file is called directly, abort.
defined('ABSPATH') || exit;

/**
 * AJAX Interface
 *
 * @author 		Javier Prieto
 * @package 	JPToolkit
 * @subpackage 	Framework\Ajax
 * @since 		{VERSION}
 */
interface AJAXInterface
{
	/**
	 * AJAX handler
	 *
	 * @since 	{VERSION}
	 * @return 	void
	 */
	public function ajax_handler();
}
