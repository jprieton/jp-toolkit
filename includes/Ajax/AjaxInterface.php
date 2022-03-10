<?php

/**
 * AJAX Interface
 *
 * @since {SINCE_VERSION}
 * @author Javier Prieto
 */

namespace JPToolkit\Ajax;

// If this file is called directly, abort.
defined('ABSPATH') || exit;

/**
 * AJAX Interface
 *
 * @since {SINCE_VERSION}
 * @author Javier Prieto
 */
interface AJAXInterface
{
	/**
	 * AJAX handler
	 *
	 * @since 	{SINCE_VERSION}
	 * @return 	void
	 */
	public function ajax_handler();
}
