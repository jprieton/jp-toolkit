<?php

/**
 * AJAX Interface
 *
 * @author      Javier Prieto
 * @since       2.0.1
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
 * @since       2.0.1
 * @package     JPToolkit
 * @subpackage  Ajax
 */
interface AjaxInterface
{
	/**
	 * AJAX handler
	 *
	 * @since 	2.0.1
	 * @return 	void
	 */
	public function ajax_handler();
}
