<?php

/**
 * The Init class initializes the Html Helper plugin
 * commonly used HTML form tags.
 *
 * @package       JPToolkit
 * @subpackage    JPToolkit
 */

namespace JPToolkit;

// Exit if accessed directly.
defined('ABSPATH') || exit;

use JPToolkit\HtmlHelper\Init as HtmlHelperInit;
use JPToolkit\AssetsHelper\Init as AssetsHelperInit;
use JPToolkit\Admin\Init as AdminInit;

/**
 * This class is required to initialize the shorthands bundled in this plugin
 *
 * @package       JPToolkit
 * @author        Javier Prieto
 * @since         1.0.0
 */
class JPToolkit
{
	/**
	 * Constructor class
	 *
	 * @since         1.1.0
	 */
	public function init()
	{
		// Initialize admin
		new AdminInit();

		// Initialize helpers
		new HtmlHelperInit();
		new AssetsHelperInit();
	}
}
