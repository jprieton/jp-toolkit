<?php

/**
 * AJAX Interface
 *
 * @author      Javier Prieto
 * @since       {VERSION}
 * @package     JPToolkit
 * @subpackage  Ajax
 */

namespace JPToolkit\Ajax;

// If this file is called directly, abort.
defined('ABSPATH') || exit;

/**
 * AJAX Interface
 *
 * @author      Javier Prieto
 * @since       {VERSION}
 * @package     JPToolkit
 * @subpackage  Ajax
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
